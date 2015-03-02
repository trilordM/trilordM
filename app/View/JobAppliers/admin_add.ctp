<div class="jobAppliers form">
<?php echo $this->Form->create('JobApplier'); ?>
	<fieldset>
		<legend><?php echo __('Add Job Applier'); ?></legend>
	<?php
		echo $this->Form->input('career_id');
		echo $this->Form->input('name');
		echo $this->Form->input('email');
		echo $this->Form->input('mobile_no');
		echo $this->Form->input('address');
		echo $this->Form->input('your_cv');
		echo $this->Form->input('applied_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Job Appliers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Careers'), array('controller' => 'careers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career'), array('controller' => 'careers', 'action' => 'add')); ?> </li>
	</ul>
</div>
