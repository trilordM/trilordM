<?php
App::uses('AppController', 'Controller');
/**
 * ServiceCategories Controller
 *
 * @property ServiceCategory $ServiceCategory
 * @property PaginatorComponent $Paginator
 */
class ServiceCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	 public function beforeFilter() {
		
		/*$this->Auth->fields = array(
        'username' => 'email',
        'password' => 'password'
    );*/
	
        $this->Auth->allow('services');
		parent::beforeFilter();
	 }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ServiceCategory->recursive = 0;
		$this->set('serviceCategories', $this->Paginator->paginate());
	}
	
	public function services() {
		
		$this->ServiceCategory->recursive = 0;
		//debug($this->Paginator->paginate(array('ServiceCategory.parent_id=0')));die;
		$this->set('serviceCategories', $this->Paginator->paginate(array('ServiceCategory.parent_id=0')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ServiceCategory->exists($id)) {
			throw new NotFoundException(__('Invalid service category'));
		}
		$options = array('conditions' => array('ServiceCategory.' . $this->ServiceCategory->primaryKey => $id));
		$this->set('serviceCategory', $this->ServiceCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ServiceCategory->create();
			if ($this->ServiceCategory->save($this->request->data)) {
				$this->Session->setFlash('The service category has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The service category could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$parentServiceCategories = $this->ServiceCategory->ParentServiceCategory->find('list');
		$this->set(compact('parentServiceCategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ServiceCategory->exists($id)) {
			throw new NotFoundException(__('Invalid service category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceCategory->save($this->request->data)) {
				$this->Session->setFlash('The service category has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The service category could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('ServiceCategory.' . $this->ServiceCategory->primaryKey => $id));
			$this->request->data = $this->ServiceCategory->find('first', $options);
		}
		$parentServiceCategories = $this->ServiceCategory->ParentServiceCategory->find('list');
		$this->set(compact('parentServiceCategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ServiceCategory->id = $id;
		if (!$this->ServiceCategory->exists()) {
			throw new NotFoundException(__('Invalid service category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ServiceCategory->delete()) {
			$this->Session->setFlash('The service category has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The service category could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->ServiceCategory->recursive = 0;
		$this->Paginator->settings = array('order'=>array('ServiceCategory.title' =>' Asc'));
		$this->set('serviceCategories', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->ServiceCategory->exists($id)) {
			throw new NotFoundException(__('Invalid service category'));
		}
		$options = array('conditions' => array('ServiceCategory.' . $this->ServiceCategory->primaryKey => $id));
		$this->set('serviceCategory', $this->ServiceCategory->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			//debug($this->request->data);die;
			$this->ServiceCategory->create();
			if ($this->ServiceCategory->save($this->request->data)) {
				$this->Session->setFlash('The service category has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The service category could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$parents[0] = "[ No Parent]";
		$categoryList = $this->ServiceCategory->generateTreeList(null,null,null," -> ");
		//debug($categoryList);die;
		if($categoryList){
			
			foreach($categoryList as $key=>$value):
				$parents[$key] = $value;
			endforeach;	
			$this->set(compact('parents'));
		}
		//$parentServiceCategories = $this->ServiceCategory->ParentServiceCategory->find('list');
		//$this->set(compact('parentServiceCategories'));
	}
	
	
	
	public function admin_category_add() {
			$this->autoRender=false;
			$this->layout= false;
		if($this->request->is('ajax')){
			$this->request->data['ServiceCategory']['parent_id']=$this->request->data['id'];
			$this->request->data['ServiceCategory']['title']=$this->request->data['cat_title'];
			
			$this->request->data['ServiceCategory']['range_1']=$this->request->data['range_1'];
			$this->request->data['ServiceCategory']['range_2']=$this->request->data['range_2'];
			$this->request->data['ServiceCategory']['is_active']='1';
			$this->ServiceCategory->create();
			if ($this->ServiceCategory->save($this->request->data)) {
				$this->Session->setFlash('The service category has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				echo '1';
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
		if (!$this->ServiceCategory->exists($id)) {
			throw new NotFoundException(__('Invalid service category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ServiceCategory->save($this->request->data)) {
				$this->Session->setFlash('The service category has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
			
				$this->Session->setFlash('The service category could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			/*$options = array('conditions' => array('ServiceCategory.' . $this->ServiceCategory->primaryKey => $id));
			$this->request->data = $this->ServiceCategory->find('first', $options);*/
			$this->data =  $this->ServiceCategory->read(null, $id);
			$parents[0] = "[ No Parent]";
			$categoryList = $this->ServiceCategory->generateTreeList(null,null,null," -> ");
			if($categoryList){
				foreach($categoryList as $key=>$value):
					$parents[$key] = $value;
				endforeach;	
				$this->set(compact('parents'));
			}
		}
		/*$parentServiceCategories = $this->ServiceCategory->ParentServiceCategory->find('list');
		$this->set(compact('parentServiceCategories'));*/
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->ServiceCategory->id = $id;
		if (!$this->ServiceCategory->exists()) {
			throw new NotFoundException(__('Invalid service category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ServiceCategory->delete()) {
			$this->Session->setFlash('The service category has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The service category could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
