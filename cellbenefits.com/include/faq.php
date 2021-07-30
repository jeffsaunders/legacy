<!-- BEGIN Include faq.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Common Questions</strong></td>
	<td><img src="images/spacer.gif" alt="" width="731" height="25" border="0"></td>
</tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</tr>
	<td colspan="2" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
		<tr>
			<td>
				<ul>
					<li><strong class="bigBlack">Do I qualify for these offers if I am an existing customer with <? echo $carrier_label; ?>?</strong><br><br>
					These programs require new service on a voice plan $39.99 or higher for all mail-in rebates on basic phones. Mail-in rebates are only eligible for data devices (PDAs, Smart Phones, BlackBerrys, Treos) if you activate on a $39.99 or higher voice plan and an unlimited data plan per your device. This will typically be outlined and explained next to the image of the device on our order site. If you are a current customer, this offer will be valid if you activate a new primary number account that is not under an existing account. Mail-in rebates are not valid if you are adding lines to a Family Plan, renewing your service, or upgrading or adding services to your existing account.<br></li><br>
	
					<li><strong class="bigBlack">Can I keep my existing cell phone number?</strong><br><br>
					If you already have service with <? echo $carrier_label; ?> and you want to have your new service activated with <? echo $carrier_label; ?>, then you will have to activate new service and receive a new phone number. If you are switching wireless carriers, then yes, due to number portability laws, all cellular carriers are required to transfer your number to the carrier of your choice.<br></li><br>
	
					<li><strong class="bigBlack">I am a current <? echo $carrier_label; ?> subscriber and want to upgrade my phone.  What should I do?</strong><br><br>
					Please visit your local <? echo $carrier_label; ?> retailer, tell them the company that you work for and that you would like to take advantage of your company's sponsored discounts.  You will be asked to show identification verifying your employment (either a company ID card or pay stub).<br></li><br>
	
					<li><strong class="bigBlack">Are there any penalties for canceling my new service with <? echo $carrier_label; ?>?</strong><br><br>
					All activations will require a two-year agreement with <? echo $carrier_label; ?>, failure to keep your service activated for this term will result in a deactivation fee from <? echo $carrier_label; ?> in the amount of <? echo iif($sprint_site == "T" || $nextel_site == "T", "$150 to $200", "$175") ?> per activated device. You will have 14 days to cancel your service without having to pay these fees. You will still be responsible for paying the $36.00 activation fee and any usage of service.<br></li><br>
	
					<li><strong class="bigBlack">I have been told that I need to "Migrate" or "Upgrade" my account, what does that mean?</strong><br></li><br>
						<ul>
							<li><strong>Migrations: </strong>
							The wireless service providers define a migration as a customer moving their service from TDMA to GSM. TDMA is an older technology that is rarely used anymore and customer's are being forced to move to the newer digital service, which is GSM. The important thing to realize is that your service remains with the same wireless service provider and is not treated as a new activation, therefore we do not receive commissions and are unable to discount your new device. Please contact <? echo $carrier_label; ?> directly if you need to migrate your service from TDMA to GSM and they will provide you a discount on your new equipment.<br></li><br>
			
							<li><strong>Upgrades: </strong>
							The wireless service providers define an upgrade as a customer requesting to extend their agreement in return for a new phone or device that is either free or heavily discounted. Vision Wireless is not compensated for this from the wireless service providers since it is not a new activation, but instead, a continuance of service with the same wireless service provider. Therefore, cannot discount your device in this situation.</li></p>
						</ul>
	
					<li><strong class="bigBlack">Are these new or refurbished devices?</strong><br><br>
					All phones distributed under this offer are brand new in the original manufacturer's packaging and have never been used.<br></li><br>
	
					<li><strong class="bigBlack">What are the requirements and associated cancellation fees to receive these special offers?</strong><br><br>
					All <? echo $carrier_label; ?> activations must remain active for 120 days on the minimum required rate plan(s) or the customer will be charged $350 for each Rim Blackberry device, $300 for each Motorola Razor device and $200 for any other device received through these offers.<br></li><br>
	
					<li><strong class="bigBlack">Why am I required to give you my Social Security Number, Birth Date and Driver's License Number?</strong><br><br>
					<? echo $carrier_label; ?> requires credit checks and identity verification for new service. Customer must pass credit restrictions by <? echo $carrier_label; ?> to be approved for this offer. If customer is not approved, they will receive a letter from <? echo $carrier_label; ?> giving them the ability to pull their credit report for free.<br></li><br>
	
					<li><strong class="bigBlack">Will my personal information be safe?</strong><br><br>
					Yes, your personal information will be safe and secure. In addition, we do not receive your credit report, simply an approval or denial from the <? echo $carrier_label; ?> credit approval department.<br></li><br>
	
					<li><strong class="bigBlack">Is there a term required for this offer?</strong><br><br>
					A service agreement for 24 months is required with <? echo $carrier_label; ?>. The customer will be charged a deactivation fee of $150 to $200 by <? echo $carrier_label; ?> if they deactivate service before the end of their term.<br></li><br>
	
					<li><strong class="bigBlack">Do I need to call anyone after I place my order online?</strong><br><br>
					No, a customer service representative will contact or email you once your order is processed. You will receive a response within 72 hours or the device should arrive within three to five business days.<br></li><br>
	
					<li><strong class="bigBlack">What is the preferred way to place my order?</strong><br><br>
					All orders must be placed online to receive these outstanding deals.<br></li><br>
	
					<li><strong class="bigBlack">Is there an Activation fee?</strong><br><br>
					Yes, <? echo $carrier_label; ?> charges a $36.00 activation fee per line of service. That amount will be billed on your first invoice.<br></li><br>
	
					<?
					if ((($sprint_site == "T" || $nextel_site == "T") && ($sprint_discount > 0 || $nextel_discount > 0)) || ($cingular_site == "T" && $cingular_discount > 0)){
					?>
					<li><strong class="bigBlack">How do I get my Company or Membership Discount?</strong><br><br>
					<a href="?sec=discount" class="bodyBlack"><strong><u>Click Here</u></strong></a> for company and membership discount information.</li>
					<?
					}
					?>
				</ul>
			</td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="930" height="5" border="0"></td>
</tr>
</table>

<!-- END Include faq.php -->

