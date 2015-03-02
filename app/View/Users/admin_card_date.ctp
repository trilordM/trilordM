<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Add Dates'); ?></legend>
	<?php
		echo $this->Form->input('from',array('id'=>'datepicker','placeholder'=>'Choose issue date','value'=>$from,'label'=>'Issue Date'));
		echo $this->Form->input('to',array('id'=>'datepicker1','placeholder'=>'Choose expiry date','value'=>$to,'label'=>'Expiry Date'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
