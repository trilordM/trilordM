<div class="places form">
<?php echo $this->Form->create('Place'); ?>
	<fieldset>
		<legend><?php echo __('Add Places'); ?></legend>
	<?php
		echo $this->Form->input('district_id',array('empty'=>'Select'));
		echo $this->Form->input('place_1');
		echo $this->Form->input('place_2');
		echo $this->Form->input('place_3');
		echo $this->Form->input('place_4');
		echo $this->Form->input('place_5');
		echo $this->Form->input('place_6');
		echo $this->Form->input('place_7');
		echo $this->Form->input('place_8');
		echo $this->Form->input('place_9');
		echo $this->Form->input('place_10');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Places'), array('action' => 'index')); ?></li>
		<li><?php //echo $this->Html->link(__('List Districts'), array('controller' => 'districts', 'action' => 'index')); ?> </li>
	</ul>
</div>
