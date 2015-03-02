<div class="serviceSeekerDeposits view">
<h2><?php echo __('Service Seeker Deposit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
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
		<li><?php echo $this->Html->link(__('Edit Service Seeker Deposit'), array('action' => 'edit', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Seeker Deposit'), array('action' => 'delete', $serviceSeekerDeposit['ServiceSeekerDeposit']['id']), null, __('Are you sure you want to delete # %s?', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Seeker Deposits'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Seeker Deposit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
