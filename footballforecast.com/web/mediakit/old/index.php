<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Football Forecast Weekly Media Kit</title>
	
	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="Content-Language" content="en-us">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="7 days">
	<meta name="classification" content="Sports Television">
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

	function SpawnChild(Content, ChildName, Width, Height, FullScreen, Centered, NSx, NSy, IEx, IEy, Resizable, ScrollBars, MenuBar, ToolBar, StatusBar){
		if (window.child && !(window.child.closed))	window.child.close();
		var URL=Content;
		var Name=ChildName;
		var WindowWidth=parseInt(Width);
		var WindowHeight=parseInt(Height);
		if ((FullScreen == "1")||(FullScreen == "yes")){
			Left=0;
			Top=0;
			NSx=Left;
			NSy=Top;
			IEx=Left;
			IEy=Top;
			if (Width==''){
				WindowWidth=(screen.width-10);
			}
			if (Height==''){
				WindowHeight=(screen.height-100);
			}
		}
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
   		child=window.open(URL, Name, "width=" + WindowWidth + ",height=" + WindowHeight + ",screenX=" + ScreenX + ",screenY=" + ScreenY + ",left=" + Left + ",top=" + Top + ",resizable=" + Resize + ",scrollbars=" + SB + ",menubar=" + MB + ",toolbar=" + TB + ",status=" + Status,"fullscreen=yes");
	}
	</script>

</head>

<body bgcolor="#203E4A">

<!-- BEGIN Image Swapping -->
<script language="javascript">
if (document.images) {
// Define and Load Images
	<?
	for ($counter=1; $counter <= 6; $counter++){
		echo'
			img'.$counter.' = new Image(); 
			img'.$counter.'.src = "images/FootballForecast'.$counter.'.jpg"; 
			img'.$counter.'lg = new Image(); 
			img'.$counter.'lg.src = "images/FootballForecast'.$counter.'lg.jpg"; 
		';
	}
	?>
}

// Swap Images
var imgNumber = 1;
function imgSwapFwd() {
	if (document.images) {
		imgNumber++;
		if (imgNumber == 7) {
			imgNumber = 1;
		}
		document.images.image.src = eval("img"+imgNumber+".src");
		document.imagelg.src = eval("img"+imgNumber+"lg.src");
	}
}

function imgSwapBwd() {
	if (document.images) {
		imgNumber--;
		if (imgNumber == 0) {
			imgNumber = 6;
		}
		document.image.src = eval("img"+imgNumber+".src");
		document.imagelg.src = eval("img"+imgNumber+"lg.src");
	}
}
</script>
<!-- END Image Swapping -->

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td valign="top"><img src="images/FootballForecast1lg.jpg" alt="" name="imagelg" id="imagelg" width="0" height="0" border="0"><br>
    	<table width="510" border="0" cellpadding="0" cellspacing="0" class="bodyBlue">
		<tr>
			<!-- Top Border -->
			<td colspan="3"><img src="images/darkdot.gif" alt="" width="510" height="5" border="0"></td>
		</tr>
		<tr>
			<!-- Header -->
			<td background="images/darkdot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
			<td style="position:relative;"><img src="images/header.jpg" width="500" height="80" border="0"></td>
			<td background="images/darkdot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Header Bottom Border -->
			<td colspan="3" style="position:relative;"><img src="images/darkdot.gif" alt="" width="510" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Left Border -->
			<td background="images/darkdot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
			<!-- Main Body -->
			<td valign="top" class="cellFrost">
				<table border="0" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td align="center" class="bigBlue" style="position:relative;">
						<!--<img src="images/spacer.gif" alt="" width="1" height="12" border="0"><br>-->
						<strong>.: Television Media Kit :.</strong>
						<table border="0" cellspacing="0" cellpadding="0" align="center">
						<tr>
							<!-- Initial Image -->
							<td style="position:relative;"><a href="javascript:SpawnChild('popimage.php?img='+document.imagelg.src+'&imgNumber='+imgNumber,'child','770','','yes','no','no','no','no','no','yes','yes')" class="bodyBlue"><img src="images/FootballForecast1.jpg" alt="Click To Enlarge" name="image" id="image" width="464" height="600" border="1" style="cursor:url('images/magnify3.cur')" galleryimg="no"></a></td>
<!--							<td style="position:relative;"><img src="images/FootballForecast1.jpg" alt="" name="image" id="image" width="464" height="600" border="1"></td>-->
						</tr>
						<tr>
							<td>
								<table width="100%">
								<tr>
									<!-- Image Swap Links -->
									<td class="bodyBlue" style="position:relative;"><a href="javascript:imgSwapBwd();" onmouseover="window.status='Football Forecast Weekly'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>&#171;&nbsp;Previous Page</strong></a>&nbsp;|&nbsp;<a href="javascript:imgSwapFwd();" onmouseover="window.status='Football Forecast Weekly'; return true;" onmouseout="window.status=''; return true;" class="bodyBlue"><strong>Next Page&nbsp;&#187;</strong></a></td>
									<!-- Link to PDF -->
									<td  align="right" class="bodyBlue" style="position:relative;"><a href="footballforecast.pdf" target="_blank" class="bodyBlue"><strong>Download Printable Version</strong></a></td>
								</tr>
								<tr>
									<!-- Seperator -->
									<td colspan="2" style="position:relative;"><img src="images/darkdot.gif" alt="" width="100%" height="1" border="0"></td>
								</tr>
								<tr>
									<!-- Contact Info -->
									<td colspan="2" align="center" class="bodyBlue" style="position:relative;"><strong class="tinyBlue">For More Information Contact:<br></strong><strong>Nikki Murdock &mdash; 702.925.8783 or <a
href="mailto:info@footballforecast.com" class="bodyBlue">info@footballforecast.com</a></strong></td>
								</tr>
								</table>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
			<!-- Right Border -->
			<td background="images/darkdot.gif"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- Bottom Border -->
			<td colspan="3"><img src="images/darkdot.gif" alt="" width="510" height="5" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
</table>

</body>
</html>
