<div class="ratePackages view">
<h2><?php echo __('Rate Package'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ratePackage['RatePackage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($ratePackage['RatePackage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo $ratePackage['RatePackage']['is_active']==0?'Inactive':'Active'; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rate Package'), array('action' => 'edit', $ratePackage['RatePackage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rate Package'), array('action' => 'delete', $ratePackage['RatePackage']['id']), null, __('Are you sure you want to delete # %s?', $ratePackage['RatePackage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('action' => 'add')); ?> </li>
		<li><?php //echo $this->Html->link(__('List Service Provider Rates'), array('controller' => 'service_provider_rates', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Service Provider Rate'), array('controller' => 'service_provider_rates', 'action' => 'add')); ?> </li>
	</ul>
</div>