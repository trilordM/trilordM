<?php
App::uses('AppController', 'Controller');

/**
 * ServicePackages Controller
 *
 * @property ServicePackage $ServicePackage
 * @property PaginatorComponent $Paginator
 */
class ServicePackagesController extends AppController
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
        $this->ServicePackage->recursive = 0;
        $this->set('servicePackages', $this->Paginator->paginate());
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
        if (!$this->ServicePackage->exists($id)) {
            throw new NotFoundException(__('Invalid service package'));
        }
        $options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
        $this->set('servicePackage', $this->ServicePackage->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ServicePackage->create();
            if ($this->ServicePackage->save($this->request->data)) {
                $this->Session->setFlash('The service package has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package could not be saved. Please, try again.', 'default',
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
        if (!$this->ServicePackage->exists($id)) {
            throw new NotFoundException(__('Invalid service package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicePackage->save($this->request->data)) {
                $this->Session->setFlash('The service package has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
            $this->request->data = $this->ServicePackage->find('first', $options);
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
        $this->ServicePackage->id = $id;
        if (!$this->ServicePackage->exists()) {
            throw new NotFoundException(__('Invalid service package'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackage->delete()) {
            $this->Session->setFlash('The service package has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service package could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
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
        $this->ServicePackage->recursive = 0;
        $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        $this->set('servicePackages', $this->Paginator->paginate());
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
        if (!$this->ServicePackage->exists($id)) {
            throw new NotFoundException(__('Invalid service package'));
        }
        $options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
        $this->set('servicePackage', $this->ServicePackage->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->request->data['ServicePackage']['slug'] = date('Y_m_d') . '_' . $this->Useful->stringToSlug($this->request->data['ServicePackage']['title']);
            $this->ServicePackage->create();
            if ($this->ServicePackage->save($this->request->data)) {
                $this->Session->setFlash('The service package has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package could not be saved. Please, try again.', 'default',
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
        if (!$this->ServicePackage->exists($id)) {
            throw new NotFoundException(__('Invalid service package'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['ServicePackage']['slug'] = date('Y_m_d') . '_' . $this->Useful->stringToSlug($this->request->data['ServicePackage']['title']);
            if ($this->ServicePackage->save($this->request->data)) {
                $this->Session->setFlash('The service package has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServicePackage.' . $this->ServicePackage->primaryKey => $id));
            $this->request->data = $this->ServicePackage->find('first', $options);
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
        $this->ServicePackage->id = $id;
        if (!$this->ServicePackage->exists()) {
            throw new NotFoundException(__('Invalid service package'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackage->delete()) {
            $this->Session->setFlash('The service package has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service package could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
