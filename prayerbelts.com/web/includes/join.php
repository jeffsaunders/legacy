<!-- BEGIN Include join.php -->

<script>
// Only accept digits (numbers)
function onlyNumbers(e,o){
//alert(o.value);
	var keynum
	var keychar
	var ltrcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which
	}
//alert(keynum);
	if (keynum == 08 || keynum == 45 || !keynum) return true; // Backspace, hyphen, or navigation (arrow) key
	keychar = String.fromCharCode(keynum)
	ltrcheck = /D/ //Regular expression for NON-digit (letter)
	crcheck = /cM/ //Regular expression ctrl-M (enter)
	if (crcheck.test(keychar)) o.blur();
	return !ltrcheck.test(keychar) //Return true if not a letter
//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
}
</script>

<div id="join">
	<div id="joinHeadline">Join Our Mailing List</div>
	<div id="joinText">
		<!-- Form Validation Scripts -->
		<script src="js/FormValidation.js" type="text/javascript"></script>

		<form action="/updatelist.php" method="POST" name="joinForm" id="joinForm" onSubmit="return validateJoin(this);">
		<table width="650" border="0" cellspacing="10" cellpadding="5">
		<tr>
			<td colspan="2">Thank you for joining our mailing list.  Please enter the following information:</td>
		</tr>
		<tr>
			<td width="180" align="right" bgcolor="#E8E8E8"><strong>Full Name:</strong></td>
			<td>
				<input type="text" name="name" id="name" size="25" maxlength="100" value="" style="width:250px;">  
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your name." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Email Address:</strong></td>
			<td>
				<input type="text" name="email" id="email" size="25" maxlength="100" value="" style="width:250px;">  
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your email address." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Email Address Again:</strong></td>
			<td>
				<input type="text" name="email2" id="email2" size="25" maxlength="100" value="" style="width:250px;">  
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your email address again for verification." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#E8E8E8"><strong>Your Zip Code:</strong></td>
			<td>
				<input type="text" name="zipcode" id="zipcode" size="25" maxlength="10" value="" style="width:250px;" onKeyPress="return onlyNumbers(event,this);">  
				<img src="images/QuestionMark.gif" alt="?" title="Please enter your zipcode for geographic sorting." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="Action" value="Submit Form">
			</td>
		</tr>
		</table>
		</form>
	</div>
</div>
<div id="joinImage"></div>

<!-- END Include contact.php -->