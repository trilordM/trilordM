<div class="seekerProviderRequests index">
	<h2><?php echo __('Service Requests'); ?></h2>
     <?php echo $this->Session->flash(); ?>
    <div>
   		<?php echo $this->Form->create('SeekerProviderRequest', array('type'=>'get','url' => array('controller' => 'seeker_provider_requests', 'action' => 'index'))); ?>
		<?php
        	echo $this->Form->input('requested', array(
													'id'=>'datepicker',
													'label'=>'Requested Date',
													'placeholder'=>date('Y-m-d'),
													'value'=>$requested));
			echo $this->Form->input('category',array('empty'=>'Select','options' =>$serviceCategories,
													'selected'=>$Category,'escape'=>false));
			$statusOptions = array('New'=>'New',
									'Assigned'=>'Assigned',
									'Completed'=>'Completed'
									);
			echo $this->Form->input('Status',array('empty'=>'Select','options'=>$statusOptions,'selected'=>$status));
			echo $this->Form->hidden('type',array('value'=>'search'));
		?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
    <div>
    <?php echo $this->Form->create('SeekerProviderRequest', array('type'=>'get','url' => array('controller' => 'SeekerProviderRequests', 'action' => 'index'))); ?>
    <?php 
			echo $this->Form->hidden('requested', array('value'=>$requested));
			echo $this->Form->hidden('category', array('value'=>$Category));
			echo $this->Form->hidden('Status', array('value'=>$status));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
    
    <div class="table-wrapper">
    
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
		<thead>
		<tr> 
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('service_seeker_id'); ?></th>
				<th><?php echo $this->Paginator->sort('service_provider_id'); ?></th>
				<th><?php echo $this->Paginator->sort('Category'); ?></th>
				<th><?php echo $this->Paginator->sort('requested_date'); ?></th>
				<th><?php echo $this->Paginator->sort('created_date'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('rate_package_id'); ?></th>
				<th><?php echo $this->Paginator->sort('rate'); ?></th>
				<th><?php echo $this->Paginator->sort('total'); ?></th>
				<th><?php echo $this->Paginator->sort('working_hour'); ?></th>
				<th><?php echo $this->Paginator->sort('working_days'); ?></th>
				<th><?php echo $this->Paginator->sort('requested_amount'); ?></th>
				<th><?php echo $this->Paginator->sort('freeze_amount'); ?></th>
				<th><?php echo $this->Paginator->sort('completion_amount'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($seekerProviderRequests as $seekerProviderRequest): ?>
		<tr>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['id']); ?>&nbsp;</td>
			<td><?php echo $this->Html->link($this->SmartForm->getUserInfo($seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']), array('controller' => 'users', 'action' => 'seeker',$seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']));?>
			</td>
			<td>
				<?php
					if(!empty($seekerProviderRequest['SeekerProviderRequest']['service_provider_id'])){
						echo $this->Html->link($this->SmartForm->getUserInfo($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']), array('controller' => 'users', 'action' => 'provider',$seekerProviderRequest['SeekerProviderRequest']['service_provider_id']));
					}
				?>
			</td>
           	<td>
           		<?php
           			$provider_category=$this->SmartForm->ProviderCategory($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']);
			 		$provider_category=str_replace(",",", ",$provider_category[0][0]['title']);
			 		echo $provider_category;
			 	?>
		    </td>
	        
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['created_date']); ?>&nbsp;</td>
			<td><?php echo h(substr($seekerProviderRequest['SeekerProviderRequest']['description'],0,120).'...'); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['status']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($seekerProviderRequest['RatePackage']['title'], array('controller' => 'rate_packages', 'action' => 'view', $seekerProviderRequest['RatePackage']['id'])); ?>
			</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
            
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['total']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_amount']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['freeze_amount']); ?>&nbsp;</td>
			<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['completion_amount']); ?>&nbsp;</td>
			<td class="actions">
                <?php
                	if(empty($seekerProviderRequest['SeekerProviderRequest']['service_provider_id'])||($seekerProviderRequest['SeekerProviderRequest']['status']=='Withheld')){
						echo $this->Html->link(__('Reply'), array('action' => 'reply', $seekerProviderRequest['SeekerProviderRequest']['id']));
					}
	            	if(empty($seekerProviderRequest['SeekerProviderRequest']['locked_by'])||($seekerProviderRequest['SeekerProviderRequest']['locked_by']==AuthComponent::user('id'))){

						if($seekerProviderRequest['SeekerProviderRequest']['status']=='New'){
							if(!empty($seekerProviderRequest['SeekerProviderRequest']['service_provider_id'])){
								echo $this->Form->postLink(__('Assign'), array('action' => 'verify', $seekerProviderRequest['SeekerProviderRequest']['id'],'1', $seekerProviderRequest['SeekerProviderRequest']['service_seeker_id'], $seekerProviderRequest['SeekerProviderRequest']['service_provider_id'],__('Are you sure you want to assign # %s?', $seekerProviderRequest['SeekerProviderRequest']['id'])));
							}
						}

						if($seekerProviderRequest['SeekerProviderRequest']['status']=='Assigned'){
							echo $this->Form->postLink(__('Completed'), array('action' => 'verify', $seekerProviderRequest['SeekerProviderRequest']['id'],'2', $seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']));
						}

						if($seekerProviderRequest['SeekerProviderRequest']['status']=='New'){
							if(!empty($seekerProviderRequest['SeekerProviderRequest']['service_provider_id'])){
								echo $this->Html->link(__('Add to relay'), array('controller'=>'ServiceRequestRelays','action' => 'add', $seekerProviderRequest['SeekerProviderRequest']['id']));
							}
						}
	            
	            	}
					if(empty($seekerProviderRequest['SeekerProviderRequest']['locked_by'])){
						echo $this->Form->postLink(__('Lock'),array('action' => 'request_lock', $seekerProviderRequest['SeekerProviderRequest']['id'],'1'));
					}else{
						if(AuthComponent::user('id')==$seekerProviderRequest['SeekerProviderRequest']['locked_by']){
							echo $this->Form->postLink(__('Free'),array('action' => 'request_lock', $seekerProviderRequest['SeekerProviderRequest']['id'],'2'));
						}
					}
				?>
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul><!--
		<li><?php //echo $this->Html->link(__('New Seeker Provider Request'), array('action' => 'add')); ?></li>-->
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>