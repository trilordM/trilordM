<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Application Form</div>
	</div>
</div><!-- end main page title -->

                        <?php echo $this->Session->flash(); ?>

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
			
			<div class="col-md-9">
				
				<?php echo $this->Form->create('JobApplier',array('novalidate' => true,'type'=>'file','class'=>"post-resume-form")); ?>
						<?php
							//echo $this->Form->input('career_id');
							echo $this->Form->input('name',array('div'=>array('type' => 'text','class'=>'form-group'),'class'=>'form-control input'));
							echo $this->Form->input('email',array('div'=>array('type' => 'text','class'=>'form-group'),'class'=>'form-control input'));
							echo $this->Form->input('mobile_no',array('div'=>array('type' => 'text','class'=>'form-group'),'class'=>'form-control input'));
							echo $this->Form->input('address',array('div'=>array('type' => 'textarea','class'=>'form-group'),'class'=>'form-control textarea'));
							echo $this->Form->input('your_cv',array('div'=>array('class'=>'form-group'),'type'=>'file','label'=>'Your CV'));
							//echo $this->Form->input('applied_date');
						?>
						<?php 
							$options = array('div'=>array('class'=>'form-group'),'value'=>'Submit', 'class'=> 'btn btn-default btn-green');
				echo $this->Form->end($options); ?>
				
			</div> <!-- end col-9 -->
			
			<div class="col-md-3">
				
				<div class="list-group">
				  	
				  	<h3>Most Recent Openings</h3>
				  	<?php foreach($careers_list as $career):?>
					
						
					<a href="<?php echo SITE_URL.'careers/view_more/'.$career['careers']['id']?>" class="list-group-item">
                     <h4 class="list-group-item-heading"><?php echo $career['careers']['title'];?></h4>
					</a>
				  <?php endforeach; ?>
				  
				</div> <!-- end list-group -->
				
			</div> <!-- end col-3 -->
		
		</div> <!-- end row -->
        
		
		
		<div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->

</div> <!-- end content-about -->
