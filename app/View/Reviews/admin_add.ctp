<div class="reviews form">
<?php echo $this->Form->create('Review'); ?>
	<fieldset>
		<legend><?php echo __('Add Review'); ?></legend>
	<?php
		echo $this->Form->input('service_provider_id');
		echo $this->Form->input('service_seeker_id');
		echo $this->Form->input('description');
		echo $this->Form->input('review_date');
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?></li>
	</ul>
</div>
