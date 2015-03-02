<div class="serviceRequestRelays form">
<?php echo $this->Form->create('ServiceRequestRelay'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Request Relay'); ?></legend>
	<?php
		echo $this->Form->input('seeker_provider_request_id');
		echo $this->Form->input('service_provider_id');
		echo $this->Form->input('service_seeker_id');
		echo $this->Form->input('description');
		echo $this->Form->input('created_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Request Relays'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('controller' => 'seeker_provider_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seeker Provider Request'), array('controller' => 'seeker_provider_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
