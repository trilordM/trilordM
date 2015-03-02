<div class="ratePackages view">
<h2><?php echo __('Rate Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ratePackage['RatePackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($ratePackage['RatePackage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($ratePackage['RatePackage']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rate Package'), array('action' => 'edit', $ratePackage['RatePackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rate Package'), array('action' => 'delete', $ratePackage['RatePackage']['id']), null, __('Are you sure you want to delete # %s?', $ratePackage['RatePackage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Provider Rates'), array('controller' => 'service_provider_rates', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Provider Rate'), array('controller' => 'service_provider_rates', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Service Provider Rates'); ?></h3>
	<?php if (!empty($ratePackage['ServiceProviderRate'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Rate Package Id'); ?></th>
		<th><?php echo __('Rate'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ratePackage['ServiceProviderRate'] as $serviceProviderRate): ?>
		<tr>
			<td><?php echo $serviceProviderRate['user_id']; ?></td>
			<td><?php echo $serviceProviderRate['rate_package_id']; ?></td>
			<td><?php echo $serviceProviderRate['rate']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'service_provider_rates', 'action' => 'view', $serviceProviderRate['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'service_provider_rates', 'action' => 'edit', $serviceProviderRate['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'service_provider_rates', 'action' => 'delete', $serviceProviderRate['id']), null, __('Are you sure you want to delete # %s?', $serviceProviderRate['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Service Provider Rate'), array('controller' => 'service_provider_rates', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
