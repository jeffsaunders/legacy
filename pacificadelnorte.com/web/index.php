<?// header("Location: http://www.nr.net"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<?
// Interrogate and reassign passed variables
$sec = $_GET['sec'];
//$page = $_GET['page'];
//$cat = $_GET['cat'];
//$scn = $_GET['scn'];
//$sub = $_GET['sub'];
?>

<html>
<head>
	<title>Pacifica del Norte  - Realty & Property Development, Costa Rica</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Realty & Property Development">
	<meta name="description" content="">
	<meta name="keywords" content="">

	<!-- Page Transition Effect -->
<!--	<meta http-equiv="Page-Enter" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Page-Exit" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Site-Enter" content="blendTrans(Duration=1.0)">
	<meta http-equiv="Site-Exit" content="blendTrans(Duration=1.0)">
-->
	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<script language="javascript">

//  This function spawns a child window 

//  SpawnChild(URL including fully qualified URL's,
//		 		Width of the spawned window in pixels,
//			 	Height of the spawned window in pixels,
//				Centered (no/0 or 1/yes, which overrides the positioning values below),
//				Netscape distance from left in pixels (unless Centered = 1/yes),
//				Netscape distance from top in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from left in pixels (unless Centered = 1/yes),
//				Internet Explorer distance from top in pixels (unless Centered = 1/yes),
//				Is window resizable? (no/0 or yes/1 - either works),
//				Display scrollbars? (no/0 or yes/1),
//				Display menubar? (no/0 or yes/1),
//				Display toolbar? (no/0 or yes/1),
//				Display statusbar? (no/0 or yes/1)
//				)

// 	Example - SpawnChild('http://192.168.0.1/ChildWindowContent.html','500','200','150','no','200','150','200','yes','yes','no','0','1')
// 	Creates a window that is 500x200 pels located 150 pels from the left and 200 pels from the top (NOT centered) which loads a page from a server at 192.168.0.1 named ChildWindowContent.html, resizable, with scrollbars & statusbar on.

	function SpawnChild(Content, ChildName, Width, Height, Centered, NSx, NSy, IEx, IEy, Resizable, ScrollBars, MenuBar, ToolBar, StatusBar){
		if (window.child && !(window.child.closed))	window.child.close();
		var URL=Content;
		var Name=ChildName;
		var WindowWidth=parseInt(Width);
		var WindowHeight=parseInt(Height);
		if ((Centered == "1")||(Centered == "yes")){
			Left=(screen.width/2)-(Width/2);
			Top=(screen.height/2)-(Height/2);
			NSx=Left;
			NSy=Top;
			IEx=Left;
			IEy=Top
		}
		var ScreenX=parseInt(NSx);
		var ScreenY=parseInt(NSy);
		var Left=parseInt(IEx);
		var Top=parseInt(IEy);
		var Resize=Resizable;
		var SB=ScrollBars;
		var MB=MenuBar;
		var TB=ToolBar;
		var Status=StatusBar;
   		child=window.open(URL, Name, "width=" + WindowWidth + ",height=" + WindowHeight + ",screenX=" + ScreenX + ",screenY=" + ScreenY + ",left=" + Left + ",top=" + Top + ",resizable=" + Resize + ",scrollbars=" + SB + ",menubar=" + MB + ",toolbar=" + TB + ",status=" + Status);
	}
	</script>

	<script>
	// Before you reuse this script you may want to have your head examined
	// 
	// Copyright 1999 InsideDHTML.com, LLC.  

	function doBlink() {
		// Blink, Blink, Blink...
		var blink = document.all.tags("BLINK")
		for (var i=0; i < blink.length; i++)
			blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : "" 
	}

	function startBlink() {
		// Only if it's IE
		if (document.all)
			setInterval("doBlink()",500)
	}
	//window.onload = startBlink;
	</script>

</head>

<body bgcolor="#223367" leftmargin="0" topmargin="10" marginwidth="0" marginheight="10" onLoad="show_clock();startscroll();startBlink();">

<table border="0" cellspacing="0" cellpadding="0" align="center">

<!-- BEGIN Header Section -->

<!--<tr>
	<!-- Header -->
