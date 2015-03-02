<div class="seekerProviderRequests index">
	<h4><?php echo __('ProviderRequest History'); ?></h4>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('requested_date'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th><?php if($status!='New'){
						echo $this->Paginator->sort('assigned_date');
						}?></th>
			<th><?php if($status=='Completed'){
						echo $this->Paginator->sort('completed_date'); 
					}?></th>
			<th><?php //echo $this->Paginator->sort('withdrawn_date'); ?></th>
        <!--<th><?php //echo $this->Paginator->sort('remarks'); ?></th>-->
			<th><?php echo $this->Paginator->sort('rate_package_id'); ?></th>
			<th><?php echo $this->Paginator->sort('rate'); ?></th>
			<th><?php echo $this->Paginator->sort('working_hour'); ?></th>
			<th><?php echo $this->Paginator->sort('Working_days'); ?></th>
			<th><?php if($status!='New'){
						echo $this->Paginator->sort('Assigned_by'); 
					}?></th>
	</tr>
	<?php //debug($service_history);die;
	foreach ($service_history as $history): ?>
	<tr>
		<td> <?php
		echo $this->SmartForm->getUserInfo($history['SeekerProviderRequest']['service_provider_id']);
		?>&nbsp;</td>
		<td><?php echo h($history['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
		<td><?php echo h($history['SeekerProviderRequest']['description']); ?>&nbsp;</td>
		<td><?php echo h($history['SeekerProviderRequest']['status']);?>&nbsp;</td> 
		<td><?php if($status!='New'){
					echo h($history['SeekerProviderRequest']['assigned_date']); 
					}?>&nbsp;</td>
		<td><?php if($status=='Completed'){
					echo h($history['SeekerProviderRequest']['completed_date']); 
				}?>&nbsp;</td>
		<td><?php //echo h($history['SeekerProviderRequest']['withdrawn_date']); ?>&nbsp;</td><!--
		<td><?php //echo h($history['SeekerProviderRequest']['remarks']); ?>&nbsp;</td>-->
		<td>
			<?php //echo $this->Html->link($history['RatePackage']['title'], array('controller' => 'rate_packages', 'action' => 'view', $history['RatePackage']['id'])); ?>
            <?php echo $history['RatePackage']['title']; ?>
		</td>
		<td><?php echo h($history['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
		<td><?php echo h($history['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
		<td><?php echo h($history['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
		<td>
		<?php 
			if(!empty($history['SeekerProviderRequest']['Assigned_by'])){ 
			echo $this->SmartForm->getUserInfo($history['SeekerProviderRequest']['Assigned_by']);
			}
		?>&nbsp;</td>
        
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

