<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Connect to the database
include "../dbconnect.php";

$copy = false;
// If they clicked "Copy Device"
if ($_REQUEST['task'] == "copy"){
	$copy = true;
	// Get copy of device info
	$query = "SELECT * FROM phones WHERE product_id = '".$_REQUEST['id_to_copy']."'";
//echo $query;
	$rs_copy = mysql_query($query, $linkID);
	$copy = mysql_fetch_assoc($rs_copy);

	// Now get a copy of all the device's features
	$query = "SELECT * FROM phone_features WHERE product_id = '".$_REQUEST['id_to_copy']."'";
//echo $query;
	$rs_features = mysql_query($query, $linkID);
}
?>

<html>
<head>
	<title>Cell Benefits Admin</title>

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

	<script>
		// Swap layer visibility
		function show(id) {
			document.getElementById(id).style.visibility = "visible";
			document.getElementById(id).style.display = "block";
		}
		function hide(id) {
			document.getElementById(id).style.visibility = "hidden";
			document.getElementById(id).style.display = "none";
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
			if (keynum == 08 || keynum == 46 || !keynum) return true; // Backspace, decimal point or navigation (arrow) key
			keychar = String.fromCharCode(keynum)
			ltrcheck = /\D/ //Regular expression for NON-digit (letter)
			crcheck = /\cM/ //Regular expression ctrl-M (enter)
			if (crcheck.test(keychar)) o.blur();
			return !ltrcheck.test(keychar) //Return true if not a letter
		//	return (!ltrcheck.test(keychar)||crcheck.test(keychar)) //Return true if not a letter OR enter
		}
				
		// Dim Table
		function dimTable(id) {
//alert(id);
			// IE
			//fix for IE bold text & opacity bug - explicitly setting a BG color fixes filter
			document.getElementById(id).style.backgroundColor = "#FFFFFF";
			document.getElementById(id).style.filter = "alpha(opacity:33)";
			// Everyone else
			document.all[id].style.Mozopacity = (33/100);
			document.all[id].style.opacity = (33/100);
			document.all[id].style.KHTMLopacity = (33/100);
		}
	
		// Disable Form
		function disableForm(id) {
//alert(id);
			try{
				for(i=0; i < document.getElementById(id).length; i++){
					if (document.getElementById(id)[i].type != "hidden"){
						// Add more types to exclude here
						if (document.getElementById(id)[i].disabled != true){
							document.getElementById(id)[i].disabled = true;
							var bFound = true;
						}
					}
				}
			}
			catch(e){
			// do nothing
			}
		}
	
		// Carrier Selected
		function selectCarrier(carrier) {
			if (carrier == ""){
				<?
				if ($copy == false){
				?>
				document.newPhone.ir1.value = "";  // Blank it in case it was stuffed by selecting Sprint or Nextel previously
				document.newPhone.label.value = "";
				<?
				}
				?>
				hide("SprintType");
//				hide("VerizonType");
				hide("AT&TType");
				show("BlankType");
				hide("NextelService");
				hide("SprintService");
//				hide("VerizonService");
				hide("AT&TService");
			}
			if (carrier == "ATT"){
				<?
				if ($copy == false){
				?>
				document.newPhone.ir1.value = "";  // Blank it in case it was stuffed by selecting Sprint or Nextel previously
				document.newPhone.label.value = '{MODEL/NAME}<br>by {MANUFACTURER} ({COLOR})';
				<?
				}
				?>
				hide("BlankType");
				hide("SprintType");
//				hide("VerizonType");
				show("AT&TType");
				hide("NextelService");
				hide("SprintService");
//				hide("VerizonService");
				show("AT&TService");
			}
			if (carrier == "Nextel"){
				<?
				if ($copy == false){
				?>
				document.newPhone.ir1.value = "150.00";
				document.newPhone.label.value = 'Nextel {MODEL/NAME}<br>by {MANUFACTURER}&reg; ({COLOR})';
				<?
				}
				?>
				hide("BlankType");
				hide("AT&TType");
//				hide("VerizonType");
				show("SprintType");
				hide("AT&TService");
				hide("SprintService");
//				hide("VerizonService");
				show("NextelService");
			}
			if (carrier == "Sprint"){
				<?
				if ($copy == false){
				?>
				document.newPhone.ir1.value = "150.00";
				document.newPhone.label.value = 'Sprint Power Vision<sup><font size="-2">SM</font></sup> {MODEL/NAME}<br>by {MANUFACTURER}&reg; ({COLOR})';
				<?
				}
				?>
				hide("BlankType");
				hide("AT&TType");
//				hide("VerizonType");
				show("SprintType");
				hide("AT&TService");
				hide("NextelService");
//				hide("VerizonService");
				show("SprintService");
			}
//			hide("AT&TOptions");
//			hide("NextelOptions");
//			hide("SprintOptions");
//			hide("VerizonOptions");
//			show(carrier+"Options");
//			newPhone.manufacturer.focus();
		}
				
		// New Manufacturer Selected
		function newManuf(manuf) {
			if (manuf != "New"){
				return
			}
			document.newPhone.manufacturer.value = "";
			hide("ManufDDLB");
			show("ManufText");
			newPhone.manufacturer_new.focus();
		}
	
		// Phone Type Selected
		function selectType(type) {
			if (type == "" || type == "P" || type == "S"){
				<?
//				if ($copy == false){
				?>
				document.newPhone.sprint_service.value = "";  // Blank it in case it was stuffed by selecting a type previously
//				document.newPhone.label.value = "";
				<?
//				}
				?>
			}
//			if (carrier == "Sprint"){
				if (type == "D" || type == "B"){
				<?
//				if ($copy == false){
				?>
					document.newPhone.sprint_service.value = "NoVision";  // Aircards & BlackBerry's don;t have Vision Service
//				document.newPhone.label.value = 'Sprint Power Vision<sup><font size="-2">SM</font></sup> {MODEL/NAME}<br>by {MANUFACTURER}&reg; ({COLOR})';
				<?
//				}
				?>
				}
//			}
		}
		function startUp(){
			selectCarrier(document.newPhone.carrier.value);
		}
	
	</script>

