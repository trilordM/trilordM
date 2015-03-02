<div class="serviceRequestRelays index">
	<h2><?php echo __('Service Request Relays'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('seeker_provider_request_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_seeker_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($serviceRequestRelays as $serviceRequestRelay): ?>
	<tr>
		<td><?php echo h($serviceRequestRelay['ServiceRequestRelay']['id']); ?>&nbsp;</td>
		<td>
			<?php echo h($serviceRequestRelay['ServiceRequestRelay']['seeker_provider_request_id']); ?>&nbsp;
		</td>
		<td><?php $provider=explode(',',$serviceRequestRelay['ServiceRequestRelay']['service_provider_id']);
		//debug($provider);
		foreach($provider as $providers){
			//debug($providers);die;

			echo $this->Html->link($this->SmartForm->getUserInfo($providers), array('controller' => 'users', 'action' => 'provider',$providers)).'<br>';
		}
		 ?>&nbsp;</td>
		<td><?php echo $this->Html->link($this->SmartForm->getUserInfo($serviceRequestRelay['ServiceRequestRelay']['service_seeker_id']), array('controller' => 'users', 'action' => 'provider',$serviceRequestRelay['ServiceRequestRelay']['service_seeker_id'])); ?>&nbsp;</td>
		<td><?php echo h($serviceRequestRelay['ServiceRequestRelay']['description']); ?>&nbsp;</td>
		<td><?php echo h($serviceRequestRelay['ServiceRequestRelay']['created_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceRequestRelay['ServiceRequestRelay']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceRequestRelay['ServiceRequestRelay']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceRequestRelay['ServiceRequestRelay']['id']), null, __('Are you sure you want to delete # %s?', $serviceRequestRelay['ServiceRequestRelay']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('New Service Request Relay'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('controller' => 'seeker_provider_requests', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Seeker Provider Request'), array('controller' => 'seeker_provider_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
