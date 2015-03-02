<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Completed Service Request History</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('Enquired By'); ?></th>
					<th><?php if($status!='New'){
								echo $this->Paginator->sort('assigned_date');
								}?></th>
					<th><?php if($status=='Completed'){
								echo $this->Paginator->sort('completed_date'); 
							}?></th>
					<th><?php echo $this->Paginator->sort('rate_package_id'); ?></th>
					<th><?php echo $this->Paginator->sort('working_hour'); ?></th>
					<th><?php echo $this->Paginator->sort('Working_days'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($service_history as $history): ?>
			<tr>
				<td> <?php echo $this->SmartForm->getUserInfo($history['SeekerProviderRequest']['service_seeker_id']);?>&nbsp;</td>
				<td><?php if($status!='New'){
							echo h($history['SeekerProviderRequest']['assigned_date']); 
							}?>&nbsp;</td>
				<td><?php if($status=='Completed'){
							echo h($history['SeekerProviderRequest']['completed_date']); 
						}?>&nbsp;</td>
				<td>
		            <?php echo $history['RatePackage']['title']; ?>
				</td>
				<td><?php echo h($history['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
				<td><?php echo h($history['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
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
            
            <div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->

</div> <!-- end content-about -->