			<!-- BEGIN include contactform.php -->

					<!-- Form Validation -->
					<script>
					function validateContact(theForm){
					// Name
						if (theForm.name.value == ""){
							theForm.name.style.background="#FF0000";
							alert("Please Enter Your Name");
							theForm.name.style.background="#FFFFFF";
							theForm.name.focus();
							return false;
						}
					// Phone (Just check if it's filled in - too many possible formats to check for without knowing the country)
						if (theForm.phone.value == ""){
							theForm.phone.style.background="#FF0000";
							alert("Please Enter Your Phone Number");
							theForm.phone.style.background="#FFFFFF";
							theForm.phone.focus();
							return false;
						}
					// Email
						if (theForm.email.value == ""){
							theForm.email.style.background="#FF0000";
							alert("Please Enter Your Email Address");
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for "@"
				 		if (theForm.email.value.indexOf("@") == -1) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Contain an "@"');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for "@" as first char.
				 		if (theForm.email.value.indexOf("@") == 0) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Cannot Start With a "@"');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for anything after "@"
				 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Contain a Domain Name After the "@"');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for multiple "@"
				 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Contain Only One "@"');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for "."
				 		if (theForm.email.value.indexOf(".") == -1) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Contain a "."');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for "." as first char.
				 		if (theForm.email.value.indexOf(".") == 0) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Cannot Start With a "."');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for ".."
				 		if (theForm.email.value.indexOf("..") != -1) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Not Contain Adjacent Dots ("..")');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for "." adjacent to "@"
				 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for TLD
				 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for TLD at least 2 char.
						var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
						if (domain.length - (domain.indexOf(".")+1) < 2) {
							theForm.email.style.background="#FF0000";
							alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for TLD over 3 char. *ALLOWED NOW
//						if (domain.length - (domain.indexOf(".")+1) > 3) {
//							theForm.email.style.background="#FF0000";
//							alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
//							theForm.email.focus();
//							return false;
//						}
						// Check for "_" in TLD
						if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
							theForm.email.style.background="#FF0000";
							alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for spaces
				 		if (theForm.email.value.indexOf(" ") != -1) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Not Contain Any Spaces (" ")');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
						// Check for illegal char.
						var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
				 		if (email_regex.test(theForm.email.value) == false) { 
							theForm.email.style.background="#FF0000";
							alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
							theForm.email.style.background="#FFFFFF";
							theForm.email.focus();
							return false;
						}
					// Message
						if (theForm.message.value == ""){
							theForm.message.style.background="#FFFF00";
							leaveBlank = confirm("Are You Sure You Want To Send An Empty Message?\n\r   (Click 'Cancel' To Go Back And Enter A Message)");
							theForm.message.style.background="#FFFFFF";
							theForm.message.focus();
							if (!leaveBlank) return false;
						}
						alert("Your Message Has Been Sent - Someone Will Get Back To You Soon\n\r                                           Thank You!");
						return true;
					}
					</script>

					<!-- Keep form tags outside structure for formatting -->
					<form action="dbupdate.php" method="post" name="contact" id="contact" onSubmit="return validateContact(this);"> <!--background-color:#ECEADC;-->
					<table width="225" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225BurgundyBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" background="images/225BurgundyBGMiddle.gif">
							<img src='TextIMG.php?text=Contact Us&font=CACCHAMP.TTF&bold=extra&points=30&txtcolor=ECEADC&shadow=000000&offset=2&width=200&height=30&left=0&top=25&angle=0&bgcolor=770025&transparent=yes&dropcap=yes&format=png' alt="For More Information" border="0">
							<table width="200" border="0" cellspacing="0" cellpadding="0" class="bodyDarkGray">
							<tr>
								<td><br><input type="text" name="name" id="name" style="width:200px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Name</strong></label></td>
							</tr>
							<tr>
								<td><br><input type="text" name="phone" id="phone" style="width:200px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Phone Number</strong></label></td>
							</tr>
							<tr>
								<td><br><input type="text" name="email" id="email" style="width:200px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Email Address</strong></label></td>
							</tr>
							<tr>
								<td><br><textarea cols="10" rows="5" name="message" class="bigBlack" style="width:200px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;"></textarea><br><label for="message"><strong class="bigIvory">Your Message</strong></label></td>
							</tr>
							<tr>
								<td align="center">
									<input type="hidden" name="task" value="contactSubmit">
									<input type="hidden" name="location" id="location" value="<?=iif($_SERVER["HTTPS"], 'https://', 'http://').$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>">
									<br><input type="submit" name="submit" value="Send">
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225BurgundyBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>
					</form>

				<!-- END include contactform.php -->

