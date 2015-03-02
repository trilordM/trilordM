<?php
App::uses('AppController', 'Controller');
/**
 * JobAppliers Controller
 *
 * @property JobApplier $JobApplier
 * @property PaginatorComponent $Paginator
 */
class JobAppliersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');


	 public function beforeFilter() {
		 $this->Auth->allow('add');
		parent::beforeFilter();
	 }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->JobApplier->recursive = 0;
		$this->set('jobAppliers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobApplier->exists($id)) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		$options = array('conditions' => array('JobApplier.' . $this->JobApplier->primaryKey => $id));
		$this->set('jobApplier', $this->JobApplier->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null) {
		if ($this->request->is('post')) {
			$this->request->data['JobApplier']['career_id']=$id;
			$this->request->data['JobApplier']['applied_date']=date('Y-m-d');
			
			
			if($this->request->data['JobApplier']['your_cv']['error']==0){
			
			//debug($this->request->data);die;	
			//$img_name=$this->request->data['JobApplier']['img_name'];
			$name =$this->request->data['JobApplier']['your_cv']['name'];
			$tmp_name=$this->request->data['JobApplier']['your_cv']['tmp_name'];
            $filename = WWW_ROOT.'job_applier_cv/'.$name;
		   $random_number = $this->Useful->random_code();
		   
			
		   if(file_exists(WWW_ROOT.'job_applier_cv/'.$name))
				{
					$name= $random_number.$this->request->data['JobApplier']['your_cv']['name'];	
				}
			
			$this->request->data['JobApplier']['your_cv'] = $name;
			//debug($tmp_name);die;
			}
			
			$this->JobApplier->create();
			if ($this->JobApplier->save($this->request->data)) {
				if (move_uploaded_file($tmp_name,WWW_ROOT.'job_applier_cv'.'\\'.$name)) {
										
					$this->Session->setFlash('The CV has been saved.','default',array('class'=>'success'));
			  	} else{
					
					$this->Session->setFlash('The CV could not be saved.','default',array('class'=>'error-message'));
				}
				
				$this->Session->setFlash('The job applier has been saved.','default',array('class'=>'success'));
			} else {
				$this->Session->setFlash('The job applier could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$careers = $this->JobApplier->Career->find('list');
		$this->set('careers_list', $this->JobApplier->query('SELECT id,title FROM careers'));
		$this->set(compact('careers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobApplier->exists($id)) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobApplier->save($this->request->data)) {
				$this->Session->setFlash('The job applier has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The job applier could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('JobApplier.' . $this->JobApplier->primaryKey => $id));
			$this->request->data = $this->JobApplier->find('first', $options);
		}
		$careers = $this->JobApplier->Career->find('list');
		$this->set(compact('careers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobApplier->id = $id;
		if (!$this->JobApplier->exists()) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobApplier->delete()) {
			$this->Session->setFlash('The job applier has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The job applier could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->JobApplier->recursive = 0;
		$this->Paginator->settings = array('order'=>array('applied_date' =>' desc'));
		$this->set('jobAppliers', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->JobApplier->exists($id)) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		$options = array('conditions' => array('JobApplier.' . $this->JobApplier->primaryKey => $id));
		$this->set('jobApplier', $this->JobApplier->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->JobApplier->create();
			if ($this->JobApplier->save($this->request->data)) {
				$this->Session->setFlash('The job applier has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The job applier could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$careers = $this->JobApplier->Career->find('list');
		$this->set(compact('careers'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->JobApplier->exists($id)) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobApplier->save($this->request->data)) {
				$this->Session->setFlash('The job applier has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The job applier could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('JobApplier.' . $this->JobApplier->primaryKey => $id));
			$this->request->data = $this->JobApplier->find('first', $options);
		}
		$careers = $this->JobApplier->Career->find('list');
		$this->set(compact('careers'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->JobApplier->id = $id;
		if (!$this->JobApplier->exists()) {
			throw new NotFoundException(__('Invalid job applier'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobApplier->delete()) {
			$this->Session->setFlash('The job applier has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The job applier could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
