<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Contact information.  Football broadcast.</title>
<meta name="description" content="Dennis Tobler's Football Forecast Weekly, Football picks">
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
if (document.theForm.Notes.value == ''){
missing += "Notes\n";
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





<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>

<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>

<? include('tdleft.php'); ?>

</td>

<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">
<p align="center">
	<font color="#990000"><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15"> </span>
<span style="font-size: 15pt">Contact 
Form </span><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15"></span></font><br>
</p>
<div align="center">
<table cellspacing="1" cellpadding="0" width="440" bgcolor="#C0C0C0">
<tr>



<FORM action="form_processor.php" name="theForm" method="post" onsubmit="return validate();">
<input type="hidden" name="recipient" value="info@footballforecast.com">
<input type="hidden" name="recipient_bcc" value="tobler@nr.net">
<input type="hidden" name="redirect" value="form_success.php">
<input type="hidden" name="subject" value="Web Inquiry Contact [footballforecast.com]">
<input type="hidden" name="print_blank_fields" value="true">
<input type="hidden" name="env_report" value="REMOTE_HOST,SERVER_PORT,HTTP_USER_AGENT">


<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">
<b><font style="font-size:11pt" color="#FFFFFF">First Name<FORM action="form_processor.php" name="theForm" method="post"  onsubmit="return validate();">
</font></b>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0" height="30">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="FirstName" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Last
  Name</font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0" height="30">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="LastName" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Phone
  Number</font></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0" valign="middle" align="left" height="30">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="Phone" size="25" tabindex="0"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">
<font style="font-size:11pt; font-weight:700" color="#FFFFFF">Email
  Address</font></td>
<td style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0" bgcolor="#990000" height="30">
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input name="Email" size="25" style="font-family:Verdana; font-size:10pt"></span></font></td>
</tr>
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">
<b>
<font color="#FFFFFF" style="font-size: 11pt">Best contact time</font></b></td>
<td bgcolor="#990000" style="padding-left:5px; padding-right:5px; padding-top:0; padding-bottom:0" valign="middle" align="left" height="30">
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="BestTime" size="25" tabindex="0"></span></font></td>
</tr>
<tr>
<td colSpan="2" align="center" width="100%" bgcolor="#990000" height="150">
<p align="center"><b><font style="font-size:11pt" color="#FFFFFF">&nbsp;<br>
Inquiries ·&nbsp; Questions ·&nbsp; Notes<br></font></b>
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<textarea name="Notes" rows="16" cols="50" style="font-family:Verdana; font-size:10pt"></textarea></span></font><b><font color="#FFFFFF" style="font-size: 11pt">
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
<!--
	<p align="center">
	<font color="#990000"><span style="font-weight: 400; font-size: 14pt"><br>
	<span style="font-size: 4pt">&nbsp;</span><br>
	For phone inquiries please call: </span></font>
	<span style="font-size: 14pt"><i>Toll-free (800) 955-0644</i></span></div>
-->
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