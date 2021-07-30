<?
// PHP Functions
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}

// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}

//Grab the database
include("dbconnect.php");

//Build page header
if ($_REQUEST['header'] != ""){
	$header_num = $_REQUEST['header']; //Value passed as parameter
}else{
	$header_num = rand(1,12); //Generate a random number
}
//echo strpos($_SERVER['HTTP_USER_AGENT'], "MSIE").'<br></br>';
$query = "SELECT * FROM header_config WHERE header_num = ".$header_num."";
//echo $query.'<br></br>';
$rs_header = mysql_query($query, $linkID);
$header = mysql_fetch_assoc($rs_header);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Green Receipts</title>

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Load Standard Javascripts -->
	<script language="JavaScript" src="/standard.js"></script>

	<!-- Custom Javascripts & Initializations -->
	<script language="javascript">
	BrowserDetect.init();
	// Returns:
	// BrowserDetect.browser = Browser Name
	// BrowserDetect.version = Browser Version Number
	// BrowserDetect.OS = Operating System
	// Display Example:
	// document.write('You\'re using ' + BrowserDetect.browser + ' ' + BrowserDetect.version + ' on ' + BrowserDetect.OS + '!');

	// Swap Button Backgrounds
	function divOn(divID) {
		document.getElementById(divID).style.backgroundImage = 'url("/images/ButtonBG100.png")';
	}
	function divOff(divID) {
		document.getElementById(divID).style.backgroundImage = 'url("/images/ButtonBG50.png")';
	}
	</script>

</head>

<body bgcolor="#FFFFFF">

<!-- Page Wrapper -->
<div align="center" id="Wrapper" style="margin: 0 auto;">
	<!-- Outer Frame Border -->
	<div align="center" id="Border" style="width:1000px; background-color:#215E21;">
		<!-- Nifty Corners -->
		<span class="rtopGreen">
			<span class="r1"></span><span class="r2"></span><span class="r3"></span><span class="r4"></span>
		</span>
		<!-- Header & Buttons -->
		<div align="center" id="Header" style="background: url(/images/HeaderBG<?=$header_num;?>.jpg) top center no-repeat; width: 960px; height: 450px; position: relative; top: 15;">
			<!-- Information Bar -->
			<div id="InfoBar" style="width:700px; height:85px; position:absolute; top:5; left:250; border: #215E21 solid thin;">
				<!-- login, logout, register, "welcome <user>", my account, # of new receipts since last login, etc. -->
				<br><div align="center" class="bodyBlack">Information<br>(Account Info/Status, Static Login/Logout, Special Promotion/Message, etc.)</div>
			</div>
			<!-- End Information Bar -->
			<!-- Promo & Primary Buttons -->
			<div id="HeaderPromo" style="width:960px; height:300px; position:absolute; top:99; left:0;">
				<div align="left" id="PromoText" style="<?=iif($txtBG != "", $txtBGx, "");?>width:<?=$header["text_width"];?>px; height:<?=IIf(strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") > 0, $header["text_height"], $header["text_height"]+5);?>px; position:absolute; top:<?=$header["top_offset"];?>; left:<?=$header["left_offset"];?>;" class="bodyBlack">
					<?
					if($header["text_bg"] != "None"){
					?>
					<div align="left" id="PromoTextTop" style="width:100%; height:5px; position:relative; top:0; left:0;">
						<span class="rtopTrans<?=$header["text_bg"];?>"><span class="r1"></span><span class="r2"></span><span class="r3"></span><span class="r4"></span></span>
					</div>
					<?
					}
					?>
					<div align="left" id="PromoTextMiddle" style="<?=iif($header["text_bg"] != "None", "background:url(/images/TransBG".$header["text_bg"].".png) repeat; ", "");?>width:100%; height:<?=$header["text_height"];?>px; position:relative; top:0; left:0;">
						<strong>
						<?
						if($header["text_wrap"] == "T"){
						?>
						<font size="+1" color="#<?=$header["text_color1"];?>">&nbsp;&nbsp;Some</font>
						<font size="+3" color="#<?=$header["text_color2"];?>">Clever</font>
						<font size="+2" color="#<?=$header["text_color1"];?>">Saying</font><br>
						<font size="+2" color="#<?=$header["text_color2"];?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Goes</font>
						<font size="+4" color="#<?=$header["text_color1"];?>">Here</font><br>
						<img src="images/spacer.gif" alt="" width="1" height="3" border="0"><br>
						<?
						}else{
						?>
						<font size="+1" color="#<?=$header["text_color1"];?>">&nbsp;&nbsp;Some</font>
						<font size="+4" color="#<?=$header["text_color2"];?>">Clever</font>
						<font size="+2" color="#<?=$header["text_color1"];?>">Saying</font>
						<font size="+2" color="#<?=$header["text_color2"];?>">Goes</font>
						<font size="+3" color="#<?=$header["text_color1"];?>">Here</font>
						<?
						}
						?>
						</strong>
					</div>
					<?
					if($header["text_bg"] != "None"){
					?>
					<div align="left" id="PromoTextBottom" style="width:100%; height:5px; position:relative; top:0; left:0;">
						<span class="rbottomTrans<?=$header["text_bg"];?>"><span class="r4"></span><span class="r3"></span><span class="r2"></span><span class="r1"></span></span>
					</div>
					<?
					}
					?>
				</div>
			</div>
			<!-- Button Bar -->
			<div id="Buttons" style="width:960px; height:51px; position:absolute; top:399; left:0;">
				<a href="#" class="menuGreen">
				<div id="HomeButton" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:50px; position:absolute; left:0;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Home
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button 2" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:110;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button2
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button 3" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:220;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button3
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button 4" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:330;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button4
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button5" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:440;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button 5
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button6" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:550;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button 6
				</div>
				</a>
				<a href="#" class="menuGreen">
				<div id="Button7" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:109px; height:51px; position:absolute; left:660;" onMouseOver="divOn(this.id);" onMouseOut="divOff(this.id);">
					<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>Button 7
				</div>
				</a>
				<div id="ButtonFiller" style="background:url(/images/ButtonBG50.png) top center repeat-x; width:190px; height:51px; position:absolute; left:770;">
					&nbsp;
				</div>
			</div>
			<!-- End Button Bar -->
		</div>
		<!-- End Header -->
		<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
		<!-- Body -->
		<div align="left" id="BodyWrapper" style="width:960px; position:relative; top:0; left:0;">

