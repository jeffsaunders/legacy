<?php
// Get passed value and pull it apart
$id = explode("=", $_REQUEST["id"]);

// Now put back any stripped out plus signs (RFC 2396)
$encryptedID = str_replace(' ', '+', $id[0]) . "=";

// Deal with what's left
$userID = $id[count($id)-1];

// Decryption function
function decrypt($value, $key){
	if(!$value || !$key){
		return false;
	}
	$td = mcrypt_module_open('rijndael-256', '', 'ecb', '');
	$iv = mcrypt_create_iv(mcrypt_enc_get_iv_size( $td ), MCRYPT_RAND);
	mcrypt_generic_init($td, $key, $iv);
	$decryptedValue = mdecrypt_generic($td, base64_decode($value));
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	return $decryptedValue;
}

// Decrypt passed ID
$dataKey = base64_decode('1zvKhVe39VUe9HDtz3q1x2dqcoDDFEgW35VhIq2YmP0=');
$decryptedEmail = decrypt($encryptedID, $dataKey);

// Look up decrypted email address
$query = "
	SELECT first_name, confirm_date
	FROM members
	WHERE email = '".trim($decryptedEmail)."'
	AND member_id = '".$userID."'
";
$rs_member = mysql_query($query, $dbhandle);
if (mysql_num_rows($rs_member) == 0){
?>
<div align="center">
<br><br>
<h2>The Smart Women Buy Homes Marketing Kit for<br>Real Estate Professionals</h2>

<p>We're sorry, your exclusive private key was not found.</p>

</div>
<?php
}else{
	$member = mysql_fetch_assoc($rs_member);
	// Update record with confirmation they received the email and viewed the page
	if ($member["confirm_date"] == 0){
		$query = "
			UPDATE members
			SET	confirm_date = UNIX_TIMESTAMP()
			WHERE member_id = '".$userID."'
		";
		$rs_update = mysql_query($query, $dbhandle);
	}
?>

<br><br>
<h2>The Smart Women Buy Homes Marketing Kit for<br>Real Estate Professionals</h2>

<div class="video-bg">
	<p><iframe src="https://player.vimeo.com/video/61022162?autoplay=1;title=0&amp;byline=0&amp;portrait=0&amp;color=71587e" width="720" height="405" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></p>
</div><!--video-bg-->
<br>
<h2><?php echo $member['first_name']; ?>, here is what you will receive when you become a Smart Women Buy Homes Advisor:</h2>
<p><img src="images/swbh-marketing-package.jpg" width="960" height="2836" border="0" alt="Our Offer" /></p>
<!--
<p style="font-size:16px;">This complete, fully equipped marketing package comes to you along with outstanding support and the proven expertise of our founder and CEO, Jeanie Douthitt.</p>

<p style="font-size:16px;">All of this for the annual licensing fee of only $695.00.</p>
-->
<h2>This complete, fully equipped marketing package comes to you along with outstanding support and the proven expertise of our founder and CEO, Jeanie Douthitt.</h2>

<h2><strong>All of this for a one-time licensing fee of $<?php echo money_format("%i", $config['membership_price']); ?> with an annual renewal of only $<?php echo money_format("%i", $config['renewal_price']); ?>.</strong></h2>

<p style="text-align:center;margin-top:15px;"><a href="/secure.php?page=realtor-checkout&id=<?php echo $_REQUEST["id"]; ?>" class="button1">This Sounds Great! Sign Me Up Now!</a></p>
<br>
<p style="text-align:center;">
	<a href="/" class="button2">Not yet. I'm not ready for this opportunity.</a><br><br>
	*Remember, by clicking on your exclusive private link in your email you can revisit this information as often as you'd like!
</p>   

<div class="clear"></div><!-- End .clear -->

<?php
}
?>
          
