<div class="serviceProviderDocuments form">
<?php echo $this->Form->create('ServiceProviderDocument'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Provider Document'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('document_file');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Provider Documents'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
