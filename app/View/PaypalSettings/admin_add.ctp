<div class="paypalSettings form">
<?php echo $this->Form->create('PaypalSetting'); ?>
	<fieldset>
		<legend><?php echo __('Add Paypal Setting'); ?></legend>
	<?php
		echo $this->Form->input('paypal_username');
		echo $this->Form->input('paypal_password');
		echo $this->Form->input('paypal_signature');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Paypal Settings'), array('action' => 'index')); ?></li>
	</ul>
</div>
