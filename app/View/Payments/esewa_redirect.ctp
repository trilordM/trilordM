

<div class="main-page-title"><!-- start main page title -->
    <div class="container">
        <div class="post-resume-page-title">Esewa Deposit</div>
        <div class="post-resume-phone">Call: 1660-01-13579</div>
    </div>
</div><!-- end main page title -->

<div class="container">
<div class="spacer-1">&nbsp;</div>
    <div class="row">
        <div class="col-md-8">
           You are going to make deposit via Esewa. Please wait while we redirect you to Esewa Payment.....
            <?php //echo $this->Form->create('Payments', array('class'=>"post-resume-form",'url'=>$esewa[0]['paypal_settings']['esewa_url'])); ?>
            <form id="payViaEsewa" action = "<?php echo $esewa[0]['paypal_settings']['esewa_url']?>" method="POST">
            	
                <input value="<?php echo $amount?>" id="amount" name="amt" type="hidden">
                <input value="<?php echo $txAmt?>" id="txAmt" name="txAmt" type="hidden">
                <input value="<?php echo $tAmt?>" name="tAmt" id="tAmt" type="hidden">
                <input value="<?php echo $psc?>" name="psc" id="psc" type="hidden">
				<input value="<?php echo $pdc?>" name="pdc" id="pdc" type="hidden">
                <input value="<?php echo $esewa[0]['paypal_settings']['esewa_service_code']?>" name="scd" type="hidden">
                <input value="<?php echo $unique_id?>" name="pid" type="hidden">
                <input value="<?php echo SITE_URL.'payments/esewa_success'?>?q=su" type="hidden" name="su">
                <input value="<?php echo SITE_URL.'payments/esewa_success'?>?q=fu" type="hidden" name="fu">
            <?php 
				//$options = array('div'=>array('class'=>'form-group'),'value'=>'Send Your Request', 'class'=> 'btn btn-default btn-green');
				//echo $this->Form->end($options); 
			?>
           </form> 
           
            <div class="spacer-2">&nbsp;</div>
        </div>

        
    </div>
    
</div>
<script>
$(document).ready(function() {
	
	$("#payViaEsewa").submit(); 
}); 
</script>

