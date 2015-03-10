<?php
App::uses('AppController', 'Controller');

/**
 * ServicePackageRequests Controller
 *
 * @property ServicePackageRequest $ServicePackageRequest
 * @property PaginatorComponent $Paginator
 */
class ServicePackageRequestsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Useful');
    public $helpers = array('SmartForm');

    /**
     * index method
     *
     * @return void
     */
    /*public function index() {
        $this->ServicePackageRequest->recursive = 0;
        $this->set('servicePackageRequests', $this->Paginator->paginate());
    }*/

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*public function view($id = null) {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $options = array('conditions' => array('ServicePackageRequest.' . $this->ServicePackageRequest->primaryKey => $id));
        $this->set('servicePackageRequest', $this->ServicePackageRequest->find('first', $options));
    }*/

    /**
     * add method
     *
     * @return void
     */
    public function add($slug = null)
    {
        if (empty($slug)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $servicePackages = $this->ServicePackageRequest->ServicePackage->find('first', array(
            'conditions' => array('ServicePackage.slug' => $slug, 'ServicePackage.is_active' => 1),
            'recursive' => -1
        ));
        if ($this->request->is('post')) {

            $this->request->data['ServicePackageRequest']['rate'] = $servicePackages['ServicePackage']['rate'];
            $this->request->data['ServicePackageRequest']['service_package_id'] = $servicePackages['ServicePackage']['id'];
            $this->request->data['ServicePackageRequest']['created_date'] = date('Y-m-d');
            $this->request->data['ServicePackageRequest']['status'] = 'New Request';
            $this->request->data['ServicePackageRequest']['seeker_id'] = $this->Auth->user('id');
            $this->request->data['ServicePackageRequest']['requested_date'] = $this->request->data['ServicePackageRequest']['requested'];
            $this->request->data['ServicePackageRequest']['requested_amount'] = $this->request->data['ServicePackageRequest']['rate'];
            $this->request->data['ServicePackageRequest']['is_locked'] = 0;
            //debug($this->request->data);exit;
            $getUserBalance = $this->Useful->CalculateAmount($this->Auth->user('id'));
            if ($getUserBalance < $this->request->data['ServicePackageRequest']['rate']) {
                $this->Session->setFlash('You do not have enough balance to process the request. Please recharge your account.',
                    'default', array('class' => 'error-message'));
            } else {
                $this->ServicePackageRequest->create();
                if ($this->ServicePackageRequest->save($this->request->data)) {
                    $this->Session->setFlash('The service package request has been processed.', 'default',
                        array('class' => 'success'));

                    return $this->redirect(array('action' => 'add', $slug));
                } else {
                    $this->Session->setFlash('The service package request could not be saved. Please, try again.',
                        'default', array('class' => 'error-message'));
                }
            }
        }
        $this->set(compact('servicePackages'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*public function edit($id = null) {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicePackageRequest->save($this->request->data)) {
                $this->Session->setFlash(__('The service package request has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The service package request could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('ServicePackageRequest.' . $this->ServicePackageRequest->primaryKey => $id));
            $this->request->data = $this->ServicePackageRequest->find('first', $options);
        }
        $servicePackages = $this->ServicePackageRequest->ServicePackage->find('list');
        $this->set(compact('servicePackages'));
    }*/

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*public function delete($id = null) {
        $this->ServicePackageRequest->id = $id;
        if (!$this->ServicePackageRequest->exists()) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackageRequest->delete()) {
            $this->Session->setFlash(__('The service package request has been deleted.'));
        } else {
            $this->Session->setFlash(__('The service package request could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }*/

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ServicePackageRequest->recursive = 0;
        $this->Paginator->settings = array('order' => array('ServicePackageRequest.created_date' => 'desc'));
        $this->set('servicePackageRequests', $this->Paginator->paginate());
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_lock($id = null, $status = null)
    {
        $this->ServicePackageRequest->id = $id;
        if (!$this->ServicePackageRequest->exists()) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $this->request->onlyAllow('post', 'delete');
        $this->request->data['ServicePackageRequest']['id'] = $id;
        if ($status == 0) {
            $this->request->data['ServicePackageRequest']['locked_by'] = $this->Auth->user('id');
            $this->request->data['ServicePackageRequest']['is_locked'] = 1;

            if ($this->ServicePackageRequest->save($this->request->data)) {
                $this->Session->setFlash('The request has been locked.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The request could not be locked. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }

        } else {
            $this->request->data['ServicePackageRequest']['locked_by'] = 0;
            $this->request->data['ServicePackageRequest']['is_locked'] = 0;

            if ($this->ServicePackageRequest->save($this->request->data)) {
                $this->Session->setFlash('The request has been unlocked.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The request could not be unlocked. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }

        //echo $status;debug($this->request->data);exit;

        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_view($id = null)
    {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $options = array('conditions' => array('ServicePackageRequest.' . $this->ServicePackageRequest->primaryKey => $id));
        $this->set('servicePackageRequest', $this->ServicePackageRequest->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ServicePackageRequest->create();
            if ($this->ServicePackageRequest->save($this->request->data)) {
                $this->Session->setFlash('The service package request has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package request could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }
        $servicePackages = $this->ServicePackageRequest->ServicePackage->find('list');
        $this->set(compact('servicePackages'));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_assign($id = null)
    {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $servicePackages = $this->ServicePackageRequest->find('first',
            array('conditions' => array('ServicePackageRequest.id' => $id)));
        if ($this->request->is('post')) {
            $this->request->data['ServicePackageRequest']['id'] = $id;
            $this->request->data['ServicePackageRequest']['status'] = 'Assigned';

            //debug($this->request->data);exit;
            $this->ServicePackageRequest->create();
            if ($this->ServicePackageRequest->save($this->request->data)) {


                $breakProviders = explode(',', $this->request->data['ServicePackageRequest']['providers']);
                foreach ($breakProviders as $provider):
                    //debug($servicePackages);exit;
                    $this->ServicePackageRequest->query("
											insert into service_package_assigned_providers
											(service_package_request_id,provider_id,assigned_date,status)
											values
											(										'{$id}','{$provider}','{$servicePackages['ServicePackageRequest']['requested_date']}','Assigned'
											)
											");
                endforeach;
                $this->Session->setFlash('The service package request has been assigned.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package request could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }

        $getProvider = $this->Useful->getSuggestionList();
        //debug($servicePackages);
        $this->set(compact('servicePackages', 'getProvider'));
    }


    public function admin_new_assign($id = null)
    {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $servicePackages = $this->ServicePackageRequest->find('first',
            array('conditions' => array('ServicePackageRequest.id' => $id)));
        //debug($id);
        if ($this->request->is('post')) {
            //$this->request->data['ServicePackageRequest']['id'] = $id;
            //$this->request->data['ServicePackageRequest']['status'] = 'Assigned';

            //debug($this->request->data);exit;
            //$this->ServicePackageRequest->create();
            $breakProviders = explode(',', $this->request->data['ServicePackageRequest']['providers']);
            foreach ($breakProviders as $provider):
                $this->ServicePackageRequest->query("
											insert into service_package_assigned_providers
											(service_package_request_id,provider_id,assigned_date,status)
											values
											(
											'{$id}','{$provider}','{$servicePackages['ServicePackageRequest']['requested_date']}','Assigned'
											)
											");
            endforeach;
            $this->Session->setFlash('The service package request has been assigned.', 'default',
                array('class' => 'success'));

            return $this->redirect(array('action' => 'index'));

        }
        $Assigned_Provider = $this->ServicePackageRequest->query("Select provider_id from service_package_assigned_providers where service_package_request_id ='$id'");
        //debug($Assigned_Provider);die;
        $getProvider = $this->Useful->getProviderSuggestionList($id);
        //debug($servicePackages);
        $this->set(compact('servicePackages', 'getProvider', 'Assigned_Provider'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->ServicePackageRequest->exists($id)) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicePackageRequest->save($this->request->data)) {
                $this->Session->setFlash('The service package request has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package request could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServicePackageRequest.' . $this->ServicePackageRequest->primaryKey => $id));
            $this->request->data = $this->ServicePackageRequest->find('first', $options);
        }
        $servicePackages = $this->ServicePackageRequest->ServicePackage->find('list');
        $this->set(compact('servicePackages'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null)
    {
        $this->ServicePackageRequest->id = $id;
        if (!$this->ServicePackageRequest->exists()) {
            throw new NotFoundException(__('Invalid service package request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackageRequest->delete()) {
            $this->Session->setFlash('The service package request has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service package request could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }


    public function admin_verify($id = null, $provider_id = null, $number = null)
    {
        //debug(date('Y-m-d'));die;
        //$this->ServicePackageRequest->id = $id;
        $this->request->onlyAllow('post', 'delete');

        if ($number == '1') {
            $this->ServicePackageRequest->query("UPDATE service_package_assigned_providers SET status='Withheld' WHERE service_package_request_id='$id' and provider_id='$provider_id' ");


        } elseif ($number == '2') {
            $this->ServicePackageRequest->query("UPDATE service_package_assigned_providers SET status='Assigned' WHERE service_package_request_id='$id' and provider_id='$provider_id' ");

        } else {

            $this->Session->setFlash('Please, try again.', 'default', array('class' => 'error-message'));
        }

        /*if ($this->ServicePackageRequest->save($this->request->data)) {
                    $this->Session->setFlash(__('Success.'));
                    return $this->redirect(array('action' => 'view',$id));
                } else {
                    $this->Session->setFlash(__('Please, try again.'));
                }*/

        return $this->redirect(array('action' => 'view', $id));

    }
}
