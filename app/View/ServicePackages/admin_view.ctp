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
			<?php echo $servicePackage['ServicePackage']['is_active']==0?'Inactive':'Active';?>
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