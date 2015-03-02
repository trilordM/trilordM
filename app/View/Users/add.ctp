<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('phone');
		echo $this->Form->input('dob');
		echo $this->Form->input('permanent_address');
		echo $this->Form->input('temporary_address');
		echo $this->Form->input('expertise_level');
		echo $this->Form->input('profile_photo');
		echo $this->Form->input('about_me');
		echo $this->Form->input('registration_code');
		echo $this->Form->input('status');
		echo $this->Form->input('created_date');
		echo $this->Form->input('role');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
