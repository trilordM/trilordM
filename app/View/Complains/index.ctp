<div class="complains index">
	<h2><?php echo __('Complains'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_seeker_id'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('complain_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($complains as $complain): ?>
	<tr>
		<td><?php echo h($complain['Complain']['id']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['service_provider_id']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['service_seeker_id']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['description']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['complain_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $complain['Complain']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $complain['Complain']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $complain['Complain']['id']), null, __('Are you sure you want to delete # %s?', $complain['Complain']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Complain'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Complain Archives'), array('controller' => 'complain_archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Archive'), array('controller' => 'complain_archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Complain Tags'), array('controller' => 'complain_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Tag'), array('controller' => 'complain_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
