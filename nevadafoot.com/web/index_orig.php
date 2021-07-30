<?
session_start(); 
// Is this the first time we've been here in this session?
$showPromo = 0;
//$_SESSION['FirstTime'] = 0;
if (!$_SESSION['FirstTime'] || $_SESSION['FirstTime'] != 1){
	$showPromo = 1;
	$_SESSION['FirstTime'] = 1;
}
?>

<?
// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}
?>

<!-- Assign passed (via path) values -->
<?
// Blow apart the passed path
$aPath = explode("/",$_SERVER['PATH_INFO']);
// Assign passed values
$page = $aPath[0];
$sec = $aPath[1];
$ailment = $aPath[2];
$task = $aPath[3];
$message = $aPath[4];
$test = $aPath[5];
?>

<?
// Interrogate and reassign passed variables
// legacy method - keep in case of bookmarks & external links
if ($_REQUEST['sec'] != ""){
	$sec = $_REQUEST['sec'];
	$ailment = $_REQUEST['ailment'];
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--
Title - Nevada Foot Institute 
Development Copyright 2004-2010, Network Resources - Las Vegas, Nevada USA (www.nr.net)
Digital Art Copyright 2004-2010, Network Resources
All Content Copyright 2004-2010, Network Resources and Nevada Foot Institute Respectively
Authored by Jeff S. Saunders, Network Resources 04/06/04
Modified by Jeff S. Saunders, Network Resources 05/26/04
Modified by Jeff S. Saunders, Network Resources 05/31/10
-->

<html>
<head>
	<title>Nevada Foot Institute - Thick Fungus Toenails Treatment Specialists</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="1 day">
	<meta name="classification" content="Medical Foot Ailements Treatment Clinic">
	<meta name="description" content="Nevada Foot Institute - Nevada's Premier Foot Ailment Treatment Clinic, Specializing in Non-Invasive Shockwave Therapy.">
	<meta name="keywords" content="thick fungus toenails laser treatment, toenail fungus, laser treatment, cool breeze, foot doctor, nevada foot institute, nevada foot, nevadafoot, nevada, las vegas, vegas, podiatrist, podiatrits, podiatric, foot, feet, toe, toes, heel, heels, arch, arches, ankle, ankles, pain, foot pain, heel pain, toe pain, arch pain, ingrown, ingron nail, ingrown toenail, ingrown toenails, infected nail, infected nails, thickened nail, thickened nails, fungus, nail fungus, toe fungus, hammer toe, black-and-blue nails, corns, warts, bunion, bunyon, bunions, bunyons, spur, spurs, bone spur, bone spurs, heel spur, heel spurs, plantar, plantar fasciitis, plantar fascitis, planter fasciitis, planter fascitis, flat foot, flat feet, neuroma, neuromas, shockwave, shockwave therapy, non-invasive shockwave therapy, aksm/ortho, eswt, marek, neal marek, dr marek, dr neal marek, neal marek dpm, open saturday, speak spanish, se habla espanol">

	<!-- Define Home Base -->
	<base href="http://www.nevadafoot.com/">

	<!-- Load Style Sheet -->
	<link href="/nevadafoot.css" rel="stylesheet" type="text/css">

</head>

<body bgcolor="#F0F0FF" leftmargin="0" topmargin="0"<?=iif($showPromo == 1, " onLoad=\"popAd('FungusNailsPromo',30000);\"", "");?>>

<table border="0" cellspacing="0" cellpadding="0" align="center">

<!-- BEGIN Headers -->
<tr>
	<td background="images/menuheader.gif"><a href="/"><img src="images/spacer.gif" width="170" height="85" alt="Home Page" border="0"></a></td>
	<?
		// The <td> & </td> tags are included redundently because not putting them adjacent to the image tag causes spacing problems - JS
		if ((!$sec) || $sec == "home") echo '<td background="images/bodyheader.gif"><img src="images/headernevadafoot.gif" width="600" height="85" alt="" border="0"></td>'; 
		elseif ($sec == "facts") echo '<td background="images/bodyheader.gif"><img src="images/headerfootfacts.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "info") echo '<td background="images/bodyheader.gif"><img src="images/headerailments.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "shockwave" || $sec == "shockwavevideo") echo '<td background="images/bodyheader.gif"><img src="images/headershockwave.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "about") echo '<td background="images/bodyheader.gif"><img src="images/headercredentials.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "newpatients") echo '<td background="images/bodyheader.gif"><img src="images/headernewpatients.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "privacy") echo '<td background="images/bodyheader.gif"><img src="images/headerpatientprivacy.gif" width="600" height="85" alt="" border="0"></td>';
		elseif ($sec == "locations") echo '<td background="images/bodyheader.gif"><img src="images/headerlocations.gif" width="600" height="85" alt="" border="0"></td>';
		else echo '<td background="images/bodyheader.gif"><img src="images/headernevadafoot.gif" width="600" height="85" alt="" border="0"></td>'; 
				?>
