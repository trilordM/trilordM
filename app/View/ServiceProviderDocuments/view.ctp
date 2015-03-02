<div class="serviceProviderDocuments view">
<h2><?php echo __('Service Provider Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($serviceProviderDocument['ServiceProviderDocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($serviceProviderDocument['User']['name'], array('controller' => 'users', 'action' => 'view', $serviceProviderDocument['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($serviceProviderDocument['ServiceProviderDocument']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document File'); ?></dt>
		<dd>
			<?php echo h($serviceProviderDocument['ServiceProviderDocument']['document_file']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Service Provider Document'), array('action' => 'edit', $serviceProviderDocument['ServiceProviderDocument']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Service Provider Document'), array('action' => 'delete', $serviceProviderDocument['ServiceProviderDocument']['id']), null, __('Are you sure you want to delete # %s?', $serviceProviderDocument['ServiceProviderDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Provider Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Provider Document'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
