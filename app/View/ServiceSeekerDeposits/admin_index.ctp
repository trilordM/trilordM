 <?php
	echo $this->Html->css('ui-lightness/jquery-ui-1.10.4.custom');
	echo $this->Html->script('datepicker/jquery-1.10.2');
	echo $this->Html->script('datepicker/jquery-ui-1.10.4.custom');
?>
 <script>
 	$(document).ready(function () {
  		$( "#datepicker" ).datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script>

<div class="serviceSeekerDeposits full-width">
	
	<h2><?php echo __('Seeker Deposits'); ?></h2>
    
     <?php echo $this->Session->flash(); ?>
   
    <div>
   		<?php echo $this->Form->create('ServiceSeekerDeposit', array('type'=>'get','url' => array('controller' => 'service_seeker_deposits', 'action' => 'index'))); ?>
		<?php
        	echo $this->Form->input('deposited', array(
													'id'=>'datepicker',
													'label'=>'Deposited Date',
													'placeholder'=>date('Y-m-d'),
													'value'=>$depositedDate));
			$transactionTypeOptions = array('Paypal'=>'Paypal',
											'Bank Deposit' => 'Bank Deposit',
											'Esewa' => 'Esewa'
										);
			echo $this->Form->input('transaction_medium',array('empty'=>'Select','options'=>$transactionTypeOptions,'selected'=>$transactionMedium));
			$statusOptions = array('New Deposit'=>'New Deposit',
									'Success'=>'Verified',
									'Withheld'=>'Withheld'
									);
			echo $this->Form->input('transaction_status',array('empty'=>'Select','options'=>$statusOptions,'selected'=>$transactionStatus));
		echo $this->Form->hidden('type',array('value'=>'search'));?>
    	<?php echo $this->Form->end(__('Search')); ?>
    </div>
    
    <div>
    <?php echo $this->Form->create('ServiceSeekerDeposit', array('type'=>'get','url' => array('controller' => 'ServiceSeekerDeposits', 'action' => 'index'))); ?>
    <?php 
			echo $this->Form->hidden('deposited', array('value'=>$depositedDate));
			echo $this->Form->hidden('transaction_medium', array('value'=>$transactionMedium));
			echo $this->Form->hidden('transaction_status', array('value'=>$transactionStatus));
			echo $this->Form->hidden('type',array('value'=>'export'));?>
    	<?php echo $this->Form->end(__('Export')); ?>
    </div>
    
    <div class="table-wrapper">
    
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		<thead>
		<tr>
				<?php /*?><th><?php echo $this->Paginator->sort('id'); ?></th><?php */?>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th><?php echo $this->Paginator->sort('deposited_date'); ?></th>
				<th><?php echo $this->Paginator->sort('amount_usd'); ?></th>
				<th><?php echo $this->Paginator->sort('amount_nrs'); ?></th>
				<th><?php echo $this->Paginator->sort('amount_medium'); ?></th>
				<th><?php echo $this->Paginator->sort('transactionId'); ?></th>
				<th><?php echo $this->Paginator->sort('transaction_date'); ?></th>
				<th><?php echo $this->Paginator->sort('status'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($serviceSeekerDeposits as $serviceSeekerDeposit): ?>
		<tr>
			<?php /*?><td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['id']); ?>&nbsp;</td><?php */?>
			<td>
				<?php echo $this->Html->link($serviceSeekerDeposit['User']['name'], array('controller' => 'users', 'action' => 'seeker', $serviceSeekerDeposit['User']['id'])); ?>
			</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transactionId']); ?>&nbsp;</td>
			<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transaction_date']); ?>&nbsp;</td>
			<td><?php echo $serviceSeekerDeposit['ServiceSeekerDeposit']['status']==0?'Inactive':'Active'; ?>&nbsp;</td>
			<td class="actions">
				<?php 
				if($serviceSeekerDeposit['ServiceSeekerDeposit']['status']=='New Deposit')
					echo $this->Form->postLink(__('Verify'), array('action' => 'verify', $serviceSeekerDeposit['ServiceSeekerDeposit']['id']), null, __('Are you sure you want to verify this transaction?', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
				<?php echo $serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']=='Bank Deposit'?$this->Html->link(__('Edit'), array('action' => 'edit', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])):''; ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceSeekerDeposit['ServiceSeekerDeposit']['id']), null, __('Are you sure you want to delete # %s?', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
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
