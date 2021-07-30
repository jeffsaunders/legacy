<?php
if (isset($_REQUEST['submit'])){ // They just hit the submit button
	// Do some word math
	$realtor_role = ($_REQUEST['realtor_role_other'] != '' ? $_REQUEST['realtor_role_other'] : $_REQUEST['realtor_role']);
	$realtor_referral = '';
	if (!empty($_REQUEST['referral'])){
		$realtor_referral = implode("|", $_REQUEST['referral']);
	}
	if (!empty($_REQUEST['referral_agent_name'])){
		if (!empty($_REQUEST['referral_other_detail'])){
			$realtor_referral = substr($realtor_referral, 0, -1); // Trim off the extra "|"
		}
		$realtor_referral .= ": ".$_REQUEST['referral_agent_name'];
	}
	if (!empty($_REQUEST['referral_other_detail'])){
		if (!empty($realtor_referral) && !empty($_REQUEST['referral_agent_name'])){
			$realtor_referral .= "|";
		}
		$realtor_referral .= "Other: ".$_REQUEST['referral_other_detail'];
	}

	// Write the record
	$query = "
		INSERT INTO members (
			first_name,
			last_name,
			company_name,
			address_1,
			address_2,
			city,
			state,
			zipcode,
			phone,
			email,
			website,
			role,
			referral,
			apply_date)
		VALUES (
			'".addslashes($_REQUEST['realtor_first_name'])."',
			'".addslashes($_REQUEST['realtor_last_name'])."',
			'".addslashes($_REQUEST['realtor_company_name'])."',
			'".addslashes($_REQUEST['realtor_address_1'])."',
			'".addslashes($_REQUEST['realtor_address_2'])."',
			'".addslashes($_REQUEST['realtor_city'])."',
			'".$_REQUEST['realtor_state']."',
			'".$_REQUEST['realtor_zip_code']."',
			'".$_REQUEST['realtor_phone']."',
			'".$_REQUEST['realtor_email']."',
			'".$_REQUEST['realtor_website']."',
			'".addslashes($realtor_role)."',
			'".addslashes($realtor_referral)."',
			UNIX_TIMESTAMP())
		";
	//die($query);
	$result = mysql_query($query, $dbhandle);
	$member_id = mysql_insert_id();

	// Send the verification email

	// Encrypt function
	function encrypt($value, $key){
		if(!$value || !$key){
			return false;
		}
		$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
		$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
		mcrypt_generic_init($td, $key, $iv);
		$encryptedValue = mcrypt_generic($td, $value);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		return base64_encode( $encryptedValue );
	}

	// Encrypt email address and pass it as the ID value
	$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');
	$id = encrypt($_REQUEST['realtor_email'], $dataKey);
	$id .= $member_id;
	
	// build the email
	$to = $_REQUEST['realtor_email'];
//	$to = 'jeff.saunders@ewomennetwork.net'; //Testing
//	$to = 'kym.yancey@ewomennetwork.net'; //Testing
	$subject = $_REQUEST['realtor_first_name'].', Here Is Your Smart Women Buy Homes Advisor Program Information Request';
	$message = '
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title></title>
<html>
<body bgcolor="#F6F6F6">
<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td>
		<table cellspacing="0" cellpadding="0" border="0" bgcolor="#FFFFFF">
		<tr>
			<td width="700" height="2" bgcolor="#F35C23"></td>
		</tr>
		<tr>
			<td width="700" align="center" bgcolor="#FFFFFF"><img src="http://smartwomenbuyhomes.com/images/header.jpg" alt="Smart Women Buy Homes" width="680" border="0"></td>
		</tr>
		<tr>
			<td style="padding:0px 10px 16px 10px;">

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;"><strong>Hello '.$_REQUEST['realtor_first_name'].':</strong></p>

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;">Thank you so much for your interest in Smart Women Buy Homes. Please <a href="https://www.smartwomenbuyhomes.com/secure.php?page=realtor-marketing-kit&id='.$id.'">Click Here</a> to access important information about how our exclusive Smart Women Buy Homes Advisor Program can help you bring the joy of homeownership to single women and expand your real estate practice.</p>

				<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:18px; color:#272727;">This link is your exclusive private key to access this information at any time, so please keep it safe and keep it handy.</p>

			</td>
		</tr>
		<tr>
			<td bgcolor="#F35C23" width="700">
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr>
					<td style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#FFFFFF; text-align:center;">
						Copyright &copy; '.date('Y').' Smart Women Buy Homes. All rights reserved.
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>
	';
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: Smart Women Buy Homes <Jeanie.Douthitt@gmail.com>' . "\r\n";
//	$headers .= 'Bcc: jeanie.douthitt@gmail.com' . "\r\n";
//	$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing

	// Mail it
	mail($to, $subject, $message, $headers);

	// Now send email containing the form data to Jeanie
	$to = 'jeanie.douthitt@gmail.com';
//	$to = 'jeff.saunders@ewomennetwork.net'; //Testing
//	$to = 'kym.yancey@ewomennetwork.net'; //Testing
	$subject = 'Smart Women Buy Homes Information Request';
	$message = '
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
<title></title>
<html>
<body>
<table style="font-family:Arial, Helvetica, sans-serif;">
<tr>
	<td colspan="2">The following information request was received at <strong>'.date('g:h a', time()).' on '.date('n/j/y', time()).'</strong>:<br><br></td>
</tr>
<tr>
	<td valign="top">Name:</td>
	<td><strong>'.$_REQUEST['realtor_first_name'].' '.$_REQUEST['realtor_last_name'].'</strong></td>
</tr>
<tr>
	<td valign="top">Company:</td>
	<td><strong>'.$_REQUEST['realtor_company_name'].'</strong></td>
</tr>
<tr>
	<td valign="top">Address:</td>
	<td>
		<strong>
		'.$_REQUEST['realtor_address_1'].'<br>
		'.($_REQUEST['realtor_address_2'] != "" ? $_REQUEST['realtor_address_2']."<br>" : "").'
		'.$_REQUEST['realtor_city'].', '.$_REQUEST['realtor_state'].' '.$_REQUEST['realtor_zip_code'].'
		</strong>
	</td>
</tr>
<tr>
	<td valign="top">Phone:</td>
	<td><strong>'.$_REQUEST['realtor_phone'].'</strong></td>
</tr>
<tr>
	<td valign="top">Email:</td>
	<td><strong>'.$_REQUEST['realtor_email'].'</strong></td>
</tr>
<tr>
	<td valign="top">Website:</td>
	<td><strong>'.$_REQUEST['realtor_website'].'</strong></td>
</tr>
<tr>
	<td valign="top">Role:</td>
	<td><strong>'.$realtor_role.'</strong></td>
</tr>
<tr>
	<td valign="top">Referral(s):</td>
	<td><strong>'.str_replace('|', ', ', $realtor_referral).'</strong></td>
</tr>
</table>
</body>
</html>
	';
	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: Smart Women Buy Homes <Jeanie.Douthitt@gmail.com>' . "\r\n";
//	$headers .= 'Bcc: jeanie.douthitt@gmail.com' . "\r\n";
//	$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing

	// Mail it
	mail($to, $subject, $message, $headers);

	// Tell them thanks for the information request and that they should look for the email
?>
<br><br>
<!--<h2>Opportunity for Realtors</h2>-->

<h2>Thank you, <?php echo $_REQUEST['realtor_first_name']; ?>, for your interest in Smart Women Buy Homes!</h2>

<p>Shortly you will receive an email sent to the address you entered on the request form.  In it you will find your exclusive private link to access important information about how our Smart Women Buy Homes Advisor Program can help you bring the joy of homeownership to single women and expand your real estate practice.</p>

<p>If you don't see your email from us within 15 minutes, please check your Spam or Junk folder.<!-- You may also have it resent by clicking <a href="">here</a>.--></p>

<?php
}else{
?>
<br><br>
<h2>Opportunity for Realtors</h2>

<p>If you are a realtor&reg;, agent or broker who wants to bring the joy of homeownership to single women and expand your real estate practice, we invite you to complete our Request for Information form. We will be happy to share how our Smart Women Buy Homes Advisor Program can help you.</p>

<p>This is an exclusive program, available only to active real estate professionals</p>

<div id="realtor-signup">
	<h3>Realtor's Request to Review SWBH Licensee Marketing Program</h3>

	<!-- Form Validation Scripts -->
	<script src="/js/FormValidation.js" type="text/javascript"></script>

	<form action="" method="post" name="signupForm" id="signupForm" onSubmit="return validateSignup(this);">
	<div class="form-fields">
		<p>
			<label>First Name</label><br />
			<input class="text-input medium-input" type="text" id="realtor_first_name" name="realtor_first_name" />
		</p>
        
        <p>
            <label>Last Name</label><br />
            <input class="text-input medium-input" type="text" id="realtor_last_name" name="realtor_last_name" />
        </p>

		<p>
			<label>Company Name</label><br />
			<input class="text-input medium-input" type="text" id="realtor_company_name" name="realtor_company_name" />
		</p>

		<p id="realtor_role_question">
			<label>Check Your Role</label><br />
			<input class="radio-indent" type="radio" name="realtor_role" id="realtor_role0" value="I am a Broker" onClick="document.getElementById('realtor_role_other').value = '';" /> I am a Broker<br />
			<input class="radio-indent" type="radio" name="realtor_role" id="realtor_role1" value="I am a Broker/Agent" onClick="document.getElementById('realtor_role_other').value = '';" /> I am a Broker/Agent<br />
			<input class="radio-indent" type="radio" name="realtor_role" id="realtor_role2" value="I am an Agent" onClick="document.getElementById('realtor_role_other').value = '';" /> I am an Agent<br />
			<input class="radio-indent" type="radio" name="realtor_role" id="realtor_role3" value="I am a Realtor" onClick="document.getElementById('realtor_role_other').value = '';" /> I am a Realtor&reg;<br />
			<input class="radio-indent" type="radio" name="realtor_role" id="realtor_role4" value="Other" onClick="document.getElementById('realtor_role_other').focus();" /> I am none of the above, but I can explain:<br />
			<textarea class="text-input textarea ta-other" id="realtor_role_other" name="realtor_role_other" cols="30" rows="5" onInput="document.getElementById('realtor_role4').checked = true;"></textarea>
		</p>

		<p>
			<label>Address</label><br />
			<input class="text-input medium-input" type="text" id="realtor_address_1" name="realtor_address_1" style="margin:0px 0px 10px 0px;"><br>
			<input class="text-input medium-input" type="text" id="realtor_address_2" name="realtor_address_2">
		</p>

		<p>
			<label>City</label><br />
			<input class="text-input medium-input" type="text" id="realtor_city" name="realtor_city" />
		</p>

		<p>
			<label>State</label><br />
			<select name="realtor_state" id="realtor_state" class="select select-input">
				<option value="">Select ...</option>
				<option value="AL">Alabama</option>
				<option value="AK">Alaska</option>
				<option value="AZ">Arizona</option>
				<option value="AR">Arkansas</option>
				<option value="CA">California</option>
				<option value="CO">Colorado</option>
				<option value="CT">Connecticut</option>
				<option value="DE">Delaware</option>
				<option value="DC">District of Columbia</option>
				<option value="FL">Florida</option>
				<option value="GA">Georgia</option>
				<option value="HI">Hawaii</option>
				<option value="ID">Idaho</option>
				<option value="IL">Illinois</option>
				<option value="IN">Indiana</option>
				<option value="IA">Iowa</option>
				<option value="KS">Kansas</option>
				<option value="KY">Kentucky</option>
				<option value="LA">Louisiana</option>
				<option value="ME">Maine</option>
				<option value="MD">Maryland</option>
				<option value="MA">Massachusetts</option>
				<option value="MI">Michigan</option>
				<option value="MN">Minnesota</option>
				<option value="MS">Mississippi</option>
				<option value="MO">Missouri</option>
				<option value="MT">Montana</option>
				<option value="NE">Nebraska</option>
				<option value="NV">Nevada</option>
				<option value="NH">New Hampshire</option>
				<option value="NJ">New Jersey</option>
				<option value="NM">New Mexico</option>
				<option value="NY">New York</option>
				<option value="NC">North Carolina</option>
				<option value="ND">North Dakota</option>
				<option value="OH">Ohio</option>
				<option value="OK">Oklahoma</option>
				<option value="OR">Oregon</option>
				<option value="PA">Pennsylvania</option>
				<option value="RI">Rhode Island</option>
				<option value="SC">South Carolina</option>
				<option value="SD">South Dakota</option>
				<option value="TN">Tennessee</option>
				<option value="TX">Texas</option>
				<option value="UT">Utah</option>
				<option value="VT">Vermont</option>
				<option value="VA">Virginia</option>
				<option value="WA">Washington</option>
				<option value="WV">West Virginia</option>
				<option value="WI">Wisconsin</option>
				<option value="WY">Wyoming</option>
			</select>
		</p>

		<p>
			<label>Zip Code</label><br />
			<input class="text-input medium-input" type="text" id="realtor_zip_code" name="realtor_zip_code" />
		</p>

		<p>
			<label>Most Direct Phone Number</label><br />
			<input class="text-input medium-input" type="text" id="realtor_phone" name="realtor_phone" onKeyPress="return onlyNumbers(event);" onBlur="return formatPhone(this);" />
		</p>
			
		<p>
			<label>Email</label><br />
			<input class="text-input medium-input" type="text" id="realtor_email" name="realtor_email" onBlur="return trimIt(this);" />
		</p>
			
		<p>
			<label>Confirm Email</label><br />
			<input class="text-input medium-input" type="text" id="realtor_email_confirm" name="realtor_email_confirm" onBlur="return trimIt(this);" />
		</p>
			
		<p>
			<label>Website Address</label><br />
			<input class="text-input medium-input" type="text" id="realtor_website" name="realtor_website" />
		</p>
			
		<p id="referral_question">
			<label>How did you hear about us? (check all that apply)</label><br />
			<input type="checkbox" name="referral[]" id="referral[0]" value="Website" class="check-indent"> Website<br />
			<input type="checkbox" name="referral[]" id="referral[1]" value="Women's Network TV" class="check-indent"> Women's Network TV<br />
			<input type="checkbox" name="referral[]" id="referral[2]" value="Women's Network Radio" class="check-indent"> Women's Network Radio<br />
			<input type="checkbox" name="referral[]" id="referral[3]" value="Real Estate Agent" class="check-indent"> Real Estate Agent (Enter Name):<br />
			<textarea cols="30" rows="1" name="referral_agent_name" id="referral_agent_name" class="text-input textarea ta-other"></textarea><br />
			<input type="checkbox" name="referral[]" id="referral[4]" value="" class="check-indent"> Other (Please Explain):<br />
			<textarea cols="30" rows="5" name="referral_other_detail" id="referral_other_detail" class="text-input textarea ta-other"></textarea>
		</p>

		<h3 style="margin-bottom:0px;">Required:</h3>
		<p>
			<table id="confirmation_question">
			<tr>
				<td width="20" valign="top"><input type="checkbox" name="confirmation" value="Y" /></td>
				<td>I certify that I am an active, licensed real estate professional.</td>
			</tr>
			<tr>
				<td colspan="2" class="finePrint">
					<strong>Note:</strong> Only active, licensed real estate professionals are granted access to review the Smart Women Buy Homes Marketing Kit and materials via this website. If you are not an active, licensed real estate professional, you are not granted permission to review the Smart Women Buy Homes materials. If you have checked this box claiming to be a certified, active licensed real estate professional, and you are not, please do not proceed.
				</td>
			</tr>
			</table>
		</p>

		<p>
			<input class="button" type="submit" value="submit" name="submit" id="submit" />
		</p>

	</div><!--form-fields-->    
	<div class="clear"></div><!-- End .clear -->
	</form>
</div><!--realtor-signup-->
<?php
}
?>
