<?php
App::uses('AppController', 'Controller');
/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class FaqsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	
	public function beforeFilter() {
		 $this->Auth->allow('view');
		parent::beforeFilter();
	 }

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index($type=null) {
		if (($type !="provider" ) && ($type != "customer")) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$this->Faq->recursive = 0;
		$this->Paginator->settings = array('conditions'=>array('Faq.faq_type'=>$type));
		$this->set('faqs', $this->Paginator->paginate());
		$this->set(compact('type'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($type=null,$id = null) {
		if (($type !="provider" ) && ($type != "customer")) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
		$this->set('faq', $this->Faq->find('first', $options));
		$this->set(compact('type'));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add($type=null) {
		if (($type !="provider" ) && ($type != "customer")) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if ($this->request->is('post')) {
			if($type=='provider'){
				$this->request->data['Faq']['faq_type'] = 'provider';
			}else{
				$this->request->data['Faq']['faq_type'] = 'customer';
			}
			$this->Faq->create();
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash('The faq has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index',$type));
			} else {
				$this->Session->setFlash('The faq could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$this->set(compact('type'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($type=null,$id = null) {
		if (($type !="provider" ) && ($type != "customer")) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if (!$this->Faq->exists($id)) {
			throw new NotFoundException(__('Invalid faq'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Faq->save($this->request->data)) {
				$this->Session->setFlash('The faq has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index',$type));
			} else {
				$this->Session->setFlash('The faq could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
			$this->request->data = $this->Faq->find('first', $options);
		}
		$this->set(compact('type'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($type=null,$id = null) {
		$this->Faq->id = $id;
		if (!$this->Faq->exists()) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Faq->delete()) {
			$this->Session->setFlash('The faq has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The faq could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index',$type));
	}
	
/* @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($type=null) {
		if (($type !="provider" ) && ($type != "customer")) {
			throw new NotFoundException(__('Invalid faq'));
		}
		$options = array('conditions' => array('Faq.is_active' => 1,'Faq.faq_type'=>$type));
		$this->set('faqs', $this->Faq->find('all', $options));
		$user_stats = $this->Faq->query("select count(id) NewProfile,
										(select count(id) from users where role='ServiceProvider' and status=1) TotalProvider,
										(select count(id) from service_categories where is_active=1) TotalCategory,
										(select count(id) from users where role='ServiceSeeker' and status=1) TotalSeeker,
										(select count(id) from seeker_provider_requests where  status='Completed') Completed
										 from users
										 where 
										 status = 1 and role = 'ServiceProvider' and created_date between  (CURDATE()- INTERVAL 30 DAY) and CURDATE()");
		$title_for_layout = 'FAQs';
        $hideSearchBar = false;
		$this->set(compact('type','user_stats','title_for_layout','hideSearchBar'));
	}
}
