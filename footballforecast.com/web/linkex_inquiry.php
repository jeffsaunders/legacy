<?php
include_once('includes/config.inc.php');
if(isset($_POST['Email'])) {
	$query="INSERT INTO link SET admin='".$_POST['FirstName']." ".$_POST['LastName']."', 
	description='".$_POST['LinkDescription']."', name='".$_POST['LinkTitle']."', url='".$_POST['LinkURL']."', 
	email='".$_POST['Email']."', phone='".$_POST['Phone']."', reciprocal='".$_POST['ReciprocalLinkURL']."', 
	active=0";
	
	//send notification email
	foreach ($_POST as $key=>$val) {
		$_POST[$key]=stripslashes($val);
	}
	$content='Link Exchange Inquiry Form Submission
-------------------------------------------------------
Name : '.$_POST['FirstName'].' '.$_POST['LastName'].'
Phone : '.$_POST['Phone'].'
Email : '.$_POST['Email'].'
Link Title : '.$_POST['LinkTitle'].'
URL : '.$_POST['LinkURL'].'
Description : '.$_POST['LinkDescription'].'
ReciURL : '.$_POST['ReciprocalLinkURL'].'
-------------------------------------------------------

You can approve the link exchange request at
http://www.footballforecast.com/link_admin.php
';
	$header='From: '.$_POST['FirstName'].' '.$_POST['LastName'].'<'.$_POST['Email'].'>';
	@mail('info@footballforecast.com','New Link Exchange Request',$content,$header);
	mysql_query($query);
	header('Location: form_success.php');
	die();
}
?>
<html>

<head>
<title>Dennis Tobler's Football Forecast Weekly</title>
<link href="css/style.css" type="text/css" rel="stylesheet">
<script>
function validate(){
	var verified = true;
	var missing = "";

//verify terms

	if (document.theForm.terms.checked == false){
		missing = "Requirements\n\n";
	}
	if (document.theForm.FirstName.value == ''){
		missing += "First Name\n";
	}
	if (document.theForm.LastName.value == ''){
		missing += "Last Name\n";
	}
	if (document.theForm.Phone.value == ''){
		missing += "Phone\n";
	}
	if (document.theForm.Email.value == ''){
		missing += "Email\n";
	}
	if (document.theForm.LinkTitle.value == ''){
		missing += "Link Title\n";
	}
	if (document.theForm.LinkURL.value == ''){
		missing += "Link URL\n";
	}
	if (document.theForm.LinkDescription.value == ''){
		missing += "Link Description\n";
	}
	if (document.theForm.ReciprocalLinkURL.value == ''){
		missing += "Existing Reciprocal Link\n";
	}			
	if (missing != ''){
		alert("Fields missing or incorrect:\n\n" + missing);
		return false;
	}
	return true;
}
</script>
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
<p align="center"><font color="#990000"><span style="font-size: 15pt">Link 
Exchange Inquiry 
Form<br>
</span>Please <a href="linkex_details.php">click here</a> to read our 
link exchange requirements first.</font><br>
</p>
<div align="center">
<table cellspacing="1" cellpadding="0" width="440" bgcolor="#C0C0C0">
<tr>
<td align="right" bgcolor="#990000" style="padding-left: 5px; padding-right: 5px; padding-top: 0; padding-bottom: 0" height="30">


<b>


<font style="font-size:11pt" color="#FFFFFF">First Name<FORM action="linkex_inquiry.php" name="theForm" method="post"  onsubmit="return validate();">
</font></b><font face="Arial" color="#FFFFFF"><span style="font-size: 11pt">
<input type="hidden" name="recipient" value="tobler@nr.net" style="font-weight: 700">
<input type="hidden" name="redirect" value="form_success.php" style="font-weight: 700">
<input type="hidden" name="subject" value="Inquiry [Link Exchange]" style="font-weight: 700">
<input type="hidden" name="print_blank_fields" value="true" style="font-weight: 700">
<input type="hidden" name="env_report" value="REMOTE_HOST,SERVER_PORT,HTTP_USER_AGENT" style="font-weight: 700">

</span></font>

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
<td colSpan="2" align="center" width="100%" bgcolor="#990000" height="150">
<p align="center"><b><font style="font-size:11pt" color="#FFFFFF">&nbsp;<br>
Your
Link Title<br></font></b>
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<textarea name="LinkTitle" rows="2" cols="50" style="font-family:Verdana; font-size:10pt"></textarea></span></font></p>
<p align="center"><b><font color="#FFFFFF" style="font-size: 11pt">
Your
URL</font></b><font color="#FFFFFF" style="font-size: 8pt"> (Domain Name)</font><font color="#FFFFFF" style="font-size: 11pt"><b><br>
</b>
</font>
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="LinkURL" size="50" tabindex="0"></span></font></p>
<p align="center"><b><font color="#FFFFFF" style="font-size: 11pt">
Your
Description</font></b><font color="#FFFFFF" style="font-size: 8pt"> (max 50 
words or 300 characters)</font><font color="#FFFFFF" style="font-size: 11pt"><b><br>
</b>
</font>
<font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<textarea name="LinkDescription" rows="4" cols="50" style="font-family:Verdana; font-size:10pt"></textarea></span></font></p>
<p align="center"><hr color="#FFFFFF">
<p align="center"><font color="#FFFFFF" style="font-size: 11pt"> <b>Reciprocal 
Link URL</b></font><font color="#FFFFFF" style="font-size: 8pt"> (enter exact 
link to our web site on your page)</font><font color="#FFFFFF" style="font-size: 11pt"><b><br>
</b>
</font>
<font size="2" face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input style="font-family:Verdana; font-size:10pt" name="ReciprocalLinkURL" size="50" tabindex="0"></span></font></p>
</p>
<p align="center"><font color="#FFFFFF" style="font-size: 11pt"> <b>Requirements<br>
</b></font>
<textarea style="FONT-SIZE: 8pt; COLOR: #808080; FONT-FAMILY: Verdana" name="TermsText" rows="5" cols="58"> Please consider that your link will not be added or will be deleted if:
 
  - we were unable to locate a link from your site to our site
  - your site has no PR or is not cached by Google
  - your site relates to pornography, racism, hate or similar themes
  - your site relates to Viagra or other controversial pharmaceutical products
  - your link to our site is not direct
  - your site is blacklisted at some search engines
  - your site is or is participating in a link farm
  - your current PR is based on link spamming within your domain
  - you have too many outbound links on the reciprocal page (low shared PR value of single link)
  - if your site contains stolen content, art or copyrighted text, or directory listings pages or page parts


 Please consider that your site must fulfill the following requirements for a link exchange:
 
  - full reciprocal link on the same domain
  - low number of outbound links (depending on the PR of the reciprocal page)
  - PR 4 or higher on the reciprocal page where the link resides
  - cached by google, DMOZ listing
  - no illegal, adult, pharmaceutical, racist, hate or pornographic content on that domain
  - no existing links to any of the above listed contents/pages/domains</textarea></p>

			<input type="checkbox" name="terms" value="ON"><b><font color="#FFFFFF"><span style="font-size: 11pt"> 
Yes, I've read and understand the requirements.</span></font></b><p align="center"><font face="Arial" color="#FFFFFF" style="font-size: 10pt">
<span style="font-size: 11pt">
<input type="submit" value="Submit Inquiry" style="font-family: Verdana; font-size: 10pt"></span></font><font color="#FFFFFF" style="font-weight: 700; font-size: 11pt"><br>
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
