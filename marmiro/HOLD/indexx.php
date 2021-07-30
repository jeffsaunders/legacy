<?
// Start the session
session_start(); 

// Grab the database
include("dbconnect.php");

// Define default settings
$query = "SELECT * FROM config;";
//echo $query."<br><br>";
$rs_config = mysql_query($query, $linkID);
$config = mysql_fetch_assoc($rs_config);

date_default_timezone_set('America/New_York');
setlocale(LC_MONETARY, 'en_US');
$pageWidth = 960;


// Grab my PHP functions library
include("functions.php");

// Assign passed (via path/redirect) values
$sec = $_REQUEST['sec'];
$prod = $_REQUEST['prod'];
$tab = $_REQUEST['tab'];
echo "<span style='color:#252525;'>SEC=".$sec."<br></span>";
echo "<span style='color:#252525;'>PRODUCT=".$prod."<br></span>";
echo "<span style='color:#252525;'>TAB=".$tab."<br></span>";
?>
<!DOCTYPE html><!--HTML5-->

<html>
<head>
	<title>Marmiro Stone - Marbles, Sandstone, Travertine, Granite Marble, Marble Slab</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta name="language" content="EN">
	<meta name="copyright" content="Copyright  MARMIRO STONES © 2010-2011">
	<meta name="robots" content="index, follow">
	<meta name="revisit-after" content="2 days">
	<meta name="author" content=marmiro.com>
	<meta name="document-classification" content=" Marbles, Sandstone"> 
<!--	<meta name="google-site-verification" content="esFFkyCOOY8EjZkEtb2ZFu4Hl3EoU6lMsYt8ez8WfcA">-->
	<meta name="Keywords" content="marbles,sandstone,travertine,granite marble,marble slab,marble tiles,granite worktops,granite countertops,slate flooring,limestone tiles,marble fireplaces,travertine flooring,granite supplier,granite stones">
	<meta name="Description" content="marmiro are the suppliers of marbles,sandstone,travertine,granite marble where you can see over 500 varieties of stock stone tile all around the world"> 

	<!-- Define Home Base -->
<!--	<base href="/">-->

	<!-- Load Style Sheets -->
	<![if (!IE)|(IE 9)]>
	<link href="marmiroo.css" rel="stylesheet" type="text/css">
	<![endif]>
	<!--[if lt IE 9]>
	<link href="marmiro-ie.css" rel="stylesheet" type="text/css">
	<![endif]-->
	<link href="lightview.css" rel="stylesheet" type="text/css">

	<!-- Common Scripts -->
	<script src="/js/common.js" type="text/javascript"></script>

	<!-- Lightview Scripts -->
<!--	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/prototype/1/prototype.js'></script>
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/scriptaculous/1/scriptaculous.js'></script>
	<script type='text/javascript' src='/js/lightview.js'></script>-->

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.7/prototype.js"></script>
<!--	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.7/prototype_update_helper.js"></script>-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/effects.js"></script>
	<script type="text/javascript" src="/js/lightview.js"></script>
</head>

<body onResize="window.location.reload(true);window.location=window.location;">

<script>
	// Determine left side coordinate for centered page to build site container
	// Must be interrogated within <body> tags
	browserWidth = document.body.clientWidth;
	document.write('<style>.pageContainer {position:absolute; top:0px; left:'+((browserWidth/2)-(960/2))+'px; width:960;}</style>');
</script>

<div id="pageContainer" class="pageContainer">
	<!-- Header -->
	<div id="headerContainer">
		<img src="images/HeaderLogo.jpg" alt="Marmiro Stones by Turan Bekisoglu" width="307" height="84" border="0">
		<?
		if (!$sec || $sec == "home"){
		?>
		<div id="soundModule">
			<object style="vertical-align:bottom;" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="60" height="30">
				<param name="movie" value="soundModule.swf">
				<param name="quality" value="high">
				<embed src="soundModule.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="60" height="30"></embed>
			</object>
		</div>
		<?
		}
		?>
	</div>
	<!-- Main Body Container -->
	<div id="bodyContainer">
		<!-- Menu -->
		<?
		// Get top level menu items
		$query = "SELECT * FROM menu WHERE menu_level = '1' AND display = 'T' ORDER BY menu_position ASC;";
