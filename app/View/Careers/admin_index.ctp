<div class="careers index">
	<h2><?php echo __('Careers'); ?></h2>
    
     <?php echo $this->Session->flash(); ?>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('created_date'); ?></th>
			<th><?php echo $this->Paginator->sort('valid_till'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($careers as $career): ?>
	<tr>
		<td><?php echo h($career['Career']['id']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['title']); ?>&nbsp;</td>
		<td><?php echo h(substr($career['Career']['description'],0,120).'...'); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['created_date']); ?>&nbsp;</td>
		<td><?php echo h($career['Career']['valid_till']); ?>&nbsp;</td>
		<td><?php echo $career['Career']['is_active']==0?'Inactive':'Active'; ?>&nbsp;</td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $career['Career']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $career['Career']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $career['Career']['id']), null, __('Are you sure you want to delete # %s?', $career['Career']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Career'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Job Appliers'), array('controller' => 'job_appliers', 'action' => 'index')); ?> </li>
		<!--<li><?php //echo $this->Html->link(__('New Job Applier'), array('controller' => 'job_appliers', 'action' => 'add')); ?> </li>-->
	</ul>
</div>
