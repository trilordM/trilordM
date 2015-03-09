<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('UserRepository', 'Repository/Impl');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController
{

    /**
     * Components
     *
     * @var array
     */


    public $components = array(
        'Paginator',
        'Useful',
        'SparrowSMS',
        'PhpThumb.PhpThumb',
        'PhpThumb.PhpCustom',
        'RequestHandler'
    );
    public $helpers = array('QrCode');


    var $UserRepository;

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);

        $this->UserRepository = new UserRepository($this->User);

    }


    public function beforeFilter()
    {
        parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'register', 'provider_add', 'logout', 'confirm_message', 'forgot_password',
            'reset_password');
    }

    public function login()
    {
        if ($this->Auth->user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash('Invalid username or password, try again', 'default',
                array('class' => 'error-message'));
        }

        $hideSearchBar = true;
        $this->set(compact('hideSearchBar'));

    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function forgot_password()
    {

        $email = $this->request->data['UserForgot']['email'];
        $user_detail = $this->User->find('first', array('conditions' => array('User.email' => $email)));

        if (count($user_detail) > 0) {
            if ($user_detail['User']['status'] == '1') {
                $key = Security::hash(String::uuid(), 'sha512', true);
                $user_detail['User']['token'] = $key;
                $url = SITE_URL . 'users/reset_password?token=' . $user_detail['User']['token'] . '&email=' . base64_encode($user_detail['User']['email']);
                $this->User->id = $user_detail['User']['id'];
                if ($this->User->saveField('token', $user_detail['User']['token'])) {


                    //$this->password_reset_mail($email, $url);
                } else {

                    echo '<span style="color:red;">Sorry, we could not process your request at the moment. Please try again.</span>';
                }
            } else {
                echo '<span style="color:red;">Sorry, Your account is not activated. Please contact site admin./span>';
            }

        } else {
            echo '<span style="color:red;">Sorry, we could not recognize your email.</span>';
        }
    }

    public function reset_password($token = null)
    {
        if ($this->Auth->user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
        $validity = '';
        if (!$this->Auth->user()) {
            //debug($this->params->query);exit;
            $email = base64_decode($this->params->query['email']);

            $token = $this->params->query['token'];
            $get_user_count = $this->User->find('first', array(
                'conditions' => array(
                    'User.token' => $token,
                    'User.email' => $email,
                    'User.status' => 1
                )
            ));


            if ($get_user_count < 1) {
                $this->Session->setFlash('Invalid token url. Please try again.', 'default',
                    array('class' => 'error-message'));
                $validity = 0;
            } else {
                $validity = 1;
            }


            if ($this->request->is('POST')) {
                //reset password in db and redirect accordingly
                $validity = 1;
                if ($this->request->data['User']['password1'] != $this->request->data['User']['confirm_password']) {
                    $this->Session->setFlash('Passwords do not match, try again.', 'default',
                        array('class' => 'error-message'));
                }
                $this->request->data['User']['password_change_date'] = date('Y-m-d H:i:s');
                $this->request->data['User']['password'] = $this->request->data['User']['password1'];
                //$this->User->create();

                //debug($new_token);
                $this->request->data['User']['token'] = '';
                $this->request->data['User']['id'] = $get_user_count['User']['id'];
                //debug($new_token);exit;
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash('Password updated successfully, login with new password to continue.',
                        'default', array('class' => 'success'));
                    $this->redirect(array('action' => 'login'));
                } else {
                    $this->Session->setFlash('The Password could not be updated, try again.', 'default',
                        array('class' => 'error-message'));
                }


            }


        }

        //echo $this->Session->read('id');exit;


        $this->set('validity', $validity);


        if (!empty($token)) {
            $token_input = $this->User->findBytoken($token);
            if ($token_input) {
                $this->User->id = $token_input['User']['id'];
                if (!empty($this->request->data)) {
                    if ($this->User->validates(array('fieldList' => array('password', 'password_confirm')))) {

                    }
                }
            } else {

                $this->Session->setFlash('Token Corrupted.', 'default', array('class' => 'error-message'));
            }

        }

    }

    private function password_reset_mail($emailTo = null, $tokenURL = null)
    {

        $this->autoRender = false;

        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array('company_name' => $this->Useful->getCompanyName(), 'link' => $tokenURL));
        $Email->from(array(MAIL_FROM => COMPANY_NAME))
            ->to($emailTo)
            ->subject('Password reset link.')
            ->emailFormat('html')
            ->template('reset_password', 'reset_password')
            ->send();


    }


    public function admin_login()
    {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash('Invalid username or password, try again', 'default',
                array('class' => 'error-message'));
        }
    }

    public function admin_logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    /**
     * index method
     *
     * @return void
     */

    public function report()
    {

    }


    public function admin_seeker_index()
    {

        $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        if (!empty($this->params->query)) {

            $from = $this->params->query['from'];
            $to = $this->params->query['to'];
            $seeker_name = $this->params->query['seeker_name'];
            $status = $this->params->query['Status'];
            $type = $this->params->query['type'];
            $conditions[] = array('role' => 'ServiceSeeker');

            if (!empty($from)) {
                if (!empty($to)) {
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$to'");
                    //array('User.created_date>=' => $from,'User.created_date<=' => $to);
                } else {
                    $now = date('Y-m-d');
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$now'");
                }
            }
            if (!empty($seeker_name)) {
                /*$user_id=$this->User->query("Select id from users where name='{$seeker_name}'");
                if($user_id){
                $conditions[] = array('User.id'=>$user_id[0]['users']['id']);
                }else{
                    $conditions[] = array('User.id'=>'0');
                }*/
                $conditions[] = array("User.name LIKE '%" . $seeker_name . "%'");
            }
            if (!empty($status)) {
                $conditions[] = array('User.status' => $status);
            }

            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;
                $users = $this->User->find('all', array('conditions' => array($conditions)));
                //debug($users);die;
                $this->set(compact('users'));
                $this->render('/Elements/seeker_record');
                //debug($conditions);die;

            }

            //$this->User->recursive = 0;
            //debug($this->Paginator->paginate($conditions));die;
            //$this->set('users',$this->Paginator->paginate($conditions));

            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => array('created_date' => ' desc')
            );

            /*$Users=$this->User->find('all',array('conditions'=>$conditions));
            $this->set(compact('Users'));*/

        } else {
            $from = "";
            $to = "";
            $seeker_name = "";
            $status = "";
            $type = "";
            $this->Paginator->settings = array(
                'conditions' => array('role' => 'ServiceSeeker'),
                'order' => array('created_date' => ' desc')
            );

            //$this->User->recursive = 0;
            //$this->set('users',$this->Paginator->paginate(array('role'=>'ServiceSeeker')));
        }
        $this->User->recursive = 0;
        $users = $this->Paginator->paginate();
        $this->set(compact('users', 'from', 'to', 'status', 'seeker_name'));
    }

    public function provider_index()
    {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate(array('role' => 'ServiceProvider ')));
    }

    public function admin_provider_index()
    {

        $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        if (!empty($this->params->query)) {
            //debug($this->params->query);die;
            $cond = "User.role='ServiceProvider' and User.status=1";
            $from = $this->params->query['from'];
            $to = $this->params->query['to'];
            $level = $this->params->query['level'];
            $provider_name = $this->params->query['provider_name'];
            $provider_type = $this->params->query['provider_type'];
            $place = $this->params->query['place'];
            $category = $this->params->query['category'];

            $type = $this->params->query['type'];
            $conditions[] = array('role' => 'ServiceProvider', 'status' => 1);

            if (!empty($from)) {
                if (!empty($to)) {
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$to'");
                    $cond .= " and User.created_date BETWEEN '$from' AND '$to'";
                    //array('User.created_date>=' => $from,'User.created_date<=' => $to);
                } else {
                    $now = date('Y-m-d');
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$now'");
                    $cond .= " and User.created_date BETWEEN '$from' AND '$now'";
                }
            }
            if (!empty($level)) {

                $conditions[] = array('User.expertise_level' => $level);
                $cond .= " and User.expertise_level='" . $level . "'";
            }

            if (!empty($provider_name)) {

                $conditions[] = array("User.name LIKE '%" . $provider_name . "%'");
                $cond .= " and User.name LIKE '%" . $provider_name . "%'";
            }

            if (!empty($provider_type)) {

                $conditions[] = array('User.registered_as' => $provider_type);
                $cond .= " and User.registered_as='" . $provider_type . "'";
            }

            if (!empty($place)) {

                $conditions[] = array('User.place_id' => $place);
                $cond .= ' and User.place_id=' . $place;
            }

            if (!empty($category)) {
                $Category = $this->User->query("Select id,title from service_categories where id = '{$category}'");
                $searchJobTitle = $Category[0]['service_categories']['title'];

                $user_id = $this->User->query("Select group_concat(distinct user_id)user_id from provider_service_categories where service_categories_id='{$category}'");
                $user_id = str_replace(",", "','", $user_id[0][0]['user_id']);
                $conditions[] = array("User.id in ('" . $user_id . "') OR User.additional_experience like '%$searchJobTitle%'");
                $cond .= " and (User.id in ('" . $user_id . "') OR User.additional_experience like '%$searchJobTitle%')";

            }


            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;

                $users = $this->User->query("select User.*,group_concat(SC.title) Category,concat_ws('-',P.name,D.name) Place from users as User
                left join provider_service_categories PSC on PSC.user_id=User.id
                left join service_categories SC on SC.id=PSC.service_categories_id
                left join places P on P.id=User.place_id
                left join districts D on D.id=P.district_id where " . $cond . " group by User.id");

                $this->set(compact('users'));
                $this->render('/Elements/provider_record');
            }
            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => array('created_date' => ' desc')
            );

        } else {
            $from = "";
            $to = "";
            $level = "";
            $provider_name = "";
            $provider_type = "";
            $place = "";
            $category = "";
            $type = "";
            $this->Paginator->settings = array(
                'conditions' => array('role' => 'ServiceProvider', 'status' => 1),
                'order' => array('created_date' => ' desc')
            );
            //$this->User->recursive = 0;
            //$this->set('users',$this->Paginator->paginate(array('role'=>'ServiceProvider')));
        }

        if ($place > 0) {
            $getPlaces = $this->User->query("select Place.id,concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id='" . $place . "'");

            $placeDistrict = array(
                array(
                    'id' => $getPlaces[0]['Place']['id'],
                    'name' => $getPlaces[0][0]['PlaceName']
                )
            );

            //debug($placeDistrict);
        } else {
            $placeDistrict = '';
        }
        if ($category > 0) {
            $Category = $this->User->query("Select id,title from service_categories where id = '{$category}'");
            $Category = array(
                array(
                    'id' => $Category[0]['service_categories']['id'],
                    'name' => $Category[0]['service_categories']['title']
                )
            );
            //debug($Category);die;
        } else {
            $Category = "";
        }
        $getPlace = $this->Useful->getPlaceSuggestionList();
        $getCategory = $this->Useful->getSearchjobSuggestionList();

        $this->User->recursive = 0;
        //$users = $this->Paginator->paginate();
        $users = $this->Paginator->paginate();
        $this->set(compact('users', 'from', 'to', 'level', 'provider_type', 'provider_name', 'place', 'category',
            'getPlace', 'getCategory', 'placeDistrict', 'Category'));
    }


    public function admin_unverified_provider_index()
    {

        $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        if (!empty($this->params->query)) {
            //debug($this->params->query);die;
            $cond = "User.role='ServiceProvider' and User.status=0";
            $from = $this->params->query['from'];
            $to = $this->params->query['to'];
            $level = $this->params->query['level'];
            $provider_name = $this->params->query['provider_name'];
            $provider_type = $this->params->query['provider_type'];
            $place = $this->params->query['place'];
            $category = $this->params->query['category'];

            $type = $this->params->query['type'];
            $conditions[] = array('role' => 'ServiceProvider', 'status' => 0);

            if (!empty($from)) {
                if (!empty($to)) {
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$to'");
                    $cond .= " and User.created_date BETWEEN '$from' AND '$to'";
                    //array('User.created_date>=' => $from,'User.created_date<=' => $to);
                } else {
                    $now = date('Y-m-d');
                    $conditions[] = array("User.created_date BETWEEN '$from' AND '$now'");
                    $cond .= " and User.created_date BETWEEN '$from' AND '$now'";
                }
            }
            if (!empty($level)) {

                $conditions[] = array('User.expertise_level' => $level);
                $cond .= " and User.expertise_level='" . $level . "'";
            }

            if (!empty($provider_name)) {

                $conditions[] = array("User.name LIKE '%" . $provider_name . "%'");
                $cond .= " and User.name LIKE '%" . $provider_name . "%'";
            }

            if (!empty($provider_type)) {

                $conditions[] = array('User.registered_as' => $provider_type);
                $cond .= " and User.registered_as='" . $provider_type . "'";
            }

            if (!empty($place)) {

                $conditions[] = array('User.place_id' => $place);
                $cond .= ' and User.place_id=' . $place;
            }

            if (!empty($category)) {
                $user_id = $this->User->query("Select group_concat(distinct user_id)user_id from provider_service_categories where service_categories_id='{$category}'");
                $user_id = str_replace(",", "','", $user_id[0][0]['user_id']);

                $conditions[] = array("User.id in ('" . $user_id . "')");
                $cond .= " and User.id in ('" . $user_id . "')";
            }


            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;
                //$users=$this->User->find('all',array('conditions'=>array($conditions)));
                $users = $this->User->query("select User.*,group_concat(SC.title) Category,concat_ws('-',P.name,D.name) Place from users as User
left join provider_service_categories PSC on PSC.user_id=User.id
left join service_categories SC on SC.id=PSC.service_categories_id
left join places P on P.id=User.place_id
left join districts D on D.id=P.district_id
								 where " . $cond . " group by User.id");
                //debug($users);die;
                $this->set(compact('users'));
                $this->render('/Elements/provider_record');
                //debug($conditions);die;

            }
            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => array('created_date' => ' desc')
            );
            //$this->User->recursive = 0;
            //$this->set('users',$this->Paginator->paginate($conditions));

        } else {
            $from = "";
            $to = "";
            $level = "";
            $provider_name = "";
            $provider_type = "";
            $place = "";
            $category = "";
            $type = "";
            $this->Paginator->settings = array(
                'conditions' => array('role' => 'ServiceProvider', 'status' => 0),
                'order' => array('created_date' => ' desc')
            );
            //$this->User->recursive = 0;
            //$this->set('users',$this->Paginator->paginate(array('role'=>'ServiceProvider')));
        }

        if ($place > 0) {
            $getPlaces = $this->User->query("select Place.id,concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id='" . $place . "'");

            $placeDistrict = array(
                array(
                    'id' => $getPlaces[0]['Place']['id'],
                    'name' => $getPlaces[0][0]['PlaceName']
                )
            );

            //debug($placeDistrict);
        } else {
            $placeDistrict = '';
        }
        if ($category > 0) {
            $Category = $this->User->query("Select id,title from service_categories where id = '{$category}'");
            $Category = array(
                array(
                    'id' => $Category[0]['service_categories']['id'],
                    'name' => $Category[0]['service_categories']['title']
                )
            );
            //debug($Category);die;
        } else {
            $Category = "";
        }
        $getPlace = $this->Useful->getPlaceSuggestionList();

        $getCategory = $this->Useful->getSearchjobSuggestionList();

        $this->User->recursive = 0;
        $users = $this->Paginator->paginate();
        $this->set(compact('users', 'from', 'to', 'level', 'provider_type', 'provider_name', 'place', 'category',
            'getPlace', 'getCategory', 'placeDistrict', 'Category'));
    }




    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    /*	public function view($id = null) {
            if (!$this->User->exists($id)) {
                throw new NotFoundException(__('Invalid user'));
            }
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->set('user', $this->User->find('first', $options));
        }*/

    /**
     * add method
     *
     * @return void
     */
    /*public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }*/


