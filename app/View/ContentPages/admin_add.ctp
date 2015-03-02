<?php echo $this->Html->script('ckeditor/ckeditor'); ?>
<div class="contentPages form">
<?php echo $this->Form->create('ContentPage'); ?>
	<fieldset>
		<legend><?php echo __('Add Content Page'); ?></legend>
	<?php
		echo $this->Form->input('title');
		//echo $this->Form->input('slug');
		echo $this->Form->input('description',array('class'=>'ckeditor'));
		echo $this->Form->input('is_active');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Content Pages'), array('action' => 'index')); ?></li>
	</ul>
</div>
