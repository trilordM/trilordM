<div class="contentPages index">
	<h2><?php echo __('Content Pages'); ?></h2>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('slug'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('is_active'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($contentPages as $contentPage): ?>
	<tr>
		<td><?php echo h($contentPage['ContentPage']['id']); ?>&nbsp;</td>
		<td><?php echo h($contentPage['ContentPage']['title']); ?>&nbsp;</td>
		<td><?php echo h($contentPage['ContentPage']['slug']); ?>&nbsp;</td>
		<td><?php echo substr(h(strip_tags($contentPage['ContentPage']['description'])),0,150).'....'; ?>&nbsp;</td>
		<td><?php echo h($contentPage['ContentPage']['is_active']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $contentPage['ContentPage']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $contentPage['ContentPage']['id'])); ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $contentPage['ContentPage']['id']), null, __('Are you sure you want to delete # %s?', $contentPage['ContentPage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Content Page'), array('action' => 'add')); ?></li>
	</ul>
</div>
