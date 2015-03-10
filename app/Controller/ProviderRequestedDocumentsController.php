<?php
App::uses('AppController', 'Controller');

/**
 * ProviderRequestedDocuments Controller
 *
 * @property ProviderRequestedDocument $ProviderRequestedDocument
 * @property PaginatorComponent $Paginator
 */
class ProviderRequestedDocumentsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->ProviderRequestedDocument->recursive = 0;
        $this->Paginator->settings = array('order' => array('uploaded_date' => ' desc'));
        $this->set('providerRequestedDocuments', $this->Paginator->paginate());
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
        if (!$this->ProviderRequestedDocument->exists($id)) {
            throw new NotFoundException(__('Invalid provider requested document'));
        }
        $options = array('conditions' => array('ProviderRequestedDocument.' . $this->ProviderRequestedDocument->primaryKey => $id));
        $this->set('providerRequestedDocument', $this->ProviderRequestedDocument->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->ProviderRequestedDocument->create();
            if ($this->ProviderRequestedDocument->save($this->request->data)) {
                $this->Session->setFlash('The provider requested document has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The provider requested document could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
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
        if (!$this->ProviderRequestedDocument->exists($id)) {
            throw new NotFoundException(__('Invalid provider requested document'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ProviderRequestedDocument->save($this->request->data)) {
                $this->Session->setFlash('The provider requested document has been updated.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The provider requested document could not be updated. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('ProviderRequestedDocument.' . $this->ProviderRequestedDocument->primaryKey => $id));
            $this->request->data = $this->ProviderRequestedDocument->find('first', $options);
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
        $this->ProviderRequestedDocument->id = $id;
        if (!$this->ProviderRequestedDocument->exists()) {
            throw new NotFoundException(__('Invalid provider requested document'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->ProviderRequestedDocument->delete()) {
            $this->Session->setFlash('The provider requested document has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The provider requested document could not be deleted. Please, try again.',
                'default', array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
