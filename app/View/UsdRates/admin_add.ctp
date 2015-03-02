<div class="usdRates form">
<?php echo $this->Form->create('UsdRate'); ?>
	<fieldset>
		<legend><?php echo __('Add Usd Rate'); ?></legend>
	<?php
		echo $this->Form->input('rate');
		echo $this->Form->input('rate_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Usd Rates'), array('action' => 'index')); ?></li>
	</ul>
</div>
