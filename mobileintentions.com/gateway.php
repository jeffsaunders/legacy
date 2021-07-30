<?
//if (!$_SESSION['auth']) header("Location: http://www.mobileintentions.com/gateway.php"); exit; 
session_start(); 
header("Cache-control: private");  // IE 6 Fix.
?>
<!-- Start a session above -->
<!-- must be FIRST thing done, even before a comment -->

<!-- Grab The Database -->
<?
// Connect to the database
include "dbconnect.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>

	<title>T-Mobile Free Phones | Free Motorola RAZR | T-Mobile Wireless Offer | T-Mobile Cellular Plans | T-Mobile BlackBerry | T-Mobile PEBL</title>

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Function Libraries -->
	<script language="JavaScript" src="standard.js"></script>	
	<script language="JavaScript" src="custom.js"></script>	

	<!-- Validate Discount Code -->
	<script>
	function validate(){
		if (code.disccode.value.toUpperCase() == 'SE42' ||
			code.disccode.value.toUpperCase() == 'SC42' ||
			code.disccode.value.toUpperCase() == 'LX33' ||
			code.disccode.value.toUpperCase() == 'RL72' ||
			code.disccode.value.toUpperCase() == 'CG21' ||
			code.disccode.value.toUpperCase() == 'EM50'){ //Added by me as email request autoresponded discount code
			event.returnValue=true;
		}else if (code.disccode.value == ''){
			alert('Please enter your Offer Code.');
			event.returnValue=false;
			document.forms[0].disccode.focus();
		}else{
			alert('Discount Code Not Valid ... Please Try Again.');
			event.returnValue=false;
			document.forms[0].disccode.focus();
		}
	}
	</script>
	
</head>

<body bgcolor="#808080" leftmargin="0" topmargin="10" marginwidth="0" onload="show_clock();">

<table width="950" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#EAEAEA">
<!-- Header -->
<tr>
	<td height="100" background="images/HeaderBG.jpg"><img src="images/spacer.gif" alt="" width="1" height="60" border="0"><br><img src="images/spacer.gif" alt="" width="100" height="1" border="0"><script src="upticker.js"></script></td>
</tr>
<tr>
	<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
</tr>
<!-- Staus Bar -->
<tr>
	<td bgcolor="#505050" class="smallWhite">
		<table width="950" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="10"><img src="images/spacer.gif" alt="" width="10" height="13" border="0"></td>
			<td width="530" id="divMessage"><!-- Menu Text --></td>
			<td width="400" align="right" class="smallWhite"><strong><? include("./liveclock.js"); ?></strong></td>
			<td width="10"><img src="images/spacer.gif" alt="" width="10" height="13" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Main Body -->
<tr>
	<td background="images/BodyBG.jpg" style="background-position: top; background-repeat: no-repeat; background-attachment: scroll;">
		<img src="images/spacer.gif" alt="" width="1" height="30" border="0"><br>
		<table width="650" border="0" cellpadding="5" align="center" bgcolor="#000000">
		<tr>
			<td>
				<table width="640" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td height="238" background="images/LoginBG.jpg">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="3"><img src="images/spacer.gif" alt="" width="640" height="30" border="0"></td>
						</tr>
						<form action="http://www.mobileintentions.com" method="post" name="code" id="code" onSubmit="return validate();">
						<tr class="bodyBlack">
							<td><img src="images/spacer.gif" alt="" width="310" height="178" border="0"></td>
							<td width="300" align="center" valign="top" bgcolor="#FFFFFF" class="cellFrost">
								<br><strong class="biggerBlack" style="position:relative;">Welcome to Mobile Intentions</strong><br><br>
								<strong style="position:relative;">Please Enter Your Discount Code:</strong><br><br>
								<input type="text" name="disccode" id="disccode" size="20" maxlength="20" style="position:relative;"><br><br>
								<strong class="biggerBlack">&raquo; <a href="javascript:code.submit();" onClick="return validate();" class="biggerBlack" style="position:relative;">ENTER</a> &laquo;</strong><br><br>
								<em class="smallBlack" style="position:relative;">Don't Have a Code?</em><br>
								<strong class="smallBlack" style="position:relative;">
								<a href="mailto:mobileintentions@wbsrecords.com?subject=Mobile Intentions Discount Code Request&body=Thank you for your interest in Mobile Intentions' Wireless Phone Discount Program.%0A
%0A
Please provide the following information next to each line below and you will receive your Discount Code, delivered to this email address, right away.%0A
%0A
Name (Personal or Company): %0A
City and State or Country: %0A
Zip/Postal Code (if applicable): %0A
Contact Email Address: %0A
%0A
Thank you for your interest in Mobile Intentions!%0A" class="smallBlack">
								Click Here to Get One!</a></strong>
								<input type="hidden" name="auth" id="auth" value="true">
							</td>
							<td><img src="images/spacer.gif" alt="" width="30" height="178" border="0"></td>
						</tr>
						</form>
						<tr>
							<td colspan="3"><img src="images/spacer.gif" alt="" width="640" height="30" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		<img src="images/spacer.gif" alt="" width="1" height="30" border="0"><br>
	</td>
</tr>
<tr>
	<td bgcolor="#808080"><img src="images/spacer.gif" alt="" width="950" height="1" border="0"></td>
</tr>
<!-- Footer -->
<tr>
	<h3><td height="15" align="center" valign="bottom" bgcolor="#C0C0C0" class="smallBlack"><strong>Copyright&copy; 2005-<? echo date("Y"); ?>, <a href="http://www.mobileintentions.com" title="You're Already Here!" class="smallBlack">MobileIntentions.com</a>.&nbsp;&nbsp;All Rights Reserved.</strong></td></h3>
</tr>
<tr>
	<td height="20" align="center" valign="top" background="images/FooterBG.jpg" class="smallBlack">
		<strong>Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallBlack">Network Resources</a>, Las Vegas-Dallas-Milwaukee</strong>
	</td>
</tr>
</table>

<!-- Put the cursor in the Discount Code field -->
<script>document.forms[0].disccode.focus();</script>


</body>
</html>
