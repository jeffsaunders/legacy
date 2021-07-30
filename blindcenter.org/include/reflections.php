<!-- BEGIN INCLUDE Reflections -->

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
	<td width="250" align="left" valign="top"><img src="images/spacer.gif" alt="" width="2" height="5" border="0"><br><img src="images/reflections200.gif" alt="" width="200" height="164" border="0"></td>
	<td width="350" valign="middle" class="bigBlack"><br><strong>The efforts of the Blind Center of Nevada are carried out with the help and support of community minded companies and volunteers.<br><br>We invite you to join the long list of community minded companies that have assisted the Center in our mission.</strong><br></td>
	<td>&nbsp;</td>
</tr>
</table>

<table width="635" border="0" cellspacing="0" cellpadding="0" align="center">
<?
if ((!$page) || $page == "1"){
?>
<tr>
<td class="bodyBlack">
	<br>
	<ul>
		<li>As a partner you will contribute the light of hope and vision to those blind and visually impaired in our community who can only see through your help.<br><br></li>
		<li>Your partnership is an act of good corporate citizenship.<br><br></li>
		<li>100% of the money donated stays in our community.<br><br></li>
		<li>Through your participation in our annual fundraisers and special events our corporate partners will be recognized thoughout the year by the media.<br><br></li>
		<li>There will be opportunities to build relationships with fellow corporate partners.<br><br></li>
		<li>Your partnership is an opportunity for you to create a company wide volunteer program to reach out to a special segment of our community.<br><br></li>
		<li>We are the ONLY day center and community based workshop for the blind and visually impaired in Southern Nevada. &nbsp;Your support enables us to continue and expand our programs and services.</li>
	</ul>
	<div align="right"><a href="?sec=reflections&page=2" class="xbigBlack">Partnership Benefits</a> <img src="images/trianglebullet.gif" width="16" height="18" border="0">&nbsp;&nbsp;&nbsp;<br><br></div>
</td>
</tr>
<?
}
if ($page == "2"){
?>
<tr>
	<td class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Partnership Benefits</td>
</tr>
<tr>
	<td class="bodyBlack">
		<br>
		<ul>
			<li><strong>ASSOCIATE PARTNERSHIP<br>Annual Donation: $2,500 - $4,999</strong><ul><li>Resolution of Appreciation<li>Inclusion in our Annual Report<li>Participation in our "Promoting Fellow Partners" Support Letter</ul><br><br>
			<li><strong>PATRON PARTNERSHIP<br>Annual Donation: $5,000 - $9,999</strong><ul><li>All of the above benefits<li>Special recognition on our Website<li>Listing in our Quarterly Newsletter<li>Presentation of The Blind Center's "Reflections of Light"</ul><br><br>
			<li><strong>ADVOCATE PARTNERSHIP<br>Annual Donation: $10,000 - $19,999</strong><ul><li>All of the above benefits<li>Hyperlink on our Website<li>Table at our Annual Partnership Recognition Dinner</ul><br><br>
			<li><strong>BENEFACTOR PARTNERSHIP<br>Annual Donation: $20,000+</strong><ul><li>All of the above benefits<li>Corporate name engraved on our donor's "Reflections of Light" Display</li><br><br>
		</ul>
		<div align="right"><a href="?sec=reflections&page=3" class="xbigBlack">Yes, I want to make a difference</a> <img src="images/trianglebullet.gif" width="16" height="18" border="0">&nbsp;&nbsp;&nbsp;<br><br></div>
	</td>
</tr>
<?
}
if ($page == "3"){
?>
<script language="Javascript">
// This function restricts keypresses for a given field to numbers only
function keyCheck(eventObj, obj){
	var keyCode
	// Check For Browser Type
	if (document.all){ 
		keyCode=eventObj.keyCode
	}else{
		keyCode=eventObj.which
	}
	var str=obj.value
	if(keyCode==46){ // Allow only 1 decimal in a number
		if (str.indexOf(".")>0){
			return false
		}
	}
	// Allow only integers, dollar signs, forward slashes, hyphens, commas & decimal points
	if((keyCode<44 || keyCode >58) && (keyCode != 46) && (keyCode != 36)){
		return false
	}
	return true
}
</script>

<tr>
	<td class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Yes, I want to make a difference</td>
</tr>
<tr>
	<td class="bodyBlack"><br><img src="images/spacer.gif" alt="" width="22" height="1" border="0"><strong>Please complete the following information form to join The Blind Center's <em>"Reflections of<br><img src="images/spacer.gif" alt="" width="22" height="1" border="0">Light"</em> Corporate Partnership Program.&nbsp;&nbsp;We will contact you to complete your application.</strong><br><br><img src="images/blackdot.gif" alt="" width="635" height="1" border="0"><br><br></td>
</tr>
<tr>
	<td align="center">
		<form action="formmail.php" method="POST">
		<input type="hidden" name="recipient" value="info@blindcenter.org">
		<input type="hidden" name="subject" value="Corporate Partnership Registration Form">
		<input type="hidden" name="required" value="firm,contact,address1,city,state,zip,phone,donation">
		<input type="hidden" name="print_blank_fields" value="1">
		<input type="hidden" name="redirect" value="./?sec=reflections&page=4">
		<table border="0" cellspacing="2" cellpadding="0" align="center">
		<tr>
			<td align="right" class="bodyBlack"><strong>Firm:</strong></td>
			<td align="left"><input type="text" name="firm" size="41" maxlength="50"></td>
			<td colspan="15"><img src="images/spacer.gif" alt="" width="50" height="1" border="0"></td>
		</tr>
		<tr>
			<td align="right" class="bodyBlack"><strong>Contact:</strong></td>
			<td align="left"><input type="text" name="contact" size="41" maxlength="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="bodyBlack"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong>Address:</strong></td>
			<td><input type="text" name="address1" size="41" maxlength="50"><br><input type="text" name="address2" size="41" maxlength="50"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
			<table cellspacing="0" cellpadding="0">
			<tr>
				<td class="smallBlack"><input type="text" name="city" size="16" maxlength="20">&nbsp;<br><strong>&nbsp;City</strong></td>
				<td class="smallBlack"><input type="text" name="state" size="4" maxlength="20">&nbsp;<br><strong>&nbsp;State</strong></td>
				<td class="smallBlack"><input type="text" name="zip" size="12" maxlength="20"><br><strong>&nbsp;Zip</strong></td>
			</tr>
			</table>
		</tr>
		<tr>
			<td align="right" class="bodyBlack"><strong>Phone:</strong></td>
			<td><input type="text" name="phone" size="41" maxlength="50"></td>
		</tr>
		<tr>
			<td align="right" class="bodyBlack"><strong>Fax:</strong></td>
			<td><input type="text" name="fax" size="41" maxlength="50"></td>
		</tr>
		<tr>
			<td align="right" class="bodyBlack"><strong>Email:</strong></td>
			<td><input type="text" name="email" size="41" maxlength="50"></td>
		</tr>
		<tr>
			<td align="right" class="bodyBlack"><strong>Donation:</strong></td>
			<td><input type="text" name="donation" value="$" size="41" maxlength="50" onKeyPress="return keyCheck(event, this)"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td align="center"><input type="submit" value="Submit">&nbsp;<input type="reset" value="Reset"><br><br></td>
		</tr>
		</table>
	</td>
</tr>
<?
}
if ($page == "4"){
?>
<meta HTTP-EQUIV="refresh" CONTENT="10; url=./">
<tr>
	<td align="center" class="bigBlack"><br><strong><span class="xbigBlack"><br>Thank You!</span><br><br>Your information has been submitted.<br>A representative from The Blind Center will contact you soon.</strong><br><br></td>
</tr>
<tr>
	<td align="center" class="bodyBlack"><br><strong>You will be redirected to the Home Page automatically.<br>If this page remains longer than 10 seconds, <a href="" class="bodyBlack">Click Here</a><br>or select a new destination from the menu.</strong><br><br></td>
</tr>
<?
}
?>
</table>

<!-- END INCLUDE Reflections -->
