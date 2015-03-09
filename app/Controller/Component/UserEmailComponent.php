<?php
/**
 * Created by PhpStorm.
 * User: shashi
 * Date: 3/9/15
 * Time: 3:42 PM
 */
App::uses('Component', 'Controller');
class UserEmailComponent extends Component{
    /**
     * @param $emailTo
     * @param $subject
     * @param $template
     * @param array $vars
     * @param string $config
     * @param string $format
     */

    public function send($emailTo, $subject, $template, $vars = array(), $config = "default", $format = "html"){

        $Email = new CakeEmail(array('log' => true));
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