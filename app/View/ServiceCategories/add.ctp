<div class="serviceCategories form">
<?php echo $this->Form->create('ServiceCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Category'); ?></legend>
	<?php
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
		echo $this->Form->input('title');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Categories'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Categories'), array('controller' => 'service_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Parent Service Category'), array('controller' => 'service_categories', 'action' => 'add')); ?> </li>
	</ul>
</div>
