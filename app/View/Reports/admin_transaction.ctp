 <?php
	echo $this->Html->css('ui-lightness/jquery-ui-1.10.4.custom');
	echo $this->Html->script('datepicker/jquery-1.10.2');
	echo $this->Html->script('datepicker/jquery-ui-1.10.4.custom');
?>
 <script>
 	$(document).ready(function () {
  		$( "#datepicker" ).datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		});
		$( "#datepicker_to" ).datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
<div class="serviceSeekerDeposits index">
	<h2><?php echo __('Transaction Report'); ?></h2>
   
    <div>
   		<?php echo $this->Form->create('Report', array('type'=>'get','url' => array('controller' => 'reports', 'action' => 'transaction'))); ?>
		<?php
        	echo $this->Form->input('deposited_from', array(
													'id'=>'datepicker',
													'label'=>'Deposited From',
													'placeholder'=>date('Y-m-d'),
													'value'=>$depositedFrom));
			echo $this->Form->input('deposited_to', array(
													'id'=>'datepicker_to',
													'label'=>'To',
													'placeholder'=>date('Y-m-d'),
													'value'=>$depositedTo));										
			$transactionTypeOptions = array(
											'All' => 'All',
											'Paypal'=>'Paypal',
											'Bank Deposit' => 'Bank Deposit',
											'Esewa' => 'Esewa',
											'MoCo' => 'MoCo'
										);
			echo $this->Form->input('transaction_medium',array('empty'=>'Select','options'=>$transactionTypeOptions,'selected'=>$transactionMedium));
			$statusOptions = array('New Deposit'=>'New Deposit',
									'Success'=>'Verified',
									'Withheld'=>'Withheld'
									);
			echo $this->Form->input('transaction_status',array('empty'=>'Select','options'=>$statusOptions,'selected'=>$transactionStatus));
		echo $this->Form->hidden('type',array('value'=>'search'));?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
    <div>
    <?php echo $this->Form->create('Report', array('type'=>'get','url' => array('controller' => 'reports', 'action' => 'transaction'))); ?>
    <?php 
			echo $this->Form->hidden('deposited_from', array('value'=>$depositedFrom));
			echo $this->Form->hidden('deposited_to', array('value'=>$depositedTo));
			echo $this->Form->hidden('transaction_medium', array('value'=>$transactionMedium));
			echo $this->Form->hidden('transaction_status', array('value'=>$transactionStatus));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo "SN"; ?></th>
			<th><?php echo ('Service Seeker'); ?></th>
			<th><?php echo ('Deposited_Date'); ?></th>
			<th><?php echo ('Amount USD'); ?></th>
			<th><?php echo ('Amount NRs'); ?></th>
			<th><?php echo ('Amount Medium'); ?></th>
			<th><?php echo ('Transaction Id'); ?></th>
			<th><?php echo ('Transaction Date'); ?></th>
			<th><?php echo ('Status'); ?></th>
			
	</tr>
	<?php 
	$totalUsd = 0;
	$totalNrs = 0;
	$i=0;
	if(isset($getTransactions)):
	foreach ($getTransactions as $transaction):
	$i++; 
	$totalUsd = $totalUsd+$transaction['SSP']['amount_usd'];
	$totalNrs = $totalNrs+$transaction['SSP']['amount_nrs'];
	?>
	<tr>
		<td><?php echo $i; ?>&nbsp;</td>
		<td>
			<?php echo h($transaction['U']['name']); ?>
		</td>
		<td><?php echo h($transaction['SSP']['deposited_date']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['amount_usd']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['amount_nrs']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['amount_medium']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['transactionId']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($transaction['SSP']['status']); ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	<tr>
    	<td colspan="3">Total</td>
        <td><?php echo $totalUsd;?></td>
        <td><?php echo $totalNrs;?></td>
        <td colspan="2">&nbsp;</td>
    </tr>
 <?php endif;?>   
	</table>
	
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Service Seeker Deposit'), array('action' => 'add')); ?></li>
		<li><?php //echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
