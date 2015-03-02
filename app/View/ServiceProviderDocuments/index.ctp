<div class="serviceProviderDocuments index">
	<h2><?php echo __('Service Provider Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('document_file'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($serviceProviderDocuments as $serviceProviderDocument): ?>
	<tr>
		<td><?php echo h($serviceProviderDocument['ServiceProviderDocument']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($serviceProviderDocument['User']['name'], array('controller' => 'users', 'action' => 'view', $serviceProviderDocument['User']['id'])); ?>
		</td>
		<td><?php echo h($serviceProviderDocument['ServiceProviderDocument']['title']); ?>&nbsp;</td>
		<td><?php echo h($serviceProviderDocument['ServiceProviderDocument']['document_file']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceProviderDocument['ServiceProviderDocument']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceProviderDocument['ServiceProviderDocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceProviderDocument['ServiceProviderDocument']['id']), null, __('Are you sure you want to delete # %s?', $serviceProviderDocument['ServiceProviderDocument']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Provider Document'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
