<?php
App::uses('AppController', 'Controller');
/**
 * RatePackages Controller
 *
 * @property RatePackage $RatePackage
 * @property PaginatorComponent $Paginator
 */
class RatePackagesController extends AppController {

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
	public function index() {
		$this->RatePackage->recursive = 0;
		$this->set('ratePackages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RatePackage->exists($id)) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		$options = array('conditions' => array('RatePackage.' . $this->RatePackage->primaryKey => $id));
		$this->set('ratePackage', $this->RatePackage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RatePackage->create();
			if ($this->RatePackage->save($this->request->data)) {
				$this->Session->setFlash('The rate package has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The rate package could not be saved. Please, try again.','default',array('class'=>'error-message'));
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
	public function edit($id = null) {
		if (!$this->RatePackage->exists($id)) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RatePackage->save($this->request->data)) {
				$this->Session->setFlash('The rate package has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The rate package could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('RatePackage.' . $this->RatePackage->primaryKey => $id));
			$this->request->data = $this->RatePackage->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RatePackage->id = $id;
		if (!$this->RatePackage->exists()) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RatePackage->delete()) {
			$this->Session->setFlash('The rate package has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The rate package could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->RatePackage->recursive = 0;
		$this->set('ratePackages', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->RatePackage->exists($id)) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		$options = array('conditions' => array('RatePackage.' . $this->RatePackage->primaryKey => $id));
		$this->set('ratePackage', $this->RatePackage->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->RatePackage->create();
			if ($this->RatePackage->save($this->request->data)) {
				$this->Session->setFlash('The rate package has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The rate package could not be saved. Please, try again.','default',array('class'=>'error-message'));
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
		if (!$this->RatePackage->exists($id)) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RatePackage->save($this->request->data)) {
				$this->Session->setFlash('The rate package has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The rate package could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('RatePackage.' . $this->RatePackage->primaryKey => $id));
			$this->request->data = $this->RatePackage->find('first', $options);
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
		$this->RatePackage->id = $id;
		if (!$this->RatePackage->exists()) {
			throw new NotFoundException(__('Invalid rate package'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->RatePackage->delete()) {
			$this->Session->setFlash('The rate package has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The rate package could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
