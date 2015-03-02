<div class="serviceRequestRelays view">
<h2><?php echo __('Service Request Relay'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seeker Provider Request'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceRequestRelay['SeekerProviderRequest']['service_provider_id'], array('controller' => 'seeker_provider_requests', 'action' => 'view', $serviceRequestRelay['SeekerProviderRequest']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Provider Id'); ?></dt>
		<dd>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['service_provider_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Seeker Id'); ?></dt>
		<dd>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['service_seeker_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['created_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Request Relay'), array('action' => 'edit', $serviceRequestRelay['ServiceRequestRelay']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Request Relay'), array('action' => 'delete', $serviceRequestRelay['ServiceRequestRelay']['id']), null, __('Are you sure you want to delete # %s?', $serviceRequestRelay['ServiceRequestRelay']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Request Relays'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Request Relay'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('controller' => 'seeker_provider_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seeker Provider Request'), array('controller' => 'seeker_provider_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
