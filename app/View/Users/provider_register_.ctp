<div class="service-provider-register-container">

    <div class="title-container"><!-- start main page title -->
        <div class="container">
            <div class="page-title">Service Provider > Register > <?php echo $form_id; ?></div>
        </div>
    </div><!-- end .title-container -->

	<div class="container content-container">

				<div class="row">
                	<div class="col-md-9 col-md-12 col-register-form">
					
						<?php echo $this->Form->create('User', array('novalidate' => true,'type'=>'file','role'=>'form','class'=>'contact')); ?>
                        	<?php echo $this->Session->flash(); ?>
                        	<p class="col-md-12 info">Please note, fields marked with (<span class="error">*</span>) are mandatory!</p>
							<div class="col-md-6">
								<div class="form-group">
                                <?php echo $this->Form->input('name',array('id'=>'name','class'=>'form-control name','placeholder'=>'Full Name','tabindex'=>'1'));?>
								</div>
                               
								<div class="form-group">
                                
        						<?php echo $this->Form->input('password',array('id'=>'password','class'=>'form-control name','placeholder'=>'Password  (minimum 6 characters)','tabindex'=>'3'));?>
								</div>
								
								<div class="form-group">
        						
                                 <?php echo $this->Form->input('primary_phone',array('id'=>'primary_phone','label'=>'Phone','class'=>'form-control phone','placeholder'=>'Phone / Cell','tabindex'=>'5'));?>
								</div>
										
							</div>
					
							<div class="col-md-6">
                            
								<div class="form-group">
                                <?php echo $this->Form->input('email',array('id'=>'email','type'=>'text','class'=>'form-control email','placeholder'=>'Email','tabindex'=>'2'));?>
								</div>
                                
                                <div class="form-group">
                                 <?php echo $this->Form->input('confirm_password',array('id'=>'confirm_password','type'=>'password','class'=>'form-control name','placeholder'=>'Confirm Password','tabindex'=>'4'));?>
								</div>
								
		
        						<!--<div class="form-group">
                                <?php //if($form_id =='company'){
								//echo $this->Form->input('PAN/VAT',array('id'=>'PAN/VAT','type'=>'text','label'=>'PAN No./VAT No.','class'=>'form-control email','placeholder'=>'PAN No./VAT No.','tabindex'=>'2'));
								//}else{
									//echo $this->Form->input('citizenship_number',array('id'=>'citizenship_number','type'=>'text','label'=>'Citizenship No.','class'=>'form-control email','placeholder'=>'Citizenship Number','tabindex'=>'2'));
								//}?>
								</div>-->
                                
								<!--<div class="form-group">
                                <?php //echo $this->Form->input('temporary_address',array('id'=>'temporary_address','label'=>'Address','class'=>'form-control subject','placeholder'=>'Address','tabindex'=>'6'));?>
								</div>-->
                                
                                <div class="form-group">
                                <?php echo $this->Form->input('category',array('id'=>'category','label'=>'Skill','class'=>'form-control name','placeholder'=>'Suggest what skill you can provide such as Plumber, Electrician etc.','tabindex'=>'2'));?>
								</div>
							</div>							
							<div class="col-md-12">
                                <p>
                                    <?php  echo $this->Form->button('REGISTER',array('type'=>'submit','class'=>'btn btn-default btn-blue'));?>
                               </p>	
							</div>
                            
                            <?php echo $this->Form->end(); ?>
                            	
					</div><!-- end grid .col-register-form -->
                    <div class="col-md-3 col-md-12 content-right-sidebar">

                        <?php echo $this->element('login')?>

                    </div><!-- end .content-right-sidebar-->

                </div> <!-- end row -->
</div><!-- end .service-provider-register-container -->