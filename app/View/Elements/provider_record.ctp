<?php
$filename = date('Y-m-d').'Provider';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?>
		<table cellpadding="0" cellspacing="0">
		<tr>
				<th><?php echo __('Id'); ?></th>
				<th><?php echo __('Name'); ?></th>
				<th><?php echo __('Email'); ?></th>
                <th><?php echo __('Service Category'); ?></th>
               	<th><?php echo __('Registered As'); ?></th>
				<th><?php echo __('Phone'); ?></th>
				<th><?php echo __('Permanent Address'); ?></th>
				<th><?php echo __('Temporary Address'); ?></th>
                <th><?php echo __('Places'); ?></th>
				<th><?php echo __('Expertise Level'); ?></th>
                
                <th><?php echo __('DOB English'); ?></th>
                 <th><?php echo __('DOB Nepali'); ?></th>
                <th><?php echo __('Identifier type'); ?></th> 
                <th><?php echo __('Identifier No.'); ?></th> 
                <th><?php echo __('Company Reg No.'); ?></th>
                <th><?php echo __('Company'); ?></th>
                <th><?php echo __('Additional Experience'); ?></th>
                <th><?php echo __('Registered Date'); ?></th> 
		</tr>
		<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['name']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
            <td><?php echo h($user[0]['Category']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['registered_as']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['primary_phone']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['permanent_address']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['temporary_address']); ?>&nbsp;</td>
            <td><?php echo h($user[0]['Place']); ?>&nbsp;</td>
			<td><?php echo h($user['User']['expertise_level']); ?>&nbsp;</td>
            
            <td><?php echo h($user['User']['dob_english']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['dob_nepali']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['identifier']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['identification_number']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['company_registration_number']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['company_name']); ?>&nbsp;</td>
            <td><?php echo h($user['User']['additional_experience']); ?>&nbsp;</td>
             <td><?php echo h($user['User']['created_date']); ?>&nbsp;</td>
			
		</tr>
	<?php endforeach; ?>
		</table>
	