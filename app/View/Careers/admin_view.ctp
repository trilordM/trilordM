<div class="careers view">
<h2><?php echo __('Career'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($career['Career']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($career['Career']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($career['Career']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($career['Career']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Valid Till'); ?></dt>
		<dd>
			<?php echo h($career['Career']['valid_till']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($career['Career']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Career'), array('action' => 'edit', $career['Career']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Career'), array('action' => 'delete', $career['Career']['id']), null, __('Are you sure you want to delete # %s?', $career['Career']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Careers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Appliers'), array('controller' => 'job_appliers', 'action' => 'index')); ?> </li>
	</ul>
</div>