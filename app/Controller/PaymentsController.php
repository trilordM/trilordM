<?php
App::uses('AppController', 'Controller');
/**
 * Payment Controller
 *
 * @property Testimonial $Testimonial
 * @property PaginatorComponent $Paginator
 */
class PaymentsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Useful');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('esewa_success','notify_url','moco_redirect');
	}

/*
Get User Ip
*/
	private function _get_ip() {
		$ip = $_SERVER['REMOTE_ADDR'];
	 
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	 
		return $ip;
	}
	 

/**
 * paypal method
 * exoress checkout via credit card
 * @return void
 */
	public function paypal($id=null) {
		
		App::uses('Paypal', 'Paypal.Lib');
		
		$this->loadModel('PaypalSetting');
		$paypalInfo = $this->PaypalSetting->find('first',array('conditions'=>array('PaypalSetting.id'=>1)));
		
		$this->Paypal = new Paypal(array(
			'sandboxMode' => $paypalInfo['PaypalSetting']['status'],
			'nvpUsername' => $paypalInfo['PaypalSetting']['paypal_username'],
			'nvpPassword' => $paypalInfo['PaypalSetting']['paypal_password'],
			'nvpSignature' => $paypalInfo['PaypalSetting']['paypal_signature']
		));
		
		$USD_Rate = $this->Useful->getMaxUSDDate();
		$get_ip = $this->_get_ip();
		if ($this->request->is('post')) {
			if ($this->Payment->validates($this->request->data)) {
				//echo 'here';exit;
				/*$nrs_amount = $this->request->data['Payment']['amount'] * $USD_Rate;
				$this->Payment->query('insert into service_seeker_deposits
												(user_id,deposited_date,amount_usd,amount_nrs,amount_medium,status)
												VALUES(
												"'.$this->Auth->user('id').'",
												"'.date('Y-m-d').'",
												"'.addslashes($this->request->data['Payment']['amount']).'",
												"'.addslashes($nrs_amount).'",
												"Paypal",
												"New Paypal"
											)');
				$lastInsertId = $this->Payment->query('select last_insert_id() as id');*/
				
				$payment = array(
					'amount' => $this->request->data['Payment']['amount'],
					'card' => $this->request->data['Payment']['credit_card_number'], // This is a sandbox CC
					'expiry' => array(
						'M' => $this->request->data['Payment']['card_expiry_month'],
						'Y' => $this->request->data['Payment']['card_expiry_year'],
					),
					'cvv' => $this->request->data['Payment']['cvv'],
					'currency' => 'USD', // Defaults to GBP if not provided
					//'notifyurl' => SITE_URL.'payments/notify_url',
					//'custom' => $lastInsertId[0][0]['id']
					
				);
				
				
				try {
					$payment_return = $this->Paypal->doDirectPayment($payment);
					//debug($payment_return);exit;
					if($payment_return['ACK']==='Success'){
						
						$nrs_amount = $this->request->data['Payment']['amount'] * $USD_Rate;
						
						$this->Payment->query('insert into service_seeker_deposits
												(user_id,deposited_date,amount_usd,amount_nrs,amount_medium,transactionId,transaction_date,status)
												VALUES(
												"'.$this->Auth->user('id').'",
												"'.date('Y-m-d').'",
												"'.addslashes($this->request->data['Payment']['amount']).'",
												"'.addslashes($nrs_amount).'",
												"Paypal",
												"'.addslashes($payment_return['TRANSACTIONID']).'",
												"'.addslashes($payment_return['TIMESTAMP']).'",
												"Success"
											)');
						$this->Session->setFlash('Total payment of '.$this->request->data['Payment']['amount'].' USD has been made successfully.','default',array('class'=>'success'));
						$this->redirect(array('action' => 'paypal'));
					}
					//debug($payment_return);
					//exit;
				} catch (Exception $e) {
					//debug($e->getMessage());
					$this->Session->setFlash(__($e->getMessage()));
				} 
			}else{
				$this->Session->setFlash('The request could not be completed at the moment. Please, try again.','default',array('class'=>'error-message'));
			}
		}
		
	}

	public function notify_url(){
		$this->layout = false;
		$this->autoRender = false;
		/*$this->Payment->query('insert into service_seeker_deposits
													(status)
													VALUES(
													"Here"
												)');*/
		// STEP 1: read POST data

		// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
		// Instead, read raw POST data from the input stream. 
		$raw_post_data = file_get_contents('php://input');
		  $this->Payment->query('insert into service_seeker_deposits
													(test_data)
													VALUES(
													"'.$raw_post_data.'"
												)');		
		$raw_post_array = explode('&', $raw_post_data);
		$myPost = array();
		foreach ($raw_post_array as $keyval) {
		  $keyval = explode ('=', $keyval);
		  if (count($keyval) == 2)
			 $myPost[$keyval[0]] = urldecode($keyval[1]);
		}
		// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
		$req = 'cmd=_notify-validate';
		if(function_exists('get_magic_quotes_gpc')) {
		   $get_magic_quotes_exists = true;
		} 
		foreach ($myPost as $key => $value) {        
		   if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
				$value = urlencode(stripslashes($value)); 
		   } else {
				$value = urlencode($value);
		   }
		   $req .= "&$key=$value";
		}
		
		 $this->Payment->query('insert into service_seeker_deposits
													(test_data)
													VALUES(
													"'.$req.'"
												)');		
		
		// STEP 2: POST IPN data back to PayPal to validate
		
		$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');
		curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
		
		// In wamp-like environments that do not come bundled with root authority certificates,
		// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
		// the directory path of the certificate as shown below:
		// curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		if( !($res = curl_exec($ch)) ) {
			// error_log("Got " . curl_error($ch) . " when processing IPN data");
			curl_close($ch);
			exit;
		}
		curl_close($ch);
		 
		
		// STEP 3: Inspect IPN validation result and act accordingly
		
		if (strcmp ($res, "VERIFIED") == 0) {
			
			$this->Payment->query('insert into service_seeker_deposits
													(test_data)
													VALUES(
													"Verified"
												)');
			// The IPN is verified, process it:
			// check whether the payment_status is Completed
			// check that txn_id has not been previously processed
			// check that receiver_email is your Primary PayPal email
			// check that payment_amount/payment_currency are correct
			// process the notification
		
			// assign posted variables to local variables
			$item_name = $_POST['item_name'];
			$item_number = $_POST['item_number'];
			$payment_status = $_POST['payment_status'];
			$payment_amount = $_POST['mc_gross'];
			$payment_currency = $_POST['mc_currency'];
			$txn_id = $_POST['txn_id'];
			$receiver_email = $_POST['receiver_email'];
			$payer_email = $_POST['payer_email'];
		
			// IPN message values depend upon the type of notification sent.
			// To loop through the &_POST array and print the NV pairs to the screen:
			foreach($_POST as $key => $value) {
			  echo $key." = ". $value."<br>";
			}
			$this->Payment->query('update service_seeker_deposits
									set transaction_id="'.addslashes($txn_id).'",
									status = "Success"
									where id = "'.$_POST['custom'].'"
												)');
			$this->Payment->query('insert into service_seeker_deposits
													(test_data)
													VALUES(
													"'.$_POST.'"
												)');									
			 
		} else if (strcmp ($res, "INVALID") == 0) {
			// IPN invalid, log for manual investigation
			echo "The response from IPN was: <b>" .$res ."</b>";
			$this->Payment->query('insert into service_seeker_deposits
													(test_data)
													VALUES(
													"UnVerified"
												)');
		}
	
	}

/**
 * bank method
 * 
 * @return void
 */	
	public function bank_deposit(){
		if ($this->request->is('post')) {
			if ($this->Payment->validates($this->request->data)) {
				//debug($this->request->data);exit;
				if($this->request->data['Payment']['currency']==='USD'){
					$USD_Rate = $this->Useful->getMaxUSDDate();
					$nrs_amount = $this->request->data['Payment']['amount'] * $USD_Rate;	
					$usd_amount = $this->request->data['Payment']['amount'];	
				}else{
					$nrs_amount = $this->request->data['Payment']['amount'];
					$usd_amount = '';	
				}
				$deposited_date = $this->request->data['Payment']['deposited_date']['year'].'-'.$this->request->data['Payment']['deposited_date']['month'].'-'.$this->request->data['Payment']['deposited_date']['day'];
				$this->Payment->query('insert into service_seeker_deposits
												(user_id,deposited_date,amount_usd,amount_nrs,amount_medium,deposited_bank,bank_location,deposited_by,currency,status)
												VALUES(
												"'.$this->Auth->user('id').'",
												"'.$deposited_date.'",
												"'.addslashes($usd_amount).'",
												"'.addslashes($nrs_amount).'",
												"Bank Deposit",
												"'.addslashes($this->request->data['Payment']['deposited_bank']).'",
												"'.addslashes($this->request->data['Payment']['bank_location']).'",
												"'.addslashes($this->request->data['Payment']['deposited_by']).'",
												"'.addslashes($this->request->data['Payment']['currency']).'",
												"New Deposit"
											)');
						$this->Session->setFlash('Deposit Request has been sent for verification.','default',array('class'=>'success'));
						$this->redirect(array('action' => 'bank_deposit'));
			}else{
				$this->Session->setFlash('The request could not be completed at the moment. Please, try again.','default',array('class'=>'error-message'));
			}	
		}
		
	}

/**
 * Esewa method
 * 
 * @return void
 */	
 	public function esewa_deposit($q=null,$oid=null,$amt=null,$refId=null){
		/*$esewa = $this->Payment->query("select esewa_username,esewa_password,esewa_service_code,esewa_url,esewa_is_active from paypal_settings where esewa_is_active=1");
		*/
		if(isset($this->params->query['q']) && $this->params->query['q']=='fu')
			$this->Session->setFlash('The request could not be completed at the moment. Please, try again.','default',array('class'=>'success'));
		
		if(isset($this->params->query['q']) && $this->params->query['q']=='su'){
			
			$this->Payment->query('insert into service_seeker_deposits
									(user_id,deposited_date,amount_nrs,amount_medium,esewa_txn_id,status,esewa_deposited_date)
									values(
									"'.$this->Auth->user('id').'",
									"'.date('Y-m-d').'",
									"'.addslashes($this->params->query['amt']).'",
									"Esewa",
									"'.$this->params->query['refId'].'",
									"Success",
									"'.date('Y-m-d H:i:s').'"
									)
									');	
			$this->Session->setFlash('Your payment has been successfully accounted. Thank You.','default',array('class'=>'success'));
			return $this->redirect(array('action' => 'esewa_deposit'));	
		}
		//$this->set(compact('esewa'));
	}
	
	public function esewa_success(){
		if(isset($this->params->query['q']) && $this->params->query['q']=='fu'){
			
			$this->Session->setFlash('The request could not be completed at the moment. Please, try again.','default',array('class'=>'error-message'));
			return $this->redirect(array('action' => 'esewa_deposit'));	
		}
		if(isset($this->params->query['q']) && $this->params->query['q']=='su'){
			
			$returnedEsewa = explode('-',$this->params->query['oid']);
			$getEsewaTransactions = $this->Payment->query("select * from service_seeker_deposits where id=".$returnedEsewa[4]." and user_id=".$returnedEsewa[3]." and status='New Esewa'");
			
			if(count($getEsewaTransactions)>0){
				$this->Payment->query('
								update service_seeker_deposits
								set status="Success",esewa_txn_id="'.$this->params->query['refId'].'",esewa_deposited_date="'.date('Y-m-d H:i:s').'" where id ="'.$returnedEsewa[4].'" 
								');
				$this->Session->setFlash('Your payment has been successfully accounted. Thank You.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'esewa_deposit'));	
			}else{
				$this->Session->setFlash('Your payment could not be verified. Please contact admin to verify your payment.','default',array('class'=>'error-message'));
				return $this->redirect(array('action' => 'esewa_deposit'));	
			}
			/*$this->Payment->query('insert into service_seeker_deposits
									(user_id,deposited_date,amount_nrs,amount_medium,esewa_txn_id,status,esewa_deposited_date)
									values(
									"'.$this->Auth->user('id').'",
									"'.date('Y-m-d').'",
									"'.addslashes($this->params->query['amt']).'",
									"Esewa",
									"'.$this->params->query['refId'].'",
									"Success",
									"'.date('Y-m-d H:i:s').'"
									)
									');	*/
			
			
		}
		
	}
	
	/**
 * Esewa method
 * 
 * @return void
 */	
 	public function esewa_redirect(){
		
		$this->request->onlyAllow('post');
		if($this->request->data['Payments']['amount'] =='')
		{
			$this->Session->setFlash('The payment could not be completed. Please, try again.','default',array('class'=>'error-message'));
			return $this->redirect(array('action' => 'esewa_deposit'));	
		}else
		{
			$esewa = $this->Payment->query("select esewa_username,esewa_password,esewa_service_code,esewa_url,esewa_is_active from paypal_settings where esewa_is_active=1");
			
			 $this->Payment->query('insert into service_seeker_deposits (user_id,deposited_date,amount_nrs,status,amount_medium)
								 values
									("'.$this->Auth->user('id').'",
										"'.date('Y-m-d').'",
										"'.addslashes($this->request->data['Payments']['amount']).'",
										"New Esewa",
										"Esewa"
									)	
									');
			//$lastInsertId = $this->Payment->getLastInsertId();						
			$lastInsertId = $this->Payment->query('select last_insert_id() as id');
			$unique_id = date('Y-m-d').'-'.$this->Auth->user('id').'-'.$lastInsertId[0][0]['id'];
			
			$amount = $this->request->data['Payments']['amount'];
			$txAmt = 0;
			$psc = 0;
			$pdc=0;
			$tAmt = $amount+$txAmt+$psc+$pdc;
			$this->set(compact('esewa','amount','txAmt','psc','pdc','tAmt','unique_id'));
		}
	}
	
/**
 * MoCo method
 * 
 * @return void
 */	
 	public function moco_deposit(){
		
		
	}
	
	public function moco_redirect(){
		$this->response->disableCache();
		$this->request->onlyAllow('post');
		$payType = '';
		
		if(isset($this->request->data['Payments'])){
			if(($this->request->data['Payments']['amount'] =='' || $this->request->data['Payments']['your_moco'] =='') && $this->request->data['Payments']['pay_type'] == 'request')
			{
				$this->Session->setFlash('The payment could not be completed. Please, try again.','default',array('class'=>'error-message'));
				return $this->redirect(array('action' => 'moco_deposit'));	
			}elseif($this->request->data['Payments']['pay_type'] == 'request' && !empty($this->request->data['Payments']['amount']) && !empty($this->request->data['Payments']['your_moco']))
			{
				//$moco = $this->Payment->query("select moco_merchant_id,moco_secret_key,moco_end_point,moco_is_active from paypal_settings where moco_is_active=1");
				
				 $this->Payment->query('insert into service_seeker_deposits (user_id,deposited_date,amount_nrs,status,amount_medium,moco_userid)
									 values
										("'.$this->Auth->user('id').'",
											"'.date('Y-m-d').'",
											"'.addslashes($this->request->data['Payments']['amount']).'",
											"New Payment",
											"MoCo",
											"'.addslashes($this->request->data['Payments']['your_moco']).'"
										)	
										');
				//$lastInsertId = $this->Payment->getLastInsertId();						
				$lastInsertId = $this->Payment->query('select last_insert_id() as id');
				$unique_id = date('Y-m-d').'-'.$this->Auth->user('id').'-'.$lastInsertId[0][0]['id'];
				
				$amount = $this->request->data['Payments']['amount'];
				$mocoUserId = $this->request->data['Payments']['your_moco'];
				$payType = $this->request->data['Payments']['pay_type'];
				$this->set(compact('moco','amount','mocoUserId','payType'));
			}elseif($this->request->data['Payments']['pay_type'] == 'send_request'){
				$payType = $this->request->data['Payments']['pay_type'];
				$moco = $this->Payment->query("select moco_merchant_id,moco_secret_key,moco_end_point,moco_is_active from paypal_settings where moco_is_active=1");
				
				$merchant_id = $moco[0]['paypal_settings']['moco_merchant_id'];
				$txn_amount = $this->request->data['Payments']['amount'];
				$moco_user_id= $this->request->data['Payments']['your_moco'];
				$secret_key = $moco[0]['paypal_settings']['moco_secret_key'];
				$moco_end_point = $moco[0]['paypal_settings']['moco_end_point'];
				
				//generate hmac md5 hash using secret key
				$hash = hash_hmac("md5", $merchant_id . $txn_amount . $moco_user_id, $secret_key);
				
				$post_params = array(
						"mid" => $merchant_id,
						"userid" => $moco_user_id,
						"amount" => $txn_amount,
						"hash" => $hash
						);
				
				$content = "";
				while (list($key, $val) = each($post_params)){
					$content .= "$key=" . urlencode($val) . "&";
				}
				//debug($content);//exit;
				//call web service endpoint
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $moco_end_point);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
				$ret = curl_exec($ch);
				
				$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
				
				$messageText =  "Response Message: $ret<br>Response Code: $http_status";
				echo "Response Code: $http_status";
				
				$this->set(compact('payType','http_status'));
			}
		}elseif(isset($this->request->data)){
			//debug($this->request->data);
			$moco = $this->Payment->query("select moco_merchant_id,moco_secret_key,moco_end_point,moco_is_active from paypal_settings where moco_is_active=1");
			
			$secret_key = $moco[0]['paypal_settings']['moco_secret_key'];
			

			//parameters sent by MoCo Server
			$tid = $this->request->data['tid']; //txn ID
			$userid = $this->request->data['userid']; // moco userid
			$status = $this->request->data['status']; //txn status S or F
			$message = $this->request->data['message']; //status message
			$name = $this->request->data['name']; //moco user's name
			$email = $this->request->data['email']; //moco user's email
			$hash = $this->request->data['hash']; // hmac hash
			$amount = $this->request->data['amount'];
			//generate hash on merchant side using values sent by MoCo
			if($status == 'S'){
				$myHash = hash_hmac("md5", $tid.$status.$message.$userid.$name.$email, $secret_key);
			}else{
				$myHash = hash_hmac("md5", $tid.$status.$message.$userid, $secret_key);
			}
			
			//validate authenticity
			if($myHash == $hash){
				$getDepositedId = $this->Payment->query("
													SELECT id FROM service_seeker_deposits WHERE moco_userid={$userid} and amount_nrs={$amount} and amount_medium='MoCo' and status='New Payment' order by deposited_date limit 1
													");
				$this->Payment->query("update service_seeker_deposits set status='Success',moco_txnid={$tid} where id=".$getDepositedId[0]['service_seeker_deposits']['id']);	
				$payType = 'success';
				$this->set(compact('payType'));
				//data sent from MoCO Server
				//do your stuff
			}else{
				$payType = 'failure';
				$this->set(compact('payType'));
			}	
			
		}
	}
	
	public function moco_post(){
		
	}
	
}
