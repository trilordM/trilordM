<?php
App::uses('AppController', 'Controller');

/**
 * ServiceProviderDocuments Controller
 *
 * @property ServiceProviderDocument $ServiceProviderDocument
 * @property PaginatorComponent $Paginator
 */
class ServiceProviderDocumentsController extends AppController
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
        $this->ServiceProviderDocument->recursive = 0;
        $this->set('serviceProviderDocuments', $this->Paginator->paginate());
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
        if (!$this->ServiceProviderDocument->exists($id)) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        $options = array('conditions' => array('ServiceProviderDocument.' . $this->ServiceProviderDocument->primaryKey => $id));
        $this->set('serviceProviderDocument', $this->ServiceProviderDocument->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->ServiceProviderDocument->create();
            if ($this->ServiceProviderDocument->save($this->request->data)) {
                $this->Session->setFlash('The service provider document has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service provider document could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }
        $users = $this->ServiceProviderDocument->User->find('list');
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
        if (!$this->ServiceProviderDocument->exists($id)) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServiceProviderDocument->save($this->request->data)) {
                $this->Session->setFlash('The service provider document has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service provider document could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceProviderDocument.' . $this->ServiceProviderDocument->primaryKey => $id));
            $this->request->data = $this->ServiceProviderDocument->find('first', $options);
        }
        $users = $this->ServiceProviderDocument->User->find('list');
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
        $this->ServiceProviderDocument->id = $id;
        if (!$this->ServiceProviderDocument->exists()) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceProviderDocument->delete()) {
            $this->Session->setFlash('The service provider document has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service provider document could not be deleted. Please, try again.',
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
        $this->ServiceProviderDocument->recursive = 0;
        $this->set('serviceProviderDocuments', $this->Paginator->paginate());
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
        if (!$this->ServiceProviderDocument->exists($id)) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        $options = array('conditions' => array('ServiceProviderDocument.' . $this->ServiceProviderDocument->primaryKey => $id));
        $this->set('serviceProviderDocument', $this->ServiceProviderDocument->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $name = $this->request->data['ServiceProviderDocument']['document_file']['name'];
            $tmp_name = $this->request->data['ServiceProviderDocument']['document_file']['tmp_name'];
            $filename = WWW_ROOT . 'providers_document/' . $name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'providers_document/' . $name)) {
                $name = $random_number . $this->request->data['ServiceProviderDocument']['document_file']['name'];
            }
            $this->request->data['ServiceProviderDocument']['document_file'] = $name;
            if ($this->ServiceProviderDocument->save($this->request->data)) {
                if (move_uploaded_file($tmp_name, WWW_ROOT . 'providers_document' . '\\' . $name)) {
                    $this->Session->setFlash('File uploaded.', 'default', array('class' => 'success'));

                } else {
                    $this->Session->setFlash('Unable to upload file.', 'default', array('class' => 'error-message'));
                }
                $this->redirect(array('action' => 'index'));
            } else {
                /* save message to session */
                $this->Session->setFlash('There was a problem uploading file. Please try again.');
            }
        }

        $users = $this->ServiceProviderDocument->User->find('list');
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
        if (!$this->ServiceProviderDocument->exists($id)) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $tmp_name = $this->request->data['ServiceProviderDocument']['document_file']['tmp_name'];
            //debug($tmp_name);die;
            $this->request->data['ServiceProviderDocument']['document_file'] = $this->request->data['ServiceProviderDocument']['document_file']['name'];
            $filename = WWW_ROOT . 'providers_document/' . $this->request->data['ServiceProviderDocument']['document_file'];
            if ($this->ServiceProviderDocument->save($this->request->data)) {
                if (move_uploaded_file($tmp_name,
                    WWW_ROOT . 'providers_document' . '\\' . $this->request->data['ServiceProviderDocument']['document_file'])) {
                    $this->Session->setFlash('The service provider document has been updated.', 'default',
                        array('class' => 'success'));
                }

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The service provider document could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ServiceProviderDocument.' . $this->ServiceProviderDocument->primaryKey => $id));
            $this->request->data = $this->ServiceProviderDocument->find('first', $options);
        }
        $users = $this->ServiceProviderDocument->User->find('list');
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
        $this->ServiceProviderDocument->id = $id;
        if (!$this->ServiceProviderDocument->exists()) {
            throw new NotFoundException(__('Invalid service provider document'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ServiceProviderDocument->delete()) {
            $this->Session->setFlash('The service provider document has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The service provider document could not be deleted. Please, try again.',
                'default', array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
