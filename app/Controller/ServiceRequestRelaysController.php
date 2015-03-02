<?php
App::uses('AppController', 'Controller');

/**
 * ServiceRequestRelays Controller
 *
 * @property ServiceRequestRelay $ServiceRequestRelay
 * @property PaginatorComponent $Paginator
 */
class ServiceRequestRelaysController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Useful');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->ServiceRequestRelay->recursive = 0;
        $this->set('serviceRequestRelays', $this->Paginator->paginate());
    }

    public function seeker_request()
    {

        $id = $this->Auth->User('id');
        $this->Paginator->settings = array('order' => array('ServiceRequestRelay.created_date' => 'desc'));


        $previous_id = $this->ServiceRequestRelay->query("SELECT group_concat(previous_request_id) previous_id FROM `seeker_provider_requests` WHERE service_seeker_id ='$id' and previous_request_id !='0'");

        if (!empty($previous_id[0][0]['previous_id'])) {
            $request_id = 'ServiceRequestRelay.seeker_provider_request_id not in(' . $previous_id[0][0]['previous_id'] . ')';
        } else {
            $request_id = 'ServiceRequestRelay.seeker_provider_request_id !=0';
        }
        $hideSearchBar = true;	
	    $active_seeker_request = "active";
        $page_title = "Response";
        $this->set(compact('hideSearchBar', 'active_seeker_request','page_title'));
        $this->ServiceRequestRelay->recursive = 0;
        $this->set('serviceRequestRelays',$this->Paginator->paginate(array('ServiceRequestRelay.service_seeker_id' => $id, $request_id)));

    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->ServiceRequestRelay->exists($id)) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        $options = array('conditions' => array('ServiceRequestRelay.' . $this->ServiceRequestRelay->primaryKey => $id));
        $this->set('serviceRequestRelay', $this->ServiceRequestRelay->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ServiceRequestRelay->create();
            if ($this->ServiceRequestRelay->save($this->request->data)) {
                $this->Session->setFlash('The service request relay has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service request relay could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
        $seekerProviderRequests = $this->ServiceRequestRelay->SeekerProviderRequest->find('list');
        $this->set(compact('seekerProviderRequests'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->ServiceRequestRelay->exists($id)) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServiceRequestRelay->save($this->request->data)) {
                $this->Session->setFlash('The service request relay has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service request relay could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceRequestRelay.' . $this->ServiceRequestRelay->primaryKey => $id));
            $this->request->data = $this->ServiceRequestRelay->find('first', $options);
        }
        $seekerProviderRequests = $this->ServiceRequestRelay->SeekerProviderRequest->find('list');
        $this->set(compact('seekerProviderRequests'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->ServiceRequestRelay->id = $id;
        if (!$this->ServiceRequestRelay->exists()) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceRequestRelay->delete()) {
            $this->Session->setFlash('The service request relay has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service request relay could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ServiceRequestRelay->recursive = 0;
        $this->set('serviceRequestRelays', $this->Paginator->paginate());
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
        if (!$this->ServiceRequestRelay->exists($id)) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        $options = array('conditions' => array('ServiceRequestRelay.' . $this->ServiceRequestRelay->primaryKey => $id));
        $this->set('serviceRequestRelay', $this->ServiceRequestRelay->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add($id = null)
    {
        if ($this->request->is('post')) {
            $date = date('Y-m-d H:i:s');
            $this->request->data['ServiceRequestRelay']['created_date'] = $date;
            //$this->request->data['ServiceRequestRelay']['service_provider_id']=implode(',',$this->request->data['ServiceRequestRelay']['providers']);
            $this->request->data['ServiceRequestRelay']['service_provider_id'] = $this->request->data['ServiceRequestRelay']['providers'];
            //debug($this->request->data);die;
            $this->ServiceRequestRelay->create();
            if ($this->ServiceRequestRelay->save($this->request->data)) {
                /*$this->loadModel('SeekerProviderRequest');
        if($this->SeekerProviderRequest->field('status')=='1'){
                        $this->SeekerProviderRequest->saveField('status','0');
            }*/
                $this->Session->setFlash('The service request relay has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service request relay could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
        $seekerProviderRequests = $this->ServiceRequestRelay->SeekerProviderRequest->find('all', array('conditions' => array('`SeekerProviderRequest`.`id`' => $id)));
        //debug($seekerProviderRequests );
        //$this->loadModel('User');
        //$provider=$this->User->find('list',array('conditions'=>array('User.role'=>'Serviceprovider'),'fields'=>'User.name'));
        //provider=$this->ServiceRequestRelay->find('list',array('conditions'=>array('User.role'=>'Serviceprovider'),'fields'=>'User.name'));
        //$this->set('provider',$provider);
        $category = $this->ServiceRequestRelay->query("select group_concat(service_categories_id) category_id from provider_service_categories where user_id ='{$seekerProviderRequests[0]['SeekerProviderRequest']['service_provider_id']}'");
        $category = str_replace(",", "','", $category[0][0]['category_id']);
        //debug($category);die;
        $Provider_listing = $this->ServiceRequestRelay->query("select distinct(user_id) from provider_service_categories where service_categories_id in ('$category')");
        //debug($Provider_listing);die;
        $getProvider = $this->Useful->getSuggestionList();
        $this->set(compact('seekerProviderRequests', 'provider', 'getProvider', 'Provider_listing'));
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
        if (!$this->ServiceRequestRelay->exists($id)) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServiceRequestRelay->save($this->request->data)) {
                $this->Session->setFlash('The service request relay has been updated.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service request relay could not be updated. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceRequestRelay.' . $this->ServiceRequestRelay->primaryKey => $id));
            $this->request->data = $this->ServiceRequestRelay->find('first', $options);
        }
        $seekerProviderRequests = $this->ServiceRequestRelay->SeekerProviderRequest->find('list');
        $this->set(compact('seekerProviderRequests'));
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
        $this->ServiceRequestRelay->id = $id;
        if (!$this->ServiceRequestRelay->exists()) {
            throw new NotFoundException(__('Invalid service request relay'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceRequestRelay->delete()) {
            $this->Session->setFlash('The service request relay has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service request relay could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
