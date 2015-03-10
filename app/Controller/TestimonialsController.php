<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

/**
 * Testimonials Controller
 *
 * @property Testimonial $Testimonial
 * @property PaginatorComponent $Paginator
 */
class TestimonialsController extends AppController
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
        $this->Testimonial->recursive = 0;
        $this->set('testimonials', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view()
    {
        $user_id = $this->Auth->User('id');
        $id = $this->Testimonial->query("select id from testimonials where user_id ='$user_id'");
        $id = $id[0]['testimonials']['id'];
        if (!$this->Testimonial->exists($id)) {
            throw new NotFoundException(__('Invalid testimonial'));
        }
        $options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
        $this->set('testimonial', $this->Testimonial->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        //debug($this->Auth->user('id'));exit;
        if ($this->request->is('post')) {
            $this->request->data['Testimonial']['user_id'] = $this->Auth->User('id');

            $this->loadModel('User');
            $user_email = $this->User->field('email', array('id' => $this->Auth->User('id')));
            $user_name = $this->User->field('name', array('id' => $this->Auth->User('id')));
            $user_name = explode(" ", $user_name);
            $user_name = $user_name[0];

            $this->request->data['Testimonial']['created_date'] = date('Y-m-d');
            $this->request->data['Testimonial']['is_active'] = '0';
            $this->Testimonial->create();
            if ($this->Testimonial->save($this->request->data)) {

                $this->Session->setFlash('The testimonial has been saved.', 'default', array('class' => 'success'));

                $this->send_mailto_seeker($user_email, $user_name);

                return $this->redirect(array('controller' => 'users', 'action' => 'seeker_profile'));
                //return $this->Html->link(__('Profile'), array('action' => 'provider', $user['User']['id']));
            } else {
                $this->Session->setFlash('The testimonial could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
        $users = $this->Testimonial->User->find('list');
        $hideSearchBar = true;

        $active_testimonials_add = "active";
        $page_title = "Testimonials > Add New";
        $this->set(compact('users', 'hideSearchBar', 'active_testimonials_add', 'page_title'));
    }

    private function send_mailto_seeker($email = null, $user_name = null)
    {
        $policy = SITE_URL . 'contents/Privacy_policy';
        $user_agreement = '';
        $trilord_email = 'email@trilordmarket.com';
        $this->autoRender = false;
        $to = $email;
        $from = MAIL_FROM;
        //$result = $this->_send_email($from,$get_email,$token_url);
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'user_name' => $user_name,
            'trilord_email' => $trilord_email,
            'policy' => $policy,
            'user_agreement' => $user_agreement
        ));
        $Email->from(array($from => 'TrilordMarket'))
            ->to($to)
            ->subject('Thank You')
            ->emailFormat('html')
            ->template('testimonial', 'testimonial')
            ->send();
    }


    public function admin_verify($id = null, $status = null)
    {
        $this->Testimonial->id = $id;
        if (!$this->Testimonial->exists()) {
            throw new NotFoundException(__('Invalid testimonial'));
        }
        $this->request->onlyAllow('post', 'delete');

        if ($status == 'enable') {
            $this->request->data['Testimonial']['is_active'] = '1';

            if ($this->Testimonial->save($this->request->data)) {
                $this->Session->setFlash('Testimonial has been enabled.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to enable testimonial.', 'default', array('class' => 'error-message'));
            }
        } else {
            $this->request->data['Testimonial']['is_active'] = '0';

            if ($this->Testimonial->save($this->request->data)) {
                $this->Session->setFlash('Testimonial has been disabled.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to disable testimonial.', 'default',
                    array('class' => 'error-message'));
            }
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
        $this->Testimonial->recursive = 0;
        $this->set('testimonials', $this->Paginator->paginate());
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
        if (!$this->Testimonial->exists($id)) {
            throw new NotFoundException(__('Invalid testimonial'));
        }
        $options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
        $this->set('testimonial', $this->Testimonial->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Testimonial->create();
            if ($this->Testimonial->save($this->request->data)) {
                $this->Session->setFlash('The testimonial has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The testimonial could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
        $users = $this->Testimonial->User->find('list');
        $this->set(compact('users'));
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
        if (!$this->Testimonial->exists($id)) {
            throw new NotFoundException(__('Invalid testimonial'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Testimonial->save($this->request->data)) {
                $this->Session->setFlash('The testimonial has been updated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The testimonial could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Testimonial.' . $this->Testimonial->primaryKey => $id));
            $this->request->data = $this->Testimonial->find('first', $options);
        }
        $users = $this->Testimonial->User->find('list');
        $this->set(compact('users'));
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
        $this->Testimonial->id = $id;
        if (!$this->Testimonial->exists()) {
            throw new NotFoundException(__('Invalid testimonial'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Testimonial->delete()) {
            $this->Session->setFlash('The testimonial has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The testimonial could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
