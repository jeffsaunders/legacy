<!-- BEGIN Include contact.php -->

			<div id="productTabsContainer">
				<strong class="sectionLabel">Contact Us</strong>
			</div>
			<div id="productInfoContainer">
				<br>
				<div id="staticInfoContainer" class="staticInfoContainer">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<!-- Why is EVERY image on this site a different size?  Sigh -->
						<td width="320" valign="top"><img src="images/Contact.jpg" alt="Marmiro Stones by Turan Bekisoglu" width="320" height="538" border="0" class="imageContainer"></td>
						<td valign="top">
							<!-- Show locations or contact form -->
							<table width="100%" cellspacing="0" cellpadding="0">
							<?
							// Locations
							if ($prod != "form"){
							?>
							<tr>
								<td width="50%" valign="top" class="contactContainer">
									<!-- #BeginSnippet name="Upper-Left Box" users="marmiroc" -->
									<strong class='contactLabel'>USA Headquarters</strong><br>
									511 Washington Ave<br>
									Carlstadt, NJ 07072<br><br>
									
									P 201.933.6461<br>
									F 201.933.6462<br>
									<a href="?sec=contact&prod=form&loc=USA Headquarters" class="contactLink">Email Us</a><br>
									888-MARMIRO (627-6476) X2<br><br>
									
									Hours of Operation<br>
									Mon - Fri 8:30am to 5:30pm EST<br>
									Saturday by appointment only
									<!-- #EndSnippet -->
								</td>
								<td width="50%" valign="top" class="contactContainer">
									<!-- #BeginSnippet name="Upper-Right Box" users="marmiroc" -->
									<strong class='contactLabel'>Southeast Branch</strong><br>
									435 N. Andrews Ave Ste 2<br>
									Ft. Lauderdale, FL 33301<br><br>
									
									P 954.462.2444<br>
									F 954.462.1160<br>
									<a href="?sec=contact&prod=form&loc=Southeast Branch" class="contactLink">Email Us</a><br>
									888-MARMIRO (627-6476) X1<br><br>
									
									Hours of Operation<br>
									Mon - Fri 9am to 5:30pm EST<br>
									Saturday by appointment only
									<!-- #EndSnippet -->
								</td>
							</tr>
							<tr>
								<td valign="top" class="contactContainer">
									<!-- #BeginSnippet name="Lower-Left Box" users="marmiroc" -->
									<strong class='contactLabel'>Factory</strong><br>
									Esenboga Yolu 15.km<br>
									Ankara 06510, Turkey<br><br>
									
									P +90.312.399.3210<br>
									F +90.312.399.4502<br>
									<a href="?sec=contact&prod=form&loc=Factory" class="contactLink">Email Us</a><br>
									<a href="http://www.turanbekisoglu.com" target="_blank" class="contactLink">www.turanbekisoglu.com</a><br><br>
									
									Hours of Operation<br>
									Mon - Fri 9am to 6pm EET (UTC+2)<br>
									Saturday 9am to 2pm
									<!-- #EndSnippet -->
							</td>
								<td valign="top" class="contactContainer">
									<!-- #BeginSnippet name="Lower-Right Box" users="marmiroc" -->
									<strong class='contactLabel'>Caribbean</strong><br>
									St. Maarten N.A.<br><br>
									
									P 599.520.2224<br>
									<a href="?sec=contact&prod=form&loc=Caribbean" class="contactLink">Email Us</a><br>
									
									Hours of Operation<br>
									By appointment only
									<!-- #EndSnippet -->
								</td>
							</tr>
							<?
							// Contact Form
							}else{
							?>
							<tr>
								<td width="100%" height="500" valign="top" class="contactContainer">
									<?
									// If the form was submitted and the user is sent back here
									if ($tab == "sent"){
									?>
									<div align="center">
										<br><br>
										<strong><?=$config["contact_thankyou"];?></strong>
									</div>
									<?
									// Display the form
									}else{
									?>
									<script type="text/javascript" src="js/swfobject.js"></script>
									<div id="CC3343409" style="z-index:1;">Form Object</div>
									<script type="text/javascript">
										var so = new SWFObject("flash/contactform.swf", "xml/contactform.xml", "560", "496", "7,0,0,0", "#ffffff");so.addParam("classid", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000");so.addParam("quality", "high");so.addParam("scale", "noscale");so.addParam("salign", "lt");so.addParam("wmode", "transparent");so.addParam("FlashVars", "xmlfile=xml/contactform.xml&w=560&h=496");so.write("CC3343409");
									</script> 
									<?
									}
									?>
								</td>
							</tr>
							<?
							}
							?>
							</table>
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include contact.php -->
