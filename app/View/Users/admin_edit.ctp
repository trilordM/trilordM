<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true)); ?>
	<fieldset>
		<legend><?php echo __('Edit User Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('username');
		
		echo $this->Form->input('role',array('empty'=>'<--Select-->','options' => array('admin' => 'Admin', 'manager' => 'Manager','supervisor'=>'Supervisor'),'selected'=>$this->Form->value('User.role')));
		$options = array('1'=>'Active','0'=>'Inactive');
		echo $this->Form->input('status',array('options'=>$options,'selected'=>$this->Form->value('User.status')));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
