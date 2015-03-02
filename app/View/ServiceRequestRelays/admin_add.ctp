<div class="serviceRequestRelays form">
<?php echo $this->Form->create('ServiceRequestRelay');?>
	<fieldset>
		<legend><?php echo __('Add Service Request Relay'); ?></legend>
	<?php
		echo $this->Form->hidden('seeker_provider_request_id',array('value'=>$seekerProviderRequests[0]['SeekerProviderRequest']['id']));
        //echo $this->Form->input('service_provider_id',array('options' => $provider,'multiple'=>true,'style'=>'height:100px;width:90px'));
		
		
		echo $this->Form->input('providers',array('id'=>'facebook-theme'));
		
		echo $this->Form->hidden('service_seeker_id',array('value'=>$seekerProviderRequests[0]['SeekerProviderRequest']['service_seeker_id']));
		echo $this->Form->input('description',array('type'=>'textarea'));
		//echo $this->Form->input('created_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Request Relays'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('controller' => 'seeker_provider_requests', 'action' => 'index')); ?> </li>
		<li><?php //echo $this->Html->link(__('New Seeker Provider Request'), array('controller' => 'seeker_provider_requests', 'action' => 'add')); ?> </li>
	</ul>
    
    <ul><b>Choose the providers from the list below:</b>
	<?php foreach($Provider_listing as $Provider){
		?>
		<li><?php echo $this->SmartForm->getUserInfo($Provider['provider_service_categories']['user_id']); ?></li>
		<?php } ?>
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
				preventDuplicates: true
            });
        });
        </script>

