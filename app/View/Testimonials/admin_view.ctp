<div class="testimonials view">
<h2><?php echo __('Testimonial'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($testimonial['Testimonial']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($testimonial['User']['name'], array('controller' => 'users', 'action' => 'view', $testimonial['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($testimonial['Testimonial']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo $testimonial['Testimonial']['is_active']==0?'Inactive':'Active'; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Testimonial'), array('action' => 'delete', $testimonial['Testimonial']['id']), null, __('Are you sure you want to delete # %s?', $testimonial['Testimonial']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Testimonials'), array('action' => 'index')); ?> </li>
	</ul>
</div>
