<?php
App::uses('AppController', 'Controller');
/**
 * UsdRates Controller
 *
 * @property UsdRate $UsdRate
 * @property PaginatorComponent $Paginator
 */
class UsdRatesController extends AppController {

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
	public function admin_index() {
		$this->UsdRate->recursive = 0;
		$this->set('usdRates', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->UsdRate->exists($id)) {
			throw new NotFoundException(__('Invalid usd rate'));
		}
		$options = array('conditions' => array('UsdRate.' . $this->UsdRate->primaryKey => $id));
		$this->set('usdRate', $this->UsdRate->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->UsdRate->create();
			if ($this->UsdRate->save($this->request->data)) {
				$this->Session->setFlash('The usd rate has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The usd rate could not be saved. Please, try again.','default',array('class'=>'error-message'));
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
	public function admin_edit($id = null) {
		if (!$this->UsdRate->exists($id)) {
			throw new NotFoundException(__('Invalid usd rate'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->UsdRate->save($this->request->data)) {
				$this->Session->setFlash('The usd rate has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The usd rate could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('UsdRate.' . $this->UsdRate->primaryKey => $id));
			$this->request->data = $this->UsdRate->find('first', $options);
		}
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->UsdRate->id = $id;
		if (!$this->UsdRate->exists()) {
			throw new NotFoundException(__('Invalid usd rate'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->UsdRate->delete()) {
			$this->Session->setFlash('The usd rate has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The usd rate could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
