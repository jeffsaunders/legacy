<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Web advertising inquiry and info. Football information and picks.</title>
<meta name="description" content="Dennis Tobler's Football Forecast Weekly, Football bets">
<link href="css/style.css" type="text/css" rel="stylesheet">



<script>
function validate(){
 var verified = true;
 var missing = "";

//verify terms
if (document.theForm.FirstName.value == ''){
missing += "First Name\n";
}
if (document.theForm.LastName.value == ''){
missing += "Last Name\n";
}
if (document.theForm.Phone.value == ''){
missing += "Phone\n";
}
if (document.theForm.CurrentURL.value == ''){
missing += "Current URL\n";
}
if (document.theForm.PreferredPage.value == ''){
missing += "Preferred Page\n";
}
if (document.theForm.URLLink.value == ''){
missing += "URL Link\n";
}
if (document.theForm.Notes.value == ''){
missing += "Description\n";
}
if (document.theForm.Email.value == ''){
missing += "Email\n";
}
else {
if(!validateemail(document.theForm.Email.value)) {
missing += "Email Invalid\n";
}
}
if (missing != ''){
alert("Fields missing or incorrect:\n\n" + missing);
return false;
}

return true;
}

function validateemail(emailAddress) {
var match = 
/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*$/.test(emailAddress);
return match;
}

</SCRIPT>

</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>

<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>

<? include('tdleft.php'); ?>

</td>

<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">
<p align="center"><font color="#990000"><span style="font-size: 15pt">
<img border="0" src="images/lock.jpg" width="12" height="15"> Secure Inquiry - 
Web Advertising <img border="0" src="images/lock.jpg" width="12" height="15"></span></font><br>
</p>
<div align="center">
<table cellspacing="1" cellpadding="0" width="440" bgcolor="#C0C0C0">
<tr>


<FORM action="form_processor.php" name="theForm" method="post" onsubmit="return validate();">
<input type="hidden" name="recipient" value="info@footballforecast.com">
<input type="hidden" name="recipient_cc" value="tobler@nr.net">
<input type="hidden" name="redirect" value="form_success.php">
<input type="hidden" name="subject" value="Web Inquiry Internet Advertising [footballforecast.com]">
<input type="hidden" name="print_blank_fields" value="true">
<input type="hidden" name="env_report" value="REMOTE_HOST,SERVER_PORT,HTTP_USER_AGENT">



<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font style="font-size:11pt" color="#FFFFFF">First Name<FORM action="form_processor.php" name="theForm" method="post"  onsubmit="return validate();">
</font></b>

<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="271">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="FirstName" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Last
  Name</font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="271">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="LastName" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Phone
  Number</font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" valign="middle" align="left" height="30" width="271">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="Phone" size="25" tabindex="0"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Email</font></td>
<td style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" bgcolor="#990000" height="30" width="271">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="Email" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<b>
<font color="#FFFFFF" style="font-size: 11pt">Best contact time</font></b></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" valign="middle" align="left" height="30" width="271">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="BestTime" size="25" tabindex="0"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font color="#FFFFFF"><span style="font-size: 11pt">Current Banner URL</span></font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" valign="middle" align="left" height="30" width="271">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="CurrentURL" size="25" tabindex="0"></span></font><font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight:400"> 
(for preview)</font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font color="#FFFFFF"><span style="font-size: 11pt">Preferred Page</span></font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" valign="middle" align="left" height="30" width="271">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="PreferredPage" size="25" tabindex="0"> </span></font>
<font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight:400">
(on our site)</font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="30" width="146">
<font color="#FFFFFF"><span style="font-size: 11pt">URL Link</span></font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0; font-family:Arial; font-size:10pt; font-weight:bold" valign="middle" align="left" height="30" width="271">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="URLLink" size="25" tabindex="0"> </span></font>
<font face="Arial" color="#FFFFFF" style="font-size: 8pt; font-weight:400">
(to your site)</font></td>
</tr>
<tr>
<td align="center" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0; font-family:Arial; font-size:10pt; font-weight:bold" height="168" colspan="2">
<font color="#FFFFFF"><b><span style="font-size: 11pt">Select Banner Ad</span></b></font><br>

<table id="table1" borderColor="#000000" cellSpacing="1" bgColor="#990000" border="0" cellpadding="3">
	<tr>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#990000" colspan="2" rowspan="2">
		<p align="center">&nbsp;</td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="1mo" name="BannerAdTime[]"></font></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="3mo" name="BannerAdTime[]"></font></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="6mo" name="BannerAdTime[]"></font></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="12mo" name="BannerAdTime[]" checked></font></td>
	</tr>
	<tr>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF">1 Month</font></b></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF">3 Months</font></b></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF">6 Months</font></b></td>
		<td style="FONT-WEIGHT: bold; FONT-SIZE: 8pt; FONT-FAMILY: Arial" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF">12 Months</font></b></td>
	</tr>
	<tr>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="468" name="BannerAdSize[]" checked></font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">
		<b><font color="#0000FF" face="Arial">468 x 60</font></b></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$360.00</td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$972.50<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$1890.00<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$3240.00<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
	</tr>
	<tr>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="195" name="BannerAdSize[]"></font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF" face="Arial">195 x 60</font></b></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$150.00</td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$665.00<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$787.50<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$1350.00<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
	</tr>
	<tr>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff" align="center">
		<font style="FONT-SIZE: 10pt" face="Arial">
		<input type="radio" value="120" name="BannerAdSize[]"></font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center"><b><font color="#0000FF" face="Arial">120 x 60</font></b></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$122.50</td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$405.00<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$647.50<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
		<td style="FONT-SIZE: 8pt; FONT-FAMILY: Verdana" bgColor="#ffffff">
		<p align="center">$1107.50<font style="FONT-WEIGHT: 400; FONT-SIZE: 8pt" face="Verdana">*</font></td>
	</tr>
</table>
</td>
</tr>
<tr>
<td colSpan="2" align="center" bgcolor="#990000" style="font-family: Arial; font-size: 10pt; font-weight: bold">
<p align="center"><b><font style="font-size:11pt" color="#FFFFFF"><br>
Notes / Description</font><font style="font-size:9pt" color="#FFFFFF"><span style="font-weight: 400"> 
(Please be descriptive)</span></font><font style="font-size:11pt" color="#FFFFFF"><br></font></b>
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<textarea name="Notes" rows="5" cols="50" style="font-family:Verdana; font-size:10pt"></textarea></span></font><b><font color="#FFFFFF" style="font-size: 11pt">
</font>
</b>
</p>
<p align="center"><font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input type="submit" value="Submit" style="font-family: Verdana; font-size: 10pt"></span></font><font color="#FFFFFF" style="font-weight: 700; font-size: 11pt"><br>
&nbsp;</font></p>
</td>
</tr>
</table>

	</div>

</td>

<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>

<? include('tdright.php'); ?>

</td>

</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>