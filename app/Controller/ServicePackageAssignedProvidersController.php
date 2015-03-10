<?php
App::uses('AppController', 'Controller');

/**
 * ServicePackageAssignedProviders Controller
 *
 * @property ServicePackageAssignedProvider $ServicePackageAssignedProvider
 * @property PaginatorComponent $Paginator
 */
class ServicePackageAssignedProvidersController extends AppController
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
        $this->ServicePackageAssignedProvider->recursive = 0;
        $this->set('servicePackageAssignedProviders', $this->Paginator->paginate());
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
        if (!$this->ServicePackageAssignedProvider->exists($id)) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        $options = array('conditions' => array('ServicePackageAssignedProvider.' . $this->ServicePackageAssignedProvider->primaryKey => $id));
        $this->set('servicePackageAssignedProvider', $this->ServicePackageAssignedProvider->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ServicePackageAssignedProvider->create();
            if ($this->ServicePackageAssignedProvider->save($this->request->data)) {
                $this->Session->setFlash('The service package assigned provider has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package assigned provider could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }
        $servicePackageRequests = $this->ServicePackageAssignedProvider->ServicePackageRequest->find('list');
        $this->set(compact('servicePackageRequests'));
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
        if (!$this->ServicePackageAssignedProvider->exists($id)) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicePackageAssignedProvider->save($this->request->data)) {
                $this->Session->setFlash('The service package assigned provider has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package assigned provider could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServicePackageAssignedProvider.' . $this->ServicePackageAssignedProvider->primaryKey => $id));
            $this->request->data = $this->ServicePackageAssignedProvider->find('first', $options);
        }
        $servicePackageRequests = $this->ServicePackageAssignedProvider->ServicePackageRequest->find('list');
        $this->set(compact('servicePackageRequests'));
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
        $this->ServicePackageAssignedProvider->id = $id;
        if (!$this->ServicePackageAssignedProvider->exists()) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackageAssignedProvider->delete()) {
            $this->Session->setFlash('The service package assigned provider has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service package assigned provider could not be deleted. Please, try again.',
                'default', array('class' => 'error-message'));
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
        $this->ServicePackageAssignedProvider->recursive = 0;
        $this->set('servicePackageAssignedProviders', $this->Paginator->paginate());
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
        if (!$this->ServicePackageAssignedProvider->exists($id)) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        $options = array('conditions' => array('ServicePackageAssignedProvider.' . $this->ServicePackageAssignedProvider->primaryKey => $id));
        $this->set('servicePackageAssignedProvider', $this->ServicePackageAssignedProvider->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ServicePackageAssignedProvider->create();
            if ($this->ServicePackageAssignedProvider->save($this->request->data)) {
                $this->Session->setFlash('The service package assigned provider has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package assigned provider could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }
        $servicePackageRequests = $this->ServicePackageAssignedProvider->ServicePackageRequest->find('list');
        $this->set(compact('servicePackageRequests'));
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
        if (!$this->ServicePackageAssignedProvider->exists($id)) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServicePackageAssignedProvider->save($this->request->data)) {
                $this->Session->setFlash('The service package assigned provider has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service package assigned provider could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServicePackageAssignedProvider.' . $this->ServicePackageAssignedProvider->primaryKey => $id));
            $this->request->data = $this->ServicePackageAssignedProvider->find('first', $options);
        }
        $servicePackageRequests = $this->ServicePackageAssignedProvider->ServicePackageRequest->find('list');
        $this->set(compact('servicePackageRequests'));
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
        $this->ServicePackageAssignedProvider->id = $id;
        if (!$this->ServicePackageAssignedProvider->exists()) {
            throw new NotFoundException(__('Invalid service package assigned provider'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServicePackageAssignedProvider->delete()) {
            $this->Session->setFlash('The service package assigned provider has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service package assigned provider could not be deleted. Please, try again.',
                'default', array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
