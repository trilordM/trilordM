<?php
/**
 * SMS component for CakePHP using SparrowSMS
 * @author Shashi Gharti <shashi.gharti@gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
App::uses('Component', 'Controller');

class SparrowSMSComponent extends Component
{
    /**
     * The username for the SparrowSMS API
     * @access public
     * @var string
     */
    var $api_user_name = "trilord";

    /**
     * The password for the SparrowSMS API
     * @access public
     * @var string
     */
    var $api_pass = "dSTrEtza";

    /**
     * Who will be shown as the sender of the text at the receivers handset.
     * @access public
     * @var string
     */
    var $api_from = 'trilordMARKET';

    /**
     * The user id for this product.
     * @access public
     * @var string
     */
    var $user_id = 'premium';

    /**
     * The SparrowSMS HTTP API url for sending GET or POST requests too.
     */
    const API_HTTP_URL = 'http://api.sparrowsms.com/call_in.php';


    /**
     * Send a message to SparrowSMS servers for the number provided
     * @param string $tel The telephone number.
     * @param string $message The text message to send to the handset.
     * @return string
     * @see SmsComponent::api_id
     * @see SmsComponent::api_user
     * @see SmsComponent::api_pass
     * @see SmsComponent::api_from
     */
    function sendSms($tel, $message)
    {
        $postdata = http_build_query(
            array(
                'client_id' => $this->user_id,
                'username' => $this->api_user_name,
                'password' => $this->api_pass,
                'from' => $this->from,
                'to' => $tel,
                'text' => $message
            )

        );
        $api_url = "http://api.sparrowsms.com/call_in.php?" . $postdata;
        $response = file_get_contents($api_url);

        return $response;
    }

}