<!-- BEGIN INCLUDE reservations -->

<?
if (!$feature || $feature < 1 || $feature > 4) $feature = "1";
$cargo = $feature;
$SID = $_SESSION['SID'];
//echo $_SESSION['SID'];
/*
if ($_REQUEST['Test'] != "T"){
	// set cargo if passed value is invalid
	if (!$feature || $feature < 1 || $feature > 4) $feature = "1";

	// test for session id; if none or mismatch they deep-linked, force them to start new reservation
	if ($feature != "1") $SID = $_REQUEST['SID'];
//echo $SID;
//	if (!$SID){ echo'<script>window.location="https://secure.nr.net/littlechurchlv/?sec=reservations&cargo=1";</script>'; exit;}
	if (!$SID){ echo'<script>window.location="http://refresh.littlechurchlv.com/index/reservations";</script>'; exit;}
}
//echo $SID."<br>";
//echo $cargo."<br>";
*/
?>

<!-- SSL Site Seal -->
<script language="JavaScript" src="https://secure.comodo.net/trustlogo/javascript/trustlogo.js" type="text/javascript"></script>

<!-- Common Scripts -->
<script language="JavaScript" src="timedate.js" type="text/javascript"></script><!-- Time and Date Math Functions -->

<!-- Custom Scripts -->
<script language="JavaScript" src="validate.js" type="text/javascript"></script>
<script>document.getElementById('mainTD').style.backgroundImage='URL(images/ResvBG3.jpg)';</script>

<script>
// Ask them what time they want their ceremony if they don't select one of the canned choices
function popTime(choice){
	if (choice == "Other") {
		time = prompt("Please enter desired start time","");
		document.Step2.altTime.value=time;
		if (document.Step2.altTime.value == ""){ //They left it blank
			alert("Please Enter A Time");
			popTime("Other");
		}
	}
	// If they choose a time before 10am or after 10pm disable the packages - per Rachel
/*	if (Step2.ResTimeFrom.value == "8:00 AM" || Step2.ResTimeFrom.value == "8:30 AM" || Step2.ResTimeFrom.value == "9:00 AM" || Step2.ResTimeFrom.value == "9:30 AM" || Step2.ResTimeFrom.value == "10:00 PM" || Step2.ResTimeFrom.value == "10:30 PM" || Step2.ResTimeFrom.value == "11:00 PM" || Step2.ResTimeFrom.value == "11:30 PM"){
	<?
	$query = "SELECT * FROM packages WHERE (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T' ORDER BY position";
	$RSPackages = mysql_query($query, $linkID);
	for ($counter=1; $counter <= mysql_num_rows($RSPackages); $counter++){
		$pkg = mysql_fetch_assoc($RSPackages);
	?>
		document.getElementById("Package<?=$counter;?>").disabled = true;
		document.getElementById("Other Arrangements").selected = true;
	<?
	}
	?>
	}else{
	<?
	mysql_data_seek($RSPackages,0);
	for ($counter=1; $counter <= mysql_num_rows($RSPackages); $counter++){
		$pkg = mysql_fetch_assoc($RSPackages);
	?>
		document.getElementById("Package<?=$counter;?>").disabled = false;
//		document.getElementById("Select Package").selected = true;
	<?
	}
	?>
	}
*/	return true;
}

// BEGIN KEYCHECK FUNCTIONS ---

// Only accept letters, no numbers
function noNumbers(e){
	var keynum
	var keychar
	var numcheck
	var crcheck
	if(window.event){ // IE
		keynum = e.keyCode
	}else if(e.which){ // Netscape/Firefox/Opera
		keynum = e.which
	}
	keychar = String.fromCharCode(keynum)
	numcheck = /\d/ //Regular expression for digit (number)
	crcheck = /\cM/ //Regular expression ctrl-M (enter)
//	return !numcheck.test(keychar) //Return true if not a digit
	return (!numcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a digit OR enter
}

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
	if (keynum == 08 || keynum == 46 || keynum == 13 || !keynum) return true; // Backspace, decimal point, enter, or navigation (arrow) key
	keychar = String.fromCharCode(keynum)
//alert(keychar);
	ltrcheck = /\D/ //Regular expression for NON-digit (letter)
	crcheck = /\cM/ //Regular expression ctrl-M (enter)
	if (crcheck.test(keychar)) o.blur();
	return !ltrcheck.test(keychar) //Return true if not a letter
//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
}

// END KEYCHECK FUNCTIONS ---

// This function disables certain time frames from the reservations on a certain day
// Right now it's hard coded to remove the first 29 choices on Valentine's Day
// Could be made more flexible, but it's a kludge for now...
function disableTimes(){
	if(document.Step2.ResMonth.selectedIndex == 2 && document.Step2.ResDay.selectedIndex == 14 && document.Step2.ResYear.selectedIndex == 1){
		for (counter=1; counter <= 29; counter=counter+1){
			document.Step2.ResTimeFrom.remove(1);
		}
		document.Step2.ResTimeFrom.selectedIndex = 0;
//	}else{  //change it back - left this out for this kludge
//		for (counter=1; counter <= 29; counter=counter+1){
//			document.Step2.ResTimeFrom.options[1] = new Option('label','value');
// Example-> document.Step2.ResTimeFrom.options[1] = new Option('From 8:00 To 8:30 AM','8:00 AM');
//		}
	}
}
</script>

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900WhiteBGTop.png"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900WhiteBGMiddle.png">



<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<?
	if ($feature == "1") $pad = 550;
	if ($feature == "2") $pad = 1;
	if ($feature == "3") $pad = 550;
	if ($feature == "4") $pad = 1;
	?>
	<td rowspan="99"><img src="images/spacer.gif" alt="" width="0" height="<?=iif($feature == "1", 550, 1);?>" border="0"></td>
	<td valign="top" class="bodyBlack">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td colspan="3" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td rowspan="2"><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
					<td valign="top" class="xbigBlack">
						<img src="images/spacer.gif" alt="" width="1" height="14" border="0"><br>
						<strong>Secure Online Reservations</strong>
					</td>
					<?
					if ($feature < 4){
						echo'<td align="center" valign="top"><img src="images/Step'.$feature.'.png" alt="" width="300" height="50" border="0"></td>';
					}else{
						echo'<td align="center" valign="top"><img src="images/Complete.png" alt="" width="300" height="50" border="0"></td>';
					}
					?>
					<!-- Site Seal -->
					<td rowspan="2" valign="top"><script type="text/javascript">TrustLogo("images/SiteSeal.jpg", "SC","none");</script></td>
				</tr>
				<tr>
					<td colspan="2" class="bigBlack">
						<br>
						<img src="images/spacer.gif" alt="" width="15" height="1" border="0">
						<strong>Booking your reservation is easy - follow our simple 3-step process.<br><br></strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="35" height="1" border="0"></td>
			<td>
				<ul>
					<li>If you would prefer to make reservations via telephone, please call toll-free <strong>800.821.2452</strong><br>(<strong>702.739.7971</strong> inside Nevada &amp; International) between 8:00 AM and 12:00 Midnight Pacific Time, daily.<br><strong><strong><nobr>Current Las Vegas Time is:&nbsp;&nbsp;<? include("./LVClock.js"); ?></nobr></strong></strong></li>
				</ul>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
		</tr>
		<?
		//Grab existing reservation info, if it exists
		$query = "SELECT * FROM reservations WHERE SessionID='".$SID."'";
//echo $query;
		$rs_reservation = mysql_query($query, $linkID);
		$row = mysql_fetch_assoc($rs_reservation);