<!-- Throw all this into "home.php" -->

			<div align="left" id="Video" style="width:350px; height:400px; position:relative; top:0; left:0; background-color:White;">
				<div id="VideoHeader" style="width:100%; height:25px; position:relative; top:0; left:0; background-color:#5D9844;">
				</div>
				<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
				<div align="center"><object width="320" height="265"><param name="movie" value="http://www.youtube.com/v/5HjVpVXI3Bo&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/5HjVpVXI3Bo&hl=en&fs=1&rel=0&color1=0x234900&color2=0x4e9e00" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="320" height="265"></embed></object></div>
				<div align="left" id="VideoTag" style="width:320; position:relative; top:0; left:15;" class="bodyBlack">
					<br>
					"Today I bought 9 items at CVS pharmacy and out of the register came 39 inches of receipt!"
					<br><br>
					<div align="right"><strong><em>- Comedian Orney Adams</em></strong></div>
				</div>
			</div>
			<div align="left" id="RegisterLogin" style="width:590px; height:250px; position:absolute; top:0; left:370; background-color:White;">
				<div id="RegisterLoginHeader" style="width:100%; height:25px; position:relative; top:0; left:0; background-color:#5D9844;">
				</div>
				<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
				<div align="center" class="xbigBlack">Register/Login<br><br><span class="bodyBlack">(Encouragement Promotion to Register for Service with CLEARLY MARKED link to do so.)</span></div>
			</div>
			<div align="left" id="LookupReceipt" style="width:590px; height:130px; position:absolute; top:270; left:370; background-color:White;">
				<div id="LookupReceiptHeader" style="width:100%; height:25px; position:relative; top:0; left:0; background-color:#5D9844;">
				</div>
				<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>
				<div align="center" class="xbigBlack">Receipt Lookup<br><br><span class="bodyBlack">(Lesser Promotion to just view and/or print a receipt without registering for service.)</span></div>
			</div>
			<img src="images/spacer.gif" alt="" width="1" height="15" border="0"><br>

<!-- end home.php -->

		</div>
		<!-- End Body -->
		<!-- Nifty Corners -->
		<span class="rbottomGreen">
			<span class="r4"></span><span class="r3"></span><span class="r2"></span><span class="r1"></span>
		</span>
	</div>
	<!-- End Border -->
</div>
<!-- End Wrapper -->




</body>
</html>
