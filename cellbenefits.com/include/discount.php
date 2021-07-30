<!-- BEGIN Include discount.php -->

<?
if ($domain == "cellbenefits.com" || strtolower($uri[1]) == "cellbenefits"){
	$discount_label = "cellbenefits.com";
}elseif ($domain == "phonebenefits.com" || strtolower($uri[1]) == "phonebenefits"){
	$discount_label = "phonebenefits.com";
}elseif ($domain == "voicebenefits.com" || strtolower($uri[1]) == "voicebenefits"){
	$discount_label = "voicebenefits.com";
}elseif ($domain == "sprintemployeesite.com" || strtolower($uri[1]) == "sprintemployeesite"){
	$discount_label = "sprintemployeesite.com";
}elseif ($domain == "attemployeesite.com" || strtolower($uri[1]) == "attemployeesite"){
	$discount_label = "attemployeesite.com";
}elseif ($domain == "verizonemployeesite.com" || strtolower($uri[1]) == "verizonemployeesite"){
	$discount_label = "verizonemployeesite.com";
}
?>

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Service Discount</strong></td>
	<td><img src="images/spacer.gif" alt="" width="730" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="929" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
	<?
	if ($cingular_site == "T"){
	?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td>
				<?
				if ($cingular_discount > 0){
				?>
				<p><strong class="bigBlack"><u>Your <? echo round($cingular_discount); ?>% Service Discount</u></strong><br>
				This is the amount you will save on your rate plan's Monthly Service Charge. AT&T offers a variety of service discount structures. The amount of your service discount, and the charges to which it applies, are all subject to the arrangement between your company or organization and AT&T. Under some service discount structures, this discount may also be applied to other qualified charges as well. You should contact your management or the appropriate department within your company or organization responsible for wireless program administration with questions on the specific discount available to you. Service discount is available to you through your employer's or organization's qualified business agreement with AT&T. You must be a qualified employee/member or otherwise eligible to participate in your company's/organization's program in order to receive this benefit. NOTE: $99.99 Nation Plan and $199.99 Nation FamilyTalk Plans do not qualify for, and will not receive, any service or combined billing discount(s).</p> 
				<?
				}
				if ($activation_fee == 0){
				?>
				<p><strong class="bigBlack"><u>Waived Activation Fee</u></strong><br>
				Only available on "new" activations and rate plans higher than $39.99. ONLY eligible through <? echo $site.".".$discount_label; ?>.</p> 
				<?
				}
				if ($gift_card > 0){
				?>
				<p><strong class="bigBlack"><u>$<? echo $gift_card; ?> Visa Gift Card</u></strong><br>
				$<? echo $gift_card; ?> Visa Check card at checkout. You can receive up to a $<? echo $gift_card; ?> Visa check card after 30 days of service  when you place a qualified order through this online portal (<? echo $site.".".$discount_label; ?>). Visa card available only to customers activating new Equipment on a qualified plan with a Monthly Service Charge of $39.99 or higher. Credit is applied after any other available discounts and does not apply to service charges, activation fees, taxes or other fees. Offer not available on any upgrades, any accessory-only orders, or any orders that include Apple iPhone or iPhone related accessories.</p> 
				<?
				}
				?>
				<br>
			</td>
		</tr>
		</table>
			<?
			}elseif ($sprint_site == "T" || $nextel_site == "T" ){
			?>
		<br>
		<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td style="vertical-align: text-top;"> <!--<u title="...or dial *2 from your Sprint or Nextel Phone" class="double"><span style="text-decoration:underline;_text-decoration:none;_border-bottom:3px double;">-->
<!--				<strong class="bigBlack">Please call Sprint Customer Care at <span title="...or dial *2 from your Sprint or Nextel Phone" class="zog">888.211.4727</span> to have your <? echo round($sprint_discount); ?>% company discount applied to your existing Sprint or Nextel service.</strong><br><br>-->
				<span class="bigBlack">Please call Sprint Customer Care at <strong>888.211.4727</strong> or dial <strong>*2</strong> from your Sprint or Nextel phone to have your <? echo round($sprint_discount); ?>% company or membership discount applied to your existing Sprint or Nextel service.</span><br><br>
				<img src="images/spacer.gif" alt="" width="15" height="1" border="0">Please note the following important information:
				<ul>
					<li>Up to 5 lines on your Sprint Nextel account qualify for company or member discounts.<br></li><br>
					<li>The name on the account must be that of the employee/member. If you would like to change the name on the account so that you can qualify for the discounts, please call 1-888-788-4727 or dial *2 from your Sprint phone. Be prepared to provide verfication of your employment or membership (paystub, company email address, employee ID, etc.) and to have your credit run to establish the account in the new name.<br></li><br>
					<li>Your existing account must be in 'good standing' (no outstanding unpaid bills) in order to qualify for adding these discounts.<br></li><br>
					<li>The discounts may take 1 to 2 billing cycles to be applied to your account and will not be prorated.<br></li><br>
					<li>The discounts policy states that they can be applied to "friends and family" as well as the employee/member. This is true as long as the friends or family members have phone numbers on the account that is in the employee's/member's name.<br></li><br>
					<li>You will need to provide a company related email address to verify your employment/membership. If you do not have a company related email address, you may be asked to fax something in to verify your employment or membership such as employee pay stub or employee ID card.<br></li><br>
					<li>To ensure the correct discount is applied, please use the name of the company on the website you entered through. If you are an affiliate or a dealer, do not use your personal company name, please use the parent company name.<br></li><br>
					<li>You may also call Sprint Customer Care to check the status of your discount request, at 888.211.4727 or by dialing *2 from your Sprint phone.<br></li><br>
				</ul>
			</td>
		</tr>
		</table>
			<?
			}
			?>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include discount.php -->

