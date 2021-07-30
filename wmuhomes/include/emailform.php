<!-- BEGIN include emailform.php -->

				<!-- Form Validation -->
				<script>
				function validate(theForm){
				// Name
					if (theForm.name.value == ""){
						theForm.name.style.background="#FF0000";
						alert("Please Enter Your Name");
						theForm.name.style.background="#D9F0F5";
						theForm.name.focus();
						return false;
					}
/*					// Phone (Just check if it's filled in - too many possible formats to check for without knowing the country)
					if (theForm.phone.value == ""){
						theForm.phone.style.background="#FF0000";
						alert("Please Enter Your Phone Number");
						theForm.phone.style.background="#D9F0F5";
						theForm.phone.focus();
						return false;
					}
*/				// Email
					if (theForm.email.value == ""){
						theForm.email.style.background="#FF0000";
						alert("Please Enter Your Email Address");
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for "@"
			 		if (theForm.email.value.indexOf("@") == -1) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Contain an "@"');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for "@" as first char.
			 		if (theForm.email.value.indexOf("@") == 0) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Cannot Start With a "@"');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for anything after "@"
			 		if (theForm.email.value.length == (theForm.email.value.indexOf("@")+1)) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Contain a Domain Name After the "@"');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for multiple "@"
			 		if (theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length).indexOf("@") != -1) {
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Contain Only One "@"');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for "."
			 		if (theForm.email.value.indexOf(".") == -1) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Contain a "."');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for "." as first char.
			 		if (theForm.email.value.indexOf(".") == 0) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Cannot Start With a "."');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for ".."
			 		if (theForm.email.value.indexOf("..") != -1) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Not Contain Adjacent Dots ("..")');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for "." adjacent to "@"
			 		if (theForm.email.value.indexOf(".@") != -1 || theForm.email.value.indexOf("@.") != -1) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Not Contain Adjacent Dots and Ats (".@" or "@.") ');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for TLD
			 		if (theForm.email.value.length == (theForm.email.value.indexOf(".")+1)) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Contain a Top Level Domain (i.e. ".com") After the "."');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for TLD at least 2 char.
					var domain = theForm.email.value.substring((theForm.email.value.indexOf("@")+1),theForm.email.value.length);
					if (domain.length - (domain.indexOf(".")+1) < 2) {
						theForm.email.style.background="#FF0000";
						alert('The Top Level Domain (i.e. ".com") Must Contain At Least 2 Characters');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
/*					// Check for TLD over 3 char. *ALLOWED NOW
					if (domain.length - (domain.indexOf(".")+1) > 3) {
						theForm.email.style.background="#FF0000";
						alert('The Top Level Domain (i.e. ".com") Cannot Contain More Than 3 Characters');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
*/					// Check for "_" in TLD
					if (theForm.email.value.indexOf("_") > theForm.email.value.indexOf("@")) {
						theForm.email.style.background="#FF0000";
						alert('The Top Level Domain (i.e. ".com") Cannot Contain Any Underscores ("_")');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for spaces
			 		if (theForm.email.value.indexOf(" ") != -1) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Not Contain Any Spaces (" ")');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					// Check for illegal char.
					var email_regex = /^\w(?:\w|-|\.(?!\.|@))*@\w(?:\w|-|\.(?!\.))*\.\w{2,3}/;
			 		if (email_regex.test(theForm.email.value) == false) { 
						theForm.email.style.background="#FF0000";
						alert('Your Email Must Not Contain Any Of These Characters: ( )<>,;:\"`\'{ }/~#$%^&*+=[ ]|? ');
						theForm.email.style.background="#D9F0F5";
						theForm.email.focus();
						return false;
					}
					if (theForm.subject.value == ""){
						theForm.subject.style.background="#FF0000";
						alert("Please Enter A Subject");
						theForm.subject.style.background="#D9F0F5";
						theForm.subject.focus();
						return false;
					}
/*					// Captcha - answer defined in index.php
					if (theForm.captcha.value != <?=$answer;?>){
						theForm.captcha.style.background="#FF0000";
						alert("I'm Sorry, That Answer Is Incorrect - Please Try Again");
						theForm.captcha.style.background="#D9F0F5";
						theForm.captcha.focus();
						return false;
					}
*/					// Message
					if (theForm.message.value == ""){
						theForm.message.style.background="#FFFF00";
						leaveBlank = confirm("Are You Sure You Want To Send An Empty Message?\n\r   (Click 'Cancel' To Go Back And Enter A Message)");
						theForm.message.style.background="#D9F0F5";
						theForm.message.focus();
						if (!leaveBlank) return false;
					}
					// All's well - do it.
SendIt("Name="+theForm.name.value+"&Email="+theForm.email.value+"&Subject="+theForm.subject.value+"&MailTo="+theForm.mailto.value+"&Message="+theForm.message.value);
					return false;
				}
				</script>

				<script>
					// Ajax script to send email
					function SendIt(params){
						if (window.XMLHttpRequest){ // Code for IE7+, Firefox, Opera, Webkit (Chrome, Safari, Rockmelt)
							xmlhttp=new XMLHttpRequest();
						}else{ // Code for IE6, IE5
							xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
						}
						xmlhttp.open("GET","include/sendemail.php?"+params);
						xmlhttp.send();
						xmlhttp.onreadystatechange = function(){
							if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
								document.getElementById("emailBox").innerHTML = xmlhttp.responseText;
							}
						}
					}
				</script>

				<div id="emailHeader" style="position:absolute; top:10px; left:20px; z-index:1001; width:595px; height:50px; font-family:'Myvetica',sans-serif; font-size:28px; color:#FFFFFF;">
					Email Contact Form
					<div id="closeButton" align="center" style="position:absolute; top:0px; right:0px; z-index:1002; width:75px; height:25px;">
						<a href="javascript:hide('overlayMask');"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a>
					</div>		
					<div id="closeLink" align="center" style="position:absolute; top:10px; right:0px; z-index:1001; width:75px; height:10px;">
						<a href="javascript:hide('overlayMask');" class="smallBlue">Close</a>
					</div>
				</div>
				<div id="emailText" style="position:absolute; top:40px; left:20px; z-index:1001; width:550px; height:100px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-family:'Myvetica',sans-serif; font-size:18px; color:#284C88;">
					Thank you for your interest in <?=$details["streetnumber"]." ".$details["street"].iif($details["aptnumber"] != "", ", Apt. ".$details["aptnumber"], "");?>.
				</div>
				<!-- Email Box -->
				<form name="Email" id="Email" onSubmit="return validate(this);">
				<div id="emailBox" style="position:absolute; top:70px; left:10px; width:580px; height:320px; background-color:#FFFFFF; z-index:1001;" class="roundedCorners">
					<!-- Email Form -->
					<div id="emailForm" style="position:absolute; top:10px; left:20px; width:540px; z-index:1002;">
						<div id="emailName" style="position:absolute; top:0px; left:0px; width:250px; z-index:1002;">
							<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="name">Your Name:</label></span><br>
							<input type="text" name="name" id="name" size="25" maxlength="50" style="width:250px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" value="" tabindex="1">
						</div>
						<div id="emailAddress" style="position:absolute; top:0px; right:5px; width:250px; z-index:1002;">
							<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="email">Your Email Address:</label></span><br>
							<input type="text" name="email" id="email" size="25" maxlength="50" style="width:250px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" value="" tabindex="2">
						</div>
						<div id="emailBottom" style="position:absolute; top:49px; left:0px; width:540px; z-index:1002;">
							<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="subject">Subject:</label></span><br>
							<input type="text" name="subject" id="subject" size="25" maxlength="50" style="width:535px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" value="Your wmuhomes.com listing for <?=$details["streetnumber"]." ".$details["street"].iif($details["aptnumber"] != "", ", Apt. ".$details["aptnumber"], "");?>" tabindex="3"><br>
							<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="message">Message:</label></span><br>
							<textarea cols="30" rows="10" name="message" style="width:535px; height:145px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" tabindex="4"></textarea><br>
							<input type="hidden" name="mailto" id="mailto" value="<?=$details["email"];?>">
							&nbsp;&nbsp;<input type="submit" value="Send" style="width:75px;">
						</div>
					</div>
				</div>
				</form>
				<!-- Place cursor in first field by default -->
				<script>document.forms['Email'].Name.focus();</script>

<!-- END include emailform.php -->

