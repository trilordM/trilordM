<div class="seekerProviderRequests form">
<?php echo $this->Form->create('SeekerProviderRequest'); ?>
	<fieldset>
		<legend><?php echo __('Edit Seeker Provider Request'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('service_seeker_id');
		//echo $this->Form->input('service_provider_id');
		echo $this->Form->input('requested_date_from');
		echo $this->Form->input('requested_date_to');
		//echo $this->Form->input('created_date');
		echo $this->Form->input('description', array('type' => 'textarea'));
		//echo $this->Form->input('status');
		//echo $this->Form->input('assigned_date');
		//echo $this->Form->input('completed_date');
		//echo $this->Form->input('withdrawn_date');
        echo $this->Form->label('Rate');
        echo "&nbsp;&nbsp;";
		
        $n=count($rate);

        for($i=0;$i<$n;$i++){
            $a[$i]="Rs".$rate[$i]['SPR']['rate'].$rate[$i]['RP']['title'];
		   // echo $rate[$i]['RP']['title']."&nbsp Rs".$rate[$i]['SPR']['rate']."&nbsp".$this->Form->radio('opt',$options,$attributes);
		    
		}

            $options=$a;
		    $attributes=array('legend'=>false);
         

            echo $this->Form->radio('opt',$options,$attributes);

		echo $this->Form->input('remarks');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SeekerProviderRequest.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SeekerProviderRequest.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Seeker Provider Requests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Rate Packages'), array('controller' => 'rate_packages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rate Package'), array('controller' => 'rate_packages', 'action' => 'add')); ?> </li>
	</ul>
</div>
