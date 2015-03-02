<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<div class="faqs form">
<?php echo $this->Form->create('Faq'); ?>
	<fieldset>
		<legend><?php echo $type=='provider'?'Add Provider Faqs':'Add Customer Faqs'; ?></legend>
	<?php
		echo $this->Form->input('title');
		echo $this->Form->input('description',array('class'=>'ckeditor'));
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Faqs'), array('action' => 'index',$type)); ?></li>
	</ul>
</div>
