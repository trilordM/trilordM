<div class="main-page-title"><!-- start main page title -->
    <div class="container">
        <div class="page-title">MoCo Deposit <p><small>You are going to make deposit via MoCo.</small></p></div>
    </div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
		
			<div class="col-md-9">
				
				<?php echo $this->Session->flash(); ?>
				<p>Please enter amount and your MoCo User Id to pay. Be sure you have downloaded MoCo app in your mobile to initiate the payment.</p>
				<?php echo $this->Session->flash(); ?>
				
				 <?php echo $this->Form->create('Payments', array('autocomplete' => 'off','class'=>"post-resume-form",'action'=>'moco_redirect','type'=>'post')); ?>
				 
				 	<?php echo $this->Form->input('amount', array('div'=>array('class'=>'form-group'),'class'=>'form-control input','label'=>'Amount in NRs','id'=>'amount'));?><span id="error-amount"></span>
				     
				     <?php echo $this->Form->input('your_moco', array('div'=>array('class'=>'form-group'),'class'=>'form-control input','label'=>'Your MoCo User Id','id'=>'user_moco_id'));?><span id="error-moco-id"></span>
				     
				  	 <?php echo $this->Form->hidden('pay_type',array('value'=>'request'));?>  
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
  
  var valid = 1;
  if ( $( "#amount" ).val() == "" ) {
    $( "#error-amount" ).text( "Pleas enter amount" ).show().fadeOut( 1000 );
    valid = 0;
  }
  
  if ( $( "#user_moco_id" ).val() == "" ) {
    $( "#error-moco-id" ).text( "Pleas enter your MoCo User Id" ).show().fadeOut( 1000 );
    valid = 0;
  }
 	
 	if(valid==0)
	{
		return false;
	}else{
		var c = confirm("Are you sure you want to make the payment?");
  		return c;
		return true;	
	}
  
  //$( "#txAmt" ).val($( "#amount" ).val());
 // return false;
 //event.preventDefault();
});
</script>

