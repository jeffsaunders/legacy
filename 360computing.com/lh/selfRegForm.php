
<!DOCTYPE HTML><!-- HTML5 -->
<html>
<head>
	<title>Conference 2014 Registration</title>
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
<?php include_once("include/dbconnect.php"); ?>
<?php
//print_r($_POST);

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
$smbBtn = strip_tags($_POST['smbBtn']);
if ($smbBtn == "Sign In")
	{
	$username = strip_tags($_POST['signinName']);
	$password = strip_tags(encrypt($_POST['password'], $dataKey));
	//look up user and verify that password is correct
	$user_check_sql = "SELECT *, count(*) as count from `u_password` WHERE `username` = '$username' AND `password` = '$password'";
	//print $user_check_sql;
	$user_check_result = mysql_query($user_check_sql, $ewnLink);
	$user_check_row = mysql_fetch_assoc($user_check_result);
	$count = $user_check_row['count'];
	}
//print $count;
if ($count > 0)
	{
	$ewn_id = $user_check_row['user_id'];
	//check if they are an active member
	$active_sql = "SELECT `active` FROM `u_flag` WHERE `user_id` = '$ewn_id'";
	$active_result = mysql_query($active_sql, $ewnLink);
	$active_row = mysql_fetch_assoc($active_result);
	$active = $active_row['active'];
	//print $active;
	}
if ($active == "Y")
	{
	$member = "Y";
	$price_text = "Member Price - $1495.00";
	//query needed info.
	$user_info_sql = "SELECT * FROM `u_personal` WHERE `user_id` = '$ewn_id'";
	$user_info_result = mysql_query($user_info_sql, $ewnLink);
	$user_info_row = mysql_fetch_assoc($user_info_result);
	/*print "<pre>";
	print_r($user_info_row);
	print "</pre>";*/
	$Title = $user_info_row['name_title'];
	$FirstName = $user_info_row['name_first'];
	$MiddleName = $user_info_row['name_middle'];
	$LastName = $user_info_row['name_last'];
	$Suffix = $user_info_row['suffix'];
	$Address1 = $user_info_row['address_1'];
	$Address2 = $user_info_row['address_2'];
	$City = $user_info_row['city'];
	$StateProvince = $user_info_row['state_province'];
	$PostalCode = $user_info_row['postal_code'];
	$Country = $user_info_row['country'];
	$Phone_1 = "(".$user_info_row['day_phone_area'].") ".$user_info_row['day_phone_first']."-".$user_info_row['day_phone_last'];
	$Phone_2 = "(".$user_info_row['evening_phone_area'].") ".$user_info_row['evening_phone_first']."-".$user_info_row['evening_phone_last'];
	$Email = $user_info_row['email'];
	$Company = $user_info_row['company_name'];
	$Occupation = $user_info_row['company_title_in'];
	$cost = "1495.00";
	//product_id needs to be changes once late date is hit
	$product_id = "165581";
	}
	else
		{
		$member = "N";
		$price_text = "Non-Member Price - $1895.00";
		$cost = "1895.00";
		$product_id = "165582";
?>

<?php
		}
//If you need to invite a friend or add a guest call in your conference registartion.
?>

<strong><font size="+1">2014 Int'l Conference & Business Expo Registration <?php echo $price_text; ?></font></strong>

<form action="confirm_self_reg.php" method="post" name="registrationForm" id="registrationForm" onSubmit="return validate(this);">
<table width="1000">
<tr>
	<td colspan="2">Please make sure you enter your current email address and confirm it is correct. Any additional information about this event will be sent to the email address you enter below. <font color="#FF0000">*</font> = Required Field</td>
</tr>
<tr>
	<td colspan="2"><hr width="100%" size="1" noshade></td>
