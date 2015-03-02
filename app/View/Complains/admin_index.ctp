<div class="complains full-width">
	<h2><?php echo __('Complains'); ?></h2>
    
     <?php echo $this->Session->flash(); ?>
    <div>
   		<?php echo $this->Form->create('Complain', array('type'=>'get','url' => array('controller' => 'complains', 'action' => 'index'))); ?>
		<?php
        	echo $this->Form->input('from', array(
													'id'=>'datepicker',
													'label'=>'Complained Date',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$from));
													
			echo $this->Form->input('to', array(
													'id'=>'datepicker1',
													'label'=>'To',
													'placeholder'=>'YYYY-MM-DD',
													'value'=>$to));										
			//echo $this->Form->input('category',array('empty'=>'Select','options' =>$serviceCategories,'escape'=>false));
			
			echo $this->Form->input('name',array('id'=>'name','placeholder'=>'Search complain for Service Provider','value'=>$name));
			echo $this->Form->hidden('type',array('value'=>'search'));
		?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
     <div>
    <?php echo $this->Form->create('Complain', array('type'=>'get','url' => array('controller' => 'complains', 'action' => 'index'))); ?>
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
				<th><?php echo $this->Paginator->sort('complain_date'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php  //debug($complains);
		foreach ($complains as $complain): ?>
		<tr>
			<td><?php echo h($complain['Complain']['id']); ?>&nbsp;</td>
	        <td><?php echo $this->Html->link($this->SmartForm->getUserInfo($complain['Complain']['service_provider_id']), array('controller' => 'users', 'action' => 'provider',$complain['Complain']['service_provider_id']));?>&nbsp;</td>
			<td><?php echo $this->Html->link($this->SmartForm->getUserInfo($complain['Complain']['service_seeker_id']), array('controller' => 'users', 'action' => 'seeker',$complain['Complain']['service_seeker_id']));?>&nbsp;</td>
	        <td><?php echo $this->Html->link($complain['Complain']['request_id'], array('controller' => 'SeekerProviderRequests', 'action' => 'index',$complain['Complain']['request_id'])); ?>&nbsp;</td>
			<td><?php echo h(substr($complain['Complain']['description'],0,120).'...'); ?>&nbsp;</td>
			<td><?php echo h($complain['Complain']['complain_date']); ?>&nbsp;</td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $complain['Complain']['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $complain['Complain']['id']), null, __('Are you sure you want to delete # %s?', $complain['Complain']['id'])); ?>
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
