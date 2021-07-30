<!-- BEGIN Include thankyou.php -->

<?
/*
//unset($_SESSION['SID']);
//session_unset();
//session_destroy();
//$_SESSION = array(); 
session_regenerate_id();
//session_start();
$_SESSION['SID'] = session_id();
//echo $_SESSION['SID'];
$SID = $_SESSION['SID'];
echo $SID;
*/
?>

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Thank You</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</tr>
	<td colspan="2" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="1" height="400" border="0"></td>
			<td align="center" valign="top" class="xbigBlack">
				<br><br><br><br><br>
				Your Order Has Been Accepted.<br>Thank You!<br><span class="bodyBlack">We will contact you if we need any additional information.</span>
				<br><br>
				<a href="?sec=rebates" class="bodyBlack">Click Here for Rebate Information and Forms</a>
			</td>
		</tr>
		</table>

	</td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include thankyou.php -->

