<?php
App::uses('AppController', 'Controller');

/**
 * Complains Controller
 *
 * @property Complain $Complain
 * @property PaginatorComponent $Paginator
 */
class ComplainsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Complain->recursive = 0;
        $this->set('complains', $this->Paginator->paginate());
    }

    public function complain_history()
    {
        $this->Complain->recursive = 0;
        $this->Paginator->settings = array('order' => array('complain_date' => ' desc'));
        $this->set('complains_history', $this->Paginator->paginate(array('service_seeker_id' => $this->Auth->User('id'))));
    }

    public function admin_complain_history($id = null)
    {
        $this->Complain->recursive = 0;

        $this->Paginator->settings = array('order' => array('complain_date' => ' desc'));
        $this->set('complains_history', $this->Paginator->paginate(array('service_seeker_id' => $id)));
    }

    public function provider_complain_history($id = null)
    {
        $this->Complain->recursive = 0;

        $this->Paginator->settings = array('order' => array('complain_date' => ' desc'));
        $this->set('complains_history', $this->Paginator->paginate(array('service_provider_id' => $id)));
    }

    public function admin_provider_complain_history($id = null)
    {
        $this->Complain->recursive = 0;

        $this->Paginator->settings = array('order' => array('complain_date' => ' desc'));
        $this->set('complains_history', $this->Paginator->paginate(array('service_provider_id' => $id)));
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
        if (!$this->Complain->exists($id)) {
            throw new NotFoundException(__('Invalid complain'));
        }
        $options = array('conditions' => array('Complain.' . $this->Complain->primaryKey => $id));
        $this->set('complain', $this->Complain->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($id = null, $request_id = null)
    {

        $this->request->data['Complain']['complain_date'] = date('Y-m-d');
        $this->request->data['Complain']['service_seeker_id'] = $this->Auth->user('id');
        $this->request->data['Complain']['service_provider_id'] = $id;
        $this->request->data['Complain']['request_id'] = $request_id;
        if ($this->request->is('post')) {
            $this->Complain->create();
            if ($this->Complain->save($this->request->data)) {
                $this->Session->setFlash('The complain has been saved.', 'default', array('class' => 'success'));
                //return $this->redirect(array('controller' => 'users', 'action' => 'seeker_profile'));
            } else {
                $this->Session->setFlash('The complain could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
        $page_title = "ServiceRequests > Complaints";
        $hideSearchBar = true;
        $this->set(compact('hideSearchBar', 'page_title'));
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
        if (!$this->Complain->exists($id)) {
            throw new NotFoundException(__('Invalid complain'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Complain->save($this->request->data)) {
                $this->Session->setFlash('The complain has been updated.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain could not be updated. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Complain.' . $this->Complain->primaryKey => $id));
            $this->request->data = $this->Complain->find('first', $options);
        }
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
        $this->Complain->id = $id;
        if (!$this->Complain->exists()) {
            throw new NotFoundException(__('Invalid complain'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Complain->delete()) {
            $this->Session->setFlash('The complain has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The complain could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
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

        $this->Paginator->settings = array('order' => array('complain_date' => ' desc'));
        if (!empty($this->params->query)) {

            $from = $this->params->query['from'];
            $to = $this->params->query['to'];
            $name = $this->params->query['name'];
            $type = $this->params->query['type'];
            $conditions[] = array();

            if (!empty($from)) {
                if (!empty($to)) {
                    $conditions[] = array("Complain.complain_date BETWEEN '$from' AND '$to'");
                    //array('User.created_date>=' => $from,'User.created_date<=' => $to);
                } else {
                    $now = date('Y-m-d');
                    $conditions[] = array("Complain.complain_date BETWEEN '$from' AND '$now'");
                }
            }
            if (!empty($name)) {
                /*$user_id=$this->Complain->query("Select id from users where name='{$name}'");
                if($user_id){
                    $conditions[] = array('Complain.service_seeker_id'=>$user_id[0]['users']['id']);
                }else{
                    $conditions[] = array('Complain.service_seeker_id'=>'0');
                }*/

                $user_id = $this->Complain->query("Select group_concat(id) id from users where name LIKE '%" . $name . "%'");
                //$user=$user_id[0][0]['id'];
                $user_id = str_replace(",", "','", $user_id[0][0]['id']);
                $conditions[] = array("Complain.service_provider_id in ('" . $user_id . "')");
            }

            if (!empty($provider_name)) {
                $user_id = $this->User->query("Select id from users where name='{$provider_name}'");
                if ($user_id) {
                    $conditions[] = array('User.id' => $user_id[0]['users']['id']);
                } else {
                    $conditions[] = array('User.id' => '0');
                }
            }
            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;
                $complains = $this->Complain->find('all', array('conditions' => array($conditions)));
                $this->set(compact('complains'));
                $this->render('/Elements/complains_record');
                //debug($conditions);die;

            }
            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => array('complain_date' => ' desc')
            );
            //$this->Complain->recursive = 0;
            //debug($this->Paginator->paginate($conditions));die;
            //$this->set('complains',$this->Paginator->paginate($conditions));

        } else {
            $from = "";
            $to = "";
            $name = "";
            //$this->Complain->recursive = 0;
            //$this->set('complains',$this->Paginator->paginate());
        }
        $this->Complain->recursive = 0;
        $complains = $this->Paginator->paginate();
        $this->set(compact('complains', 'from', 'to', 'name'));
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
        if (!$this->Complain->exists($id)) {
            throw new NotFoundException(__('Invalid complain'));
        }
        $options = array('conditions' => array('Complain.' . $this->Complain->primaryKey => $id));
        $this->set('complain', $this->Complain->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Complain->create();
            if ($this->Complain->save($this->request->data)) {
                $this->Session->setFlash('The complain has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
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
        if (!$this->Complain->exists($id)) {
            throw new NotFoundException(__('Invalid complain'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Complain->save($this->request->data)) {
                $this->Session->setFlash('The complain has been updated.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain could not be updated. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Complain.' . $this->Complain->primaryKey => $id));
            $this->request->data = $this->Complain->find('first', $options);
        }
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
        $this->Complain->id = $id;
        if (!$this->Complain->exists()) {
            throw new NotFoundException(__('Invalid complain'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Complain->delete()) {
            $this->Session->setFlash('The complain has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The complain could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
