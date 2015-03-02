<?php /*?><div class="servicePackageRequests form">
<?php echo $this->Form->create('ServicePackageRequest'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Package Request'); ?></legend>
	<?php
		echo $this->Form->input('service_package_id');
		echo $this->Form->input('seeker_id');
		echo $this->Form->input('requested_date');
		echo $this->Form->input('description');
		echo $this->Form->input('status');
		echo $this->Form->input('assigned_date');
		echo $this->Form->input('is_locked');
		echo $this->Form->input('locked_by');
		echo $this->Form->input('completed_date');
		echo $this->Form->input('rate');
		echo $this->Form->input('requested_amount');
		echo $this->Form->input('freezed_amount');
		echo $this->Form->input('completed_amount');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div><?php */?>




<div class="main-page-title"><!-- start main page title -->
    <div class="container">
        <div class="post-resume-page-title">Service Package Request</div>
        <div class="post-resume-phone">Toll Free: 1660-01-13579</div>
    </div>
</div><!-- end main page title -->

                       

<div class="container">
<div class="spacer-1">&nbsp;</div>
    <div class="row">
        <div class="col-md-8">
            You are requesting for the service package <?php echo $servicePackages['ServicePackage']['title']?> of NRs <?php echo $servicePackages['ServicePackage']['rate']?>. This package is valid till <?php echo $servicePackages['ServicePackage']['valid_till']?>
            <?php echo $this->Form->create('ServicePackageRequest', array('class'=>"post-resume-form")); ?>
             
			 <?php echo $this->Session->flash(); ?>
             
            	<?php echo $this->Form->input('requested', array('div'=>array('class'=>'form-group'),'class'=>'form-control input','id'=>'datepicker','label'=>'Service Required Date','placeholder'=>date('Y-m-d')));?>
                <?php echo $this->Form->input('description', array('div'=>array('class'=>'form-group'),'class'=>'form-control textarea'));?>
                <?php echo $this->Form->hidden('rate', array('value'=>$servicePackages['ServicePackage']['rate']));?>
            <?php 
				$options = array('div'=>array('class'=>'form-group'),'value'=>'Send Your Request', 'class'=> 'btn btn-default btn-green');
				echo $this->Form->end($options); 
			?>
            
           
            <div class="spacer-2">&nbsp;</div>
        </div>

    </div>
    
</div>
 <script type="text/javascript">
        $(document).ready(function() {
          
		 
			
			$('#magnefic-popup4').magnificPopup({
				type: 'inline',
				preloader: false,
				focus: '#username',
				modal: true,
				
			});
			$(document).on('click', '.close', function (e) {
				e.preventDefault();
				$.magnificPopup.close();
			});
			
			//$(document).on('click', '.popup-modal-dismiss', function (e) {
//				e.preventDefault();
//				$.magnificPopup.close();
//			});
			
        });
        </script>
