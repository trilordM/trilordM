<div class="servicePackageAssignedProviders view">
<h2><?php echo __('Service Package Assigned Provider'); ?></h2>
	<dl>
		<dt><?php echo __('Service Package Request'); ?></dt>
		<dd>
			<?php echo $this->Html->link($servicePackageAssignedProvider['ServicePackageRequest']['id'], array('controller' => 'service_package_requests', 'action' => 'view', $servicePackageAssignedProvider['ServicePackageRequest']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider Id'); ?></dt>
		<dd>
			<?php echo $this->SmartForm->getUserInfo($servicePackageAssignedProvider['ServicePackageAssignedProvider']['provider_id']); ?>
			&nbsp;
		</dd>
		 <?php  if($servicePackageAssignedProvider['ServicePackageAssignedProvider']['assigned_date']!='0000-00-00'){?>
		<dt><?php echo __('Assigned Date'); ?></dt>
		<dd>
			<?php echo h($servicePackageAssignedProvider['ServicePackageAssignedProvider']['assigned_date']); ?>
			&nbsp;
		</dd>
        <?php } ?>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($servicePackageAssignedProvider['ServicePackageAssignedProvider']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Package Assigned Provider'), array('action' => 'edit', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Package Assigned Provider'), array('action' => 'delete', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id']), null, __('Are you sure you want to delete # %s?', $servicePackageAssignedProvider['ServicePackageAssignedProvider']['service_package_request_id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Assigned Providers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
