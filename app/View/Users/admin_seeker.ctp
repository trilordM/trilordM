<div class="users view">
<h2><?php echo __('Seeker'); ?></h2>

	<dl>
        <dt><?php echo __('Image'); ?></dt>
   		 <dd>         
         <?php if(file_exists(WWW_ROOT.'seekers_photo/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){ 
		 		echo $this->Html->image('/seekers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'Profile_pic'));
		 }else{ 
				echo $this->Html->image('avatar.gif',array('width'=>140,'height'=>'100','alt'=>'No Image')) ;
		 }?>
		<td class="actions"> 
        
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
		<dt><?php echo __('Phone'); ?></dt>
		<dd>
			<?php echo h($user['User']['primary_phone']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Temporary Address'); ?></dt>
		<dd>
			<?php echo h($user['User']['temporary_address']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'seeker_index')); ?></li>
	</ul>
</div>


<div class="users index">
	
    <?php if(!empty($history_1)){?>
    <h2><?php  
	echo __('<br/>Service Used History'); ?></h2>
    <div>
        <h4><?php echo __('<br/>SeekerProviderNewRequest History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th><?php echo __('Service provider'); ?>&nbsp;</th>
                <th><?php echo __('Requested Date'); ?>&nbsp;</th>
                <th><?php echo __('Description'); ?>&nbsp;</th>
                <th><?php echo __('Status'); ?>&nbsp;</th>
                <th><?php echo __('Rate Package'); ?>&nbsp;</th>
                <th><?php echo __('Rate'); ?>&nbsp;</th>
                <th><?php echo __('Working Hours'); ?>&nbsp;</th>
                <th><?php echo __('Working Days'); ?>&nbsp;</th>
        </tr>
        <?php //debug($history_1);die;
        foreach ($history_1 as $Service_history): ?>
        <tr>
            <td>
            <?php //debug($history);die;
            echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
            ?></td>        
            <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['description']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['status']);?>&nbsp;</td>
            <td><?php echo h($Service_history['RatePackage']['title']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history',$Service_history['SeekerProviderRequest']['service_seeker_id'],'New'),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
            <!--<td class="actions">
         </td>-->
    </div>
    <?php }?>
     <?php if(!empty($history_2)){?>
     <div>
        <h4><?php echo __('<br/>SeekerProviderAssignedRequest History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th><?php echo __('Service provider'); ?>&nbsp;</th>
                <th><?php echo __('Requested Date'); ?>&nbsp;</th>
                <th><?php echo __('Description'); ?>&nbsp;</th>
                <th><?php echo __('Status'); ?>&nbsp;</th>
                <th><?php echo __('Assigned Date'); ?>&nbsp;</th>
                <th><?php echo __('Rate Package'); ?>&nbsp;</th>
                <th><?php echo __('Rate'); ?>&nbsp;</th>
                <th><?php echo __('Working Hours'); ?>&nbsp;</th>
                <th><?php echo __('Working Days'); ?>&nbsp;</th>
                <th><?php echo __('Assigned By'); ?>&nbsp;</th>
        </tr>
        <?php
        foreach ($history_2 as $Service_history): ?>
        <tr>
            <td>
            <?php //debug($history);die;
            echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
            ?></td>        
            <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['description']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['status']);?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['assigned_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['RatePackage']['title']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
            <td><?php 
            if(!empty($Service_history['SeekerProviderRequest']['Assigned_by'])){ 
            echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['Assigned_by']);
            }?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history',$Service_history['SeekerProviderRequest']['service_seeker_id'],'Assigned'),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
            <!--<td class="actions">
         </td>-->
    </div>
     <?php }?>
     <?php //debug($history_3);die; 
	 if(!empty($history_3)){?>
     <div>
        <h4><?php echo __('<br/>SeekerProviderCompletedRequest History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th><?php echo __('Service provider'); ?>&nbsp;</th>
                <th><?php echo __('Requested Date'); ?>&nbsp;</th>
                <th><?php echo __('Description'); ?>&nbsp;</th>
                <th><?php echo __('Status'); ?>&nbsp;</th>
                <th><?php echo __('Assigned Date'); ?>&nbsp;</th>
                <th><?php echo __('Completed Date'); ?>&nbsp;</th>
                <th><?php echo __('Rate Package'); ?>&nbsp;</th>
                <th><?php echo __('Rate'); ?>&nbsp;</th>
                <th><?php echo __('Working Hours'); ?>&nbsp;</th>
                <th><?php echo __('Working Days'); ?>&nbsp;</th>
                <th><?php echo __('Assigned By'); ?>&nbsp;</th>
        </tr>
        <?php
        foreach ($history_3 as $Service_history): ?>
        <tr>
            <td>
            <?php //debug($history);die;
            echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['service_provider_id']);
            ?></td>        
            <td><?php echo h($Service_history['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['description']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['status']);?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['assigned_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['completed_date']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['RatePackage']['title']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
            <td><?php echo h($Service_history['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
            <td><?php 
            if(!empty($Service_history['SeekerProviderRequest']['Assigned_by'])){ 
            echo $this->SmartForm->getUserInfo($Service_history['SeekerProviderRequest']['Assigned_by']);
            }?>&nbsp;</td>
        </tr>
    <?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'SeekerProviderRequests','action' => 'service_history',$Service_history['SeekerProviderRequest']['service_seeker_id'],'Completed'),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
            <!--<td class="actions">
         </td>-->
    </div>
    <?php }?>
    <?php //debug($deposit_record);die;
	if(!empty($deposit_record)){?>
    <div>
        <h4><?php echo __('<br/>Seeker Deposits History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
                <th><?php echo __('Deposited Date'); ?>&nbsp;</th>
                <th><?php echo __('Amount Usd'); ?>&nbsp;</th>
                <th><?php echo __('Amount Nrs'); ?>&nbsp;</th>
                <th><?php echo __('Amount Medium'); ?>&nbsp;</th>
                <th><?php echo __('Transaction Date'); ?>&nbsp;</th>
                <th><?php echo __('Status'); ?>&nbsp;</th>
        </tr>
        <?php foreach ($deposit_record as $deposit): ?>
	<tr>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($deposit['ServiceSeekerDeposit']['status']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'ServiceSeekerDeposits','action' => 'deposit_history',$deposit['ServiceSeekerDeposit']['user_id']),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
    
    </div>
    <?php }?>
    <?php //debug($complain_record);die;
	if(!empty($complain_record)){?>
     <div>
        <h4><?php //debug($complain_record);die;
		echo __('<br/>Complains History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
			<th><?php echo __('Provider'); ?>&nbsp;</th>
			<th><?php echo __('request_id'); ?></th>
			<th><?php echo __('Description'); ?>&nbsp;</th>
			<th><?php echo __('Complain Date'); ?>&nbsp;</th>
        </tr>
        <?php foreach ($complain_record as $complain): ?>
	<tr>        
        <td><?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_provider_id']);?>&nbsp;</td>
        <td><?php echo h($complain['Complain']['request_id']); ?>&nbsp;</td>
        <td><?php echo h($complain['Complain']['description']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['complain_date']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'Complains','action' => 'complain_history',$complain['Complain']['service_seeker_id']),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
    
    </div>
    <?php }?>
    
    <?php //debug($complain_record);die;
	if(!empty($review_record)){?>
     <div>
        <h4><?php //debug($complain_record);die;
		echo __('<br/>Reviews History'); ?></h4>
        <table cellpadding="0" cellspacing="0">
        <tr>
			<th><?php echo __('Provider'); ?>&nbsp;</th>
			<th><?php echo __('request_id'); ?></th>
			<th><?php echo __('Description'); ?>&nbsp;</th>
			<th><?php echo __('Review Date'); ?></th>
			<th><?php echo __('Is Active'); ?></th>
        </tr>
        <?php foreach ($review_record as $review): ?>
	<tr>        
        <td><?php echo $this->SmartForm->getUserInfo($review['Review']['service_provider_id']);?>&nbsp;</td>
        <td><?php echo h($review['Review']['request_id']); ?>&nbsp;</td>
        <td><?php echo h($review['Review']['description']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['review_date']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['is_active']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
        </table>
        
        <td class="actions"> 
            <?php
            echo $this->Html->link(__('View More'), array('controller'=>'Reviews','action' => 'review_history',$review['Review']['service_seeker_id']),array('class'=>'btn btn-default btn-green btn-sm'));?> 
            </td>
    
    </div>
    <?php }?>
</div>