<div class="paypalSettings index">
	<h2><?php echo __('Paypal Settings'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('paypal_username'); ?></th>
			<th><?php echo $this->Paginator->sort('paypal_password'); ?></th>
			<th><?php echo $this->Paginator->sort('paypal_signature'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($paypalSettings as $paypalSetting): ?>
	<tr>
		<td><?php echo h($paypalSetting['PaypalSetting']['id']); ?>&nbsp;</td>
		<td><?php echo h($paypalSetting['PaypalSetting']['paypal_username']); ?>&nbsp;</td>
		<td><?php echo h($paypalSetting['PaypalSetting']['paypal_password']); ?>&nbsp;</td>
		<td><?php echo h($paypalSetting['PaypalSetting']['paypal_signature']); ?>&nbsp;</td>
		<td><?php echo h($paypalSetting['PaypalSetting']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $paypalSetting['PaypalSetting']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $paypalSetting['PaypalSetting']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $paypalSetting['PaypalSetting']['id']), null, __('Are you sure you want to delete # %s?', $paypalSetting['PaypalSetting']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Paypal Setting'), array('action' => 'add')); ?></li>
	</ul>
</div>