</head>

<body onLoad="startUp();">

<div id="Container" style="position:static; visibility:visible; display:block;">
	<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
	<tr>
		<td colspan="3" align="center" class="bigBlack">
			<strong>Add New "<em>x</em>Benefits" Device</strong><br>
			<strong><font size="+5">TEST!</font></strong><br>
			<strong>&raquo;&nbsp;<a href="/admin" class="bodyBlack" title="Return To Main Menu">Return to Menu</a>&nbsp;&laquo;</strong>
			<hr width="100%" size="1" noshade>
		</td>
	</tr>
	</table>
	<div id="AddChoice" style="position:static; visibility:visible; display:block;">
	<form name="copyPhone" id="copyPhone" method="GET" action="" onSubmit="return choiceMade(this);">
		<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack" id="CopyPhoneTable">
		<tr>
			<td width="210">Product ID to Copy:</td>
			<td width="295">
				<input type="text" name="id_to_copy" id="id_to_copy" size="20" value="" maxlength="50">&nbsp;&nbsp;
				<input type="submit" value="Copy Device">
			</td>
			<td width="145" align="right">
				...or Click Here for:
			</td>
			<td width="100" align="right">
				<input type="button" value="Blank Form" onClick="disableForm('copyPhone'); dimTable('CopyPhoneTable'); show('MainForm');">
			</td>
		</tr>
		<?
		if ($_REQUEST['task'] == "copy" && mysql_num_rows($rs_copy) == 0){
		?>
		<tr>
			<td colspan="4" align="center"><br><font color="#FF0000"><strong>Device Not Found - Please Try Again or Click "Blank Form"</strong></font></td>		
		</tr>
		<?
		}
		?>
		</table>
		<input type="hidden" name="task" id="task" value="copy">
	</form>
	</div>
	<div id="MainForm" style="position:relative; visibility:hidden; display:none;">
	<form name="newPhone" id="newPhone" method="POST" action="saveit_test.php" onSubmit="return validate(this);">
		<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
		<tr>
			<td width="195">Carrier:</td>
			<td width="10">&nbsp;</td>
			<td width="550">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<select name="carrier" id="carrier" size="1" onChange="return selectCarrier(this.value);">
							<option value="">Select</option>
							<option value="ATT"<? if ($copy['carrier']=="AT&T") echo " Selected" ?>>AT&amp;T</option>
							<option value="Nextel"<? if ($copy['carrier']=="Nextel") echo " Selected" ?>>Nextel</option>
							<option value="Sprint"<? if ($copy['carrier']=="Sprint") echo " Selected" ?>>Sprint</option>
