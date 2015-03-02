<?php
$filename = date('Y-m-d').'Seeker_Provider_Requests';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
<div class="seekerProviderRequests index">
	<h2><?php echo __('Seeker Provider Requests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr> 
			<th><?php echo __('Id'); ?></th>
			<th><?php echo __('Seeker Name'); ?></th>
			<th><?php echo __('Provider Name'); ?></th>
			<th><?php echo __('Category'); ?></th>
			<th><?php echo __('Requested Date'); ?></th>
			<th><?php echo __('Created Date'); ?></th>
			<th><?php echo __('Description'); ?></th>
			<th><?php echo __('Status'); ?></th>
			<th><?php echo __('Rate Package'); ?></th>
			<th><?php echo __('Rate'); ?></th>
			<th><?php echo __('Working Hour'); ?></th>
			<th><?php echo __('Working Days'); ?></th>
			<th><?php echo __('Requested Amount'); ?></th>
			<th><?php echo __('Freeze Amount'); ?></th>
			<th><?php echo __('Completion Amount'); ?></th>
	</tr>
	<?php foreach ($seekerProviderRequests as $seekerProviderRequest): ?>
	<tr>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['id']); ?>&nbsp;</td>
		<td><?php echo $this->SmartForm->getUserInfo($seekerProviderRequest['SeekerProviderRequest']['service_seeker_id']);?>&nbsp;</td>
		<td><?php echo $this->SmartForm->getUserInfo($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']);?>&nbsp;</td>
        <td><?php foreach($this->SmartForm->getUserCategory($seekerProviderRequest['SeekerProviderRequest']['service_provider_id']) as $category):
			echo $category['service_categories']['title'].'<br>';
			endforeach;?>&nbsp;</td>
        
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_date']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['created_date']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['description']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['status']); ?>&nbsp;</td>
		<td><?php echo $seekerProviderRequest['RatePackage']['title']; ?>&nbsp;</td>        
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['rate']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_hour']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['working_days']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['requested_amount']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['freeze_amount']); ?>&nbsp;</td>
		<td><?php echo h($seekerProviderRequest['SeekerProviderRequest']['completion_amount']); ?>&nbsp;</td>
	</tr>
<?php endforeach; ?>
	</table>
	
</div>
