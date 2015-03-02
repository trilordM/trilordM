<?php
//$filename = date('Y-m-d').'Provider';
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=".$filename.".xls");  //File name extension was wrong
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);
?> 
<table>
	<tr>
			<th><?php echo "SN"; ?></th>
			<th><?php echo ('Service Seeker'); ?></th>
			<th><?php echo ('Deposited_Date'); ?></th>
			<th><?php echo ('Amount USD'); ?></th>
			<th><?php echo ('Amount NRs'); ?></th>
			<th><?php echo ('Amount Medium'); ?></th>
			<th><?php echo ('Transaction Id'); ?></th>
			<th><?php echo ('Transaction Date'); ?></th>
            <th><?php echo ('Bank'); ?></th>
            <th><?php echo ('Deposited By'); ?></th>
            <th><?php echo ('Verified By'); ?></th>
			<th><?php echo ('Status'); ?></th>
			
	</tr>
	<?php 
	$totalUsd = 0;
	$totalNrs = 0;
	$i=0;foreach ($getTransactions as $transaction):$i++; 
	$totalUsd = $totalUsd+$transaction['SSP']['amount_usd'];
	$totalNrs = $totalNrs+$transaction['SSP']['amount_nrs'];
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<?php echo h($transaction['U']['name']); ?>
		</td>
		<td><?php echo h($transaction['SSP']['deposited_date']); ?></td>
		<td><?php echo h($transaction['SSP']['amount_usd']); ?></td>
		<td><?php echo h($transaction['SSP']['amount_nrs']); ?></td>
		<td><?php echo h($transaction['SSP']['amount_medium']); ?></td>
		<td><?php echo h($transaction['SSP']['amount_medium']=='Paypal'?$transaction['SSP']['transactionId']:$transaction['SSP']['esewa_txn_id']); ?></td>
		<td><?php if($transaction['SSP']['amount_medium']=='Paypal')
					echo $transaction['SSP']['transaction_date'];
				  elseif($transaction['SSP']['amount_medium']=='Esewa')	
				  	echo $transaction['SSP']['esewa_deposited_date'];
				  else
					echo '';
				 ?></td>
        <td><?php echo $transaction['SSP']['deposited_bank']!=''?$transaction['SSP']['deposited_bank'].', '.$transaction['SSP']['bank_location']:''; ?></td>
        <td><?php echo h($transaction['SSP']['deposited_by']); ?></td>
        <td><?php echo h($transaction['UV']['name']); ?></td>
		<td><?php echo h($transaction['SSP']['status']); ?></td>
		
	</tr>
<?php endforeach; ?>
	<tr>
    	<td colspan="3">Total</td>
        <td><?php echo $totalUsd;?></td>
        <td><?php echo $totalNrs;?></td>
        <td colspan="7">&nbsp;</td>
    </tr>
	</table>