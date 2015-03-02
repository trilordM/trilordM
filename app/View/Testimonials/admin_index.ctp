<div class="testimonials full-width">
	<h2><?php echo __('Testimonials'); ?></h2>
	
	<div class="table-wrapper">
	
		<table cellpadding="0" cellspacing="0" class="table-bordered">
		
		<thead>
		<tr>
				<th><?php echo $this->Paginator->sort('id'); ?></th>
				<th><?php echo $this->Paginator->sort('user_id'); ?></th>
				<th><?php echo $this->Paginator->sort('description'); ?></th>
				<th><?php echo $this->Paginator->sort('created_date'); ?></th>
				<th><?php echo $this->Paginator->sort('is_active'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		</thead>
		
		<tbody>
		<?php foreach ($testimonials as $testimonial): ?>
		<tr>
			<td><?php echo h($testimonial['Testimonial']['id']); ?>&nbsp;</td>
			<td>
				<?php echo $this->Html->link($testimonial['User']['name'], array('controller' => 'users', 'action' => 'view', $testimonial['User']['id'])); ?>
			</td>
			<td><?php echo h(substr($testimonial['Testimonial']['description'],0,120).'...'); ?>&nbsp;</td>
			<td><?php if($testimonial['Testimonial']['created_date']!='0000-00-00'){
			echo h($testimonial['Testimonial']['created_date']);
			}?>&nbsp;</td>
			<td><?php echo $testimonial['Testimonial']['is_active']==0?'Inactive':'Active';?>&nbsp;</td>
			<td class="actions">
            
            	<?php if($testimonial['Testimonial']['is_active']==0) {
					echo $this->Form->postLink(__('Enable'), array('action' => 'verify', $testimonial['Testimonial']['id'],'enable'));
				}else{
					echo $this->Form->postLink(__('Dsable'), array('action' => 'verify', $testimonial['Testimonial']['id'],'disable'));												                 }?>
				<?php echo $this->Html->link(__('View'), array('action' => 'view', $testimonial['Testimonial']['id'])); ?>
				<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $testimonial['Testimonial']['id'])); ?>
				<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $testimonial['Testimonial']['id']), null, __('Are you sure you want to delete # %s?', $testimonial['Testimonial']['id'])); ?>
			</td>
		</tr>
		<?php endforeach; ?>
		</tbody>
		
		</table>
	
	</div> <!-- end table-wrapper -->
	
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