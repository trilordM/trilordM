<div class="paypalSettings form">
<?php echo $this->Form->create('PaypalSetting'); ?>
	<fieldset>
		<legend><?php echo __('Edit MoCo Setting'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('moco_merchant_id', array('type'=>'text'));
		echo $this->Form->input('moco_secret_key');
		echo $this->Form->input('moco_end_point');
		
		echo $this->Form->input('moco_is_active',array('label'=>'Active'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

