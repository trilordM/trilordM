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
		
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($serviceCategory['ServiceCategory']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo $serviceCategory['ServiceCategory']['is_active']==0?'Inactive':'Active'; ?>
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
		<li><?php echo $this->Html->link(__('New Parent Service Category'), array('controller' => 'service_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>