<div class="users index">
	<h2><?php echo __('Providers'); ?></h2>
	
	<?php foreach ($users as $user): ?>
    <div>
    <ul>
		<li>
			<B><?php echo __('Profile Photo:');?></B>
			
           <?php 
				echo $this->Html->image('/providers_photo/'.$user['User']['profile_photo'],array('width'=>140,'height'=>'100','alt'=>'No Image'));
			?>
        </li>
       	<li>   
			<B><?php echo __('Name:'); ?></B>
            <?php echo h($user['User']['name']); ?>&nbsp;
        </li>
        <li>   
			<B><?php echo __('Expertise Level:');?></B>
            <?php echo h($user['User']['expertise_level']); ?>&nbsp;
        </li>		
		</ul>
			<?php echo $this->Html->link(__('View Details'), array('action' => 'provider', $user['User']['id'])); ?>
        </div>
	<?php endforeach; ?>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>
    </p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
    
    <?php 
		echo $this->Form->create('User',array('action'=>'provider_record','type' => 'get'));
		echo $this->Form->input('keyword',array('placeholder'=>'Search','label'=>false));
		echo $this->Form->input('Category',array('empty'=>'Select','options' =>$serviceCategories,'escape'=>false));
		echo $this->Form->input('level',array('empty'=>'Select','options'=>array('expert'=>'Expert','intermediate'=>'Intermediate','basic'=>'Basic')));
		echo $this->Form->end(_('Search'));
	?>
</div>