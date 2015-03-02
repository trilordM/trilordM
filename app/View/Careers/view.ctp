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
		<li><?php echo $this->Form->postLink(__('Delete Career'), array('action' => 'delete', $career['Career']['id']), null, __('Are you sure you want to delete # %s?', $career['Career']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Careers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Career'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Job Appliers'), array('controller' => 'job_appliers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Job Applier'), array('controller' => 'job_appliers', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Job Appliers'); ?></h3>
	<?php if (!empty($career['JobApplier'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Career Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Mobile No'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Your Cv'); ?></th>
		<th><?php echo __('Applied Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($career['JobApplier'] as $jobApplier): ?>
		<tr>
			<td><?php echo $jobApplier['id']; ?></td>
			<td><?php echo $jobApplier['career_id']; ?></td>
			<td><?php echo $jobApplier['name']; ?></td>
			<td><?php echo $jobApplier['email']; ?></td>
			<td><?php echo $jobApplier['mobile_no']; ?></td>
			<td><?php echo $jobApplier['address']; ?></td>
			<td><?php echo $jobApplier['your_cv']; ?></td>
			<td><?php echo $jobApplier['applied_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'job_appliers', 'action' => 'view', $jobApplier['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'job_appliers', 'action' => 'edit', $jobApplier['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'job_appliers', 'action' => 'delete', $jobApplier['id']), null, __('Are you sure you want to delete # %s?', $jobApplier['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Job Applier'), array('controller' => 'job_appliers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
