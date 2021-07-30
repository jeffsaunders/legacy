<?
// PHP Functions
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}

// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}

// Connect to the database
include "dbconnect.php";

// Refresh account info
$SID = $_REQUEST['sid'];
// ADJUST TIME OFFSET ACCORDINGLY!
$query = "SELECT *,UNIX_TIMESTAMP(SUBTIME(accept_terms_time, '2:0:0')) AS timestamp FROM orders WHERE session_id='".$SID."'";
$rs_order = mysql_query($query, $linkID);
$order = mysql_fetch_assoc($rs_order);
?>
<?
if ($order['carrier'] == "at&t"){
	$carrier = "AT&T";
}else{
	$carrier = ucwords($order['carrier']);
}
$sAcctType = "";
if ($order['add_line'] == "No") $sAcctType .= "New ";
if ($order['add_line'] == "Yes") $sAcctType .= "Existing ";
if ($order['acct_type'] == "CL") $sAcctType .= "Business ";
if ($order['acct_type'] == "IL") $sAcctType .= "Personal ";
$rowcount = 0;
$roweven = "#F6F6F6";
$rowodd = "#FFFFFF";
$tab = "Tab200BG.gif";
$tab_class = "bigWhite";
$bar_color = "#DD0C08";
$border_color = "#DD0C08";
$box_color = "#000000";
$box_bg = "#E6E6E6";
//$form_bg = "#EFEFEF";
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>DevicePort.com Order Receipt</title>
	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">
	<!-- SSL Site Seal -->
	<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>
</head>

<body>

<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="200" height="25" align="center" valign="bottom" background="images/<? echo $tab; ?>" style="background-position: top left; background-repeat: no-repeat; background-attachment: scroll;" class="<? echo $tab_class; ?>">
		<strong>Order Receipt</strong><br>
		<img src="images/spacer.gif" alt="" width="199" height="1" border="0"><br>
	</td>
	<td align="right" bgcolor="#FFFFFF">
		<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td><a href="javascript:window.print();"><img src="images/PrinterIcon.jpg" alt="" width="25" border="0"></a></td>
			<td valign="bottom">
				&nbsp;<a href="javascript:window.print();" class="bodyBlack"><strong>Print This Page</strong></a>&nbsp;<br>
				<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="800" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="800" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="100" rowspan="4"><img src="images/spacer.gif" alt="" width="100" height="1" border="0"></td>
			<td align="center" class="xbigBlack"><br><strong>Thank You For Your Order</strong></td>
			<td width="100" rowspan="4"><script type="text/javascript">TrustLogo("images/ComodoSiteSeal.gif", "SC","none");</script></td>
		</tr>
		<tr>
			<td align="center" class="bodyBlack">
				<strong>(<? echo $sAcctType; ?>Account)</strong>
			</td>
		</tr>
		<tr>
			<td align="center" class="bigBlack"><br><strong>Order Number <? echo $order['order_num']; ?></strong></td>
		</tr>
		<tr>
			<td align="center" class="bodyBlack">
				<br>The following order was submitted on <? echo date('m/d/y', $order['timestamp']); ?> at <? echo date('g:i A', $order['timestamp']); ?> Pacific Time:<br><br>
			</td>
		</tr>
		</table>
	</td>
</tr>

<?// echo $SID."<br>"; ?>

<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table border="0" cellspacing="0" cellpadding="0" align="center">
		<tr bgcolor="<? echo $box_color; ?>" style="background-image:url(images/ButtonBarBG.jpg);">
			<td width="770" height="30" colspan="3" align="center" class="bodyWhite">&nbsp;<strong><? echo iif($order['acct_type'] == "IL" && $order['add_line'] == "No", 'Billing &amp; Shipping Information', 'Account'); ?> Information</strong></td>
		</tr>
