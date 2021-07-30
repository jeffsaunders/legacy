<?
session_start();
?>
<body style="font:normal 11px Verdana, Arial, Helvetica, sans-serif;">
<table width="800" align="center">
<tr>
	<td>
		<table width="100%">
		<tr>
			<td><img src="http://www.prayerbelts.com/images/logo.gif" border="0"></td>
			<td align="right" valign="bottom"><?=date("m/d/y");?></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td><hr width="100%" size="2"></td>
</tr>
<tr>
	<td>
		<br>
		<font size="+2">Thank you for your order.</font><br>Your order number is: <strong><?=$aRecord['ReferenceNumber'];?></strong>, paid for with your: <strong><?=$_REQUEST['cardnumber'];?></strong>
		<br><br>
	</td>
</tr>
<tr>
	<td>
		<table width="100%">
		<tr>
			<td width="50%" align="center">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Bill To:</td>
				</tr>
				<tr>
					<td>
						<?=$_SESSION['FirstName'];?> <?=$_SESSION['LastName'];?><br>
						<?=$_SESSION['BillingAddress'];?> <?=$_SESSION['BillingApt'];?><br>
						<?=$_SESSION['BillingCity'];?>, <?=$_SESSION['BillingState'];?>&nbsp;&nbsp;<?=$_SESSION['BillingZipCode'];?><br>
					</td>
				</tr>
				</table>
			</td>
			<td width="50%" align="center">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Ship To:</td>
				</tr>
				<tr>
					<td>
						<?=$_SESSION['FirstName'];?> <?=$_SESSION['LastName'];?><br>
						<?=$_SESSION['ShippingAddress'];?> <?=$_SESSION['ShippingApt'];?><br>
						<?=$_SESSION['ShippingCity'];?>, <?=$_SESSION['ShippingState'];?>&nbsp;&nbsp;<?=$_SESSION['ShippingZipCode'];?><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<br>
		<table width="100%">
		<tr>
			<td width="440" align="center">Item</td>
			<td width="120" align="center">Quantity</td>
			<td width="120" align="right">Item Price</td>
			<td width="120" align="right">Item Total</td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
		<?
		$item = 0;
		while ($_SESSION['Item'.$item]){
			if ($_SESSION['Quantity'.$item] > 0){
		?>
		<tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90">MESSAGE:</td>
					<td width="350"><?=$_SESSION['Title'.$item];?></td>
				</tr>
				<tr>
					<td>COLOR:</td>
					<td><?=$_SESSION['Color'.$item];?></td>
				</tr>
				<tr>
					<td>SIZE:</td>
					<td><?=$_SESSION['Size'.$item];?></td>
				</tr>
				<tr>
					<td>WIDTH:</td>
					<td><?=$_SESSION['Width'.$item];?></td>
				</tr>
				</table>
			</td>
			<td align="center" valign="top"><?=$_SESSION['Quantity'.$item];?></td>
			<td align="right" valign="top"><div style="margin-top:2px;">$<?=number_format($_SESSION['Price'.$item], 2, '.', ',');?></div></td>
			<td align="right" valign="top"><div style="margin-top:2px;">$<?=number_format($_SESSION['Price'.$item]*$_SESSION['Quantity'.$item], 2, '.', ',');?></div></td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
		<?
			}
			$item++;
		}
		?>
		<tr>
			<td colspan="3" align="right">Subtotal:</td>
			<td align="right">$<?=number_format($_REQUEST['subtotal'], 2, '.', ',');?></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Shipping &amp; Handling:</td>
			<td align="right">$<?=number_format($_REQUEST['shipping'], 2, '.', ',');?></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Sales Tax:</td>
			<td align="right">$<?=number_format($_REQUEST['tax'], 2, '.', ',');?></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="2"><hr width="100%" size="2"></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><strong><font size="+1">Total:</font></strong></td>
			<td align="right" valign="top"><strong><font size="+1">$<?=number_format($_REQUEST['chargetotal'], 2, '.', ',');?></font></strong></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>
