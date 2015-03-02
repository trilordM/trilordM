<div class="servicePackages view">
<h2><?php echo __('Service Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid Till'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['valid_till']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($servicePackage['ServicePackage']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Package'), array('action' => 'edit', $servicePackage['ServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Package'), array('action' => 'delete', $servicePackage['ServicePackage']['id']), null, __('Are you sure you want to delete # %s?', $servicePackage['ServicePackage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('controller' => 'service_package_requests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Service Package Requests'); ?></h3>
	<?php if (!empty($servicePackage['ServicePackageRequest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Service Package Id'); ?></th>
		<th><?php echo __('Seeker Id'); ?></th>
		<th><?php echo __('Requested Date'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Assigned Date'); ?></th>
		<th><?php echo __('Is Locked'); ?></th>
		<th><?php echo __('Locked By'); ?></th>
		<th><?php echo __('Completed Date'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th><?php echo __('Requested Amount'); ?></th>
		<th><?php echo __('Freezed Amount'); ?></th>
		<th><?php echo __('Completed Amount'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($servicePackage['ServicePackageRequest'] as $servicePackageRequest): ?>
		<tr>
			<td><?php echo $servicePackageRequest['id']; ?></td>
			<td><?php echo $servicePackageRequest['service_package_id']; ?></td>
			<td><?php echo $servicePackageRequest['seeker_id']; ?></td>
			<td><?php echo $servicePackageRequest['requested_date']; ?></td>
			<td><?php echo $servicePackageRequest['description']; ?></td>
			<td><?php echo $servicePackageRequest['status']; ?></td>
			<td><?php echo $servicePackageRequest['assigned_date']; ?></td>
			<td><?php echo $servicePackageRequest['is_locked']; ?></td>
			<td><?php echo $servicePackageRequest['locked_by']; ?></td>
			<td><?php echo $servicePackageRequest['completed_date']; ?></td>
			<td><?php echo $servicePackageRequest['rate']; ?></td>
			<td><?php echo $servicePackageRequest['requested_amount']; ?></td>
			<td><?php echo $servicePackageRequest['freezed_amount']; ?></td>
			<td><?php echo $servicePackageRequest['completed_amount']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'service_package_requests', 'action' => 'view', $servicePackageRequest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'service_package_requests', 'action' => 'edit', $servicePackageRequest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'service_package_requests', 'action' => 'delete', $servicePackageRequest['id']), null, __('Are you sure you want to delete # %s?', $servicePackageRequest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service Package Request'), array('controller' => 'service_package_requests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
