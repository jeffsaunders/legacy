
<!-- BEGIN Include contact.php -->

	<!-- Form Validation Scripts -->
	<script src="js/FormValidation.js" type="text/javascript"></script>
	
	<div id="MiddleSectionContainer" style="position:relative; top:10px; left:0px; width:1000px; background-color:#FFFFFF; z-index:1;">
 		<!-- Right Column -->
		<div id="RightColumnContainer" style="position:relative; top:-15px; width:750px; background-color:#FFFFFF; float:right; display:block; z-index:2;">
			<div id="Breadcrumbs" style="position:relative; top:15px; left:5px; width:740px; z-index:2;">
				<strong class="bodyBlack">Contact Us</strong>
				<hr width="100%" size="1">
			</div>
			<div id="ContactUs" style="position:relative; top:15px; left:20px; width:710px; z-index:2;">
				<div align="center" class="bigBlue"><p><strong>Contact Us</strong></p></div>

				<p>Thank you for your interest in DCM Clean Air Products, Inc.  Please contact us by:</p>
				
				<ul>
				<form action="/sendform.php" method="POST" name="contactForm" id="contactForm" onSubmit="return validateContact(this);">
				<table border="0" cellspacing="10" cellpadding="0">
				<tr>
					<td>Phone:</td>
					<td><strong>800.624.4518</strong></td>
				</tr>
				<tr>
					<td valign="top">Mail:</td>
					<td><strong>9605 Camp Bowie West<br>Ft. Worth, Texas 76116</strong></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><strong>Complete and submit this form:</strong></td>
				</tr>
				</table>

				<input type="hidden" name="request_type" id="request_type" value="Contact">
				<table border="0" cellspacing="10" cellpadding="0">
				<tr>
					<td>Company Name:</td>
					<td>
						<input type="text" name="company" id="company" size="50" maxlength="100" value="" style="width:500px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company name." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td colspan="2">
						Are you a branch of the government?
						<input type="radio" id="government" name="government" value="Yes"><strong>Yes</strong>&nbsp;&nbsp;
						<input type="radio" id="government" name="government" value="No" checked><strong>No</strong>&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please indicate whether or not your company is a branch of the government." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Your First Name:</td>
					<td>
						<input type="text" name="first_name" id="first_name" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your first name." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
						<input type="text" name="last_name" id="last_name" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your last name." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Address:</td>
					<td>
						<input type="text" name="address" id="address" size="50" maxlength="100" value="" style="width:500px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company's street or mailing address." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>City:</td>
					<td>
						<input type="text" name="city" id="city" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company's city." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>State:</td>
					<td>
						<input type="text" name="state" id="state" size="10" maxlength="100" value="" style="width:100px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company's state." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Zip Code:</td>
					<td>
						<input type="text" name="zipcode" id="zipcode" size="10" maxlength="100" value="" style="width:100px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company's zip code." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Phone:</td>
					<td>
						<input type="text" name="phone" id="phone" size="10" maxlength="100" value="" style="width:100px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your contact phone number." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Fax:</td>
					<td>
						<input type="text" name="fax" id="fax" size="10" maxlength="100" value="" style="width:100px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your company's fax number." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Email:</td>
					<td>
						<input type="text" name="email" id="email" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your contact email address." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td>Best Time to Call:</td>
					<td>
						<input type="text" name="besttime" id="besttime" size="25" maxlength="100" value="" style="width:250px;">&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter the best time of the day to be reached." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td valign="top">Specific Need:</td>
					<td>
						<textarea cols="80" rows="3" name="message" id="message" style="width:500px;"></textarea>&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please enter your specific need or question." border="0" style="cursor:help;">
					</td>
				</tr>
				<tr>
					<td valign="top">Captcha Code:</td>
					<td>
						<?
						require_once('lib/recaptchalib.php');
						$publickey = "6LeaUscSAAAAAH8U2Lfr3OmbHKV6CYdhaH2-YPP6"; // This is dcmsanding.com's global key. Replace this with dcmcleanair.com's when site goes live
						echo recaptcha_get_html($publickey);
						?>
						<div style="position:relative; top:-20px; left:325px;">
							<img src="images/QuestionMark.gif" alt="?" title="Please enter the words you see in the captcha window." border="0" style="cursor:help;">
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
<!--						<input type="submit" name="Send" value="Send">-->
<!--						<img src="images/SubmitButton.gif" alt="Submit Form" width="125" height="30" border="0" style="cursor:pointer;" title="Click here to submit the form." onClick="document.forms['contactForm'].submit();">-->
						<img src="images/SubmitButton.gif" alt="Submit Form" width="125" height="30" border="0" style="cursor:pointer;" title="Click here to submit the form." onClick="return validateContact(document.forms['contactForm']);">
					</td>
				</tr>
				</table>
				</form>
				</ul>
			</div>
			<br>
		</div>
		<!-- Left Column -->
		<?
		include("include/leftcolumn.php");
 		?>
	</div>

<!-- END Include contact.php -->

