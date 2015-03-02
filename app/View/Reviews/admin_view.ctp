<div class="reviews view">
<h2><?php echo __('Review'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($review['Review']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Provider Id'); ?></dt>
		<dd>
			<?php echo h($review['Review']['service_provider_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Service Seeker Id'); ?></dt>
		<dd>
			<?php echo h($review['Review']['service_seeker_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($review['Review']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Review Date'); ?></dt>
		<dd>
			<?php echo h($review['Review']['review_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php if($review['Review']['is_active']=='0'){
			 			echo 'New'; 
					}elseif($review['Review']['is_active']=='1'){
						echo 'Enabled'; 
					}else{
						echo 'Blocked'; 
					}?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php //echo $this->Html->link(__('Edit Review'), array('action' => 'edit', $review['Review']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Review'), array('action' => 'delete', $review['Review']['id']), null, __('Are you sure you want to delete # %s?', $review['Review']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reviews'), array('action' => 'index')); ?> </li>
		<li><?php // echo $this->Html->link(__('New Review'), array('action' => 'add')); ?> </li>
	</ul>
</div>
