<div class="servicePackageRequests form">
<?php echo $this->SmartForm->getUserInfo($servicePackages['ServicePackageRequest']['seeker_id']).' has requested service package of '.$servicePackages['ServicePackage']['title'].' for '.$servicePackages['ServicePackageRequest']['requested_date'].' priced NRs '.$servicePackages['ServicePackageRequest']['rate']?>
<?php echo $this->Form->create('ServicePackageRequest'); ?>
	<fieldset>
		<legend><?php echo __('Add Service Package Request'); ?></legend>
	<?php
		echo $this->Form->input('providers',array('id'=>'facebook-theme'));
		echo $this->Form->input('assigned_date');
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Service Package Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Service Packages'), array('controller' => 'service_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package'), array('controller' => 'service_packages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Service Package Assigned Providers'), array('controller' => 'service_package_assigned_providers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Service Package Assigned Provider'), array('controller' => 'service_package_assigned_providers', 'action' => 'add')); ?> </li>
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