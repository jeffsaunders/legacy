<!-- BEGIN Include contact.php -->

<div id="contactUs">
	<div id="contactHeadline">Contact Us</div>
	<div id="contactText">
		<!-- Form Validation Scripts -->
		<script src="js/FormValidation.js" type="text/javascript"></script>

		<form action="/sendform.php" method="POST" name="contactForm" id="contactForm" onSubmit="return validateContact(this);">
		<table width="750" border="0" cellspacing="10" cellpadding="5">
		<tr>
			<td colspan="2">Thank you for your interest in Prayer Belts.  Complete and submit this form:</td>
		</tr>
<!--		<tr>
			<td width="150" align="right" bgcolor="#E8E8E8"><strong>Email:</strong></td>
			<td><strong>Complete and submit this form:</strong></td>
		</tr>-->
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Name:</strong></td>
			<td>
				<input type="text" name="name" id="name" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your name." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Email:</strong></td>
			<td>
				<input type="text" name="email" id="email" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your email address." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Email Again:</strong></td>
			<td>
				<input type="text" name="email2" id="email2" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your email address again for verification." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" bgcolor="#E8E8E8"><strong>Message:</strong></td>
			<td>
				<textarea cols="80" rows="5" name="message" id="message" style="width:250px;"></textarea>&nbsp;&nbsp;
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your specific need, question, or comment." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" valign="top" bgcolor="#E8E8E8"><strong>Mail:</strong></td>
			<td>
				<strong>Prayer Belts, Inc.<br>
				5100 Eldorado Parkway, Suite 102<br>
				#903<br>
				McKinney, Texas 75070</strong></td>
		</tr>
<!--		<tr>
			<td valign="top">Captcha Code:</td>
			<td>
				<?
				//require_once('lib/recaptchalib.php');
				//$publickey = "6LeaUscSAAAAAH8U2Lfr3OmbHKV6CYdhaH2-YPP6"; // Replace with site specific key
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
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<div id="contactImage"></div>

<!-- END Include contact.php -->
