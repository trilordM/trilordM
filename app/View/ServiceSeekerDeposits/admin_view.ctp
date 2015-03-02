<div class="serviceSeekerDeposits view">
<h2><?php echo __('Seeker Deposit'); ?></h2>
	<dl>
		
		<dt><?php echo __('Account Holder'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceSeekerDeposit['User']['name'], array('controller' => 'users', 'action' => 'view', $serviceSeekerDeposit['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deposited Date'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Usd'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_usd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Nrs'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_nrs']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount Medium'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']); ?>
			&nbsp;
		</dd>
        <?php 
		if($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']=='Bank Deposit'){
		?>
        <dt><?php echo __('Bank'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_bank']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Location'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['bank_location']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Deposited By'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_by']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['currency']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Verified By'); ?></dt>
		<dd>
			<?php echo $serviceSeekerDeposit['ServiceSeekerDeposit']['verified_by']>0?$this->SmartForm->getUserInfo($serviceSeekerDeposit['ServiceSeekerDeposit']['verified_by']):''; ?>
			&nbsp;
		</dd>
        <?php } ?>
         <?php 
		if($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']=='Paypal'){
		?>
		<dt><?php echo __('TransactionId'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transactionId']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Transaction Date'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transaction_date']); ?>
			&nbsp;
		</dd>
         <?php } ?>
         <?php 
		if($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']=='Esewa'){
		?>
        <dt><?php echo __('Esewa Transaction Id'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['esewa_txn_id']); ?>
			&nbsp;
		</dd>
        <dt><?php echo __('Transaction Date'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['esewa_deposited_date']); ?>
			&nbsp;
		</dd>
        <?php } ?>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['status']); ?>
			&nbsp;
		</dd>
        
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
	
		<li><?php echo $this->Html->link(__('List Service Seeker Deposits'), array('action' => 'index')); ?> </li>
	</ul>
</div>
