<div class="main-page-title"><!-- start main page title -->
			<div class="container">
				<h4 class="login-title">Reset Password</h4>
                
                        <?php echo $this->Session->flash(); ?>
				<div class="row">
					<div class="col-md-5">
						<div class="form-singin-container">
                        <?php
							if($validity==1){
						?>		
						<?php echo $this->Form->create('User', array('id'=>'UserActualResetForm','novalidate' => true,'type'=>'file','role'=>'form','autocomplete' => 'off')); ?>
								<div class="form-group">
                                 <?php echo $this->Form->input('password1',array('type'=>'password','id'=>'password1','class'=>'form-control input-form','label'=>false,'placeholder'=>'Password'));?>
									<div class="singin-aksen"></div>
								</div>
								<div class="form-group">
                                <?php echo $this->Form->input('confirm_password',array('type'=>'password','id'=>'confirm_password','class'=>'form-control input-form','label'=>false,'placeholder'=>'Confirm Password'));?>
									<div class="singin-aksen"></div>
                                    <?php  echo $this->Form->button('SUBMIT',array('type'=>'submit','class'=>'btn btn-default btn-green'));?>
								
									</div>
							<?php echo $this->Form->end(); ?>
                            
                            <?php }else{echo 'Nothing to show..';}?>
						</div>
					</div>

					<div class="col-md-7 singin-page">
						<h5>Not A Member? Register Now!</h5>
						<div class="row">
							<div class="col-md-6">
								<ul class="style-list-2">
									<li>One single venue for all services from the comfort of your home or office.</li>
									<li>Trusted reviews and ratings from service users.</li>
									<li>Collaboration with law enforcement to ensure safety.</li>
									<li>Transparent, Accountable, and Trustworthy Services found nowhere else in Nepal.</li>
								</ul>
							</div>

							<div class="col-md-6">
								<ul class="style-list-2">
									<li>A wide array of listings and rates of service providers</li>
									<li>Exclusive discounts and deals</li>
									<li>Value for money</li>
									<li>Opportunity to review and rate</li>
									<li>Verified, Secure, Reliable, Hassle free service</li> 
								</ul>
							</div>
						</div>
						<p>
                        <a href=".modal-dialog" id="magnefic-popup4" class="btn btn-default btn-blue">REGISTER</a></p>
						
					</div>
				</div>
			</div>
		</div><!-- end main page title -->
        
        
        
<script>

$(document).ready(function() {
	// validate signup form on keyup and submit
	$("#UserActualResetForm").validate({
		rules: {
			"data[User][password1]": {
				required: true,
				minlength: 5
			},
			"data[User][confirm_password]": {
				required: true,
				minlength: 5,
				equalTo: "#password1"
			},
		},
		messages: {
			"data[User][password1]": {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			"data[User][confirm_password]": {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			}
		}
	});
	
	

});
</script>