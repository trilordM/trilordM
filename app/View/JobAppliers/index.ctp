<div class="jobAppliers index">
	<h2><?php echo __('Job Appliers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('career_id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('mobile_no'); ?></th>
			<th><?php echo $this->Paginator->sort('address'); ?></th>
			<th><?php echo $this->Paginator->sort('your_cv'); ?></th>
			<th><?php echo $this->Paginator->sort('applied_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($jobAppliers as $jobApplier): ?>
	<tr>
		<td><?php echo h($jobApplier['JobApplier']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($jobApplier['Career']['title'], array('controller' => 'careers', 'action' => 'view', $jobApplier['Career']['id'])); ?>
		</td>
		<td><?php echo h($jobApplier['JobApplier']['name']); ?>&nbsp;</td>
		<td><?php echo h($jobApplier['JobApplier']['email']); ?>&nbsp;</td>
		<td><?php echo h($jobApplier['JobApplier']['mobile_no']); ?>&nbsp;</td>
		<td><?php echo h($jobApplier['JobApplier']['address']); ?>&nbsp;</td>
		<td><?php echo h($jobApplier['JobApplier']['your_cv']); ?>&nbsp;</td>
		<td><?php echo h($jobApplier['JobApplier']['applied_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $jobApplier['JobApplier']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $jobApplier['JobApplier']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $jobApplier['JobApplier']['id']), null, __('Are you sure you want to delete # %s?', $jobApplier['JobApplier']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Job Applier'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Careers'), array('controller' => 'careers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career'), array('controller' => 'careers', 'action' => 'add')); ?> </li>
	</ul>
</div>
