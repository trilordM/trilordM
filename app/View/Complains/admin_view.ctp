<div class="complains view">
<h2><?php echo __('Complain'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($complain['Complain']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Provider'); ?></dt>
		<dd>
			<?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_provider_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Seeker'); ?></dt>
		<dd>
			<?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_seeker_id']); ?>
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
		<li><?php //echo $this->Form->postLink(__('Delete Complain'), array('action' => 'delete', $complain['Complain']['id']), null, __('Are you sure you want to delete # %s?', $complain['Complain']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Complains'), array('action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Complain Archives'), array('controller' => 'complain_archives', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Complain Archive'), array('controller' => 'complain_archives', 'action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Complain Tags'), array('controller' => 'complain_tags', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Complain Tag'), array('controller' => 'complain_tags', 'action' => 'add')); ?> </li>
	</ul>
</div>