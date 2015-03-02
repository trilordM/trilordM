<div class="col-md-9 col-xs-12 review-container right-column">

    <?php echo $this->Session->flash(); ?>

     <div class="row container-content">
            <div class="col-md-9 col-xs-12">
    		    <p>Please note, fields marked with (*) are mandatory!</p>
				<?php echo $this->Form->create('Review',array('class'=>"post-resume-form")); ?>
					<fieldset>
					<?php
						echo $this->Form->input('description',array('label'=>'Your review','div'=>array('class'=>'form-group'),'class'=>'form-control textarea'));
					?>
					</fieldset>
				<?php
					echo '<button type="submit" class="btn btn-default"><i class="fa  fa-save"></i>Add Review</button>';
					echo $this->Form->end();
				?>

	
			</div> <!-- end .grid -->
    	</div> <!-- .container-content -->

</div> <!-- end .review-container -->