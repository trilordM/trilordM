<div class="seekerProviderRequests index">
	<h4><?php echo __('Review History'); ?></h4>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('service_provider_id'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('request_id'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('description'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('review_date'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('is_active'); ?>&nbsp;</th>
	</tr>
	<?php foreach ($review_history as $review): ?>
	<tr>
		<td> <?php //debug($history);die;
		echo $this->SmartForm->getUserInfo($review['Review']['service_provider_id']);
		?>&nbsp;</td>
        <td><?php echo h($review['Review']['request_id']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['description']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['review_date']);?>&nbsp;</td>
		<td><?php echo h($review['Review']['is_active']); ?>&nbsp;</td>
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

