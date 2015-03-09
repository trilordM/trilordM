<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email', 'SparrowSMS');

/**
 * SeekerProviderRequests Controller
 *
 * @property SeekerProviderRequest $SeekerProviderRequest
 * @property PaginatorComponent $Paginator
 */
class SeekerProviderRequestsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Useful', 'SparrowSMS');
    /**
     * @var string
     */
    private $companyName = '';

    /**
     *
     */
    public function beforeFilter()
    {

        parent::beforeFilter();
        $this->companyName = $this->Useful->getCompanyName();
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->SeekerProviderRequest->recursive = 0;
        $this->set('seekerProviderRequests', $this->Paginator->paginate());

    }

    //This action is used to view more service history in seeker profile
    /**
     * @param null $status
     */
    public function service_history($status = null)
    {
        //debug($status);die;
        $this->SeekerProviderRequest->recursive = 0;
        $page_title = "ServiceRequests > $status";

        if ($status == 'New') {
            $this->Paginator->settings = array('order' => array('created_date' => ' desc'), 'limit' => 6);
            $new = "class = 'active'";
        } elseif ($status == 'Completed') {
            $this->Paginator->settings = array('order' => array('completed_date' => ' desc'), 'limit' => 6);
            $completed = "class = 'active'";
        } elseif ($status == 'Assigned') {
            $this->Paginator->settings = array('order' => array('assigned_date' => ' desc'), 'limit' => 6);
            $assigned = "class = 'active'";
        }
        $service_history = $this->Paginator->paginate(array(
            'service_seeker_id' => $this->Auth->User('id'),
            'status' => $status
        ));

        $this->set('service_history', $service_history);
        $hideSearchBar = true;
        $this->set(compact('completed', 'new', 'assigned', 'status', 'page_title', 'hideSearchBar'));
    }

    /**
     * @param null $id
     * @param null $status
     */
    public function admin_service_history($id = null, $status = null)
    {
        $this->SeekerProviderRequest->recursive = 0;
        if ($status == 'New') {
            $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        } elseif ($status == 'Completed') {
            $this->Paginator->settings = array('order' => array('completed_date' => ' desc'));
        } else {
            $this->Paginator->settings = array('order' => array('assigned_date' => ' desc'));
        }
        //debug($this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));die;
        $this->set('service_history',
            $this->Paginator->paginate(array('service_seeker_id' => $id, 'status' => $status)));
        $this->set(compact('status'));
    }

    /**
     * @param null $id
     * @param null $status
     */
    public function provider_service_history($id = null, $status = null)
    {
        $this->SeekerProviderRequest->recursive = 0;
        if ($status == 'New') {
            $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        } elseif ($status == 'Completed') {
            $this->Paginator->settings = array('order' => array('completed_date' => ' desc'));
        } else {
            $this->Paginator->settings = array('order' => array('assigned_date' => ' desc'));
        }
        //debug($this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));die;

        $this->set('service_history',
            $this->Paginator->paginate(array('service_provider_id' => $id, 'status' => $status)));
        $this->set(compact('status'));
    }

    /**
     * @param null $id
     * @param null $status
     */
    public function admin_provider_service_history($id = null, $status = null)
    {
        $this->SeekerProviderRequest->recursive = 0;
        if ($status == 'New') {
            $this->Paginator->settings = array('order' => array('created_date' => ' desc'));
        } elseif ($status == 'Completed') {
            $this->Paginator->settings = array('order' => array('completed_date' => ' desc'));
        } else {
            $this->Paginator->settings = array('order' => array('assigned_date' => ' desc'));
        }
        //debug($this->Paginator->paginate(array('service_seeker_id'=>$this->Auth->User('id'))));die;

        $this->set('service_history',
            $this->Paginator->paginate(array('service_provider_id' => $id, 'status' => $status)));
        $this->set(compact('status'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->SeekerProviderRequest->exists($id)) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $options = array('conditions' => array('SeekerProviderRequest.' . $this->SeekerProviderRequest->primaryKey => $id));
        $this->set('seekerProviderRequest', $this->SeekerProviderRequest->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add($id = null, $previousId = null, $message = null)
    {

        if (isset($id)) {
            $this->request->data['SeekerProviderRequest']['service_provider_id'] = $id;
        }
        //debug($this->request->data['SeekerProviderRequest']['service_provider_id']);die;
        $this->request->data['SeekerProviderRequest']['service_seeker_id'] = $this->Auth->user('id');
        $this->request->data['SeekerProviderRequest']['created_date'] = date('Y-m-d H:i:s', time());
        //debug($this->request->data['SeekerProviderRequest']['created_date']);die;
        $this->request->data['SeekerProviderRequest']['status'] = 'New';
        if (isset($previousId)) {
            $this->request->data['SeekerProviderRequest']['previous_request_id'] = $previousId;
        }

        $rate = $this->SeekerProviderRequest->query("select RP.*,SPR.rate from rate_packages RP left join service_provider_rates SPR on SPR.rate_package_id=RP.id and SPR.user_id='{$id}' where RP.id is not null group by RP.id");
        $this->set(compact('provider', 'rate'));

        //$this->request->data['SeekerProviderRequest']['rate_pakages_id']=$this->request->data['SeekerProviderRequest']['opt'];
        //debug($this->request->data);die;
        if ($this->request->is('post')) {
            //debug($this->request->data);die;
            $this->request->data['SeekerProviderRequest']['flag'] = $this->request->data['SeekerProviderRequest']['payment_on_site'];


            $this->loadModel('User');

            $seeker_name = $this->User->field('name', array('id' => $this->Auth->User('id')));
            $seeker_email = $this->User->field('email', array('id' => $this->Auth->User('id')));

            $seeker_phone = $this->User->field('primary_phone', array('id' => $this->Auth->User('id')));
            $seeker_number = preg_replace("/[\s-]+/", "", trim($seeker_phone));

            $provider_name = $this->User->field('name', array('id' => $id));
            $provider_number = preg_replace("/[\s-]+/", "",
                trim($this->User->field('primary_phone', array('id' => $id))));


            $provider_category = $this->Useful->getUserCategory($id);
            if (!empty($provider_category)) {
                $provider_category = $provider_category[0]['service_categories']['title'];
            } else {
                $provider_category = '';
            }
            $time = date('Y-m-d H:i:s');
            $service_time = $this->request->data['SeekerProviderRequest']['requested_date'];
            $flag = '1';//Temporarily disabled: $this->request->data['SeekerProviderRequest']['flag'];

            if (array_key_exists("opt", $this->request->data['SeekerProviderRequest'])) {

                if ($this->request->data['SeekerProviderRequest']['opt'] != '') {
                    $a = $this->request->data['SeekerProviderRequest']['opt'];
                    $this->request->data['SeekerProviderRequest']['rate_package_id'] = $rate[$a]['RP']['id'];
                    $this->request->data['SeekerProviderRequest']['rate'] = $rate[$a]['SPR']['rate'];

                    if ($a == '0') {
                        $this->request->data['SeekerProviderRequest']['working_hour'] = $this->request->data['SeekerProviderRequest']['txtTime'];

                    } else {
                        if ($a == '1') {
                            $this->request->data['SeekerProviderRequest']['working_days'] = $this->request->data['SeekerProviderRequest']['txtTime'];
                        }
                    }
                    $this->request->data['SeekerProviderRequest']['requested_amount'] = $this->request->data['SeekerProviderRequest']['txtTotal'];
                    $remaining_amount = $this->Useful->CalculateAmount($this->Auth->user('id'));

                    if ($remaining_amount >= $this->request->data['SeekerProviderRequest']['requested_amount']) {
                        //debug($this->request->data);die;
                        $this->SeekerProviderRequest->create();
                        if ($this->SeekerProviderRequest->save($this->request->data)) {
                            $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                                'default', array('class' => 'success'));

                            $this->send_mailto_admin(MAIL_FROM, $seeker_name, $seeker_phone, $provider_category,
                                $provider_name, $time, $service_time);
                            $this->send_mailto_seeker($seeker_email, $seeker_name);

                            $seeker_mob_num = $this->Useful->checkMobileNumber($seeker_number);
                            $provider_mob_num = $this->Useful->checkMobileNumber($provider_number);

                            $text = "Namaskar, Tapaiko $provider_category sewako order $this->companyName  ma confirm bhayo. Haami tapailai samparka garney chau. Dhanyabaad! $this->companyName ";
                            $this->SparrowSMS->sendSMS($seeker_mob_num, $text);

                            $text = "Namaskar,Grahak le tapaiko sewa channu bhayeko cha.Tapailai haami aawashyak sewa barey samparka garchau. Dhanyabaad! $this->companyName ";
                            $this->SparrowSMS->sendSMS($provider_mob_num, $text);

                            $message = 'success';

                            return $this->redirect(array('action' => 'add', $id, $previousId, $message));
                        } else {
                            $this->Session->setFlash('The request could not be sent.Please, try again.', 'default',
                                array('class' => 'error-message'));

                            return $this->redirect(array('action' => 'add', $id, $previousId));
                        }
                    } elseif ($this->request->data['SeekerProviderRequest']['flag'] == '1') {
                        //debug($this->request->data);die;
                        $this->SeekerProviderRequest->create();
                        if ($this->SeekerProviderRequest->save($this->request->data)) {
                            $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                                'default', array('class' => 'success'));

                            $this->send_mailto_admin(MAIL_FROM, $seeker_name, $seeker_phone, $provider_category,
                                $provider_name, $time, $service_time);
                            $this->send_mailto_seeker($seeker_email, $seeker_name);

                            $seeker_mob_num = $this->Useful->checkMobileNumber($seeker_number);
                            $provider_mob_num = $this->Useful->checkMobileNumber($provider_number);

                            $text = "Namaskar, Tapaiko $provider_category sewako order $this->companyName ma confirm bhayo. Haami tapailai samparka garney chau. Dhanyabaad! $this->companyName ";
                            $this->SparrowSMS->sendSMS($seeker_mob_num, $text);

                            $text = "Namaskar,Grahak le tapaiko sewa channu bhayeko cha.Tapailai haami aawashyak sewa barey samparka garchau. Dhanyabaad! $this->companyName ";
                            $this->SparrowSMS->sendSMS($provider_mob_num, $text);

                            $message = 'success';

                            return $this->redirect(array('action' => 'add', $id, $previousId, $message));
                        } else {
                            $this->Session->setFlash('The request could not be sent. Please, try again.', 'default',
                                array('class' => 'error-message'));

                            return $this->redirect(array('action' => 'add', $id, $previousId));
                        }
                    } else {

                        $this->Session->setFlash('There is not enough amount in your deposit please check Pay in person to request for provider',
                            'default', array('class' => 'error-message'));

                        return $this->redirect(array('action' => 'add', $id, $previousId));
                    }
                } else {
                    $this->Session->setFlash('The request could not be sent. Please try again.', 'default',
                        array('class' => 'error-message'));
                }
            } elseif ($flag == '1') {
                //debug($this->request->data);die;
                $this->SeekerProviderRequest->create();
                if ($this->SeekerProviderRequest->save($this->request->data)) {
                    //debug($this->request->data);die;
                    $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                        'default', array('class' => 'success'));

                    $this->send_mailto_admin(MAIL_FROM, $seeker_name, $seeker_phone, $provider_category, $provider_name,
                        $time, $service_time);
                    $policy = SITE_URL . 'contents/Privacy_policy';
                    $emailVars = array(
                        'company_name' => COMPANY_NAME,
                        'email' => $seeker_email,
                        'name' => $seeker_name,
                        'policy' => $policy,
                        'company_email' => MAIL_FROM
                    );

                    //$this->send_mailto_seeker($seeker_email, $seeker_name);
                    $this->Useful->sendEmail($seeker_email, "Thank You", 'mailtoseeker', $emailVars);


                    $seeker_mob_num = $this->Useful->checkMobileNumber($seeker_number);

                    $provider_mob_num = $this->Useful->checkMobileNumber($provider_number);

                    $text = "Namaskar, Tapaiko $provider_category sewako order $this->companyName ma confirm bhayo. Haami tapailai samparka garney chau. Dhanyabaad! $this->companyName";
                    $this->SparrowSMS->sendSMS($seeker_mob_num, $text);

                    $text = "Namaskar,Grahak le tapaiko sewa channu bhayeko cha.Tapailai haami aawashyak sewa barey samparka garchau. Dhanyabaad! $this->companyName";
                    $this->SparrowSMS->sendSMS($provider_mob_num, $text);

                    $message = 'success';

                    return $this->redirect(array('action' => 'add', $id, $previousId, $message));
                } else {
                    $this->Session->setFlash('The request could not be sent. Please, try again.', 'default',
                        array('class' => 'error-message'));

                    return $this->redirect(array('action' => 'add', $id, $previousId));
                }
            } else {

                $this->Session->setFlash('The request could not be sent. Please try again.', 'default',
                    array('class' => 'error-message'));
            }
        }
        $ratePackages = $this->SeekerProviderRequest->RatePackage->find('list');

        $provider_rates = $this->SeekerProviderRequest->query("SELECT * FROM `service_provider_rates` WHERE user_id='$id'");
        $hideSearchBar = true;
        $this->set(compact('hideSearchBar', 'serviceSeekers', 'serviceProviders', 'ratePackages', 'provider_rates'));
    }

    /**
     * @param null $trilord_mail
     * @param null $seeker_name
     * @param null $seeker_phone
     * @param null $provider_category
     * @param null $provider_name
     * @param null $time
     * @param null $service_time
     */
    private function send_mailto_admin(
        $trilord_mail = null,
        $seeker_name = null,
        $seeker_phone = null,
        $provider_category = null,
        $provider_name = null,
        $time = null,
        $service_time = null
    ) {

        $this->autoRender = false;
        $to = $trilord_mail;
        $from = MAIL_FROM;
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'trilord_email' => $trilord_mail,
            'seeker_name' => $seeker_name,
            'seeker_phone' => $seeker_phone,
            'provider_category' => $provider_category,
            'provider_name' => $provider_name,
            'time' => $time,
            'service_time' => $service_time
        ));
        $Email->from(array($from => $this->Useful->getCompanyName()))
            ->to($to)
            ->subject('Requested Service')
            ->emailFormat('html')
            ->viewVars(array('company_name' => $this->Useful->getCompanyName()))
            ->template('notification', 'notification')
            ->send();
    }


    /**
     * @param null $seeker_email
     * @param null $seeker_name
     */
    private function send_mailto_seeker($seeker_email = null, $seeker_name = null)
    {
        $policy = SITE_URL . 'contents/Privacy_policy';
        $user_agreement = '';
        $trilord_mail = 'email@trilordmarket.com';
        $this->autoRender = false;
        $to = $seeker_email;
        $from = MAIL_FROM;
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'company_name' => $this->Useful->getCompanyName(),
            'trilord_email' => $trilord_mail,
            'seeker_name' => $seeker_name,
            'policy' => $policy,
            'user_agreement' => $user_agreement
        ));
        $Email->from(array($from => $this->Useful->getCompanyName()))
            ->to($to)
            ->subject('Thank you')
            ->emailFormat('html')
            ->template('mailtoseeker', 'mailtoseeker')
            ->send();
    }


    /**
     * @param null $message
     */
    public function send_request($message = null)
    {

        $this->request->data['SeekerProviderRequest']['service_seeker_id'] = $this->Auth->user('id');
        $this->request->data['SeekerProviderRequest']['created_date'] = date('Y-m-d H:i:s');
        $this->request->data['SeekerProviderRequest']['status'] = 'New';


        if ($this->request->is('post')) {

            $this->loadModel('User');
            $seeker_name = $this->User->field('name', array('id' => $this->Auth->User('id')));
            $seeker_email = $this->User->field('email', array('id' => $this->Auth->User('id')));

            $seeker_phone = $this->User->field('primary_phone', array('id' => $this->Auth->User('id')));
            $time = date('Y-m-d H:i:s');
            $service_time = $this->request->data['SeekerProviderRequest']['requested_date'];

            $this->SeekerProviderRequest->create();
            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                    'default', array('class' => 'success'));

                $this->send_mailto_trilord(MAIL_FROM, $seeker_name, $seeker_phone, $time, $service_time);
                $this->send_mailto_seeker($seeker_email, $seeker_name);

                $message = 'success';

                return $this->redirect(array('action' => 'send_request', $message));
            } else {
                $this->Session->setFlash('The request could not be sent. Please, try again.', 'default',
                    array('class' => 'error-message'));

                return $this->redirect(array('action' => 'send_request'));
            }

        }

    }

    /**
     * @param null $trilord_mail
     * @param null $seeker_name
     * @param null $seeker_phone
     * @param null $time
     * @param null $service_time
     */
    private function send_mailto_trilord(
        $trilord_mail = null,
        $seeker_name = null,
        $seeker_phone = null,
        $time = null,
        $service_time = null
    ) {

        $this->autoRender = false;
        $to = $trilord_mail;
        $from = MAIL_FROM;
        $Email = new CakeEmail();
        $Email->config('default');
        $Email->viewVars(array(
            'company_name' => $this->Useful->getCompanyName(),
            'trilord_email' => $trilord_mail,
            'seeker_name' => $seeker_name,
            'seeker_phone' => $seeker_phone,
            'time' => $time,
            'service_time' => $service_time
        ));
        $Email->from(array($from => $this->Useful->getCompanyName()))
            ->to($to)
            ->subject('Requested Service')
            ->emailFormat('html')
            ->template('notify', 'notify')
            ->send();
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
        $this->SeekerProviderRequest->id = $id;
        if (!$this->SeekerProviderRequest->exists()) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->SeekerProviderRequest->delete()) {
            $this->Session->setFlash('The seeker provider request has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The seeker provider request could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }


    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index($request_id = null)
    {

        $this->loadModel('ServiceCategory');
        $serviceCategories = $this->ServiceCategory->generateTreeList(null, null, null, '&nbsp;&nbsp;&nbsp;');
        $this->set(compact('categories', 'serviceCategories'));
        //debug($this->params->query);exit;

        $this->Paginator->settings = array('order' => array('SeekerProviderRequest.created_date' => ' desc'));
        if (!empty($this->params->query)) {

            $requested = $this->params->query['requested'];
            $Category = $this->params->query['category'];
            $status = $this->params->query['Status'];
            $type = $this->params->query['type'];
            $conditions[] = array();

            if (!empty($requested)) {
                $conditions[] = array('SeekerProviderRequest.requested_date' => $requested);
            }
            if (!empty($Category)) {

                $serviceCategories = $this->SeekerProviderRequest->query("SELECT GROUP_CONCAT(provider_service_categories.user_id) UserId FROM provider_service_categories where provider_service_categories.service_categories_id={$Category}");

                if (!empty($serviceCategories[0][0]['UserId'])) {
                    $conditions[] = array('SeekerProviderRequest.service_provider_id IN (' . $serviceCategories[0][0]['UserId'] . ')');
                } else {
                    $conditions[] = array('SeekerProviderRequest.service_provider_id' => '0');
                }
            }
            if (!empty($status)) {
                $conditions[] = array('SeekerProviderRequest.status' => $status);
            }
            if ($type == 'export') {
                $this->layout = false;
                $this->autoRender = false;
                $seekerProviderRequests = $this->SeekerProviderRequest->find('all',
                    array('conditions' => array($conditions)));
                $this->set(compact('seekerProviderRequests'));
                $this->render('/Elements/seeker_provider_request_record');

                //debug($conditions);die;

            }
            //debug($conditions);
            $this->Paginator->settings = array(
                'conditions' => array($conditions),
                'order' => array('SeekerProviderRequest.created_date' => ' desc')
            );
            //$this->SeekerProviderRequest->recursive = 0;
            //$this->set('seekerProviderRequests',$this->Paginator->paginate('SeekerProviderRequest',$conditions));

        } else {
            $requested = "";
            $Category = "";
            $status = "";
            $type = "";


            //$this->SeekerProviderRequest->recursive = 0;
            //$this->set('seekerProviderRequests', $this->Paginator->paginate());

        }

        $this->SeekerProviderRequest->recursive = 0;

        if ($request_id) {
            //$seekerProviderRequests=$this->SeekerProviderRequest->find('first',array('conditions'=>array('SeekerProviderRequest.id'=>$request_id)));
            $seekerProviderRequests = $this->Paginator->paginate(array('SeekerProviderRequest.id' => $request_id));
        } else {
            $seekerProviderRequests = $this->Paginator->paginate();
        }
        $this->set(compact('seekerProviderRequests', 'requested', 'Category', 'status'));

    }


    /**
     * @param null $to
     */
    public function select($to = null)
    {
        //debug($to);die;
        //$this->SeekerProviderRequest->id = $id;
        //debug($_POST['request_id']);die;
        $this->autoRender = false;
        $this->layout = false;
        if ($this->request->is('ajax')) {
            $this->SeekerProviderRequest->id = $this->request->data['request_id'];
            $provider_id = $this->SeekerProviderRequest->field('service_provider_id',
                array('id' => $this->SeekerProviderRequest->id));
            //debug($this->SeekerProviderRequest->id);die;
            if (!$this->SeekerProviderRequest->exists()) {
                throw new NotFoundException(__('Invalid provider request'));
            }

            $this->request->data['SeekerProviderRequest']['id'] = $this->request->data['request_id'];
            $this->request->data['SeekerProviderRequest']['flag'] = $this->request->data['name'];
            //debug($this->Auth->user('id'));die;


            if ($to == 'accept') {
                $this->request->data['SeekerProviderRequest']['status'] = "Assigned";
                $this->request->data['SeekerProviderRequest']['reply_flag'] = '0';

                $this->request->data['SeekerProviderRequest']['assigned_date'] = date('Y-m-d');
                $this->request->data['SeekerProviderRequest']['requested_amount'] = $this->SeekerProviderRequest->field('total');
                //debug($this->request->data);die;

                $remaining_amount = $this->Useful->CalculateAmount($this->Auth->user('id'));


                if ($remaining_amount >= $this->request->data['SeekerProviderRequest']['requested_amount']) {


                    $this->SeekerProviderRequest->create();

                    if ($this->SeekerProviderRequest->save($this->request->data)) {

                        $this->loadModel('User');

                        $sms_details = $this->User->query("select sms_username,sms_password,sms_sender_id,sms_is_active from paypal_settings where id ='1'");


                        $provider_phone = $this->User->field('primary_phone', array('id' => $provider_id));


                        //$category=$this->Useful->getUserCategory($provider_id);
                        //$category=$category[0]['service_categories']['title'];

                        $provider_number = preg_replace("/[\s-]+/", "", trim($provider_phone));

                        $provider_mob_num = '';

                        if (is_numeric($provider_number)) {
                            $num_digit = strlen($provider_number);
                            if ($num_digit == 10) {
                                $digit = substr($provider_number, 0, 2);
                                if ($digit == '98') {
                                    $provider_mob_num = $provider_number;
                                }
                            }
                            if ($num_digit == 13) {
                                $digit = substr($provider_number, 0, 5);
                                if ($digit == '97798') {
                                    $provider_mob_num = $provider_number;
                                }
                            }
                        }

                        if ($sms_details[0]['paypal_settings']['sms_is_active']) {

                            //prepare necessary parameters
                            $client_id = $sms_details[0]['paypal_settings']['sms_sender_id'];
                            $username = $sms_details[0]['paypal_settings']['sms_username'];
                            $password = $sms_details[0]['paypal_settings']['sms_password'];

                            $to_provider = $provider_mob_num;

                            $text_to_provider = 'Namaskar,Grahak le tapaiko sewa channu bhayeko cha.Tapailai haami aawashyak sewa barey samparka garchau. Dhanyabaad,' . $this->Useful->getCompanyName() . '.';
                            // build the url
                            if (!empty($provider_mob_num)) {
                                $api_url_provider = "http://api.sparrowsms.com/call_in.php?" .
                                    http_build_query(array(
                                        "client_id" => $client_id,
                                        "username" => $username,
                                        "password" => $password,
                                        "to" => $to_provider,
                                        "text" => $text_to_provider
                                    ));

                                // put the request to server

                                $response2 = file_get_contents($api_url_provider);
                            } else {
                                $this->Session->setFlash('SMS could not be sent to Service Provider.', 'default',
                                    array('class' => 'error-message'));
                            }
                            //check the response and verify
                            //print_r($response);
                        } else {
                            $this->Session->setFlash('SMS could not be sent.', 'default',
                                array('class' => 'error-message'));
                        }
                        //debug($this->request->data);die;
                        $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                            'default', array('class' => 'success'));

                        //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                    } else {
                        $this->Session->setFlash('The request could not be sent.Please, try again.', 'default',
                            array('class' => 'error-message'));

                        //$this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                    }
                } elseif ($this->request->data['SeekerProviderRequest']['flag'] == '1') {
                    $this->SeekerProviderRequest->create();
                    if ($this->SeekerProviderRequest->save($this->request->data)) {

                        $this->loadModel('User');

                        $sms_details = $this->User->query("select sms_username,sms_password,sms_sender_id,sms_is_active from paypal_settings where id ='1'");
                        //$user_phone=$this->User->query("select group_concat(primary_phone) primary_phone from users where id='$seeker_id'or id='$provider_id'");

                        $provider_phone = $this->User->field('primary_phone', array('id' => $provider_id));


                        $category = $this->Useful->getUserCategory($provider_id);
                        $category = $category[0]['service_categories']['title'];
                        //debug($seeker_phone);
                        //debug($category);die;

                        $provider_number = preg_replace("/[\s-]+/", "", trim($provider_phone));

                        if ($sms_details[0]['paypal_settings']['sms_is_active']) {

                            //prepare necessary parameters
                            $client_id = $sms_details[0]['paypal_settings']['sms_sender_id'];
                            $username = $sms_details[0]['paypal_settings']['sms_username'];
                            $password = $sms_details[0]['paypal_settings']['sms_password'];

                            $to_provider = $provider_number;

                            $text_to_provider = "Namaskar, Grahak le tapaiko sewa channu bhayeko cha.Tapailai haami aawashyak sewa barey samparka garchau. Dhanyabaad, $this->companyName.";
                            // build the url

                            $api_url_provider = "http://api.sparrowsms.com/call_in.php?" .
                                http_build_query(array(
                                    "client_id" => $client_id,
                                    "username" => $username,
                                    "password" => $password,
                                    "to" => $to_provider,
                                    "text" => $text_to_provider
                                ));

                            // put the request to server

                            $response2 = file_get_contents($api_url_provider);
                            //check the response and verify
                            //print_r($response);
                        } else {
                            $this->Session->setFlash('SMS could not be sent.', 'default',
                                array('class' => 'error-message'));
                        }

                        $this->Session->setFlash('The request has been sent successfully. We will respond to your request at the earliest time possible.',
                            'default', array('class' => 'success'));

                        //$this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                    } else {
                        $this->Session->setFlash('The request could not be sent.Please, try again.', 'default',
                            array('class' => 'error-message'));

                        //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                    }
                } else {

                    echo 1;

                    //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));

                }


            } elseif ($to == 'decline') {

                $this->request->data['SeekerProviderRequest']['status'] = "Withheld";
                $this->request->data['SeekerProviderRequest']['reply_flag'] = '0';

                //debug($this->request->data);die;
                if ($this->SeekerProviderRequest->save($this->request->data)) {

                    //debug($this->request->data);die;

                    $this->Session->setFlash('Success.', 'default', array('class' => 'success'));
                    //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                } else {
                    $this->Session->setFlash('Please, try again.', 'default', array('class' => 'error-message'));

                    //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));
                }

            }

            //return $this->redirect(array('controller'=>'seeker_provider_requests','action' => 'response_enquire'));

        }


        /*
        $this->SeekerProviderRequest->recursive = 0;
        $this->request->data = $this->SeekerProviderRequest->find('first',array('fields'=>array('SeekerProviderRequest.status','SeekerProviderRequest.reply_flag','SeekerProviderRequest.total'),'conditions'=>array('SeekerProviderRequest.id'=>$id)));


        $this->request->onlyAllow('post', 'delete');*/


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
        if (!$this->SeekerProviderRequest->exists($id)) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $options = array('conditions' => array('SeekerProviderRequest.' . $this->SeekerProviderRequest->primaryKey => $id));
        $this->set('seekerProviderRequest', $this->SeekerProviderRequest->find('first', $options));
    }

    /**
     * admin_add method
     *
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->SeekerProviderRequest->create();
            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('The seeker provider request has been saved.', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The seeker provider request could not be saved. Please, try again.',
                    'default', array('class' => 'error-message'));
            }
        }
        $ratePackages = $this->SeekerProviderRequest->RatePackage->find('list');
        $this->set(compact('serviceSeekers', 'serviceProviders', 'ratePackages'));
    }


    /**
     * @param null $id
     */
    public function cancel_request($id = null)
    {
        $this->SeekerProviderRequest->id = $id;
        if (!$this->SeekerProviderRequest->exists()) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $this->request->onlyAllow('post', 'delete');
        $this->request->data['SeekerProviderRequest']['status'] = "Canceled";

        if ($this->SeekerProviderRequest->save($this->request->data)) {
            $this->Session->setFlash('The request has been canceled.', 'default', array('class' => 'success'));
            $this->redirect(array('controller' => 'users', 'action' => 'seeker_profile'));
        } else {
            $this->Session->setFlash('Unable to cancel request. Please, try again.', 'default',
                array('class' => 'error-message'));
            $this->redirect(array('controller' => 'users', 'action' => 'seeker_profile'));
        }
    }


    /**
     * @param null $id
     * @param null $number
     * @param null $seeker_id
     * @param null $provider_id
     */
    public function admin_verify($id = null, $number = null, $seeker_id = null, $provider_id = null)
    {

        $this->SeekerProviderRequest->id = $id;
        if (!$this->SeekerProviderRequest->exists()) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $this->request->onlyAllow('post', 'delete');
        $this->request->data['SeekerProviderRequest']['Assigned_by'] = $this->Auth->user('id');
        if ($number == '1') {
            $this->request->data['SeekerProviderRequest']['assigned_date'] = date('Y-m-d');

            $this->request->data['SeekerProviderRequest']['status'] = "Assigned";
            if ($this->SeekerProviderRequest->field('requested_amount') != '0') {
                $this->request->data['SeekerProviderRequest']['freeze_amount'] = $this->SeekerProviderRequest->field('requested_amount');
            } else {
                $this->request->data['SeekerProviderRequest']['freeze_amount'] = $this->SeekerProviderRequest->field('total');
            }

            $this->request->data['SeekerProviderRequest']['requested_amount'] = "";


            if ($this->SeekerProviderRequest->save($this->request->data)) {

                $this->loadModel('User');

                $this->Session->setFlash('Successfully assigned a request.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Please, try again.', 'default', array('class' => 'error-message'));
            }


        } elseif ($number == '2') {
            $this->request->data['SeekerProviderRequest']['completed_date'] = date('Y-m-d');

            $this->request->data['SeekerProviderRequest']['status'] = "Completed";
            $this->request->data['SeekerProviderRequest']['completion_amount'] = $this->SeekerProviderRequest->field('freeze_amount');
            $this->request->data['SeekerProviderRequest']['freeze_amount'] = "";

            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('Successfully completed a requested service', 'default',
                    array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Please, try again.', 'default', array('class' => 'error-message'));
            }

        } elseif ($number == '3') {

            $this->request->data['SeekerProviderRequest']['status'] = "withdraw";
            $this->request->data['SeekerProviderRequest']['completion_amount'] = "";
            $this->request->data['SeekerProviderRequest']['freeze_amount'] = "";
            $this->request->data['SeekerProviderRequest']['requested_amount'] = "";

            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('Request has been withdrawed.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Please, try again.', 'default', array('class' => 'error-message'));
            }
        }

        return $this->redirect(array('action' => 'index'));

    }

    /**
     * @param null $id
     * @param null $number
     */
    public function admin_request_lock($id = null, $number = null)
    {
        $this->SeekerProviderRequest->id = $id;
        if (!$this->SeekerProviderRequest->exists()) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($number == '1') {
            $this->request->data['SeekerProviderRequest']['locked_by'] = $this->Auth->user('id');

            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('Request has been locked.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to lock the request.', 'default', array('class' => 'error-message'));
            }
        } elseif ($number == '2') {
            $this->request->data['SeekerProviderRequest']['locked_by'] = "";

            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('Request has been unlocked.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to unlock the request.', 'default', array('class' => 'error-message'));
            }
        }

        //debug($this->request->data);die;

        return $this->redirect(array('action' => 'index'));

    }


    /**
     *
     */
    public function response_enquire()
    {
        $id = $this->Auth->User('id');
        $this->Paginator->settings = array('order' => array('SeekerProviderRequest.created_date' => 'desc'));
        //debug($this->Paginator->paginate());die;
        $this->SeekerProviderRequest->recursive = 0;
        $this->set('ProviderRequest', $this->Paginator->paginate(array(
            'SeekerProviderRequest.service_seeker_id' => $id,
            'SeekerProviderRequest.reply_flag' => '1'
        )));
        $hideSearchBar = true;
        $active_response_enquire = "active";
        $page_title = "Response Enquiry";
        $this->set(compact('hideSearchBar', 'active_response_enquire', 'page_title'));
    }

    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_reply($id = null)
    {
        if (!$this->SeekerProviderRequest->exists($id)) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['SeekerProviderRequest']['Assigned_by'] = $this->Auth->User('id');
            $this->request->data['SeekerProviderRequest']['service_provider_id'] = $this->request->data['SeekerProviderRequest']['provider'];
            $this->request->data['SeekerProviderRequest']['reply_flag'] = '1';
            $this->request->data['SeekerProviderRequest']['response_date'] = date('Y-m-d H:i:s');;
            //debug($this->request->data);die;
            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('The request has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The request could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('SeekerProviderRequest.' . $this->SeekerProviderRequest->primaryKey => $id));
            $this->request->data = $this->SeekerProviderRequest->find('first', $options);
            $Provider = $this->Useful->provider_name($this->request->data['SeekerProviderRequest']['service_provider_id']);
            //debug($this->request->data);die;
        }

        $ratePackages = $this->SeekerProviderRequest->RatePackage->find('list');


        $getProvider = $this->Useful->getSuggestionList();
        $this->set('provider_name', $Provider);
        $this->set(compact('serviceSeekers', 'serviceProviders', 'ratePackages', 'getProvider'));
    }


    /**
     * @param null $id
     */
    public function admin_edit($id = null)
    {
        if (!$this->SeekerProviderRequest->exists($id)) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['SeekerProviderRequest']['Assigned_by'] = $this->Auth->User('id');
            //debug($this->request->data);die;
            if ($this->SeekerProviderRequest->save($this->request->data)) {
                $this->Session->setFlash('The request has been saved.', 'default', array('class' => 'success'));

                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The request could not be saved. Please, try again.', 'default',
                    array('class' => 'error-message'));
            }
        } else {
            $options = array('conditions' => array('SeekerProviderRequest.' . $this->SeekerProviderRequest->primaryKey => $id));
            $this->request->data = $this->SeekerProviderRequest->find('first', $options);
        }

        $ratePackages = $this->SeekerProviderRequest->RatePackage->find('list');


        $this->set(compact('serviceSeekers', 'serviceProviders', 'ratePackages'));
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
        $this->SeekerProviderRequest->id = $id;
        if (!$this->SeekerProviderRequest->exists()) {
            throw new NotFoundException(__('Invalid seeker provider request'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->SeekerProviderRequest->delete()) {
            $this->Session->setFlash('The seeker provider request has been deleted.', 'default',
                array('class' => 'success'));
        } else {
            $this->Session->setFlash('The seeker provider request could not be deleted. Please, try again.', 'default',
                array('class' => 'error-message'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}