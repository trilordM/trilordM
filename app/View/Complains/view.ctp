<div class="complains view">
<h2><?php echo __('Complain'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Provider Id'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['service_provider_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Seeker Id'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['service_seeker_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Complain Date'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['complain_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Complain'), array('action' => 'edit', $complain['Complain']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Complain'), array('action' => 'delete', $complain['Complain']['id']), null, __('Are you sure you want to delete # %s?', $complain['Complain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Complains'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Complain Archives'), array('controller' => 'complain_archives', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Archive'), array('controller' => 'complain_archives', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Complain Tags'), array('controller' => 'complain_tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Complain Tag'), array('controller' => 'complain_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Complain Archives'); ?></h3>
	<?php if (!empty($complain['ComplainArchive'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Complain Id'); ?></th>
		<th><?php echo __('Service Provider Id'); ?></th>
		<th><?php echo __('Service Seeker Id'); ?></th>
		<th><?php echo __('Complain Date'); ?></th>
		<th><?php echo __('Archieved Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($complain['ComplainArchive'] as $complainArchive): ?>
		<tr>
			<td><?php echo $complainArchive['id']; ?></td>
			<td><?php echo $complainArchive['complain_id']; ?></td>
			<td><?php echo $complainArchive['service_provider_id']; ?></td>
			<td><?php echo $complainArchive['service_seeker_id']; ?></td>
			<td><?php echo $complainArchive['complain_date']; ?></td>
			<td><?php echo $complainArchive['archieved_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'complain_archives', 'action' => 'view', $complainArchive['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'complain_archives', 'action' => 'edit', $complainArchive['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'complain_archives', 'action' => 'delete', $complainArchive['id']), null, __('Are you sure you want to delete # %s?', $complainArchive['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Complain Archive'), array('controller' => 'complain_archives', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Complain Tags'); ?></h3>
	<?php if (!empty($complain['ComplainTag'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Complain Id'); ?></th>
		<th><?php echo __('Tag Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($complain['ComplainTag'] as $complainTag): ?>
		<tr>
			<td><?php echo $complainTag['complain_id']; ?></td>
			<td><?php echo $complainTag['tag_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'complain_tags', 'action' => 'view', $complainTag['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'complain_tags', 'action' => 'edit', $complainTag['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'complain_tags', 'action' => 'delete', $complainTag['id']), null, __('Are you sure you want to delete # %s?', $complainTag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Complain Tag'), array('controller' => 'complain_tags', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
