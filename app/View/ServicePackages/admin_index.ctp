<div class="servicePackages index">
	<h2><?php echo __('Service Packages'); ?></h2>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('rate'); ?></th>
				<th><?php echo $this->Paginator->sort('created_date'); ?></th>
				<th><?php echo $this->Paginator->sort('valid_till'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($servicePackages as $servicePackage): ?>
		<tr>
			<td><?php echo h($servicePackage['ServicePackage']['id']); ?>&nbsp;</td>
			<td><?php echo h($servicePackage['ServicePackage']['title']); ?>&nbsp;</td>
			<td><?php echo substr(h($servicePackage['ServicePackage']['description']),0,150); ?>&nbsp;</td>
			<td><?php echo h($servicePackage['ServicePackage']['rate']); ?>&nbsp;</td>
			<td><?php echo h($servicePackage['ServicePackage']['created_date']); ?>&nbsp;</td>
			<td><?php echo h($servicePackage['ServicePackage']['valid_till']); ?>&nbsp;</td>
			<td><?php echo $servicePackage['ServicePackage']['is_active']==0?'Inactive':'Active'; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $servicePackage['ServicePackage']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $servicePackage['ServicePackage']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $servicePackage['ServicePackage']['id']), null, __('Are you sure you want to delete # %s?', $servicePackage['ServicePackage']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	
	</div> <!-- end table-wrapper -->
	
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
		<li><?php echo $this->Html->link(__('New Service Package'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
