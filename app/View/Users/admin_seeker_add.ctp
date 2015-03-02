<?php 
echo $this->Html->script('jquery');
echo $this->Html->script('validation');
?>
<div class="users form">
<?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file')); ?>
	<fieldset>
		<legend><?php echo __('Add Seeker'); ?></legend>
	<?php
		echo $this->Form->input('name',array('id'=>'name','class'=>'default'));
		echo $this->Form->input('email',array('id'=>'email','class'=>'default'));
		echo $this->Form->input('username',array('id'=>'username','class'=>'default'));
		echo $this->Form->input('password',array('id'=>'password','class'=>'default'));
		echo $this->Form->input('confirm_password',array('id'=>'confirm_password','type'=>'password','class'=>'default'));
		echo $this->Form->input('phone',array('id'=>'phone','class'=>'default'));
		echo $this->Form->input('dob',array('id'=>'dob','class'=>'default'));
		echo $this->Form->input('permanent_address',array('id'=>'permanent_address','class'=>'default'));
		echo $this->Form->input('temporary_address',array('id'=>'temporary_address','class'=>'default'));
		echo $this->Form->input('profile_photo',array('type'=>'file','id'=>'profile_photo','class'=>'default'));
		//echo $this->Form->input('registration_code',array('id'=>'registration_code','class'=>'default'));
		//echo $this->Form->input('status',array('id'=>'status','class'=>'default'));
		//echo $this->Form->input('created_date',array('id'=>'created_date','class'=>'default'));
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
