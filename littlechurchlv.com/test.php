<?
// Assign passed (via path) values
// Blow apart the passed path
$aPath = explode("/",$_SERVER['PATH_INFO']);
//print_r($aPath);
// Assign passed values
$page = $aPath[0];
//if ($aPath[2] != "reservations"){
	$sec = $aPath[1];
	if ($_REQUEST['sec'] != "") $sec = $_REQUEST['sec']; //Override the path element if explicitely passed (probably from a form)
	$feature = $aPath[2];
	if ($_REQUEST['feature'] != "") $feature = $_REQUEST['feature']; //Override the path element if explicitely passed (probably from a form)
	$task = $aPath[3];
	if ($_REQUEST['task'] != "") $task = $_REQUEST['task']; //Override the path element if explicitely passed (probably from a form)
	$message = $aPath[4];
	if ($_REQUEST['message'] != "") $message = $_REQUEST['message']; //Override the path element if explicitely passed (probably from a form)
	$test = $aPath[5];
	if ($_REQUEST['test'] != "") $test = $_REQUEST['test']; //Override the path element if explicitely passed (probably from a form)
//}else{
//	$sec = $aPath[2];
//	if ($_REQUEST['sec'] != "") $sec = $_REQUEST['sec']; //Override the path element if explicitely passed (probably from a form)
//	$feature = $aPath[3];
//	if ($_REQUEST['feature'] != "") $feature = $_REQUEST['feature']; //Override the path element if explicitely passed (probably from a form)
//	$task = $aPath[4];
//	if ($_REQUEST['task'] != "") $task = $_REQUEST['task']; //Override the path element if explicitely passed (probably from a form)
//	$message = $aPath[5];
//	if ($_REQUEST['message'] != "") $message = $_REQUEST['message']; //Override the path element if explicitely passed (probably from a form)
//	$test = $aPath[6];
//	if ($_REQUEST['test'] != "") $test = $_REQUEST['test']; //Override the path element if explicitely passed (probably from a form)
//}
//echo $page;
//echo $sec;
//echo $navigator_user_agent;
?>
<?
// PRELIMINARIES
session_start(); 
// Are we in test mode?
if ($test != "T"){
	// If FIRST page of reservation - start a session
	if ($sec == "reservations" && (!$feature || $feature == "1")){
		session_cache_expire(20); //20 minutes
		header("Cache-control: private"); // Maintain forms data
		$_SESSION['SID'] = session_id();
		$SID = session_id();
	}
	// If LAST page of reservation - kill the session
	if ($sec == "reservations" && $feature == "4"){
//echo $SID."<br>";
		// Kill the session and start a new one
		session_cache_expire(20); //20 minutes
		session_start();
		$_SESSION = array(); 
		if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
		session_regenerate_id(true);
		$_SESSION['SID'] = session_id();
		$SID = $_SESSION['SID'];
//echo $SID."<br>";
	}
	// If SSL connection and NOT a reservation then break out - mostly for site use after a reservation
	if ($_SERVER["HTTPS"] && ($sec != "reservations" && $feature != "limousine" && $feature != "limousine_new")){
//	if ($_SERVER["HTTPS"] && ($sec != "reservations" && $feature != "limousine")){
		$destination = "http://www.littlechurchlv.com/".$_SERVER['REQUEST_URI'];
//echo $destination;
		header("Location: $destination");
		exit;
	}
//echo $SID."<br>";
}

// Is this the first time we've been here in this session?
$playAnimation = 0;
if (!$_SESSION['FirstTime'] || $_SESSION['FirstTime'] != 1){
	$playAnimation = 1;
	$_SESSION['FirstTime'] = 1;
}

// If SSL connection and NOT a reservation then break out - mostly for site use after a reservation
if ($_SERVER["HTTPS"] && $sec != "reservations" && $feature != "limousine" && $feature != "limousine_new"){
//if ($_SERVER["HTTPS"] && $sec != "reservations" && $feature != "limousine"){
	$destination = "http://www.littlechurchlv.com/".$_SERVER['REQUEST_URI'];
//echo $destination;
	header("Location: $destination");
	exit;
}

// Grab the database
include("dbconnect.php");

// Load the config settings
$query = "SELECT * FROM config";
$rs_config = mysql_query($query, $linkID);
$config = mysql_fetch_assoc($rs_config);
$rs_config2 = mysql_query($query, $linkID2);
$config2 = mysql_fetch_assoc($rs_config2);

