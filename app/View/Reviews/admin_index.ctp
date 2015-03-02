<div class="reviews full-width">
	<h2><?php echo __('Reviews'); ?></h2>
    <div>
   		<?php echo $this->Form->create('Review', array('type'=>'get','url' => array('controller' => 'reviews', 'action' => 'index'))); ?>
		<?php
        	echo $this->Form->input('from', array(
													'id'=>'datepicker',
													'label'=>'Review Date',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$from));
													
			echo $this->Form->input('to', array(
													'id'=>'datepicker1',
													'label'=>'To',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$to));										
			
			echo $this->Form->input('name',array('id'=>'name','placeholder'=>'Service Provider','value'=>$name));
			echo $this->Form->hidden('type',array('value'=>'search'));
		?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
     <div>
    <?php echo $this->Form->create('Review', array('type'=>'get','url' => array('controller' => 'reviews', 'action' => 'index'))); ?>
    <?php 
			echo $this->Form->hidden('from', array('value'=>$from));
			echo $this->Form->hidden('to', array('value'=>$to));
			echo $this->Form->hidden('name', array('value'=>$name));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
    
    <div class="table-wrapper">
    
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
				<th><?php echo $this->Paginator->sort('service_seeker_id'); ?></th>
				<th><?php echo $this->Paginator->sort('request_id'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('review_date'); ?></th>
				<th><?php echo $this->Paginator->sort('Status'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($reviews as $review): ?>
		<tr>
			<td><?php echo h($review['Review']['id']); ?>&nbsp;</td>
	        <td><?php echo $this->Html->link($this->SmartForm->getUserInfo($review['Review']['service_provider_id']), array('controller' => 'users', 'action' => 'provider',$review['Review']['service_provider_id']));?>&nbsp;</td>
	        <td><?php echo $this->Html->link($this->SmartForm->getUserInfo($review['Review']['service_seeker_id']), array('controller' => 'users', 'action' => 'seeker',$review['Review']['service_seeker_id']));?>&nbsp;</td>
	        <td><?php echo $this->Html->link($review['Review']['request_id'], array('controller' => 'SeekerProviderRequests', 'action' => 'index',$review['Review']['request_id'])); ?>&nbsp;</td>
			<td><?php echo h(substr($review['Review']['description'],0,120).'...'); ?>&nbsp;</td>
			<td><?php echo h($review['Review']['review_date']); ?>&nbsp;</td>
			<td><?php if($review['Review']['is_active']=='0'){
			 			echo 'New'; 
					}elseif($review['Review']['is_active']=='1'){
						echo 'Enabled'; 
					}else{
						echo 'Blocked'; 
					}?>&nbsp;</td>
			<td class="actions">
	        
				<?php if($review['Review']['is_active']=='0'){
						echo $this->Form->postLink(__('Verify'), array('action' => 'verify', $review['Review']['id'],'verify')); 
					}elseif($review['Review']['is_active']=='1'){
						echo $this->Form->postLink(__('Disable'), array('action' => 'verify', $review['Review']['id'],'disable')); 
					}elseif($review['Review']['is_active']=='2'){
						echo $this->Form->postLink(__('Enable'), array('action' => 'verify', $review['Review']['id'],'enable')); 
					}?>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $review['Review']['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $review['Review']['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $review['Review']['id']), null, __('Are you sure you want to delete # %s?', $review['Review']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	
	</div> <!--- end table-wrapper -->
	
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
