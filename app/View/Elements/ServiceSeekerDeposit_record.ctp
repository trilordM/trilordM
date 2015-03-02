<?php
$filename = date('Y-m-d').'Deposits';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?> 
<div class="serviceSeekerDeposits index">
	<h2><?php echo __('Service Seeker Deposits'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<?php /*?><th><?php echo $this->Paginator->sort('id'); ?></th><?php */?>
			<th><?php echo __('User'); ?></th>
			<th><?php echo __('Deposited Date'); ?></th>
			<th><?php echo __('Amount_usd'); ?></th>
			<th><?php echo __('Amount_nrs'); ?></th>
			<th><?php echo __('Amount Medium'); ?></th>
			<th><?php echo __('Transaction Id'); ?></th>
			<th><?php echo __('Transaction Date'); ?></th>
			<th><?php echo __('Status'); ?></th>
	</tr>
	<?php foreach ($serviceSeekerDeposits as $serviceSeekerDeposit): ?>
	<tr>
		<td><?php echo $serviceSeekerDeposit['User']['name']; ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['deposited_date']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_usd']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_nrs']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['amount_medium']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transactionId']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['transaction_date']); ?>&nbsp;</td>
		<td><?php echo h($serviceSeekerDeposit['ServiceSeekerDeposit']['status']); ?>&nbsp;</td>
		
	</tr>
<?php endforeach; ?>
	</table>
</div>

