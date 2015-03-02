<div class="col-md-9 col-xs-12 seeker-request-container right-column">
	<!-- end .title-container -->
	<?php echo $this->Session->flash(); ?>
	<div class="row container-content">
		<div class="col-md-6">
		        <p>Please note, fields marked with (*) are mandatory!</p>
				<?php echo $this->Form->create('User', array('novalidate' => true,'class'=>"post-resume-form")); ?>
				<?php
					echo $this->Form->input('old_Password', array('id'=>'old_Password','type'=>'password','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo $this->Form->input('new_Password', array('id'=>'new_Password','type'=>'password','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo $this->Form->input('confirm_password', array('id'=>'confirm_password','type'=>'password','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					
					?>
				<?php
				    echo '<button type="submit" class="btn btn-default"><i class="fa  fa-save"></i>Change Password</button>';

					echo $this->Form->end();
					?>
			</div>
		</div>
        <!-- end .first-row -->
    </div>
    <!-- end .container-content -->
</div>
<!-- end .response-enquire-container -->