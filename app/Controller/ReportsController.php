<?php
App::uses('AppController', 'Controller');
/**
 * Reports Controller
 *
 * @property Reports $Reports
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator','Useful');
	
	public function beforeFilter(){
		parent::beforeFilter();
		//$this->Auth->allow('esewa_success');
	}

	public function admin_transaction(){
		$conditions = ' 1=1 ';
		if(!empty($this->params->query)){
			$depositedFrom = $this->params->query['deposited_from'];
			$depositedTo = $this->params->query['deposited_to'];
			$transactionMedium = $this->params->query['transaction_medium'];
			$transactionStatus = $this->params->query['transaction_status'];
            $type = $this->params->query['type'];
			if(!empty($depositedFrom) && !empty($depositedFrom)){
				$depositedFroms = "'".$depositedFrom."'";
				$depositedTos = "'".$depositedTo."'";
				$conditions.= "and SSP.deposited_date between ".$depositedFroms." and ".$depositedTos ;	
			}
			if(!empty($transactionMedium) and $transactionMedium !='All'){
				$conditions.= "and SSP.amount_medium='".$transactionMedium."'";
			}
			if(!empty($transactionStatus)){
				if(!empty($transactionMedium) && $transactionMedium=='Esewa' && !empty($transactionStatus))
					$conditions.= "and SSP.status='New Esewa'";
				elseif(!empty($transactionMedium) && $transactionMedium=='All' && !empty($transactionStatus))	
					$conditions.= "and (SSP.status='New Esewa' OR SSP.status='New Deposit')";
				else	
					$conditions.= "and SSP.status='".$transactionStatus."'";
			}
			if ($type=='export') {
				$this->layout = false;
				$this->autoRender = false;
				$filename = $depositedFrom.'to'.$depositedTo.'_'.$transactionMedium.'_TransactionReport';
				$getTransactions = $this->Report->query("select SSP.*,U.name,UV.name from service_seeker_deposits  SSP
													left join users as U on U.id=SSP.user_id
													left join users as UV on UV.id=SSP.verified_by
													where ".$conditions." order by SSP.deposited_date asc");
				//debug($getTransactions);
				$this->set(compact('getTransactions','filename'));
				$this->render('/elements/transaction');				
			}
			
			$getTransactions = $this->Report->query("select SSP.*,U.name from service_seeker_deposits  SSP
													inner join users as U on U.id=SSP.user_id
													where ".$conditions." order by SSP.deposited_date asc");
			//debug($getTransactions);
		}else{
			$depositedFrom = '';
			$depositedTo = '';
			$transactionMedium = '';
			$transactionStatus = '';
			$this->Paginator->settings = array(
										'conditions' => array('ServiceSeekerDeposit.status' => 'New Deposit'),
										'order' => 'ServiceSeekerDeposit.deposited_date DESC'
									);
		}
		
		$this->set(compact('getTransactions','depositedFrom','depositedTo','transactionMedium','transactionStatus'));
	}
}
