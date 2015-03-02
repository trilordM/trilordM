<div class="paypalSettings form">
<?php echo $this->Form->create('PaypalSetting'); ?>
	<fieldset>
		<legend><?php echo __('SMS'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('sms_username',array('label'=>'Username'));
		echo $this->Form->input('sms_password',array('label'=>'Password'));
		echo $this->Form->input('sms_sender_id',array('type'=>'text'));
		echo $this->Form->input('sms_is_active',array('label'=>'Active'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

