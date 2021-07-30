
<!-- BEGIN Include contact.php -->

	<div id="MiddleSectionContainer" style="position:relative; top:10px; left:0px; width:1000px; background-color:#FFFFFF; z-index:1;">
 		<!-- Right Column -->
		<div id="RightColumnContainer" style="position:relative; top:-15px; width:750px; background-color:#FFFFFF; float:right; display:block; z-index:2;">
			<div id="Breadcrumbs" style="position:relative; top:15px; left:5px; width:740px; z-index:2;">
				<strong class="bodyBlack">Contact Us</strong>
				<hr width="100%" size="1">
			</div>
			<div id="ContactUs" style="position:relative; top:15px; left:20px; width:710px; z-index:2;">
				<div align="center" class="bigBlue"><p><strong>Contact Us</strong></p></div>
				
				<p><font color="#FF0000">Form building in progress.</font></p>

				<p>Thank you for your interest in DCM Clean Air Products, Inc.  Please contact us by:</p>
				
				<ul>
				<form action="" method="post" name="contactForm" id="contactForm">
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
						<input type="radio" id="government" name="government" value="No"><strong>No</strong>&nbsp;&nbsp;
						<img src="images/QuestionMark.gif" alt="?" title="Please indicate whether or not your company is a branch of the govnerment." border="0" style="cursor:help;">
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
						$publickey = "6Ld9hsYSAAAAAKaGlGqSTBJXIAYBQmZiWcvepJi3"; // This is purplepeak.com's global key. Replace this with DCM's when site goes live
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
						<img src="images/SubmitButton.gif" alt="Submit Form" width="125" height="30" border="0" style="cursor:pointer;" title="Click here to submit the form." onClick="document.forms['contactForm'].submit();">
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

