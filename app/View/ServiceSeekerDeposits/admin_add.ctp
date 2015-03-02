<div class="serviceSeekerDeposits form">
<?php echo $this->Form->create('SeekerDeposit'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Seeker Deposit'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('id'=>'facebook-theme','label'=>'Service Seeker'));
		
		echo $this->Form->input('amount');
		$options = array('NRs'=>'NRs','USD'=>'USD');
		$attributes = array('default'=>'NRs','legend'=>false);
		echo $this->Form->radio('currency',$options, $attributes);
		//echo $this->Form->input('description',array('type'=>'radio','options'=>$options,'hiddenField'=>false));
		//echo $this->Form->input('deposited_bank');
		//echo $this->Form->input('bank_location');
		//echo $this->Form->input('deposited_by');
		echo $this->Form->input('deposited_date', array(
								'type' => 'date',
								'dateFormat' => 'DMY',
								'minYear' => date('Y')-1,
								'maxYear' => date('Y')+1));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Seeker Deposits'), array('action' => 'index')); ?></li>
	</ul>
</div>
<?php
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input-facebook');
?>
<script type="text/javascript">
        $(document).ready(function() {
           
			$("#facebook-theme").tokenInput(<?php echo json_encode($getProvider)?>, {
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit: 1
            });
        });
        </script>