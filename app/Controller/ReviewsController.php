<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');
/**
 * Reviews Controller
 *
 * @property Review $Review
 * @property PaginatorComponent $Paginator
 */
class ReviewsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Useful');
	public $helpers = array('SmartForm');

/**
 * index method
 *
 * @return void
 */
	/*public function index() {
		$this->Review->recursive = 0;
		$this->set('reviews', $this->Paginator->paginate());
	}*/

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
		$this->set('review', $this->Review->find('first', $options));
	}
	
	public function review_history() {
		$this->Review->recursive = 0;
		
		$this->Paginator->settings = array('order'=>array('review_date' =>' desc'));
		$this->set('review_history', $this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));
	}
	
	public function admin_review_history($id=null) {
		$this->Review->recursive = 0;
		$this->Paginator->settings = array('order'=>array('review_date' =>' desc'));
		$this->set('review_history', $this->Paginator->paginate(array('service_seeker_id'=>$id)));
	}
	public function admin_provider_review_history($id=null) {
		$this->Review->recursive = 0;
		$this->Paginator->settings = array('order'=>array('review_date' =>' desc'));
		$this->set('review_history', $this->Paginator->paginate(array('service_provider_id'=>$id)));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($id=null, $request_id=null) {
		
		if ($id=='' || $request_id=='') {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->data['Review']['review_date']=date('Y-m-d');
		$this->request->data['Review']['service_seeker_id']=$this->Auth->user('id');
		$this->request->data['Review']['service_provider_id']=$id;
		$this->request->data['Review']['request_id']=$request_id;
		$this->request->data['Review']['is_active']='0';
		
		
		if ($this->request->is('post')) {
			
			$this->loadModel('User');
			$user_email=$this->User->field('email',array('id'=>$this->Auth->User('id')));
			$user_name=$this->User->field('name',array('id'=>$this->Auth->User('id')));
			$user_name =explode(" ",$user_name);
			$user_name=$user_name[0];
			
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash('The review has been saved.','default',array('class'=>'success'));
				//$this->send_mailto_seeker($user_email,$user_name);

				$policy = SITE_URL . 'contents/Privacy_policy';
				$emailVars = array('company_name' => COMPANY_NAME, 'user_name' => $user_name, 'trilord_email' => MAIL_FROM, 'policy' => $policy, 'user_agreement' => '');
				$this->Useful->sendEmail($user_email, "Thank You", 'review', $emailVars);


				///return $this->redirect(array('controller'=>'users','action' => 'seeker_profile'));
			} else {
				$this->Session->setFlash('The review could not be saved. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		$provider_name = $this->Useful->provider_name($id);
		$hideSearchBar = true;
		$page_title = "ServiceRequests > Review";
		$this->set(compact('provider_name', 'hideSearchBar', 'page_title'));
	}
	
	
	private function send_mailto_seeker($email = null,$user_name=null){
			$policy=SITE_URL.'contents/Privacy_policy';
			$user_agreement='';
			$trilord_email='email@trilordmarket.com';
			$this->autoRender=false;
			$to = $email;
			$from = MAIL_FROM;
					//$result = $this->_send_email($from,$get_email,$token_url);
			$Email = new CakeEmail();
			$Email->config('default');
			$Email->viewVars(array('user_name' => $user_name,'trilord_email'=>$trilord_email,'policy'=>$policy,'user_agreement'=>$user_agreement));
			$Email->from(array($from  => 'TrilordMarket'))
				  ->to($to)
				  ->subject('Thank You')
				  ->emailFormat('html')
				  ->template('review','review')
				  ->send();
			}
	
	public function admin_verify($id = null,$status=null){
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->onlyAllow('post', 'delete');
		
		if($status=='verify'){
			$this->request->data['Review']['is_active'] =1;
			
			if ($this->Review->save($this->request->data)) {
					$this->Session->setFlash('Review has been verified.','default',array('class'=>'success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					//debug($this->Review->validationErrors);exit;
					$this->Session->setFlash('Unable to verify review.','default',array('class'=>'error-message'));
				}
				
		}elseif($status=='disable'){
			$this->request->data['Review']['is_active'] =2;
			
			if ($this->Review->save($this->request->data)) {
					$this->Session->setFlash('Review has been blocked.','default',array('class'=>'success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					//debug($this->Review->validationErrors);exit;
					$this->Session->setFlash('Unable to block review.','default',array('class'=>'error-message'));
				}
				
		}else{	
			$this->request->data['Review']['is_active'] =1;
			
			if ($this->Review->save($this->request->data)) {
					$this->Session->setFlash('Review has been enabled.','default',array('class'=>'success'));
					return $this->redirect(array('action' => 'index'));
				} else {
					//debug($this->Review->validationErrors);exit;
					$this->Session->setFlash('Unable to enable review.','default',array('class'=>'error-message'));
				}
		}
		//debug($this->request->data);die;
		
		
		
		return $this->redirect(array('action' => 'index'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash('The review has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The review could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
			$this->request->data = $this->Review->find('first', $options);
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
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Review->delete()) {
			$this->Session->setFlash('The review has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The review could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		
		$this->Paginator->settings = array('order'=>array('review_date' =>' desc'));
		if (!empty($this->params->query)) {
			
			$from = $this->params->query['from'];
			$to =	$this->params->query['to'];
			$name = $this->params->query['name'];
            $type = $this->params->query['type'];
			$conditions[] = array();
			
			if (!empty($from)) {
				if (!empty($to)) {
				$conditions[] =array("Review.review_date BETWEEN '$from' AND '$to'");
				//array('User.created_date>=' => $from,'User.created_date<=' => $to);
				}
				else{
					$now=date('Y-m-d');
				$conditions[] =array("Review.review_date BETWEEN '$from' AND '$now'");					
				}
			}
			if (!empty($name)) {
				/*
				$user_id=$this->Review->query("Select id from users where name='{$name}'");
				if($user_id){
					$conditions[] = array('Review.service_provider_id'=>$user_id[0]['users']['id']);
				}else{
					$conditions[] = array('Review.service_provider_id'=>'0');
				}*/
				$user_id=$this->Review->query("Select group_concat(id) id from users where name LIKE '%".$name."%'");
				$user_id=str_replace(",","','",$user_id[0][0]['id']);
				$conditions[] = array("Review.service_provider_id in ('".$user_id."')");
				
			}
			if ($type=='export') {
				$this->layout = false;
				$this->autoRender = false;
				$reviews=$this->Review->find('all',array('conditions'=>array($conditions)));
				$this->set(compact('reviews'));
				$this->render('/Elements/reviews_record');
				//debug($conditions);die;
				
			}
			 $this->Paginator->settings = array(
										'conditions' => array($conditions),
										'order'=>array('review_date' =>' desc')
									);
			
		}else{
			$from = "";
			$to =	"";
			$name = "";
		}
		$this->Review->recursive = 0;
		$reviews = $this->Paginator->paginate();
		$this->set(compact('reviews','from','to','name'));
	}
/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
		$this->set('review', $this->Review->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Review->create();
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash('The review has been saved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The review could not be saved. Please, try again.','default',array('class'=>'error-message'));
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
		if (!$this->Review->exists($id)) {
			throw new NotFoundException(__('Invalid review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Review->save($this->request->data)) {
				$this->Session->setFlash('The review has been updated.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The review could not be updated. Please, try again.','default',array('class'=>'error-message'));
			}
		} else {
			$options = array('conditions' => array('Review.' . $this->Review->primaryKey => $id));
			$this->request->data = $this->Review->find('first', $options);
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
		$this->Review->id = $id;
		if (!$this->Review->exists()) {
			throw new NotFoundException(__('Invalid review'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Review->delete()) {
			$this->Session->setFlash('The review has been deleted.','default',array('class'=>'success'));
		} else {
			$this->Session->setFlash('The review could not be deleted. Please, try again.','default',array('class'=>'error-message'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
