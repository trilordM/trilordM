<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Change Profile Picture</div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
			
			<div class="row">
			
			<div class="col-md-2">
            <?php if(file_exists(WWW_ROOT.'seekers_photo/medium/'.$user['User']['profile_photo'])&&!empty($user['User']['profile_photo'])){ 
				 			echo $this->Html->image('/seekers_photo/medium/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','class'=>'img-responsive job-detail-logo img-rounded','alt'=>'Profile_pic'));
				}else{
							echo $this->Html->image('avatar.gif',array('width'=>140,'height'=>'100','class'=>'img-responsive job-detail-logo img-rounded','alt'=>'No Image')) ;
				}
				?>
            
			</div>
			
			<div class="col-md-10">
			
			<?php
			echo $this->Form->create('User',array('type'=>'file')); ?>
			<?php
			echo $this->Form->input('profile_image',array('type'=>'file','label'=>false));
			// debug($user['User']['profile_photo']);
			 echo $this->Form->hidden('img_name',array('value'=>$user['User']['profile_photo']));
			
			?>
			<?php  echo $this->Form->button('SUBMIT',array('type'=>'submit','class'=>'btn btn-default btn-green'));?>
			<?php echo $this->Form->end(); ?>
			
			
			</div>
			
			</div> <!-- end row -->
		
		<div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->

</div> <!-- end content-about -->