<!--							<option value="Verizon"<? if ($copy['carrier']=="Verizon") echo " Selected" ?>>Verizon</option>-->
						</select>
					</td>
					<?
					$home = $_SERVER['HTTP_HOST'];
					$uri = explode("?",$_SERVER['REQUEST_URI']);
					$home .= $uri[0];
					?>
					<td align="right">
						<input type="button" value=" Start Over " onClick="location.href='http://<? echo $home; ?>';">
					</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">Manufacturer:</td>
			<td>
				<div id="ManufDDLB" style="position:static; visibility:visible; display:block;">
					<select name="manufacturer" id="manufacturer" size="1" onChange="return newManuf(this.value);">
						<option value="">Select</option>
					<?
					// Get manufacturers
					$query = "SELECT DISTINCT manufacturer FROM phones ORDER BY manufacturer";
					$result = mysql_query($query, $linkID);
					while ($row = mysql_fetch_assoc($result)){
					?>
						<option value="<? echo $row['manufacturer']; ?>"<? if ($copy['manufacturer']==$row['manufacturer']) echo " Selected" ?>><? echo $row['manufacturer']; ?></option>
					<?
					}
					?>
						<option value="New">Not Listed</option>
					</select>
				</div>
				<div id="ManufText" style="position:relative; visibility:hidden; display:none;">
					<input type="text" name="manufacturer_new" id="manufacturer_new" value="" size="20" style="height=20;" maxlength="20">
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">Model:</td>
			<td>
				<input type="text" name="model" id="model" size="50" value="<? echo $copy['model']; ?>" maxlength="50">
			</td>
		</tr>
		<tr>
			<td colspan="2">Display Name:</td>
			<td>
				<input type="text" name="label" id="label" size="85" value='<? echo htmlentities($copy['label']); ?>' maxlength="255">
			</td>
		</tr>
		<tr>
			<td colspan="2">Phone Image File:</td>
			<td>
				<input type="text" name="thumbnail" id="thumbnail" size="50" value="<? echo $copy['thumbnail']; ?>" maxlength="50">
			</td>
		</tr>
		<tr>
			<td colspan="2">Description:</td>
			<td>
				<textarea cols="66" rows="5" name="description" id="description"><? echo htmlentities($copy['description']); ?></textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">Bullet Point #1:</td>
			<td>
				<input type="text" name="bullet1" id="bullet1" size="50" value="<? echo $copy['bullet1']; ?>" maxlength="100">
			</td>
		</tr>
		<tr>
			<td colspan="2">Bullet Point #2:</td>
			<td>
				<input type="text" name="bullet2" id="bullet2" size="50" value="<? echo $copy['bullet2']; ?>" maxlength="100">
			</td>
		</tr>
		<tr>
			<td colspan="2">Bullet Point #3:</td>
			<td>
				<input type="text" name="bullet3" id="bullet3" size="50" value="<? echo $copy['bullet3']; ?>" maxlength="100">
			</td>
		</tr>
		<tr>
			<td colspan="2">Status/Hookline:</td>
			<td>
				<input type="text" name="hookline" id="hookline" size="50" value="<? echo $copy['hookline']; ?>" maxlength="50">
			</td>
		</tr>
		<tr>
			<td colspan="2">Device Type:</td>
			<td>
				<div id="BlankType" style="position:static; visibility:visible; display:block;">
					<select name="phone_type" id="phone_type" size="1">
						<option value="">Select&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
					</select>
				</div>
				<div id="AT&TType" style="position:relative; visibility:hidden; display:none;">
					<select name="phone_type" id="phone_type" size="1">
						<option value="">Select</option>
						<option value="V"<? if ($copy['phone_type']=="V") echo " Selected" ?>>Voice Phone</option>
						<option value="D"<? if ($copy['phone_type']=="D") echo " Selected" ?>>Aircard</option>
						<option value="B"<? if ($copy['phone_type']=="B") echo " Selected" ?>>BlackBerry</option>
						<option value="P"<? if ($copy['phone_type']=="P") echo " Selected" ?>>PDA Phone</option>
