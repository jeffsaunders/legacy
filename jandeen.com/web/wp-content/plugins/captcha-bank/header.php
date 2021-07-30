<?php
$display_banner = get_option("captcha-bank-banner");
if($display_banner == "")
{
	echo'<div id="buy_captcha_pro" class="updated" style="margin:10px 2px 10px 0;">
	 		<div class="captcha_bank_buy_pro">
		 		<div class="captcha_bank_text_control">
			 		It\'s time to upgrade your <strong>Captcha Bank Standard Edition</strong> to <strong>Premium</strong> Edition!<br />
			 		<span>Extend standard plugin functionality with awesome features! <br/>Go for Premium Version Now! Starting at <strong>7£/- only</strong></span>
		 		</div>
		 		<a class="button captcha_bank_message_buttons" href="admin.php?page=captcha_bank_setting&banner=no">CLOSE</a>
		 		<a class="button captcha_bank_message_buttons" target="_blank" href="http://wordpress.org/support/view/plugin-reviews/captcha-bank?filter=5">RATE US 5 ★</a>
		 		<a class="button captcha_bank_message_buttons" target="_blank" href="http://tech-banker.com/captcha-bank/demo/">LIVE DEMO</a>
		 		<a class="button captcha_bank_message_buttons" target="_blank" href="http://tech-banker.com/captcha-bank/">UPGRADE NOW</a>
	 		</div>
	 	</div>';
}
?>
<h2 class="nav-tab-wrapper">
	<a class="nav-tab " id="captcha_bank_setting" href="admin.php?page=captcha_bank_setting"><?php _e("Captcha Bank Settings", captcha_bank);?></a>
	<a class="nav-tab " id="captcha_bank_buy_pro" href="admin.php?page=captcha_bank_buy_pro"><?php _e("Captcha Bank Pricing", captcha_bank);?></a>
	<a class="nav-tab " id="captcha_bank_documentation" href="admin.php?page=captcha_bank_documentation"><?php _e("Captcha Bank - Documentation", captcha_bank);?></a>
</h2>
<script>
jQuery(document).ready(function()
{
	jQuery(".nav-tab-wrapper > a#<?php echo $_REQUEST["page"];?>").addClass("nav-tab-active");
});
</script>