<?php
$filename = date('Y-m-d').'Complains';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<div class="complains index">
	<h2><?php echo __('Complains'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Provider Name'); ?></th>
			<th><?php echo __('Seeker Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Complain Date'); ?></th>
	</tr>
	<?php foreach ($complains as $complain): ?>
	<tr>
		<td><?php echo h($complain['Complain']['id']); ?>&nbsp;</td>
        <td><?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_provider_id']);?>&nbsp;</td>
		<td><?php echo $this->SmartForm->getUserInfo($complain['Complain']['service_seeker_id']);?>&nbsp;</td>
        
		<td><?php echo h($complain['Complain']['description']); ?>&nbsp;</td>
		<td><?php echo h($complain['Complain']['complain_date']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>

