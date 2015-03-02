<div class="users full-width">
	<h2><?php echo __('Service Seekers'); ?></h2>
    <?php echo $this->Session->flash(); ?>
     <div>
   		<?php echo $this->Form->create('User', array('type'=>'get','url' => array('controller' => 'users', 'action' => 'seeker_index'))); ?>
		<?php 
        	echo $this->Form->input('from', array(
													'id'=>'datepicker',
													'label'=>'Created Date',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$from));
													
			echo $this->Form->input('to', array(
													'id'=>'datepicker1',
													'label'=>'To',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$to));										
			//echo $this->Form->input('category',array('empty'=>'Select','options' =>$serviceCategories,'escape'=>false));
			echo $this->Form->input('seeker_name',array('id'=>'seeker_name','placeholder'=>'Name','value'=>$seeker_name));
			
			$categoryOptions = array('1'=>'Registered','2'=>'Blocked');
			echo $this->Form->input('Status',array('empty'=>'Select','options'=>$categoryOptions,'selected'=>$status));
			echo $this->Form->hidden('type',array('value'=>'search'));?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
    <div>
    <?php echo $this->Form->create('User', array('type'=>'get','url' => array('controller' => 'users', 'action' => 'seeker_index'))); ?>
    <?php 
			echo $this->Form->hidden('from', array('value'=>$from));
			echo $this->Form->hidden('to', array('value'=>$to));
			echo $this->Form->hidden('seeker_name', array('value'=>$seeker_name));
			echo $this->Form->hidden('Status', array('value'=>$status));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
	
	<div class="table-holder">
	
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<!--<th><?php //echo $this->Paginator->sort('username'); ?></th>-->
				<th><?php echo $this->Paginator->sort('primary_phone'); ?></th>
				<th><?php echo $this->Paginator->sort('temporary_address'); ?></th>
				<th><?php echo $this->Paginator->sort('created_date'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'seeker',$user['User']['id'])); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<!--<td><?php //echo h($user['User']['username']); ?>&nbsp;</td>-->
			<td><?php echo h($user['User']['primary_phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['temporary_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['created_date']); ?>&nbsp;</td>
			<td class="actions">
				<?php // echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                
            <?php //if (AuthComponent::user('role')!='supervisor '):?>
				<?php //echo $this->Html->link(__('Edit'), array('action' => 'seeker_edit', $user['User']['id'])); ?>
            <?php //endif;?>
             
            <?php if (AuthComponent::user('role')=='admin'):?>
				<?php if($user['User']['status']=='1'){
					//echo $this->Form->postLink(__('Disable'), array('action' => 'verify', $user['User']['id'],'disable'), null, __('Are you sure you want to disable # %s?', $user['User']['id']));
					echo $this->Form->postLink(__('Block'), array('action' => 'admin_seeker_verify', $user['User']['id'],'block'), null, __('Are you sure you want to block # %s?', $user['User']['id']));
				}elseif($user['User']['status']=='0'){
					echo $this->Form->postLink(__('Enable'), array('action' => 'admin_seeker_verify', $user['User']['id'],'enable'), null, __('Are you sure you want to enable # %s?', $user['User']['id']));
			}else{
					echo $this->Form->postLink(__('Unblock'), array('action' => 'admin_seeker_verify', $user['User']['id'],'unblock'), null, __('Are you sure you want to unblock # %s?', $user['User']['id']));
			}
			//echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                <?php endif; ?>
				<?php echo $this->Html->link(__('Profile'), array('action' => 'seeker', $user['User']['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
		</table>
	
	</div> <!-- end table holder -->
	
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
	</p>
	
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>