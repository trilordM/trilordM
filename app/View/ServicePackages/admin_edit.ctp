<div class="servicePackages form">
<?php echo $this->Form->create('ServicePackage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Package'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('rate');
		//echo $this->Form->input('created_date');
		echo $this->Form->input('valid_till');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServicePackage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ServicePackage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
