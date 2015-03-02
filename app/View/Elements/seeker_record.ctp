<?php
$filename = date('Y-m-d').'Seeker';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<div class="users index">
	<h2><?php echo __('Users');?></h2>
	
	<div class="table-holder">
	
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
				<th><?php echo __('Username'); ?></th>
				<th><?php echo __('Phone'); ?></th>
				<th><?php echo __('Permanent Address'); ?></th>
				<th><?php echo __('Created Date'); ?></th>
		</tr>
		<?php foreach ($users as $user): ?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['primary_phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['permanent_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['created_date']); ?>&nbsp;</td>
		</tr>
	<?php endforeach; ?>
		</table>
	
	</div> <!-- end table holder -->	
	
</div>

