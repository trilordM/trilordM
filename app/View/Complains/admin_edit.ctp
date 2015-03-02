<div class="complains form">
<?php echo $this->Form->create('Complain'); ?>
	<fieldset>
		<legend><?php echo __('Edit Complain'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('service_provider_id');
		echo $this->Form->input('service_seeker_id');
		echo $this->Form->input('description');
		echo $this->Form->input('complain_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Complain.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Complain.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Complains'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Complain Archives'), array('controller' => 'complain_archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Archive'), array('controller' => 'complain_archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Complain Tags'), array('controller' => 'complain_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Tag'), array('controller' => 'complain_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
