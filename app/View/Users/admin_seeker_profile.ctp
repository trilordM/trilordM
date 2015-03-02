<div class="users view">
	<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Image'); ?></dt>
		<dd>
			<?php echo $this->Html->image('/seekers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'Profile_pic'));?>
			<td class="actions"> 
				<?php 
					//echo $this->Html->link(__('Edit profile pic'), array('action' => 'seeker_pic_edit'));
					?> 
			<td class="actions">
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
		<?php echo h($user['User']['name']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
		<?php echo h($user['User']['email']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
		<?php echo h($user['User']['username']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
		<?php echo h($user['User']['phone']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Dob'); ?></dt>
		<dd>
		<?php echo h($user['User']['dob']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Permanent Address'); ?></dt>
		<dd>
		<?php echo h($user['User']['permanent_address']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('Temporary Address'); ?></dt>
		<dd>
		<?php echo h($user['User']['temporary_address']); ?>
		&nbsp;
		</dd>
		<dt><?php //echo __('Expertise Level'); ?></dt>
		<dd>
		<?php //echo h($user['User']['expertise_level']); ?>
		&nbsp;
		</dd>
		<dt><?php //echo __('Profile Photo'); ?></dt>
		<dd>
		<?php //echo h($user['User']['profile_photo']); ?>
		&nbsp;
		</dd>
		<dt><?php echo __('About Me'); ?></dt>
		<dd>
		<?php echo h($user['User']['about_me']); ?>
		&nbsp;
		</dd>
	</dl>
	<td class="actions"> 
		<?php
			//echo $this->Html->link(__('Edit Profile'), array('action' => 'seeker_edit'));?> 
	<td class="actions">
	<td class="actions"> 
		<?php
			//echo $this->Html->link(__('Change password'), array('action' => 'change_password')); ?> 
	<td class="actions">
		<?php
			//echo $this->Html->link(__('Testimonial'), array('controller'=>'Testimonials','action' => 'add')); ?> 
</div>