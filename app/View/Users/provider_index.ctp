<div class="users index">
	<h2><?php echo __('Users'); ?></h2>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php //echo $this->Paginator->sort('email'); ?></th>
				<th><?php //echo $this->Paginator->sort('username'); ?></th>
				<th><?php //echo $this->Paginator->sort('password'); ?></th>
				<th><?php echo $this->Paginator->sort('phone'); ?></th>
				<th><?php echo $this->Paginator->sort('dob'); ?></th>
				<th><?php echo $this->Paginator->sort('permanent_address'); ?></th>
				<th><?php echo $this->Paginator->sort('temporary_address'); ?></th>
				<th><?php echo $this->Paginator->sort('expertise_level'); ?></th>
				<th><?php //echo $this->Paginator->sort('profile_photo'); ?></th>
				<th><?php //echo $this->Paginator->sort('about_me'); ?></th>
				<th><?php //echo $this->Paginator->sort('rate_'.$i); ?></th>
				<th><?php //echo $this->Paginator->sort('category'); ?></th>
				<th><?php //echo $this->Paginator->sort('created_date'); ?></th>
				<th><?php //echo $this->Paginator->sort('role'); ?></th>
				<th class="actions"><?php //echo __('Actions'); ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['email']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['password']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['dob']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['permanent_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['temporary_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['expertise_level']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['profile_photo']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['about_me']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['rate_'.$i]); ?>&nbsp;</td>
			<td><?php //echo h($user['User']["<li>$cb $value &nbsp;</li>"]); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['created_date']); ?>&nbsp;</td>
			<td><?php //echo h($user['User']['role']); ?>&nbsp;</td>
			<td class="actions">
				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('action' => 'provider_edit', $user['User']['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
				<?php //echo $this->Html->link(__('Profile'), array('action' => 'provider', $user['User']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	
	</div> <!-- end table-wrapper -->
	
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
	</ul>
    <?php  
    echo $this->Form->create("Search",array('action' => 'search')); 
    echo $this->Form->input("q", array('label' => 'Search for')); 
    echo $this->Form->end("Search"); 
	?> 
</div>
