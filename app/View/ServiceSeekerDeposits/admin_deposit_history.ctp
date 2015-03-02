<div class="seekerProviderRequests index">
	<h4><?php echo __('Deposits History'); ?></h4>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('deposited_date'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_usd'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_nrs'); ?></th>
			<th><?php echo $this->Paginator->sort('amount_medium'); ?></th>
			<th><?php echo $this->Paginator->sort('transaction_date'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
	</tr>
	<?php foreach ($serviceSeekerDeposits as $Deposits): ?>
	<tr>
		
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($Deposits['ServiceSeekerDeposit']['status']); ?>&nbsp;</td>
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

