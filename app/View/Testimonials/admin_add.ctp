<div class="testimonials form">
<?php echo $this->Form->create('Testimonial'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Testimonial'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('description',array('type' => 'textarea','id'=>'description','class'=>'default'));
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Testimonials'), array('action' => 'index')); ?></li>
	</ul>
</div>
