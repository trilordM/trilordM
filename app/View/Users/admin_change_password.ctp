<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Change Password'); ?></legend>
	<?php
		echo $this->Form->input('old_Password',array('type'=>'password'));
		echo $this->Form->input('new_Password',array('type'=>'password'));
		echo $this->Form->input('confirm_password',array('type'=>'password'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>