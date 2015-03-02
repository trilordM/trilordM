<div class="servicePackageAssignedProviders form">
<?php echo $this->Form->create('ServicePackageAssignedProvider'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Package Assigned Provider'); ?></legend>
	<?php
		echo $this->Form->input('provider_id');
		echo $this->Form->input('assigned_date');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Package Assigned Providers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