</tr>
<tr>
	<td width="300">Title:</td>
	<td>
	    <select name="title" id="title" style="width:120px;">
			<option value="">Select ...</option>
			<option value="Ms."<?php echo ($Title == "Ms." ? " selected" : "");?>>Ms.</option>
			<option value="Mrs."<?php echo ($Title == "Mrs." ? " selected" : "");?>>Mrs.</option>
			<option value="Miss"<?php echo ($Title == "Miss" ? " selected" : "");?>>Miss</option>
			<option value="Dr."<?php echo ($Title == "Dr." ? " selected" : "");?>>Dr.</option>
			<option value="Mr."<?php echo ($Title == "Mr." ? " selected" : "");?>>Mr.</option>
		</select>
	</td>
</tr>
<tr>
	<td>First Name:<font color="#FF0000">*</font></td>
	<td>
		<input type="text" name="first_name" id="first_name" value="<?php echo $FirstName; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Middle Name:</td>
	<td>
		<input type="text" name="middle_name" id="middle_name" value="<?php echo $MiddleName; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Last Name:<font color="#FF0000">*</font></td>
	<td>
		<input type="text" name="last_name" id="last_name" value="<?php echo $LastName; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Name Suffix:</td>
	<td>
		<input type="text" name="suffix" id="suffix" value="<?php echo $Suffix; ?>" style="width:100px;">
	</td>
</tr>
<tr>
	<td>Company:</td>
	<td>
		<input type="text" name="company" id="company" value="<?php echo $Company; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Occupation:</td>
	<td>
		<input type="text" name="occupation" id="occupation" value="<?php echo $Occupation; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Country:</td>
	<td>
		<script>
			function countryChange() {
				if (document.getElementById('country').value == "" || document.getElementById('country').value == "United States" || document.getElementById('country').value == "Canada"){
					document.getElementById('intlState').style.visibility = "hidden";
					document.getElementById('intlState').style.display = "none";
					document.getElementById('listStates').style.visibility = "visible";
					document.getElementById('listStates').style.display = "block";
				}else{
					document.getElementById('listStates').style.visibility = "hidden";
					document.getElementById('listStates').style.display = "none";
					document.getElementById('intlState').style.visibility = "visible";
					document.getElementById('intlState').style.display = "block";
				}
			}
		</script>
	    <select name="country" id="country" style="width:270px; margin:0px;" onChange="countryChange();">
			<option value="">Select ...</option>
			<option value="United States"<?php echo ($Country == "United States" ? " selected" : "");?>>United States</option>
			<option value="Canada"<?php echo ($Country == "Canada" ? " selected" : "");?>>Canada</option>
			<option disabled>--------------------------------------------</option>
<?php
// Get Countries (not US or Canada)
$query = "
	SELECT country_name
	FROM s_countries
	WHERE country_name <> 'United States'
	AND country_name <> 'Canada'
	ORDER BY country_name ASC
";
//echo $query."<br>";
$rs_countries = mysql_query($query, $ewnLink);
while ($countries = mysql_fetch_assoc($rs_countries)){
?>
			<option value="<?php echo trim($countries['country_name']); ?>"<?php echo ($Country == trim($countries['country_name']) ? " selected" : "");?>><?php echo trim($countries['country_name']); ?></option>
<?php
}
?>
			<option disabled>--------------------------------------------</option>
			<option value="Other">Other</option>
		</select>
	</td>
</tr>
<tr>
	<td>Address 1:</td>
	<td>
		<input type="text" name="address_1" id="address_1" value="<?php echo $Address1; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Address 2:</td>
	<td>
		<input type="text" name="address_2" id="address_2" value="<?php echo $Address2; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>City:</td>
	<td>
		<input type="text" name="city" id="city" value="<?php echo $City; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>State/Province:</td>
	<td>
		<!-- U.S. or Canada -->
		<div id="listStates" style="<?php echo ($Country == "" || $Country == "United States" || $Country == "Canada" ? "display:block; visibility:visible;" : "display:none; visibility:hidden; z-index:-1;");?>">
		    <select name="state_province" id="state_province" style="width:270px; margin:0px;">
				<option value="">Select ...</option>
