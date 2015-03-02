<div class="serviceSeekerDeposits form">
<?php echo $this->Form->create('ServiceSeekerDeposit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Seeker Deposit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('deposited_date');
		echo $this->Form->input('amount_usd');
		echo $this->Form->input('amount_nrs');
		echo $this->Form->input('amount_medium');
		echo $this->Form->input('transactionId');
		echo $this->Form->input('transaction_date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceSeekerDeposit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ServiceSeekerDeposit.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Seeker Deposits'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
