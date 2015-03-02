<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Bank Deposit</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
		
			<div class="col-md-9">
				
				<p>Please note, fields marked with (<span class="required">*</span>) are mandatory!</p>
				<?php echo $this->Session->flash(); ?>
				
				<?php echo $this->Form->create('Payment', array('class'=>"post-resume-form")); ?>
				
				<?php
				    
				    echo '<div class="col-md-6">';
					echo $this->Form->input('amount',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					$options = array('NRs'=>'NRs','USD'=>'USD');
					$attributes = array('default'=>'NRs','legend'=>false);
					echo $this->Form->radio('currency',$options, $attributes);
					//echo $this->Form->input('description',array('type'=>'radio','options'=>$options,'hiddenField'=>false));
					
					echo $this->Form->input('deposited_date', array('div'=>array('class'=>'form-group select-group'),
											'type' => 'date',
											'dateFormat' => 'DMY',
											'minYear' => date('Y')-1,
											'maxYear' => date('Y')+1));
					
					echo '</div>';
					
					echo '<div class="col-md-6">';
					echo $this->Form->input('deposited_bank',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo $this->Form->input('bank_location',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo $this->Form->input('deposited_by',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					
					echo '</div>';
				?>
				
				<?php 
				echo '<div class="col-md-12">';
				
				echo '</div>';
				?>
				
				<?php 
							$options = array('div'=>array('class'=>'form-group'),'value'=>'Submit', 'class'=> 'btn btn-default btn-green');
							echo $this->Form->end($options); 
						?>
				
			</div> <!-- end col-9 -->
			
			<div class="col-md-3">
				
				<?php echo $this->element('seeker_qlinks');?>
				
			</div> <!-- end col-3 -->
		
		</div> <!-- end row -->
		
        <div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->
	
</div> <!-- end content-about -->