<div class="main-page-title"><!-- start main page title -->
    <div class="container">
        <div class="page-title">Esewa Deposit
        <p><small>You are going to make deposit via Esewa. Please enter amount to pay.</small></p>
        </div>
    </div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
		
			<div class="col-md-9">
				
				<?php echo $this->Session->flash(); ?>
				
				 <?php echo $this->Form->create('Payments', array('class'=>"post-resume-form",'action'=>'esewa_redirect','type'=>'post')); ?>
				 
				 	<?php echo $this->Form->input('amount', array('div'=>array('class'=>'form-group'),'class'=>'form-control input','label'=>'Amount in NRs','id'=>'amount'));?><span id="error-amount"></span>
				     
				    
				 <?php 
						$options = array('div'=>array('class'=>'form-group'),'value'=>'Send Your Request', 'class'=> 'btn btn-default btn-green');
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
<script>
$( "form" ).submit(function( event ) {
  
  if ( $( "#amount" ).val() == "" ) {
    $( "#error-amount" ).text( "Pleas enter amount" ).show().fadeOut( 1000 );
    return false;
  }
 
  
  //$( "#txAmt" ).val($( "#amount" ).val());
 // return false;
 //event.preventDefault();
});
</script>