</tr>
<!-- END Headers -->

<tr>

	<!-- BEGIN Menu -->
	<td valign="top">
		<a href="/"><img src="images/menuheel.gif" width="170" height="100" alt="Home Page" border="0"></a>
		<table width="170" border="0" cellspacing="0" cellpadding="0" background="images/menubg.gif">
		<tr>
			<td><img src="images/spacer.gif" width="20" height="1" alt="" border="0"></td>
			<td style="line-height : 150%;" class="bodyBlue">
				<a href="/" class="bodyBlack" title="Home Page"><strong>Home</strong></a><br>
				<a href="/index/facts" class="bodyBlack" title="Foot Facts"><strong>Foot Facts</strong></a><br>
				<a href="/index/info" class="bodyBlack" title="Common Ailment Information"><strong>Common Ailments</strong></a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/fungus toenails" class="bodyBlack" title="Fungus Toenails Information">Fungus Toenails</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/ingrown toenails" class="bodyBlack" title="Ingrown Toenails Information">Ingrown Toenails</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/spurs" class="bodyBlack" title="Bone Spurs Information">Heel/Bone Spurs</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/plantar fasciitis" class="bodyBlack" title="Plantar Faciitis Information">Plantar Fasciitis</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/hammer toes" class="bodyBlack" title="Hammer Toes Information">Hammer Toes</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/plantar fasciitis" class="bodyBlack" title="Arch Pain Information">Arch Pain</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/bunions" class="bodyBlack" title="Bunions Information">Bunions</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/corns" class="bodyBlack" title="Corns Information">Corns</a><br>
					&nbsp;&diams;&nbsp;<a href="/index/info/warts" class="bodyBlack" title="Warts Information">Warts</a><br>
				<a href="/index/shockwave" class="bodyBlack" title="Shockwave Therapy"><strong>Shockwave Therapy</strong></a><br>
					&nbsp;&diams;&nbsp;<a href="/index/shockwavevideo" class="bodyBlack" title="Shockwave Video">Informative Video</a><br>
				<a href="/index/about" class="bodyBlack" title="All About Us"><strong>About Nevada Foot</strong></a><br>
				<a href="/index/newpatients" class="bodyBlack" title="New Patient Information"><strong>New Patients</strong></a><br>
				<a href="/index/privacy" class="bodyBlack" title="Our Privacy Policy"><strong>Privacy Policy</strong></a><br>
				<a href="/index/locations" class="bodyBlack" title="4 Locations To Serve You"><strong>Office Locations</strong></a><br><br>
				<div align="center"><strong>Call Today!&nbsp;&nbsp;&nbsp;&nbsp;</strong></div><font size="1">&nbsp;(702)</font><font size="4"><strong>438-2425</strong></font></em><br><div align="center"><a href="mailto:info@nevadafoot.com" class="bodyBlue"><font size="1">info@nevadafoot.com</strong></font></a>&nbsp;&nbsp;&nbsp;</div><br>
			</td>
		</tr>	
		</table>
	</td>
	<!-- END Menu -->

	<!-- BEGIN Body -->
	<td valign="top">
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td background="images/bodybg.jpg">
				<?
				if ((!$sec) || $sec == "home") include("./include/home.php");
				elseif ($sec == "facts") include("./include/footfacts.php");
//				elseif ($sec == "info") include("./include/ailments.php?ailment=".$ailment."");
				elseif ($sec == "info") include("./include/ailments.php");
				elseif ($sec == "shockwave") include("./include/shockwave.php");
				elseif ($sec == "shockwavevideo") include("./include/shockwavevideo.php");
				elseif ($sec == "about") include("./include/about.php");
				elseif ($sec == "newpatients") include("./include/newpatients.php");
				elseif ($sec == "privacy") include("./include/privacypolicy.php");
				elseif ($sec == "locations") include("./include/locations.php");
				else include("./include/home.php");
				?>
			</td>
		</tr>
		<tr>
			<td><img src="images/bodyfooter.jpg" width="600" height="15" alt="" border="0"></td>
		</tr>	
		<tr>
			<td><? include("./include/footer.php"); ?></td>
		</tr>
		</table>
	</td>
	<!-- END Body -->

