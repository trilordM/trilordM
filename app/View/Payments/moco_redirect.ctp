

<div class="main-page-title"><!-- start main page title -->
    <div class="container">
        <div class="post-resume-page-title">MoCo Deposit</div>
        <div class="post-resume-phone">Call: 1660-01-13579</div>
    </div>
</div><!-- end main page title -->

<div class="container">
<div class="spacer-1">&nbsp;</div>
    <div class="row">
        <div class="col-md-8">
        <?php if($payType == 'request'){?>
           You are going to make deposit via MoCo. Please wait while we process your payment.....
            
            
            <?php echo $this->Form->create('Payments', array('autocomplete' => 'off','class'=>"post-resume-form",'action'=>'moco_redirect','type'=>'post','id'=>'payViaMoCo')); ?>
           		
				<?php echo $this->Form->hidden('amount',array('value'=>$amount));?>
                <?php echo $this->Form->hidden('your_moco',array('value'=>$mocoUserId));?>
                <?php echo $this->Form->hidden('pay_type',array('value'=>'send_request'));?>
                
                
            <?php 
				//$options = array('div'=>array('class'=>'form-group'),'value'=>'Send Your Request', 'class'=> 'btn btn-default btn-green');
				//echo $this->Form->end($options); 
			?>
           </form> 
            <script>
				$(document).ready(function() {
					 $("#payViaMoCo").submit(); 
				}); 
			</script>
           <?php }elseif($payType == 'send_request'){ ?>
           		
                <?php 
				if($http_status=='200')
					echo 'Payment request successful.';
				elseif($http_status=='202')	
					echo 'User doesn’t have an active mobile device or push notification could not be sent.';
				elseif($http_status=='400')
					echo 'Invalid request. Required parameters missing';
				elseif($http_status=='422')
					echo 'Invalid User and/or Merchant';
				else
					echo 'Your payment is under process. Please wait while we complete your payment.';	
				?>
           <?php }elseif($payType=='success'){?>
           		Your transaction has been successfully completed. Thank You.
           <?php }elseif($payType=='failure'){?>
          		 Your transaction was not successfull. Please try again.
           <?php } ?>
            <div class="spacer-2">&nbsp;</div>
        </div>

        
    </div>
    
</div>
