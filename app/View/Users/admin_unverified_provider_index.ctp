<div class="users full-width">
	<h2><?php echo __('Service Providers'); ?></h2>
        <div>
   		<?php echo $this->Form->create('User', array('type'=>'get','url' => array('controller' => 'users', 'action' => 'unverified_provider_index'))); ?>
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
			echo $this->Form->input('level',array('empty'=>'Select','options'=>array('expert'=>'Expert','intermediate'=>'Intermediate','basic'=>'Basic'),'selected'=>$level));
			
			echo $this->Form->input('provider_name',array('id'=>'provider_name','placeholder'=>'Name','value'=>$provider_name));
			
			echo $this->Form->input('provider_type',array('empty'=>'Select','options'=>array('company'=>'Company','individual'=>'Individual'),'selected'=>$provider_type));
			
			echo $this->Form->input('place',array('id'=>'facebook-theme','class'=>'default'));
			echo $this->Form->input('category',array('id'=>'category','class'=>'default'));

			
		?>
        <?php echo $this->Form->hidden('type',array('value'=>'search'));?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
    <div>
    <?php echo $this->Form->create('User', array('type'=>'get','url' => array('controller' => 'users', 'action' => 'unverified_provider_index'))); ?>
    <?php 
			echo $this->Form->hidden('from', array('value'=>$from));
			echo $this->Form->hidden('to', array('value'=>$to));
			echo $this->Form->hidden('level', array('value'=>$level));
			echo $this->Form->hidden('provider_name', array('value'=>$provider_name));
			echo $this->Form->hidden('provider_type', array('value'=>$provider_type));
			
			echo $this->Form->hidden('place', array('value'=>$place));
			echo $this->Form->hidden('category', array('value'=>$category));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('name'); ?></th>
				<th><?php echo $this->Paginator->sort('Provider Service Category'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('primary_phone'); ?></th>
				<th><?php echo $this->Paginator->sort('secondary_phone'); ?></th>
				<th><?php echo $this->Paginator->sort('permanent_address'); ?></th>
				<th><?php echo $this->Paginator->sort('temporary_address'); ?></th>
				<th><?php echo $this->Paginator->sort('ward_number'); ?></th>
				<th><?php echo $this->Paginator->sort('category'); ?></th>
				<th><?php echo $this->Paginator->sort('registered_as'); ?></th>
				<th><?php echo $this->Paginator->sort('identifier'); ?></th>
				<th><?php echo $this->Paginator->sort('identification_number'); ?></th>
				<th><?php echo $this->Paginator->sort('Involved_company'); ?></th>
				<th><?php echo $this->Paginator->sort('company_registration_number'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th><?php echo $this->Paginator->sort('profile_visibility'); ?></th>
				<th><?php echo $this->Paginator->sort('expertise_level'); ?></th>
				<th><?php echo $this->Paginator->sort('created_date'); ?></th>
				<th><?php echo $this->Paginator->sort('edited_by'); ?></th>
				<th><?php echo $this->Paginator->sort('assigned_by'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
            <td><?php echo $this->Html->link($user['User']['name'], array('controller' => 'users', 'action' => 'provider',$user['User']['id'])); ?>&nbsp;</td>
            
             <td><?php $provider_category=$this->SmartForm->ProviderCategory($user['User']['id']);
			 $provider_category=str_replace(",",", ",$provider_category[0][0]['title']);
			// debug($provider_category);die;
			 echo $provider_category;
			 //foreach($this->SmartForm->ProviderCategory($user['User']['id']) as $category):
				//echo $category['service_categories']['title'].'<br>';
				//endforeach;?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['primary_phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['secondary_phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['permanent_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['temporary_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['ward_number']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['category']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['registered_as']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['identifier']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['identification_number']); ?>&nbsp;</td>
			<td><?php if(!empty($user['User']['Involved_company'])){
			 echo $this->smartForm->getUserInfo($user['User']['Involved_company']);
			}?>&nbsp;</td>
			<td><?php echo h($user['User']['company_registration_number']); ?>&nbsp;</td>
			<td><?php echo $user['User']['status']==0?'Inactive':'Active'; ?>&nbsp;</td>
			<td><?php echo $user['User']['profile_visibility']==0?'Private':'Public';
			//debug(in_array($user['User']['profile_visibility'],unserialize(PROFILE_VISIBILITY))); ?>&nbsp;</td>
			<td><?php echo h($user['User']['expertise_level']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['created_date']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['edited_by']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['assigned_by']); ?>&nbsp;</td>
            
			<td class="actions">
				 <?php //if(!empty($user['User']['card_number'])){
				 echo $this->Html->link(__('PDF'), array('action' => 'barcode', 'ext' => 'pdf', $user['User']['id']));
				 //}?>
                <?php echo $this->Html->link(__('Card_dates'), array('action' => 'card_date', $user['User']['id'],$user['User']['primary_phone'])); ?> 
				<?php if($user['User']['status']=="0"){
				echo $this->Form->postLink(__('Verify'), array('action' => 'provider_verify', $user['User']['id'],'verify'));
				}?>
               <?php if (AuthComponent::user('role')=='admin'):?>
				<?php  if($user['User']['status']=='1'){
					echo $this->Form->postLink(__('Block'), array('action' => 'provider_verify', $user['User']['id'],'block'), null, __('Are you sure you want to block # %s?', $user['User']['id']));
				}elseif($user['User']['status']=='2'){
					echo $this->Form->postLink(__('Unblock'), array('action' => 'provider_verify', $user['User']['id'],'unblock'), null, __('Are you sure you want to unblock # %s?', $user['User']['id']));
			}
				echo $this->Form->postLink(__('Delete'), array('action' => 'admin_provider_delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
            <?php endif;?>  
				<?php //echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id'])); ?>
                
                
            <?php if (AuthComponent::user('role')!='supervisor '):?>
				<?php if($user['User']['registered_as']=='individual'){
					echo $this->Html->link(__('Edit'), array('action' => 'admin_provider_edit', $user['User']['id']));
				}else if($user['User']['registered_as']=='company'){
					echo $this->Html->link(__('Edit'), array('action' => 'admin_company_edit', $user['User']['id']));
				}?>
             <?php endif;?>
             

				<?php echo $this->Html->link(__('Profile'), array('action' => 'provider', $user['User']['id'])); ?>
            
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		</table>
	
	</div> <!-- end table wrapper -->
	
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


 <?php
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input-facebook');
?>

<script type="text/javascript">
        $(document).ready(function() {
           
			$("#facebook-theme").tokenInput(<?php echo json_encode($getPlace )?>, {
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit : 1,
			  	prePopulate : <?php echo json_encode($placeDistrict)?>
            });
			
			$("#category").tokenInput(<?php echo json_encode($getCategory )?>, {
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit : 1,
			  	prePopulate : <?php echo json_encode($Category)?>
            });
				
        });
        </script>