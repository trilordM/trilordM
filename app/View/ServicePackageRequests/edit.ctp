<div class="servicePackageRequests form">
<?php echo $this->Form->create('ServicePackageRequest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Package Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('service_package_id');
		echo $this->Form->input('seeker_id');
		echo $this->Form->input('requested_date');
		echo $this->Form->input('description');
		echo $this->Form->input('status');
		echo $this->Form->input('assigned_date');
		echo $this->Form->input('is_locked');
		echo $this->Form->input('locked_by');
		echo $this->Form->input('completed_date');
		echo $this->Form->input('rate');
		echo $this->Form->input('requested_amount');
		echo $this->Form->input('freezed_amount');
		echo $this->Form->input('completed_amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServicePackageRequest.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ServicePackageRequest.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Assigned Providers'), array('controller' => 'service_package_assigned_providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('controller' => 'service_package_assigned_providers', 'action' => 'add')); ?> </li>
	</ul>
</div>
