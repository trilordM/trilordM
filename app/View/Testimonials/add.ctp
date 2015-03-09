<div class="col-md-9 col-xs-12 testimonial-container right-column">

    <?php echo $this->Session->flash(); ?>

    <div class="row container-content">

        <div class="col-md-9 col-xs-12">
		    <p>Please note, fields marked with (*) are mandatory!</p>

			<?php echo $this->Form->create('Testimonial', array('class'=>"post-resume-form")); ?>
				<?php echo $this->Session->flash(); ?>
				<?php
					//echo $this->Form->input('user_id');
					echo $this->Form->input('description',array('type' => 'textarea','id'=>'description','class'=>'default','div'=>array('class'=>'form-group'),'class'=>'form-control textarea','label'=>'Write down your testimonial here'));
					//echo $this->Form->input('is_active');
				?>
				
			<?php 
				echo '<button type="submit" class="btn btn-default"><i class="fa  fa-save"></i>Change Password</button>';
                echo $this->Form->end();
			?>
	
	    </div> <!-- end .grid -->

	</div> <!-- .container-content -->

</div> <!-- end .testimonial-container -->