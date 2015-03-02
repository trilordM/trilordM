<?php
App::uses('AppController', 'Controller');

/**
 * ComplainArchives Controller
 *
 * @property ComplainArchive $ComplainArchive
 * @property PaginatorComponent $Paginator
 */
class ComplainArchivesController extends AppController
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
        $this->ComplainArchive->recursive = 0;
        $this->set('complainArchives', $this->Paginator->paginate());
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
        if (!$this->ComplainArchive->exists($id)) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        $options = array('conditions' => array('ComplainArchive.' . $this->ComplainArchive->primaryKey => $id));
        $this->set('complainArchive', $this->ComplainArchive->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ComplainArchive->create();
            if ($this->ComplainArchive->save($this->request->data)) {
                $this->Session->setFlash('The complain archive has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain archive could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
        $complains = $this->ComplainArchive->Complain->find('list');
        $serviceProviders = $this->ComplainArchive->ServiceProvider->find('list');
        $serviceSeekers = $this->ComplainArchive->ServiceSeeker->find('list');
        $this->set(compact('complains', 'serviceProviders', 'serviceSeekers'));
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
        if (!$this->ComplainArchive->exists($id)) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ComplainArchive->save($this->request->data)) {
                $this->Session->setFlash('The complain archive has been updated.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain archive could not be updated. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ComplainArchive.' . $this->ComplainArchive->primaryKey => $id));
            $this->request->data = $this->ComplainArchive->find('first', $options);
        }
        $complains = $this->ComplainArchive->Complain->find('list');
        $serviceProviders = $this->ComplainArchive->ServiceProvider->find('list');
        $serviceSeekers = $this->ComplainArchive->ServiceSeeker->find('list');
        $this->set(compact('complains', 'serviceProviders', 'serviceSeekers'));
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
        $this->ComplainArchive->id = $id;
        if (!$this->ComplainArchive->exists()) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ComplainArchive->delete()) {
            $this->Session->setFlash('The complain archive has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The complain archive could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
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
        $this->ComplainArchive->recursive = 0;
        $this->set('complainArchives', $this->Paginator->paginate());
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
        if (!$this->ComplainArchive->exists($id)) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        $options = array('conditions' => array('ComplainArchive.' . $this->ComplainArchive->primaryKey => $id));
        $this->set('complainArchive', $this->ComplainArchive->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ComplainArchive->create();
            if ($this->ComplainArchive->save($this->request->data)) {
                $this->Session->setFlash('The complain archive has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain archive could not be saved. Please, try again.', 'default', array('class' => 'error-message'));
            }
        }
        $complains = $this->ComplainArchive->Complain->find('list');
        $serviceProviders = $this->ComplainArchive->ServiceProvider->find('list');
        $serviceSeekers = $this->ComplainArchive->ServiceSeeker->find('list');
        $this->set(compact('complains', 'serviceProviders', 'serviceSeekers'));
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
        if (!$this->ComplainArchive->exists($id)) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ComplainArchive->save($this->request->data)) {
                $this->Session->setFlash('The complain archive has been updated.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain archive could not be updated. Please, try again.', 'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ComplainArchive.' . $this->ComplainArchive->primaryKey => $id));
            $this->request->data = $this->ComplainArchive->find('first', $options);
        }
        $complains = $this->ComplainArchive->Complain->find('list');
        $serviceProviders = $this->ComplainArchive->ServiceProvider->find('list');
        $serviceSeekers = $this->ComplainArchive->ServiceSeeker->find('list');
        $this->set(compact('complains', 'serviceProviders', 'serviceSeekers'));
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
        $this->ComplainArchive->id = $id;
        if (!$this->ComplainArchive->exists()) {
            throw new NotFoundException(__('Invalid complain archive'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ComplainArchive->delete()) {
            $this->Session->setFlash('The complain archive has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The complain archive could not be deleted. Please, try again.', 'default', array('class' => 'error-message'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