//Provider_add method
    public function provider_add($id = null)
    {

        if ($this->request->is('post')) {
            //debug($this->request->data);exit;
            $this->request->data['User']['role'] = 'ServiceProvider';
            $this->User->create();
            $name = $this->request->data['User']['profile_photo']['name'];
            $tmp_name = $this->request->data['User']['profile_photo']['tmp_name'];
            //WWW_ROOT.'providers_photo/'.$name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'providers_photo/' . $name)) {
                $name = $random_number . $this->request->data['User']['profile_photo']['name'];
            }
            $this->request->data['User']['profile_photo'] = $name;

            if ($this->User->save($this->request->data)) {

                $user_Id = $this->User->getLastInsertID();
                //for uploading providers profile image
                if (!empty($name)) {
                    move_uploaded_file($tmp_name, WWW_ROOT . 'providers_photo/' . $name);
                }

                //add rate:
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
(user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }

                //add category:
                $user_Id = $this->User->getLastInsertID();
                for ($i = 1; $i <= $this->request->data['User']['category_count']; $i++) {
                    $categories = $this->request->data['User']['category_id_' . $i];
                    if ($categories > 0) {
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$categories')");

                    }
                }
                //add document:
                $user_Id = $this->User->getLastInsertID();
                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];

                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];
                    //WWW_ROOT.'providers_document/'.$document_insert;
                    //debug($filename);exit;
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    //debug($filename);exit;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");

                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                    }
                    /* echo "insert into service_provider_documents
(user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')";exit;*/
                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                /*$link='http://192.168.1.122/serviceportal/users/confirm_message?email='.$email.'&code='.$usercode;
                        debug($link);die;*/

                return $this->redirect(array('action' => 'provider_profile', $user_Id));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }

        $this->loadModel('RatePackage');
        $ratePackages = $this->RatePackage->find('all');
        $this->set(compact('ratePackages'));

        $this->loadModel('ServiceCategory');

        $serviceCategories = $this->ServiceCategory->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');
        //debug($serviceCategories);
        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        //debug($country);die;
        $this->set(compact('categories', 'serviceCategories', 'documentPackages', 'country'));
    }


    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been updated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }


    public function seeker_edit()
    {

        $id = $this->Auth->User('id');
        $this->User->id = $id;
        $user_email = $this->User->field('email');
        $user_name = $this->User->field('name');
        $user_name = explode(" ", $user_name);
        $user_name = $user_name[0];

        $existing_record = $this->User->find('first', array(
            'recursive' => '-1',
            'fields' => array(
                'name',
                'email',
                'primary_phone',
                'dob_english',
                'permanent_address',
                'temporary_address'
            ),
            'conditions' => array('User.id' => $id)
        ));

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Profile has been updated.', 'default', array('class' => 'success'));
                $new_record = $this->User->find('first', array(
                    'recursive' => '-1',
                    'fields' => array(
                        'name',
                        'email',
                        'primary_phone',
                        'dob_english',
                        'permanent_address',
                        'temporary_address'
                    ),
                    'conditions' => array('id' => $id)
                ));
                //$new_record=$this->User->query("select name,email,primary_phone,dob_english,permanent_address,temporary_address from users where id='$id'");

                $data_array = array(
                    'name' => 'Name',
                    'primary_phone' => 'Phone',
                    'dob_english' => 'Date of Birth',
                    'permanent_address' => 'Permanent Address',
                    'temporary_address' => 'Temporary Address'
                );

                $result = array_diff($existing_record['User'], $new_record['User']);
                $data = array_intersect_key($data_array, $result);
                $changed_fields = implode(',', array_values($data));


                // $this->send_mailto_seeker($user_email, $user_name, $changed_fields);

                $policy = SITE_URL . 'contents/Privacy_policy';
                $emailVars = array(
                    'company_name' => COMPANY_NAME,
                    'user_name' => $user_name,
                    'user_info' => $changed_fields,
                    'trilord_email' => MAIL_FROM,
                    'policy' => $policy,
                    'user_agreement' => ''
                );

                $this->Useful->sendEmail($user_email, "Profile Updated", 'profile_update', $emailVars);

                return $this->redirect(array('action' => 'seeker_profile'));
            } else {
                $this->Session->setFlash('The user could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        $hideSearchBar = true;
        $active_edit_profile = "active";
        $page_title = "User > Edit Profile";
        $this->set(compact('hideSearchBar', 'active_edit_profile', 'page_title'));
    }

    public function admin_seeker_edit($id)
    {
        //$id=$this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            //debug($this->request->data);die;
            /*$name =$this->request->data['User']['profile_photo']['name'];
            $tmp_name=$this->request->data['User']['profile_photo']['tmp_name'];
            $filename = WWW_ROOT.'seekers_photo/'.$name;
           $random_number = $this->Useful->random_code();
           if(file_exists(WWW_ROOT.'seekers_photo/'.$name))
                {
                    $name= $random_number.$this->request->data['User']['profile_photo']['name'];
                }
            $this->request->data['User']['profile_photo'] = $name;*/
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                /*if (move_uploaded_file($tmp_name,WWW_ROOT.'seekers_photo'.'\\'.$name)) {
                    $this->Session->setFlash('Photo uploaded.');
                  }
                      else{
                          $this->Session->setFlash('Unable to upload photo.');
                      }*/

                return $this->redirect(array('action' => 'seeker_index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    public function provider_pic_edit($id = null)
    {
        $id = $this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {

            $img_name = $this->request->data['User']['img_name'];
            $name = $this->request->data['User']['profile_photo']['name'];
            $tmp_name = $this->request->data['User']['profile_photo']['tmp_name'];
            $filename = WWW_ROOT . 'providers_photo/' . $name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'providers_photo/' . $name)) {
                $name = $random_number . $this->request->data['User']['profile_photo']['name'];
            }
            $this->request->data['User']['profile_photo'] = $name;
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                if (move_uploaded_file($tmp_name, WWW_ROOT . 'providers_photo/' . $name)) {
                    @unlink(WWW_ROOT . 'providers_photo/' . $img_name);
                    $this->Session->setFlash('Profile picture changed.', 'default', array('class' => 'success'));
                } else {
                    $this->Session->setFlash('Unable to upload photo.', 'default', array('class' => 'error-message'));
                }

                return $this->redirect(array('action' => 'provider_pic_edit', $this->User->id));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
            $this->set('user', $this->request->data);
        }
    }


    public function seeker_pic_edit()
    {
        $id = $this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $id;

            $user_email = $this->User->field('email');
            $user_name = $this->User->field('name');
            $user_name = explode(" ", $user_name);
            $user_name = $user_name[0];

            if ($this->request->data['User']['profile_image']['error'] == 0) {
                $img_name = $this->request->data['User']['img_name'];
                $name = $this->request->data['User']['profile_image']['name'];
                $tmp_name = $this->request->data['User']['profile_image']['tmp_name'];
                $filename = WWW_ROOT . 'seekers_photo/' . $name;
                $random_number = $this->Useful->random_code();
                if (file_exists(WWW_ROOT . 'seekers_photo/' . $name)) {
                    $name = $random_number . $this->request->data['User']['profile_image']['name'];
                }
                $this->request->data['User']['profile_photo'] = $name;
                if ($this->User->save($this->request->data)) {
                    if (move_uploaded_file($tmp_name, WWW_ROOT . 'seekers_photo' . '/' . $name)) {
                        $this->PhpThumb->thumbnail('seekers_photo/' . $name, array('w' => 140, 'h' => 140, 'zc' => 1));
                        $this->PhpCustom->thumbnail('seekers_photo/' . $name, array('w' => 200, 'zc' => 1));
                        @unlink(WWW_ROOT . 'seekers_photo/' . $img_name);
                        $this->Session->setFlash('Photo uploaded.', 'default', array('class' => 'success'));

                        $policy = SITE_URL . 'contents/Privacy_policy';
                        $emailVars = array(
                            'company_name' => COMPANY_NAME,
                            'user_name' => $user_name,
                            'user_info' => 'Profile Photo',
                            'trilord_email' => MAIL_FROM,
                            'policy' => $policy,
                            'user_agreement' => ''
                        );
                        $this->Useful->sendEmail($user_email, "Profile Updated", 'profile_update', $emailVars);


                        //$this->send_mailto_seeker($user_email, $user_name, 'Profile Photo');

                    } else {
                        $this->Session->setFlash('Unable to upload photo.', 'default',
                            array('class' => 'error-message'));
                    }

                    return $this->redirect(array('action' => 'seeker_profile', $this->User->id));
                } else {
                    $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                        array('class' => 'error-message'));
                }
            } else {
                return $this->redirect(array('action' => 'seeker_profile', $this->User->id));
            }
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->request->data = $this->User->find('first', $options);
        $this->set('user', $this->request->data);
    }


    public function change_password()
    {
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $this->Auth->User('id');
            $user_email = $this->User->field('email');
            $user_name = $this->User->field('name');
            $user_name = explode(" ", $user_name);
            $user_name = $user_name[0];

            if (!empty($this->request->data['User']['old_Password'])) {
                if ($this->User->field('password') == AuthComponent::password($this->request->data['User']['old_Password'])) {
                    if (!empty($this->request->data['User']['new_Password'])) {
                        if (strlen($this->request->data['User']['new_Password']) >= '6') {
                            if ($this->request->data['User']['new_Password'] == $this->request->data['User']['confirm_password']) {
                                $pass = $this->request->data['User']['new_Password'];
                                $this->User->saveField('password', $pass);

                                $this->Session->setFlash('Password changed', 'default', array('class' => 'success'));


                                $policy = SITE_URL . 'contents/Privacy_policy';
                                $emailVars = array(
                                    'company_name' => COMPANY_NAME,
                                    'user_name' => $user_name,
                                    'user_info' => 'Password',
                                    'trilord_email' => MAIL_FROM,
                                    'policy' => $policy,
                                    'user_agreement' => ''
                                );
                                $this->Useful->sendEmail($user_email, "Profile Updated", 'profile_update', $emailVars);

                                // $this->send_mailto_seeker($user_email, $user_name, 'Password');
                                return $this->redirect(array('action' => 'seeker_profile', $this->User->id));
                            } else {
                                $this->Session->setFlash('Password didnot match', 'default',
                                    array('class' => 'error-message'));
                            }
                        } else {
                            $this->Session->setFlash('Password must be of atlest 6 characters', 'default',
                                array('class' => 'error-message'));
                        }
                    } else {

                        $this->Session->setFlash('Enter your new password', 'default',
                            array('class' => 'error-message'));
                    }
                } else {
                    $this->Session->setFlash('The user with this password did not found', 'default',
                        array('class' => 'error-message'));
                }
            } else {
                $this->Session->setFlash('Enter your password', 'default', array('class' => 'error-message'));
            }
        }
        $hideSearchBar = true;
        $active_change_password = "active";
        $page_title = "Change Password";
        $this->set(compact('hideSearchBar', 'active_change_password', 'page_title'));
    }

    public function admin_change_password()
    {
        if ($this->request->is(array('post', 'put'))) {
            $this->User->id = $this->Auth->User('id');
            if (!empty($this->request->data['User']['old_Password'])) {
                if ($this->User->field('password') == AuthComponent::password($this->request->data['User']['old_Password'])) {
                    if (!empty($this->request->data['User']['new_Password'])) {
                        if ($this->request->data['User']['new_Password'] == $this->request->data['User']['confirm_password']) {
                            $pass = $this->request->data['User']['new_Password'];
                            $this->User->saveField('password', $pass);
                            $this->Session->setFlash('Password changed', 'default', array('class' => 'success'));
                        } else {
                            $this->Session->setFlash('password didnot match', 'default',
                                array('class' => 'error-message'));
                        }
                    } else {

                        $this->Session->setFlash('Enter your new password', 'default',
                            array('class' => 'error-message'));
                    }
                } else {
                    $this->Session->setFlash('The user with this password didnot found', 'default',
                        array('class' => 'error-message'));
                }
            } else {
                $this->Session->setFlash('Enter your password', 'default', array('class' => 'error-message'));
            }
        }
    }


