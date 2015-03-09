<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/9/15
 * Time: 7:55 PM
 */

App::uses('CakeEmail', 'Network/Email');

class Email {

    public function send($emailTo, $subject, $template, $vars = array(), $config = "default", $format = "html"){

        $Email = new CakeEmail();
        $Email->config($config);
        $Email->viewVars($vars);
        $Email->from(array(MAIL_FROM => COMPANY_NAME))
            ->to($emailTo)
            ->subject($subject)
            ->emailFormat($format)
            ->template($template, $template)
            ->send();

    }

}