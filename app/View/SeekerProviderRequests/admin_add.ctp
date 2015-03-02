<div class="seekerProviderRequests form">
<?php echo $this->Form->create('SeekerProviderRequest'); ?>
	<fieldset>
		<legend><?php echo __('Add Provider Request'); ?></legend>
	<?php
		echo $this->Form->input('service_seeker_id');
		echo $this->Form->input('service_provider_id');
		echo $this->Form->input('requested_date_from');
		echo $this->Form->input('requested_date_to');
		echo $this->Form->input('created_date');
		echo $this->Form->input('description');
		echo $this->Form->input('status');
		echo $this->Form->input('assigned_date');
		echo $this->Form->input('completed_date');
		echo $this->Form->input('withdrawn_date');
		echo $this->Form->input('remarks');
		echo $this->Form->input('rate_package_id');
		echo $this->Form->input('rate');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