//provider_edit
    public function provider_edit($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {


            if ($this->User->save($this->request->data)) {

                //edit rates:

                $user_Id = $id;
                $this->User->query("DELETE from service_provider_rates WHERE user_id = {$user_Id}");
                //echo "DELETE from service_provider_rates WHERE user_id = {$user_Id}";exit;
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
	 (user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }

                //edit category:
                $this->User->query("DELETE from provider_service_categories WHERE user_id = {$user_Id}");
                for ($i = 1; $i <= $this->request->data['User']['category_count']; $i++) {
                    $categories = $this->request->data['User']['category_id_' . $i];
                    if ($categories > 0) {
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$categories')");
                    }
                }

                //edit document:
                for ($i = 1; $i <= $this->request->data['User']['doc_count']; $i++) {

                    $doc_title = $this->request->data['User']['doc_title_' . $i];
                    $doc_id = $this->request->data['User']['doc_id_' . $i];
                    $doc_name = $this->request->data['User']['doc_name_' . $i]['name'];
                    //$doc_name=$doc_name['name'];
                    $documents = $this->User->query("select SPD.document_file from service_provider_documents SPD where SPD.user_id='{$id}' and SPD.id='{$doc_id}'");
                    $documents = $documents[0]['SPD']['document_file'];
                    //debug($documents);die;

                    if ($this->request->data['User']['doc_name_' . $i]['error'] > 0) {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$documents}' where user_id='{$id}' and id='{$doc_id}'");

                    } else {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$doc_name}' where user_id='{$id}' and id='{$doc_id}'");
                        $tmp_name_doc = $this->request->data['User']['doc_name_' . $i]['tmp_name'];
                        $random_number_doc = $this->Useful->random_code();
                        if (file_exists(WWW_ROOT . 'providers_document/' . $doc_name)) {
                            $doc_name = $random_number_doc . $this->request->data['User']['doc_name_' . $i]['name'];
                        }
                        $this->request->data['User']['document_file'] = $doc_name;
                        if ($doc_name) {
                            move_uploaded_file($tmp_name_doc, WWW_ROOT . 'providers_document/' . $doc_name);
                            @unlink(WWW_ROOT . 'providers_document/' . $documents);
                        }
                    }
                }

                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];
                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");
                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                        //@unlink(WWW_ROOT.'providers_document/'.$document_insert);
                    }

                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'provider_profile', $user_Id));
            } else {

                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
            $this->data = $this->User->read(null, $id);
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
            $this->set('user', $this->request->data);


        }
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user_details = $this->User->find('first', $userOptions);
        //debug($this->User->find('first', $options));

        $checkedArray = array();
        foreach ($user_details['ProviderServiceCategory'] as $Categories) {
            $checkedArray[] = $Categories['service_categories_id'];
        }
        //debug($checkedArray);
        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //debug($ratePackages);die;
        $document = $this->User->query("select SPD.* from service_provider_documents SPD where SPD.user_id={$id}");
        //debug($documents);die;
        //debug($ratePackages);exit;

        $this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');

        //debug($serviceCategories);
        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        $this->set(compact('categories', 'user_details', 'serviceCategories', 'ratePackages', 'checkedArray',
            'documentPackages', 'documents', 'document', 'country'));
        //$this->render('provider_edit');
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash('The user has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }

    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index()
    {
        $this->User->recursive = 0;
        $this->Paginator->settings = array(
            'conditions' => array('User.role!="serviceprovider" and User.role!="serviceseeker"'),
            'order' => array('created_date' => ' desc')
        );
        $this->set('users', $this->Paginator->paginate());
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }


    public function complain_msg()
    {
        $provider = $this->User->find('list',
            array('conditions' => array('User.role' => 'Serviceprovider'), 'fields' => 'User.name'));
        $this->set('provider', $provider);
        $date = date('Y-m-d');
        $this->request->data['User']['complain_date'] = $date;

        if ($this->request->is('post')) {
            $this->User->create();
            //debug($this->request->data);die;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The complain has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The complain could not be saved.', 'default',
                    array('class' => 'error-message'));
            }
        }
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function register()
    {

        if ($this->Auth->user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
        if ($this->request->is('post')) {
            $success = $this->UserRepository->create($this->request->data);

            if($success) {
                $this->Session->setFlash('Your credentials have been saved, all the information you have provided will be kept confidential and will not be disclosed anywhere. You will be sent a validation email to confirm your account.Please check spam folder incase there is no email in inbox. Please Verify your e-mail.',
                    'default', array('class' => 'success'));
            }else
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',array('class' => 'error-message'));

        }

        $hideSearchBar = true;
        $this->set(compact('hideSearchBar'));
    }


    public function confirm_message()
    {
        $email = base64_decode ($this->params['url']['email']);
        $code = $this->params['url']['code'];

        //$condition=array('email'=>$email,'registration_code'=>$code);
        $cond = array('email' => $email);
        if ($this->User->hasAny($cond)) {
            $this->User->id = $this->User->field('id', array('email' => $email));

            $user_Id = $this->User->field('id', array('email' => $email));

            $name = $this->User->field('name', array('email' => $email));


            if ($this->User->field('status') == '0') {
                $this->User->saveField('status', '1');
                $this->User->saveField('registration_code', '');
                $this->Session->setFlash('Thank you for registering with us.Login with your credentials provided during registration.',
                    'default', array('class' => 'success'));


                $sms_details = $this->User->query("select sms_username,sms_password,sms_sender_id,sms_is_active from paypal_settings where id ='1'");

                //debug($sms_details);die;
                $user_phone = $this->User->field('primary_phone', array('id' => $user_Id));
                $seeker_number = preg_replace("/[\s-]+/", "", trim($user_phone));


                $seeker_mob_num = $this->Useful->checkMobileNumber($seeker_number);


                if ($sms_details[0]['paypal_settings']['sms_is_active']) {

                    //prepare necessary parameters
                    /* $client_id = $sms_details[0]['paypal_settings']['sms_sender_id'];
                     $username = $sms_details[0]['paypal_settings']['sms_username'];
                     $password = $sms_details[0]['paypal_settings']['sms_password'];*/

                    $to = $seeker_mob_num;
                    $text = 'Namaskar, Tapai trilordMarket ma register hunu bhayeko cha.Toll Free number 1660-01-13579 Email:info@trilordmarket.com Dhanyabaad,trilordMarket';

                    if (!empty($seeker_mob_num)) {
                        $response = $this->SparrowSMS->sendSMS($to, $text);
                    } else {

                        $this->Session->setFlash('SMS could not be sent to Service Seeker.', 'default',
                            array('class' => 'error-message'));
                    }
                } else {
                    $this->Session->setFlash('SMS could not be sent.', 'default', array('class' => 'error-message'));
                }

            } else {
                if ($this->User->field('status') == '1') {
                    $this->Session->setFlash('Your are already registered', 'default', array('class' => 'success'));
                } else {
                    //debug($this->User->field('status'));die;
                    $this->Session->setFlash('Your account has been disable by admin.Please contact admin ', 'default',
                        array('class' => 'error-message'));
                }
            }
        } else {
            $this->Session->setFlash('No record found.', 'default', array('class' => 'error-message'));

        }

        $service_packages = $this->User->query("select * from service_packages ServicPackage where ServicPackage.is_active=1 and ServicPackage.valid_till >= '" . date('Y-m-d') . "' order by created_date desc limit 1");
        $categories = $this->User->query("SELECT id,title FROM `service_categories` where parent_id ='0'");

        $hideSearchBar = true;
        $this->set(compact('hideSearchBar', 'categories', 'service_packages', 'name'));

    }

    public function provider_register()
    {
        if ($this->Auth->user('id')) {
            $this->redirect(array('controller' => 'pages', 'action' => 'display'));
        }
        if ($this->request->is('post')) {

            $this->request->data['User']['created_date'] = date('Y-m-d');
            $this->request->data['User']['role'] = 'ServiceProvider';
            $this->request->data['User']['status'] = '0';
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                //debug('success');die;
                $this->Session->setFlash('Your request has been sent to admin.  You will be sent a validation email to confirm your account.Please check spam folder incase there is no email in inbox.',
                    'default', array('class' => 'success'));


                return $this->redirect(array('controller' => 'users', 'action' => 'login'));

            } else {

                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));

            }


        }

        $form_id = $this->params->query['type'];
        $hideSearchBar = true;
        $this->set(compact('form_id', 'hideSearchBar'));
    }

    public function admin_seeker_verify($id = null, $status = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->request->onlyAllow('post', 'delete');
        //debug($status);die;
        if ($status == 'enable') {
            if ($this->User->saveField('status', '1')) {
                $this->Session->setFlash('The user has been enabled.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be enabled.', 'default',
                    array('class' => 'error-message'));
            }
        } elseif ($status == 'unblock') {
            if ($this->User->saveField('status', '1')) {
                $this->Session->setFlash('The user has been unblocked.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be unblocked.', 'default',
                    array('class' => 'error-message'));
            }

        } elseif ($status == 'block') {
            if ($this->User->saveField('status', '2')) {
                $this->Session->setFlash('The user has been blocked.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be blocked.', 'default',
                    array('class' => 'error-message'));
            }

        }


        /*if ($this->User->save($this->request->data)) {
            $this->Session->setFlash('The user has been deleted.','default',array('class'=>'success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.','default',array('class'=>'error-message'));
        }*/

        //return $this->redirect($this->request->here);
        return $this->redirect(array('action' => 'seeker_index'));
    }

    public function admin_provider_verify($id = null, $status = null)
    {
        //debug($status);die;
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');

        if ($status == 'verify') {
            $this->request->data['User']['status'] = '1';
            $this->request->data['User']['profile_visibility'] = '1';
            //debug($this->User->field('email'));die;
            if ($this->User->save($this->request->data)) {
                //$user=$this->User->field('username');
                $email = $this->User->field('email');
                $name = $this->User->field('name');
                //creates a unique id with the $user' prefix
                $usercode = uniqid($name);
                $this->request->data['User']['registration_code'] = $usercode;

                $link = SITE_URL . 'users/confirm_message?email=' . $email . '&code=' . $usercode;

                $emailVars = array(
                    'company_name' => COMPANY_NAME,
                    'verify_code' => $link,
                    'username' => $email,
                    'name' => $name
                );

                $this->Useful->sendEmail($email, "Account Activation with " . COMPANY_NAME, 'signup', $emailVars);


                //$this->send_mail($email, $email, $name, $link);
                $this->Session->setFlash('User registered successfully', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('Unable to register user.', 'default', array('class' => 'error-message'));
            }
        } elseif ($status == 'unblock') {
            if ($this->User->saveField('status', '1')) {
                $this->Session->setFlash('The user has been enabled.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be enabled.', 'default',
                    array('class' => 'error-message'));
            }

        } elseif ($status == 'block') {
            if ($this->User->saveField('status', '2')) {
                $this->Session->setFlash('The user has been blocked.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be blocked.', 'default',
                    array('class' => 'error-message'));
            }

        }

        return $this->redirect(array('action' => 'provider_index'));

    }


    public function provider_profile($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user = $this->User->find('first', $userOptions);


        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //$this->loadModel('ServiceCategory');
        $serviceCategories = $this->User->query("SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");
        //echo "SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}";
        //debug($serviceCategories);exit;


        //$provider_id = $id;
        //$ratingCount = $this->Useful->getProviderRating($id);

        $title_for_layout = $user['User']['name'];
        $hideSearchBar = true;
        $this->set(compact('hideSearchBar', 'user', 'ratePackages', 'serviceCategories', 'title_for_layout'));

    }

    /**
     * for star rating
     **/
    public function provider_rating()
    {
        //rating
        if ($this->request->is('ajax')) {
            $this->autoRender = false;
            $this->layout = false;
            $providerId = addslashes($this->request->data['provider_id']);
            $request_id = addslashes($this->request->data['request_id']);
            $seekerId = $this->Auth->user('id');
            $rate = addslashes($this->request->data['rate']);
            //$countSeekerRating = $this->User->query("select count(user_id) UserIds from ratings where user_id='".$providerId."' and seeker_id='".$seekerId."'");
            /*
            if($countSeekerRating[0][0]['UserIds']>0){
                $this->User->query("update ratings set rating='".$rate."' where user_id='".$providerId."' and seeker_id='".$seekerId."'");
            }else{
                $this->User->query("insert into ratings (user_id,seeker_id,rating) values('".$providerId."','".$seekerId."','".$rate."')");
            }*/
            $this->User->query("insert into ratings (user_id,seeker_id,request_id,rating) values('" . $providerId . "','" . $seekerId . "','" . $request_id . "','" . $rate . "')");
            $ratingCount = $this->Useful->getProviderRating($providerId);
            echo ($rate / 5) * 100;
            //echo json_encode($ratingCount);

        }
    }

    public function provider_profile_page()
    {

        $id = $this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }


        if ($this->request->is('post')) {

            //debug($this->request->data);die;
            $uploaded_date = date('Y-m-d');
            $this->User->create();
            $provider_id = $this->Auth->User('id');
            for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {

                if ($this->request->data['User']['document_' . $j]['error'] == 0) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];

                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    $documentId = $this->request->data['User']['document_id_' . $j];

                    $description = $this->request->data['User']['document_description_' . $j];
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/provider_requested_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;

                    if (!empty($document_insert)) {
                        $this->User->query("insert into provider_requested_documents(provider_id,title,description,document_file,uploaded_date)  values ('$provider_id','$documentId','$description','$document_insert','$uploaded_date')");
                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document,
                            WWW_ROOT . 'providers_document/provider_requested_document/' . $document_insert);
                    }

                    $this->Session->setFlash('The documents are successsfully send to admin', 'default',
                        array('class' => 'success'));
                }
            }

        }

        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user = $this->User->find('first', $userOptions);


        $user_place = $this->User->query("select concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id ={$user['User']['place_id']}");


        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP inner join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //$this->loadModel('ServiceCategory');
        $serviceCategories = $this->User->query("SELECT group_concat(title) title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");
        //echo "SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}";
        //debug($serviceCategories);exit;

        //$documents=$this->User->query("SELECT document_file FROM `service_provider_documents` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");

        $provider_id = $id;
        $ratingCount = $this->Useful->getProviderRating($id);
        $title_for_layout = $user['User']['name'];

        $this->set(compact('user', 'ratePackages', 'serviceCategories', 'provider_id', 'ratingCount',
            'title_for_layout'));

        $this->loadModel('SeekerProviderRequest');
        $history_1 = $this->SeekerProviderRequest->find('all',
            array('conditions' => array('service_provider_id' => $id, 'status' => 'New'), 'limit' => 5));
        $history_2 = $this->SeekerProviderRequest->find('all',
            array('conditions' => array('service_provider_id' => $id, 'status' => 'Assigned'), 'limit' => 5));
        $history_3 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_provider_id' => $id, 'status' => 'Completed'),
            'order' => 'completed_date DESC'
        ));
        $this->loadModel('Complain');
        $complain_record = $this->Complain->find('all',
            array('conditions' => array('service_provider_id' => $id), 'limit' => 5));

        $serviceCategories = str_replace(",", "','", $serviceCategories[0][0]['title']);
        //debug($serviceCategories);die;
        $provider_records = $this->User->query("SELECT User.id,User.name,User.temporary_address,User.about_me,User.profile_photo,group_concat(distinct(SC.title)) as categories,group_concat(distinct(concat_ws(' ',SPR.rate,RP.title))) as rate FROM `users` User
		Left JOIN service_provider_rates SPR ON User.id = SPR.user_id
		Left join rate_packages as RP on SPR.rate_package_id=RP.id
		Left JOIN provider_service_categories PSC on PSC.user_id=User.id 
		Left JOIN service_categories SC on PSC.service_categories_id= SC.id where User.role='Serviceprovider' and User.id!='$id' and  SC.title in('$serviceCategories') group by User.id ORDER BY User.created_date ASC LIMIT 5");

        $this->loadModel('Review');
        $review_record = $this->Review->find('all',
            array('conditions' => array('service_provider_id' => $id, 'is_active' => '1')));


        //debug($previousId);
        //debug($review_record);die;
        $this->set(compact('history_1', 'history_2', 'history_3', 'deposit_record', 'complain_record',
            'provider_records', 'review_record', 'previousId', 'user_place'));


    }

    public function provider($id = null, $previousId = null)
    {

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user = $this->User->find('first', $userOptions);


        $user_place = $this->User->query("select concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id ={$user['User']['place_id']}");

        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP inner join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //$this->loadModel('ServiceCategory');
        $serviceCategories = $this->User->query("SELECT group_concat(title) title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");
        //echo "SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}";
        //debug($serviceCategories);exit;

        //$documents=$this->User->query("SELECT document_file FROM `service_provider_documents` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");

        $provider_id = $id;
        $ratingCount = $this->Useful->getProviderRating($id);
        $title_for_layout = $user['User']['name'];

        $this->set(compact('user', 'ratePackages', 'serviceCategories', 'provider_id', 'ratingCount',
            'title_for_layout'));

        $this->loadModel('SeekerProviderRequest');
        $history_1 = $this->SeekerProviderRequest->find('all',
            array('conditions' => array('service_provider_id' => $id, 'status' => 'New'), 'limit' => 5));
        $history_2 = $this->SeekerProviderRequest->find('all',
            array('conditions' => array('service_provider_id' => $id, 'status' => 'Assigned'), 'limit' => 5));
        $history_3 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_provider_id' => $id, 'status' => 'Completed'),
            'order' => 'completed_date DESC'
        ));
        $this->loadModel('Complain');
        $complain_record = $this->Complain->find('all',
            array('conditions' => array('service_provider_id' => $id), 'limit' => 5));

        $serviceCategories = str_replace(",", "','", $serviceCategories[0][0]['title']);
        //debug($serviceCategories);die;
        $provider_records = $this->User->query("SELECT User.id,User.name,User.temporary_address,concat_ws(' - ',Place.name,District.name) PlaceName,User.about_me,User.profile_photo,group_concat(distinct(SC.title)) as categories,group_concat(distinct(concat_ws('/',SPR.rate,RP.title))) as rate FROM `users` User
		
			
		inner join places as Place on Place.id=User.place_id
		inner join districts as District on District.id=Place.district_id
		
		Left JOIN service_provider_rates SPR ON User.id = SPR.user_id
		Left join rate_packages as RP on SPR.rate_package_id=RP.id
		Left JOIN provider_service_categories PSC on PSC.user_id=User.id 
		Left JOIN service_categories SC on PSC.service_categories_id= SC.id where User.role='Serviceprovider' and User.id!='$id' and  SC.title in('$serviceCategories') group by User.id ORDER BY User.created_date ASC LIMIT 6");

        $this->loadModel('Review');
        $review_record = $this->Review->find('all',
            array('conditions' => array('service_provider_id' => $id, 'is_active' => '1')));


        //debug($previousId);
        //debug($review_record);die;
        $this->set(compact('history_1', 'history_2', 'history_3', 'deposit_record', 'complain_record',
            'provider_records', 'review_record', 'previousId', 'user_place'));


    }


    //provider profile in admin page
    public function admin_provider($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $users = $this->set('user', $this->User->find('first', $userOptions));

        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //$this->loadModel('ServiceCategory');
        $serviceCategories = $this->User->query("SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");
        //echo "SELECT title FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}";
        //debug($serviceCategories);exit;
        $this->loadModel('SeekerProviderRequest');
        $history_1 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_provider_id' => $id, 'status' => 'New'),
            'limit' => 5,
            'order' => 'created_date DESC'
        ));
        $history_2 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_provider_id' => $id, 'status' => 'Assigned'),
            'limit' => 5,
            'order' => 'assigned_date DESC'
        ));
        $history_3 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_provider_id' => $id, 'status' => 'Completed'),
            'limit' => 5,
            'order' => 'completed_date DESC'
        ));
        $this->loadModel('Complain');
        $complain_record = $this->Complain->find('all',
            array('conditions' => array('service_provider_id' => $id), 'limit' => 5, 'order' => 'complain_date DESC'));

        $this->loadModel('Review');
        $review_record = $this->Review->find('all',
            array('conditions' => array('service_provider_id' => $id), 'limit' => 5, 'order' => 'review_date DESC'));
        $this->set(compact('history_1', 'history_2', 'history_3', 'deposit_record', 'complain_record',
            'review_record'));

        $this->set(compact('ratePackages', 'serviceCategories'));

    }

    public function admin_seeker($id = null)
    {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->loadModel('SeekerProviderRequest');
        $history_1 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $id, 'status' => 'New'),
            'limit' => 5,
            'order' => 'created_date DESC'
        ));
        $history_2 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $id, 'status' => 'Assigned'),
            'limit' => 5,
            'order' => 'assigned_date DESC'
        ));
        $history_3 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $id, 'status' => 'Completed'),
            'limit' => 5,
            'order' => 'completed_date DESC'
        ));
        $this->loadModel('ServiceSeekerDeposit');
        $deposit_record = $this->ServiceSeekerDeposit->find('all',
            array('conditions' => array('user_id' => $id), 'limit' => 5, 'order' => 'deposited_date DESC'));
        $this->loadModel('Complain');
        $complain_record = $this->Complain->find('all',
            array('conditions' => array('service_seeker_id' => $id), 'limit' => 5, 'order' => 'complain_date DESC'));
        $this->loadModel('Review');
        $review_record = $this->Review->find('all',
            array('conditions' => array('service_seeker_id' => $id), 'limit' => 5, 'order' => 'review_date DESC'));

        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $users = $this->set('user', $this->User->find('first', $userOptions));
        $this->set(compact('history_1', 'history_2', 'history_3', 'deposit_record', 'complain_record',
            'review_record'));

    }


    public function seeker_profile()
    {
        $id = $this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->loadModel('SeekerProviderRequest');
        $history_1 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $this->Auth->User('id'), 'status' => 'New'),
            'order' => 'created_date DESC'
        ));
        $history_2 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $this->Auth->User('id'), 'status' => 'Assigned'),
            'order' => 'assigned_date DESC'
        ));
        $history_3 = $this->SeekerProviderRequest->find('all', array(
            'conditions' => array('service_seeker_id' => $this->Auth->User('id'), 'status' => 'Completed'),
            'order' => 'completed_date DESC'
        ));
        $this->loadModel('ServiceSeekerDeposit');
        $deposit_record = $this->ServiceSeekerDeposit->find('all', array(
            'conditions' => array('user_id' => $this->Auth->User('id')),
            'order' => 'deposited_date DESC'
        ));
        $this->loadModel('Complain');
        $complain_record = $this->Complain->find('all', array(
            'conditions' => array('service_seeker_id' => $this->Auth->User('id')),
            'order' => 'complain_date DESC'
        ));
        $this->loadModel('Review');
        $review_record = $this->Review->find('all', array(
            'conditions' => array('service_seeker_id' => $this->Auth->User('id'), 'is_active' => '1'),
            'order' => 'review_date DESC'
        ));

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user = $this->User->find('first', $options);
        $this->set('user', $user);
        $getDepositDetail = $this->Useful->availableAmount($id);

        $testimonial_existance = $this->User->query("Select * from testimonials where user_id ='$id'");

        $hideSearchBar = true;
        $active_seeker_profile = "active";
        $page_title = $user['User']['name'] . "'s Profile";
        $this->set(compact('active_seeker_profile', 'page_title', 'hideSearchBar', 'history_1', 'history_2',
            'history_3', 'deposit_record', 'complain_record', 'review_record', 'getDepositDetail', 'settings',
            'testimonial', 'testimonial_existance'));

    }


    public function admin_seeker_profile()
    {
        $id = $this->Auth->User('id');
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));

    }


    public function admin_add()
    {
        $this->request->data['User']['created_date'] = date('Y-m-d');
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
    }

    public function admin_provider_add($id = null)
    {
        if ($this->request->is('post')) {
            //debug($this->request->data);die;

            if (!empty($this->request->data['Model']['field'])) {

                $this->request->data['User']['dob_nepali'] = $this->request->data['Model']['field']['year'] . '-' . $this->request->data['Model']['field']['month'] . '-' . $this->request->data['Model']['field']['day'];
            }

            $this->request->data['User']['created_date'] = date('Y-m-d');
            $this->request->data['User']['role'] = 'ServiceProvider';
            $this->request->data['User']['status'] = '1';
            $this->request->data['User']['registered_as'] = 'individual';
            $this->request->data['User']['place_id'] = $this->request->data['User']['place'];
            $this->request->data['User']['assigned_by'] = $this->Auth->User('name');

            $this->User->create();
            $name = $this->request->data['User']['profile_image']['name'];
            $tmp_name = $this->request->data['User']['profile_image']['tmp_name'];
            //WWW_ROOT.'providers_photo/'.$name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'providers_photo/' . $name)) {
                $name = $random_number . $this->request->data['User']['profile_image']['name'];
            }
            $this->request->data['User']['profile_photo'] = $name;

            if ($this->User->save($this->request->data)) {


                $user_Id = $this->User->getLastInsertID();
                //for uploading providers profile image
                if (!empty($name)) {
                    move_uploaded_file($tmp_name, WWW_ROOT . 'providers_photo/' . $name);

                    $this->PhpThumb->thumbnail('providers_photo/' . $name, array(
                        'w' => 140,
                        'h' => 140,
                        'zc' => 1
                    ));
                    $this->PhpCustom->thumbnail('providers_photo/' . $name, array(
                        'w' => 200,
                        'zc' => 1
                    ));
                }

                //add rate:
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    //debug($rateId);die;
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
(user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }

                //add category:
                $user_Id = $this->User->getLastInsertID();
                //debug($this->request->data['User']);die;
                /*
                    $category_count=count($this->request->data['User']['category_id']);
                for($i=1;$i<=$category;$i++){
                    $categories = $this->request->data['User']['category_id_'.$i];
                    if(isset($categories)){
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$categories')");

                        }
                    }*/

                if (isset($this->request->data['User']['category_id'])) {
                    foreach ($this->request->data['User']['category_id'] as $Categories) {
                        //debug($Categories);die;
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$Categories')");
                    }
                }

                /*//add additional experience to services table
                if(!empty($this->request->data['User']['additional_experience'])){
                $sevices=explode(',',$this->request->data['User']['additional_experience']);
                foreach($sevices as $service){
                    $service=trim($service);
                    $record=$this->User->query("select * from services where name='{$service}'");
                    if(empty($record)){
                        $this->User->query("INSERT INTO `services`(`name`) VALUES ('$service')");
                    }
                    }
                }
                */


                //add document:
                $user_Id = $this->User->getLastInsertID();
                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];

                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];
                    //WWW_ROOT.'providers_document/'.$document_insert;
                    //debug($filename);exit;
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    //debug($filename);exit;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");

                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                    }
                    /* echo "insert into service_provider_documents
(user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')";exit;*/
                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                /*
                $sms_details=$this->User->query("select sms_username,sms_password,sms_sender_id,sms_is_active from paypal_settings where id ='1'");

                //debug($sms_details);die;
                $user_phone = $this->User->field('primary_phone',array('id'=>$user_Id));
                $number = preg_replace("/[\s-]+/", "", trim($user_phone));
                //$number=substr($number, 1);
                $provider_phone=$user_phone;
                //if(is_numeric($number)){
    //				$number_digit = strlen($number);
    //				if($number_digit==10){
    //				$digit=substr($number, 0, 2);
    //					if($digit=='98'){
    //						$provider_phone=$number;
    //					}
    //				}
    //				if($number_digit==13){
    //				$digit=substr($number, 0, 5);
    //				//debug($number);die;
    //					if($digit=='97798'){
    //						$provider_phone=$number;
    //					}
    //				}
    //			}

                if( $sms_details[0]['paypal_settings']['sms_is_active']){

                //prepare necessary parameters
                $client_id = $sms_details[0]['paypal_settings']['sms_sender_id'];
                $username = $sms_details[0]['paypal_settings']['sms_username'];
                $password = $sms_details[0]['paypal_settings']['sms_password'];

                $to =$provider_phone;
                $text = 'Welcome to trilordMarket';

                // build the url
                 $api_url =  "http://api.sparrowsms.com/call_in.php?" .
                    http_build_query(array(
                        "client_id" => $client_id,
                        "username" => $username,
                        "password" => $password,
                        "to" => $to,
                        "text" => $text
                    ));

                 // put the request to server
                $response = file_get_contents($api_url);
                 //check the response and verify
                //print_r($response);
                }else{
                    $this->Session->setFlash('SMS could not be sent.','default',array('class'=>'error-message'));
                }*/

                return $this->redirect(array('action' => 'provider_index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }

        $this->loadModel('RatePackage');
        $ratePackages = $this->RatePackage->find('all');
        $this->set(compact('ratePackages'));

        $this->loadModel('ServiceCategory');
        //$serviceCategoryOptions = array('order by ServiceCategory.title desc');
        ///$this->ServiceCategory->order = 'title ASC';
        //$serviceCategories = $this->ServiceCategory->generateTreeList(null,null,null,'&nbsp;&nbsp;&nbsp;');
        $serviceCategories = $this->ServiceCategory->find('threaded', array(
            'conditions' => array('ServiceCategory.is_active' => 1),
            'order' => 'ServiceCategory.title',
            'parent' => 'parent_id'
        ));
        $countServiceCategory = $this->ServiceCategory->find('count',
            array('conditions' => array('ServiceCategory.is_active' => 1)));

        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        $getPlace = $this->Useful->getPlaceSuggestionList();
        $getCompany = $this->Useful->getCompanySuggestionList();


        $this->loadModel('ServiceCategory');
        $parents[0] = "[ No Parent]";
        $categoryList = $this->ServiceCategory->generateTreeList(null, null, null, " -> ");

        //debug($categoryList);die;
        if ($categoryList) {

            foreach ($categoryList as $key => $value):
                $parents[$key] = $value;
            endforeach;
            $this->set(compact('parents'));
        }

        //debug($country);die;
        $this->set(compact('categories', 'serviceCategories', 'documentPackages', 'country', 'getPlace', 'getCompany',
            'countServiceCategory'));
    }

    public function admin_load_category($id = null)
    {
        //debug($id);

        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user_details = $this->User->find('first', $userOptions);

        $this->autoRender = false;
        $this->layout = false;
        $this->loadModel('ServiceCategory');
        if (!empty($id)) {

            $serviceCategories = $this->ServiceCategory->find('threaded', array(
                'conditions' => array('ServiceCategory.is_active' => 1),
                'order' => 'ServiceCategory.title',
                'parent' => 'parent_id'
            ));

            $checkedArray = array();
            foreach ($user_details['ProviderServiceCategory'] as $Categories) {
                $checkedArray[] = $Categories['service_categories_id'];
            }

        } else {
            $serviceCategories = $this->ServiceCategory->find('threaded', array(
                'conditions' => array('ServiceCategory.is_active' => 1),
                'order' => 'ServiceCategory.title',
                'parent' => 'parent_id'
            ));

            $checkedArray[] = null;

        }
        //debug($checkedArray);die;
        $this->set(compact('serviceCategories', 'checkedArray'));
        $this->render('admin_load_category');
    }


    public function admin_load_place($id = null)
    {
        //debug($id);
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user_details = $this->User->find('first', $userOptions);


        $this->autoRender = false;
        $this->layout = false;
        $getPlace = $this->Useful->getPlaceSuggestionList();

        $this->loadModel('Place');

        if (!empty($id)) {


            $districts = $this->Place->District->find('list');

            if ($user_details['User']['place_id'] > 0) {
                $getPlaces = $this->User->query("select Place.id,concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id='" . $user_details['User']['place_id'] . "'");
                $placeDistrict = array(
                    array(
                        'id' => $getPlaces[0]['Place']['id'],
                        'name' => $getPlaces[0][0]['PlaceName']
                    )
                );

            } else {
                $placeDistrict = '';
            }


        } else {

            $districts = $this->Place->District->find('list');

            $getPlaces = '';
            $placeDistrict = '';

        }

        //echo json_encode($getPlace );

        $this->set(compact('getPlaces', 'placeDistrict', 'districts'));
        $this->render('admin_load_place');
    }

    public function admin_refresh_place()
    {


        $this->autoRender = false;
        $this->layout = 'ajax';

        if ($this->request->is('ajax')) {
            //debug($this->request);
            //$places=$this->request->query['q'];
            $getPlace = $this->Useful->PlaceSuggestionList($this->request->query['q']);

            return json_encode($getPlace);
            //exit;
        }

    }


    public function admin_seeker_add()
    {

        if ($this->request->is('post')) {
            $this->User->create();
            $name = $this->request->data['User']['profile_photo']['name'];
            $tmp_name = $this->request->data['User']['profile_photo']['tmp_name'];
            $filename = WWW_ROOT . 'seekers_photo/' . $name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'seekers_photo/' . $name)) {
                $name = $random_number . $this->request->data['User']['profile_photo']['name'];
            }
            $this->request->data['User']['profile_photo'] = $name;
            if ($this->User->save($this->request->data)) {

                if (move_uploaded_file($tmp_name, WWW_ROOT . 'seekers_photo/' . $name)) {
                    $this->Session->setFlash('Photo uploaded.', 'default', array('class' => 'success'));
                } else {
                    $this->Session->setFlash('Unable to upload photo.', 'default', array('class' => 'error-message'));
                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
    }


    public function admin_company_add($id = null)
    {

        if ($this->request->is('post')) {
            $this->request->data['User']['name'] = $this->request->data['User']['company_name'];
            //$this->request->data['User']['email']=$this->request->data['User']['mail'];
            //debug($this->request->data);die;
            //$this->request->data['User']['indentifier']=$this->request->data['User']['identifier'];
            $this->request->data['User']['created_date'] = date('Y-m-d');
            $this->request->data['User']['role'] = 'ServiceProvider';
            $this->request->data['User']['status'] = '1';

            $this->request->data['User']['profile_visibility'] = '1';
            $this->request->data['User']['registered_as'] = 'company';
            $this->request->data['User']['place_id'] = $this->request->data['User']['place'];
            $this->request->data['User']['assigned_by'] = $this->Auth->User('name');
            $this->User->create();

            $name = $this->request->data['User']['profile_image']['name'];
            $tmp_name = $this->request->data['User']['profile_image']['tmp_name'];
            //WWW_ROOT.'providers_photo/'.$name;
            $random_number = $this->Useful->random_code();
            if (file_exists(WWW_ROOT . 'providers_photo/' . $name)) {
                $name = $random_number . $this->request->data['User']['profile_image']['name'];
            }
            $this->request->data['User']['profile_photo'] = $name;


            if ($this->User->save($this->request->data)) {
                //debug($this->request->data);
                $user_Id = $this->User->getLastInsertID();

                //for uploading providers profile image
                if (!empty($name)) {
                    move_uploaded_file($tmp_name, WWW_ROOT . 'providers_photo/' . $name);

                    $this->PhpThumb->thumbnail('providers_photo/' . $name, array(
                        'w' => 140,
                        'h' => 140,
                        'zc' => 1
                    ));
                    $this->PhpCustom->thumbnail('providers_photo/' . $name, array(
                        'w' => 200,
                        'zc' => 1
                    ));
                }

                /*//add additional experience to services table
                    if(!empty($this->request->data['User']['additional_experience'])){
                    $sevices=explode(',',$this->request->data['User']['additional_experience']);
                    foreach($sevices as $service){
                        $service=trim($service);
                        $record=$this->User->query("select * from services where name='{$service}'");
                        if(empty($record)){
                            $this->User->query("INSERT INTO `services`(`name`) VALUES ('$service')");
                        }
                        }
                    }*/

                //add rate:
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    //debug($rateId);die;
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
(user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }

                //add category:
                $user_Id = $this->User->getLastInsertID();
                /*$category_count=count($this->request->data['User']['category_id']);
                for($i=1;$i<=$category;$i++){
                    $categories = $this->request->data['User']['category_id_'.$i];
                    if(isset($categories)){
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$categories')");

                        }
                    }*/
                if (isset($this->request->data['User']['category_id'])) {
                    foreach ($this->request->data['User']['category_id'] as $Categories) {
                        //debug($Categories);die;
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$Categories')");
                    }
                }


                //add document:
                //$user_Id = $this->User->getLastInsertID();
                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];

                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];
                    //WWW_ROOT.'providers_document/'.$document_insert;
                    //debug($filename);exit;
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    //debug($filename);exit;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");

                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                    }
                    /* echo "insert into service_provider_documents
(user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')";exit;*/
                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                /*
                    $sms_details=$this->User->query("select sms_username,sms_password,sms_sender_id,sms_is_active from paypal_settings where id ='1'");

                //debug($sms_details);die;
                $user_phone = $this->User->field('primary_phone',array('id'=>$user_Id));
                $number = preg_replace("/[\s-]+/", "", trim($user_phone));
                //$number=substr($number, 1);
                $provider_phone=$user_phone;
                //if(is_numeric($number)){
    //				$number_digit = strlen($number);
    //				if($number_digit==10){
    //				$digit=substr($number, 0, 2);
    //					if($digit=='98'){
    //						$provider_phone=$number;
    //					}
    //				}
    //				if($number_digit==13){
    //				$digit=substr($number, 0, 5);
    //				//debug($number);die;
    //					if($digit=='97798'){
    //						$provider_phone=$number;
    //					}
    //				}
    //			}

                    if( $sms_details[0]['paypal_settings']['sms_is_active']){

                        //prepare necessary parameters
                        $client_id = $sms_details[0]['paypal_settings']['sms_sender_id'];
                        $username = $sms_details[0]['paypal_settings']['sms_username'];
                        $password = $sms_details[0]['paypal_settings']['sms_password'];

                        $to =$provider_phone;
                        $text = 'Welcome to trilordMarket';

                        // build the url
                         $api_url =  "http://api.sparrowsms.com/call_in.php?" .
                            http_build_query(array(
                                "client_id" => $client_id,
                                "username" => $username,
                                "password" => $password,
                                "to" => $to,
                                "text" => $text
                            ));

                         // put the request to server
                        $response = file_get_contents($api_url);
                         //check the response and verify
                        //print_r($response);
                    }else{
                        $this->Session->setFlash('SMS could not be sent.','default',array('class'=>'error-message'));
                    }*/

                return $this->redirect(array('action' => 'provider_index'));
            } else {
                //debug($this->validationErrors);die;
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }

        $this->loadModel('RatePackage');
        $ratePackages = $this->RatePackage->find('all');
        $this->set(compact('ratePackages'));

        $this->loadModel('ServiceCategory');

        $serviceCategories = $this->ServiceCategory->find('threaded', array(
            'conditions' => array('ServiceCategory.is_active' => 1),
            'order' => 'ServiceCategory.title',
            'parent' => 'parent_id'
        ));
        $countServiceCategory = $this->ServiceCategory->find('count',
            array('conditions' => array('ServiceCategory.is_active' => 1)));
        //debug($serviceCategories);
        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        $getPlace = $this->Useful->getPlaceSuggestionList();

        $this->loadModel('ServiceCategory');
        $parents[0] = "[ No Parent]";
        $categoryList = $this->ServiceCategory->generateTreeList(null, null, null, " -> ");

        //debug($categoryList);die;
        if ($categoryList) {

            foreach ($categoryList as $key => $value):
                $parents[$key] = $value;
            endforeach;
            $this->set(compact('parents'));
        }
        //debug($country);die;
        $this->set(compact('categories', 'serviceCategories', 'countServiceCategory', 'documentPackages', 'country',
            'getPlace'));
    }


    public function validate_form()
    {
        if ($this->request->is('ajax')) {
            $this->request->data['User'][$this->request['data']['field']] = $this->request['data']['value'];
            $this->User->set($this->request->data);
            if ($this->User->validates()) {
                $this->autoRender = false;
            } else {

                $error = $this->validateErrors($this->User);
                $this->set('error', $this->User->validationErrors[$this->request['data']['field']][0]);
                $this->render('validate_form', 'ajax');
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
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {

            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash('The user has been updated.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be updated. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);

        }
    }


    public function admin_provider_edit($id = null)
    {

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
            //debug($this->request->data);die;
            if (!empty($this->request->data['User']['profile_image']['name'])) {
                $photo_to_delete = $this->request->data['User']['profile_photo'];

                $profile_image = $this->request->data['User']['profile_image']['name'];
                //debug($profile_image);die;
                $tmp_profile_image = $this->request->data['User']['profile_image']['tmp_name'];
                if (file_exists(WWW_ROOT . 'providers_photo/' . $profile_image)) {
                    $random_number_image = $this->Useful->random_code();
                    $profile_image = $random_number_image . $this->request->data['User']['profile_image']['name'];
                }
            } else {
                $profile_image = $this->request->data['User']['profile_photo'];
            }
            $this->request->data['User']['profile_photo'] = $profile_image;

            $this->request->data['User']['edited_by'] = $this->Auth->User('name');

            $this->request->data['User']['place_id'] = $this->request->data['User']['place'];
            $this->request->data['User']['dob_nepali'] = $this->request->data['User']['dob_nepali']['year'] . '-' . $this->request->data['User']['dob_nepali']['month'] . '-' . $this->request->data['User']['dob_nepali']['day'];

            //debug($this->User->invalidFields());die;
            //debug($this->validationErrors);
            if ($this->User->save($this->request->data)) {
                //change profile image
                if (!empty($this->request->data['User']['profile_image']['name'])) {

                    move_uploaded_file($tmp_profile_image, WWW_ROOT . 'providers_photo/' . $profile_image);

                    $this->PhpThumb->thumbnail('providers_photo/' . $profile_image, array(
                        'w' => 140,
                        'h' => 140,
                        'zc' => 1
                    ));
                    $this->PhpCustom->thumbnail('providers_photo/' . $profile_image, array(
                        'w' => 200,
                        'zc' => 1
                    ));

                    @unlink(WWW_ROOT . 'providers_photo/' . $photo_to_delete);
                    @unlink(WWW_ROOT . 'providers_photo/thumbs/' . $photo_to_delete);
                    @unlink(WWW_ROOT . 'providers_photo/medium/' . $photo_to_delete);
                }
                //$user_Id = $id;
                /*//add additional experience to services table
                    if(!empty($this->request->data['User']['additional_experience'])){
                    $sevices=explode(',',$this->request->data['User']['additional_experience']);
                    foreach($sevices as $service){
                        $service=trim($service);
                        $record=$this->User->query("select * from services where name='{$service}'");
                        if(empty($record)){
                            $this->User->query("INSERT INTO `services`(`name`) VALUES ('$service')");
                        }
                        }
                    }*/
                //edit rates:

                $user_Id = $id;
                $this->User->query("DELETE from service_provider_rates WHERE user_id = {$user_Id}");
                //echo "DELETE from service_provider_rates WHERE user_id = {$user_Id}";exit;
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
	 (user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }

                //edit category:
                $this->User->query("DELETE from provider_service_categories WHERE user_id = {$user_Id}");
                /*for($i=1;$i<=$this->request->data['User']['category_count'];$i++){
                    $categories = $this->request->data['User']['category_id_'.$i];
                    if($categories>0){
                        $this->User->query("insert into provider_service_categories
(user_id,service_categories_id)  values ('$user_Id','$categories')");
                    }
                    }*/
                if (isset($this->request->data['User']['category_id'])) {
                    foreach ($this->request->data['User']['category_id'] as $Categories) {
                        //debug($Categories);die;
                        $this->User->query("insert into provider_service_categories
 (user_id,service_categories_id)  values ('$user_Id','$Categories')");
                    }
                }


                //edit document:
                for ($i = 1; $i <= $this->request->data['User']['doc_count']; $i++) {

                    $doc_title = $this->request->data['User']['doc_title_' . $i];
                    $doc_id = $this->request->data['User']['doc_id_' . $i];
                    $doc_name = $this->request->data['User']['doc_name_' . $i]['name'];
                    //$doc_name=$doc_name['name'];
                    $documents = $this->User->query("select SPD.document_file from service_provider_documents SPD where SPD.user_id='{$id}' and SPD.id='{$doc_id}'");
                    $documents = $documents[0]['SPD']['document_file'];
                    //debug($documents);die;

                    if ($this->request->data['User']['doc_name_' . $i]['error'] > 0) {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$documents}' where user_id='{$id}' and id='{$doc_id}'");

                    } else {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$doc_name}' where user_id='{$id}' and id='{$doc_id}'");
                        $tmp_name_doc = $this->request->data['User']['doc_name_' . $i]['tmp_name'];
                        $random_number_doc = $this->Useful->random_code();
                        if (file_exists(WWW_ROOT . 'providers_document/' . $doc_name)) {
                            $doc_name = $random_number_doc . $this->request->data['User']['doc_name_' . $i]['name'];
                        }
                        $this->request->data['User']['document_file'] = $doc_name;
                        if ($doc_name) {
                            move_uploaded_file($tmp_name_doc, WWW_ROOT . 'providers_document/' . $doc_name);
                            @unlink(WWW_ROOT . 'providers_document/' . $documents);
                        }
                    }
                }

                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];
                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];

                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");
                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                        //@unlink(WWW_ROOT.'providers_document/'.$document_insert);
                    }

                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'provider_index'));
            } else {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                $this->request->data = $this->User->find('first', $options);
                $this->set('user', $this->request->data);
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
            $this->data = $this->User->read(null, $id);
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
            $this->set('user', $this->request->data);


        }
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user_details = $this->User->find('first', $userOptions);
        //debug($user_details);

        $checkedArray = array();
        foreach ($user_details['ProviderServiceCategory'] as $Categories) {
            $checkedArray[] = $Categories['service_categories_id'];
        }
        //debug($checkedArray);
        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //debug($ratePackages);die;
        $document = $this->User->query("select SPD.* from service_provider_documents SPD where SPD.user_id={$id}");
        //debug($documents);die;
        //debug($ratePackages);exit;

        /*$this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->generateTreeList(null,null,null,'&nbsp;&nbsp;&nbsp;');*/

        $this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->find('threaded', array(
            'conditions' => array('ServiceCategory.is_active' => 1),
            'order' => 'ServiceCategory.title',
            'parent' => 'parent_id'
        ));

        //debug($serviceCategories);
        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('ServiceCategory');
        $parents[0] = "[ No Parent]";
        $categoryList = $this->ServiceCategory->generateTreeList(null, null, null, " -> ");

        //debug($categoryList);die;
        if ($categoryList) {

            foreach ($categoryList as $key => $value):
                $parents[$key] = $value;
            endforeach;
            $this->set(compact('parents'));
        }

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        if ($user_details['User']['place_id'] > 0) {
            $getPlaces = $this->User->query("select Place.id,concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id='" . $user_details['User']['place_id'] . "'");
            $placeDistrict = array(
                array(
                    'id' => $getPlaces[0]['Place']['id'],
                    'name' => $getPlaces[0][0]['PlaceName']
                )
            );

        } else {
            $placeDistrict = '';
        }
        $getPlace = $this->Useful->getPlaceSuggestionList();

        $getCompany = $this->Useful->getCompanySuggestionList();

        $company = $this->Useful->company_name($this->request->data['User']['Involved_company']);

        $this->set(compact('categories', 'user_details', 'serviceCategories', 'ratePackages', 'checkedArray',
            'documentPackages', 'documents', 'document', 'country', 'placeDistrict', 'getPlace', 'getCompany',
            'company'));
        //$this->render('provider_edit');
    }


    public function admin_company_edit($id = null)
    {

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
            //debug($this->request->data);die;

            $this->request->data['User']['name'] = $this->request->data['User']['company_name'];
            //$this->request->data['User']['email']=$this->request->data['User']['mail'];
            if (!empty($this->request->data['User']['profile_image']['name'])) {
                $photo_to_delete = $this->request->data['User']['profile_photo'];

                $profile_image = $this->request->data['User']['profile_image']['name'];
                //debug($profile_image);die;
                $tmp_profile_image = $this->request->data['User']['profile_image']['tmp_name'];
                if (file_exists(WWW_ROOT . 'providers_photo/' . $profile_image)) {
                    $random_number_image = $this->Useful->random_code();
                    $profile_image = $random_number_image . $this->request->data['User']['profile_image']['name'];
                }
            } else {
                $profile_image = $this->request->data['User']['profile_photo'];
            }
            $this->request->data['User']['profile_photo'] = $profile_image;

            $this->request->data['User']['edited_by'] = $this->Auth->User('name');

            $this->request->data['User']['place_id'] = $this->request->data['User']['place'];

            //debug($this->User->invalidFields());die;
            //debug($this->validationErrors);
            //debug($this->request->data);die;
            if ($this->User->save($this->request->data)) {
                //change profile image
                if (!empty($this->request->data['User']['profile_image']['name'])) {

                    move_uploaded_file($tmp_profile_image, WWW_ROOT . 'providers_photo/' . $profile_image);

                    $this->PhpThumb->thumbnail('providers_photo/' . $profile_image, array(
                        'w' => 140,
                        'h' => 140,
                        'zc' => 1
                    ));
                    $this->PhpCustom->thumbnail('providers_photo/' . $profile_image, array(
                        'w' => 200,
                        'zc' => 1
                    ));

                    @unlink(WWW_ROOT . 'providers_photo/' . $photo_to_delete);
                    @unlink(WWW_ROOT . 'providers_photo/thumbs/' . $photo_to_delete);
                    @unlink(WWW_ROOT . 'providers_photo/medium/' . $photo_to_delete);
                }
                //edit rates:
                $user_Id = $id;


                $this->User->query("DELETE from service_provider_rates WHERE user_id = {$user_Id}");
                //echo "DELETE from service_provider_rates WHERE user_id = {$user_Id}";exit;
                for ($i = 1; $i <= $this->request->data['User']['rate_count']; $i++) {
                    $rate_insert = $this->request->data['User']['rate_' . $i];
                    $rateId = $this->request->data['User']['rate_id_' . $i];
                    if (!empty($rate_insert)) {
                        $this->User->query("insert into service_provider_rates
	 (user_id,rate_package_id,rate)  values ('$user_Id','$rateId','$rate_insert')");
                    }
                }


                /*//add additional experience to services table
                if(!empty($this->request->data['User']['additional_experience'])){
                $sevices=explode(',',$this->request->data['User']['additional_experience']);
                foreach($sevices as $service){
                    $service=trim($service);
                    $record=$this->User->query("select * from services where name='{$service}'");
                    if(empty($record)){
                        $this->User->query("INSERT INTO `services`(`name`) VALUES ('$service')");
                    }
                    }
                }*/


                //edit category:
                $this->User->query("DELETE from provider_service_categories WHERE user_id = {$user_Id}");
                /*for($i=1;$i<=$this->request->data['User']['category_count'];$i++){
                    $categories = $this->request->data['User']['category_id_'.$i];
                    if($categories>0){
                        $this->User->query("insert into provider_service_categories
(user_id,service_categories_id)  values ('$user_Id','$categories')");
                    }
                    }*/


                if (isset($this->request->data['User']['category_id'])) {
                    foreach ($this->request->data['User']['category_id'] as $Categories) {
                        //debug($Categories);die;
                        $this->User->query("insert into provider_service_categories
	 (user_id,service_categories_id)  values ('$user_Id','$Categories')");
                    }
                }

                //edit document:
                for ($i = 1; $i <= $this->request->data['User']['doc_count']; $i++) {

                    $doc_title = $this->request->data['User']['doc_title_' . $i];
                    $doc_id = $this->request->data['User']['doc_id_' . $i];
                    $doc_name = $this->request->data['User']['doc_name_' . $i]['name'];
                    //$doc_name=$doc_name['name'];
                    $documents = $this->User->query("select SPD.document_file from service_provider_documents SPD where SPD.user_id='{$id}' and SPD.id='{$doc_id}'");
                    $documents = $documents[0]['SPD']['document_file'];
                    //debug($documents);die;

                    if ($this->request->data['User']['doc_name_' . $i]['error'] > 0) {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$documents}' where user_id='{$id}' and id='{$doc_id}'");

                    } else {
                        $this->User->query("UPDATE service_provider_documents SET title='{$doc_title}',document_file='{$doc_name}' where user_id='{$id}' and id='{$doc_id}'");
                        $tmp_name_doc = $this->request->data['User']['doc_name_' . $i]['tmp_name'];
                        $random_number_doc = $this->Useful->random_code();
                        if (file_exists(WWW_ROOT . 'providers_document/' . $doc_name)) {
                            $doc_name = $random_number_doc . $this->request->data['User']['doc_name_' . $i]['name'];
                        }
                        $this->request->data['User']['document_file'] = $doc_name;
                        if ($doc_name) {
                            move_uploaded_file($tmp_name_doc, WWW_ROOT . 'providers_document/' . $doc_name);
                            @unlink(WWW_ROOT . 'providers_document/' . $documents);
                        }
                    }
                }

                for ($j = 1; $j <= $this->request->data['User']['document_count']; $j++) {
                    $document_insert = $this->request->data['User']['document_' . $j]['name'];
                    $tmp_name_document = $this->request->data['User']['document_' . $j]['tmp_name'];
                    //debug($tmp_name);exit;
                    $documentId = $this->request->data['User']['document_id_' . $j];
                    $random_number = $this->Useful->random_code();
                    if (file_exists(WWW_ROOT . 'providers_document/' . $document_insert)) {
                        $document_insert = $random_number . $this->request->data['User']['document_' . $j]['name'];
                    }
                    $this->request->data['User']['document_file'] = $document_insert;
                    if (!empty($document_insert)) {
                        $this->User->query("insert into service_provider_documents
 (user_id,title,document_file)  values ('$user_Id','$documentId','$document_insert')");
                    }
                    if ($document_insert) {
                        move_uploaded_file($tmp_name_document, WWW_ROOT . 'providers_document/' . $document_insert);
                        //@unlink(WWW_ROOT.'providers_document/'.$document_insert);
                    }

                }
                $this->Session->setFlash('The user has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'provider_index'));
            } else {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                $this->request->data = $this->User->find('first', $options);
                $this->set('user', $this->request->data);
                $this->Session->setFlash('The user could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
            $this->data = $this->User->read(null, $id);
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
            $this->set('user', $this->request->data);


        }
        $userOptions = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user_details = $this->User->find('first', $userOptions);
        //debug($user_details);

        /*$checkedArray = array();

        $checkedArray=$this->User->query("SELECT group_concat(service_categories_id) categories FROM `provider_service_categories` WHERE user_id ='{$user_details['ProviderServiceCategory'][0]['user_id']}'");

        $checkedArray=$checkedArray[0][0]['categories'];*/
        /*debug($checkedArray);die;
        $a=array($checkedArray[0][0]['categories']);
        debug($a);die;
            foreach($user_details['ProviderServiceCategory'] as $Categories){
                $checkedArray[] = $Categories['service_categories_id'];
            }*/

        //debug($user_details);
        $checkedArray = array();
        foreach ($user_details['ProviderServiceCategory'] as $Categories) {
            $checkedArray[] = $Categories['service_categories_id'];
        }

        //debug($checkedArray);exit;

        $ratePackages = $this->User->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id={$id} where RP.id is not null group by RP.id");

        //debug($ratePackages);die;
        $document = $this->User->query("select SPD.* from service_provider_documents SPD where SPD.user_id={$id}");
        //debug($documents);die;
        //debug($ratePackages);exit;

        $this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->find('threaded', array(
            'conditions' => array('ServiceCategory.is_active' => 1),
            'order' => 'ServiceCategory.title',
            'parent' => 'parent_id'
        ));

        /*$this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->generateTreeList(null,null,null,'&nbsp;&nbsp;&nbsp;');*/

        //debug($serviceCategories);
        $this->loadModel('ServiceProviderDocument');
        $documentPackages = $this->ServiceProviderDocument->find('all');

        $this->loadModel('ServiceCategory');
        $parents[0] = "[ No Parent]";
        $categoryList = $this->ServiceCategory->generateTreeList(null, null, null, " -> ");

        //debug($categoryList);die;
        if ($categoryList) {

            foreach ($categoryList as $key => $value):
                $parents[$key] = $value;
            endforeach;
            $this->set(compact('parents'));
        }

        $this->loadModel('Country');
        $country = $this->Country->find('list');
        if ($user_details['User']['place_id'] > 0) {
            $getPlaces = $this->User->query("select Place.id,concat_ws(' - ',Place.name,District.name) PlaceName from places as Place
	inner join districts as District on District.id=Place.district_id where Place.id='" . $user_details['User']['place_id'] . "'");
            $placeDistrict = array(
                array(
                    'id' => $getPlaces[0]['Place']['id'],
                    'name' => $getPlaces[0][0]['PlaceName']
                )
            );

        } else {
            $placeDistrict = '';
        }
        $getPlace = $this->Useful->getPlaceSuggestionList();


        $this->set(compact('categories', 'user_details', 'serviceCategories', 'ratePackages', 'checkedArray',
            'documentPackages', 'documents', 'document', 'country', 'placeDistrict', 'getPlace'));
        //$this->render('provider_edit');
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
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        //$user = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
        //$doc = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
        //$this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            //@unlink(WWW_ROOT.'providers_photo'.$user['User']['profile_photo']);
            //@unlink(WWW_ROOT.'providers_document'.$doc['User']['doc_name_'.$i]['name']);
            $this->Session->setFlash('The user has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }


    public function admin_verify($id = null, $status = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        $this->request->onlyAllow('post', 'delete');
        //debug($status);die;
        if ($status == 'enable') {
            if ($this->User->saveField('status', '1')) {
                $this->Session->setFlash('The user has been enabled.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be enabled.', 'default',
                    array('class' => 'error-message'));
            }
        } elseif ($status == 'disable') {
            if ($this->User->saveField('status', '0')) {
                $this->Session->setFlash('The user has been disabled.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash('The user could not be disabled.', 'default',
                    array('class' => 'error-message'));
            }

        }

        /*if ($this->User->save($this->request->data)) {
            $this->Session->setFlash('The user has been deleted.','default',array('class'=>'success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.','default',array('class'=>'error-message'));
        }*/

        //return $this->redirect($this->request->here);
        return $this->redirect(array('action' => 'index'));
    }


    //provider delete
    public function admin_provider_delete($id = null)
    {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        $this->loadModel('ServiceProviderDocument');
        //$documentPackages = $this->ServiceProviderDocument->find('all');
        $doc = $this->ServiceProviderDocument->find('all', array('conditions' => array('user_id' => $id)));
        //debug($doc['ServiceProviderDocument']['document_file']);die;
        //$this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->User->query("delete from service_provider_rates where user_id = {$id}");
            $this->User->query("delete from service_provider_documents where user_id = {$id}");
            $this->User->query("delete from provider_service_categories where user_id = {$id}");
            @unlink(WWW_ROOT . 'providers_photo/' . $user['User']['profile_photo']);
            foreach ($doc as $document) {
                @unlink(WWW_ROOT . 'providers_document/' . $document['ServiceProviderDocument']['document_file']);
            }
            $this->Session->setFlash('The user has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The user could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'admin_provider_index'));

    }

    /**
     * Send Email
     **/
    private function send_mail($email = null, $username = null, $name = null, $verify_code = null)
    {
        $this->autoRender = false;
        $to = $email;
        $from = MAIL_FROM;
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'company_name' => COMPANY_NAME,
            'verify_code' => $verify_code,
            'username' => $username,
            'name' => $name
        ));
        $Email->from(array($from => COMPANY_NAME))
            ->to($to)
            ->subject('Account Activation with trilordMarket.')
            ->emailFormat('html')
            ->template('signup', 'signup')
            ->send();
    }


    private function send_mailto_seeker($email = null, $user_name = null, $user_info = null)
    {
        $policy = SITE_URL . 'contents/Privacy_policy';
        $user_agreement = '';
        $trilord_email = 'email@trilordmarket.com';
        $this->autoRender = false;
        $to = $email;
        $from = MAIL_FROM;
        //$result = $this->_send_email($from,$get_email,$token_url);
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'company_name' => $this->Useful->getCompanyName(),
            'user_name' => $user_name,
            'user_info' => $user_info,
            'trilord_email' => $trilord_email,
            'policy' => $policy,
            'user_agreement' => $user_agreement
        ));
        $Email->from(array($from => $this->Useful->getCompanyName()))
            ->to($to)
            ->subject('Profile Updated')
            ->emailFormat('html')
            ->template('profile_update', 'profile_update')
            ->send();
    }

    //for identiy card
    public function admin_barcode($id = null)
    {

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        ini_set('memory_limit', '512M');

        $userInfo = $this->User->find('first', array('conditions' => array('User.id' => $id), 'recursive' => -1));

        $this->set(compact('userInfo'));

    }

    public function admin_card_date($id = null, $phone = null)
    {
        $this->User->id = $id;
        $digit = substr($phone, -6);


        $user_info = $this->User->find('first', array(
            'recursive' => '-1',
            'fields' => array('issue_date', 'expire_date'),
            'conditions' => array('id' => $id)
        ));
        if ($user_info['User']['issue_date'] != '0000-00-00') {
            $from = $user_info['User']['issue_date'];
        } else {
            $from = '';
        }

        if ($user_info['User']['expire_date'] != '0000-00-00') {
            $to = $user_info['User']['expire_date'];
        } else {
            $to = '';
        }
        $this->set(compact('from', 'to'));


        $serviceCategories = $this->User->query("SELECT title,range_1,range_2 FROM `service_categories` inner join provider_service_categories on provider_service_categories.service_categories_id= service_categories.id where provider_service_categories.user_id={$id}");

        if (!empty($serviceCategories[0]['service_categories'])) {
            //debug($serviceCategories);die;
            $user_category = $serviceCategories[0]['service_categories'];
        } else {
            $user_category = '';
        }
        if (!empty($user_category)) {
            if ($user_category['range_1']) {
                $card_number1 = $user_category['range_1'];
            } else {
                $card_number1 = '';
            }

            if ($user_category['range_2']) {
                $card_number2 = $user_category['range_2'];
            } else {
                $card_number2 = '';
            }
        } else {
            $card_number1 = '';
            $card_number2 = '';
        }

        if ($this->request->is(array('post', 'put'))) {
            if (!$this->User->field('card_number')) {
                if (!empty($card_number1)) {

                    $user_card_id = $card_number1 . $digit;
                    if ($this->User->find('first', array('card_number' => $user_card_id))) {
                        if (!empty($card_number2)) {
                            $user_card_id = $card_number2 . $digit;
                            if ($this->User->find('first', array('card_number' => $user_card_id))) {
                                $card_id = $this->get_card_id($card_number1, $digit);
                                $this->request->data['User']['card_number'] = $card_id;

                            } else {

                                $this->request->data['User']['card_number'] = $user_card_id;
                            }
                        } else {
                            //$card_id=$this->Useful->getcard_id($card_number1,$digit);
                            $this->request->data['User']['card_number'] = $this->get_card_id($card_number1, $digit);
                        }
                    } else {
                        $this->request->data['User']['card_number'] = $user_card_id;
                    }
                }
            }
            $this->request->data['User']['issue_date'] = $this->request->data['User']['from'];
            $this->request->data['User']['expire_date'] = $this->request->data['User']['to'];

            if ($this->User->save($this->request->data)) {

                $this->Session->setFlash('User information has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'provider_index'));
            } else {
                $this->Session->setFlash('User information could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
    }

    public function get_card_id($card_number1, $digit)
    {

        $user_card_id = $card_number1 . $digit;
        if ($this->User->query("select * from users where card_number = {$user_card_id}")) {
            $user_card_id = $this->get_card_id($card_number1, $digit - 1);
        } else {
            $user_card_id = $user_card_id;
        }

        return $user_card_id;
    }

}