<!--						<option value="S"<? if ($copy['phone_type']=="S") echo " Selected" ?>>Smartphone</option>-->
					</select>
				</div>
				<div id="SprintType" style="position:relative; visibility:hidden; display:none;">
					<select name="phone_type" id="phone_type" size="1" onChange="selectType(this.value);">
						<option value="">Select</option>
						<option value="V"<? if ($copy['phone_type']=="V") echo " Selected" ?>>Voice Phone</option>
						<option value="D"<? if ($copy['phone_type']=="D") echo " Selected" ?>>Aircard</option>
						<option value="B"<? if ($copy['phone_type']=="B") echo " Selected" ?>>BlackBerry</option>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">Size/Dimensions:</td>
			<td>
				<input type="text" name="size" id="size" size="30" value="<? echo $copy['size']; ?>" maxlength="30">
			</td>
		</tr>
		<tr>
			<td colspan="2">Weight:</td>
			<td>
				<input type="text" name="weight" id="weight" size="25" value="<? echo $copy['weight']; ?>" maxlength="25">
			</td>
		</tr>
		<tr>
			<td colspan="2">Talk Time:</td>
			<td>
				<input type="text" name="talk_time" id="talk_time" size="25" value="<? echo $copy['talk_time']; ?>" maxlength="25">
			</td>
		</tr>
		<tr>
			<td colspan="2">Frequency Band(s):</td>
			<td>
				<input type="text" name="band" id="band" size="30" value="<? echo $copy['band']; ?>" maxlength="50">
			</td>
		</tr>
		<tr>
			<td>Retail Price:</td>
			<td align="right">$</td>
			<td>
				<input type="text" name="msrp" id="msrp" size="10" value="<? echo $copy['msrp']; ?>" maxlength="10" onkeypress="return onlyNumbers(event,this)">
			</td>
		</tr>
		<tr>
			<td>Instant Discount #1:</td>
			<td align="right">$</td>
			<td>
				<input type="text" name="ir1" id="ir1" size="10" value="<? echo $copy['instant1-1']; ?>" maxlength="10" onkeypress="return onlyNumbers(event,this)">
			</td>
		</tr>
		<tr>
			<td>Instant Discount #2:</td>
			<td align="right">$</td>
			<td>
				<input type="text" name="ir2" id="ir2" size="10" value="<? echo $copy['instant1-2']; ?>" maxlength="10" onkeypress="return onlyNumbers(event,this)">
			</td>
		</tr>
		<tr>
			<td>Mail-In Rebate(s) Total:</td>
			<td align="right">$</td>
			<td>
				<input type="text" name="mir1" id="mir1" size="10" value="<? echo $copy['mail_in1-1']; ?>" maxlength="10" onkeypress="return onlyNumbers(event,this)"> <!-- Carrier and manufacturer rebates only -->
			</td>
		</tr>
		<?
		$flat_price = "N/A";
		if ($copy['carrier'] == "Sprint" || $copy['carrier'] == "Nextel"){
			$flat_price = $copy['msrp']-$copy['instant5-1'];
		}
		?>
		<tr>
			<td>Flat Rate Price (Final Price):</td>
			<td align="right">$</td>
			<td>
				<input type="text" name="flat_rate" id="flat_rate" size="10" value="<? echo $flat_price; ?>" maxlength="10" onkeypress="return onlyNumbers(event,this)">
			</td>
		</tr>
		<tr>
			<td colspan="2">Display Position:</td>
			<td>
				<select name="display" id="display" size="1">
					<option value="">Select</option>
					<option value="F"<? if ($copy['display']=="F") echo " Selected" ?>>Feature (Home Page Top Row)</option>
					<option value="P"<? if ($copy['display']=="P") echo " Selected" ?>>Promote (Home Page Bottom Two Rows)</option>
					<option value="A"<? if ($copy['display']=="A") echo " Selected" ?>>Include on "Phones" Page Only</option>
					<option value="N"<? if ($copy['display']=="N") echo " Selected" ?>>Do Not Display (Unavailable or Discontinued)</option>
				</select>
			</td>
		</tr>
		</table>

		<div id="AT&TService" style="position:relative; visibility:hidden; display:none;">
			<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td width="195">AT&T Express Mail Capable:</td>
				<td width="5">&nbsp;</td>
				<td width="555">
					<input type="radio" name="at&t_xpress_mail" value="T"<? if ($copy['at&t_xpress_mail']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_xpress_mail" value="F"<? if ($copy['at&t_xpress_mail']=="" || $copy['at&t_xpress_mail']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T TeleNav Capable:</td>
				<td>
					<input type="radio" name="at&t_telenav" value="T"<? if ($copy['at&t_telenav']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_telenav" value="F"<? if ($copy['at&t_telenav']=="" || $copy['at&t_telenav']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T PDA4BlackBerry Capable:</td>
				<td>
					<input type="radio" name="at&t_pda4bb" value="T"<? if ($copy['at&t_pda4bb']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_pda4bb" value="F"<? if ($copy['at&t_pda4bb']=="" || $copy['at&t_pda4bb']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T Push to Talk Capable:</td>
				<td>
					<input type="radio" name="at&t_push_talk" value="T"<? if ($copy['at&t_push_talk']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_push_talk" value="F"<? if ($copy['at&t_push_talk']=="" || $copy['at&t_push_talk']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T Media Basic Capable:</td>
				<td>
					<input type="radio" name="at&t_media_basic" value="T"<? if ($copy['at&t_media_basic']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_media_basic" value="F"<? if ($copy['at&t_media_basic']=="" || $copy['at&t_media_basic']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T Media Works Capable:</td>
				<td>
					<input type="radio" name="at&t_media_works" value="T"<? if ($copy['at&t_media_works']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_media_works" value="F"<? if ($copy['at&t_media_works']=="" || $copy['at&t_media_works']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T Media Max Capable:</td>
				<td>
					<input type="radio" name="at&t_media_max" value="T"<? if ($copy['at&t_media_max']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_media_max" value="F"<? if ($copy['at&t_media_max']=="" || $copy['at&t_media_max']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T Video Share Capable:</td>
				<td>
					<input type="radio" name="at&t_video_share" value="T"<? if ($copy['at&t_video_share']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_video_share" value="F"<? if ($copy['at&t_video_share']=="" || $copy['at&t_video_share']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">AT&T High-Speed/3G Capable:</td>
				<td>
					<input type="radio" name="at&t_3g" value="T"<? if ($copy['at&t_3g']=="T") echo " checked" ?>> Yes
					<input type="radio" name="at&t_3g" value="F"<? if ($copy['at&t_3g']=="" || $copy['at&t_3g']=="F") echo " checked" ?>> No
				</td>
			</tr>
			</table>
		</div>
		<div id="NextelService" style="position:relative; visibility:hidden; display:none;">
			<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td width="195">Nextel Dual Mode Capable:</td>
				<td width="5">&nbsp;</td>
				<td width="555">
					<input type="radio" name="nextel_dual_mode" value="T"<? if ($copy['nextel_dual_mode']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_dual_mode" value="F"<? if ($copy['nextel_dual_mode']=="" || $copy['nextel_dual_mode']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">Nextel Easy Office Capable:</td>
				<td>
					<input type="radio" name="nextel_easy_office" value="T"<? if ($copy['nextel_easy_office']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_easy_office" value="F"<? if ($copy['nextel_easy_office']=="" || $copy['nextel_easy_office']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">Nextel Mapquest Capable:</td>
				<td>
					<input type="radio" name="nextel_mapquest" value="T"<? if ($copy['nextel_mapquest']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_mapquest" value="F"<? if ($copy['nextel_mapquest']=="" || $copy['nextel_mapquest']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">Nextel Trimble GPS Capable:</td>
				<td>
					<input type="radio" name="nextel_trimble_gps" value="T"<? if ($copy['nextel_trimble_gps']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_trimble_gps" value="F"<? if ($copy['nextel_trimble_gps']=="" || $copy['nextel_trimble_gps']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">Nextel Intl. Data Capable:</td>
				<td>
					<input type="radio" name="nextel_intl_data" value="T"<? if ($copy['nextel_intl_data']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_intl_data" value="F"<? if ($copy['nextel_intl_data']=="" || $copy['nextel_intl_data']=="F") echo " checked" ?>> No
				</td>
			</tr>
			<tr>
				<td colspan="2">Nextel Games Capable:</td>
				<td>
					<input type="radio" name="nextel_games" value="T"<? if ($copy['nextel_games']=="T") echo " checked" ?>> Yes
					<input type="radio" name="nextel_games" value="F"<? if ($copy['nextel_games']=="" || $copy['nextel_games']=="F") echo " checked" ?>> No
				</td>
			</tr>
			</table>
		</div>
		<div id="SprintService" style="position:relative; visibility:hidden; display:none;">
			<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
			<tr>
				<td width="195">Sprint Service Type:</td>
				<td width="10">&nbsp;</td>
				<td width="550">
					<select name="sprint_service" id="display" size="1">
						<option value="">Select</option>
						<option value="PCS"<? if ($copy['sprint_pcs']=="T") echo " Selected" ?>>Sprint PCS</option>
						<option value="Vision"<? if ($copy['sprint_pcs_vision']=="T") echo " Selected" ?>>Sprint Vision</option>
						<option value="PVision"<? if ($copy['sprint_power_vision']=="T") echo " Selected" ?>>Sprint Power Vision</option>
						<option value="NoVision"<? if ($copy['sprint_pcs']=="F" && $copy['sprint_pcs_vision']=="F" && $copy['sprint_power_vision']=="F") echo " Selected" ?>>BlackBerry/Aircard</option>
					</select>
				</td>
			</tr>
			</table>
		</div>

		<script>
		function clearFeatures(){
		<?
			for ($counter=1; $counter <= 20; $counter++){
		?>
			newPhone.feature<? echo $counter; ?>.value = "";
		<?
			}
		?>
			newPhone.feature1.focus();
		}
		</script>
		<table width="775" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyBlack">
		<?
		for ($counter=1; $counter <= 20; $counter++){
			if ($_REQUEST['task'] == "copy"){
				// Get copy of device feature
				$feature = mysql_fetch_assoc($rs_features);
			}
		?>
		<tr>
			<td width="195">Device Feature #<? echo $counter; ?>:</td>
			<td width="10">&nbsp;</td>
			<td width="550">
				<input type="text" name="feature<? echo $counter; ?>" id="feature<? echo $counter; ?>" size="50" value="<? echo htmlentities($feature['feature']); ?>" maxlength="50">
				<?
				if ($counter == 1){
				?>
				<img src="images/spacer.gif" alt="" width="80" height="1" border="0"><input type="button" value="Clear Features" onClick="clearFeatures();">
				<?
				}
				?>
			</td>
		</tr>
		<?
		}
		?>
		</table>
		<br>
		<div align="center"><input type="submit" value="Add Device"></div>
	<input type="hidden" name="task" id="task" value="addphone">
	</form>
	</div>
</div>
<?
if ($_REQUEST['task'] == "copy" && mysql_num_rows($rs_copy) != 0){
?>
<script>
	disableForm('copyPhone');
	dimTable('CopyPhoneTable');
	show('MainForm');
</script>
<?
}
?>

</body>
</html>
