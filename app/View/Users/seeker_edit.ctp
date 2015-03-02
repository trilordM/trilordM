<div class="col-md-9 col-xs-12 user-profile-edit-container right-column">
	<!-- end .title-container -->
	<?php echo $this->Session->flash(); ?>
	<div class="row container-content">
		<div class="col-md-9">
			<p>Please note, fields marked with (<span class="required">*</span>) are mandatory!</p>
			<?php echo $this->Form->create('User', array('novalidate' => true,'class'=>"post-resume-form")); ?>
			<?php
				echo $this->Form->input('id');

				echo '<div class="row">';

				echo '<div class="col-md-6">';
				echo $this->Form->input('name',array('div'=>array('class'=>'form-group'),'class'=>'form-control input', 'tabindex'=>'1'));
				echo '</div>';

				echo '<div class="col-md-6">';
				echo $this->Form->input('email',array('readonly'=>true,'div'=>array('class'=>'form-group'),'class'=>'form-control input','tabindex'=>'2'));
				echo '</div>';

				echo '<div class="col-md-6">';
				echo $this->Form->input('primary_phone',array('div'=>array('class'=>'form-group'),'label'=>'Phone / Cell No.','class'=>'form-control input','tabindex'=>'3'));
				echo '</div>';


				echo '<div class="col-md-6">';
				echo $this->Form->input('dob_english', array('type' => 'text','class'=>'demoHeaders','label'=>'DOB','id' => 'datepicker','div'=>array('class'=>'form-group'),'class'=>'form-control input','tabindex'=>'4'));
				echo '</div>';

				echo '<div class="col-md-6">';
				echo $this->Form->input('permanent_address',array('div'=>array('class'=>'form-group'),'class'=>'form-control input','tabindex'=>'5'));
				echo '</div>';

				echo '<div class="col-md-6">';
				echo $this->Form->input('temporary_address',array('div'=>array('class'=>'form-group'),'class'=>'form-control input','tabindex'=>'6'));
				echo '</div>';

				echo '<button type="submit" class="btn btn-default"><i class="fa  fa-save"></i>Save</button>';

                echo $this->Form->end();
				echo '</div>';
			?>
		</div>
		<!-- end .grid -->
	</div>
	<!-- end .row .container-content -->
</div>
<!-- end .grid .user-profile-edit-container -->