//echo $query."<br><br>";
		$rs_menu = mysql_query($query, $linkID);
		?>
		<script>
			// Force hide any dropped-down menus that may not have closed due to a missed exit event
			function hideAll(){
				<?
				while ($level1 = mysql_fetch_assoc($rs_menu)){
				?>
				if(document.getElementById('menu<?=$level1["menu_group"];?>Dropdown')){
					hide('menu<?=$level1["menu_group"];?>Dropdown');
				}
				<?
				}
				?>
			}

			// Show drop down menu
			function showMenu(id){
				document.getElementById(id).style.backgroundColor="#686868";
				if(document.getElementById(id+'Dropdown')){
					show(id+'Dropdown');
				}
			}

			// Hide drop down menu
			function hideMenu(id){
				document.getElementById(id).style.backgroundColor="#252525";
				if(document.getElementById(id+'Dropdown')){
					hide(id+'Dropdown');
				}
			}

			// Change the background back (upon leaving) on the top level menu element UNLESS it's accompanying dropdown is visible
			function leaveMenu(id){
				if(document.getElementById(id+'Dropdown')){
					if(document.getElementById(id+'Dropdown').style.visibility = "hidden"){
						document.getElementById(id).style.backgroundColor="#252525";
					}
				}else{
					document.getElementById(id).style.backgroundColor="#252525";
				}
			}
		</script>

		<div id="menuContainer">
			<ul id="menuLevel1">
				<?
				// Go back to the top of the level 1 menu items result set
				mysql_data_seek($rs_menu, 0);
				while ($level1 = mysql_fetch_assoc($rs_menu)){
				?>
				<li id="menu<?=$level1["menu_group"];?>" onMouseOver="hideAll(); showMenu(this.id);" onMouseOut="leaveMenu(this.id);"><a href="<?=iif($level1["link"] == "", "javascript:void();", $level1["link"]);?>"><?=strtoupper($level1["label"]);?></a>
				<?
					$query = "SELECT * FROM menu WHERE menu_level = '2' AND menu_group = '". $level1['menu_group'] ."' AND display = 'T' ORDER BY menu_position ASC;";
//echo $query."<br><br>";
					$rs_dropdown = mysql_query($query, $linkID);
					if (mysql_num_rows($rs_dropdown) > 0){
				?>
					<div id="menu<?=$level1["menu_group"];?>Dropdown" style="display:none; visibility:hidden; z-index:2;" onMouseOut="hideMenu('menu<?=$level1["menu_group"];?>');" onMouseLeave="hideMenu('menu<?=$level1["menu_group"];?>');">
					<ul class="menuLevel2">
				<?
						while ($level2 = mysql_fetch_assoc($rs_dropdown)){
				?>
						<li><a href="<?=$level2["link"];?>"><?=strtoupper($level2["label"]);?></a></li>
				<?
						}
				?>
					</ul>
					</div>
				<?
					}
				?>
				</li>
				<?
				}
				?>
			</ul>
		</div>		

		<img src="images/spacer.gif" alt="" width="1" height="7" border="0"><br>
		<!-- Dynamic Content -->
		<div id="contentContainer">
			<?
			// Branch content based on "sec" value
			switch($sec){
				case "": include("include/home.php");break;
				case "home": include("include/home.php");break;
				case "products": include("include/products.php");break;
				case "aboutstone": include("include/aboutstone.php");break;
				case "guidelines": include("include/guidelines.php");break;
				case "packaging": include("include/packaging.php");break;
				case "faq": include("include/faq.php");break;
				default: include("include/home.php");break;
			} // End Switch
			?>
		</div>
	</div>
	<!-- Footer -->
	<div id="footerContainer">
		<div id="footerContact">
			1-888-MARMIRO (627-6476)&nbsp;&nbsp;::&nbsp;
			Find us on&nbsp;&nbsp;<a href="http://www.facebook.com/marmirostones" target="_blank"><img src="images/FacebookBug.png" width="19" height="19" alt="Find Us On FaceBook" border="0"></a>&nbsp;
			<a href="http://twitter.com/MarmiroStones" target="_blank"><img src="images/TwitterBug.png" width="19" height="19" alt="Follow Us On Twitter" border="0"></a>&nbsp;
			<a href="http://www.youtube.com/watch?v=T4QGnG6Hxjk" target="_blank"><img src="images/YouTubeBug.png" width="20" height="19" alt="Watch Us On YouTube" border="0"></a>
		</div>
		<div id="footerCopyright">
			<a href="?sec=privacy">PRIVACY</a>&nbsp;&nbsp;|&nbsp;&nbsp;Copyright&copy; 2010-<?=date('Y');?>, MARMIRO STONES. All Rights Reserved.
		</div>
	</div>
	<br>
</div>	

</body>
</html>
