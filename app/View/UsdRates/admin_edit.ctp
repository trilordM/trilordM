<div class="usdRates form">
<?php echo $this->Form->create('UsdRate'); ?>
	<fieldset>
		<legend><?php echo __('Edit Usd Rate'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('rate');
		echo $this->Form->input('rate_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('UsdRate.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('UsdRate.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Usd Rates'), array('action' => 'index')); ?></li>
	</ul>
</div>
