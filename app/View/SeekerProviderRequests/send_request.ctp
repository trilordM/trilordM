<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">New Service Enquiry</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<?php echo $this->Session->flash(); ?>
        
         
        <?php //debug($this->here);
		if (strpos($this->here,'success')== false) {
   			 $success_message=null;
		}else{
			$success_message='success';
		}
		if(empty($success_message)){?>
		
		<p>Please note, fields marked with (<span class="required">*</span>) are mandatory!</p>
		<?php echo $this->Form->create('SeekerProviderRequest', array('novalidate' => true,'class'=>"post-resume-form")); ?>
			
			<?php
				echo '<div class="row">';
				echo '<div class="col-md-6">';
				
				//echo $this->Form->input('requested_date', array('type' => 'text','class'=>'demoHeaders','id' => 'datepicker','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
				
				echo $this->Form->input('requested_date', array('type' => 'text','placeholder'=>'Click here to select requested date','class'=>'demoHeaders','id' => 'datetimepicker','div'=>array('class'=>'form-group'),'class'=>'form-control input','readonly'=>true));
				
				echo $this->Form->input('description', array('type' => 'textarea','placeholder'=>'Briefly describe the service that you want to request.','div'=>array('class'=>'form-group'),'class'=>'form-control textarea'));
				
			$options = array('div'=>array('class'=>'form-group'),'value'=>'Send', 'class'=> 'btn btn-default btn-green');
			
			echo '</div>';
			echo '<div class="col-md-12">';
			echo $this->Form->end($options); 
			echo '</div>';
			echo '</div>';
		?>	
		 <?php } ?>
		<div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->

</div> <!-- end content-about -->