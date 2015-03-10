<?php
App::uses('AppController', 'Controller');

/**
 * PaypalSettings Controller
 *
 * @property PaypalSetting $PaypalSetting
 * @property PaginatorComponent $Paginator
 */
class PaypalSettingsController extends AppController
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
    /*public function admin_index() {
        $this->PaypalSetting->recursive = 0;
        $this->set('paypalSettings', $this->Paginator->paginate());
    }*/

    /**
     * admin_view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*public function admin_view($id = null) {
        if (!$this->PaypalSetting->exists($id)) {
            throw new NotFoundException(__('Invalid paypal setting'));
        }
        $options = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
        $this->set('paypalSetting', $this->PaypalSetting->find('first', $options));
    }*/

    /**
     * admin_add method
     *
     * @return void
     */
    /*public function admin_add() {
        if ($this->request->is('post')) {
            $this->PaypalSetting->create();
            if ($this->PaypalSetting->save($this->request->data)) {
                $this->Session->setFlash(__('The paypal setting has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The paypal setting could not be saved. Please, try again.'));
            }
        }
    }*/

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!$this->PaypalSetting->exists($id)) {
            throw new NotFoundException(__('Invalid paypal setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PaypalSetting->save($this->request->data)) {
                $this->Session->setFlash('The paypal setting has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash('The paypal setting could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
            $this->request->data = $this->PaypalSetting->find('first', $options);
        }
        $paypalOptions = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
        $paypal = $this->PaypalSetting->find('first', $paypalOptions);
        $this->set(compact('paypal'));
    }


    public function admin_sms($id = null)
    {
        if (!$this->PaypalSetting->exists($id)) {
            throw new NotFoundException(__('Invalid paypal setting'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->PaypalSetting->save($this->request->data)) {
                $this->Session->setFlash('The SMS setting has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'edit', $id));
            } else {
                $this->Session->setFlash('The SMS setting could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
            $this->request->data = $this->PaypalSetting->find('first', $options);
        }
        $paypalOptions = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
        $SMS = $this->PaypalSetting->find('first', $paypalOptions);
        $this->set(compact('SMS'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_esewa($id = null)
    {
        if (!$this->PaypalSetting->exists($id)) {
            throw new NotFoundException(__('Invalid esewa setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PaypalSetting->save($this->request->data)) {
                $this->Session->setFlash('The esewa setting has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'esewa', $id));
            } else {
                $this->Session->setFlash('The esewa setting could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
            $this->request->data = $this->PaypalSetting->find('first', $options);
        }
        $paypalOptions = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
        $paypal = $this->PaypalSetting->find('first', $paypalOptions);
        $this->set(compact('paypal'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_moco($id = null)
    {
        if (!$this->PaypalSetting->exists($id)) {
            throw new NotFoundException(__('Invalid esewa setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PaypalSetting->save($this->request->data)) {
                $this->Session->setFlash('The moco setting has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'moco', $id));
            } else {
                $this->Session->setFlash('The moco setting could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
            $this->request->data = $this->PaypalSetting->find('first', $options);
        }
        $paypalOptions = array('conditions' => array('PaypalSetting.' . $this->PaypalSetting->primaryKey => $id));
        $paypal = $this->PaypalSetting->find('first', $paypalOptions);
        $this->set(compact('paypal'));
    }

    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*public function admin_delete($id = null) {
        $this->PaypalSetting->id = $id;
        if (!$this->PaypalSetting->exists()) {
            throw new NotFoundException(__('Invalid paypal setting'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PaypalSetting->delete()) {
            $this->Session->setFlash(__('The paypal setting has been deleted.'));
        } else {
            $this->Session->setFlash(__('The paypal setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }*/
}
