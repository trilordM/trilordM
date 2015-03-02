<div class="main-page-title"><!-- start main page title -->
	<div class="container">
		<div class="page-title">Paypal Deposit <p><small>( Please be assured, we do not store your credentials. )</small></p></div>
	</div>
</div><!-- end main page title -->

<div class="content-about">

	<div class="container">
		
		<div class="spacer-1">&nbsp;</div>
		
		<div class="row">
		
			<div class="col-md-9">
			
				<p>Please note, fields marked with (<span class="required">*</span>) are mandatory!</p>
				
				<?php echo $this->Session->flash(); ?>
				
				<?php echo $this->Form->create('Payment', array('class'=>"post-resume-form")); ?>
				
				<?php
				    echo '<div class="row">';
				    
				    echo '<div class="col-md-6">';
					echo $this->Form->input('amount',array('placeholder'=>'USD','div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo '</div>';
					
					echo '<div class="col-md-6">';
					echo $this->Form->input('credit_card_number',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo '</div>';
					
					echo '<div class="col-md-6">';
					echo '<div class="form-group required">';
					echo '<label style="display: block">'.'Card Expiry Date'.'</label>';
					echo $this->Form->input('card_expiry_year', array('div'=>false,'label'=>false,'empty'=>'Year',
											'options'=> array_combine(range(date('Y'),2040),range(date('Y'),2040))
											));
					echo $this->Form->input('card_expiry_month', array('div'=>false,'label'=>false,'empty'=>'Month',
											'options'=>array_combine(range(1,12),range(1,12))));
					echo '</div>';
					echo '</div>';
					
					echo '<div class="col-md-6">';
					echo $this->Form->input('cvv',array('div'=>array('class'=>'form-group'),'class'=>'form-control input'));
					echo '</div>';
				?>
				
				<?php 
						$options = array('div'=>array('class'=>'form-group'),'value'=>'Submit', 'class'=> 'btn btn-default btn-green');
						echo '</div>';
						echo $this->Form->end($options); 
					?>
			
			</div>
		
			<div class="col-md-3">
				
				<?php echo $this->element('seeker_qlinks');?>
				
			</div>
		
		</div>
		
		
        <div class="spacer-1">&nbsp;</div>
	
	</div> <!-- end container -->
	
</div> <!-- end content-about -->

<?php /*?><div class="payments form">
<?php echo $this->Form->create('Payment'); ?>
	<fieldset>
		<legend><?php echo __('Recharge via Paypal'); ?></legend>
	<?php
		echo $this->Form->input('amount',array('after'=>'USD'));
		echo $this->Form->input('credit_card_number');
		echo 'Card Expiry Date';
		echo $this->Form->input('card_expiry_year', array('div'=>false,'label'=>false,'empty'=>'Year',
								'options'=> array_combine(range(date('Y'),2040),range(date('Y'),2040))
								));
		echo $this->Form->input('card_expiry_month', array('div'=>false,'label'=>false,'empty'=>'Month',
								'options'=>array_combine(range(1,12),range(1,12))));
		
		echo $this->Form->input('cvv');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

<?php */?>