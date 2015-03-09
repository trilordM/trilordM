<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/9/15
 * Time: 10:13 AM
 */


App::uses('CakeEventListener', 'Event');
App::uses('Email', 'Lib');

class UserListener implements CakeEventListener
{

    /**
     * @return array
     */
    public function implementedEvents()
    {
        return array(
            'Repository.User.registered' => 'sendActivationEmail'
        );
    }

    /**
     * @param CakeEvent $event
     */
    public function sendActivationEmail(CakeEvent $event)
    {

        $email = $event->data['data']['email'];
        $usercode = $event->data['data']['registration_code'];
        $name = $event->data['data']['name'];
        $link = SITE_URL . 'users/confirm_message?email=' . base64_encode($email) . '&code=' . $usercode;
        $policy = SITE_URL . 'contents/Privacy_policy';
        $emailVars = array(
            'company_name' => COMPANY_NAME,
            'verify_code' => $link,
            'username' => $email,
            'name' => $name,
            'policy' => $policy
        );
        $emailUser = new Email();
        $emailUser->send($email, "Account Activation with " . COMPANY_NAME, 'signup', $emailVars);
    }


}