<!DOCTYPE HTML><!-- HTML5 -->
<html>
<head>
	<title>Live Happy Conference 2014 Registration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- At least set a LITTLE style -->
	<style>
/*		body {background-color:#F9F9F9; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
		form select{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form textarea{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form input[type=text]{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form input[type=checkbox]{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
*/
		body {font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px; background-color:#FFFFFF; background:#FFFFFF url(/lh_bg1.jpg) left top repeat-x; margin:0px;}
		form select{background-color:#F9F9F9; border:thin #C0C0C0 solid;}
		form textarea{background-color:#F9F9F9; border:thin #C0C0C0 solid;}
		form input[type=text]{background-color:#F9F9F9; border:thin #C0C0C0 solid;}
		form input[type=checkbox]{background-color:#F9F9F9; border:thin #C0C0C0 solid;}

		.menuContainer {position:fixed; top:0px; left:0px; width:100%; height:180px; text-align:left; background-color:#F9F9F9; white-space:nowrap; overflow:hidden; z-index:100;}
		.menuContainer a{color:#000000;	font-size:12px;	text-decoration:none; text-transform:uppercase;	font-weight:normal;	margin-right:20px;}
		.menuContainer a:hover{color:#FF0000; text-decoration:underline;}

		.reportsMenuContainer {position:absolute; left:400px; top:174px; width:auto; padding:5px; height:auto; background-color:#FFFFFF; border:solid black thin; z-index:10000; display:none; visibility:hidden;}
		.reportsMenuContainer a{color:#000000;	font-size:12px;	text-decoration:none; text-transform:uppercase;	font-weight:normal;	margin-right:20px;}
		.reportsMenuContainer a:hover{color:#FF0000; text-decoration:underline;}

		.bodyContainer {position:relative; top:180px;}

	</style>

	<!-- Common scripts -->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
	<script src="./js/functions.js" type="text/javascript"></script>
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0"> 
		<tr background="/images/header_bg_ss.jpg"> 
			<td><img src="/img/blank.png" width=134 height=5><br><img src="/img/ewnLogoNew.png" width=170 height=87></td> 
		</tr>
		<tr>
			<td height="15" valign="top" style="padding:3px 0px 3px 10px;"> </td> 
		</tr>
		</table>
<?php
include_once("include/dbconnect.php");
print_r($_POST);
function encrypt($value, $key){
		if(!$value || !$key){
			return false;
		}
		$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$encryptedValue = mcrypt_generic($td, $value);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return base64_encode( $encryptedValue );
	}
$dataKey = base64_decode('d2Vscm47d2xrZW5yd2VvaWowMiE5bm4=');
foreach($_POST as $key => $value)
	{
	$$key = strip_tags($value);
	}
$now = time();
//print $now;
/*if ($source_code != "")
	{
	//look up code
	$code_sql = "SELECT * FROM `ems`.`com_promotion_requirement` JOIN `ems`.`com_promotion_info` ON `ems`.`com_promotion_requirement`.`promo_id` = `ems`.`com_promotion_info`.`promo_id` WHERE `ems`.`com_promotion_requirement`.`requirement_value` = '$source_code' AND `ems`.`com_promotion_info`.`is_active` = '1' AND `ems`.`com_promotion_info`.`period_start` < '$now' and `ems`.`com_promotion_info`.`period_end` > '$now';";
	//print $code_sql;
	$code_result = mysql_query($code_sql, $emsLink);
	$code_num_rows = mysql_num_rows($code_result);
	$code_row = mysql_fetch_assoc($code_result);
	$promo_id = $code_row['promo_id'];
	//print_r($code_row);
	//print "<br><br>".$code_num_rows;
	
	if($code_num_rows > 0)
		{
		//if product_id matches, give discount off of $total
		$value_sql = "SELECT * FROM `ems`.`com_promotion_result` WHERE `promo_id` = '$promo_id' AND `application_value` = '$product_id';";
		//print $value_sql;
		$value_result = mysql_query($value_sql, $emsLink);
		$value_num_rows = mysql_num_rows($value_result);
		if($value_num_rows > 0)
			{
			$value_row = mysql_fetch_assoc($value_result);
			$result_value = $value_row['result_value'];
			$result_type = $value_row['result_type'];
			//create case/switch statement for 3 types of discounts and proccess $total accordingly
			switch ($result_type) 
				{
				case 2:
					//percentage off
	    			$percentage_value = ".".$result_value;
					$price = $price*$percentage_value;
					print '<br><div align="center"><font color="#FF0000">Event Code '.$source_code.' Used to get a '.$result_value.'% Discount.</font></div>';
					break;
				case 3:
					//fixed dollars off
					$price = $price+$result_value;
					print '<br><div align="center"><font color="#FF0000">Event Code '.$source_code.' Used to get a '.$result_value.' Discount.</font></div>';
					break;
				case 4:
					//flat rate
					$price = $result_value;
					print '<br><div align="center"><font color="#FF0000">Event Code '.$source_code.' Used to override Conference cost to $'.money_format('%i', $price).'.</font></div>';
					break;
				}
			
			
			}
			else
				{
				print '<br><div align="center"><font color="#FF0000">Event Code '.$source_code.' is not valid for this product.</font></div>';
				}
			
		}
		else
			{
			//source code offers no discount
			print '<br><div align="center"><font color="#FF0000">Event Code '.$source_code.' is invalid.</font></div>';
			}
	}*/
if ($first_name == "" or $last_name == "" or $email_address == "" or $number_on_card == "" or $exp_on_card == "" or $phone_1 == "")
	{
	print "Required fields left blank on form, please go back and enter required information";
	die;
	}
if ($threepay == "3-Pay")
	{
	$pay_plan = "3 Payments";
	}
	else
		{
		$pay_plan = "Single Payment";
		}
//figure out what the payments are
$total = $price;
switch (true) 
	{
	case ($threepay == "3-Pay"):
		$number_of_records = '3';
		//Hack to remove upcharge
		//$payment_amount = (($total + 110) / 3);
		$payment_amount = $total / 3;
		//$payment_amount = round(($payment_amount+5/2)/5)*5;
		$multi_payment_total = $payment_amount * 3;
		$upcharge = $multi_payment_total - $total;
 		break;
	case ($threepay != "3-Pay"):
		$number_of_records = '1';
		$payment_amount = $total;
 		break;
	default:
	}
//encrypt hand entered card
$last_four = substr($number_on_card, -4, 4);
//$card_num = encrypt($number_on_card, $dataKey);
//explode the exp date into $exp_m and $exp_y and encrypt them both
//$pieces = explode("/", $exp_on_card);
//$exp_m = encrypt($pieces['0'], $dataKey);
//$exp_y = encrypt($pieces['1'], $dataKey);
?>
<br><strong><font size="+1">Confirm your information and payments below.</font></strong>

<table width="1000">
<form action="process_self_reg.php" method="post">
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
	<td width="250">Title:</td>
	<td><?php echo $title; ?></td>
</tr>
<tr>
	<td>First Name:</td>
	<td><?php echo $first_name; ?></td>
</tr>
<tr>
	<td>Middle Name:</td>
	<td><?php echo $middle_name; ?></td>
</tr>
<tr>
	<td>Last Name:</td>
	<td><?php echo $last_name; ?></td>
</tr>
<tr>
	<td>Name Suffix:</td>
	<td><?php echo $suffix; ?></td>
</tr>
<tr>
	<td>Company:</td>
	<td><?php echo $company; ?></td>
</tr>
<tr>
	<td>Occupation:</td>
	<td><?php echo $occupation; ?></td>
</tr>
<!--
<tr>
	<td>Country:</td>
	<td>
	    <select name="country" id="country" style="width:270px; margin:0px;" onChange="mdChange(this.value);">
			<option value="">Select ...</option>
			<option value="United States"<?php echo ($Country == "United States" ? " selected" : "");?>>United States</option>
			<option value="Canada"<?php echo ($Country == "Canada" ? " selected" : "");?>>Canada</option>
			<option value="Other">Other</option>
		</select>
	</td>
</tr>
-->
<tr>
	<td>Country:</td>
	<td><?php echo $country; ?></td>
</tr>
<tr>
	<td>Address 1:</td>
	<td><?php echo $address_1; ?></td>
</tr>
<tr>
	<td>Address 2:</td>
	<td><?php echo $address_2; ?></td>
</tr>
<tr>
	<td>City:</td>
	<td><?php echo $city; ?></td>
</tr>
<tr>
	<td>State/Province:</td>
	<td><?php echo $state_province; ?></td>
</tr>
<tr>
	<td>Zip/Postal Code:</td>
	<td><?php echo $postal_code; ?></td>
</tr>
</div>
<tr>
	<td>Primary Phone:</td>
	<td><?php echo $phone_1; ?></td>
</tr>
<tr>
	<td>Secondary Phone:</td>
	<td><?php echo $phone_2; ?></td>
</tr>
<tr>
	<td>Email:</td>
	<td><?php echo $email_address; ?></td>
</tr>
<tr>
	<td>Event Code:</td>
	<td><?php echo $source_code; ?></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
	<td>Payment Plan:</td>
	<td><?php echo $pay_plan; ?> of $<?php echo number_format($payment_amount, 2, '.', '') ?> <?php echo ($threepay == "3-Pay" ? "Each" : "");?> Using Credit Card ending in <?php echo $last_four; ?></td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade>
<?php foreach($_POST as $kkey => $vvalue)
	{
	//$$key = strip_tags($value);
	print '<input type="hidden" name="'.$kkey.'" value="'.strip_tags($vvalue).'">';
	}
?>
	</td>
</tr>

<tr>
	<td colspan="2" align="center"><input type="hidden" name="payment_amount" value="<?php echo number_format($payment_amount, 2, '.', '') ?>"><input type="hidden" name="number_of_payments" value="<?php echo $number_of_records; ?>"><input type="hidden" name="last_four" value="<?php echo $last_four; ?>"><input type="hidden" name="member" value="<?php echo $member; ?>"><input type="submit" value="Process Registration"><br><br></td>
</tr>
</table>

</form>
</body>
</html>