<!--		<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td class="bodyBlack">
				<br>
				<ul>
					<li>Please verify that the following information is correct.  If you wish to make any changes, click the applicable button located in each section.  If the information is correct, please acknowledge your acceptance of the Terms & Conditions by checking the appropriate box and click the "Submit Order" button at the bottom.</li>
				</ul>
			</td>
			<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr bgcolor="<? echo $box_color; ?>">
			<td width="900" colspan="2"><img src="images/spacer.gif" alt="" width="1" height="2" border="0"></td>
		</tr>-->
		<tr>
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="770" align="center">
				<table width="100%" border="0" cellspacing="0" cellpadding="5" align="center" class="xbigBlack">
				<?
				if ($order['acct_type'] == "IL"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Name:</td>
					<td><strong><? echo $order['first_name']; ?> <? echo $order['middle_name']; ?> <? echo $order['last_name']; ?></strong></td>
				</tr>
				<?
				}else{
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Company Name:</td>
					<td><strong><? echo $order['company_name']; ?></strong></td>
				</tr>
				<?
					if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Tax ID (FEIN):</td>
					<td><strong><? echo $order['tax_id']; ?></strong></td>
				</tr>
				<?
//echo $rowcount;
//					}else{
				?>
<!--				<tr bgcolor="<?// echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td colspan="2"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
				</tr>-->
				<?
					}
				?>
				<?
				}
				?>
				<?
				if ($order['add_line'] == "Yes"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br><? echo $carrier; ?> Phone Number:</td>
					<td><strong><? echo $order['wireless_phone']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Account Number:</td>
					<td><strong><? echo $order['acct_number']; ?></strong>
				</tr>
				<?
				}
				?>
				<?
				if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Shipping Address:</td>
					<td>
						<strong><? echo $order['ship_address_1']; echo iif($order["ship_address_2"] != "", ", ", ""); echo $order['ship_address_2']; ?><br>
						<? echo $order['ship_city']; ?>,&nbsp;<? echo $order['ship_state']; ?>&nbsp;&nbsp;<? echo $order['ship_zipcode']; ?></strong>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Address:</td>
					<td>
						<strong><? echo $order['bill_address_1']; echo iif($order["bill_address_2"] != "", ", ", ""); echo $order['bill_address_2']; ?><br>
						<? echo $order['bill_city']; ?>,&nbsp;<? echo $order['bill_state']; ?>&nbsp;&nbsp;<? echo $order['bill_zipcode']; ?></strong>
					</td>
				</tr>
				<?
				}
// Column width defined here - first row in ALL forms
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td width="300" align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Service Address:<br><span class="smallBlack"><strong>Primary Place of Use Address.</strong></span></td>
					<td>
						<strong><? echo $order['service_address_1']; echo iif($order["service_address_2"] != "", ", ", ""); echo $order['service_address_2']; ?><br>
						<? echo $order['service_city']; ?>,&nbsp;<? echo $order['service_state']; ?>&nbsp;&nbsp;<? echo $order['service_zipcode']; ?></strong>
					</td>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Area Code:</td>
					<td><strong><? echo $order['request_areacode']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Requested Password:</td>
					<td><strong><? echo $order['password']; ?></strong>
				</tr>
				<?
				if ($order['acct_type'] == "CL"){
					if ($order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact:</td>
					<td><strong><? echo $order['billing_name']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact Phone:</td>
					<td><strong><? echo $order['billing_phone']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Billing Contact Email:</td>
					<td><strong><? echo $order['billing_email']; ?></strong>
				</tr>
				<?
					}
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact:</td>
					<td><strong><? echo $order['contact_name']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact Phone:</td>
					<td><strong><? echo $order['contact_phone']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Order Contact Email:</td>
					<td><strong><? echo $order['contact_email']; ?></strong>
				</tr>
				<?
				}
				?>
				<?
				if ($order['acct_type'] == "IL"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Home Phone:</td>
					<td><strong><? echo $order['home_phone']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Alternate Phone:</td>
					<td><strong><? echo $order['alt_phone']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Email Address:</td>
					<td><strong><? echo $order['email']; ?></strong>
				</tr>
				<?
					}
				?>
				<?
				if ($order['acct_type'] == "IL" && $order['add_line'] == "No"){
				?>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Social Security Number:</td>
					<td><strong><? echo $order['ssn']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Date of Birth:</td>
					<td><strong><? echo $order['dob']; ?></strong>
				</tr>
				<tr bgcolor="<? echo iif(is_even($rowcount), $roweven, $rowodd); $rowcount++; ?>">
					<td align="right" valign="top" class="xbigBlack"><img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>Driver's License:</td>
					<td><strong><? echo $order['dl_state']; ?> - <? echo $order['dl_number']; ?></strong>
				</tr>
				<?
					}
				?>
				</table>
				<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
			</td>
			<td rowspan="99" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="2" bgcolor="<? echo $box_color; ?>"><img src="images/spacer.gif" alt="" width="770" height="2" border="0"></td>
		</tr>
		</table>
		<br>
	</td>
