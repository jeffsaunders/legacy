<?
// Start the session
session_start(); 

// Grab the database
include("../dbconnect.php");

// Define default settings
date_default_timezone_set('America/New_York');
setlocale(LC_MONETARY, 'en_US');
//ini_set('magic_quotes_runtime', 1);
//$pageWidth = 960;

// Grab my PHP functions library
include("../functions.php");

// Assign passed (via path/redirect) values
$sec = $_REQUEST['sec'];
$page = $_REQUEST['page'];
$cargo = $_REQUEST['cargo'];
$message = $_REQUEST['message'];
?>
<!DOCTYPE HTML><!-- HTML5 -->

<html>
<head>
	<title>Marmiro Stones Website Administration Portal</title>

	<!-- Show some style -->
	<link href="admin.css" rel="stylesheet" type="text/css">

	<!-- Common Scripts -->
	<script src="../js/common.js" type="text/javascript"></script>

	<!-- Load jQuery -->
	<script src="jquery-1.6.2.min.js"></script>
	<script src="jquery.tablednd_0_5.js"></script>

</head>

<body onLoad="<? if ($message != ""){?>alert('<?=$message;?>');<?}?>">

<br>
<table width="960" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td colspan="2" align="center" class="xbigBlack">Marmiro Stones - Website Administration Portal<br><br></td>
</tr>
<tr>
	<td width="210" valign="top" style="border-top:thin solid Black; border-left:thin solid Black; border-bottom:thin solid Black; background-color:#FFFFFF;" class="roundedTopLeft">
 		<div id="menuHeader" style="position:relative; top:0px; left:0px; width:210px; height:20px; padding:5px 5px 5px 10px; background-color:#000000; text-align:center;" class="roundedTopLeft">
			<strong class="bigWhite">Main Menu</strong>
		</div>
 		<div id="menuBody" style="position:relative; top:0px; left:20px; width:190px; padding:5px;">
			<? include("include/menu.php"); ?>
		</div>
	</td>
	<td width="750" valign="top" style="border:thin solid Black; background-color:#FFFFFF;" class="roundedTopRight">
 		<div id="contentHeader" style="position:relative; top:0px; left:0px; width:750px; height:20px; padding:5px; background-color:#000000; text-align:center;" class="roundedTopRight">
			<strong class="bigWhite">
			<?
			// Display page label based on "sec" value
			switch($sec){
				case "": break;
				case "site": echo "Global Site Settings"; break;
				case "home": echo "Home Page Settings"; break;
				case "about": echo "About Marmiro Stones Settings"; break;
				case "products": echo "Products Information Settings"; break;
				case "technical": echo "Technical Information Settings"; break;
				case "production": echo "Production Information Settings"; break;
				case "portfolio": echo "Portfolio Information Settings"; break;
				case "misc": echo "Miscellaneous Information Settings"; break;
				default: break;
			} // End Switch
			?>
			</strong>
		</div>
<!--		<div id="contentBody" style="position:relative; top:0px; left:0px; width:750px; height:650px; padding:5px 5px 5px 5px; overflow:auto;">-->
		<div id="contentBody" style="position:relative; top:0px; left:0px; width:750px; padding:5px 5px 5px 5px;">
			<?
			// Branch content based on "sec" value and include the appropriate content
			switch($sec){
				case "": include("include/default.php"); break;
				case "site": include("include/sitesettings.php"); break;
				case "home": include("include/homesettings.php"); break;
				case "about": include("include/aboutsettings.php"); break;
				case "products": include("include/productssettings.php"); break;
				case "technical": include("include/techsettings.php"); break;
				case "production": include("include/productionsettings.php"); break;
				case "portfolio": include("include/portfoliosettings.php"); break;
				case "misc": include("include/miscsettings.php"); break;
				default: include("include/default.php"); break;
			} // End Switch
			?>
		</div>
	</td>
</tr>
<tr>
	<td>&nbsp;&nbsp;<a href="/" class="menuBlack"><strong>View Website</strong></a></td>
	<td align="right">Copyright&copy; 2010-<?=date('Y');?>, MARMIRO STONES. All Rights Reserved.&nbsp;&nbsp;</td>
</tr>
</table>
<br>

</body>
</html>
