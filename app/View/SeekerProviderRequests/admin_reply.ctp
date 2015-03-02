<div class="seekerProviderRequests form">
<?php echo $this->Form->create('SeekerProviderRequest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Provider Request'); ?></legend>
	<?php echo $this->Form->input('id');
		//echo $this->Form->input('service_seeker_id');
		//echo $this->Form->input('service_provider_id');
		//echo $this->Form->input('requested_date_from');
		//echo $this->Form->input('requested_date_to');
		//echo $this->Form->input('created_date');
		
		echo $this->Form->input('provider',array('id'=>'facebook_theme','label'=>'Provider'));
		echo $this->Form->input('description',array('type'=>'textarea','readonly'=>true));
		echo $this->Form->input('reply',array('type'=>'textarea'));
		
		//echo $this->Form->input('status');
		//echo $this->Form->input('assigned_date', array('type' => 'text','class'=>'demoHeaders','id' => 'datepicker'));
		// echo $this->Form->input('completed_date', array('type' => 'text','class'=>'demoHeaders','id' => 'datepicker1'));
		// echo $this->Form->input('withdrawn_date', array('type' => 'text','class'=>'demoHeaders','id' => 'datepicker2'));
		//echo $this->Form->input('assigned_date');
		//echo $this->Form->input('completed_date');
		//echo $this->Form->input('withdrawn_date');
		echo $this->Form->input('total');
		
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeekerProviderRequest.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeekerProviderRequest.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>


 <?php
echo $this->Html->script('jquery.tokeninput');
echo $this->Html->css('token-input-facebook');
?>
<script type="text/javascript">
        $(document).ready(function() {
           
			$("#facebook_theme").tokenInput(<?php echo json_encode($getProvider)?>, {
                theme: "facebook",
				preventDuplicates: true,
				tokenLimit : 1,
			  	prePopulate : <?php echo json_encode($provider_name)?>
            });
        });
</script>
