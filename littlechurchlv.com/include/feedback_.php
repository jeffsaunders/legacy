<!-- BEGIN INCLUDE Feedback -->

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">




<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Main Body -->
	<td valign="top" class="bodyBlack">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td colspan="3" class="bigBlack">
				<!-- Image -->
				<table width="279" border="0" cellspacing="0" cellpadding="0" align="right">
				<tr>
					<!-- Chapel Front -->
<!--					<td align="right"><img src="images/Feedback.jpg" alt="" width="300" height="200" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>-->
					<td align="right"><img src="images/Feedback2.jpg" alt="" width="239" height="300" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
				</tr>
				</table>
				<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
				<!-- Text -->
				<strong class="xbigBlack">We Welcome Your Comments<br>
				<em class="bodyBlack"><img src="images/spacer.gif" alt="" width="30" height="1" border="0">
				Especially Testimonials!</em></strong><br><br>
				<p>
				<ul>
				<strong>We want to hear from you!<br><br>
				Please use this form to send us feedback about your wedding experience at The Little Church of the West.<br><br>
				Of course, testimonials are most welcome, but we'd like to hear any complaints, comments, or other concerns you may have as well ... after all, how can we improve our service otherwise?</strong>
				</ul>
				</p>
				<br>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
			<td>

			<script>
			function validateFeedback(theForm){
			// Name
				if (theForm.name.value == ""){
					theForm.name.style.background="#FF0000";
					alert("Please Enter Your Name");
					theForm.name.style.background="#ECEADC";
					theForm.name.focus();
					return false;
				}
			// Email
				if (theForm.email.value == ""){
					theForm.email.style.background="#FF0000";
					alert("Please Enter Your Email Address");
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for "@"
		 		if (theForm.email.value.indexOf("@") == -1) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Contain an "@"');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for "@" as first char.
		 		if (theForm.email.value.indexOf("@") == 0) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Cannot Start With a "@"');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for anything after "@"
		 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Contain a Domain Name After the "@"');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for multiple "@"
		 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Contain Only One "@"');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for "."
		 		if (theForm.email.value.indexOf(".") == -1) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Contain a "."');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for "." as first char.
		 		if (theForm.email.value.indexOf(".") == 0) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Cannot Start With a "."');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for ".."
		 		if (theForm.email.value.indexOf("..") != -1) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Not Contain Adjacent Dots ("..")');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for "." adjacent to "@"
		 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for TLD
		 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for TLD at least 2 char.
				var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
				if (domain.length - (domain.indexOf(".")+1) < 2) {
					theForm.email.style.background="#FF0000";
					alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for TLD over 3 char.
//				if (domain.length - (domain.indexOf(".")+1) > 3) {
//					theForm.email.style.background="#FF0000";
//					alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//					theForm.email.focus();
//					return false;
//				}
				// Check for "_" in TLD
				if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
					theForm.email.style.background="#FF0000";
					alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for spaces
		 		if (theForm.email.value.indexOf(" ") != -1) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Not Contain Any Spaces (" ")');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
				// Check for illegal char.
				var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
		 		if (email_regex.test(theForm.email.value) == false) { 
					theForm.email.style.background="#FF0000";
					alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
					theForm.email.style.background="#ECEADC";
					theForm.email.focus();
					return false;
				}
			// Purpose/Type
				if (theForm.type.value == ""){
					theForm.type.style.background="#FF0000";
					alert("Please Select a Purpose");
					theForm.type.style.background="#ECEADC";
					theForm.type.focus();
					return false;
				}
			// Subject
				if (theForm.subject.value == ""){
					theForm.subject.style.background="#FFFF00";
					leaveBlank = confirm("Are You Sure You Want To Send An Email Without A Subject?");
					theForm.subject.style.background="#ECEADC";
					theForm.subject.focus();
					if (!leaveBlank) return false;
				}
			// Message
				if (theForm.message.value == ""){
					theForm.message.style.background="#FFFF00";
					leaveBlank = confirm("Are You Sure You Want To Send An Empty Email?");
					theForm.message.style.background="#ECEADC";
					theForm.message.focus();
					if (!leaveBlank) return false;
				}
				return true;
			}
			</script>

			<?
			if ($task == "submit"){
				// Assign values
//				ini_set("SMTP","localhost" ); 
//				ini_set('sendmail_from', 'info@littlechurchlv.com');
//$to = 'jeff@nr.net'; //Testing
				$to = 'info@littlechurchlv.com';
				$from = $_REQUEST['email'];
				$name = addcslashes($_REQUEST['name'], '&');
				$type = $_REQUEST['type'];
				$subject = $_REQUEST['subject'];

				// Build message
				$message = "<table border='0' cellspacing='0' cellpadding='0'><font face='sans-serif'>";
				$message .= "<tr><td><font face='sans-serif'><strong>From:</strong></font></td><td><font face='sans-serif'>&nbsp;".$name."</font></td></tr>";
				$message .= "<tr><td><font face='sans-serif'><strong>Email:</strong></font></td><td><font face='sans-serif'>&nbsp;".$from."</font></td></tr>";
				$message .= "<tr><td><font face='sans-serif'><strong>Type:</strong></font></td><td><font face='sans-serif'>&nbsp;".$type."</font></td></tr>";
				$message .= "</table><br>";
				$message .= "<strong>Message:</strong>"."<br>";
				$message .= addcslashes($_REQUEST['message'], '&')."</font>";

				// Build additional headers
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "From: ".$name." (".$type.") <".$from.">\r\n";
				if ($_REQUEST['email_cc'] != "") $headers .= "Cc: ".$from.""."\r\n";
$headers .= "Bcc: lcotw_test@nr.net"."\r\n";  //Testing

				// Save it to database
				if ($_REQUEST['email_cc'] != ""){
					$copy = "T";
				}else{
					$copy = "F";
				}
				$query =
					"INSERT INTO inquiries (
					name,
					email,
					copy,
					purpose,
					subject,
					message,
					timestamp)
					VALUES (
					'".$_REQUEST['name']."',
					'".$_REQUEST['email']."',
					'".$copy."',
					'".$_REQUEST['type']."',
					'".$_REQUEST['subject']."',
					'".addcslashes($_REQUEST['message'], '&')."',
					NOW())";
//echo $query.'<br></br>';
				$result = mysql_query($query, $linkID);

				// Send it off
				mail($to, $subject, stripslashes($message), $headers);

				// Tell 'em "thanks"
				echo'
					<div align="center">
						<br><br><br><br><br>
						<p><strong class="bigBlack">Your Message Has Been Sent.</strong></p>
						<p><strong class="xbigBlack">Thank You!</strong></p>
						<br><br><br><br><br>
					</div>
				';
			}else{
			?>
				<br>
				<form action="" method="post" name="contact" id="contact" onSubmit="return validateFeedback(this);">
				<table width="750" border="0" cellspacing="5" cellpadding="0" class="bigBlack">
				<tr>
					<td width="125" align="right"><strong><nobr>Your Name:</nobr></strong></td>
					<td width="250"><input type="text" name="name" size="28" maxlength="50" class="bigBlack" style="background-color:#ECEADC;" tabindex="1"></td>
					<td width="125" align="right"><strong>Your Email:</strong></td>
					<td width="250"><input type="text" name="email" size="28" maxlength="50" class="bigBlack" style="background-color:#ECEADC;" tabindex="2"></td>
				</tr>
				<tr>
					<td align="right"><strong>Purpose:</strong></td>
					<td>
						<select name="type" id="type" class="bigBlack" style="background-color:#ECEADC; width:238px;" tabindex="3">
							<option value="">Choose</option>
							<option value="Testimonial">Testimonial</option>
<!--							<option value="Information">Information</option>
							<option value="Inquiry">Inquiry</option>-->
							<option value="Comment">Comment</option>
							<option value="Complaint">Complaint</option>
							<option value="Other">Other</option>
						</select>
					</td>
					<td colspan="2"><img src="images/spacer.gif" alt="" width="30" height="1" border="0"><strong>Check to send a copy to yourself?</strong> <input type="checkbox" name="email_cc" value="No" tabindex="4"></td>
				</tr>
				<tr>
					<td align="right"><strong>Subject:</strong></td>
					<td colspan="3"><input type="text" name="subject" size="97" maxlength="50" style="background-color:#ECEADC;" tabindex="5"></td>
				</tr>
				<tr>
					<td valign="top" align="right"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br><strong>Message:</strong></td>
					<td colspan="3"><textarea cols="<?=iif(stristr($navigator_user_agent, "safari"), "73", "85");?>" rows="10" name="message" class="bigBlack" style="background-color:#ECEADC;" tabindex="6"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="3" align="center"><input type="submit" name="submit" value="Send" tabindex="10"></td>
				</tr>
<!--				<input type="hidden" name="sec" value="contact">
				<input type="hidden" name="cargo" value="submit">-->
				<input type="hidden" name="task" value="submit">
				</table>
				</form>
			<?
			}
			?>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<script>
	contact.name.focus();
</script>

<!-- END INCLUDE Feedback -->

