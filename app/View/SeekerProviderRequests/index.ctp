<div class="seekerProviderRequests index">
	<h2><?php echo __('Seeker Provider Requests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_seeker_id'); ?></th>
			<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('requested_date'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php echo $this->Paginator->sort('assigned_date'); ?></th>
			<th><?php echo $this->Paginator->sort('completed_date'); ?></th>
			<th><?php echo $this->Paginator->sort('withdrawn_date'); ?></th>
        <!--<th><?php //echo $this->Paginator->sort('remarks'); ?></th>-->
			<th><?php echo $this->Paginator->sort('rate_package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('working_hour'); ?></th>
			<th><?php echo $this->Paginator->sort('working_days'); ?></th>
			<th><?php echo $this->Paginator->sort('requested_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('freeze_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('completion_amount'); ?></th>
			<th><?php echo $this->Paginator->sort('Assigned_by'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($seekerProviderRequests as $seekerProviderRequest): ?>
	<tr>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['id']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']); ?>&nbsp;</td>
        <td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['description']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['status']);?>&nbsp;</td> 
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['assigned_date']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['completed_date']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['withdrawn_date']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($seekerProviderRequest['RatePackage']['title'], array('controller' => 'rate_packages', 'action' => 'view', $seekerProviderRequest['RatePackage']['id'])); ?>
		</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
        
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_amount']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['freeze_amount']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['completion_amount']); ?>&nbsp;</td>
		<td>
		<?php
		if(!empty($history['SeekerProviderRequest']['Assigned_by'])){ 
		echo $this->SmartForm->getUserInfo($history['SeekerProviderRequest']['Assigned_by']);
		}
		?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $seekerProviderRequest['SeekerProviderRequest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $seekerProviderRequest['SeekerProviderRequest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $seekerProviderRequest['SeekerProviderRequest']['id']), null, __('Are you sure you want to delete # %s?', $seekerProviderRequest['SeekerProviderRequest']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Seeker Provider Request'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
