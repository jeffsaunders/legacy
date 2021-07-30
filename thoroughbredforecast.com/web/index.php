<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!-- Grab the database -->
<? include("dbconnect.php"); ?>

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
?>

<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$show = $_REQUEST['show'];
$cargo = $_REQUEST['cargo'];
?>

<html>
<head>
	<title>Dennis Tobler's Thoroughbred Racing Forecast</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Television Show">
	<meta name="description" content="">
	<meta name="keywords" content="">

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

	<script>
	// Detect Browser, Version, & OS
	var BrowserDetect = {
		init: function () {
			this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
			this.version = this.searchVersion(navigator.userAgent)
				|| this.searchVersion(navigator.appVersion)
				|| "an unknown version";
			this.OS = this.searchString(this.dataOS) || "an unknown OS";
		},
		searchString: function (data) {
			for (var i=0;i<data.length;i++)	{
				var dataString = data[i].string;
				var dataProp = data[i].prop;
				this.versionSearchString = data[i].versionSearch || data[i].identity;
				if (dataString) {
					if (dataString.indexOf(data[i].subString) != -1)
						return data[i].identity;
				}
				else if (dataProp)
					return data[i].identity;
			}
		},
		searchVersion: function (dataString) {
			var index = dataString.indexOf(this.versionSearchString);
			if (index == -1) return;
			return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
		},
		dataBrowser: [
			{ 	string: navigator.userAgent,
				subString: "OmniWeb",
				versionSearch: "OmniWeb/",
				identity: "OmniWeb"
			},
			{
				string: navigator.vendor,
				subString: "Apple",
				identity: "Safari"
			},
			{
				prop: window.opera,
				identity: "Opera"
			},
			{
				string: navigator.vendor,
				subString: "iCab",
				identity: "iCab"
			},
			{
				string: navigator.vendor,
				subString: "KDE",
				identity: "Konqueror"
			},
			{
				string: navigator.userAgent,
				subString: "Firefox",
				identity: "Firefox"
			},
			{
				string: navigator.vendor,
				subString: "Camino",
				identity: "Camino"
			},
			{		// for newer Netscapes (6+)
				string: navigator.userAgent,
				subString: "Netscape",
				identity: "Netscape"
			},
			{
				string: navigator.userAgent,
				subString: "MSIE",
				identity: "Explorer",
				versionSearch: "MSIE"
			},
			{
				string: navigator.userAgent,
				subString: "Gecko",
				identity: "Mozilla",
				versionSearch: "rv"
			},
			{ 		// for older Netscapes (4-)
				string: navigator.userAgent,
				subString: "Mozilla",
				identity: "Netscape",
				versionSearch: "Mozilla"
			}
		],
		dataOS : [
			{
				string: navigator.platform,
				subString: "Win",
				identity: "Windows"
			},
			{
				string: navigator.platform,
				subString: "Mac",
				identity: "Mac"
			},
			{
				string: navigator.platform,
				subString: "Linux",
				identity: "Linux"
			}
		]
	
	};
	BrowserDetect.init();
	// Returns:
	// BrowserDetect.browser = Browser Name
	// BrowserDetect.version = Browser Version Number
	// BrowserDetect.OS = Operating System
	// Display Example:
	// document.write('You\'re using ' + BrowserDetect.browser + ' ' + BrowserDetect.version + ' on ' + BrowserDetect.OS + '!');

	</script>


	<style>
	/* For scaling background image */
	.backgroundcontent {
		z-index:0;
		position:relative;
		top:0px;
		left:0px;
	}
	</style>

</head>

<body bgcolor="#AFC96D" leftmargin="0" topmargin="10" marginwidth="0" onResize="window.location.reload(true);window.location=window.location;">

<script language="JavaScript1.2">
//// Determine browser width for centering
////var wdth = 0;
////if (window.innerWidth){
////	wdth = window.innerWidth;
////}else{
////	wdth = document.body.clientWidth;
////}
//// create another style for the foreground - lays on top of background div

//if (window.innerWidth && BrowserDetect.browser != "Safari" && BrowserDetect.browser != "Opera"){ // Safari & Opera act like they are Mozilla but they aren't
//	document.write('<style>.forgroundcontent {z-index:1; position:absolute; left:auto;}</style>');
//}else{
	wdth = document.body.clientWidth;
	document.write('<style>.forgroundcontent {z-index:1; position:absolute; left:'+((wdth/2)-405)+'px;}</style>');
//}
</script>

<!-- Wrap foreground in a div so it can be layed on top of scaled background -->
<div align="center" class="forgroundcontent">
	<!-- Dark Green Border -->
	<table width="810" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#224221">
	<tr>
		<td>
			<!-- Site Content -->
			<table width="800" border="0" cellspacing="0" cellpadding="0" align="center">
			<!-- Header -->
			<tr>
				<td background="images/Header.jpg"><img src="images/spacer.gif" alt="" width="800" height="100" border="0"></td>
			</tr>
			<!-- Green Line -->	
			<tr>
				<td bgcolor="#224221"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
			</tr>
			<!-- Menu -->
			<tr bgcolor="#66984B">
				<td><? include("./include/menu.php"); ?></td>
			</tr>
			<!-- Green Line -->	
			<tr>
				<td bgcolor="#224221"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
			</tr>
			<!-- Body -->
			<tr>
				<td valign="top" bgcolor="#FFFFFF">
					<!-- Main Body Include -->
					<?
					// Branch Content Based On Passed "SEC" Value
					switch($sec){
//						case "test": include("include/contact.php");break;
						case "": include("include/home.php");break;
						case "home": include("include/home.php");break;
						case "show": include("include/show.php");break;
						case "host": include("include/bio-dennis.php");break;
						case "advertising": include("include/advertising.php");break;
						case "contact": include("include/contact.php");break;
						case "stable": include("include/stable.php");break;
//case "stable2": include("include/stable2.php");break;
						case "roster": include("include/roster.php");break;
						default: include("include/home.php");break;
					} // End Switch
					?>
				</td>
			</tr>
			<!-- Green Line -->	
			<tr>
				<td bgcolor="#224221"><img src="images/spacer.gif" alt="" width="800" height="2" border="0"></td>
			</tr>
			<!-- Footer -->
			<tr bgcolor="#66984B">
				<td align="center" class="bodyWhite"><? include("include/footer.php"); ?></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	<br>
</div>

<!-- Scaled Background image -->
<div class="backgroundcontent">
	<img src="images/Background.jpg" width="100%" galleryimg="no">
</div>

</body>
</html>
