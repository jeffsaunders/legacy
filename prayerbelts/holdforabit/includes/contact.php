<!-- BEGIN Include contact.php -->

<div id="aboutBar">
	<img src="images/secondbar.gif">
</div>

<div id="contactUs">
	<div id="contactHeadline">Contact Us</div>
	<div id="contactText">
		<!-- Form Validation Scripts -->
		<script src="js/FormValidation.js" type="text/javascript"></script>

		<form action="/sendform.php" method="POST" name="contactForm" id="contactForm" onSubmit="return validateContact(this);">
		<table width="650" border="0" cellspacing="10" cellpadding="0">
		<tr>
			<td colspan="2">Thank you for your interest in Prayer Belts.  Please contact us by:</td>
		</tr>
		<tr>
			<td valign="top">Mail:</td>
			<td>
				<strong>Prayer Belts, Inc.<br>
				5100 Eldorado Parkway, Suite 102<br>
				#903<br>
				McKinney, Texas 75070</strong></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><strong>Complete and submit this form:</strong></td>
		</tr>
		<tr>
			<td>Your Name:</td>
			<td>
				<input type="text" name="name" id="name" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your name." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td>
				<input type="text" name="email" id="email" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your email address." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top">Message:</td>
			<td>
				<textarea cols="80" rows="5" name="message" id="message" style="width:500px;"></textarea>&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your specific need, question, or comment." border="0" style="cursor:help;">
			</td>
		</tr>
<!--		<tr>
			<td valign="top">Captcha Code:</td>
			<td>
				<?
				//require_once('lib/recaptchalib.php');
				//$publickey = "6LeaUscSAAAAAH8U2Lfr3OmbHKV6CYdhaH2-YPP6"; // This is dcmsanding.com's global key. Replace this with dcmcleanair.com's when site goes live
				//echo recaptcha_get_html($publickey);
				?>
				<div style="position:relative; top:-20px; left:325px;">
					<img src="images/QuestionMark.gif" alt="?" title="Please enter the words you see in the captcha window." border="0" style="cursor:help;">
				</div>
			</td>
		</tr>-->
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="Action" value="Submit Form">
<!--						<img src="images/SubmitButton.gif" alt="Submit Form" width="125" height="30" border="0" style="cursor:pointer;" title="Click here to submit the form." onClick="document.forms['contactForm'].submit();">-->
<!--				<img src="images/SubmitButton.gif" alt="Submit Form" width="125" height="30" border="0" style="cursor:pointer;" title="Click here to submit the form." onClick="return validateContact(document.forms['contactForm']);">-->
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<div id="contactImage"></div>

<!-- END Include contact.php -->