//print_r($row);
		if ($cargo == "1"){
// STEP 1 *********************************
			echo'
		<tr>
			<td><img src="images/spacer.gif" alt="" width="35" height="1" border="0"></td>
			<td>
			';
		// USA or Canada Address
//		if (stristr($navigator_user_agent, "msiexx")){
//			echo'
//				<div id="USA" style="position:absolute; top:450; left:175; z-index:0; visibility:visible">
//			';
//		}elseif  (stristr($navigator_user_agent, "firefox")){
//			echo'
//				<div id="USA" style="position:absolute; top:460; left:110; z-index:0; visibility:visible">
//			';
//		}elseif  (stristr($navigator_user_agent, "netscape")){
//			echo'
//				<div id="USA" style="position:absolute; top:460; left:110; z-index:0; visibility:visible">
//			';
//		}elseif  (stristr($navigator_user_agent, "opera")){
//			echo'
//				<div id="USA" style="position:absolute; top:460; left:110; z-index:0; visibility:visible">
//			';
//		}else{
			echo'
				<div id="USA" style="position:absolute; top:480; left:110; z-index:0; visibility:visible">
			';
//		}
			echo'
					<form action="" method="post" name="Step1u" id="Step1u" onSubmit="return validate(this);">
					<table width="735" border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
					<tr>
						<td colspan="3" align="center" class="xbigBlack"><strong>Your Contact Information<br><a href="javascript:hide(\'USA\');show(\'Intl\');" onBlur="javascript:document.forms[\'Step1i\'].ResName.focus();" class="smallBlack">* CLICK HERE IF OUTSIDE USA OR CANADA *</a></strong><br><img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br></td>
					</tr>
					<tr>
						<td valign="top">
							<table width="365" border="0" cellpadding="5">
							<tr>
								<td width="160" align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Your Name:</strong>
								</td>
								<td width="205" valign="top">
									<input type="text" name="ResName" id="ResName" size="22" maxlength="30" tabindex="1" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResName'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Relationship:</strong>
								</td>
								<td valign="top">
									<select name="ResRelation" id="ResRelation" tabindex="2" class="bigBlack" style="background-color:#ECEADC; width:195px;">
										<option value="">Select From List</option>
										<option value="Bride"'.iif($row['ResRelation']=="Bride"," selected","").'>Bride</option>
										<option value="Groom"'.iif($row['ResRelation']=="Groom"," selected","").'>Groom</option>
										<option value="Bride\'s Mother"'.iif($row['ResRelation']=="Bride's Mother"," selected","").'>Bride\'s Mother</option>
										<option value="Bride\'s Father"'.iif($row['ResRelation']=="Bride's Father"," selected","").'>Bride\'s Father</option>
										<option value="Groom\'s Mother"'.iif($row['ResRelation']=="Groom's Mother"," selected","").'>Groom\'s Mother</option>
										<option value="Groom\'s Father"'.iif($row['ResRelation']=="Groom's Father"," selected","").'>Groom\'s Father</option>
										<option value="Bride\'s Sibling"'.iif($row['ResRelation']=="Bride's Sibling"," selected","").'>Bride\'s Sibling</option>
										<option value="Groom\'s Sibling"'.iif($row['ResRelation']=="Groom's Sibling"," selected","").'>Groom\'s Sibling</option>
										<option value="Bride\'s Relative (Other)"'.iif($row['ResRelation']=="Bride's Relative (Other)"," selected","").'>Bride\'s Relative (Other)</option>
										<option value="Groom\'s Relative (Other)"'.iif($row['ResRelation']=="Groom's Relative (Other)"," selected","").'>Groom\'s Relative (Other)</option>
										<option value="Maid of Honor"'.iif($row['ResRelation']=="Maid of Honor"," selected","").'>Maid of Honor</option>
										<option value="Best Man"'.iif($row['ResRelation']=="Best Man"," selected","").'>Best Man</option>
										<option value="Friend"'.iif($row['ResRelation']=="Friend"," selected","").'>Friend</option>
										<option value="Other"'.iif($row['ResRelation']=="Other"," selected","").'>Other</option>
									</select><br>
									<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Email Address:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResEmail" id="ResEmail" size="22" maxlength="50" tabindex="3" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResEmail'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Phone Number:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResHomePhone" id="ResHomePhone" size="22" maxlength="20" tabindex="4" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResHomePhone'].'">
								</td>
							</tr>
							</table>
						</td>
						<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
						<td align="right" valign="top">
							<table width="365" border="0" cellpadding="5">
							<tr>
								<td width="160" align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Address:</strong>
								</td>
								<td width="205">
									<input type="text" name="ResAddress" id="ResAddress" size="22" maxlength="50" tabindex="5" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResAddress'].'"><br>
									<input type="text" name="ResAddress2" id="ResAddress2" size="22" maxlength="50" tabindex="6" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResAddress2'].'"><br>
									<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>City:</strong>
								</td>
								<td>
									<input type="text" name="ResCity" id="ResCity" size="22" maxlength="50" tabindex="7" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCity'].'"><br>
									<img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>State/Province:</strong>
								</td>
								<td>
									<select name="ResState" id="ResState" tabindex="8" class="bigBlack" style="background-color: #ECEADC;">
										<option value="">Select</option>
						                <option value="AL"'.iif($row['ResState']=="AL"," selected","").'>AL</option>
										<option value="AK"'.iif($row['ResState']=="AK"," selected","").'>AK</option>
										<option value="AZ"'.iif($row['ResState']=="AZ"," selected","").'>AZ</option>
										<option value="AR"'.iif($row['ResState']=="AR"," selected","").'>AR</option>
										<option value="CA"'.iif($row['ResState']=="CA"," selected","").'>CA</option>
										<option value="CO"'.iif($row['ResState']=="CO"," selected","").'>CO</option>
										<option value="CT"'.iif($row['ResState']=="CT"," selected","").'>CT</option>
										<option value="DE"'.iif($row['ResState']=="DE"," selected","").'>DE</option>
										<option value="DC"'.iif($row['ResState']=="DC"," selected","").'>DC</option>
										<option value="FL"'.iif($row['ResState']=="FL"," selected","").'>FL</option>
										<option value="GA"'.iif($row['ResState']=="GA"," selected","").'>GA</option>
										<option value="HI"'.iif($row['ResState']=="HI"," selected","").'>HI</option>
										<option value="ID"'.iif($row['ResState']=="ID"," selected","").'>ID</option>
										<option value="IL"'.iif($row['ResState']=="IL"," selected","").'>IL</option>
										<option value="IN"'.iif($row['ResState']=="IN"," selected","").'>IN</option>
										<option value="IA"'.iif($row['ResState']=="IA"," selected","").'>IA</option>
										<option value="KS"'.iif($row['ResState']=="KS"," selected","").'>KS</option>
										<option value="KY"'.iif($row['ResState']=="KY"," selected","").'>KY</option>
										<option value="LA"'.iif($row['ResState']=="LA"," selected","").'>LA</option>
										<option value="ME"'.iif($row['ResState']=="ME"," selected","").'>ME</option>
										<option value="MD"'.iif($row['ResState']=="MD"," selected","").'>MD</option>
										<option value="MA"'.iif($row['ResState']=="MA"," selected","").'>MA</option>
										<option value="MI"'.iif($row['ResState']=="MI"," selected","").'>MI</option>
										<option value="MN"'.iif($row['ResState']=="MN"," selected","").'>MN</option>
										<option value="MS"'.iif($row['ResState']=="MS"," selected","").'>MS</option>
										<option value="MO"'.iif($row['ResState']=="MO"," selected","").'>MO</option>
										<option value="MT"'.iif($row['ResState']=="MT"," selected","").'>MT</option>
										<option value="NE"'.iif($row['ResState']=="NE"," selected","").'>NE</option>
										<option value="NV"'.iif($row['ResState']=="NV"," selected","").'>NV</option>
										<option value="NH"'.iif($row['ResState']=="NH"," selected","").'>NH</option>
										<option value="NJ"'.iif($row['ResState']=="NJ"," selected","").'>NJ</option>
										<option value="NM"'.iif($row['ResState']=="NM"," selected","").'>NM</option>
										<option value="NY"'.iif($row['ResState']=="NY"," selected","").'>NY</option>
										<option value="NC"'.iif($row['ResState']=="NC"," selected","").'>NC</option>
										<option value="ND"'.iif($row['ResState']=="ND"," selected","").'>ND</option>
										<option value="OH"'.iif($row['ResState']=="OH"," selected","").'>OH</option>
										<option value="OK"'.iif($row['ResState']=="OK"," selected","").'>OK</option>
										<option value="OR"'.iif($row['ResState']=="OR"," selected","").'>OR</option>
										<option value="PA"'.iif($row['ResState']=="PA"," selected","").'>PA</option>
										<option value="RI"'.iif($row['ResState']=="RI"," selected","").'>RI</option>
										<option value="SC"'.iif($row['ResState']=="SC"," selected","").'>SC</option>
										<option value="SD"'.iif($row['ResState']=="SD"," selected","").'>SD</option>
										<option value="TN"'.iif($row['ResState']=="TN"," selected","").'>TN</option>
										<option value="TX"'.iif($row['ResState']=="TX"," selected","").'>TX</option>
										<option value="UT"'.iif($row['ResState']=="UT"," selected","").'>UT</option>
										<option value="VT"'.iif($row['ResState']=="VT"," selected","").'>VT</option>
										<option value="VA"'.iif($row['ResState']=="VA"," selected","").'>VA</option>
										<option value="WA"'.iif($row['ResState']=="WA"," selected","").'>WA</option>
										<option value="WV"'.iif($row['ResState']=="WV"," selected","").'>WV</option>
										<option value="WI"'.iif($row['ResState']=="WI"," selected","").'>WI</option>
										<option value="WY"'.iif($row['ResState']=="WY"," selected","").'>WY</option>
										<option value = "" disabled>----</option>
										<option value="AB"'.iif($row['ResState']=="AB"," selected","").'>AB</option>
										<option value="BC"'.iif($row['ResState']=="BC"," selected","").'>BC</option>
										<option value="MB"'.iif($row['ResState']=="MB"," selected","").'>MB</option>
										<option value="NB"'.iif($row['ResState']=="NB"," selected","").'>NB</option>
										<option value="NL"'.iif($row['ResState']=="NL"," selected","").'>NL</option>
										<option value="NS"'.iif($row['ResState']=="NS"," selected","").'>NS</option>
										<option value="NT"'.iif($row['ResState']=="NT"," selected","").'>NT</option>
										<option value="NU"'.iif($row['ResState']=="NU"," selected","").'>NU</option>
										<option value="ON"'.iif($row['ResState']=="ON"," selected","").'>ON</option>
										<option value="PE"'.iif($row['ResState']=="PE"," selected","").'>PE</option>
										<option value="QC"'.iif($row['ResState']=="QC"," selected","").'>QC</option>
										<option value="SK"'.iif($row['ResState']=="SK"," selected","").'>SK</option>
										<option value="YT"'.iif($row['ResState']=="YT"," selected","").'>YT</option>
									</select><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
									<strong>Zip/Postal Code:</strong>
								</td>
								<td valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
									<input type="text" name="ResZip" id="ResZip" size="7" maxlength="10" tabindex="9" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResZip'].'">
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<input type="hidden" name="sec" id="sec" value="reservations">
							<input type="hidden" name="feature" id="feature" value="2">
							<input type="hidden" name="Test" id="Test" value="'.IIf($_REQUEST['Test'] != "", "T", "F").'">
							<input type="hidden" name="SID" id="SID" value="'.$SID.'">
							<br><br><br>
							<input type="submit" name="submit1" id="submit1" value="Proceed to Step 2"></td>
					</tr>
					</table>
					</form>
					<!-- Put cursor in first field -->
					<script>document.forms[\'Step1u\'].ResName.focus();</script>
				</div>
			';
		// International Address
//		if (stristr($navigator_user_agent, "msie")){
//			echo'
//				<div id="Intl" style="position:absolute; top:250; left:175; z-index:1; visibility:hidden">
//			';
//		}elseif (stristr($navigator_user_agent, "firefox")){
//			echo'
//				<div id="Intl" style="position:absolute; top:250; left:150; z-index:1; visibility:hidden">
//			';
//		}elseif (stristr($navigator_user_agent, "netscape")){
//			echo'
//				<div id="Intl" style="position:absolute; top:250; left:175; z-index:1; visibility:hidden">
//			';
//		}elseif (stristr($navigator_user_agent, "opera")){
//			echo'
//				<div id="Intl" style="position:absolute; top:269; left:550; z-index:1; visibility:hidden">
//			';
//		}else{
			echo'
				<div id="Intl" style="position:absolute; top:480; left:110; z-index:1; visibility:hidden">
			';
//		}
			echo'
					<form action="" method="post" name="Step1i" id="Step1i" onSubmit="return validate(this);">
					<table width="735" border="0" cellspacing="0" cellpadding="0" align="center" class="bigBlack">
					<tr>
						<td colspan="3" align="center" class="xbigBlack"><strong>Your Contact Information<br><a href="javascript:hide(\'Intl\');show(\'USA\');" onBlur="javascript:document.forms[\'Step1u\'].ResName.focus();" class="smallBlack">* CLICK HERE IF INSIDE USA OR CANADA *</a></strong><br><img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br></td>
					</tr>
					<tr>
						<td valign="top">
							<table width="365" border="0" cellpadding="5">
							<tr>
								<td width="160" align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Your Name:</strong>
								</td>
								<td width="205" valign="top">
									<input type="text" name="ResName" id="ResName" size="22" maxlength="30" tabindex="1" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResName'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Relationship:</strong>
								</td>
								<td valign="top">
									<select name="ResRelation" id="ResRelation" tabindex="2" class="bigBlack" style="background-color:#ECEADC; width:195px;">
										<option value="">Select From List</option>
										<option value="Bride"'.iif($row['ResRelation']=="Bride"," selected","").'>Bride</option>
										<option value="Groom"'.iif($row['ResRelation']=="Groom"," selected","").'>Groom</option>
										<option value="Bride\'s Mother"'.iif($row['ResRelation']=="Bride's Mother"," selected","").'>Bride\'s Mother</option>
										<option value="Bride\'s Father"'.iif($row['ResRelation']=="Bride's Father"," selected","").'>Bride\'s Father</option>
										<option value="Groom\'s Mother"'.iif($row['ResRelation']=="Groom's Mother"," selected","").'>Groom\'s Mother</option>
										<option value="Groom\'s Father"'.iif($row['ResRelation']=="Groom's Father"," selected","").'>Groom\'s Father</option>
										<option value="Bride\'s Sibling"'.iif($row['ResRelation']=="Bride's Sibling"," selected","").'>Bride\'s Sibling</option>
										<option value="Groom\'s Sibling"'.iif($row['ResRelation']=="Groom's Sibling"," selected","").'>Groom\'s Sibling</option>
										<option value="Bride\'s Relative (Other)"'.iif($row['ResRelation']=="Bride's Relative (Other)"," selected","").'>Bride\'s Relative (Other)</option>
										<option value="Groom\'s Relative (Other)"'.iif($row['ResRelation']=="Groom's Relative (Other)"," selected","").'>Groom\'s Relative (Other)</option>
										<option value="Maid of Honor"'.iif($row['ResRelation']=="Maid of Honor"," selected","").'>Maid of Honor</option>
										<option value="Best Man"'.iif($row['ResRelation']=="Best Man"," selected","").'>Best Man</option>
										<option value="Friend"'.iif($row['ResRelation']=="Friend"," selected","").'>Friend</option>
										<option value="Other"'.iif($row['ResRelation']=="Other"," selected","").'>Other</option>
									</select><br>
									<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Email Address:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResEmail" id="ResEmail" size="22" maxlength="50" tabindex="3" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResEmail'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Phone Number:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResHomePhone" id="ResHomePhone" size="22" maxlength="20" tabindex="4" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResHomePhone'].'">
								</td>
							</tr>
							</table>
						</td>
						<td><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
						<td align="right" valign="top">
							<table width="365" border="0" cellpadding="5" align="right">
							<tr>
								<td width="160" align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Address:</strong>
								</td>
								<td width="205">
									<input type="text" name="ResAddress" id="ResAddress" size="22" maxlength="50" tabindex="5" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResAddress'].'"><br>
									<input type="text" name="ResAddress2" id="ResAddress2" size="22" maxlength="50" tabindex="6" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResAddress2'].'"><br>
									<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>City:</strong>
								</td>
								<td>
									<input type="text" name="ResCity" id="ResCity" size="22" maxlength="50" tabindex="7" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCity'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>State/Province:</strong>
								</td>
								<td>
									<input type="text" name="ResState" id="ResState" size="22" maxlength="20" tabindex="8" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResState'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Postal Code:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResZip" id="ResZip" size="22" maxlength="20" tabindex="9" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResZip'].'">
								</td>
							</tr>
							<tr>
								<td align="right" valign="top">
									<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
									<strong>Country:</strong>
								</td>
								<td valign="top">
									<input type="text" name="ResCountry" id="ResCountry" size="22" maxlength="30" tabindex="10" class="bigBlack" style="background-color: #ECEADC;" value="'.iif($row['ResCountry']=="USA"||$row['ResCountry']=="Canada","",$row['ResCountry']).'">
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center">
							<input type="hidden" name="sec" id="sec" value="reservations">
							<input type="hidden" name="feature" id="feature" value="2">
							<input type="hidden" name="Test" id="Test" value="'.IIf($_REQUEST['Test'] != "", "T", "F").'">
							<input type="hidden" name="SID" id="SID" value="'.$SID.'">
			';
		// Spacer for button - distance depends on browser
//echo $navigator_user_agent;
		if (stristr($navigator_user_agent, "msie")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="17" border="0"><br>
			';
		}elseif (stristr($navigator_user_agent, "firefox")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="23" border="0"><br>
			';
		}elseif (stristr($navigator_user_agent, "netscape")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="23" border="0"><br>
			';
		}elseif (stristr($navigator_user_agent, "opera")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="17" border="0"><br>
			';
		}elseif (stristr($navigator_user_agent, "chrome")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="17" border="0"><br>
			';
		}elseif (stristr($navigator_user_agent, "safari")){
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="19" border="0"><br>
			';
		}else{
			echo'
							<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
			';
		}
			echo'
							<input type="submit" name="submit1" id="submit1" value="Proceed to Step 2"></td>
					</tr>
					</table>
					</form>
					<!-- Put cursor in first field -->
					<script>document.forms[\'Step1i\'].ResName.focus();</script>
				</div>
			</td>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
		</tr>
		<!-- Put the cursor in the Name field of the USA form by default -->
		<script>document.forms[\'Step1u\'].ResName.focus();</script>
			';
		}elseif ($cargo == "2"){
// STEP 2 *********************************
			// Store what we have so far...
			// delete a previous reservation made during this session if one exists
			// should be made to look for a previous reservation with this same SID and, if found, update it...if not insert a new one.
			// but deleting it and starting over was specifically requested.  *shrug*

			$query = "DELETE FROM reservations WHERE SessionID='".$_REQUEST['SID']."'";
			$result = mysql_query($query, $linkID);

			// Start new reservation & insert values from Step 1
			// but first, assign "country" to what they entered, if they used the INTL form
			$country = $_REQUEST['ResCountry'];

			// or determine if they are from the US or Canada
			if ($country == ""){
				// set "country" to "Canada" if US/CDN form was submitted and a CDN province was selected
				$provinces = array('dummy','AB','BC','MB','NB','NL','NS','NT','NU','ON','PE','QC','SK','YT');
				if (array_search($_REQUEST['ResState'], $provinces) > 0){
					$country = "Canada";
				// or "USA" of not
				}else{
					$country = "USA";
				}
			}

			// and grab the user's IP address
			$IpAddress = getenv('REMOTE_ADDR');

			// Now save it!
			// Note to anyone who may care in the future - this database schema and column naming convention is inherited from the original Cold Fusion site, misspellings and improper grammar included.  "ResPackagedDesired" - SHEESH!!
			// For consistency (and sanity) I continued with the "ResXX" theme....
			$query = "INSERT INTO reservations (SessionID, ResNumber, ResName, ResEmail, ResRelation, ResAddress, ResAddress2, ResCity, ResState, ResZip, ResCountry, ResHomePhone, Step1Time, IpAddress, Test) VALUES ('".$_REQUEST['SID']."', UNIX_TIMESTAMP(), '".$_REQUEST['ResName']."', '".$_REQUEST['ResEmail']."', '".$_REQUEST['ResRelation']."', '".$_REQUEST['ResAddress']."', '".$_REQUEST['ResAddress2']."', '".$_REQUEST['ResCity']."', '".$_REQUEST['ResState']."', '".$_REQUEST['ResZip']."', '$country', '".$_REQUEST['ResHomePhone']."', NOW(), '$IpAddress', '".$_REQUEST['Test']."')";
//echo $query;
			$result = mysql_query($query, $linkID);
			// Set bride or groom name if relationship is "Bride" or "Groom"
			if ($_REQUEST['ResRelation'] == "Bride"){
				$bride = $_REQUEST['ResName'];
			}elseif ($_REQUEST['ResRelation'] == "Groom"){
				$groom = $_REQUEST['ResName'];
			}else{
				$bride = $row['ResBrideName'];
				$groom = $row['ResGroomName'];
			}
			// then look up package choices for DDLB
//			$query = "SELECT * FROM packages WHERE display = 'T' ORDER BY position";
			$query = "SELECT * FROM packages WHERE (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T' ORDER BY position";
			$RSPackages = mysql_query($query, $linkID);
			// and flower style choices
//			$query = "SELECT * FROM packages WHERE display = 'T' AND flowerchoice = 'T' ORDER BY position";
			$query = "SELECT * FROM packages WHERE (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T' AND flowerchoice = 'T' ORDER BY position";
			$RSFlowerChoice = mysql_query($query, $linkID);
			// Now build page
			echo'
		<tr>
			<td colspan="3" align="center">
				<form action="" method="post" name="Step2" id="Step2" onSubmit="return validate(this);">
				<table width="750" border="0" cellspacing="0" cellpadding="5" align="center" class="bigBlack">
				<tr>
					<td colspan="5" align="center" class="xbigBlack"><strong>Your Reservation Information</strong><br><br></td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Bride\'s Name:</strong>
					</td>
					<td width="200" valign="top">
						<input type="text" name="Bride" id="Bride" size="22" maxlength="30" tabindex="1" class="bigBlack" style="background-color: #ECEADC;" value="'.$bride.'">
					</td>
<!--					<td><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>-->
					<td width="125" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Groom\'s Name:</strong>
					</td>
					<td width="210" valign="top">
						<input type="text" name="Groom" id="Groom" size="22" maxlength="30" tabindex="2" class="bigBlack" style="background-color: #ECEADC;" value="'.$groom.'">
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Reservation Date:</strong>
					</td>
			';
			$date = explode(" ",$row['ResDate']);
			// $date[0] = month, $date[1] = day, $date[2] = year
			// $date[1] (day) will include trailing comma, so test for it INCLUDING the comma in the string - easier than spliting the string further.
			echo '
					<td colspan="3" valign="top">
						<select name="ResMonth" id="ResMonth" class="bigBlack" style="background-color:#ECEADC; width:105px;" tabindex="3" onChange="disableTimes();">
							<option value="">Month</option>
							<option value="January"'.iif($date[0]=="January"," selected","").'>January</option>
							<option value="February"'.iif($date[0]=="February"," selected","").'>February</option>
							<option value="March"'.iif($date[0]=="March"," selected","").'>March</option>
							<option value="April"'.iif($date[0]=="April"," selected","").'>April</option>
							<option value="May"'.iif($date[0]=="May"," selected","").'>May</option>
							<option value="June"'.iif($date[0]=="June"," selected","").'>June</option>
							<option value="July"'.iif($date[0]=="July"," selected","").'>July</option>
							<option value="August"'.iif($date[0]=="August"," selected","").'>August</option>
							<option value="September"'.iif($date[0]=="September"," selected","").'>September</option>
							<option value="October"'.iif($date[0]=="October"," selected","").'>October</option>
							<option value="November"'.iif($date[0]=="November"," selected","").'>November</option>
							<option value="December"'.iif($date[0]=="December"," selected","").'>December</option>
						</select>
						<select name="ResDay" id="ResDay" class="bigBlack" style="background-color: #ECEADC; width: 60px;" tabindex="4" onChange="disableTimes();">
							<option value="">Day</option>
							<option value="1"'.iif($date[1]=="1,"," selected","").'>1</option>
							<option value="2"'.iif($date[1]=="2,"," selected","").'>2</option>
							<option value="3"'.iif($date[1]=="3,"," selected","").'>3</option>
							<option value="4"'.iif($date[1]=="4,"," selected","").'>4</option>
							<option value="5"'.iif($date[1]=="5,"," selected","").'>5</option>
							<option value="6"'.iif($date[1]=="6,"," selected","").'>6</option>
							<option value="7"'.iif($date[1]=="7,"," selected","").'>7</option>
							<option value="8"'.iif($date[1]=="8,"," selected","").'>8</option>
							<option value="9"'.iif($date[1]=="9,"," selected","").'>9</option>
							<option value="10"'.iif($date[1]=="10,"," selected","").'>10</option>
							<option value="11"'.iif($date[1]=="11,"," selected","").'>11</option>
							<option value="12"'.iif($date[1]=="12,"," selected","").'>12</option>
							<option value="13"'.iif($date[1]=="13,"," selected","").'>13</option>
							<option value="14"'.iif($date[1]=="14,"," selected","").'>14</option>
							<option value="15"'.iif($date[1]=="15,"," selected","").'>15</option>
							<option value="16"'.iif($date[1]=="16,"," selected","").'>16</option>
							<option value="17"'.iif($date[1]=="17,"," selected","").'>17</option>
							<option value="18"'.iif($date[1]=="18,"," selected","").'>18</option>
							<option value="19"'.iif($date[1]=="19,"," selected","").'>19</option>
							<option value="20"'.iif($date[1]=="20,"," selected","").'>20</option>
							<option value="21"'.iif($date[1]=="21,"," selected","").'>21</option>
							<option value="22"'.iif($date[1]=="22,"," selected","").'>22</option>
							<option value="23"'.iif($date[1]=="23,"," selected","").'>23</option>
							<option value="24"'.iif($date[1]=="24,"," selected","").'>24</option>
							<option value="25"'.iif($date[1]=="25,"," selected","").'>25</option>
							<option value="26"'.iif($date[1]=="26,"," selected","").'>26</option>
							<option value="27"'.iif($date[1]=="27,"," selected","").'>27</option>
							<option value="28"'.iif($date[1]=="28,"," selected","").'>28</option>
							<option value="29"'.iif($date[1]=="29,"," selected","").'>29</option>
							<option value="30"'.iif($date[1]=="30,"," selected","").'>30</option>
							<option value="31"'.iif($date[1]=="31,"," selected","").'>31</option>
						</select>
						<select name="ResYear" id="ResYear" class="bigBlack" style="background-color: #ECEADC; width: 75px;" tabindex="5" onChange="disableTimes();">
							<option value="">Year</option>
							<option value="'.date("Y").'"'.iif($date[2]==date("Y")," selected","").'>'.date("Y").'</option>
							<option value="'.(date("Y")+1).'"'.iif($date[2]==(date("Y")+1)," selected","").'>'.(date("Y")+1).'</option>
							<option value="'.(date("Y")+2).'"'.iif($date[2]==(date("Y")+2)," selected","").'>'.(date("Y")+2).'</option>
							<option value="'.(date("Y")+3).'"'.iif($date[2]==(date("Y")+3)," selected","").'>'.(date("Y")+3).'</option>
							<option value="'.(date("Y")+4).'"'.iif($date[2]==(date("Y")+4)," selected","").'>'.(date("Y")+4).'</option>
							<option value="'.(date("Y")+5).'"'.iif($date[2]==(date("Y")+5)," selected","").'>'.(date("Y")+5).'</option>
							<option value="'.(date("Y")+6).'"'.iif($date[2]==(date("Y")+6)," selected","").'>'.(date("Y")+6).'</option>
							<option value="'.(date("Y")+7).'"'.iif($date[2]==(date("Y")+7)," selected","").'>'.(date("Y")+7).'</option>
							<option value="'.(date("Y")+8).'"'.iif($date[2]==(date("Y")+8)," selected","").'>'.(date("Y")+8).'</option>
							<option value="'.(date("Y")+9).'"'.iif($date[2]==(date("Y")+9)," selected","").'>'.(date("Y")+9).'</option>
						</select>
						<img src="images/spacer.gif" alt="" width="3" height="1" border="0">
						<strong>Time Slot:</strong>
						<img src="images/spacer.gif" alt="" width="2" height="1" border="0">
						<select name="ResTimeFrom" id="ResTimeFrom" class="bigBlack" onChange="popTime(ResTimeFrom.value);" style="background-color: #ECEADC; width: 195px;" tabindex="6">
							<option value="">Select Time Period</option>
<!-- Changed from time ranges to specific start times per Rachel
							<option value="8:00 AM"'.iif($row['ResTimeFrom']=="8:00 AM"," selected","").'>From 8:00 To 8:30 AM</option>
							<option value="8:30 AM"'.iif($row['ResTimeFrom']=="8:30 AM"," selected","").'>From 8:30 To 9:00 AM</option>
							<option value="9:00 AM"'.iif($row['ResTimeFrom']=="9:00 AM"," selected","").'>From 9:00 To 9:30 AM</option>
							<option value="9:30 AM"'.iif($row['ResTimeFrom']=="9:30 AM"," selected","").'>From 9:30 To 10:00 AM</option>
							<option value="10:00 AM"'.iif($row['ResTimeFrom']=="10:00 AM"," selected","").'>From 10:00 To 10:30 AM</option>
							<option value="10:30 AM"'.iif($row['ResTimeFrom']=="10:30 AM"," selected","").'>From 10:30 To 11:00 AM</option>
							<option value="11:00 AM"'.iif($row['ResTimeFrom']=="11:00 AM"," selected","").'>From 11:00 To 11:30 AM</option>
							<option value="11:30 AM"'.iif($row['ResTimeFrom']=="11:30 PM"," selected","").'>From 11:30 To 12:00 PM</option>
							<option value="" disabled>---------------------------------------------------------</option>
							<option value="12:00 PM"'.iif($row['ResTimeFrom']=="12:00 PM"," selected","").'>From 12:00 To 12:30 PM</option>
							<option value="12:30 PM"'.iif($row['ResTimeFrom']=="12:30 PM"," selected","").'>From 12:30 To 1:00 PM</option>
							<option value="1:00 PM"'.iif($row['ResTimeFrom']=="1:00 PM"," selected","").'>From 1:00 To 1:30 PM</option>
							<option value="1:30 PM"'.iif($row['ResTimeFrom']=="1:30 PM"," selected","").'>From 1:30 To 2:00 PM</option>
							<option value="2:00 PM"'.iif($row['ResTimeFrom']=="2:00 PM"," selected","").'>From 2:00 To 2:30 PM</option>
							<option value="2:30 PM"'.iif($row['ResTimeFrom']=="2:30 PM"," selected","").'>From 2:30 To 3:00 PM</option>
							<option value="3:00 PM"'.iif($row['ResTimeFrom']=="3:00 PM"," selected","").'>From 3:00 To 3:30 PM</option>
							<option value="3:30 PM"'.iif($row['ResTimeFrom']=="3:30 PM"," selected","").'>From 3:30 To 4:00 PM</option>
							<option value="4:00 PM"'.iif($row['ResTimeFrom']=="4:00 PM"," selected","").'>From 4:00 To 4:30 PM</option>
							<option value="4:30 PM"'.iif($row['ResTimeFrom']=="4:30 PM"," selected","").'>From 4:30 To 5:00 PM</option>
							<option value="5:00 PM"'.iif($row['ResTimeFrom']=="5:00 PM"," selected","").'>From 5:00 To 5:30 PM</option>
							<option value="5:30 PM"'.iif($row['ResTimeFrom']=="5:30 PM"," selected","").'>From 5:30 To 6:00 PM</option>
							<option value="" disabled>---------------------------------------------------------</option>
							<option value="6:00 PM"'.iif($row['ResTimeFrom']=="6:00 PM"," selected","").'>From 6:00 To 6:30 PM</option>
							<option value="6:30 PM"'.iif($row['ResTimeFrom']=="6:30 PM"," selected","").'>From 6:30 To 7:00 PM</option>
							<option value="7:00 PM"'.iif($row['ResTimeFrom']=="7:00 PM"," selected","").'>From 7:00 To 7:30 PM</option>
							<option value="7:30 PM"'.iif($row['ResTimeFrom']=="7:30 PM"," selected","").'>From 7:30 To 8:00 PM</option>
							<option value="8:00 PM"'.iif($row['ResTimeFrom']=="8:00 PM"," selected","").'>From 8:00 To 8:30 PM</option>
							<option value="8:30 PM"'.iif($row['ResTimeFrom']=="8:30 PM"," selected","").'>From 8:30 To 9:00 PM</option>
							<option value="9:00 PM"'.iif($row['ResTimeFrom']=="9:00 PM"," selected","").'>From 9:00 To 9:30 PM</option>
							<option value="9:30 PM"'.iif($row['ResTimeFrom']=="9:30 PM"," selected","").'>From 9:30 To 10:00 PM</option>
							<option value="10:00 PM"'.iif($row['ResTimeFrom']=="10:00 PM"," selected","").'>From 10:00 To 10:30 PM</option>
							<option value="10:30 PM"'.iif($row['ResTimeFrom']=="10:30 PM"," selected","").'>From 10:30 To 11:00 PM</option>
							<option value="11:00 PM"'.iif($row['ResTimeFrom']=="11:00 PM"," selected","").'>From 11:00 To 11:30 PM</option>
							<option value="11:30 PM"'.iif($row['ResTimeFrom']=="11:30 PM"," selected","").'>From 11:30 To 12:00 AM</option>
-->
							<option id="8:00 AM" value="8:00 AM"'.iif($row['ResTimeFrom']=="8:00 AM"," selected","").'>8:00 AM</option>
							<option id="8:30 AM" value="8:30 AM"'.iif($row['ResTimeFrom']=="8:30 AM"," selected","").'>8:30 AM</option>
							<option id="9:00 AM" value="9:00 AM"'.iif($row['ResTimeFrom']=="9:00 AM"," selected","").'>9:00 AM</option>
							<option id="9:30 AM" value="9:30 AM"'.iif($row['ResTimeFrom']=="9:30 AM"," selected","").'>9:30 AM</option>
							<option id="10:00 AM" value="10:00 AM"'.iif($row['ResTimeFrom']=="10:00 AM"," selected","").'>10:00 AM</option>
							<option id="10:30 AM" value="10:30 AM"'.iif($row['ResTimeFrom']=="10:30 AM"," selected","").'>10:30 AM</option>
							<option id="11:00 AM" value="11:00 AM"'.iif($row['ResTimeFrom']=="11:00 AM"," selected","").'>11:00 AM</option>
							<option id="11:30 AM" value="11:30 AM"'.iif($row['ResTimeFrom']=="11:30 AM"," selected","").'>11:30 AM</option>
							<option value="" disabled>---------------------------------</option>
							<option id="12:00 PM" value="12:00 PM"'.iif($row['ResTimeFrom']=="12:00 PM"," selected","").'>12:00 PM</option>
							<option id="12:30 PM" value="12:30 PM"'.iif($row['ResTimeFrom']=="12:30 PM"," selected","").'>12:30 PM</option>
							<option id="1:00 PM" value="1:00 PM"'.iif($row['ResTimeFrom']=="1:00 PM"," selected","").'>1:00 PM</option>
							<option id="1:30 PM" value="1:30 PM"'.iif($row['ResTimeFrom']=="1:30 PM"," selected","").'>1:30 PM</option>
							<option id="2:00 PM" value="2:00 PM"'.iif($row['ResTimeFrom']=="2:00 PM"," selected","").'>2:00 PM</option>
							<option id="2:30 PM" value="2:30 PM"'.iif($row['ResTimeFrom']=="2:30 PM"," selected","").'>2:30 PM</option>
							<option id="3:00 PM" value="3:00 PM"'.iif($row['ResTimeFrom']=="3:00 PM"," selected","").'>3:00 PM</option>
							<option id="3:30 PM" value="3:30 PM"'.iif($row['ResTimeFrom']=="3:30 PM"," selected","").'>3:30 PM</option>
							<option id="4:00 PM" value="4:00 PM"'.iif($row['ResTimeFrom']=="4:00 PM"," selected","").'>4:00 PM</option>
							<option id="4:30 PM" value="4:30 PM"'.iif($row['ResTimeFrom']=="4:30 PM"," selected","").'>4:30 PM</option>
							<option id="5:00 PM" value="5:00 PM"'.iif($row['ResTimeFrom']=="5:00 PM"," selected","").'>5:00 PM</option>
							<option id="5:30 PM" value="5:30 PM"'.iif($row['ResTimeFrom']=="5:30 PM"," selected","").'>5:30 PM</option>
							<option value="" disabled>---------------------------------</option>
							<option id="6:00 PM" value="6:00 PM"'.iif($row['ResTimeFrom']=="6:00 PM"," selected","").'>6:00 PM</option>
							<option id="6:30 PM" value="6:30 PM"'.iif($row['ResTimeFrom']=="6:30 PM"," selected","").'>6:30 PM</option>
							<option id="7:00 PM" value="7:00 PM"'.iif($row['ResTimeFrom']=="7:00 PM"," selected","").'>7:00 PM</option>
							<option id="7:30 PM" value="7:30 PM"'.iif($row['ResTimeFrom']=="7:30 PM"," selected","").'>7:30 PM</option>
							<option id="8:00 PM" value="8:00 PM"'.iif($row['ResTimeFrom']=="8:00 PM"," selected","").'>8:00 PM</option>
							<option id="8:30 PM" value="8:30 PM"'.iif($row['ResTimeFrom']=="8:30 PM"," selected","").'>8:30 PM</option>
							<option id="9:00 PM" value="9:00 PM"'.iif($row['ResTimeFrom']=="9:00 PM"," selected","").'>9:00 PM</option>
							<option id="9:30 PM" value="9:30 PM"'.iif($row['ResTimeFrom']=="9:30 PM"," selected","").'>9:30 PM</option>
							<option id="10:00 PM" value="10:00 PM"'.iif($row['ResTimeFrom']=="10:00 PM"," selected","").'>10:00 PM</option>
							<option id="10:30 PM" value="10:30 PM"'.iif($row['ResTimeFrom']=="10:30 PM"," selected","").'>10:30 PM</option>
							<option id="11:00 PM" value="11:00 PM"'.iif($row['ResTimeFrom']=="11:00 PM"," selected","").'>11:00 PM</option>
							<option id="11:30 PM" value="11:30 PM"'.iif($row['ResTimeFrom']=="11:30 PM"," selected","").'>11:30 PM</option>
							<option id="Other" value="Other"'.iif($row['ResTimeFrom']=="Other"," selected","").'>Another Time</option>
							<!-- If they select "Another Time" they get a javascript pop up box so they can type in the times they want, then it\'s assigned to the ResTimeFrom value.-->
						</select>
					</td>
				</tr>
			';
		$sFlowerChoice = "";
		for ($counter=1; $counter <= mysql_num_rows($RSFlowerChoice); $counter++){
			$FlowerChoice = mysql_fetch_assoc($RSFlowerChoice);
			if ($counter > 1){
				$sFlowerChoice .= " || ";
			}
			$sFlowerChoice .= "Step2.ResPackagedDesired.value == ";
			$sFlowerChoice .= "\"".$FlowerChoice['package_name']." #".$FlowerChoice['package_num']." for $".$FlowerChoice['package_price']."\"";
		}
			echo'
				<script>
					function ValidChoices(){
/*						// If the package they chose allows them to choose flower style, let them...
//						if (Step2.ResPackagedDesired.value == "Traditional Package #4 for $445.00" || Step2.ResPackagedDesired.value == "Luxury Package #5 for $545.00"){
						if ('.$sFlowerChoice.'){
//							var x=document.getElementById("ResFlowerStyle")
//							x.options[x.selectedIndex].text="Select"
							Step2.ResFlowerStyle.options[Step2.ResFlowerStyle.selectedIndex].text="Select"
							Step2.ResFlowerStyle.readOnly = false;
							Step2.ResFlowerStyle.disabled = false;
							Step2.ResFlowerStyle.style.color = "#000000";
							Step2.ResLimo.readOnly = false;
							Step2.ResLimo.disabled = false;
//							Step2.ResLimoLabel.style.color = "#000000";
							document.getElementById("ResLimoLabel").style.color = "#000000";
						}else{  //...otherwise don\'t.
							Step2.ResFlowerStyle.value = "";
//							var x=document.getElementById("ResFlowerStyle")
//							x.options[x.selectedIndex].text="N/A"
							Step2.ResFlowerStyle.options[Step2.ResFlowerStyle.selectedIndex].text="N/A"
							Step2.ResFlowerStyle.readOnly = true;
							Step2.ResFlowerStyle.disabled = true;
							Step2.ResFlowerStyle.style.color = "#999999";
							Step2.ResLimo.checked = false;
							Step2.ResLimo.readOnly = true;
							Step2.ResLimo.disabled = true;
//							Step2.ResLimoLabel.style.color = "#999999";
//							Step2.ResLimo.value = "N/A";
							document.getElementById("ResLimoLabel").style.color = "#999999";
						}
*/
						// If the package they chose allows them to request the limo, let them...
						if (Step2.ResPackagedDesired.value == "Forever True Package for $1425.00" || Step2.ResPackagedDesired.value == "Marry Me Package for $975.00" || Step2.ResPackagedDesired.value == "Marry Me Again Package for $899.00" || Step2.ResPackagedDesired.value == "Lucky in Love Package for $625.00"){
							Step2.ResLimo.readOnly = false;
							Step2.ResLimo.disabled = false;
//							Step2.ResLimoLabel.style.color = "#000000";
							document.getElementById("ResLimoLabel").style.color = "#000000";
						}else{  //...otherwise don\'t.
							Step2.ResLimo.checked = false;
							Step2.ResLimo.readOnly = true;
							Step2.ResLimo.disabled = true;
//							Step2.ResLimoLabel.style.color = "#999999";
//							Step2.ResLimo.value = "N/A";
							document.getElementById("ResLimoLabel").style.color = "#999999";
						}

						// If the package they chose does not include flowers, don\'t let them choose a color...
						if (Step2.ResPackagedDesired.value == "Let\'s Elope for $199.00"){
							Step2.ResFlowerColor.options[Step2.ResFlowerColor.selectedIndex].text="Select"
							Step2.ResFlowerColor.readOnly = true;
							Step2.ResFlowerColor.disabled = true;
							Step2.ResFlowerColor.style.color = "#999999";
//							document.getElementById("ResFlowerColorLabel").style.color = "#999999";
						}else{
							Step2.ResFlowerColor.readOnly = false;
							Step2.ResFlowerColor.disabled = false;
							Step2.ResFlowerColor.style.color = "#000000";
//							document.getElementById("ResFlowerColorLabel").style.color = "#000000";
						}


						// Chose Gazebo - NO VIDEO.  Disable DVD and Webcam options.
						if (Step2.ResPackagedDesired.value == "Garden Ceremony for $375.00"){
							Step2.ResDVD.readOnly = true;
							Step2.ResDVD.disabled = true;
							Step2.ResDVD.checked = false;
							document.getElementById("ResDVDLabel").style.color = "#999999";
							Step2.ResDVDQty.value = "0";
							Step2.ResDVDQty.readOnly = true;
							Step2.ResDVDQty.disabled = true;
							Step2.ResDVDQty.style.color = "#999999";
							document.getElementById("ResDVDQty").style.color = "#999999";
							Step2.ResWebcam.readOnly = true;
							Step2.ResWebcam.disabled = true;
							Step2.ResWebcam.checked = false;
							document.getElementById("ResWebcamLabel").style.color = "#999999";
						}else{
							Step2.ResDVD.readOnly = false;
							Step2.ResDVD.disabled = false;
							document.getElementById("ResDVDLabel").style.color = "#000000";
							Step2.ResWebcam.readOnly = false;
							Step2.ResWebcam.disabled = false;
							document.getElementById("ResWebcamLabel").style.color = "#000000";
						}
						// Halloween - restrict flower color options
						if (Step2.ResPackagedDesired.value == "Medieval Halloween Package for $175.00" || Step2.ResPackagedDesired.value == "Empire Halloween Package for $275.00" || Step2.ResPackagedDesired.value == "Victorian Halloween Package for $375.00"){
							document.getElementById("Red").disabled = true;
							document.getElementById("White").disabled = false;
							document.getElementById("Ivory").disabled = true;
							document.getElementById("Light_Pink").disabled = true;
							document.getElementById("Hot_Pink").disabled = true;
							document.getElementById("Lavender").disabled = true;
							document.getElementById("Peach").disabled = true;
							document.getElementById("Orange").disabled = false;
							document.getElementById("Coral").disabled = true;
							document.getElementById("Burgundy").disabled = false;
							document.getElementById("Yellow").disabled = true;
							document.getElementById("Pale_Green").disabled = true;
//							document.getElementById("Black_Baccara").disabled = false;
						}else{
							document.getElementById("Red").disabled = false;
							document.getElementById("White").disabled = false;
							document.getElementById("Ivory").disabled = false;
							document.getElementById("Light_Pink").disabled = false;
							document.getElementById("Hot_Pink").disabled = false;
							document.getElementById("Lavender").disabled = false;
							document.getElementById("Peach").disabled = false;
							document.getElementById("Orange").disabled = false;
							document.getElementById("Coral").disabled = false;
							document.getElementById("Burgundy").disabled = false;
							document.getElementById("Yellow").disabled = false;
							document.getElementById("Pale_Green").disabled = false;
//							document.getElementById("Black_Baccara").disabled = true;
 						}
					}
					</script>
				<tr>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Ceremony:</strong>
					</td>
					<td colspan="3">
<!--						<strong>Service Type:&nbsp;&nbsp;</strong>-->
						<select name="ResPackageType" id="ResPackageType" class="bigBlack" style="background-color:#ECEADC; width:105px;" onChange="ValidPackages();" tabindex="7">
							<option value="">Type</option>
							<option value="Wedding"'.iif($row['ResPackageType']=="Wedding"," selected","").'>Wedding</option>
							<option value="Renewal"'.iif($row['ResPackageType']=="Renewal"," selected","").'>Renewal</option>
						</select>
						<select name="ResServiceType" id="ResServiceType" class="bigBlack" style="background-color:#ECEADC; width:105px;" tabindex="8">
							<option value="">Service</option>
							<option value="Traditional"'.iif($row['ResServiceType']=="Traditional"," selected","").'>Traditional</option>
							<option value="Civil"'.iif($row['ResServiceType']=="Civil"," selected","").'>Civil</option>
						</select>
						<select name="ResServiceLanguage" id="ResServiceLanguage" class="bigBlack" style="background-color:#ECEADC; width:105px;" tabindex="9">
							<option value="">Language</option>
							<option value="English"'.iif($row['ResServiceLanguage']=="English"," selected","").'>English</option>
							<option value="Spanish"'.iif($row['ResServiceLanguage']=="Spanish"," selected","").'>Spanish</option>
							<option value="French"'.iif($row['ResServiceLanguage']=="French"," selected","").'>French</option>
						</select>
					</td>
				</tr>

				<script>
					function ValidPackages(){
						if (Step2.ResPackageType.value == "Renewal"){
							document.getElementById("Package1").innerHTML = "Forever True Package for $1425.00";
							document.getElementById("Package1").value = "Forever True Package for $1425.00";
							document.getElementById("Package2").innerHTML = "Marry Me Again Package for $975.00";
							document.getElementById("Package2").value = "Marry Me Again Package for $975.00";
							document.getElementById("Package3").innerHTML = "Lucky in Love Package for $625.00";
							document.getElementById("Package3").value = "Lucky in Love Package for $625.00";
							document.getElementById("Package4").innerHTML = "Tie the Knot Again Package for $375.00";
							document.getElementById("Package4").value = "Tie the Knot Again Package for $375.00";
							document.getElementById("Package5").innerHTML = "Let\'s Elope Again for $199.00";
							document.getElementById("Package5").value = "Let\'s Elope Again for $199.00";
							document.getElementById("Package6").innerHTML = "Garden Ceremony for $375.00";
							document.getElementById("Package6").value = "Garden Ceremony for $375.00";
							document.getElementById("Package7").innerHTML = "&quot;Now or Never&quot; Ceremony (Elvis) for $575.00";
							document.getElementById("Package7").value = "&quot;Now or Never&quot; Ceremony (Elvis) for $575.00";
						}else{
							document.getElementById("Package1").innerHTML = "Forever True Package for $1425.00";
							document.getElementById("Package1").value = "Forever True Package for $1425.00";
							document.getElementById("Package2").innerHTML = "Marry Me Package for $975.00";
							document.getElementById("Package2").value = "Marry Me Package for $975.00";
							document.getElementById("Package3").innerHTML = "Lucky in Love Package for $625.00";
							document.getElementById("Package3").value = "Lucky in Love Package for $625.00";
							document.getElementById("Package4").innerHTML = "Tie the Knot Package for $375.00";
							document.getElementById("Package4").value = "Tie the Knot Package for $375.00";
							document.getElementById("Package5").innerHTML = "Let\'s Elope for $199.00";
							document.getElementById("Package5").value = "Let\'s Elope for $199.00";
							document.getElementById("Package6").innerHTML = "Garden Ceremony for $375.00";
							document.getElementById("Package6").value = "Garden Ceremony for $375.00";
							document.getElementById("Package7").innerHTML = "&quot;Now or Never&quot; Ceremony (Elvis) for $575.00";
							document.getElementById("Package7").value = "&quot;Now or Never&quot; Ceremony (Elvis) for $575.00";
 						}
					}
				</script>

				<tr>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Wedding Package:</strong>
					</td>
					<td colspan="3" valign="top">
						<select name="ResPackagedDesired" id="ResPackagedDesired" class="bigBlack" style="background-color:#ECEADC; width:325px;" onChange="ValidChoices();" tabindex="10">
							<option id="Select Package" value="">Select Package</option>
							<option id="Package1" value="Forever True Package for $1425.00">Forever True Package for $1425.00</option>
							<option id="Package2" value="Marry Me Package for $975.00">Marry Me Package for $975.00</option>
							<option id="Package3" value="Lucky in Love Package for $625.00">Lucky in Love Package for $625.00</option>
							<option id="Package4" value="Tie the Knot Package for $375.00">Tie the Knot Package for $375.00</option>
							<option id="Package5" value="Let\'s Elope for $199.00">Let\'s Elope for $199.00</option>
							<option id="Package6" value="Garden Ceremony for $375.00">Garden Ceremony for $375.00</option>
							<option id="Package7" value="&quot;Now or Never&quot; Ceremony for $575.00">&quot;Now or Never&quot; Ceremony (Elvis) for $575.00</option>
<!--							<option id="Other Arrangements" value="Other Arrangements">Other Arrangements</option>-->

			';
//		for ($counter=1; $counter <= mysql_num_rows($RSPackages); $counter++){
//			$pkg = mysql_fetch_assoc($RSPackages);
//			echo'
//							<option id="Package'.$counter.'" value="'.$pkg['package_name'].iif($pkg["package_num"] != "", ' #'.$pkg["package_num"], '')." for $".$pkg['package_price'].'"'.iif($row['ResPackagedDesired']==$pkg['package_name'].iif($pkg["package_num"] != "", ' #'.$pkg["package_num"], '')." for $".$pkg['package_price']," selected","").'>'.$pkg["package_name"].iif($pkg["package_num"] != "", ' #'.$pkg["package_num"], '').'</option>
//			';
//		}
			echo'
<!--							<option id="Other Arrangements" value="Other Arrangements"'.iif($row['ResPackagedDesired']=="Other Arrangements"," selected","").'>Other Arrangements</option>-->
						</select>
					</td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Number of Guests:</strong>
					</td>
					<td colspan="3" class="smallBlack">
						<input type="text" name="ResGuests" id="ResGuests" size="2" maxlength="2" tabindex="11" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResGuests'].'" onkeypress="return onlyNumbers(event)">&nbsp;&nbsp;&nbsp;
						<strong>Please enter the number of guests who will be attending, including the bridal party.</strong>
					</td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Flower Color:</strong>
					</td>
					<td valign="top" colspan="3">
						<select name="ResFlowerColor" id="ResFlowerColor" class="bigBlack" style="background-color:#ECEADC; width:105px;" tabindex="12">
<!--							<optgroup label="Select">-->
							<option value="">Select</option>
							<option id="Red" value="Red"'.iif($row['ResFlowerColor']=="Red"," selected","").'>Red</option>
							<option id="White" value="White"'.iif($row['ResFlowerColor']=="White"," selected","").'>White</option>
							<option id="Ivory" value="Ivory"'.iif($row['ResFlowerColor']=="Ivory"," selected","").'>Ivory</option>
							<option id="Light_Pink" value="Light Pink"'.iif($row['ResFlowerColor']=="Light Pink"," selected","").'>Light Pink</option>
							<option id="Hot_Pink" value="Hot Pink"'.iif($row['ResFlowerColor']=="Hot Pink"," selected","").'>Hot Pink</option>
							<option id="Lavender" value="Lavender"'.iif($row['ResFlowerColor']=="Lavender"," selected","").'>Lavender</option>
							<option id="Peach" value="Peach"'.iif($row['ResFlowerColor']=="Peach"," selected","").'>Peach</option>
							<option id="Orange" value="Orange"'.iif($row['ResFlowerColor']=="Orange"," selected","").'>Orange</option>
							<option id="Coral" value="Coral"'.iif($row['ResFlowerColor']=="Coral"," selected","").'>Coral</option>
							<option id="Burgundy" value="Burgundy"'.iif($row['ResFlowerColor']=="Burgundy"," selected","").'>Burgundy</option>
							<option id="Yellow" value="Yellow"'.iif($row['ResFlowerColor']=="Yellow"," selected","").'>Yellow</option>
							<option id="Pale_Green" value="Pale Green"'.iif($row['ResFlowerColor']=="Pale Green"," selected","").'>Pale Green</option>
<!--							<option id="Black_Baccara" value="Black Baccara"'.iif($row['ResFlowerColor']=="Black Baccara"," selected","").'>Black Baccara (Halloween Only)</option>-->
<!--							</optgroup>-->
						</select>
<!--						<strong>&nbsp;&nbsp;Style:&nbsp;&nbsp;</strong>
						<select name="ResFlowerStyle" id="ResFlowerStyle" class="bigBlack" style="background-color:#ECEADC; width:105px;" tabindex="13">
							<option value="">Select</option>
							<option value="Hand Tied"'.iif($row['ResFlowerStyle']=="Hand Tied"," selected","").'>Hand Tied</option>
							<option value="Cascade"'.iif($row['ResFlowerStyle']=="Cascade"," selected","").'>Cascade</option>
						</select>&nbsp;&nbsp;&nbsp;
						<strong class="smallBlack">Packages #4 & #5 Only</strong>-->
						<strong class="smallBlack">&nbsp;&nbsp;&nbsp;Please enter your desired flower color, if applicable.</strong>
					</td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Hotel/Lodging:</strong>
					</td>
					<td colspan="3" valign="top">
						<input type="text" name="ResHotel" id="ResHotel" size="16" maxlength="50" tabindex="14" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResHotel'].'">&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Please provide the hotel where you will be staying, if known and applicable.</strong>
					</td>
				</tr>
				<script>
					function moreDVDs(){
						if (Step2.ResDVD.checked == true){
							Step2.ResDVDQty.readOnly = false;
							Step2.ResDVDQty.disabled = false;
							Step2.ResDVDQty.style.color = "#000000";
							document.getElementById("ResDVDQty").style.color = "#000000";
						}else if (Step2.ResDVD.checked == false){
							Step2.ResDVDQty.value = "0";
							Step2.ResDVDQty.readOnly = true;
							Step2.ResDVDQty.disabled = true;
							Step2.ResDVDQty.style.color = "#999999";
							document.getElementById("ResDVDQty").style.color = "#999999";
						}
					}
				</script>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Additional Services:</strong>
					</td>
					<td colspan="3" valign="top">
<!--						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>-->
						<input type="checkbox" name="ResDVD" tabindex="15" value="Yes"'.iif($row['ResDVD']=="Yes"," checked","").' onClick="moreDVDs();">&nbsp;<strong id="ResDVDLabel">Add DVD of Ceremony&nbsp;&ndash;&nbsp;How Many:</strong>&nbsp;&nbsp;<input type="text" name="ResDVDQty" id="ResDVDQty" size="2" maxlength="2" tabindex="16" class="bigBlack" style="background-color:#ECEADC; width:25px;" value="'.iif($row['ResDVDQty']!="",$row['ResDVDQty'],0).'">&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Quantity of <u><em>ADDITIONAL</em></u> DVD\'s requested.</strong><br>
						<input type="checkbox" name="ResWebcam" tabindex="17" value="Yes"'.iif($row['ResWebcam']=="Yes"," checked","").'>&nbsp;<strong id="ResWebcamLabel">Add Webcam Service</strong><br>
						<input type="checkbox" name="ResLimo" tabindex="18" value="Yes"'.iif($row['ResDVD']=="Yes"," checked","").'>&nbsp;<strong id="ResLimoLabel">Reserve Limo Service</strong>&nbsp;&nbsp;&nbsp;<strong class="smallBlack">"Forever True", Marry Me", & "Lucky in Love" Packages Only</strong>
<!--						<input type="checkbox" name="ResUpgradePhotos" tabindex="19" value="Yes"'.iif($row['ResUpgradePhotos']=="Yes"," checked","").'>&nbsp;<strong id="ResUpgradePhotosLabel">Upgrade Photography Service</strong>&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Check if you are interested in additional Photo Services</strong>-->
					</td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
<!--						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>-->
						<strong>Addl. Photo Services:</strong>
					</td>
					<td colspan="3" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
						<input type="checkbox" name="OutdoorPhotos" tabindex="19" value="Yes"'.iif(strpos($row['ResUpgradePhotos'],"Outdoor Photography")===true," checked","").'>&nbsp;<strong id="OutdoorPhotosLabel">Outdoor Photography Package for $250</strong><!--&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Check if you are interested in additional Photo Services</strong>--><br>
						<input type="checkbox" name="SignPhotos" tabindex="20" value="Yes"'.iif(strpos($row['ResUpgradePhotos'],"Welcome to Las Vegas Sign Photography")===true," checked","").'>&nbsp;<strong id="SignPhotosLabel"><em>"Welcome to Las Vegas"</em> Sign Photography Package for $325</strong><!--&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Check if you are interested in additional Photo Services</strong>--><br>
						<input type="checkbox" name="StudioPhotos" tabindex="21" value="Yes"'.iif(strpos($row['ResUpgradePhotos'],"Studio Photography")===true," checked","").'>&nbsp;<strong id="StudioPhotosLabel">Studio Photography Package for $499</strong><!--&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Check if you are interested in additional Photo Services</strong>--><br>
						<input type="checkbox" name="LocationPhotos" tabindex="22" value="Yes"'.iif(strpos($row['ResUpgradePhotos'],"On Location Photography")===true," checked","").'>&nbsp;<strong id="LocationPhotosLabel">On Location Photography Package for $1,250</strong><!--&nbsp;&nbsp;&nbsp;<strong class="smallBlack">Check if you are interested in additional Photo Services</strong>--><br>
					</td>
				</tr>
				<tr>
					<td width="165" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Special Requests:</strong><br>
						<strong class="smallBlack">(Extra Flowers, etc.)</strong></div>
					</td>
					<td colspan="3" valign="top">
						<textarea name="ResRequests" id="ResRequests" rows="2" cols="100" tabindex="23" class="bigBlack" style="background-color:#ECEADC; width:545px; height:65px;">
'.$row['ResRequests'].'</textarea> <!-- Leave here for formatting! -->
					</td>
				</tr>
				<tr>
					<td colspan="5" align="center">
						<input type="hidden" name="altTime" id="altTime" value="">
						<input type="hidden" name="sec" id="sec" value="reservations">
						<input type="hidden" name="feature" id="feature" value="3">
						<input type="hidden" name="SID" id="SID" value="'.$SID.'">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<input type="submit" name="submit2" id="submit2" value="Proceed to Step 3"><br><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<script>ValidChoices();</script>
		<script>ValidPackages();</script>
		<script>moreDVDs();</script>
		<script>document.forms[\'Step2\'].Groom.focus();</script>
			';
		}elseif ($cargo == "3"){
// STEP 3 *********************************
			// Make sure we have the right starting time
			if ($_REQUEST['ResTimeFrom'] == "Other"){
				$ResTime = $_REQUEST['altTime']; // value entered in prompt box
			}else{
				$ResTime = $_REQUEST['ResTimeFrom'];
			}
			// Build list of additional photography services
			$UpgradePhotos = "";
			if ($_REQUEST['OutdoorPhotos'] == "Yes"){$UpgradePhotos.= "Outdoor Photography,";};
			if ($_REQUEST['SignPhotos'] == "Yes"){$UpgradePhotos.= "Welcome to Las Vegas Sign Photography,";};
			if ($_REQUEST['StudioPhotos'] == "Yes"){$UpgradePhotos.= "Studio Photography,";};
			if ($_REQUEST['LocationPhotos'] == "Yes"){$UpgradePhotos.= "On Location Photography,";};

			// Save Step 2 values
			// "ResPackage*d*Desired" - Huh?  What What???
			$query = "UPDATE reservations SET
						ResGroomName='".$_REQUEST['Groom']."',
						ResBrideName='".$_REQUEST['Bride']."',
						ResDate='".$_REQUEST['ResMonth']." ".$_REQUEST['ResDay'].", ".$_REQUEST['ResYear']."',
						ResTimeFrom='".$ResTime."',
						ResPackagedDesired='".$_REQUEST['ResPackagedDesired']."',
						ResPackageType='".$_REQUEST['ResPackageType']."',
						ResServiceType='".$_REQUEST['ResServiceType']."',
						ResServiceLanguage='".$_REQUEST['ResServiceLanguage']."',
						ResGuests='".$_REQUEST['ResGuests']."',
						ResFlowerColor='".$_REQUEST['ResFlowerColor']."',
						ResFlowerStyle='".$_REQUEST['ResFlowerStyle']."',
						ResHotel='".$_REQUEST['ResHotel']."',
						ResDVD='".$_REQUEST['ResDVD']."',
						ResDVDQty='".$_REQUEST['ResDVDQty']."',
						ResWebcam='".$_REQUEST['ResWebcam']."',
						ResLimo='".$_REQUEST['ResLimo']."',
						ResUpgradePhotos='".substr($UpgradePhotos, 0, -1)."',
						ResRequests='".$_REQUEST['ResRequests']."',
						Step2Time=NOW()
						WHERE SessionID = '".$_REQUEST['SID']."'";
//echo $query;
			$result = mysql_query($query, $linkID);
			// Now build page
			echo'
		<tr>
			<td colspan="3" align="center">
				<form action="" method="post" name="Step3" id="Step3" onSubmit="return validate(this);">
				<table width="735" border="0" cellspacing="0" cellpadding="5" align="center" class="bigBlack">
				<tr>
					<td colspan="4" align="center" class="xbigBlack"><strong>Your Billing Information</strong><br><strong class="bodyBlack">Reservation will not be confirmed until payment is received.</strong><br></td>
				</tr>
				<tr>
					<td width="735" colspan="4" class="bodyBlack">
						<ul>
							<li>This site uses the latest encryption technology for the transmission of sensitive information.  As such, <a href="https://secure.comodo.net/ttb_searcher/trustlogo?v_querytype=W&v_shortname=SC&v_search=https://secure.nr.net/littlechurchlv/newsite/&x=6&y=5" target="_blank" class="bodyBlack"><strong>this site is secure.</strong></a> However, if you prefer, you may phone in your credit card information after completing the online reservation form. Simply select <em><strong>"I\'d prefer to phone in my credit card information"</strong></em> below and click the <strong><em>"Complete Reservation"</em></strong> button, then please call 800.821.2452 (702.739.7971 inside Nevada &amp; International) between 8:00 AM and 12:00 Midnight Pacific Time, daily.<br></li>
						</ul>
					</td>
				</tr>
				<tr>
					<td width="735" colspan="4" class="bodyBlack">
						<ul>
							<li>By completing this reservation you are authorizing The Little Church of the West to charge your credit card for the full package price amount plus any optional items you have selected.  This amount is non-refundable but is transferrable.<br><br></li>
						</ul>
					</td>
				</tr>
				<tr>
					<td width="185" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Credit Card Type:</strong>
					</td>
					<td width="180" valign="top">
						<select name="ResCreditCardType" id="ResCreditCardType" class="bigBlack" style="background-color: #ECEADC; width: 180px;" tabindex="1">
							<option value="">Select Type of Card</option>
							<option value="Visa"'.iif($row['ResCreditCardType']=="Visa"," selected","").'>Visa</option>
							<option value="MasterCard"'.iif($row['ResCreditCardType']=="MasterCard"," selected","").'>MasterCard</option>
							<option value="American Express"'.iif($row['ResCreditCardType']=="American Express"," selected","").'>American Express</option>
						<!-- For Future...
							<option value="Discover"'.iif($row['ResCreditCardType']=="Discover"," selected","").'>Discover</option>-->
						</select>
					</td>
					<td width="190" align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Name on Card:</strong>
					</td>
					<td width="180" valign="top">
						<input type="text" name="ResCreditCardName" id="ResCreditCardName" size="22" maxlength="30" tabindex="2" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCreditCardName'].'">
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Card Number:</strong>
					</td>
					<td valign="top">
						<input type="text" name="ResCreditCardNumber" id="ResCreditCardNumber" size="20" maxlength="20" tabindex="3" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCreditCardNumber'].'" onkeypress="return onlyNumbers(event)">
					</td>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>CID Security Code:</strong>
					</td>
					<td valign="top">
						<input type="text" name="ResCreditCardCID" id="ResCreditCardCID" size="2" maxlength="5" tabindex="4" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCreditCardCID'].'" onkeypress="return onlyNumbers(event)">&nbsp;&nbsp;<a href="javascript:show(\'CID\');" class="bodyBlack"><strong>What\'s this?</strong></a>
					</td>
				</tr>
				<tr>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Expiration Date:</strong>
					</td>
			';
			$date = explode("/",$row['ResCreditCardExpiration']);
			// $date[0] = month, $date[1] = year
			echo '
					<td>
						<select name="ExpMonth" id="ExpMonth" class="bigBlack" style="background-color:#ECEADC; width:110px;" tabindex="5">
							<option value="">Month</option>
							<option value="01"'.iif($date[0]=="01"," selected","").'>Jan. (01)</option>
							<option value="02"'.iif($date[0]=="02"," selected","").'>Feb. (02)</option>
							<option value="03"'.iif($date[0]=="03"," selected","").'>Mar. (03)</option>
							<option value="04"'.iif($date[0]=="04"," selected","").'>Apr. (04)</option>
							<option value="05"'.iif($date[0]=="05"," selected","").'>May  (05)</option>
							<option value="06"'.iif($date[0]=="06"," selected","").'>Jun. (06)</option>
							<option value="07"'.iif($date[0]=="07"," selected","").'>Jul. (07)</option>
							<option value="08"'.iif($date[0]=="08"," selected","").'>Aug. (08)</option>
							<option value="09"'.iif($date[0]=="09"," selected","").'>Sep. (09)</option>
							<option value="10"'.iif($date[0]=="10"," selected","").'>Oct. (10)</option>
							<option value="11"'.iif($date[0]=="11"," selected","").'>Nov. (11)</option>
							<option value="12"'.iif($date[0]=="12"," selected","").'>Dec. (12)</option>
						</select>
						<select name="ExpYear" id="ExpYear" class="bigBlack" style="background-color: #ECEADC; width: 67px;" tabindex="6">
							<option value="">Year</option>
							<option value="'.date("Y").'"'.iif($date[1]==date("Y")," selected","").'>'.date("Y").'</option>
							<option value="'.(date("Y")+1).'"'.iif($date[1]==(date("Y")+1)," selected","").'>'.(date("Y")+1).'</option>
							<option value="'.(date("Y")+2).'"'.iif($date[1]==(date("Y")+2)," selected","").'>'.(date("Y")+2).'</option>
							<option value="'.(date("Y")+3).'"'.iif($date[1]==(date("Y")+3)," selected","").'>'.(date("Y")+3).'</option>
							<option value="'.(date("Y")+4).'"'.iif($date[1]==(date("Y")+4)," selected","").'>'.(date("Y")+4).'</option>
							<option value="'.(date("Y")+5).'"'.iif($date[1]==(date("Y")+5)," selected","").'>'.(date("Y")+5).'</option>
							<option value="'.(date("Y")+6).'"'.iif($date[1]==(date("Y")+6)," selected","").'>'.(date("Y")+6).'</option>
							<option value="'.(date("Y")+7).'"'.iif($date[1]==(date("Y")+7)," selected","").'>'.(date("Y")+7).'</option>
							<option value="'.(date("Y")+8).'"'.iif($date[1]==(date("Y")+8)," selected","").'>'.(date("Y")+8).'</option>
							<option value="'.(date("Y")+9).'"'.iif($date[1]==(date("Y")+9)," selected","").'>'.(date("Y")+9).'</option>
						</select>
					</td>
					<td align="right" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<strong>Billing Zipcode:</strong>
					</td>
					<td valign="top">
						<input type="text" name="ResCreditCardZip" id="ResCreditCardZip" size="2" maxlength="10" tabindex="7" class="bigBlack" style="background-color: #ECEADC;" value="'.$row['ResCreditCardZip'].'">&nbsp;&nbsp;<strong class="smallBlack">If Applicable (USA).</strong></a>
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center" valign="top">
						<img src="images/spacer.gif" alt="" width="1" height="13" border="0"><br>
						<strong>I\'d prefer to phone in my credit card information:</strong><input type="checkbox" name="ResPhonePaymentInfo" value="No">
					</td>
				</tr>
				<tr>
					<td colspan="4" align="center">
						<input type="hidden" name="sec" id="sec" value="reservations">
						<input type="hidden" name="feature" id="feature" value="4">
						<input type="hidden" name="SID" id="SID" value="'.$SID.'">
						<input type="hidden" name="Country" id="Country" value="'.$row['ResCountry'].'">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<input type="submit" name="submit3" id="submit3" value="Complete Reservation"><br><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
			';
//		if (stristr($navigator_user_agent, "msie")){
//			echo'
//				<div id="CID" style="position:absolute; top:80; left:570; z-index:1; visibility:hidden; display:none">
//			';
//		}elseif (stristr($navigator_user_agent, "firefox")){
//			echo'
//				<div id="CID" style="position:absolute; top:80; left:570; z-index:1; visibility:hidden; display:none">
//			';
//		}elseif (stristr($navigator_user_agent, "netscape")){
//			echo'
//				<div id="CID" style="position:absolute; top:80; left:570; z-index:1; visibility:hidden; display:none">
//			';
//		}elseif (stristr($navigator_user_agent, "opera")){
//			echo'
//				<div id="CID" style="position:absolute; top:80; left:570; z-index:1; visibility:hidden; display:none">
//			';
//		}else{
			echo'
				<div id="CID" style="position:absolute; top:150; left:540; z-index:10000; visibility:hidden; display:none">
			';
//		}
			echo'
				<table width="375" border="1" cellspacing="0" cellpadding="5" bordercolor="#770025" bgcolor="#F8F6E8">
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
						<tr>
							<td class="bigBlack"><strong>What is my Security Code?</strong></td>
							<td align="right"><a href="javascript:hide(\'CID\');" onBlur="javascript:document.forms[\'Step3\'].ResCreditCardCID.focus();"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></td>
						</tr>
						<tr>
							<td colspan="2"><hr align="left" width="100%" size="2" color="#000000" noshade></td>
						</tr>
						<tr>
							<td colspan="2">
								For your protection, we ask that you enter an extra 3-4 digit number commonly called the CID (Visa & MasterCard sometimes refer to it as a CVV2). The CID is <strong>NOT</strong> your PIN number. It is an extra ID printed on your Visa, MasterCard, or American Express Card. The CID value helps validate two things:
									<ul>
										<li>The customer has a card in his/her possession.</li>
										<li>The card account is legitimate.</li>
									</ul>
								The CID is not contained in the magnetic stripe information, nor does it appear on sales receipts.<br><br>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
								<tr>
									<td><img src="images/AmexCID.jpg" alt="Amex CID Location" title="Amex CID Location" width="154" height="100" border="0"></td>
								</tr>
								</table>
								<strong>American Express:</strong> The CID is the 4 digit, non embossed number printed above your account number on the face of your card. It can be found to the right on Classic, Gold, and Platinum cards or to the left on Optima cards.
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table width="160" border="0" cellspacing="0" cellpadding="0" align="right">
								<tr>
									<td><img src="images/VisaMCCVV2.jpg" alt="Visa & MasterCard CVV2 Location" title="Visa & MasterCard CVV2 Location" width="154" height="100" border="0"></td>
								</tr>
								</table>
								<strong>Visa &amp; MasterCard:</strong> The CID (CVV2) three-digit value is printed on the signature panel on the back of the cards immediately following the card\'s account number.<br><br>If your card does not have a CID or it is unreadable, please choose the option to phone your card information in and call the chapel for payment arrangements.
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				</div>
			</td>
		</tr>

		<script>document.forms[\'Step3\'].ResCreditCardType.focus();</script>
			';
		}elseif ($cargo == "4"){
// STEP 4 *********************************
			// Make sure we have the right starting time
			if ($_REQUEST['ResPhonePaymentInfo'] != "Yes"){
				$PhoneIt = "No";
			}else{
				$PhoneIt = "Yes";
			}
			// Save Step 3 values
			// Credit Card numbers SHOULD be stored encrypted!!!  Old system did not encrypt them so leave them unencrypted for now.  Must go back after everything is up and correct that!
			$query = "UPDATE reservations SET ResCreditCardType='".$_REQUEST['ResCreditCardType']."', ResCreditCardName='".$_REQUEST['ResCreditCardName']."', ResCreditCardNumber='".$_REQUEST['ResCreditCardNumber']."', ResCreditCardCID='".$_REQUEST['ResCreditCardCID']."', ResCreditCardExpiration='".$_REQUEST['ExpMonth']."/".$_REQUEST['ExpYear']."', ResCreditCardZip='".$_REQUEST['ResCreditCardZip']."', ResPhonePaymentInfo='".$PhoneIt."', Step3Time=NOW() WHERE SessionID = '".$_REQUEST['SID']."'";
//echo $query;
			$result = mysql_query($query, $linkID);
			// Now create Email receipt
			// retrieve complete reservation and email it
			$query = "SELECT *, UNIX_TIMESTAMP(Step3Time) AS ResTime FROM reservations WHERE SessionID = '".$_REQUEST["SID"]."'";
			$result = mysql_query($query, $linkID);
			$row = mysql_fetch_assoc($result);
//print_r($row);
			// build email
			$to = $row["ResEmail"];
			$subject = "Your Little Church of the West Wedding Reservation";
			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= 'Cc: info@littlechurchlv.com' . "\r\n";
$headers .= 'Bcc: lcotw_test@nr.net' . "\r\n"; //Testing
			$headers .= "From: Little Church of the West Reservations <info@littlechurchlv.com>\r\n";
			$message = '
				<table width="700" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<font face="sans-serif" size="3"><strong>Thank You for choosing The Little Church of the West for your wedding!</strong></font><br><hr width="100%" size="3" color="#000000" noshade>
					</td>
				</tr>
				<tr>
					<td>
						<font face="sans-serif" size="2"><strong>The following is a summary of the information you provided in your reservation:</strong><br><br></font>
					</td>
				</tr>
				<tr>
					<td>
						<table width="700" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="345" valign="top">
								<table width="345" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="125"><font face="sans-serif" size="2"><strong>Reservation Date:</strong></font></td>
									<td width="220"><font face="sans-serif" size="2">'.date("F j, Y, g:i a T",$row["ResTime"]).'</font></td>
								</tr>
								<tr>
									<td><font face="sans-serif" size="2"><strong>Online Resv Num:</strong></font></td>
									<td><font face="sans-serif" size="2">'.$row["ResNumber"].'</font></td>
								</tr>
								<tr>
									<td><font face="sans-serif" size="2"><strong>Reserved From:</strong></font></td>
									<td><font face="sans-serif" size="2">IP Address '.$row["IpAddress"].'</font></td>
								</tr>
								<tr>
									<td valign="top"><font face="sans-serif" size="2"><strong>Payment Method:</strong></font></td>
			';
			if ($row["ResPhonePaymentInfo"] != "Yes"){
				$payment = $row["ResCreditCardType"].' **** **** **** '.substr($row["ResCreditCardNumber"],-4,4);
			}else{
				$payment = "<strong>Please Call to Arrange Payment</strong><br><font face='sans-serif' size='1'>NOTE - Reservations are not complete<br>until payment arrangements are made.</font>";
			}
			$message .= '
									<td><font face="sans-serif" size="2">'.$payment.'</font></td>
								</tr>
								</table>
							</td>
							<td width="25">&nbsp;</td>
							<td width="330">
								<table width="330" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="100" valign="top"><font face="sans-serif" size="2"><strong>Reserved By:</strong></font></td>
									<td width="230">
										<font face="sans-serif" size="2">
										'.$row["ResName"].'<br>
										'.$row["ResAddress"].'<br>
			';
			if ($row["ResAddress2"] != "") $message .= $row["ResAddress2"].'<br>';
			$message .= '
										'.$row["ResCity"].', '.$row["ResState"].'  '.$row["ResZip"].'<br>
			';
			if ($row["ResCountry"] != "USA") $message .= $row["ResCountry"].'<br>';
			$message .= '
										'.$row["ResHomePhone"].'
										</font>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<br><font face="sans-serif" size="3"><strong>Wedding Information</strong><br><hr width="100%" size="1" color="#000000" noshade></font>
					</td>
				</tr>
				<tr>
					<td>
						<table width="700" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="120"><font face="sans-serif" size="2"><strong>Bride\'s Name:</strong></font></td>
							<td width="220"><font face="sans-serif" size="2">'.$row["ResBrideName"].'</font></td>
							<td width="25">&nbsp;</td>
							<td width="100"><font face="sans-serif" size="2"><strong>Guests:</strong></font></td>
							<td width="230"><font face="sans-serif" size="2">'.$row["ResGuests"].'</font></td>
						</tr>
						<tr>
							<td><font face="sans-serif" size="2"><strong>Groom\'s Name:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResGroomName"].'</font></td>
							<td>&nbsp;</td>
							<td><font face="sans-serif" size="2"><strong>Flower Choice:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResFlowerStyle"].' '.$row["ResFlowerColor"].'</font></td>
						</tr>
						<tr>
							<td><font face="sans-serif" size="2"><strong>Wedding Date:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResDate"].' at '.$row["ResTimeFrom"].'</font></td>
							<td>&nbsp;</td>
							<td><font face="sans-serif" size="2"><strong>Lodging:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResHotel"].'</font></td>
						</tr>
						<tr>
							<td><font face="sans-serif" size="2"><strong>Package:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResPackagedDesired"].'</font></td>
							<td>&nbsp;</td>
							<td><font face="sans-serif" size="2"><strong>Addl. DVDs:</strong></font></td>
							<td><font face="sans-serif" size="2">'.iif($row["ResDVDQty"]=="","0",$row["ResDVDQty"]).'</font></td>
						</tr>
						<tr>
							<td><font face="sans-serif" size="2"><strong>Service:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResServiceType"].' '.$row["ResPackageType"].'</font></td>
							<td>&nbsp;</td>
							<td><font face="sans-serif" size="2"><strong>Add Webcam:</strong></font></td>
							<td><font face="sans-serif" size="2">'.iif($row["ResWebcam"]=="","No",$row["ResWebcam"]).'</font></td>
						</tr>
						<tr>
							<td><font face="sans-serif" size="2"><strong>Language:</strong></font></td>
							<td><font face="sans-serif" size="2">'.$row["ResServiceLanguage"].'</font></td>
							<td>&nbsp;</td>
							<td><font face="sans-serif" size="2"><strong>Add Limo:</strong></font></td>
							<td><font face="sans-serif" size="2">'.iif($row["ResLimo"]=="","No",$row["ResLimo"]).'</font></td>
						</tr>
						<tr>
							<td colspan="5">
								<br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="150" valign="top"><font face="sans-serif" size="2"><strong>Additional Requests:</strong></font></td>
									<td width="550" valign="top"><font face="sans-serif" size="2">'.$row["ResRequests"].'</font></td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<ul>
							<font face="sans-serif" size="2"><br>
							<li>We will contact you to confirm your reservation within 24-48 hours of receipt of your payment. If you did not supply your credit card information, please call 800.821.2452 (702.739.7971 inside Nevada & International) between the hours of 8:00 AM to 12:00 Midnight Pacific Time, daily, to arrange payment.<br><br></li>
							<li>If you have any questions in the mean-time please call or email us at <a href="mailto:info@littlechurchlv.com">info@littlechurchlv.com</a>.</li>
							</font>
						</ul>
					</td>
				</tr>
				<tr>
					<td>
						<br><font face="sans-serif" size="3"><strong>Frequently Asked Questions</strong><br><hr width="100%" size="1" color="#000000" noshade></font>
					</td>
				</tr>
				<tr>
					<td>
			';
			// Grab the FAQ contents
			$query = "SELECT * FROM faq	WHERE show_on_receipt = 'T' ORDER BY position";
			$rs_faq = mysql_query($query, $linkID);
			for ($counter=1; $counter <= mysql_num_rows($rs_faq); $counter++){
				$faq = mysql_fetch_assoc($rs_faq);
				$message .= '
						<font face="sans-serif" size="2">
						<p><strong>'.$faq["question"].'</strong><br>
						'.$faq["answer"].'</p>
						</font>
				';
			}
			$message .= '
					</td>
				</tr>
				<tr>
					<td>
						<br><br><font face="sans-serif" size="3"><strong>Chapel Location &amp; Directions</strong><br><hr width="100%" size="1" color="#000000" noshade></font>
					</td>
				</tr>
				<tr>
					<td>
						<table width="230" border="0" cellspacing="0" cellpadding="0" align="right">
						<tr>
							<td><br><img src="http://www.littlechurchlv.com/images/Map.png" alt="" width="220" height="329" border="0"></td>
						</tr>
						</table>
						<font face="sans-serif" size="2">
						<strong>The Little Church of the West is located at the South end of the World Famous Las Vegas "Strip", right across from the Mandalay Bay Hotel.</strong><br><br><br>
						<ul><ul>
							<strong>
							<font face="sans-serif" size="3">
							The Little Church of the West<br></font>
							4617 Las Vegas Boulevard South<br>
							Las Vegas, Nevada 89119<br><br>
							800.921.2452 (Toll-Free Outside Nevada)<br>
							702.739.7971 (Inside Nevada &amp; International)<br>
							702.897.2182 (Fax)<br><br>
							Email: <a href="mailto:info@littlechurchlv.com">info@littlechurchlv.com</a><br><br>
							Open 8:00 AM to 12:00 Midnight Pacific Time, Daily
							</strong><br><br><br>
						</ul></ul>
						<strong>
						<font face="sans-serif" size="3">
						Thank you for allowing us to be a part of your special day!<br><br>
						Sincerely,<br>
						<font face="\'Monotype Corsiva\',cursive" size="5">The Little Church Team</font>
						</font>
						</strong>
					</td>
				</tr>
				</table>
 			';
			// send email
			mail($to, $subject, $message, $headers);
			// Now thank them for their reservation
			echo'
		<tr>
			<td colspan="3" align="center">
				<table width="860" border="0" cellspacing="0" cellpadding="5" align="center" class="bigBlack">
				<tr>
					<td align="center" class="xbigBlack"><br><strong>Thank You for Your Reservation!</strong><br><br></td>
				</tr>
				<tr>
					<td width="860" class="bigBlack">
						Shortly you will receive an email (sent to the address you provided with your reservation) detailing the information you provided along with additional information regarding your reservation.<br><br>We will contact you to confirm your reservation within 24-48 hours of receipt of your payment. If you did not supply your credit card information, please call 800.821.2452 (702.739.7971 inside Nevada &amp; International) between the hours of 8:00 AM to 12:00 Midnight Pacific Time, daily, to arrange payment.<br><br>If you have any questions in the mean-time please call or email us at <a href="mailto:info@littlechurchlv.com" class="bigBlack">info@littlechurchlv.com</a>.
					</td>
				</tr>
				<tr>
					<td align="center">
						<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
						<input type="button" name="Go Home!" id="Go Home!" value="Return To HomePage" onClick="window.location=\'/index/home/\';"><br><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
			';
		}
		?>
		</table>
	</td>
	</form>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900WhiteBGBottom.png"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- Put the cursor in the Name field -->
<script>//document.forms[0].ResName.focus();</script>
<script>//document.forms[\'Step1u\'].ResName.focus();</script>

<!-- END INCLUDE reservations -->

