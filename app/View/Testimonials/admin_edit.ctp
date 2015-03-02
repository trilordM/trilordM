<div class="testimonials form">
<?php echo $this->Form->create('Testimonial'); ?>
	<fieldset>
		<legend><?php echo __('Edit Testimonial'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('description',array('type' => 'textarea','id'=>'description','class'=>'default'));
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Testimonial.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Testimonial.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Testimonials'), array('action' => 'index')); ?></li>
	</ul>
</div>
