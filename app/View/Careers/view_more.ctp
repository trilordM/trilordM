

<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Career</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
	        
	        <div class="col-md-9">
				
				<div class="jumbotron">
					<h3><?php echo($career['Career']['title']);?></h3>
					<p><?php echo ($career['Career']['description']);?></p>
	                <?php $time=$this->Time->format('F jS, Y',$career['Career']['valid_till']);?>
					<p><em>Application Deadline:</em> <?php echo $time?></p>
					<p><?php echo $this->Html->link('Apply',array('controller' => 'JobAppliers', 'action' => 'add',$career['Career']['id']), array('class'=>'btn btn-red btn-default'));?></p>
				</div>
				
			</div> <!-- end col-9 -->
			
			<div class="col-md-3">
				
				<div class="list-group">
				  	
				  	<h3>Most Recent Openings</h3>
				  	<?php foreach($careers_list as $career):?>
					
						
					<a href="<?php echo SITE_URL.'careers/view_more/'.$career['Career']['id']?>" class="list-group-item">
					<h4 class="list-group-item-heading"><?php echo $career['Career']['title'];?></h4>
					</a>
				  <?php endforeach; ?>
				</div> <!-- end list-group -->
				
			</div> <!-- end col-3 -->
        
        </div> <!-- end row -->
        
        <div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->

</div> <!-- end content-about -->