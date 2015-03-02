<div class="contentPages view">
<h2><?php echo __('Content Page'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($contentPage['ContentPage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($contentPage['ContentPage']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Slug'); ?></dt>
		<dd>
			<?php echo h($contentPage['ContentPage']['slug']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($contentPage['ContentPage']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($contentPage['ContentPage']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Content Page'), array('action' => 'edit', $contentPage['ContentPage']['id'])); ?> </li>
		<?php /*?><li><?php echo $this->Form->postLink(__('Delete Content Page'), array('action' => 'delete', $contentPage['ContentPage']['id']), null, __('Are you sure you want to delete # %s?', $contentPage['ContentPage']['id'])); ?> </li><?php */?>
		<li><?php echo $this->Html->link(__('List Content Pages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Content Page'), array('action' => 'add')); ?> </li>
	</ul>
</div>
