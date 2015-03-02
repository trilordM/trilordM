<div class="seekerProviderRequests index">
	<h4><?php echo __('Complain History'); ?></h4>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('service_seeker_id'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('request_id'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('description'); ?>&nbsp;</th>
			<th><?php echo $this->Paginator->sort('complain_date'); ?>&nbsp;</th>
	</tr>
	<?php foreach ($complains_history as $history): ?>
	<tr>
		<td> <?php //debug($history);die;
		echo $this->SmartForm->getUserInfo($history['Complain']['service_seeker_id']);
		?>&nbsp;</td>
        <td><?php echo h($history['Complain']['request_id']); ?>&nbsp;</td>
		<td><?php echo h($history['Complain']['description']); ?>&nbsp;</td>
		<td><?php echo h($history['Complain']['complain_date']);?>&nbsp;</td>
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

