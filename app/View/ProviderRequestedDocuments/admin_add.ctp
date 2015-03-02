<div class="providerRequestedDocuments form">
<?php echo $this->Form->create('ProviderRequestedDocument'); ?>
	<fieldset>
		<legend><?php echo __('Add Provider Requested Document'); ?></legend>
	<?php
		echo $this->Form->input('provider_id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('document_file');
		echo $this->Form->input('uploaded_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Provider Requested Documents'), array('action' => 'index')); ?></li>
	</ul>
</div>
