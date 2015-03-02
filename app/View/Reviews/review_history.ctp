<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Review History</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<table cellpadding="0" cellspacing="0" class="table table-bordered table-striped">
			<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('service_provider_id'); ?>&nbsp;</th>
					<th><?php echo $this->Paginator->sort('description'); ?>&nbsp;</th>
					<th><?php echo $this->Paginator->sort('review_date'); ?>&nbsp;</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($review_history as $review): ?>
			<tr>
				<td> <?php //debug($history);die;
				echo $this->SmartForm->getUserInfo($review['Review']['service_provider_id']);
				?>&nbsp;</td>
				<td><?php echo substr($review['Review']['description'],'0','50').'...'; ?>&nbsp;</td>
				<td><?php echo h($review['Review']['review_date']);?>&nbsp;</td>
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