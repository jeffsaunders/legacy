<!-- BEGIN Include thankyou.php -->

<?
// If there is request data, save it!
//if ($_REQUEST['accept_terms'] != ""){
	// Write account information to database
	$query =
		"UPDATE orders SET
		accept_terms_time = NOW()
		WHERE session_id = '".$SID."'";
//echo $query.'<br></br>';
	$rs_update = mysql_query($query, $linkID);
//}
// Refresh account info
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);
?>
<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Activate Service</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="410" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="20"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
			<td class="bodyBlack">
				<div align="center">
				<br>
				<strong class="xbigBlack">Thank You!</strong><br>
				<strong class="bigBlack">Your order has been submitted for processing.</strong><br>
				<br>
				</div>
<!--				<strong>Shortly, an email confirmation of your order will be sent to the<? echo iif($order['acct_type']=="CL", " order contact", ""); ?> email address you provided.  Please save or print it for your records.<br>-->
				<br>
				<strong>If you wish to print an order confirmation, <a href="https://secure.nr.net/deviceport/receipt.php?sid=<? echo $SID; ?>" target="_blank" class="bodyBlack">Click Here</a>.<br>
				<br>
				If you have any questions about your order, please call 877.351.1658 or email us at <a href="mailto:<? echo $support_email; ?>" class="bodyBlack"><? echo $support_email; ?></a>.</strong>
			</td>
			<td width="20"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<?
// Assign new session ID
$SID = $_SESSION['SID'];
?>

<!-- END Include thankyou.php -->
