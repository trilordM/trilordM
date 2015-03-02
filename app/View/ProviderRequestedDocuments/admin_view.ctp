<div class="providerRequestedDocuments view">
<h2><?php echo __('Provider Requested Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($providerRequestedDocument['ProviderRequestedDocument']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provider Id'); ?></dt>
		<dd>
			<?php echo $this->Html->link($this->SmartForm->getUserInfo($providerRequestedDocument['ProviderRequestedDocument']['provider_id']), array('controller' => 'users', 'action' => 'seeker',$providerRequestedDocument['ProviderRequestedDocument']['provider_id']));; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($providerRequestedDocument['ProviderRequestedDocument']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($providerRequestedDocument['ProviderRequestedDocument']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document File'); ?></dt>
		<dd>
			<?php echo h($providerRequestedDocument['ProviderRequestedDocument']['document_file']); ?>
			&nbsp;
                      
         <?php if(file_exists(WWW_ROOT.'providers_document/provider_requested_document/'.$providerRequestedDocument['ProviderRequestedDocument']['document_file'])&&!empty($providerRequestedDocument['ProviderRequestedDocument']['document_file'])){ 
			 echo $this->Html->image('/providers_document/provider_requested_document/'.$providerRequestedDocument['ProviderRequestedDocument']['document_file'],array('width'=>140,'height'=>'100','alt'=>'Documents'));
			};?>
        
		</dd>
		<dt><?php echo __('Uploaded Date'); ?></dt>
		<dd>
			<?php echo h($providerRequestedDocument['ProviderRequestedDocument']['uploaded_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provider Requested Document'), array('action' => 'edit', $providerRequestedDocument['ProviderRequestedDocument']['id'])); ?> </li>
		<li><?php //echo $this->Form->postLink(__('Delete Provider Requested Document'), array('action' => 'delete', $providerRequestedDocument['ProviderRequestedDocument']['id']), null, __('Are you sure you want to delete # %s?', $providerRequestedDocument['ProviderRequestedDocument']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Provider Requested Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provider Requested Document'), array('action' => 'add')); ?> </li>
	</ul>
</div>
