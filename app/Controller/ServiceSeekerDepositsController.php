<?php
App::uses('AppController', 'Controller');

/**
 * ServiceSeekerDeposits Controller
 *
 * @property ServiceSeekerDeposit $ServiceSeekerDeposit
 * @property PaginatorComponent $Paginator
 */
class ServiceSeekerDepositsController extends AppController
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
        $conditions = ' ServiceSeekerDeposit.user_id="' . $this->Auth->user('id') . '" ';
        if (!empty($this->params->query)) {
            $depositedDate = $this->params->query['deposited'];
            $transactionMedium = $this->params->query['transaction_medium'];
            $transactionStatus = $this->params->query['transaction_status'];
            if (!empty($depositedDate)) {
                $depositedDates = "'" . $depositedDate . "'";
                $conditions .= "and ServiceSeekerDeposit.deposited_date=" . $depositedDates;
            }
            if (!empty($transactionMedium)) {
                $conditions .= "and ServiceSeekerDeposit.amount_medium='" . $transactionMedium . "'";
            }
            if (!empty($transactionStatus)) {
                $conditions .= "and ServiceSeekerDeposit.status='" . $transactionStatus . "'";
            }

            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => 'ServiceSeekerDeposit.deposited_date'
            );
        } else {
            $depositedDate = '';
            $transactionMedium = '';
            $transactionStatus = '';
            $this->Paginator->settings = array(
                'conditions' => array(
                    'ServiceSeekerDeposit.status' => 'New Deposit',
                    'ServiceSeekerDeposit.user_id' => $this->Auth->user('id')
                ),
                'order' => 'ServiceSeekerDeposit.deposited_date'
            );
        }
        $this->ServiceSeekerDeposit->recursive = 0;
        $serviceSeekerDeposits = $this->Paginator->paginate();
        $this->set(compact('serviceSeekerDeposits', 'depositedDate', 'transactionMedium', 'transactionStatus'));
    }

    public function deposit_history()
    {
        $this->ServiceSeekerDeposit->recursive = 0;

        $this->Paginator->settings = array('order' => array('deposited_date' => 'DESC'));
        //debug($this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));die;
        $this->set('serviceSeekerDeposits', $this->Paginator->paginate(array('user_id' => $this->Auth->User('id'))));
    }

    public function admin_deposit_history($id = null)
    {
        $this->ServiceSeekerDeposit->recursive = 0;
        $this->Paginator->settings = array('order' => array('deposited_date' => 'DESC'));
        //debug($this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));die;
        $this->set('serviceSeekerDeposits', $this->Paginator->paginate(array('user_id' => $id)));
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
        if (!$this->ServiceSeekerDeposit->exists($id)) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        $options = array('conditions' => array('ServiceSeekerDeposit.' . $this->ServiceSeekerDeposit->primaryKey => $id));
        $this->set('serviceSeekerDeposit', $this->ServiceSeekerDeposit->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ServiceSeekerDeposit->create();
            if ($this->ServiceSeekerDeposit->save($this->request->data)) {
                $this->Session->setFlash('The service seeker deposit has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service seeker deposit could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
        $users = $this->ServiceSeekerDeposit->User->find('list');
        $this->set(compact('users'));
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
        if (!$this->ServiceSeekerDeposit->exists($id)) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServiceSeekerDeposit->save($this->request->data)) {
                $this->Session->setFlash('The service seeker deposit has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service seeker deposit could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceSeekerDeposit.' . $this->ServiceSeekerDeposit->primaryKey => $id));
            $this->request->data = $this->ServiceSeekerDeposit->find('first', $options);
        }
        $users = $this->ServiceSeekerDeposit->User->find('list');
        $this->set(compact('users'));
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
        $this->ServiceSeekerDeposit->id = $id;
        if (!$this->ServiceSeekerDeposit->exists()) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceSeekerDeposit->delete()) {
            $this->Session->setFlash('The service seeker deposit has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service seeker deposit could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_verify method
     * verify bank deposit
     * @return void
     */
    public function admin_verify($id = null)
    {
        $this->ServiceSeekerDeposit->id = $id;
        if (!$this->ServiceSeekerDeposit->exists()) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        $this->request->onlyAllow('post', 'delete');
        $this->request->data['ServiceSeekerDeposit']['verified_by'] = $this->Auth->user('id');
        $this->request->data['ServiceSeekerDeposit']['status'] = "Success";
        $this->request->data['ServiceSeekerDeposit']['id'] = $id;

        if ($this->ServiceSeekerDeposit->save($this->request->data)) {
            $this->Session->setFlash('The deposit has been verified.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The deposit could not be verified. Please, try again.', 'default',
                array('class' => 'success'));
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
        $conditions = ' 1=1 ';
        if (!empty($this->params->query)) {
            $depositedDate = $this->params->query['deposited'];
            $transactionMedium = $this->params->query['transaction_medium'];
            $transactionStatus = $this->params->query['transaction_status'];
            $type = $this->params->query['type'];
            if (!empty($depositedDate)) {
                $depositedDates = "'" . $depositedDate . "'";
                $conditions .= "and ServiceSeekerDeposit.deposited_date=" . $depositedDates;
            }
            if (!empty($transactionMedium)) {
                $conditions .= "and ServiceSeekerDeposit.amount_medium='" . $transactionMedium . "'";
            }
            if (!empty($transactionStatus)) {
                $conditions .= "and ServiceSeekerDeposit.status='" . $transactionStatus . "'";
            }
            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;
                $serviceSeekerDeposits = $this->ServiceSeekerDeposit->find('all',
                    array('conditions' => array($conditions)));
                $this->set(compact('serviceSeekerDeposits'));
                $this->render('/Elements/ServiceSeekerDeposit_record');
            }

            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => 'ServiceSeekerDeposit.deposited_date DESC'
            );
        } else {
            $depositedDate = '';
            $transactionMedium = '';
            $transactionStatus = '';
            $this->Paginator->settings = array(
                'conditions' => array('ServiceSeekerDeposit.status' => 'New Deposit'),
                'order' => 'ServiceSeekerDeposit.deposited_date DESC'
            );
        }
        $this->ServiceSeekerDeposit->recursive = 0;
        $serviceSeekerDeposits = $this->Paginator->paginate();
        $this->set(compact('serviceSeekerDeposits', 'depositedDate', 'transactionMedium', 'transactionStatus'));
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
        if (!$this->ServiceSeekerDeposit->exists($id)) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        $options = array('conditions' => array('ServiceSeekerDeposit.' . $this->ServiceSeekerDeposit->primaryKey => $id));
        $this->set('serviceSeekerDeposit', $this->ServiceSeekerDeposit->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ServiceSeekerDeposit->create();
            if ($this->request->data['ServiceSeekerDeposit']['currency'] === 'USD') {
                $USD_Rate = $this->Useful->getMaxUSDDate();
                $this->request->data['ServiceSeekerDeposit']['amount_nrs'] = $this->request->data['ServiceSeekerDeposit']['amount'] * $USD_Rate;
                $this->request->data['ServiceSeekerDeposit']['amount_usd'] = $this->request->data['ServiceSeekerDeposit']['amount'];
            } else {
                $this->request->data['ServiceSeekerDeposit']['amount_nrs'] = $this->request->data['ServiceSeekerDeposit']['amount'];
                $this->request->data['ServiceSeekerDeposit']['amount_usd'] = 0;
            }
            $this->request->data['ServiceSeekerDeposit']['amount_medium'] = 'Bank Deposit';
            $this->request->data['ServiceSeekerDeposit']['deposited_by'] = $this->Auth->user('name');
            $this->request->data['ServiceSeekerDeposit']['status'] = 'Success';
            $this->request->data['ServiceSeekerDeposit']['deposited_date'] = $this->request->data['ServiceSeekerDeposit']['deposited_date']['year'] . '-' . $this->request->data['ServiceSeekerDeposit']['deposited_date']['month'] . '-' . $this->request->data['ServiceSeekerDeposit']['deposited_date']['day'];
            /*debug($this->request->data['ServiceSeekerDeposit']);
            exit;*/
            if ($this->ServiceSeekerDeposit->save($this->request->data)) {
                $this->Session->setFlash('The service seeker deposit has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service seeker deposit could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
        $users = $this->ServiceSeekerDeposit->User->find('list');
        $getProvider = $this->Useful->getSeekerSuggestionList();
        $this->set(compact('users', 'getProvider'));
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
        if (!$this->ServiceSeekerDeposit->exists($id)) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->request->data['ServiceSeekerDeposit']['currency'] === 'USD') {
                $USD_Rate = $this->Useful->getMaxUSDDate();
                $this->request->data['ServiceSeekerDeposit']['amount_nrs'] = $this->request->data['ServiceSeekerDeposit']['amount'] * $USD_Rate;
                $this->request->data['ServiceSeekerDeposit']['amount_usd'] = $this->request->data['ServiceSeekerDeposit']['amount'];
            } else {
                $this->request->data['ServiceSeekerDeposit']['amount_nrs'] = $this->request->data['ServiceSeekerDeposit']['amount'];
                $this->request->data['ServiceSeekerDeposit']['amount_usd'] = 0;
            }
            $this->request->data['ServiceSeekerDeposit']['deposited_date'] = $this->request->data['ServiceSeekerDeposit']['deposited_date']['year'] . '-' . $this->request->data['ServiceSeekerDeposit']['deposited_date']['month'] . '-' . $this->request->data['ServiceSeekerDeposit']['deposited_date']['day'];
            //debug($this->request->data);exit;
            if ($this->ServiceSeekerDeposit->save($this->request->data)) {
                $this->Session->setFlash('The service seeker deposit has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service seeker deposit could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceSeekerDeposit.' . $this->ServiceSeekerDeposit->primaryKey => $id));
            $this->request->data = $this->ServiceSeekerDeposit->find('first', $options);
        }
        $options = array('conditions' => array('ServiceSeekerDeposit.' . $this->ServiceSeekerDeposit->primaryKey => $id));
        $depositData = $this->ServiceSeekerDeposit->find('first', $options);
        $users = $this->ServiceSeekerDeposit->User->find('list',
            array('conditions' => array('User.role' => 'ServiceSeeker', 'User.status' => 1)));
        $this->set(compact('users', 'depositData'));
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
        $this->ServiceSeekerDeposit->id = $id;
        if (!$this->ServiceSeekerDeposit->exists()) {
            throw new NotFoundException(__('Invalid service seeker deposit'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceSeekerDeposit->delete()) {
            $this->Session->setFlash('The service seeker deposit has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service seeker deposit could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
