<div class="providerRequestedDocuments full-width">
	<h2><?php echo __('Provider Uploaded Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table-bordered">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('provider_id'); ?></th>
			<th><?php echo $this->Paginator->sort('title'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('document_file'); ?></th>
			<th><?php echo $this->Paginator->sort('uploaded_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($providerRequestedDocuments as $providerRequestedDocument): ?>
	<tr>
		<td><?php echo h($providerRequestedDocument['ProviderRequestedDocument']['id']); ?>&nbsp;</td>
		<td><?php echo $this->Html->link($this->SmartForm->getUserInfo($providerRequestedDocument['ProviderRequestedDocument']['provider_id']), array('controller' => 'users', 'action' => 'seeker',$providerRequestedDocument['ProviderRequestedDocument']['provider_id'])); ?>&nbsp;</td>
		<td><?php echo h($providerRequestedDocument['ProviderRequestedDocument']['title']); ?>&nbsp;</td>
		<td><?php echo h(substr($providerRequestedDocument['ProviderRequestedDocument']['description'],0,120).'...'); ?>&nbsp;</td>
		<td><?php echo h($providerRequestedDocument['ProviderRequestedDocument']['document_file']); ?>&nbsp;</td>
		<td><?php echo h($providerRequestedDocument['ProviderRequestedDocument']['uploaded_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $providerRequestedDocument['ProviderRequestedDocument']['id'])); ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $providerRequestedDocument['ProviderRequestedDocument']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $providerRequestedDocument['ProviderRequestedDocument']['id']), null, __('Are you sure you want to delete # %s?', $providerRequestedDocument['ProviderRequestedDocument']['id'])); ?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
