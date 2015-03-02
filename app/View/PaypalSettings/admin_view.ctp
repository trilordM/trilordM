<div class="paypalSettings view">
<h2><?php echo __('Paypal Setting'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($paypalSetting['PaypalSetting']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paypal Username'); ?></dt>
		<dd>
			<?php echo h($paypalSetting['PaypalSetting']['paypal_username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paypal Password'); ?></dt>
		<dd>
			<?php echo h($paypalSetting['PaypalSetting']['paypal_password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Paypal Signature'); ?></dt>
		<dd>
			<?php echo h($paypalSetting['PaypalSetting']['paypal_signature']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($paypalSetting['PaypalSetting']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Paypal Setting'), array('action' => 'edit', $paypalSetting['PaypalSetting']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Paypal Setting'), array('action' => 'delete', $paypalSetting['PaypalSetting']['id']), null, __('Are you sure you want to delete # %s?', $paypalSetting['PaypalSetting']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Paypal Settings'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Paypal Setting'), array('action' => 'add')); ?> </li>
	</ul>
</div>
