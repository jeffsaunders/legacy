			<!-- BEGIN include feedbackform.php -->

					<!-- Form Validation -->
					<script>
					function validateFeedback(theForm){
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
					// Type Selected
						var typeSelected = false;
						for (i = 0;  i < theForm.type.length;  i++){
							if (theForm.type[i].checked){
								typeSelected = true;
							}
						}
						if (!typeSelected){
							for (i = 0;  i < theForm.type.length;  i++){
								theForm.type[i].style.background="#FF0000";
							}
							alert("Please Select A Message Type");
							for (i = 0;  i < theForm.type.length;  i++){
								theForm.type[i].style.background="#FFFFFF";
							}
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
						hide('feedbackLayer');
						alert("Your Message Has Been Sent - Thank You!");
						return true;
					}
					</script>

					<!-- Keep form tags outside structure for formatting -->
					<form action="dbupdate.php" method="post" name="feedbackForm" id="feedbackForm" onSubmit="return validateFeedback(this);">
					<table width="600" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
					<tr>
						<td background="images/600BurgundyBGTop.png"><img src="images/spacer.gif" alt="" width="600" height="20" border="0"></td>
					</tr>
					<tr>
						<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top">
							<table width="550" border="0" cellspacing="0" cellpadding="0" align="center" class="menuWhite">
							<tr>
								<td>
									<table width="550" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="500">
											<img src='TextIMG.php?text=We Welcome Your Comments&font=CACCHAMP.TTF&bold=extra&points=28&txtcolor=FFFFFF&shadow=000000&offset=1&width=500&height=40&left=0&top=25&angle=0&bgcolor=770025&transparent=yes&dropcap=yes&format=png' alt="We Welcome Your Comments" border="0"><br>
											<strong class="bigIvory"><em><img src="images/spacer.gif" alt="" width="30" height="1" border="0">Especially Testimonials!</em></strong>
										</td>
										<td width="50" align="right" valign="top">
											<a href="javascript:void(0)" onclick="hide('feedbackLayer')" class="smallIvory"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td>
									<br>
									We want to hear from you!<br><br>
									Please use this form to send us feedback about your wedding experience at The Little Church of the West.<br><br>
									Of course, testimonials are most welcome, but we'd like to hear any complaints, comments, or other concerns you may have as well ... after all, how can we improve our service otherwise?<br><br>
								</td>
							</tr>
							<tr>
								<td>
									<table width="550" border="0" cellspacing="0" cellpadding="0" class="menuWhite">
									<tr>
										<td width="400"><br><input type="text" name="name" id="name" style="width:400px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Name</strong></label></td>
										<td width="25" rowspan="3"><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
										<td width="125" rowspan="3" valign="top">
											<br>
											<input type="radio" name="type" id="button1" value="Testimonial" checked>&nbsp;<label for="button1"><strong class="bigIvory">Testimonial</strong></label><br><br>
											<input type="radio" name="type" id="button2" value="Comment">&nbsp;<label for="button2"><strong class="bigIvory">Comment</strong></label><br><br>
											<input type="radio" name="type" id="button3" value="Complaint">&nbsp;<label for="button3"><strong class="bigIvory">Complaint</strong></label><br><br>
											<input type="radio" name="type" id="button4" value="Other">&nbsp;<label for="button4"><strong class="bigIvory">Other</strong></label>
										</td>
									</tr>
									<tr>
										<td><br><input type="text" name="phone" id="phone" style="width:400px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Phone Number</strong></label></td>
									</tr>
									<tr>
										<td><br><input type="text" name="email" id="email" style="width:400px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;" value=""><br><label for="name"><strong class="bigIvory">Your Email Address</strong></label></td>
									</tr>
									<tr>
										<td colspan="3"><br><textarea cols="30" rows="3" name="message" class="bigBlack" style="width:550px; color:#3F3F3F; font-weight:bold; background-color:#FFFFFF;"></textarea><br><label for="message"><strong class="bigIvory">Your Message</strong></label></td>
									</tr>
									<tr>
										<td colspan="3" align="center">
											<input type="hidden" name="task" value="feedbackSubmit">
											<input type="hidden" name="location" id="location" value="<?=iif($_SERVER["HTTPS"], 'https://', 'http://').$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];?>">
											<br><input type="submit" name="submit" value="Send" style="width:200px;">
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/600BurgundyBGBottom.png"><img src="images/spacer.gif" alt="" width="600" height="20" border="0"></td>
					</tr>
					</table>
					</form>

				<!-- END include feedbackform.php -->

