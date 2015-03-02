<div class="serviceCategories view">
<h2><?php echo __('Service Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Service Category'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceCategory['ParentServiceCategory']['title'], array('controller' => 'service_categories', 'action' => 'view', $serviceCategory['ParentServiceCategory']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Category'), array('action' => 'edit', $serviceCategory['ServiceCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Category'), array('action' => 'delete', $serviceCategory['ServiceCategory']['id']), null, __('Are you sure you want to delete # %s?', $serviceCategory['ServiceCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Categories'), array('controller' => 'service_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Service Category'), array('controller' => 'service_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Service Categories'); ?></h3>
	<?php if (!empty($serviceCategory['ChildServiceCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Parent Id'); ?></th>
		<th><?php echo __('Lft'); ?></th>
		<th><?php echo __('Rght'); ?></th>
		<th><?php echo __('Title'); ?></th>
		<th><?php echo __('Is Active'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($serviceCategory['ChildServiceCategory'] as $childServiceCategory): ?>
		<tr>
			<td><?php echo $childServiceCategory['id']; ?></td>
			<td><?php echo $childServiceCategory['parent_id']; ?></td>
			<td><?php echo $childServiceCategory['lft']; ?></td>
			<td><?php echo $childServiceCategory['rght']; ?></td>
			<td><?php echo $childServiceCategory['title']; ?></td>
			<td><?php echo $childServiceCategory['is_active']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'service_categories', 'action' => 'view', $childServiceCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'service_categories', 'action' => 'edit', $childServiceCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'service_categories', 'action' => 'delete', $childServiceCategory['id']), null, __('Are you sure you want to delete # %s?', $childServiceCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Child Service Category'), array('controller' => 'service_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
