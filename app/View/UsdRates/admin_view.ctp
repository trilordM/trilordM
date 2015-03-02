<div class="usdRates view">
<h2><?php echo __('Usd Rate'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($usdRate['UsdRate']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($usdRate['UsdRate']['rate']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate Date'); ?></dt>
		<dd>
			<?php echo h($usdRate['UsdRate']['rate_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Usd Rate'), array('action' => 'edit', $usdRate['UsdRate']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usd Rate'), array('action' => 'delete', $usdRate['UsdRate']['id']), null, __('Are you sure you want to delete # %s?', $usdRate['UsdRate']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usd Rates'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usd Rate'), array('action' => 'add')); ?> </li>
	</ul>
</div>
