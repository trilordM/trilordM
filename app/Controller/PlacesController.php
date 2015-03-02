<?php
App::uses('AppController', 'Controller');
/**
 * Places Controller
 *
 * @property Place $Place
 * @property PaginatorComponent $Paginator
 */
class PlacesController extends AppController {

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
		$this->Place->recursive = 0;
		
		$this->Paginator->settings = array('order'=>array('Place.name' =>' Asc'));
		$this->set('places', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Place->exists($id)) {
			throw new NotFoundException(__('Invalid place'));
		}
		$options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
		$this->set('place', $this->Place->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Place->create();
			//debug($this->request->data);die;
			$this->Place->set($this->request->data);
			if ($this->Place->validates($this->request->data)){
				
				for($i=1;$i<=10;$i++){
					
					$this->request->data['Place']['district_id']=$this->request->data['Place']['district_id'];
					$this->request->data['Place']['name']=$this->request->data['Place']['place_'.$i];
					
					
					$district=addslashes($this->request->data['Place']['district_id']);
					$name=addslashes($this->request->data['Place']['name']);
					//debug($name);die;
					if(!empty($name)){
					$this->Place->query("Insert into places (district_id,name) values('$district','$name')");
					//$this->Place->saveMany($this->request->data);
					}
					//debug($this->request->data);
				}
				$this->Session->setFlash('The place has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			}else{
				$this->Session->setFlash('The place could not be saved.','default',array('class'=>'error-message'));
			}	
			//return $this->redirect(array('action' => 'index'));			
			
		}
		$districts = $this->Place->District->find('list');
		$this->set(compact('districts'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Place->exists($id)) {
			throw new NotFoundException(__('Invalid place'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Place->save($this->request->data)) {
				$this->Session->setFlash('The place has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The place could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('Place.' . $this->Place->primaryKey => $id));
			$this->request->data = $this->Place->find('first', $options);
		}
		$districts = $this->Place->District->find('list');
		$this->set(compact('districts'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Place->id = $id;
		if (!$this->Place->exists()) {
			throw new NotFoundException(__('Invalid place'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Place->delete()) {
			$this->Session->setFlash('The place has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The place could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function admin_place_add() {
			$this->autoRender=false;
			$this->layout= false;
		if($this->request->is('ajax')){
			//debug($this->request->data);die;
			$this->request->data['Place']['district_id']=$this->request->data['id'];
			$this->request->data['Place']['name']=$this->request->data['name'];
			$this->Place->create();
			if ($this->Place->save($this->request->data)) {
				$this->Session->setFlash('Place has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				echo '1';
			}
			
		}
	}
}