<!--	<td colspan="2" background="images/headerbg.jpg"><img src="images/spacer.gif" alt="" width="800" height="150" border="0"></td>
</tr>-->
<tr>
	<!-- Header -->
	<td colspan="2">
		<table width="800" border="0" cellspacing="0" cellpadding="0" background="images/headerbg2.jpg">
		<tr>
			<td colspan="2"><img src="images/spacer.gif" alt="" width="800" height="5" border="0"></td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="1" height="125" border="0"></td>
			<td align="right" valign="top">
				<?
				if (false){
//				if ((!$sec)){ //<!-- || $sec == "why-costa-rica" || $sec == "weather"-->
				?>
				<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
					codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" width="160" height="120">
					<param name="movie" value="/media/costaricasmall.swf">
					<param name="quality" value="best">
					<param name="bgcolor" value="#FFFFFF">
					<param name="wmode" value="transparent">
					<param name="loop" value="false">
						<EMBED src="/media/costaricasmall.swf" quality="best" bgcolor="#FFFFFF" width="160" height="120" loop="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" wmode="transparent">
						</EMBED>
				</OBJECT>
				<!-- refresh page after 35 seconds -->
				<meta http-equiv="refresh" content="35; url=http://www.pacificadelnorte.com/?sec=home">
				<?
				}elseif ($sec != "vista-al-pacifico-video"){
				?>
					<a href="?sec=homes"><img src="images/VistaHeaderPromo.gif" alt="" width="120" height="120" border="0"></a>
<!--					<a href="?sec=vista-al-pacifico-video"><img src="images/VideoHeaderPromo.gif" alt="" width="120" height="120" border="0"></a>-->
				<?
				}
				?>
				<img src="images/spacer.gif" alt="" width="5" height="1" border="0">
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<!-- Blue Line -->	
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>
<!--<tr bgcolor="#1C6DD9">-->
<tr bgcolor="#477ACF">

	<!-- Scroller & Clock Bar Cell -->
	<td><img src="images/spacer.gif" alt="" width="1" height="30" border="0"></td>
	<td>

		<!-- BEGIN Scroller & Running Clocks Section -->

		<table width="800" border="0" cellspacing="0" cellpadding="0" align="right">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			<td align="left" valign="top" class="bigWhite"><font size="+1"><? include("./scroller.js"); ?></font></td>
			<td width="90" class="smallWhite"><strong>Your Local Time:&nbsp;&nbsp;<br>Costa Rica Time:&nbsp;&nbsp;</strong></td>
			<td width="260" align="right" class="smallWhite"><strong><? include("./liveclock.js"); ?></td>
		</tr>
		</table>

		<!-- END Scroller & Running Clocks Section -->

	</td>
</tr>
<tr>
	<!-- Blue Line -->
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- END Header Section -->

<!-- BEGIN Menu Section -->

<tr bgcolor="#3E5AAF">
	<td colspan="2"><? include("./include/menu.php"); ?></td>
</tr>

<!-- END Menu Section -->

<tr>
	<!-- Blue Line -->
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- BEGIN Body Section -->

<tr>
	<td colspan="2" align="center" valign="top" bgcolor="#FEFEFE" background="images/watermark.jpg" style="background-position: bottom; background-repeat: no-repeat; background-attachment: scroll;"> <!-- #EAEFFD -->

		<!-- Main Body Include -->
		<?
		// Branch Content Based On Passed "SEC" Value
		if ((!$sec) || $sec == "home") include("include/home.php");
		if ($sec == "homes") include("./include/homes.php");
		if ($sec == "land") include("./include/land.php");
		if ($sec == "why-costa-rica") include("./include/whycostarica.php");
		if ($sec == "weather") include("./include/weather.php");
		if ($sec == "contact") include("./include/contact.php");

		// Real Player needed but not installed
		if ($sec == "needplayer") include("./include/needplayer.php");

		// Property Image Galleries
		if ($sec == "oceanas") include("./include/properties/oceanas.php");
		if ($sec == "vista-al-pacifico") include("./include/properties/vista-al-pacifico.php");
		if ($sec == "vista-al-pacifico-video") include("./include/properties/vista-al-pacifico-video.php");
//		if ($sec == "vista-a-los-suenos") include("./include/placeholder.php");
		if ($sec == "playa-hermosa-3-hectareas") include("./include/properties/playa-hermosa-3-hectareas.php");
		if ($sec == "playa-hermosa-3-hectareas-video") include("./include/properties/playa-hermosa-3-hectareas-video.php");
		if ($sec == "alsides-naranjo") include("./include/properties/alsides-naranjo.php");
		if ($sec == "alsides-naranjo-video") include("./include/properties/alsides-naranjo-video.php");
		if ($sec == "linda-vista") include("./include/properties/linda-vista.php");
		if ($sec == "linda-vista-video") include("./include/properties/linda-vista-video.php");
		if ($sec == "lomas-de-jaco") include("./include/properties/lomas-de-jaco.php");
		if ($sec == "lomas-de-jaco-video") include("./include/properties/lomas-de-jaco-video.php");
		?>
	</td>
</tr>
<tr>
	<!-- Blue Line -->	
	<td colspan="2" bgcolor="#223367"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
</tr>

<!-- END Body Section -->

<!-- BEGIN Footer Section -->

<tr bgcolor="#477ACF">
	<td><img src="images/spacer.gif" alt="" width="1" height="25" border="0">
	<td align="center" class="bodyWhite">
		<?
		include("include/footer.php");
		?>
	</td>
</tr>

<!-- END Footer Section -->

</table>

</body>
</html>
