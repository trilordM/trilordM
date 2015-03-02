<div class="servicePackageRequests view">
<h2><?php echo __('Service Package Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($servicePackageRequest['ServicePackage']['title'], array('controller' => 'service_packages', 'action' => 'view', $servicePackageRequest['ServicePackage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Seeker Id'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['seeker_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requested Date'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['requested_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assigned Date'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['assigned_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Locked'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['is_locked']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Locked By'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['locked_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed Date'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['completed_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requested Amount'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['requested_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Freezed Amount'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['freezed_amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed Amount'); ?></dt>
		<dd>
			<?php echo h($servicePackageRequest['ServicePackageRequest']['completed_amount']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Package Request'), array('action' => 'edit', $servicePackageRequest['ServicePackageRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Package Request'), array('action' => 'delete', $servicePackageRequest['ServicePackageRequest']['id']), null, __('Are you sure you want to delete # %s?', $servicePackageRequest['ServicePackageRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Assigned Providers'), array('controller' => 'service_package_assigned_providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('controller' => 'service_package_assigned_providers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Service Package Assigned Providers'); ?></h3>
	<?php if (!empty($servicePackageRequest['ServicePackageAssignedProvider'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Service Package Request Id'); ?></th>
		<th><?php echo __('Provider Id'); ?></th>
		<th><?php echo __('Assigned Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($servicePackageRequest['ServicePackageAssignedProvider'] as $servicePackageAssignedProvider): ?>
		<tr>
			<td><?php echo $servicePackageAssignedProvider['service_package_request_id']; ?></td>
			<td><?php echo $servicePackageAssignedProvider['provider_id']; ?></td>
			<td><?php echo $servicePackageAssignedProvider['assigned_date']; ?></td>
			<td><?php echo $servicePackageAssignedProvider['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'service_package_assigned_providers', 'action' => 'view', $servicePackageAssignedProvider['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'service_package_assigned_providers', 'action' => 'edit', $servicePackageAssignedProvider['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'service_package_assigned_providers', 'action' => 'delete', $servicePackageAssignedProvider['id']), null, __('Are you sure you want to delete # %s?', $servicePackageAssignedProvider['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('controller' => 'service_package_assigned_providers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