</tr>

<!-- Cart Contents -->

<tr>
	<td colspan="2" align="center" bgcolor="#F5E7E7" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top:thin solid <? echo $border_color; ?>; border-bottom: 1px solid <? echo $border_color; ?>;">
		<br>
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td align="center" class="xbigBlack">
				<strong>Items Ordered</strong><br><br>
			</td>
		</tr>
		<tr>
			<td width="800" height="15">
			<?
				$query = "SELECT * FROM orders o, devices d WHERE o.session_id='".$SID."' AND d.session_id='".$SID."'";
				$rs_cart = mysql_query($query, $linkID);
				$row = mysql_fetch_assoc($rs_cart);
				$discount = ($row["plan_discount"] * .01);
//echo $discount;
				mysql_data_seek($rs_cart,0);
				if ($row['carrier'] == "sprint" || $row['carrier'] == "verizon"){
					echo'
					<table width="770" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td width="100" height="30" align="center">Device ESN</td>
						<td width="386" align="center">Plan Name</td>
						<td width="170" align="center">Included Data</td>
						<td width="170" align="center">Cost per Month</td>
					</tr>
					';
					$total = 0;
					for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
						$row = mysql_fetch_assoc($rs_cart);
						echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="30" align="center">'.$row["esn"].'</td>
						<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
						<td align="center">'.$row["plan_quantity"].'</td>
						<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
					</tr>
						';
						$total += $row["plan_cost"];
					};
					echo'
					<tr>
						<td height="30" align="right" colspan="3" bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
						<td align="right" bgcolor="'.$box_bg.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="60" height="1" border="0"></td>
					</tr>
					';
				}else{
					echo'
					<table width="770" border="1" cellspacing="0" cellpadding="0" align="center" bordercolor="'.$box_color.'" class="bodyBlack">
					<tr bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">
						<td width="180" height="30" align="center">Device ICCID</td>
						<td width="135" align="center">Device IMEI</td>
						<td width="336" align="center">Plan Name</td>
						<td width="90" align="center">Included<br>Data</td>
						<td width="90" align="center">Cost<br>per Month</td>
					</tr>
					';
					$total = 0;
					for ($counter=1; $counter <= mysql_num_rows($rs_cart); $counter++){
						$row = mysql_fetch_assoc($rs_cart);
						echo'
					<tr bgcolor="'.$box_bg.'" class="bodyBlack">
						<td height="30" align="center">'.$row["iccid"].'</td>
						<td align="center">'.$row["imei"].'</td>
						<td align="left" style="padding-left: 5px">'.$row["plan_name"].'</td>
						<td align="center">'.$row["plan_quantity"].'</td>
						<td align="right">$'.money_format('%i', ($row["plan_cost"]-($row["plan_cost"]*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
					</tr>
						';
						$total += $row["plan_cost"];
					};
					echo'
					<tr>
						<td height="30" align="right" colspan="4" bgcolor="'.$box_color.'" style="background-image:url(images/ButtonBarBG.jpg);" class="bodyWhite">Estimated* Monthly Total&nbsp;</td>
						<td align="right" bgcolor="'.$box_bg.'" class="bodyBlack">$'.money_format('%i', ($total-($total*$discount))).'<img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
					</tr>
					';
				}
				echo'
					</table>
				';
			?>
				<em class="smallBlack"><img src="images/spacer.gif" alt="" width="20" height="1" border="0">*Plus Federal, State, and Local taxes & fees.<? echo iif($discount > 0 && $discount < 1, "&nbsp;&nbsp;Prices reflect your ".($discount*100)."% discount.", ""); ?></em><br><br>
			</td>
		</tr>
		</table>
	</td>
</tr>

<!-- Contact -->

<tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>; border-top: 1px solid <? echo $border_color; ?>; border-bottom:thick solid <? echo $border_color; ?>;" class="bodyBlack">
		<ul>
		<br>
			<li><strong>For help with online orders call 877.351.1658 or email <a href="mailto:support@deviceport.com" class="bodyBlack" style="text-decoration:underline;">support@deviceport.com</a>.</strong>
		</ul>
	</td>	
</tr>
</table>

</body>
</html>