</tr>
</table>

<!-- Layers/Pop Up ads -->

<!-- BEGIN Thick Fungus Nails Promo -->
<div align="center" id="FungusNailsPromo" style="position:absolute; top:-1200; z-index:10; width:600; align:center; display:block;">
<table width="600" border="0" cellspacing="5" cellpadding="0" align="center" bgcolor="#F0F0FF" style="border:5px solid #090982;">
<tr>
	<td>
		<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
		<tr>
			<td width="600" colspan="2" valign="top">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="200" colspan="2" align="right" valign="top" background="images/DoctorsSmall.jpg" style="background-attachment:scroll; background-position:center; background-repeat:no-repeat;">
						<table border="0" cellpadding="10" align="right">
						<tr>
							<td align="center">
								<a href="javascript:void(0)" title="Close This Window" onclick="hideAd('FungusNailsPromo')" class="smallBlue"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close</a>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<!-- Tagline -->
					<td height="40" colspan="2" align="center" bgcolor="#090982" class="bigWhite">
						<strong><em>&ndash; Nevada's Source for Laser Treatment of Thick Fungus Nails &ndash;</em></strong>
					</td>
				</tr>
				<tr>
					<td>
						<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						<img src="images/FungusBigToeSmall.jpg" width="100" alt="" border="1">
					</td>
					<td align="center" class="bodyBlue">
						<strong class="xbigBlue">Do You Suffer From Thick Fungus Nails?</strong><br>
						<strong><font size="7">Relief is Here!</font><br>
						&ndash; <a href="http://www.thickfungusnails.com" title="Thick Fungus Nails Treatment Information" target="_self" class="bodyBlue">Click Here for More Information</a> &ndash;</strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>

<script type="text/javascript">
if (document.layers) document.layers.FungusNailsPromo.left = ((window.innerWidth / 2) - (600 / 2));  //Mozilla
else if (document.all) document.all.FungusNailsPromo.style.left = ((document.body.offsetWidth / 2) - (600 / 2));  //IE
else if (document.getElementById) document.getElementById("FungusNailsPromo").style.left = ((window.innerWidth / 2) - (600 / 2));
</script>

<script>
// BEGIN FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---
function hideAd(divId){
	if (document.layers) document.layers[divId].visibility = 'hide';
	else if (document.all) document.all[divId].style.visibility = 'hidden';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'hidden';
//	if (document.all) setTimeout("document.all.carriers.src = document['carriers'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.fivebars.src = document['fivebars'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.yourbenefits.src = document['yourbenefits'].src;",1); // IE animated gif fix
}

function showAd(divId){
	if (document.layers) document.layers[divId].visibility = 'show';
	else if (document.all) document.all[divId].style.visibility = 'visible';
	else if (document.getElementById) document.getElementById(divId).style.visibility = 'visible';
}

function adDown(divId, top){
	setTimeout("showAd('"+divId+"');",0);
	if(typeof topPos == 'undefined') topPos=top;
	if(topPos <= 75){
		topPos+=10;
		if (document.layers) document.layers[divId].top = topPos;
		else if (document.all) document.all[divId].style.top = topPos;
		else if (document.getElementById) document.getElementById(divId).style.top = topPos;	
		setTimeout("adDown('"+divId+"');",5);
	}else{
		topPos=top;
	}
//	if (document.all) setTimeout("document.all.carriers.src = document.all.carriers.src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.fivebars.src = document['fivebars'].src;",1); // IE animated gif fix
//	if (document.all) setTimeout("document.all.yourbenefits.src = document['yourbenefits'].src;",1); // IE animated gif fix
}

function popAd(adName, delay){
	adDown(adName, -450);
//	setTimeout("adDown('"+adName+"', -450);",1);
	setTimeout("hideAd('"+adName+"');",delay);
}

// END FUNCTIONS TO POP & HIDE PROMO LAYER(S) ---
</script>










<a href="javascript:popAd('FungusNailsPromo',30000);">.</a>

</body>
</html>
