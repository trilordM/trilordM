<div class="paypalSettings form">
<?php echo $this->Form->create('PaypalSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Paypal Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('paypal_username');
		echo $this->Form->input('paypal_password');
		echo $this->Form->input('paypal_signature');
		$options = array('1'=>'Test','0'=>'Live');
		echo $this->Form->input('status',array('options'=>$options,'selected'=>$paypal['PaypalSetting']['status']==true?'1':'0','after'=>'<span>Please select Live to receive payment</span>'));
		echo $this->Form->input('paypal_is_active',array('label'=>'Active'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

