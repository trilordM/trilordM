<div class="ratePackages index">
	<h2><?php echo __('Rate Packages'); ?></h2>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('title'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($ratePackages as $ratePackage): ?>
		<tr>
			<td><?php echo h($ratePackage['RatePackage']['id']); ?>&nbsp;</td>
			<td><?php echo h($ratePackage['RatePackage']['title']); ?>&nbsp;</td>
			<td><?php echo $ratePackage['RatePackage']['is_active']==0?'Inactive':'Active'; ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $ratePackage['RatePackage']['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ratePackage['RatePackage']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ratePackage['RatePackage']['id']), null, __('Are you sure you want to delete # %s?', $ratePackage['RatePackage']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rate Package'), array('action' => 'add')); ?></li>
		
	</ul>
</div>