// Set SEO info based on "sec" & "task" values
switch($sec){
	case "":
		$title = $config2["home_seo_title"];
		$description = $config2["home_seo_description"];
		$keywords = $config2["home_seo_keywords"];
		break;
	case "home":
		$title = $config2["home_seo_title"];
		$description = $config2["home_seo_description"];
		$keywords = $config2["home_seo_keywords"];
		break;
	case "experience":
		if ($feature == "testimonials"){
			$title = $config2["testimonials_seo_title"];
			$description = $config2["testimonials_seo_description"];
			$keywords = $config2["testimonials_seo_keywords"];
			break;
		}elseif ($feature == "history"){
			$title = $config2["history_seo_title"];
			$description = $config2["history_seo_description"];
			$keywords = $config2["history_seo_keywords"];
			break;
		}elseif ($feature == "news"){
			$title = $config2["news_seo_title"];
			$description = $config2["news_seo_description"];
			$keywords = $config2["news_seo_keywords"];
			break;
		}else{ //$feature == "gallery"
			if ($task == "grounds"){
				$title = $config2["gallery_grounds_seo_title"];
				$description = $config2["gallery_grounds_seo_description"];
				$keywords = $config2["gallery_grounds_seo_keywords"];
				break;
			}else{ //$task == "chapel"
				$title = $config2["gallery_chapel_seo_title"];
				$description = $config2["gallery_chapel_seo_description"];
				$keywords = $config2["gallery_chapel_seo_keywords"];
				break;
			}
		}
		break;
	case "packages":
		if ($feature == "weddings"){
			$title = $config2["wedding_package_seo_title"];
			$description = $config2["wedding_package_seo_description"];
			$keywords = $config2["wedding_package_seo_keywords"];
			break;
		}elseif ($feature == "renewals"){
			$title = $config2["renewal_package_seo_title"];
			$description = $config2["renewal_package_seo_description"];
			$keywords = $config2["renewal_package_seo_keywords"];
			break;
		}else{ //$feature == "featured"
			$title = $config2["featured_package_seo_title"];
			$description = $config2["featured_package_seo_description"];
			$keywords = $config2["featured_package_seo_keywords"];
			break;
		}
	break;
	case "packagedetails":
		// Grab SEO info for individual packages
		$query = "SELECT * FROM packages WHERE package_type = '".ucfirst($feature)."' AND package_name = '".addslashes($task)."' AND (package_expires = '0000-00-00' OR package_expires >= NOW()) AND display = 'T';";
//echo $query;
		$rs_package = mysql_query($query, $linkID2) or die(mysql_error());
		$package = mysql_fetch_assoc($rs_package);
		$title = $package["seo_title"];
		$description = $package["seo_description"];
		$keywords = $package["seo_keywords"];
		break;
	case "services":
		if ($feature == "photography"){
			$title = $config2["photography_seo_title"];
			$description = $config2["photography_seo_description"];
			$keywords = $config2["photography_seo_keywords"];
			break;
		}elseif ($feature == "additional"){
			$title = $config2["additional_services_seo_title"];
			$description = $config2["additional_services_seo_description"];
			$keywords = $config2["additional_services_seo_keywords"];
			break;
		}elseif ($feature == "limousine"){
			$title = $config2["limousine_seo_title"];
			$description = $config2["limousine_seo_description"];
			$keywords = $config2["limousine_seo_keywords"];
			break;
		}else{ //$task == "flowers"
			$title = $config2["gallery_flowers_seo_title"];
			$description = $config2["gallery_flowers_seo_description"];
			$keywords = $config2["gallery_flowers_seo_keywords"];
			break;
		}
	case "guests":
		if ($feature == "webcam"){
			$title = $config2["webcam_seo_title"];
			$description = $config2["webcam_seo_description"];
			$keywords = $config2["webcam_seo_keywords"];
			break;
		}
		break;
	case "questions":
		$title = $config2["questions_seo_title"];
		$description = $config2["questions_seo_description"];
		$keywords = $config2["questions_seo_keywords"];
		break;
	case "reservations":
		$title = $config2["reservations_seo_title"];
		$description = $config2["reservations_seo_description"];
		$keywords = $config2["reservations_seo_keywords"];
		break;
	case "contact":
		if ($feature == "feedback"){
			$title = $config2["feedback_seo_title"];
			$description = $config2["feedback_seo_description"];
			$keywords = $config2["feedback_seo_keywords"];
			break;
		}else{ //$feature == "message"
			$title = $config2["message_seo_title"];
			$description = $config2["message_seo_description"];
			$keywords = $config2["message_seo_keywords"];
			break;
		}
		break;
	case "privacy":
		$title = $config2["privacy_seo_title"];
		$description = $config2["privacy_seo_description"];
		$keywords = $config2["privacy_seo_keywords"];
		break;
	case "terms":
		$title = $config2["terms_seo_title"];
		$description = $config2["terms_seo_description"];
		$keywords = $config2["terms_seo_keywords"];
		break;
	case "sitemap":
		$title = $config2["sitemap_seo_title"];
		$description = $config2["sitemap_seo_description"];
		$keywords = $config2["sitemap_seo_keywords"];
		break;
	default:
		$title = $config2["home_seo_title"];
		$description = $config2["home_seo_description"];
		$keywords = $config2["home_seo_keywords"];
		break;
} // End Switch

// Set up the Captcha - Do this here because we load the contact form twice on some pages and the second load overwrites these values
// Build array of the alphabet (upper)
$upperLetters = range(A,Z);
// Generate 2 random numbers
$num1 = rand(1, 9);
$num2 = rand(0, 9);
// Grab the letters at those postitions
$letter1 = strtolower($upperLetters[$num1]);
$letter2 = strtolower($upperLetters[$num2]);
// Calculate the answer for later
$answer = $num1 + $num2;
$_SESSION['Captcha'] = $answer;
// Build some dummy strings to pad the 2 important letters being passed
$lString1 = strtolower($upperLetters[rand(0, 25)]).strtoupper($upperLetters[rand(0, 25)]);
$rString1 = strtolower($upperLetters[rand(0, 25)]).strtolower($upperLetters[rand(0, 25)]).strtoupper($upperLetters[rand(0, 25)]);
$lString2 = strtolower($upperLetters[rand(0, 25)]).strtolower($upperLetters[rand(0, 25)]).strtoupper($upperLetters[rand(0, 25)]);
$rString2 = strtolower($upperLetters[rand(0, 25)]).strtoupper($upperLetters[rand(0, 25)]);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<!-- These are all attempts to get the background to stay fixed in IE - AAAAAAAAAAAAAAAAAAAAAA -->
<!-- There should be NO output above the DocType declaration or IE will go into "quirks mode" -->
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Strict//EN"> <!--This is the best solution but will require cleanup -->
<!--<!DOCTYPE HTML> <!--html5...this worked for IE but screwed everything else up -->
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">-->
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">-->
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">-->

<!-- PHP Functions -->
<? include("functions.php"); ?>

<!-- Test for Browser -->
<? $navigator_user_agent = (isset( $_SERVER['HTTP_USER_AGENT']))?strtolower($_SERVER['HTTP_USER_AGENT']):''; ?>

<html>
<head>
	<title><?=$title;?></title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Weddings">
	<meta name="description" content="<?=$description;?>">
	<meta name="keywords" content="<?=$keywords;?>">
	<meta name="google-site-verification" content="1P_tJRNY0br4pORefcClFyFNzNaIAe-cQC5jxWzTTjY">

	<!-- Define Home Base -->
	<?
	// If in reservation or limo section make base SSL URL
	if ($sec == "reservations" || $feature == "limousine" || $feature == "limousine_new"){
//	if ($sec == "reservations" || $feature == "limousine"){
//		echo'<base href="https://secure.nr.net/littlechurchlv/">';
		echo'<base href="http://littlechurchlv.com/">';
	}else{
		echo'<base href="http://littlechurchlv.com/">';
	}
	?>

	<!-- Load Style Sheets -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<!-- Common Scripts -->
	<script language="JavaScript" src="standard.js" type="text/javascript"></script>

	<!-- Custom Scripts -->
	<script language="JavaScript" src="custom.js" type="text/javascript"></script>

