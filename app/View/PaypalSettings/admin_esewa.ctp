<div class="paypalSettings form">
<?php echo $this->Form->create('PaypalSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit Esewa Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('esewa_username');
		echo $this->Form->input('esewa_password');
		echo $this->Form->input('esewa_service_code');
		echo $this->Form->input('esewa_url');
		
		echo $this->Form->input('esewa_is_active',array('label'=>'Active'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

