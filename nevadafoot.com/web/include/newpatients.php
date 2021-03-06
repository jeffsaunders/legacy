<!-- BEGIN INCLUDE "New Patients" -->

<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
<tr>
	<td class="bodyBlue">
		<table width="210" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<td align="left"><img src="images/spacer.gif" width="1" height="3" alt="" border="0"><br><img src="images/familyfeet.jpg" alt="" width="200" border="1"></td>
		</tr>
		</table>
		<p align="left"><font size="3"><strong>New Patients</strong></font></p>
		
		<p align="left">Nevada Foot Institute welcomes all new patients.  Please call <strong>(702)438-2425</strong> for an appointment.  Most new patients can be seen within 24 hours for urgent situations &mdash; <a href="?sec=locations" class="bodyBlue">two convenient locations to serve you</a>.</p>

		<p align="left">Please keep in mind that most HMO Insurance Plans will require a referral from your primary care physician before your visit &mdash; consult with your insurance provider.</p>
		<br><br>

		<p align="left"><font size="3"><strong>New Patient Forms</strong></font></p>

		<p align="left">Click on the applicable link below to access the New Patient Information Form.  When you click the link, a new browser window will open with the form - please fill it out as completely as possible.  Once complete, please click the 'PRINT' icon in your browser.  After the form prints, sign it and and bring it to our office for your appointment.</p>

		<p align="left">Completing the New Patient Information Form in advance will save you time on your initial visit!</p>

		<p align="center">
			<font size="3"><strong>Choose the Applicable New Patient Information Form Packet<br>
<!--			<a href="WebsiteRegistrationFormAdultEnglish.pdf" target="_blank" class="bodyBlue">Adult Patient</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="WebsiteRegistrationFormMinorEnglish.pdf" target="_blank" class="bodyBlue">Minor Patient</a>&nbsp;&nbsp;|&nbsp;
			<a href="WebsiteRegistrationFormAdultSpanish.pdf" target="_blank" class="bodyBlue">Paciente Adulto<!--En Espa&ntilde;ol--</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="WebsiteRegistrationFormMinorSpanish.pdf" target="_blank" class="bodyBlue">Paciente Infantil</a></strong></font>-->

<!--			<a href="Patient Registration English 2012.pdf" target="_blank" class="bodyBlue">Adult Patient</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration English Minor 2012.pdf" target="_blank" class="bodyBlue">Minor Patient</a>&nbsp;&nbsp;|&nbsp;
			<a href="Patient Registration Spanish 2012.pdf" target="_blank" class="bodyBlue">Paciente Adulto<!--En Espa&ntilde;ol--</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration Spanish Minor 2012.pdf" target="_blank" class="bodyBlue">Paciente Infantil</a></strong></font>-->

<!--			<a href="Patient Registration English 2013 rev 05-2013.pdf" target="_blank" class="bodyBlue">Adult Patient</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration English Minor 2013 rev 05-2013.pdf" target="_blank" class="bodyBlue">Minor Patient</a>&nbsp;&nbsp;|&nbsp;
			<a href="Patient Registration Spanish 2013 rev 05-2013.pdf" target="_blank" class="bodyBlue">Paciente Adulto<!--En Espa&ntilde;ol--</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration Spanish Minor 2013 rev 05-2013.pdf" target="_blank" class="bodyBlue">Paciente Infantil</a></strong></font>-->

			<a href="Patient Registration English 2013 rev 09-2013.pdf" target="_blank" class="bodyBlue">Adult Patient</a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration English Minor 2013 rev 09-2013.pdf" target="_blank" class="bodyBlue">Minor Patient</a>&nbsp;&nbsp;|&nbsp;
			<a href="Patient Registration Spanish 2013 rev 09-2013.pdf" target="_blank" class="bodyBlue">Paciente Adulto<!--En Espa&ntilde;ol--></a>&nbsp;&nbsp;&middot;&nbsp;
			<a href="Patient Registration Spanish Minor 2013 rev 09-2013.pdf" target="_blank" class="bodyBlue">Paciente Infantil</a></strong></font>
 		</p>

		<table border="0" cellspacing="5" cellpadding="0" align="center">
		<tr>
			<td>
				<a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank"><img src="images/get_adobe_reader.gif" width="88" height="31" alt="Free Adobe Acrobat Reader" border="0"></a>
			</td>
			<td align="center" class="bodyBlue">
				<font size="1">You must have the Adobe Acrobat Reader to view and print the form</font><br>
				<a href="http://www.adobe.com/products/acrobat/readstep2.html" target="_blank" class="bodyBlue"><font size="1"><strong>Click Here to Download Adobe Acrobat Reader Free</strong></a></font>
			</td>
		</tr>
		</table>
		<br>
		<p align="left"><font size="3"><strong>Insurance Plans</strong></font></p>

		<p align="left">Below is a list of most, but not all, insurance companies for which we are providers.  Please call us at <strong>(702)438-2425</strong> if you have questions regarding your insurance.</p>
		<br>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td colspan="3" class="bodyBlue"><font size="2"><strong><u><em>Provider Networks</em></u></strong></font></td>
		</tr>
		<tr>
		<?
		// Grab information
		$query = "SELECT * FROM insurance_plans WHERE display <> 'F' AND section = 'network' ORDER BY name";
		$rs_insurance = mysql_query($query, $linkID);
		?>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=0; $cnt <= mysql_num_rows($rs_insurance)/3; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= (mysql_num_rows($rs_insurance)/3)*2; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= mysql_num_rows($rs_insurance); $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="bodyBlue"><br><font size="2"><strong><u><em>Accepted Plans</em></u></strong></font></td>
		</tr>
		<tr>
		<?
		// Grab information
		$query = "SELECT * FROM insurance_plans WHERE display <> 'F' AND section = 'accepted' ORDER BY name";
		$rs_insurance = mysql_query($query, $linkID);
		?>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=0; $cnt <= mysql_num_rows($rs_insurance)/3; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= (mysql_num_rows($rs_insurance)/3)*2; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= mysql_num_rows($rs_insurance); $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
		</tr>
		<tr>
			<td colspan="3" class="bodyBlue"><br><font size="2"><strong><u><em>Sorry, we do not accept:</em></u></strong></font></td>
		</tr>
		<tr>
		<?
		// Grab information
		$query = "SELECT * FROM insurance_plans WHERE display <> 'F' AND section = 'not_accepted' ORDER BY name";
		$rs_insurance = mysql_query($query, $linkID);
		?>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=0; $cnt <= mysql_num_rows($rs_insurance)/3; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= (mysql_num_rows($rs_insurance)/3)*2; $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
			<td width="33%" valign="top" class="bodyBlue">
		<?
		for ($cnt=$cnt; $cnt <= mysql_num_rows($rs_insurance); $cnt++){
				$insurance = mysql_fetch_assoc($rs_insurance);
		?>
			<?=$insurance["name"];?><br>
		<?
		}
		?>
			</td>
		</tr>
		</table>
		<br>
	</td>
</tr>
</table>

<!-- END INCLUDE "New Patients" -->
