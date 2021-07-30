<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>

<head>
	<title>Pacer Discount - Sprint-Nextel</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<style>
		.bodyBlack {font-family:Tahoma,Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none;}
		A.bodyBlack {font-family:Tahoma,Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none;}
		A.bodyBlack:hover {color:Red; text-decoration:underline;}
		A.bodyBlack:active {color:Red;}
		A.bodyBlack:visited {color:#000000;}
		A.bodyBlack:visited:hover {color:Red; text-decoration:underline;}

		.smallBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px;	color:#000000; text-decoration:none;}
		A.smallBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px; color:#000000; text-decoration:underline;}
		A.smallBlack:hover {color:Red; text-decoration:underline;}
		A.smallBlack:active {color:Red;}
		A.smallBlack:visited {color:#000000;}
		A.smallBlack:visited:hover {color:Red; text-decoration:underline;}

		.bigBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:14px; color:#000000; text-decoration:none;}
		A.bigBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:14px; color:#000000; text-decoration:none;}
		A.bigBlack:hover {color:Red; text-decoration:underline;}
		A.bigBlack:active {color:Red;}
		A.bigBlack:visited {color:#000000;}
		A.bigBlack:visited:hover {color:Red; text-decoration:underline;}

		.xbigBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:18px; color:#000000; text-decoration:none;}
		A.xbigBlack {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:18px; color:#000000; text-decoration:none;}
		A.xbigBlack:hover {color:Red; text-decoration:underline;}
		A.xbigBlack:active {color:Red;}
		A.xbigBlack:visited {color:#000000;}
		A.xbigBlack:visited:hover {color:Red; text-decoration:underline;}

		.bodyWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px;	color:#FFFFFF; text-decoration:none;}
		A.bodyWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:12px; color:#FFFFFF; text-decoration:none;}
		A.bodyWhite:hover {color:Yellow; text-decoration:underline;}
		A.bodyWhite:active {color:Yellow;}
		A.bodyWhite:visited {color:#FFFFFF;}
		A.bodyWhite:visited:hover {color:Yellow; text-decoration:underline;}

		.smallWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px;	color:#FFFFFF; text-decoration:none;}
		A.smallWhite {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px; color:#FFFFFF; text-decoration:underline;}
		A.smallWhite:hover {color:Yellow; text-decoration:underline;}
		A.smallWhite:active {color:Yellow;}
		A.smallWhite:visited {color:#FFFFFF;}
		A.smallWhite:visited:hover {color:Yellow; text-decoration:underline;}

		.smallGray {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px;	color:#C0C0C0; text-decoration:none;}
		A.smallGray {font-family:Verdana,Arial,Helvetica,sans-serif; font-size:9px; color:#C0C0C0; text-decoration:none;}
		A.smallGray:hover {color:#585858; text-decoration:underline;}
		A.smallGray:active {color:#585858;}
		A.smallGray:visited {color:#C0C0C0;}
		A.smallGray:visited:hover {color:#585858; text-decoration:underline;}

		table.borderBlue {border: 1px solid #58639B;}
		table.borderBlue td {border: 1px solid #58639B;}
		
		table.borderNone {border: 0px solid;}
		table.borderNone td {border: 0px solid;}
	</style>

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

	<script>
	function validateForm(theForm){
	// Carrier
		if (theForm.carrier){
			var carrierSelected = false;
			for (i = 0;  i < theForm.carrier.length;  i++){
				if (theForm.carrier[i].checked){
					carrierSelected = true;
				}
			}
			if (!carrierSelected){
				document.getElementById('carriers').style.background="#FF0000";
				alert("Please Select Your Carrier Before Continuing.");
				document.getElementById('carriers').style.background="#FFE100";
				theForm.carrier[0].focus();
				return false;
			}
		}
	// Account Number
		if (theForm.acct_num){
			if (theForm.acct_num.value == ""){
				theForm.acct_num.style.background="#FF0000";
				alert("Please Enter Your Account Number");
				theForm.acct_num.style.background="#FFE100";
				theForm.acct_num.focus();
				return false;
			}
		}
	// Phone #1
		if (theForm.phone_1){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone_1.value) == false && phone2_regex.test(theForm.phone_1.value) == false) { 
				theForm.phone_1.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone_1.style.background="#FFE100";
				theForm.phone_1.focus();
				return false;
			}
		}
	// Phone #2
		if (theForm.phone_2 && theForm.phone_2.value != ""){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone_2.value) == false && phone2_regex.test(theForm.phone_2.value) == false) { 
				theForm.phone_2.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone_2.style.background="#FFE100";
				theForm.phone_2.focus();
				return false;
			}
		}
	// Phone #3
		if (theForm.phone_3 && theForm.phone_3.value != ""){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone_3.value) == false && phone2_regex.test(theForm.phone_3.value) == false) { 
				theForm.phone_3.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone_3.style.background="#FFE100";
				theForm.phone_3.focus();
				return false;
			}
		}
	// Phone #4
		if (theForm.phone_4 && theForm.phone_4.value != ""){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone_4.value) == false && phone2_regex.test(theForm.phone_4.value) == false) { 
				theForm.phone_4.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone_4.style.background="#FFE100";
				theForm.phone_4.focus();
				return false;
			}
		}
	// Phone #5
		if (theForm.phone_5 && theForm.phone_5.value != ""){
			var phone1_regex = /^\([1-9]\d{2}\)\s?\d{3}\-\d{4}$/;  // (xxx)xxx-xxxx
			var phone2_regex = /^[1-9]\d{2}\-\d{3}\-\d{4}$/;  // xxx-xxx-xxxx
 			if (phone1_regex.test(theForm.phone_5.value) == false && phone2_regex.test(theForm.phone_5.value) == false) { 
				theForm.phone_5.style.background="#FF0000";
				alert('Please Enter a Valid Phone Number as (NNN)NNN-NNNN or NNN-NNN-NNNN');
				theForm.phone_5.style.background="#FFE100";
				theForm.phone_5.focus();
				return false;
			}
		}
	// First Name
		if (theForm.first_name){
			if (theForm.first_name.value == ""){
				theForm.first_name.style.background="#FF0000";
				alert("Please Enter Your First Name");
				theForm.first_name.style.background="#FFE100";
				theForm.first_name.focus();
				return false;
			}
		}
	// Last Name
		if (theForm.last_name){
			if (theForm.last_name.value == ""){
				theForm.last_name.style.background="#FF0000";
				alert("Please Enter Your Last Name");
				theForm.last_name.style.background="#FFE100";
				theForm.last_name.focus();
				return false;
			}
		}
	// Address
		if (theForm.address_1.value == "" && theForm.address_2.value == ""){
			theForm.address_1.style.background="#FF0000";
			theForm.address_2.style.background="#FF0000";
			alert("Please Enter Your Address Exactly As It Appears On Your Bill");
			theForm.address_1.style.background="#FFE100";
			theForm.address_2.style.background="#FFE100";
			theForm.address_1.focus();
			return false;
		}
	// City
		if (theForm.city.value == ""){
			theForm.city.style.background="#FF0000";
			alert("Please Enter Your City Exactly As It Appears On Your Bill");
			theForm.city.style.background="#FFE100";
			theForm.city.focus();
			return false;
		}
	// State
		if (theForm.state.value == ""){
			theForm.state.style.background="#FF0000";
			alert("Please Select Your Billing State");
			theForm.state.style.background="#FFE100";
			theForm.state.focus();
			return false;
		}
	// Zip Code
		if (theForm.zipcode.value == ""){
			theForm.zipcode.style.background="#FF0000";
			alert("Please Enter Your Billing Zip Code");
			theForm.zipcode.style.background="#FFE100";
			theForm.zipcode.focus();
			return false;
		}
		var usa_regex = /(^\d{5}$)|(^\d{5}-\d{4}$)/;  // xxxxx or xxxxx-xxxx
//		var cdn_regex = /(^\D{1}\d{1}\D{1}\s\d{1}\D{1}\d{1}$)|(^\D{1}\d{1}\D{1}\-?\d{1}\D{1}\d{1}$)/;  // ANA NAN or ANA-NAN
//		if (usa_regex.test(theForm.zipcode.value) == false && cdn_regex.test(theForm.zipcode.value) == false) { 
		if (usa_regex.test(theForm.zipcode.value) == false) { 
			theForm.zipcode.style.background="#FF0000";
			alert('Please Enter a Valid Zip Code as "NNNNN" or "NNNNN-NNNN"');
			theForm.zipcode.style.background="#FFE100";
			theForm.zipcode.focus();
			return false;
		}
	// Email Address
		if (theForm.email){
			if (theForm.email.value == ""){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("Please Enter Your Email Address Twice to Confirm");
				theForm.email.style.background="#FFE100";
				theForm.email_confirm.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "@"
	 		if (theForm.email.value.indexOf("@") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain an "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "@" as first char.
	 		if (theForm.email.value.indexOf("@") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for anything after "@"
	 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Domain Name After the "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for multiple "@"
	 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain Only One "@"');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "."
	 		if (theForm.email.value.indexOf(".") == -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "." as first char.
	 		if (theForm.email.value.indexOf(".") == 0) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Cannot Start With a "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for ".."
	 		if (theForm.email.value.indexOf("..") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots ("..")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for "." adjacent to "@"
	 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD
	 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD at least 2 char.
			var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
			if (domain.length - (domain.indexOf(".")+1) < 2) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for TLD over 3 char.
//			if (domain.length - (domain.indexOf(".")+1) > 3) {
//				theForm.email.style.background="#FF0000";
//				alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//				theForm.email.style.background="#FFE100";
//				theForm.email.focus();
//				return false;
//			}
			// Check for "_" in TLD
			if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
				theForm.email.style.background="#FF0000";
				alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for spaces
	 		if (theForm.email.value.indexOf(" ") != -1) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Spaces (" ")');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			// Check for illegal char.
			var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
	 		if (email_regex.test(theForm.email.value) == false) { 
				theForm.email.style.background="#FF0000";
				alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
				theForm.email.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
			if (theForm.email.value != theForm.email_confirm.value){
				theForm.email.style.background="#FF0000";
				theForm.email_confirm.style.background="#FF0000";
				alert("The Email Addresses You Entered Do Not Match - Please Correct Them");
				theForm.email.style.background="#FFE100";
				theForm.email_confirm.style.background="#FFE100";
				theForm.email.focus();
				return false;
			}
		}
		return true;
	}
	</script>

</head>

<body leftmargin="0" topmargin="10" rightmargin="0" bottommargin="0" style="background-color: transparent;" onLoad="window.resizeTo(800,775)">

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
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$site = $_REQUEST['site'];
?>

<?
// Connect to the database
include "dbconnect.php";
?>

<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE site = '$site'", $linkID);
$config = mysql_fetch_assoc($result);
$label = $config['label'];
$title = $config['title'];
$header_logo = $config['header_logo'];
$header_promo = $config['header_promo'];
$pricing_level = $config['pricing_level'];
$sprint_site = $config['sprint'];
$sprint_discount = $config['sprint_discount'];
$nextel_site = $config['nextel'];
$nextel_discount = $config['nextel_discount'];
$cingular_site = $config['cingular'];
$cingular_discount = $config['cingular_discount'];
?>

<table width="750" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#8D8D8D">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
		<!-- Header -->
		<tr>
			<td bgcolor="#FFE100">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="200"><a href="javascript:SpawnChild('http://www.sprintstorelocator.com/sprintLocator/searchForm.jsp','child','800','600','yes','','','','','1','1','1','1','1'); child.focus();" onmouseover="window.status='Click Here For Your Discount!'; return true" onmouseout="window.status=''; return true"><img src="images/SprintHeaderLogo.jpg" alt="" width="200" height="100" border="0"></a></td>
					<td align="center">
						<img src="images/<? echo $header_logo; ?>" alt="<? echo $label; ?> Logo" width="500" height="75" border="0"><br>
						<? echo iif($header_promo != '', '<img src="images/'.$header_promo.'" alt="" width="500" height="25" border="0">', '&nbsp;'); ?>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#C0C0C0"><img src="images/spacer.gif" alt="" width="740" height="1" border="0"></td>
		</tr>
		<tr>
			<td>
	<?
	if ($sec == "contractors"){
	?>
				<br>
				<form action="?sec=saveit&site=<? echo $_REQUEST['site']; ?>" method="post" name="PacerDisc" id="PacerDisc" onSubmit="return validateForm(this);">
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" class="borderBlue">
				<tr bgcolor="#58639B">
					<td width="700" colspan="2" class="bodyWhite"><strong>&nbsp;Affiliate Discount</strong></td>
				</tr>
				<tr bgcolor="#FFFFFF" class="bodyBlack">
					<td>
						<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" class="borderNone">
						<tr>
							<td width="100%" colspan="4" align="center" class="bigBlack">
								<br><strong>Pacer Contractors and Fleet & Owner Operators<br>Sprint-Nextel Wireless Service Discount Request Form</strong><br><br>
							</td>
						</tr>
						<tr>
							<td colspan="4" bgcolor="#58639B"><img src="images/spacer.gif" alt="" width="700" height="2" border="0"></td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
						</tr>
						<tr class="xbigBlack">
							<td width="200" align="right">Select Carrier:&nbsp;</td>
							<td width="150" align="center" class="bigBlack" style="background-color: #FFE100; border-top: 2px solid Gray; border-left: 2px solid Gray; border-bottom: 1px solid Silver; border-right: 1px solid Silver;" id="carriers" name="carriers"><input type="radio" name="carrier" value="Sprint" tabindex="1" style="height: 17px;">Sprint&nbsp;&nbsp;<input type="radio" name="carrier" value="Nextel" tabindex="2" style="height: 17px;">Nextel</td>
							<td width="150" align="right">Account #:&nbsp;</td>
							<td width="200"><input type="text" name="acct_num" id="acct_num" size="20" maxlength="50" tabindex="3" class="bodyBlack" style="background-color: #FFE100;" value=""></td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr class="xbigBlack">
							<td align="right" valign="top">Mobile Number(s):&nbsp;</td>
							<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td>
										<input type="text" name="phone_1" id="phone_1" size="13" maxlength="15" tabindex="4" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Phone #1</strong>
									</td>
									<td>
										<input type="text" name="phone_2" id="phone_2" size="13" maxlength="15" tabindex="5" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Phone #2</strong>
									</td>
									<td>
										<input type="text" name="phone_3" id="phone_3" size="13" maxlength="15" tabindex="6" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Phone #3</strong>
									</td>
									<td>
										<input type="text" name="phone_4" id="phone_4" size="13" maxlength="15" tabindex="7" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Phone #4</strong>
									</td>
									<td>
										<input type="text" name="phone_5" id="phone_5" size="13" maxlength="15" tabindex="8" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Phone #5</strong>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td align="right" valign="top" class="xbigBlack">Name As On Bill:&nbsp;</td>
							<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="160">
										<input type="text" name="first_name" id="first_name" size="25" maxlength="50" tabindex="9" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>First</strong>
									</td>
									<td width="70">
										<input type="text" name="middle_name" id="middle_name" size="7" maxlength="10" tabindex="10" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>MI</strong>
									</td>
									<td>
										<input type="text" name="last_name" id="last_name" size="25" maxlength="50" tabindex="11" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Last</strong>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td align="right" valign="top" class="xbigBlack">Billing Address:&nbsp;</td>
							<td colspan="3">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3">
										<input type="text" name="address_1" id="address_1" size="56" maxlength="50" tabindex="12" class="bodyBlack" style="background-color: #FFE100;" value="">
									</td>
								</tr>
								<tr>
									<td colspan="3">
										<input type="text" name="address_2" id="address_2" size="56" maxlength="50" tabindex="13" class="bodyBlack" style="background-color: #FFE100;" value="">
									</td>
								</tr>
								<tr>
									<td width="160">
										<input type="text" name="city" id="city" size="25" maxlength="50" tabindex="14" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>City</strong>
									</td>
									<td width="70">
										<select name="state" id="state" tabindex="15" class="bodyBlack" style="background-color: #FFE100;">
											<option value="">Select</option>
							                <option value="AL">AL</option>
											<option value="AK">AK</option>
											<option value="AZ">AZ</option>
											<option value="AR">AR</option>
											<option value="CA">CA</option>
											<option value="CO">CO</option>
											<option value="CT">CT</option>
											<option value="DE">DE</option>
											<option value="DC">DC</option>
											<option value="FL">FL</option>
											<option value="GA">GA</option>
											<option value="HI">HI</option>
											<option value="ID">ID</option>
											<option value="IL">IL</option>
											<option value="IN">IN</option>
											<option value="IA">IA</option>
											<option value="KS">KS</option>
											<option value="KY">KY</option>
											<option value="LA">LA</option>
											<option value="ME">ME</option>
											<option value="MD">MD</option>
											<option value="MA">MA</option>
											<option value="MI">MI</option>
											<option value="MN">MN</option>
											<option value="MS">MS</option>
											<option value="MO">MO</option>
											<option value="MT">MT</option>
											<option value="NE">NE</option>
											<option value="NV">NV</option>
											<option value="NH">NH</option>
											<option value="NJ">NJ</option>
											<option value="NM">NM</option>
											<option value="NY">NY</option>
											<option value="NC">NC</option>
											<option value="ND">ND</option>
											<option value="OH">OH</option>
											<option value="OK">OK</option>
											<option value="OR">OR</option>
											<option value="PA">PA</option>
											<option value="RI">RI</option>
											<option value="SC">SC</option>
											<option value="SD">SD</option>
											<option value="TN">TN</option>
											<option value="TX">TX</option>
											<option value="UT">UT</option>
											<option value="VT">VT</option>
											<option value="VA">VA</option>
											<option value="WA">WA</option>
											<option value="WV">WV</option>
											<option value="WI">WI</option>
											<option value="WY">WY</option>
										</select>
										<br><span class="smallBlack"><strong>State</strong>
									</td>
									<td>
										<input type="text" name="zipcode" id="zipcode" size="10" maxlength="10" tabindex="16" class="bodyBlack" style="background-color: #FFE100;" value=""><br><span class="smallBlack"><strong>Zipcode</strong>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
						</tr>
						<tr>
							<td align="right" valign="top" class="xbigBlack">Email Address:&nbsp;</td>
							<td>
								<input type="text" name="email" id="email" size="25" maxlength="50" tabindex="17" class="bodyBlack" style="background-color: #FFE100;" value="">
							</td>
							<td align="right" valign="top" class="xbigBlack">Retype Email:&nbsp;</td>
							<td>
								<input type="text" name="email_confirm" id="email_confirm" size="25" maxlength="50" tabindex="18" class="bodyBlack" style="background-color: #FFE100;" value="">
							</td>
						</tr>
						<tr>
							<td colspan="4"><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<br>
				<input type="hidden" name="affiliation" value="<? echo $label; ?>">
				<img src="images/spacer.gif" alt="" width="50" height="1" border="0"><input type="image" name="submit" src="images/SubmitFormButton.gif"></form>
	<?
	}
	elseif ($sec == "saveit"){
		// connect to database and write record
		$query =
			"INSERT INTO discounts (
			affiliation,
			ipaddress,
			carrier,
			acct_num,
			phone_1,
			phone_2,
			phone_3,
			phone_4,
			phone_5,
			first_name,
			middle_name,
			last_name,
			address_1,
			address_2,
			city,
			state,
			zipcode,
			email,
			timestamp)
			VALUES (
			'".$_REQUEST['affiliation']."',
			'".getenv('REMOTE_ADDR')."',
			'".$_REQUEST['carrier']."',
			'".$_REQUEST['acct_num']."',
			'".$_REQUEST['phone_1']."',
			'".$_REQUEST['phone_2']."',
			'".$_REQUEST['phone_3']."',
			'".$_REQUEST['phone_4']."',
			'".$_REQUEST['phone_5']."',
			'".$_REQUEST['first_name']."',
			'".$_REQUEST['middle_name']."',
			'".$_REQUEST['last_name']."',
			'".$_REQUEST['address_1']."',
			'".$_REQUEST['address_2']."',
			'".$_REQUEST['city']."',
			'".$_REQUEST['state']."',
			'".$_REQUEST['zipcode']."',
			'".$_REQUEST['email']."',
			NOW())";
//echo $query.'<br></br>';
		$rs_insert = mysql_query($query, $linkID);
	?>
				<br><br>
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td colspan="2" align="center"><img src="images/PacerLogoNew.jpg" alt="Pacer International Logo" width="140" height="131" border="0"><br><br></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="top" class="bigBlack">
						<br>
						<strong class="xbigBlack">Thank You!</strong><br>
						<strong>Your request has been accepted.</strong><br><br>
					</td>
				</tr>
				<tr>
					<td class="bodyBlack">
						<ul>
							<li><strong>It may take up to two complete billing cycles before your discount is reflected on your monthly statement. For Sprint PCS Customers your billing cycle will change to the 6th of each month.  This may cause a one-time prorated adjustment on your bill.</strong></li>
						</ul>
					</td>
					<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
				</tr>
				<tr>
					<td colspan="2" align="center" valign="top" class="bigBlack">
						<br><a href="javascript:window.close()" class="bigBlack" style="text-decoration: underline;"><strong>You may close this window now.</strong></a>
					</td>
				</tr>
				</table>
				<br><br>
	<?
	}else{
	?>
				<br><br>
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td colspan="2" align="center"><img src="images/PacerLogoNew.jpg" alt="Pacer International Logo" width="140" height="131" border="0"><br><br></td>
				</tr>
				<tr>
					<td width="50%" align="center" valign="top">
						<a href="http://www.sprint-discount.com" target="_self" class="bigBlack">
						<img src="images/PacerEmployees.jpg" alt="Pacer International Employees" width="160" height="70" border="0"><br>
						<strong>Pacer Employees<br>Click Here</strong>
						</a>
					</td>
					<td width="50%" align="center" valign="top">
						<a href="?sec=contractors&site=<? echo $_REQUEST['site']; ?>" class="bigBlack">
						<img src="images/PacerContractors.jpg" alt="Pacer International Contractors, Fleet & Owner Operators" width="160" height="70" border="0"><br>
						<strong>Pacer Contractors,<br>Fleet & Owner Operators<br>Click Here</strong>
						</a>
					</td>
				</tr>
				</table>
				<br><br>
	<?
	}
	?>
			</td>
		</tr>
		</table>
	</td>
</tr>
<!-- Footer -->
<tr bgcolor="#8D8D8D">
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="0" height="70" border="0"></td>
			<td width="150" rowspan="2" valign="top">
				<!-- BEGIN ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
				<div id="ps_visionwireless_chat_button" style="width:140px;height:60px;display:inline"><spacer type="block" width="140" height="60"></spacer></div><div id="ps_visionwireless_chat_invitation" style="z-index:100;position:absolute;left:0px;top:0px;"></div><script id="ps_visionwireless_scr" language="JavaScript"></script><script language="JavaScript">if(document.getElementById)document.getElementById("ps_visionwireless_scr").src="https://secure.providesupport.com/image/js/visionwireless/safe-standard.js?ps_t="+new Date().getTime()</script><noscript><a href="http://www.providesupport.com?messenger=visionwireless" target="_blank">Live Support Chat</a></noscript>
				<!-- END ProvideSupport.com Standard Graphics Chat Button Code for Secure Pages -->
			</td>
			<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td valign="top" class="smallWhite">
				<strong>
				<li>For help with existing Sprint accounts, please call 888.211.4727.</li>
				<li>To request a company sponsored discount be applied to your individual Sprint account, <a a href="http://www.sprint-discount.com" target="_self" class="smallWhite">click here</a>.</li>
				<li>For help with online orders call 877.351.1658 or email <a href="mailto:personalcell@cellbenefits.com" class="smallWhite">personalcell@cellbenefits.com</a>.
				</strong>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="150" valign="bottom"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><!--<a href="?sec=privacy" class="smallWhite"><strong>Privacy Policy</strong></a>--></td>
			<td align="center" valign="bottom" class="smallGray"><strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Vision Wireless" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td>
			<td width="150" align="right" valign="bottom" class="smallGray"><strong><? echo $label; ?></strong><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<!-- Copyrights --
<div align="center" class="smallGray">
<strong>Copyright&copy; 2006-<? echo date("Y"); ?>, <a href="http://www.visioncell.com" title="Business Wireless Solutions" target="_blank" class="smallGray">Vision Wireless</a>.&nbsp;&nbsp;All Rights Reserved.</strong><br>
<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
</div>-->


</body>
</html>

