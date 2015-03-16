<?php
App::uses('AppController', 'Controller');

/**
 * Careers Controller
 *
 * @property Career $Career
 * @property PaginatorComponent $Paginator
 */
class CareersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');


    public function beforeFilter()
    {
        $this->Auth->allow('view_more');
        parent::beforeFilter();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->Career->recursive = 0;
        $this->set('careers', $this->Paginator->paginate());
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
        if (!$this->Career->exists($id)) {
            throw new NotFoundException(__('Invalid career'));
        }
        $options = array('conditions' => array('Career.' . $this->Career->primaryKey => $id));
        $this->set('career', $this->Career->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Career->create();
            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('The career has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The career could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
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
        if (!$this->Career->exists($id)) {
            throw new NotFoundException(__('Invalid career'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('The career has been updated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The career could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Career.' . $this->Career->primaryKey => $id));
            $this->request->data = $this->Career->find('first', $options);
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
        $this->Career->id = $id;
        if (!$this->Career->exists()) {
            throw new NotFoundException(__('Invalid career'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Career->delete()) {
            $this->Session->setFlash('The career has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The career could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }


    public function career()
    {
        $vacancy = $this->Career->find('all',
            array('conditions' => array('is_active' => '1', 'valid_till >=' => date('Y-m-d'))));
        //debug($vacancy);die;
        $hideSearchBar = true;
        $career = true;
        $this->set(compact('career', 'vacancy', 'hideSearchBar'));
    }


    public function view_more($id = null)
    {
        if (!$this->Career->exists($id)) {
            throw new NotFoundException(__('Invalid career'));
        }
        $options = array('conditions' => array('Career.' . $this->Career->primaryKey => $id));
        $this->set('careers_list', $this->Paginator->paginate());
        $this->set('career', $this->Career->find('first', $options));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->Career->recursive = 0;
        $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        $this->set('careers', $this->Paginator->paginate());
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
        if (!$this->Career->exists($id)) {
            throw new NotFoundException(__('Invalid career'));
        }
        $options = array('conditions' => array('Career.' . $this->Career->primaryKey => $id));
        $this->set('career', $this->Career->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {

            $this->request->data['Career']['created_date'] = date('Y-m-d');
            $this->Career->create();
            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('The career has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The career could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
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
        if (!$this->Career->exists($id)) {
            throw new NotFoundException(__('Invalid career'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Career']['created_date'] = date('Y-m-d');
            //debug($this->request->data);die;

            if ($this->Career->save($this->request->data)) {
                $this->Session->setFlash('The career has been udated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The career could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Career.' . $this->Career->primaryKey => $id));
            $this->request->data = $this->Career->find('first', $options);
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
        $this->Career->id = $id;
        if (!$this->Career->exists()) {
            throw new NotFoundException(__('Invalid career'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Career->delete()) {
            $this->Session->setFlash('The career has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The career could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
