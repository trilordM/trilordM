<?php /*?> <?php
	echo $this->Html->css('ui-lightness/jquery-ui-1.10.4.custom');
	echo $this->Html->script('datepicker/jquery-1.10.2');
	echo $this->Html->script('datepicker/jquery-ui-1.10.4.custom');
?>
 <script>
 	$(document).ready(function () {
  		$( "#datepickerdate" ).datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		});
	});
</script><?php */?>

<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Your Deposits</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
   
    	<div class="col-md-9">
   		<?php echo $this->Form->create('ServiceSeekerDeposit', array('type'=>'get','class'=>"post-resume-form")); ?>
		<?php
        	echo $this->Form->input('deposited', array(
													'id'=>'datepicker',
													'label'=>'Deposited Date',
													'placeholder'=>date('Y-m-d'),
													'value'=>$depositedDate,'div'=>array('class'=>'form-group'),'class'=>'form-control input'));
			$transactionTypeOptions = array('Paypal'=>'Paypal',
											'Bank Deposit' => 'Bank Deposit'
										);
			echo $this->Form->input('transaction_medium',array('empty'=>'Select','options'=>$transactionTypeOptions,'selected'=>$transactionMedium,'div'=>array('class'=>'form-group'),'class'=>'form-control input'));
			$statusOptions = array('New Deposit'=>'New Deposit',
									'Success'=>'Verified'
									);
			echo $this->Form->input('transaction_status',array('empty'=>'Select','options'=>$statusOptions,'selected'=>$transactionStatus,'div'=>array('class'=>'form-group'),'class'=>'form-control input'));
		?>
    	<?php
				$options = array('div'=>array('class'=>'form-group'),'value'=>'Send', 'class'=> 'btn btn-default btn-green');
				echo $this->Form->end($options); 
			
		//echo $this->Form->end(__('Search')); ?>
		<div style="margin-top: 1.5em; border-top: double #BBB; ">&nbsp;</div>
		<h5>Deposit History</h5>
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			<thead>
			<tr>
					<?php /*?><th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('user_id'); ?></th><?php */?>
					<th><?php echo $this->Paginator->sort('deposited_date'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_usd'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_nrs'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_medium'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
					<?php /*?><th class="actions"><?php echo __('Actions'); ?></th><?php */?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($serviceSeekerDeposits as $serviceSeekerDeposit): ?>
			<tr>
				<?php /*?><td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['id']); ?>&nbsp;</td>
				<td>
					<?php echo $this->Html->link($serviceSeekerDeposit['User']['name'], array('controller' => 'users', 'action' => 'view', $serviceSeekerDeposit['User']['id'])); ?>
				</td><?php */?>
				<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
				<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
				<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
				<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
				<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['status']); ?>&nbsp;</td>
				<?php /*?><td class="actions">
					<?php echo $this->Form->postLink(__('Verify'), array('action' => 'verify', $serviceSeekerDeposit['ServiceSeekerDeposit']['id']), null, __('Are you sure you want to verify this transaction?', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $serviceSeekerDeposit['ServiceSeekerDeposit']['id']), null, __('Are you sure you want to delete # %s?', $serviceSeekerDeposit['ServiceSeekerDeposit']['id'])); ?>
				</td><?php */?>
			</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
		    
		    <div class="row clearfix">
		            			
		    			<div class="col-md-6">
		    				<p class="pagination-info">
		    				<?php
		    				echo $this->Paginator->counter(array(
		    				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
		    				));
		    				?>	</p>
		    			</div>
		    			
						<div class="col-md-6"><!-- Pagination -->
								<ul class="job-pagination pull-right">
								<?php
								//echo $this->Paginator->prev(' << ' . __('previous'),array('tag' => 'li'),null,array('class' => 'prev disabled'));
								//echo $this->Paginator->numbers(array('first' => 'First page'));
								//echo $this->Paginator->next('Next >>',null,null,array('class' => 'disabled'));
								?>
									<li >
									<?php
										echo $this->Paginator->prev('Prev',array('class' => 'pag-prev'), null, array('class' => 'pag-prev disabled'));
									?>
									</li>
									<li>
									<?php
										echo $this->Paginator->numbers(array('separator' => '','currentClass' => 'pag-num active','class' =>'pag-num'));
									?>
									</li>
									<li>
									<?php 
										echo $this->Paginator->next('Next',array('class' => 'pag-next'), null, array('class' => 'pag-next disabled'));
									?>
									</li>
								</ul>
						</div><!-- Pagination -->
					</div>
		
		</div> <!-- end col-9 -->
		
		<div class="col-md-3">
			
			<?php echo $this->element('seeker_qlinks');?>
			
		</div> <!-- end col-3 -->
    
    </div> <!-- end container -->

</div> <!-- end content-about -->


