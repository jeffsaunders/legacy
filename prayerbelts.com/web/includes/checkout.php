<!-- BEGIN Include checkout.php -->



<?

// If the cart is empty, go back to the cart page

if (!$_SESSION['Item0']){

//	header("Location: /?sec=cart");

?>	

<script>

	window.location = "/?sec=cart";

</script>

<?

}

?>



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

	ltrcheck = /\D/ //Regular expression for NON-digit (letter)

	crcheck = /\cM/ //Regular expression ctrl-M (enter)

	if (crcheck.test(keychar)) o.blur();

	return !ltrcheck.test(keychar) //Return true if not a letter

//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter

}

</script>



<div id="checkout">

	<div id="checkoutHeadline">Checkout</div>

<?

$step = $_REQUEST['step'];

if (!$step || $step == 1){

?>

	<div id="checkoutTagline">Step 1 of our 2-Step Checkout Process</div>

	<div id="checkoutText">

		<!-- Form Validation Scripts -->

		<script src="js/FormValidation.js" type="text/javascript"></script>



		<form action="" method="POST" name="OrderForm" id="OrderForm" onSubmit="return validateOrder(this);">

		<table border="0" cellspacing="10" cellpadding="5" align="center">

		<tr>

			<td colspan="6">Please enter the following information.  After clicking "Proceed" you will be connected to the First Data Global Gateway Secure Payment System to enter and process your credit/debit card.</td>

		</tr>

		<tr>

			<td align="right" bgcolor="#E8E8E8"><strong>Email Address:</strong></td>

			<td colspan="5">

				<input type="text" name="email" id="email" size="40" tabindex="1" value="<?=$_SESSION['Email'];?>" style="width:320px;">

				<em>* Your Order Confirmation Will Be Sent Here</em>

			</td>

		</tr>

		<tr> 

			<td width="300" align="right" bgcolor="#E8E8E8"><strong>First Name:</strong></td>

			<td width="100"><input type="text" name="first_name" id="first_name" maxlength="50" tabindex="3" value="<?=$_SESSION['FirstName'];?>" style="width:150px;"></td>

			<td width="75" align="right" bgcolor="#E8E8E8"><strong>Initial:</strong></td>

			<td width="50"><input type="text" name="mi" id="mi" size="4" maxlength="2" tabindex="4" value="<?=$_SESSION['MiddleName'];?>" style="width:50px;"></td>

			<td width="75" align="right" bgcolor="#E8E8E8"><strong>Last Name:</strong></td>

			<td width="200"><input type="text" name="last_name" id="last_name" maxlength="50" tabindex="5" value="<?=$_SESSION['LastName'];?>" style="width:150px;"></td>

		</tr>

		<tr>

			<td height="2" colspan="6" bgcolor="#C0C0C0"></td>

		</tr>

		<tr>

			<td align="right" bgcolor="#E8E8E8"><strong>Shipping Address:</strong></td>

			<td colspan="3">

				<input type="text" name="shipping_address" id="shipping_address" size="35" maxlength="100" tabindex="6" value="<?=$_SESSION['ShippingAddress'];?>" style="width:320px;">

			</td>

			<td align="right" bgcolor="#E8E8E8"><strong>Suite/Apt#:</strong></td>

			<td><input type="text" name="shipping_apt" id="shipping_apt" maxlength="25" tabindex="7" value="<?=$_SESSION['ShippingApt'];?>" style="width:150px;"></td>

		</tr>

		<tr>

			<td align="right" bgcolor="#E8E8E8"><strong>Shipping City:</strong></td>

			<td><input type="text" name="shipping_city" id="shipping_city" maxlength="50" tabindex="8" value="<?=$_SESSION['ShippingCity'];?>" style="width:150px;"></td>

			<td align="right" bgcolor="#E8E8E8"><strong>State:</strong></td>

			<td>

				<select name="shipping_state" id="shipping_state" tabindex="9" style="width:55px;">

					<option value="">-----</option>

					<option value="AL" <? if($_SESSION['ShippingState']=="AL") echo "Selected"; ?>>AL</option>

					<option value="AK" <? if($_SESSION['ShippingState']=="AK") echo "Selected"; ?>>AK</option>

					<option value="AZ" <? if($_SESSION['ShippingState']=="AZ") echo "Selected"; ?>>AZ</option>

					<option value="AR" <? if($_SESSION['ShippingState']=="AR") echo "Selected"; ?>>AR</option>

					<option value="CA" <? if($_SESSION['ShippingState']=="CA") echo "Selected"; ?>>CA</option>

					<option value="CO" <? if($_SESSION['ShippingState']=="CO") echo "Selected"; ?>>CO</option>

					<option value="CT" <? if($_SESSION['ShippingState']=="CT") echo "Selected"; ?>>CT</option>

					<option value="DE" <? if($_SESSION['ShippingState']=="DE") echo "Selected"; ?>>DE</option>

					<option value="DC" <? if($_SESSION['ShippingState']=="DC") echo "Selected"; ?>>DC</option>

					<option value="FL" <? if($_SESSION['ShippingState']=="FL") echo "Selected"; ?>>FL</option>

					<option value="GA" <? if($_SESSION['ShippingState']=="GA") echo "Selected"; ?>>GA</option>

					<option value="HI" <? if($_SESSION['ShippingState']=="HI") echo "Selected"; ?>>HI</option>

					<option value="ID" <? if($_SESSION['ShippingState']=="ID") echo "Selected"; ?>>ID</option>

					<option value="IL" <? if($_SESSION['ShippingState']=="IL") echo "Selected"; ?>>IL</option>

					<option value="IN" <? if($_SESSION['ShippingState']=="IN") echo "Selected"; ?>>IN</option>

					<option value="IA" <? if($_SESSION['ShippingState']=="IA") echo "Selected"; ?>>IA</option>

					<option value="KS" <? if($_SESSION['ShippingState']=="KS") echo "Selected"; ?>>KS</option>

					<option value="KY" <? if($_SESSION['ShippingState']=="KY") echo "Selected"; ?>>KY</option>

					<option value="LA" <? if($_SESSION['ShippingState']=="LA") echo "Selected"; ?>>LA</option>

					<option value="ME" <? if($_SESSION['ShippingState']=="ME") echo "Selected"; ?>>ME</option>

					<option value="MD" <? if($_SESSION['ShippingState']=="MD") echo "Selected"; ?>>MD</option>

					<option value="MA" <? if($_SESSION['ShippingState']=="MA") echo "Selected"; ?>>MA</option>

					<option value="MI" <? if($_SESSION['ShippingState']=="MI") echo "Selected"; ?>>MI</option>

					<option value="MN" <? if($_SESSION['ShippingState']=="MN") echo "Selected"; ?>>MN</option>

					<option value="MS" <? if($_SESSION['ShippingState']=="MS") echo "Selected"; ?>>MS</option>

					<option value="MO" <? if($_SESSION['ShippingState']=="MO") echo "Selected"; ?>>MO</option>

					<option value="MT" <? if($_SESSION['ShippingState']=="MT") echo "Selected"; ?>>MT</option>

					<option value="NE" <? if($_SESSION['ShippingState']=="NE") echo "Selected"; ?>>NE</option>

					<option value="NV" <? if($_SESSION['ShippingState']=="NV") echo "Selected"; ?>>NV</option>

					<option value="NH" <? if($_SESSION['ShippingState']=="NH") echo "Selected"; ?>>NH</option>

					<option value="NJ" <? if($_SESSION['ShippingState']=="NJ") echo "Selected"; ?>>NJ</option>

					<option value="NM" <? if($_SESSION['ShippingState']=="NM") echo "Selected"; ?>>NM</option>

					<option value="NY" <? if($_SESSION['ShippingState']=="NY") echo "Selected"; ?>>NY</option>

					<option value="NC" <? if($_SESSION['ShippingState']=="NC") echo "Selected"; ?>>NC</option>

					<option value="ND" <? if($_SESSION['ShippingState']=="ND") echo "Selected"; ?>>ND</option>

					<option value="OH" <? if($_SESSION['ShippingState']=="OH") echo "Selected"; ?>>OH</option>

					<option value="OK" <? if($_SESSION['ShippingState']=="OK") echo "Selected"; ?>>OK</option>

					<option value="OR" <? if($_SESSION['ShippingState']=="OR") echo "Selected"; ?>>OR</option>

					<option value="PA" <? if($_SESSION['ShippingState']=="PA") echo "Selected"; ?>>PA</option>

					<option value="RI" <? if($_SESSION['ShippingState']=="RI") echo "Selected"; ?>>RI</option>

					<option value="SC" <? if($_SESSION['ShippingState']=="SC") echo "Selected"; ?>>SC</option>

					<option value="SD" <? if($_SESSION['ShippingState']=="SD") echo "Selected"; ?>>SD</option>

					<option value="TN" <? if($_SESSION['ShippingState']=="TN") echo "Selected"; ?>>TN</option>

					<option value="TX" <? if($_SESSION['ShippingState']=="TX") echo "Selected"; ?>>TX</option>

					<option value="UT" <? if($_SESSION['ShippingState']=="UT") echo "Selected"; ?>>UT</option>

					<option value="VT" <? if($_SESSION['ShippingState']=="VT") echo "Selected"; ?>>VT</option>

					<option value="VA" <? if($_SESSION['ShippingState']=="VA") echo "Selected"; ?>>VA</option>

					<option value="WA" <? if($_SESSION['ShippingState']=="WA") echo "Selected"; ?>>WA</option>

					<option value="WV" <? if($_SESSION['ShippingState']=="WV") echo "Selected"; ?>>WV</option>

					<option value="WI" <? if($_SESSION['ShippingState']=="WI") echo "Selected"; ?>>WI</option>

					<option value="WY" <? if($_SESSION['ShippingState']=="WY") echo "Selected"; ?>>WY</option>

				</select>

			</td>

			<td align="right" bgcolor="#E8E8E8"><strong>Zip Code:</strong></td>

			<td>

				<input type="text" name="shipping_zip_code" id="shipping_zip_code" size="10" maxlength="15" tabindex="10" value="<?=$_SESSION['ShippingZipCode'];?>" onKeyPress="return onlyNumbers(event,this);">

			</td>

		</tr>

		<tr>

			<td height="2" colspan="6" bgcolor="#C0C0C0"></td>

		</tr>

		<script>

		function CopyShippingToBilling(){

			document.forms[0].billing_address.value = document.forms[0].shipping_address.value;

			document.forms[0].billing_apt.value = document.forms[0].shipping_apt.value;

			document.forms[0].billing_city.value = document.forms[0].shipping_city.value;

			document.forms[0].billing_state.value = document.forms[0].shipping_state.value;

			document.forms[0].billing_zip_code.value = document.forms[0].shipping_zip_code.value;

			return;

		}

		</script>

		<tr>

			<td align="right" bgcolor="#E8E8E8">

				<strong>Billing Address:</strong><br>

				<span class="smallBlack"><a href="javascript:CopyShippingToBilling();">Click to Copy Shipping Address</a>&nbsp;</span>						

			</td>

			<td colspan="3">

				<input type="text" name="billing_address" id="billing_address" size="35" maxlength="100" tabindex="11" value="<?=$_SESSION['BillingAddress'];?>" style="width:320px;">

			</td>

			<td align="right" bgcolor="#E8E8E8"><strong>Suite/Apt#:</strong></td>

			<td><input type="text" name="billing_apt" id="billing_apt" maxlength="25" tabindex="12" value="<?=$_SESSION['BillingApt'];?>" style="width:150px;"></td>

		</tr>

		<tr>

			<td align="right" bgcolor="#E8E8E8"><strong>Billing City:</strong></td>

			<td><input type="text" name="billing_city" id="billing_city" maxlength="50" tabindex="13" value="<?=$_SESSION['BillingCity'];?>" style="width:150px;"></td>

			<td align="right" bgcolor="#E8E8E8"><strong>State:</strong></td>

			<td>

				<select name="billing_state" id="billing_state" tabindex="14" style="width:55px;">

					<option value="">-----</option>

					<option value="AL" <? if($_SESSION['BillingState']=="AL") echo "Selected"; ?>>AL</option>

					<option value="AK" <? if($_SESSION['BillingState']=="AK") echo "Selected"; ?>>AK</option>

					<option value="AZ" <? if($_SESSION['BillingState']=="AZ") echo "Selected"; ?>>AZ</option>

					<option value="AR" <? if($_SESSION['BillingState']=="AR") echo "Selected"; ?>>AR</option>

					<option value="CA" <? if($_SESSION['BillingState']=="CA") echo "Selected"; ?>>CA</option>

					<option value="CO" <? if($_SESSION['BillingState']=="CO") echo "Selected"; ?>>CO</option>

					<option value="CT" <? if($_SESSION['BillingState']=="CT") echo "Selected"; ?>>CT</option>

					<option value="DE" <? if($_SESSION['BillingState']=="DE") echo "Selected"; ?>>DE</option>

					<option value="DC" <? if($_SESSION['BillingState']=="DC") echo "Selected"; ?>>DC</option>

					<option value="FL" <? if($_SESSION['BillingState']=="FL") echo "Selected"; ?>>FL</option>

					<option value="GA" <? if($_SESSION['BillingState']=="GA") echo "Selected"; ?>>GA</option>

					<option value="HI" <? if($_SESSION['BillingState']=="HI") echo "Selected"; ?>>HI</option>

					<option value="ID" <? if($_SESSION['BillingState']=="ID") echo "Selected"; ?>>ID</option>

					<option value="IL" <? if($_SESSION['BillingState']=="IL") echo "Selected"; ?>>IL</option>

					<option value="IN" <? if($_SESSION['BillingState']=="IN") echo "Selected"; ?>>IN</option>

					<option value="IA" <? if($_SESSION['BillingState']=="IA") echo "Selected"; ?>>IA</option>

					<option value="KS" <? if($_SESSION['BillingState']=="KS") echo "Selected"; ?>>KS</option>

					<option value="KY" <? if($_SESSION['BillingState']=="KY") echo "Selected"; ?>>KY</option>

					<option value="LA" <? if($_SESSION['BillingState']=="LA") echo "Selected"; ?>>LA</option>

					<option value="ME" <? if($_SESSION['BillingState']=="ME") echo "Selected"; ?>>ME</option>

					<option value="MD" <? if($_SESSION['BillingState']=="MD") echo "Selected"; ?>>MD</option>

					<option value="MA" <? if($_SESSION['BillingState']=="MA") echo "Selected"; ?>>MA</option>

					<option value="MI" <? if($_SESSION['BillingState']=="MI") echo "Selected"; ?>>MI</option>

					<option value="MN" <? if($_SESSION['BillingState']=="MN") echo "Selected"; ?>>MN</option>

					<option value="MS" <? if($_SESSION['BillingState']=="MS") echo "Selected"; ?>>MS</option>

					<option value="MO" <? if($_SESSION['BillingState']=="MO") echo "Selected"; ?>>MO</option>

					<option value="MT" <? if($_SESSION['BillingState']=="MT") echo "Selected"; ?>>MT</option>

					<option value="NE" <? if($_SESSION['BillingState']=="NE") echo "Selected"; ?>>NE</option>

					<option value="NV" <? if($_SESSION['BillingState']=="NV") echo "Selected"; ?>>NV</option>

					<option value="NH" <? if($_SESSION['BillingState']=="NH") echo "Selected"; ?>>NH</option>

					<option value="NJ" <? if($_SESSION['BillingState']=="NJ") echo "Selected"; ?>>NJ</option>

					<option value="NM" <? if($_SESSION['BillingState']=="NM") echo "Selected"; ?>>NM</option>

					<option value="NY" <? if($_SESSION['BillingState']=="NY") echo "Selected"; ?>>NY</option>

					<option value="NC" <? if($_SESSION['BillingState']=="NC") echo "Selected"; ?>>NC</option>

					<option value="ND" <? if($_SESSION['BillingState']=="ND") echo "Selected"; ?>>ND</option>

					<option value="OH" <? if($_SESSION['BillingState']=="OH") echo "Selected"; ?>>OH</option>

					<option value="OK" <? if($_SESSION['BillingState']=="OK") echo "Selected"; ?>>OK</option>

					<option value="OR" <? if($_SESSION['BillingState']=="OR") echo "Selected"; ?>>OR</option>

					<option value="PA" <? if($_SESSION['BillingState']=="PA") echo "Selected"; ?>>PA</option>

					<option value="RI" <? if($_SESSION['BillingState']=="RI") echo "Selected"; ?>>RI</option>

					<option value="SC" <? if($_SESSION['BillingState']=="SC") echo "Selected"; ?>>SC</option>

					<option value="SD" <? if($_SESSION['BillingState']=="SD") echo "Selected"; ?>>SD</option>

					<option value="TN" <? if($_SESSION['BillingState']=="TN") echo "Selected"; ?>>TN</option>

					<option value="TX" <? if($_SESSION['BillingState']=="TX") echo "Selected"; ?>>TX</option>

					<option value="UT" <? if($_SESSION['BillingState']=="UT") echo "Selected"; ?>>UT</option>

					<option value="VT" <? if($_SESSION['BillingState']=="VT") echo "Selected"; ?>>VT</option>

					<option value="VA" <? if($_SESSION['BillingState']=="VA") echo "Selected"; ?>>VA</option>

					<option value="WA" <? if($_SESSION['BillingState']=="WA") echo "Selected"; ?>>WA</option>

					<option value="WV" <? if($_SESSION['BillingState']=="WV") echo "Selected"; ?>>WV</option>

					<option value="WI" <? if($_SESSION['BillingState']=="WI") echo "Selected"; ?>>WI</option>

					<option value="WY" <?// if($_SESSION['BillingState']=="WY") echo "Selected"; ?>>WY</option>

				</select>

			</td>

			<td align="right" bgcolor="#E8E8E8"><strong>Zip Code:</strong></td>

			<td>

				<input type="text" name="billing_zip_code" id="billing_zip_code" size="10" maxlength="15" tabindex="15" value="<?=$_SESSION['BillingZipCode'];?>" onKeyPress="return onlyNumbers(event,this);">

			</td>

		</tr>

		<tr>

			<td height="2" colspan="6" bgcolor="#C0C0C0"></td>

		</tr>

		<tr>

			<td colspan="6" align="center">

				<table width="100%" border="0">
				  <tr>
				    <td width="11%" align="left"><img src="../images/lock.gif" width="125" height="60" alt="Secure checkout" /></td>
				    <td width="89%" align="center"><input type="hidden" name="step" id="step" value="2" />
                    <input type="submit" name="Submit" id="Submit" value="Proceed to Step 2" /></td>
			      </tr>
			  </table></td>

		</tr>

		</table>

		</form>

	</div>

<?

}else{

	// Write form information to session variables

	$_SESSION['Email'] = $_REQUEST['email'];

	$_SESSION['FirstName'] = $_REQUEST['first_name'];

	$_SESSION['MiddleName'] = $_REQUEST['mi'];

	$_SESSION['LastName'] = $_REQUEST['last_name'];

	$_SESSION['ShippingAddress'] = $_REQUEST['shipping_address'];

	$_SESSION['ShippingApt'] = $_REQUEST['shipping_apt'];

	$_SESSION['ShippingCity'] = $_REQUEST['shipping_city'];

	$_SESSION['ShippingState'] = $_REQUEST['shipping_state'];

	$_SESSION['ShippingZipCode'] = $_REQUEST['shipping_zip_code'];

	$_SESSION['BillingAddress'] = $_REQUEST['billing_address'];

	$_SESSION['BillingApt'] = $_REQUEST['billing_apt'];

	$_SESSION['BillingCity'] = $_REQUEST['billing_city'];

	$_SESSION['BillingState'] = $_REQUEST['billing_state'];

	$_SESSION['BillingZipCode'] = $_REQUEST['billing_zip_code'];

	// ...and load up an iFrame containing the FDGG charge forms

?>

	<div id="checkoutTagline">Your are now connected to the First Data Global Gateway Secure Payment System<br /><img src="../images/lock-45.gif" width="94" height="45" alt="Secure Checkout" /></div>

	<div id="checkoutIFrame">

		<iframe src="fdgg.php" name="checkoutFrame" id="checkoutFrame" width="820" height="700" frameborder="0"></iframe>

	</div>

<?

}

?>

</div>



<!-- END Include checkout.php -->

