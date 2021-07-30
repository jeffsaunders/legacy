<!-- BEGIN Include faq.php -->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
<tr>
	<td valign="top">
		<table width="710" border="0" cellspacing="0" cellpadding="0" align="left" bgcolor="#FFFFFF">
		<tr>
			<td><img src="images/FAQHeader.jpg" alt="" width="710" height="25" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" background="images/InfoBG.jpg" style="background-position:top; background-repeat:repeat-y;">
				<img src="images/spacer.gif" alt="" width="1" height="10" border=""><br>
				<table width="690" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
				<tr>
					<td>
						<strong class="bodyBlack">Do I qualify for these offers if I am an existing customer with <? echo $carrier_label; ?>?</strong>
						<ul>
							<li>These programs require new service on a voice plan $39.99 or higher for all mail-in rebates on basic phones. Mail-in rebates are only eligible for data devices (PDAs, Smart Phones, BlackBerrys, Treos) if you activate on a $39.99 or higher voice plan and an unlimited data plan per your device. If you are a current customer, this offer will be valid if you activate a new primary number account that is not under an existing account. Mail-in rebates are not valid if you are adding lines to a Family Plan, renewing your service, or upgrading or adding services to your existing account.</li>
						</ul>
		
						<strong class="bodyBlack">What's the "catch", why are these prices so good?</strong>
						<ul>
							<li>These prices reflect all available promotions & rebates and are valid only with a 2-year activation of a NEW non-substitute line of service with <? echo $carrier_label; ?>.  They require you to maintain this new line of service with the selected rate plan in good standing for a minimum of 181 consecutive days. Additional service fees may apply.</li>
						</ul>

						<strong class="bodyBlack">Can I keep my existing cell phone number?</strong>
						<ul>
							<li>If you already have service with <? echo $carrier_label; ?> and you want to have your new service activated with <? echo $carrier_label; ?>, then you will have to activate new service and receive a new phone number. If you are switching wireless carriers, then yes, due to number portability laws, all cellular carriers are required to transfer your number to the carrier of your choice.</li>
						</ul>
		
						<strong class="bodyBlack">I am a current <? echo $carrier_label; ?> subscriber and want to upgrade my phone.  What should I do?</strong>
						<ul>
							<li>Please visit your local <? echo $carrier_label; ?> retailer.</li>
						</ul>
		
						<strong class="bodyBlack">Are there any penalties for canceling my new service with <? echo $carrier_label; ?>?</strong>
						<ul>
							<li>All activations will require a two-year agreement with <? echo $carrier_label; ?>, failure to keep your service activated for this term will result in a deactivation fee from <? echo $carrier_label; ?> in the amount of <? echo iif($sprint_site == "T" || $nextel_site == "T", "up to $200", "$175") ?> per activated device. You will have 30 days to cancel your service without having to pay these fees. You will still be responsible for paying the $<? echo money_format('%-2n', $activation_fee); ?> activation fee and any usage of service.</li>
						</ul>
		
						<strong class="bodyBlack">I have been told that I need to <? echo iif($cingular_site == 'T', '"Migrate" or ', '') ?>"Upgrade" my account, what does that mean?</strong>
						<ul>
		<? if ($cingular_site == "T"){ ?>
							<li><strong>Migrations: </strong>
							The wireless service providers define a migration as a customer moving their service from TDMA to GSM. TDMA is an older technology that is rarely used anymore and customer's are being forced to move to the newer digital service, which is GSM. The important thing to realize is that your service remains with the same wireless service provider and is not treated as a new activation, therefore we do not receive commissions and are unable to discount your new device. Please contact <? echo $carrier_label; ?> directly if you need to migrate your service from TDMA to GSM and they will provide you a discount on your new equipment.<br></li><br>
		
							<li><strong>Upgrades: </strong>
		<? } ?>
							<? echo iif($cingular_site != "T", "<li>", "") ?>The wireless service providers define an "upgrade" as a customer requesting to extend their agreement in return for a new phone or device that is either free or heavily discounted.<!--Vision Wireless is not compensated for this from the wireless service providers since it is not a new activation, but instead, a continuance of service with the same wireless service provider. Therefore, we cannot discount your device in this situation.--></li></li>
						</ul>
		
						<strong class="bodyBlack">Are these new or refurbished devices?</strong>
						<ul>
							<li>All phones distributed under this offer are brand new in the original manufacturer's packaging and have never been used.</li>
						</ul>
		
						<strong class="bodyBlack">What are the requirements and associated cancellation fees to receive these special offers?</strong>
						<ul>
							<li>All <? echo $carrier_label; ?> activations must remain active for 180 days on the minimum required rate plan(s).<? echo iif($cingular_site == "T", " The rebate also requires activation on a PDA Personal Plan or a $39.99 or higher unlimited data rate plan or a $19.99 or higher messaging plan plus an AT&T Voice Plan of $39.99 or higher.", "") ?></li>
						</ul>
		
						<strong class="bodyBlack">Why am I required to give you my Social Security Number, Birth Date and Driver's License Number?</strong>
						<ul>
							<li><? echo $carrier_label; ?> requires credit checks and identity verification for new service. Customer must pass credit restrictions by <? echo $carrier_label; ?> to be approved for this offer. If customer is not approved, they will receive a letter from <? echo $carrier_label; ?> giving them the ability to pull their credit report for free.</li>
						</ul>
		
						<strong class="bodyBlack">Will my personal information be safe?</strong>
						<ul>
							<li>Yes, your personal information will be safe and secure. In addition, we do not receive your credit report, simply an approval or denial from the <? echo $carrier_label; ?> credit approval department.</li>
						</ul>
		
						<strong class="bodyBlack">Is there a term required for this offer?</strong>
						<ul>
							<li>A service agreement for 24 months is required with <? echo $carrier_label; ?>. The customer will be charged a deactivation fee of <? echo iif($sprint_site == "T" || $nextel_site == "T", "up to $200", "$175") ?> by <? echo $carrier_label; ?> if they deactivate service before the end of their term.</li>
						</ul>
		
						<strong class="bodyBlack">Do I need to call anyone after I place my order online?</strong>
						<ul>
							<li>No, you will receive an email confirmation once your order is processed. You will receive a response within 72 hours or the device should arrive within three to five business days.</li>
						</ul>
		
						<strong class="bodyBlack">What is the preferred way to place my order?</strong>
						<ul>
							<li>All orders must be placed online to receive these outstanding deals.</li>
						</ul>
		
						<strong class="bodyBlack">Is there an Activation fee?</strong>
						<ul>
							<li>Yes, <? echo $carrier_label; ?> charges a $<? echo money_format('%-2n', $activation_fee); ?> activation fee per line of service. That amount will be billed on your first invoice.</li>
						</ul>

	
						<strong class="bodyBlack">How do I get my Company Discount?</strong>
						<ul>
<!--							<li><a href="javascript:void(0)" onclick="show('Discount')" class="bodyBlack"><strong><u>Click Here</u></strong></a> for company discount information.</li>-->
							<li><a href="<? echo$_SERVER['REQUEST_URI']; ?>#top" onclick="show('Discount')" class="bodyBlack"><strong><u>Click Here</u></strong></a> for company discount information.</li>
						</ul>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><img src="images/InfoFooter.jpg" alt="" width="710" height="10" border="0"></td>
		</tr>
		</table>					
	</td>
</tr>
</table>

<!-- END Include faq.php -->
