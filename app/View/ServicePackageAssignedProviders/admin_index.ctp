<div class="servicePackageAssignedProviders index">
	<h2><?php echo __('Service Package Assigned Providers'); ?></h2>
     <?php echo $this->Session->flash(); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('service_package_request_id'); ?></th>
			<th><?php echo $this->Paginator->sort('provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('assigned_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($servicePackageAssignedProviders as $servicePackageAssignedProvider): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($servicePackageAssignedProvider['ServicePackageRequest']['id'], array('controller' => 'service_package_requests', 'action' => 'view', $servicePackageAssignedProvider['ServicePackageRequest']['id'])); ?>
		</td>
		<td><?php echo  $this->SmartForm->getUserInfo($servicePackageAssignedProvider['ServicePackageAssignedProvider']['provider_id']); ?>&nbsp;</td>
		<td><?php if($servicePackageAssignedProvider['ServicePackageAssignedProvider']['assigned_date']!='0000-00-00'){
		echo h($servicePackageAssignedProvider['ServicePackageAssignedProvider']['assigned_date']); 
		}?>&nbsp;</td>
		<td><?php echo h($servicePackageAssignedProvider['ServicePackageAssignedProvider']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id']), null, __('Are you sure you want to delete # %s?', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
