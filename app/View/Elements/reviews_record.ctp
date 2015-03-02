<?php
$filename = date('Y-m-d').'Reviews';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<div class="Reviews index">
	<h2><?php echo __('Reviews'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Provider Name'); ?></th>
			<th><?php echo __('Seeker Name'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Review Date'); ?></th
	</tr>
	<?php foreach ($reviews as $review): ?>
	<tr>
		<td><?php echo h($review['Review']['id']); ?>&nbsp;</td>
        <td><?php echo $this->SmartForm->getUserInfo($review['Review']['service_provider_id']);?>&nbsp;</td>
        <td><?php echo $this->SmartForm->getUserInfo($review['Review']['service_seeker_id']);?>&nbsp;</td>
		<td><?php echo h($review['Review']['description']); ?>&nbsp;</td>
		<td><?php echo h($review['Review']['review_date']); ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</table>