</head>

<!-- Tracking -->
<?
// Added for Addvisors
if ($sec == "reservations" || $feature == "limousine" || $feature == "limousine_new"){
//if ($sec == "reservations" || $feature == "limousine"){
//	echo '<script src="https://ssl.google-analytics.com/urchin.js" type="text/javascript"></script>';
	echo '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>';
}else{
	echo '<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>';
}
?>

<script type="text/javascript">
	_uacct = "UA-1640091-1";
	urchinTracker();
</script>

<body bgcolor="#770025" leftmargin="0" topmargin="0" marginwidth="0" onResize="window.location.reload(true);window.location=window.location;" onLoad="void(0);">

<!-- Calculate browser width -->
<script language="JavaScript1.2">
	// Must be interrogated within <body> tags
	wdth = document.body.clientWidth;
	document.write('<style>.forgroundcontent {z-index:10; position:absolute; top:0; left:'+((wdth/2)-480)+'px;}</style>');
</script>

<!-- Place scaled background -->
<?
if (!stristr($navigator_user_agent, "msie")){ //Not IE
?>
<div>
	<img id="background" src="images/Background.jpg" alt="" title=""> 
</div>
<?
}else{ //IE
?>
<style type="text/css">
	/*
	Fix for IE5 & IE6 not having "position:fixed" support.
	Even though IE7+ DOES have it, it only works in STRICT DOCTYPE mode...
	this covers them all, even in QUIRKS/TRADITIONAL/TRANSITIONAL mode.
	*/
	* html div#fixed{ position:absolute; top:expression(eval(document.compatMode && document.compatMode=='CSS1Compat') ? documentElement.scrollTop : document.body.scrollTop); z-index:-1; width:100%; height:99%; } /* 100% causes endless scroll */
	* html,* html body{ background: #fff url(images/spacer.gif) fixed; }
</style>
<div id="fixed">
	<img src="images/Background.jpg" alt="" width="100%" height="100%" border="0"> 
</div>
<?
}
?>

<!-- Wrap foreground in a div so it can be layed on top of scaled background -->
<a name="top" id="top">
<div align="center" class="forgroundcontent">
	<table width="960" border="0" cellspacing="0" cellpadding="0" align="center">
	<!-- Header -->
	<tr>
		<td>
			<img src="images/spacer.gif" alt="" width="1" height="130" border="0">
			<!-- Logo -->
			<div style="position:absolute; top:5; left:15; z-index:20;">
<!--				<img src="images/HeaderLogo.png" alt="" width="219" height="170" border="0">-->
				<img src="images/HeaderLogo.png" alt="" width="190" border="0">
			</div>
			<div style="position:absolute; top:5; right:15; z-index:20;">
				<table border="0" cellspacing="5" cellpadding="0">
				<tr>
					<td valign="top">
						<!-- Badges -->
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="44" border="0"></td>
						</tr>
						<tr>
							<td valign="top">
								<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="center" valign="top">
										<!-- Facebook Badge -->
										<a href="http://www.facebook.com/pages/Las-Vegas-NV/Little-Church-of-the-West/128461487175584" target="_blank"><img src="images/Facebook.png" title="Find Us on Facebook" width="75" height="75" border="0"></a>
									</td>
									<td align="center" valign="top">
										<!-- National Parks Badge -->
										<a href="http://www.hmdb.org/marker.asp?marker=29215" target="_blank"><img src="images/NationalRegister.png" title="Placed on the National Register of Historic Places" width="75" height="75" border="0"></a>
									</td>
									<td align="center" valign="top">
										<!-- Best of Las Vegas Badge -->
										<a href="http://bestoflasvegas.com/2010/locations/best-wedding-chapel" target="_blank"><img src="images/BOLV.png" title="Voted Best Wedding Chapel in Las Vegas 13 Years in a Row!" width="75" height="75" border="0"></a><br><strong class="bodyWhite">13<sup class="smallWhite">th</sup> Year!&nbsp;</strong>
									</td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
					<td>
						<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
					</td>
					<td valign="top">
						<!-- Business Info -->
						<img src="images/spacer.gif" alt="" width="1" height="35" border="0">
						<table border="0" cellspacing="5" cellpadding="0">
						<tr>
							<td valign="bottom" class="bigWhite"><strong>Open 8 AM to 12 Midnight Pacific Time, Daily</strong></td>
						</tr>
						<tr>
							<td class="bigWhite">
								<table border="0" cellspacing="0" cellpadding="0" align="center" class="xbigWhite">
								<tr>
									<td><strong>800.821.2452 <span class="bodyWhite"><em>(Toll-Free Outside Nevada)</em></span></strong></td>
								</tr>
								<tr>
									<td><strong>702.739.7971 </span><span class="bodyWhite"><em>(Inside Nevada & International)</em></span></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td valign="top" class="bodyWhite">
								<a href="javascript:void(0)" onClick="show('directionsLayer')" class="bigWhite"><strong>Click Here for Directions to the Chapel</strong></a>
							</td>
						</tr>
<!--						<tr>
							<td align="right" class="smallBlack">
								<img src="images/spacer.gif" alt="" width="1" height="<?=iif(stristr($navigator_user_agent, "msie"), "25", "15");?>" border="0"><br>
								<a href="" class="smallBlack"><strong>My Wedding (Login)</strong></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0">
							</td>
						</tr>-->
						</table>
					</td>
				</tr>
				</table>
			</div>
		</td>
	</tr>
	<!-- Body Top -->
	<tr>
		<td background="images/BodyBGTop.png">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td><img src="images/spacer.gif" alt="" width="80" height="55" border="0"></td>
				<!-- Tagline -->
				<td valign="bottom"><img src="images/Tagline.png" alt="" width="345" height="25" border="0"></td>
				<td><img src="images/spacer.gif" alt="" width="465" height="55" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Menu Bar -->
	<tr>
		<td align="center" background="images/BodyBGMiddle.png">
			<!-- Flourish -->
			<img src="images/MenuBar.png" alt="" width="900" height="23" border="0">
			<!-- Buttons (tabs) -->
			<div class="menucontent">
				<script>
				// function to pop open drop menu and force all OTHER drop menus closed upon mouseOver
				// ...to cover for all too often missed mouseOut events
				function popMenu(id){
					var aMenu=["experience","packages","services","contact"]; // menu names
					for (m=0;m<=aMenu.length-1;m++){
						if (id == aMenu[m]+"DropMenu"){
							show(id);
						}else{
							hide(aMenu[m]+"DropMenu");
						}
					}
				}
				// function to close div upon mouse out
				// tests for event element (DIV) to avoid event bubbling triggers
				function menuOut(event,id){
					if (window.event && event.srcElement.tagName == "DIV"){  //IE
						hide(id);
					}else if (!window.event && event.target.tagName == "DIV"){ //Firefox, Chrome, Safari, and everyone else
						hide(id);
					}
				}

				// Move to the contact form
				function popContact(theForm){
					if (document.getElementById(theForm)){ //The form is already on the page
						window.location="<?=$_SERVER['REQUEST_URI']?>#contact"; //Go to it!
						document.getElementById(theForm).name.focus(); //Put the cursor in the name field
					}else{
						show('contactLayer'); //Pop the form up
						window.location="<?=$_SERVER['REQUEST_URI']?>#top"; //Go to it!
						document.getElementById('contactDiv').name.focus(); //Put the cursor in the name field
					}
				}
				</script>	
				<!-- The following block is the menu.  It needs to be formatted just as it is in order-->
				<!-- to maintain proper spacing so that the drop menus align properly. -->
				<!-- ...I know, editing it is a nightmare but it shouldn't need to be modified that often. --> 
				<table width="880" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<!-- Home -->
					<td width="110">
						<a href="index/home" onMouseOver="imgOn('btn1');popMenu();" onMouseOut="imgOff('btn1')" onMouseLeave="imgOff('btn1')" title="The Little Church Home Page"><img src="images/Buttons/Home-Off.png" alt="Home" name="btn1" id="btn1" width="110" height="30" border="0"></a>
					</td>
					<!-- Experience -->
					<td width="110">
						<a href="#" onMouseOver="popMenu('experienceDropMenu');" title="All About the Little Church"><img src="images/Buttons/AboutUs-Off.png" alt="Experience" name="btn2" id="btn2" width="110" height="30" border="0"></a>
						<div id="experienceDropMenu" style="position:absolute; top:0; left:<?=iif(stristr($navigator_user_agent, "msie"), "110", "150");?>; width:110; text-align:left; z-index:10000; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);">
							<img src="images/Buttons/AboutUs-On.png" alt="About Us" title="See The Difference" width="110" height="30" border="0">
							<div id="experienceMenu" style="position:absolute; top:30; left:0; width:165; z-index:10001; padding-left:10px; padding-right:10px; background-image:url(images/MenuBottom2.png); background-position:bottom left; background-repeat:no-repeat;" class="dropmenuBurgundy">
								<!--<li><a href="index/experience/gallery/photos" title="Photo Gallery" class="dropmenuBurgundy">Photo Gallery</a></li>-->
								<!--<li><a href="index/experience/gallery/chapel" title="Tour Our Chapel Interior" class="dropmenuBurgundy">Chapel Interior</a></li>-->
								<li><a href="index/experience/gallery/grounds" title="Tour Our Chapel Grounds" class="dropmenuBurgundy">Chapel Grounds</a></li>
								<li><a href="index/experience/gallery/chapel" title="Tour Our Chapel Interior" class="dropmenuBurgundy">Chapel Interior</a></li>
								<li><a href="index/experience/history" title="The Rich History of The Little Church of the West" class="dropmenuBurgundy">Chapel History</a></li>
								<li><a href="index/experience/news" title="The Little Church of the West in the News" class="dropmenuBurgundy">News/Press</a></li>
								<li><a href="index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families" class="dropmenuBurgundy">Testimonials</a></li>
								<li><a href="index/questions" title="Frequently Asked Questions & Answers" class="dropmenuBurgundy">Questions</a></li>
								<!--<li><a href="images/LittleChurchBrochure2010.pdf" title="Download Our Brochure" target="_blank" class="dropmenuBurgundy">View Brochure</a></li>-->
								<?=iif(stristr($navigator_user_agent, "msie"), "<br>", "");?><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br>
							</div>
						</div>
					</td>
					<!-- Packages -->
					<td width="110">
						<a href="#" onMouseOver="popMenu('packagesDropMenu');" title="Convenient Pre-Designed Ceremony Packages"><img src="images/Buttons/Packages-Off.png" alt="Packages" name="btn3" id="btn3" width="110" height="30" border="0"></a>
						<div id="packagesDropMenu" style="position:absolute; top:0; left:<?=iif(stristr($navigator_user_agent, "msie"), "220", "260");?>; width:110; text-align:left; z-index:10000; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);">
							<img src="images/Buttons/Packages-On.png" alt="Packages" title="Convenient Pre-Designed Ceremony Packages" width="110" height="30" border="0">
							<div id="packagesMenu" style="position:absolute; top:30; left:0; width:165; z-index:10001; padding-left:10px; padding-right:10px; background-image:url(images/MenuBottom2.png); background-position:bottom left; background-repeat:no-repeat;" class="dropmenuBurgundy">
								<li><a href="index/packages/weddings" title="Wedding Ceremony Packages" class="dropmenuBurgundy">Weddings</a></li>
								<li><a href="index/packages/renewals" title="Vow Renewal Ceremony Packages" class="dropmenuBurgundy">Vow Renewals</a></li>
								<li><a href="index/packages/featured" title="Special Themed or Featured Ceremony Packages" class="dropmenuBurgundy">Featured</a></li>
								<?=iif(stristr($navigator_user_agent, "msie"), "<br>", "");?><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br>
							</div>
						</div>
					</td>
					<!-- Services -->
					<td width="110">
						<a href="#" onMouseOver="popMenu('servicesDropMenu');" title="Additional Services"><img src="images/Buttons/Services-Off.png" alt="Services" name="btn4" id="btn4" width="110" height="30" border="0"></a>
						<div id="servicesDropMenu" style="position:absolute; top:0; left:<?=iif(stristr($navigator_user_agent, "msie"), "330", "370");?>; width:110; text-align:left; z-index:10000; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);">
							<img src="images/Buttons/Services-On.png" alt="Services" title="Additional Services For Your Convenience" width="110" height="30" border="0">
							<div id="servicesMenu" style="position:absolute; top:30; left:0; width:165; z-index:10001; padding-left:10px; padding-right:10px; background-image:url(images/MenuBottom2.png); background-position:bottom left; background-repeat:no-repeat;" class="dropmenuBurgundy">
								<li><a href="index/services/flowers" title="Floral Arrangement Photo Gallery" class="dropmenuBurgundy">Flower Gallery</a></li>
								<li><a href="index/services/photography" title="Professional Photography Services" class="dropmenuBurgundy">Photography</a></li>
								<li><!--<a href="https://secure.nr.net/littlechurchlv/index/services/limousine" title="Limousine Service Packages & Tours" class="dropmenuBurgundy">--><a href="index/services/limousine" title="Limousine Service Packages & Tours" class="dropmenuBurgundy">Limousine</a></li>
								<li><a href="index/services/additional" title="Additional Services For Your Convenience" class="dropmenuBurgundy">Added Services</a></li>
								<?=iif(stristr($navigator_user_agent, "msie"), "<br>", "");?><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br>
							</div>
						</div>
					</td>
					<!-- Webcam -->
					<td width="110">
						<!--<a href="javascript:void(0)" onclick="show('WebcamChoice')" onMouseOver="imgOn('btn5');popMenu();" onMouseOut="imgOff('btn5')" onMouseLeave="imgOff('btn5')" title="Streaming Wedding Videos (Premium Service)">--><a href="index/guests/webcam" onMouseOver="imgOn('btn5');popMenu();" onMouseOut="imgOff('btn5')" onMouseLeave="imgOff('btn5')" title="Streaming Wedding Videos (Premium Service)"><img src="images/Buttons/Webcam-Off.png" alt="Webcam" name="btn5" id="btn5" width="110" height="30" border="0"></a>
					</td>
					<!-- Questions -->
					<td width="110">
						<a href="index/questions" onMouseOver="imgOn('btn6');popMenu();" onMouseOut="imgOff('btn6')" onMouseLeave="imgOff('btn6')" title="Frequently Asked Questions & Answers"><img src="images/Buttons/Questions-Off.png" alt="Questions" name="btn6" id="btn6" width="110" height="30" border="0"></a>
					</td>
					<!-- Contact -->
					<td width="110">
						<a href="index/contact" onMouseOver="popMenu('contactDropMenu');" title="Feel Free to Contact Us!"><img src="images/Buttons/Contact-Off.png" alt="Contact" name="btn8" id="btn8" width="110" height="30" border="0"></a>
						<div id="contactDropMenu" style="position:absolute; top:0; left:<?=iif(stristr($navigator_user_agent, "msie"), "660", "700");//770 810?>; width:110; text-align:left; z-index:10000; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);">
							<img src="images/Buttons/Contact-On.png" alt="Contact" title="Feel Free To Contact Us!" width="110" height="30" border="0">
							<div id="contactMenu" style="position:absolute; top:30; left:0; width:165; z-index:10001; padding-left:10px; padding-right:10px; background-image:url(images/MenuBottom2.png); background-position:bottom left; background-repeat:no-repeat;" class="dropmenuBurgundy">
								<li><a href="javascript:void(0)" onClick="show('directionsLayer')" title="Directions to our World Famous Location" class="dropmenuBurgundy">Directions</a></li>
								<li><a href="javascript:popContact('contactForm')" title="Leave Us A Message and We'll Get Back To You" class="dropmenuBurgundy">Contact Us</a></li>
								<li><a href="javascript:void(0)" onClick="show('feedbackLayer')" title="Tell Us What You Think - Testimonials Welcome!" class="dropmenuBurgundy">Leave Feedback</a></li>
								<li><a href="http://www.facebook.com/pages/Las-Vegas-NV/Little-Church-of-the-West/128461487175584"
target="_blank" title="Find Us on Facebook" class="dropmenuBurgundy">Our Facebook</a></li>
								<!--<li><a href="index/contact/chat" title="Chat Live With One Of Our Wedding Consultants" class="dropmenuBurgundy">Live Chat</a></li>-->
								<?=iif(stristr($navigator_user_agent, "msie"), "<br>", "");?><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br>
							</div>
						</div>
					</td>
					<!-- Reservations -->
					<td width="110">
						<!--<a href="https://secure.nr.net/littlechurchlv/index/reservations" onMouseOver="imgOn('btn7');popMenu();" onMouseOut="imgOff('btn7')" onMouseLeave="imgOff('btn7')" title="Our SECURE Reservation System">--><a href="index/reservations" onMouseOver="imgOn('btn7');popMenu();" onMouseOut="imgOff('btn7')" onMouseLeave="imgOff('btn7')" title="Our SECURE Reservation System"><img src="images/Buttons/Reservations-Off.png" alt="Reservations" name="btn7" id="btn7" width="110" height="30" border="0"></a>
					</td>
				</tr>
				</table>






<? if (1==2){ ?>
<div id="experienceDropMenu" style="position:absolute; top:-10; left:<?=iif(stristr($navigator_user_agent, "msie"), "100", "140");?>; z-index:10000; padding:10px; width:200; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);"><table width="110" cellspacing="0" cellpadding="0"><tr><td background="images/MenuBottom.png" class="smallBurgundy" style="background-position:bottom; background-repeat:no-repeat;"><img src="images/Buttons/AboutUs-On.png" alt="About Us" title="See The Difference" width="110" height="30" border="0"><div style="position:relative; left:5;"><!--<li><a href="index/experience/gallery/photos" title="Photo Gallery" class="smallBurgundy"><strong>Photo Gallery</strong></a></li>--><!--<li><a href="index/experience/gallery/chapel" title="Tour Our Chapel Interior" class="smallBurgundy"><strong>Chapel Interior</strong></a></li>--><li><a href="index/experience/gallery/grounds" title="Tour Our Chapel Grounds" class="smallBurgundy"><strong>Chapel Grounds</strong></a></li><li><a href="index/experience/gallery/chapel" title="Tour Our Chapel Interior" class="smallBurgundy"><strong>Chapel Interior</strong></a></li><li><a href="index/experience/history" title="The Rich History of The Little Church of the West" class="smallBurgundy"><strong>Chapel History</strong></a></li><li><a href="index/experience/news" title="The Little Church of the West in the News" class="smallBurgundy"><strong>News/Press</strong></a></li><li><a href="index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families" class="smallBurgundy"><strong>Testimonials</strong></a></li><li><a href="index/questions" title="Frequently Asked Questions & Answers" class="smallBurgundy"><strong>Questions</strong></a></li><!--<li><a href="images/LittleChurchBrochure2010.pdf" title="Download Our Brochure" target="_blank" class="smallBurgundy"><strong>View Brochure</strong></a></li>--></div><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br></td></tr></table></div>
<? } ?>






<? if (1==2){ ?>
<!---------- Packages ----------><a href="#" onMouseOver="popMenu('packagesDropMenu');" title="Convenient Pre-Designed Ceremony Packages"><img src="images/Buttons/Packages-Off.png" alt="Packages" name="btn3" id="btn3" width="110" height="30" border="0"></a><div id="packagesDropMenu" style="position:absolute; top:-10; left:<?=iif(stristr($navigator_user_agent, "msie"), "210", "250");?>; z-index:10000; padding:10px; width:110; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);"><table width="110" cellspacing="0" cellpadding="0"><tr><td background="images/MenuBottom.png" class="smallBurgundy" style="background-position:bottom; background-repeat:no-repeat;"><img src="images/Buttons/Packages-On.png" alt="Packages" title="Convenient Pre-Designed Ceremony Packages" width="110" height="30" border="0"><div style="position:relative; left:5;"><li><a href="index/packages/weddings" title="Wedding Ceremony Packages" class="smallBurgundy"><strong>Weddings</strong></a></li><li><a href="index/packages/renewals" title="Vow Renewal Ceremony Packages" class="smallBurgundy"><strong>Vow Renewals</strong></a></li><li><a href="index/packages/featured" title="Special Themed or Featured Ceremony Packages" class="smallBurgundy"><strong>Featured</strong></a></li></div><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br></td></tr></table></div><!---------- Services ----------><a href="#" onMouseOver="popMenu('servicesDropMenu');" title="Additional Services"><img src="images/Buttons/Services-Off.png" alt="Services" name="btn4" id="btn4" width="110" height="30" border="0"></a><div id="servicesDropMenu" style="position:absolute; top:-10; left:<?=iif(stristr($navigator_user_agent, "msie"), "320", "360");?>; z-index:10000; padding:10px; width:110; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);"><table width="110" cellspacing="0" cellpadding="0"><tr><td background="images/MenuBottom.png" class="smallBurgundy" style="background-position:bottom; background-repeat:no-repeat;"><img src="images/Buttons/Services-On.png" alt="Services" title="Additional Services For Your Convenience" width="110" height="30" border="0"><div style="position:relative; left:5;"><li><a href="index/services/flowers" title="Floral Arrangement Photo Gallery" class="smallBurgundy"><strong>Flower Gallery</strong></a></li><li><a href="index/services/photography" title="Professional Photography Services" class="smallBurgundy"><strong>Photography</strong></a></li><li><!--<a href="https://secure.nr.net/littlechurchlv/index/services/limousine" title="Limousine Service Packages & Tours" class="smallBurgundy">--><a href="index/services/limousine" title="Limousine Service Packages & Tours" class="smallBurgundy"><strong>Limousine</strong></a></li><li><a href="index/services/additional" title="Additional Services For Your Convenience" class="smallBurgundy"><strong>Added Services</strong></a></li></div><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br></td></tr></table></div><!---------- Webcam ----------><!--<a href="javascript:void(0)" onclick="show('WebcamChoice')" onMouseOver="imgOn('btn5');popMenu();" onMouseOut="imgOff('btn5')" onMouseLeave="imgOff('btn5')" title="Streaming Wedding Videos (Premium Service)">--><a href="index/guests/webcam" onMouseOver="imgOn('btn5');popMenu();" onMouseOut="imgOff('btn5')" onMouseLeave="imgOff('btn5')" title="Streaming Wedding Videos (Premium Service)"><img src="images/Buttons/Webcam-Off.png" alt="Webcam" name="btn5" id="btn5" width="110" height="30" border="0"></a><!---------- Guests ----------<a href="#" onMouseOver="popMenu('guestsDropMenu');" title="Guest Services"><img src="images/Buttons/Webcam-Off.png" alt="Guests" name="btn5" id="btn5" width="110" height="30" border="0"></a><div id="guestsDropMenu" style="position:absolute; top:-10; left:<?=iif(stristr($navigator_user_agent, "msie"), "430", "470");?>; z-index:10000; padding:10px; width:110; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);"><table width="110" cellspacing="0" cellpadding="0"><tr><td background="images/MenuBottom.png" class="smallBurgundy" style="background-position:bottom; background-repeat:no-repeat;"><img src="images/Buttons/Webcam-On.png" alt="Guest Services" title="Guest Services" width="110" height="30" border="0"><div style="position:relative; left:5;"><!--<li><a href="index/guests/gifts" title="Purchase Gifts" class="smallBurgundy"><strong>Gift Shop</strong></a></li><li><a href="index/guests/wishes" title="Leave Best Wishes for the Happy Couple" class="smallBurgundy"><strong>View Photos</strong></a></li><li><a href="index/guests/photos" title="View & Purchase Photos of the Happy Couple" class="smallBurgundy"><strong>Photo Shop</strong></a></li>--<li><a href="javascript:void(0)" onclick="show('WebcamChoice')" title="Streaming Wedding Videos (Premium Service)" class="smallBurgundy"><strong>Chapel Webcam</strong></a></li></div><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br></td></tr></table></div><!---------- Questions ----------><a href="index/questions" onMouseOver="imgOn('btn6');popMenu();" onMouseOut="imgOff('btn6')" onMouseLeave="imgOff('btn6')" title="Frequently Asked Questions & Answers"><img src="images/Buttons/Questions-Off.png" alt="Questions" name="btn6" id="btn6" width="110" height="30" border="0"></a><!---------- Reservations ----------><!--<a href="https://secure.nr.net/littlechurchlv/index/reservations" onMouseOver="imgOn('btn7');popMenu();" onMouseOut="imgOff('btn7')" onMouseLeave="imgOff('btn7')" title="Our SECURE Reservation System">--><a href="index/reservations" onMouseOver="imgOn('btn7');popMenu();" onMouseOut="imgOff('btn7')" onMouseLeave="imgOff('btn7')" title="Our SECURE Reservation System"><img src="images/Buttons/Reservations-Off.png" alt="Reservations" name="btn7" id="btn7" width="110" height="30" border="0"></a><!---------- Contact ----------><a href="index/contact" onMouseOver="popMenu('contactDropMenu');" title="Feel Free to Contact Us!"><img src="images/Buttons/Contact-Off.png" alt="Contact" name="btn8" id="btn8" width="110" height="30" border="0"></a><div id="contactDropMenu" style="position:absolute; top:-10; left:<?=iif(stristr($navigator_user_agent, "msie"), "760", "800");?>; z-index:10000; padding:10px; width:110; display:none; visibility:hidden;" onMouseOut="menuOut(event, this.id);" onMouseLeave="menuOut(event, this.id);"><table width="110" cellspacing="0" cellpadding="0"><tr><td background="images/MenuBottom.png" class="smallBurgundy" style="background-position:bottom; background-repeat:no-repeat;"><img src="images/Buttons/Contact-On.png" alt="Contact" title="Feel Free To Contact Us!" width="110" height="30" border="0"><div style="position:relative; left:5;"><li><a href="javascript:void(0)" onClick="show('directionsLayer')" title="Directions to our World Famous Location" class="smallBurgundy"><strong>Directions</strong></a></li><li><a href="javascript:popContact('contactForm')" title="Leave Us A Message and We'll Get Back To You" class="smallBurgundy"><strong>Contact Us</strong></a></li><li><a href="javascript:void(0)" onClick="show('feedbackLayer')" title="Tell Us What You Think - Testimonials Welcome!" class="smallBurgundy"><strong>Leave Feedback</strong></a></li><li><a href="http://www.facebook.com/pages/Las-Vegas-NV/Little-Church-of-the-West/128461487175584"
target="_blank" title="Find Us on Facebook" class="smallBurgundy"><strong>Our Facebook</strong></a></li><!--<li><a href="index/contact/chat" title="Chat Live With One Of Our Wedding Consultants" class="smallBurgundy"><strong>Live Chat</strong></a></li>--></div><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></br></td></tr></table></div>
<? } ?>
			</div>
		</td>
	</tr>
	<!-- Body Content -->
	<tr>
		<td background="images/BodyBGMiddle.png">
			<?
			// Branch content based on "sec" value
			switch($sec){
				case "": include("include/home.php");break;
				case "home": include("include/home.php");break;
				case "experience":
					if ($feature == "testimonials"){
						include("include/testimonials.php");
					}elseif ($feature == "history"){
						include("include/history.php");
					}elseif ($feature == "news"){
						include("include/news.php");
					}else{ //$task == "grounds, chapel, etc."
						include("include/gallery.php");
					}
					break;
				case "packages": include("include/packages.php");break;
				case "ceremonies": include("include/packages.php");break; //Leave here for backward compatibility
				case "packagedetails": include("include/packagedetails.php");break;
				case "services":
					if (!$feature || $feature == "additional"){
						include("include/additional.php");
					}elseif ($feature == "photography"){
						include("include/photography.php");
					}elseif ($feature == "limousine"){
						include("include/limo.php");
}elseif ($feature == "limousine_new"){
	include("include/limo_new.php");
					}else{
						include("include/gallery.php");
					}
					break;
				case "guests":
//					if ($feature == "webcam0"){
//						include("include/webcam0.php");
//					}elseif ($feature == "webcam"){
						include("include/webcam.php");
//					}else{
//						include("include/xxx.php");
//					}
					break;
				case "questions": include("include/faq.php");break;
				case "reservations": include("include/reservations.php");break;
				case "contact":
					if ($feature == "feedback"){
						include("include/feedback.php");
					}else{ //$feature == "message"
						include("include/contact.php");
					}
					break;
				case "privacy": include("include/privacy.php");break;
				case "terms": include("include/terms.php");break;
				case "sitemap": include("include/sitemap.php");break;
				default: include("include/home.php");break;
			} // End Switch
			?>
		</td>
	</tr>
	<!-- Footer -->
	<tr>
		<td background="images/BodyBGBottom.png">
			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="MenuBurgundy">
			<tr>
				<td rowspan="2"><img src="images/spacer.gif" alt="" width="10" height="75" border="0"></td>
				<!-- Text Links -->
				<td width="880" colspan="4" align="center" valign="top">
					<img src="images/spacer.gif" alt="" width="1" height="25" border="0"><br>
					<a href="index/home" class="MenuBurgundy">Home</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/experience/gallery/grounds" class="MenuBurgundy">About Us</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/packages/weddings" class="MenuBurgundy">Packages</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/services/additional" class="MenuBurgundy">Services</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/guests/webcam" class="MenuBurgundy">Webcam</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/questions" class="MenuBurgundy">Questions</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
<!--					<a href="https://secure.nr.net/littlechurchlv/index/reservations" class="MenuBurgundy">Reservations</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;-->
					<a href="javascript:popContact('contactForm')" class="MenuBurgundy">Contact</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/reservations" class="MenuBurgundy">Reservations</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/privacy" class="MenuBurgundy">Privacy Policy</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/terms" class="MenuBurgundy">Terms of Use</a>&nbsp;&nbsp;<strong>&middot;</strong>&nbsp;
					<a href="index/sitemap" class="MenuBurgundy">Site Map</a>
				</td>
				<td rowspan="2"><img src="images/spacer.gif" alt="" width="10 height="75" border="0"></td>
			</tr>
			<tr>
				<td><img src="images/spacer.gif" alt="" width="30" height="6" border="0"></td>
				<!-- Copyright -->
				<td valign="bottom" class="smallGray">
					Copyright&copy; 2000-<? echo date("Y"); ?>, <a href="http://www.littlechurchlv.com" title="You're Already Here!" class="smallGray" style="text-decoration:underline;">Little Church of Las Vegas&reg;, Inc.</a>.&nbsp;&nbsp;All Rights Reserved.<br>
					<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
				</td>
				<!-- Attribution -->
				<td valign="bottom" align="right" class="smallGray">
					Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray" style="text-decoration:underline;">Network Resources</a>, Las Vegas-Dallas-Milwaukee<br>
					<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
				</td>
				<td><img src="images/spacer.gif" alt="" width="30" height="6" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<!-- Reflection -->
	<tr>
		<td background="images/BodyBGReflection.png"><img src="images/spacer.gif" alt="" width="960" height="70" border="0"></td>
	</tr>
	</table>

<!-- Layers/Pop Ups On Every Page -->

	<div id="directionsLayer" style="position:absolute; top:155; right:25; z-index:100000; width:600; display:none; visibility:hidden;">
	<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
		<td background="images/600IvoryBGTop.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
	</tr>
	<tr>
		<td bgcolor="#f8f6e8" background="images/600IvoryBGMiddle.png">
			<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td width="100%" height="200" colspan="2" valign="top">
					<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">
					<tr>
						<td colspan="2" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top" class="bigBlack"><strong>Directions to The Little Church of the West Wedding Chapel</strong></td>
								<td align="right">
									<a href="javascript:void(0)" onclick="hide('directionsLayer')" class="smallBlack"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td><img src="images/Map.png" alt="Map to The Little Church of the West" title="Map to The Little Church of the West" width="230" height="329" border="0"></td>
						<td valign="top" class="bodyDarkGray">
							The Little Church of the West is conveniently located at the South end of the World Famous Las Vegas "Strip", between the Mandalay Bay Hotel and the iconic "Welcome to Las Vegas" sign.<br><br>
							<strong class="bigDarkGray">The Little Church of the West<br></strong>
							4617 Las Vegas Boulevard South<br>
							Las Vegas, Nevada &nbsp;89119<br>
							<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							<strong>800.821.2452</strong> (Toll-Free Outside Nevada)<br>
							<strong>702.739.7971</strong> (Inside Nevada &amp; International)<br>
<!--							702.739.8950 (Fax)<br>-->
							<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							Email: <a href="index/contact" class="bodyDarkGray">Click Here</a><br>
							<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
							Open 8 AM to 12 Midnight Pacific Time, Daily<br>
							<img src="images/spacer.gif" alt="" width="1" height="35" border="0"><br>
							<div align="center"><a href="http://www.google.com/maps?q=4617+S+Las+Vegas+Blvd,+Las+Vegas,+NV+89119&ie=UTF8&om=1&z=15&iwloc=addr" target="_blank" class="bigDarkGray"><strong>Click Here For Map &amp; Directions</strong></a></div>
	 					</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td background="images/600IvoryBGBottom.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;"><br><br></td>
	</tr>
	</table>
	</div>

	<div id="contactLayer" style="position:absolute; top:155; right:25; z-index:99999; width:225; display:none; visibility:hidden;">
		<?
		$formName = "contactDiv";
		include("include/contactform.php");
		?>
	</div>

	<div id="feedbackLayer" style="position:absolute; top:155; right:25; z-index:99999; width:600; display:none; visibility:hidden;">
		<?
		include("include/feedbackform.php");
		?>
	</div>
		
</div>

<!--<div align="center" id="WebcamChoice" style="position:absolute; top:-1000; z-index:10; width:600; align:center; display:block;">-->
<!--<div align="center" id="WebcamChoice" style="position:absolute; top:300; z-index:10; width:525; align:center; display:none; visibility:hidden;">
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/600BurgundyBGTop.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
</tr>
<tr>
	<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top">
<!--		<table width="525" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="550" valign="top">--
				<table width="550" border="0" cellspacing="5" cellpadding="0" align="center">
				<tr>
					<td valign="top" class="xbigWhite"><strong>The Little Church of the West Chapel Webcam</strong></td>
					<td align="right">
						<a href="javascript:void(0)" onclick="hide('WebcamChoice')" class="smallWhite"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" class="bigWhite">
						We recently changed our video streaming format.  Weddings that took place after May 10 use the new format.  Please select the appropriate choice below:<br><br>
					</td>
				</tr>
				<tr>
					<td colspan="2" valign="top" class="bigWhite">
						<ul>
							<li><a href="index/guests/webcam0" class="bigWhite"><strong>Click Here if the wedding took place before May 10.</strong></a></li>
							<li><a href="index/guests/webcam" class="bigWhite"><strong>Click Here if the wedding took place on or after May 10.</strong></a></li>
					</td>
				</tr>
				</table>
			</td>
<!--		</tr>
		</table>--
	</td>
</tr>
<tr>
	<td background="images/600BurgundyBGBottom.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
</tr>
</table>
</div>-->

<script type="text/javascript">
if (document.layers) document.layers.WebcamChoice.left = ((window.innerWidth / 2) - (600 / 2));  //Mozilla
else if (document.all) document.all.WebcamChoice.style.left = ((document.body.offsetWidth / 2) - (600 / 2));  //IE
else if (document.getElementById) document.getElementById("WebcamChoice").style.left = ((window.innerWidth / 2) - (600 / 2));
</script>

</body>
</html>
