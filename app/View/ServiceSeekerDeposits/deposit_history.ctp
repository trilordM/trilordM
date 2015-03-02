<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Deposits History</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('deposited_date'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_usd'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_nrs'); ?></th>
					<th><?php echo $this->Paginator->sort('amount_medium'); ?></th>
					<th><?php echo $this->Paginator->sort('transaction_date'); ?></th>
					<th><?php echo $this->Paginator->sort('status'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($serviceSeekerDeposits as $Deposits): ?>
			<tr>
				
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['transaction_date']); ?>&nbsp;</td>
				<td><?php echo h($Deposits['ServiceSeekerDeposit']['status']); ?>&nbsp;</td>
			</tr>
			<?php endforeach; ?>
			</tbody>
			</table>
			
			<!--<div class="paging">
			<?php
				/*echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
				echo $this->Paginator->numbers(array('separator' => ''));
				echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));*/
			?>
			</div>
			
			<div class="spacer-1">&nbsp;</div>-->
            
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
            
            <div class="spacer-1">&nbsp;</div>
		
	</div> <!-- end container -->
	
</div> <!-- end content-about -->