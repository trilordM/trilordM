<div class="serviceCategories index">
	<h2><?php echo __('Service Categories'); ?></h2>
    
     <?php echo $this->Session->flash(); ?>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
				
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('range_1'); ?></th>
				<th><?php echo $this->Paginator->sort('range_2'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($serviceCategories as $serviceCategory): ?>
		<tr>
			<td><?php echo h($serviceCategory['ServiceCategory']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($serviceCategory['ParentServiceCategory']['title'], array('controller' => 'service_categories', 'action' => 'view', $serviceCategory['ParentServiceCategory']['id'])); ?>
			</td>
			
			<td><?php echo h($serviceCategory['ServiceCategory']['title']); ?>&nbsp;</td>
            <td><?php echo h($serviceCategory['ServiceCategory']['range_1']); ?>&nbsp;</td>
            <td><?php echo h($serviceCategory['ServiceCategory']['range_2']); ?>&nbsp;</td>
			<td><?php echo $serviceCategory['ServiceCategory']['is_active']==0?'Inactive':'Active'; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceCategory['ServiceCategory']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceCategory['ServiceCategory']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceCategory['ServiceCategory']['id']), null, __('Are you sure you want to delete # %s?', $serviceCategory['ServiceCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Service Category'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Categories'), array('controller' => 'service_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Service Category'), array('controller' => 'service_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
