<?php
App::uses('AppController', 'Controller');

/**
 * Countries Controller
 *
 * @property Country $Country
 * @property PaginatorComponent $Paginator
 */
class CountriesController extends AppController
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
        $this->Country->recursive = 0;
        $this->Paginator->settings = array('order' => array('Country.name' => ' Asc'));
        $this->set('countries', $this->Paginator->paginate());
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
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
        $this->set('country', $this->Country->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Country->create();
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash('The country has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The country could not be saved. Please, try again.', 'default',
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
        if (!$this->Country->exists($id)) {
            throw new NotFoundException(__('Invalid country'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Country->save($this->request->data)) {
                $this->Session->setFlash('The country has been updated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The country could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('Country.' . $this->Country->primaryKey => $id));
            $this->request->data = $this->Country->find('first', $options);
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
        $this->Country->id = $id;
        if (!$this->Country->exists()) {
            throw new NotFoundException(__('Invalid country'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Country->delete()) {
            $this->Session->setFlash('The country has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The country could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
