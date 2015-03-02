<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		//echo $this->Form->input('registration_code');
		$options = array('1'=>'Active','0'=>'Inactive');
		echo $this->Form->input('status',array('options'=>$options));
		//echo $this->Form->input('created_date');
		echo $this->Form->input('role',array('empty'=>'<--Select-->','options' => array('admin' => 'Admin', 'manager' => 'Manager','supervisor'=>'Supervisor')));
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
