<div class="providerRequestedDocuments form">
<?php echo $this->Form->create('ProviderRequestedDocument'); ?>
	<fieldset>
		<legend><?php echo __('Edit Provider Requested Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ProviderRequestedDocument.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ProviderRequestedDocument.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Provider Requested Documents'), array('action' => 'index')); ?></li>
	</ul>
</div>
