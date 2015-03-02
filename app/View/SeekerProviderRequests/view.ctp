<div class="seekerProviderRequests view">
<h2><?php echo __('Seeker Provider Request'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Seeker Id'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Provider Id'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requested Date From'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_date_from']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Requested Date To'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_date_to']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created Date'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['created_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Assigned Date'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['assigned_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Completed Date'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['completed_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Withdrawn Date'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['withdrawn_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate Package'); ?></dt>
		<dd>
			<?php echo $this->Html->link($seekerProviderRequest['RatePackage']['title'], array('controller' => 'rate_packages', 'action' => 'view', $seekerProviderRequest['RatePackage']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rate'); ?></dt>
		<dd>
			<?php echo h($seekerProviderRequest['SeekerProviderRequest']['rate']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Seeker Provider Request'), array('action' => 'edit', $seekerProviderRequest['SeekerProviderRequest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Seeker Provider Request'), array('action' => 'delete', $seekerProviderRequest['SeekerProviderRequest']['id']), null, __('Are you sure you want to delete # %s?', $seekerProviderRequest['SeekerProviderRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Seeker Provider Request'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
