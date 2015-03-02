<div class="serviceSeekerDeposits form">
<?php echo $this->Form->create('ServiceSeekerDeposit'); ?>
	<fieldset>
		<legend><?php echo __('Edit Service Seeker Deposit'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id',array('empty'=>'Select','label'=>'Service Seeker'));
		echo $this->Form->input('deposited_date');
		echo $this->Form->input('amount',array('value'=>$depositData['ServiceSeekerDeposit']['amount_nrs']>0?$depositData['ServiceSeekerDeposit']['amount_nrs']:$depositData['ServiceSeekerDeposit']['amount_usd']));
		$options = array('NRs'=>'NRs','USD'=>'USD');
		
		$attributes = array('default'=>$depositData['ServiceSeekerDeposit']['currency'],'legend'=>false);
		echo $this->Form->radio('currency',$options, $attributes);
		$optionStatus = array('Success'=>'Verified','Withheld'=>'Withheld');
		echo $this->Form->input('status',array('empyt'=>'Select','options'=>$optionStatus,'selected'=>$depositData['ServiceSeekerDeposit']['status']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<?php /*?><li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ServiceSeekerDeposit.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ServiceSeekerDeposit.id'))); ?></li><?php */?>
		<li><?php echo $this->Html->link(__('List Service Seeker Deposits'), array('action' => 'index')); ?></li>
		
	</ul>
</div>