<?php
// Get states
$query = "
	SELECT state_name
	FROM s_states
	WHERE state_country = 'USA'
	AND state_entity = 'State'
	ORDER BY state_name ASC
";
//echo $query."<br>";
$rs_states = mysql_query($query, $ewnLink);
while ($states = mysql_fetch_assoc($rs_states)){
?>
				<option value="<?php echo trim($states['state_name']); ?>"<?php echo (($Country == "United States" || $Country == "Canada") && $StateProvince == trim($states['state_name']) ? " selected" : "");?>><?php echo trim($states['state_name']); ?></option>
<?php
}
?>
				<option disabled>--------------------------------------------</option>
<?php
// Get Provinces
$query = "
	SELECT state_name
	FROM s_states
	WHERE state_country = 'Canada'
	AND state_entity = 'Province'
	ORDER BY state_name ASC
";
//echo $query."<br>";
$rs_provinces = mysql_query($query, $ewnLink);
while ($provinces = mysql_fetch_assoc($rs_provinces)){
?>
				<option value="<?php echo trim($provinces['state_name']); ?>"<?php echo (($Country == "United States" || $Country == "Canada") && $StateProvince == trim($provinces['state_name']) ? " selected" : "");?>><?php echo trim($provinces['state_name']); ?></option>
<?php
}
?>
			</select>
		</div>
		<!-- International -->
		<div id="intlState" style="<?php echo ($Country != "" && $Country != "United States" && $Country != "Canada" ? "display:block; visibility:visible; z-index:100;" : "display:none; visibility:hidden;");?>">
			<input type="text" name="intl_province" id="intl_province" value="<?php echo $StateProvince; ?>" style="width:250px;">
		<div>
	</td>
</tr>
<tr>
	<td>Zip/Postal Code:</td>
	<td>
		<input type="text" name="postal_code" id="postal_code" value="<?php echo $PostalCode; ?>" style="width:100px;">
	</td>
</tr>
</div>
<tr>
	<td>Primary Phone:<font color="#FF0000">*</font></td>
	<td>
		<script>
			function phoneChange(o) {
				if (o.value != "" && (document.getElementById('country').value == "" || document.getElementById('country').value == "United States" || document.getElementById('country').value == "Canada")){
					formatPhone(o);
				}
			}
		</script>
		<input type="text" name="phone_1" id="phone_1" value="<?php echo $Phone_1; ?>" style="width:250px;" onBlur="phoneChange(this);">
	</td>
</tr>
<tr>
	<td>Secondary Phone:</td>
	<td>
		<input type="text" name="phone_2" id="phone_2" value="<?php echo $Phone_2; ?>" style="width:250px;" onBlur="phoneChange(this);">
	</td>
</tr>
<tr>
	<td>Email:<font color="#FF0000">*</font></td>
	<td>
		<input type="text" name="email_address" id="email_address" value="<?php echo $Email; ?>" style="width:250px;">
	</td>
</tr>
<tr>
	<td>Events Code:</td>
	<td>
		<input type="text" name="source_code" id="source_code" value="" style="width:250px;">
	</td>
</tr>

<tr><td align="right">Card Number:<font color="#FF0000">*</font></td><td><input type="text" name="number_on_card" id="number_on_card" value="" style="width:250px;"></td></tr>
<tr><td align="right">Exp Date (MM/YY):<font color="#FF0000">*</font></td><td><input type="text" name="exp_on_card" id="exp_on_card" value="" style="width:250px;"><br><br></td></tr>
<tr>
	<td colspan="2" align="center"><input type="hidden" name="ewn_id" value="<?php echo $ewn_id; ?>"><input type="hidden" name="member" value="<?php echo $member; ?>"><input type="hidden" name="price" value="<?php echo $cost; ?>"><input type="hidden" name="product_id" value="<?php echo $product_id; ?>"><input type="submit" name="submit" value="Next"></td>
</tr>
</table>
</form>
</body>
</html>