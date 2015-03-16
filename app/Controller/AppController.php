<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' =>array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
            ),
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'scope' => array('User.status' => '1')
                )
            ),
            'authorize' => array('Controller') // Added this line
        ),
        'Useful'
    );

    public $ServiceProvider = array('users|provider_profile_page',
        'users|logout',
        'pages|invite_friend'

    );
    public $ServiceSeeker = array(
        'users|seeker_profile',
        'users|seeker_pic_edit',
        'users|seeker_edit',
        'users|change_password',
        'users|provider_rating',
        'testimonials|add',
        'Complains|add',
        'Reviews|add',
        'SeekerProviderRequests|add',
        'SeekerProviderRequests|cancel_request',
        'SeekerProviderRequests|service_history',
        'ServiceSeekerDeposits|deposit_history',
        'Complains|complain_history',
        'Reviews|review_history',
        'seeker_provider_requests|select',
        'SeekerProviderRequests|response',
        'SeekerProviderRequests|send_request',
        'seeker_provider_requests|response_enquire',
        'ServiceRequestRelays|seeker_request',
        'service_package_requests|add',
        //'pages|search_marketplace',
        'payments|paypal',
        'payments|bank_deposit',
        'payments|esewa_deposit',
        'payments|esewa_redirect',
        'payments|moco_deposit',
        'users|logout',
        'pages|invite_friend'
    );

    public function isAuthorized($user) {
        //provider

        if(isset($user['role']) && $user['role'] == 'ServiceProvider') :
            if (in_array($this->params['controller']."|".$this->params['action'],$this->ServiceProvider))
            {return true;}	else {return false;}
        endif;

        if(isset($user['role']) && $user['role'] == 'ServiceSeeker') :
            if (in_array($this->params['controller']."|".$this->params['action'],$this->ServiceSeeker))
            {return true;}	else {return false;}
        endif;

        // Admin can access every action
        if (isset($user['role']) && $user['role'] === 'admin') {
            return true;
        }

        // Default deny
        return false;
    }

    public function beforeFilter() {

        $this->Auth->allow('index', 'view','search_marketplace','provider','contact','provider_register','career','facebook_login');
        parent::beforeFilter();

        $this->layout = 'default';
        if (isset($this->params['layout']))
            $this->layout = $this->params['layout'];

        if(isset($this->request->params['admin']) && $this->request->params['admin']) {
            $this->layout = 'admin';
            if($this->Auth->user('role') == 'ServiceProvider' || $this->Auth->user('role') == 'ServiceSeeker'){
                $this->redirect(
                    array(
                        'admin'=>false,
                        'controller'=> $this->request->params['controller'],
                        'action'=>(str_replace('admin_','',$this->params['action']))
                    )
                );
            }

        }elseif(empty($this->request->params['admin'])){

            $menuItems = $this->_getMenu();

            $getPlace = $this->Useful->getPlaceSuggestionList();
            $getSearchjob = $this->Useful->getSearchjobSuggestionList();
            $settings = $this->_getSettings();
            $getPrivacyPolicy = $this->_getPrivacyPolicy();
            $this->set(compact('menuItems','getPlace','getSearchjob','settings','getPrivacyPolicy'));
        }


    }
    //get privacy policy
    private function _getPrivacyPolicy(){
        $this->loadModel('ContentPage');
        $getContents = $this->ContentPage->query("select title,slug from content_pages as ContentPage where id=8 and is_active=1");

        return $getContents;
    }
    //get menu navigation
    private function _getMenu(){
        $this->loadModel('ContentPages');
        $getAbout = $this->ContentPages->query("select title,slug from content_pages as ContentPage where id=1");
        $getContents = $this->ContentPages->query("select title,slug from content_pages as ContentPage where id!=1 and is_active=1");
        $data = array();
        $i=0;
        foreach($getContents as $content_page):

            $data['Contents'][$i]['slug'] = $content_page['ContentPage']['slug'];
            $data['Contents'][$i]['title'] = $content_page['ContentPage']['title'];
            $data['Contents'][$i]['url'] = SITE_URL.'contents/'.$content_page['ContentPage']['slug'];
            $i++;
        endforeach;
        $data['About'] = array('title'=>$getAbout[0]['ContentPage']['title'],'url'=>SITE_URL.'contents/'.$getAbout[0]['ContentPage']['slug']);

        return $data;
    }

    private function _getSettings(){
        $this->loadModel('PaypalSetting');
        $getSetting = $this->PaypalSetting->findById(1);;
        return $getSetting;
    }


}
