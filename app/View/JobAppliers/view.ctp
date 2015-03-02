<div class="jobAppliers view">
<h2><?php echo __('Job Applier'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Career'); ?></dt>
		<dd>
			<?php echo $this->Html->link($jobApplier['Career']['title'], array('controller' => 'careers', 'action' => 'view', $jobApplier['Career']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile No'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['mobile_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Address'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Your Cv'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['your_cv']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Applied Date'); ?></dt>
		<dd>
			<?php echo h($jobApplier['JobApplier']['applied_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Job Applier'), array('action' => 'edit', $jobApplier['JobApplier']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Job Applier'), array('action' => 'delete', $jobApplier['JobApplier']['id']), null, __('Are you sure you want to delete # %s?', $jobApplier['JobApplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Appliers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job Applier'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Careers'), array('controller' => 'careers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career'), array('controller' => 'careers', 'action' => 'add')); ?> </li>
	</ul>
</div>
