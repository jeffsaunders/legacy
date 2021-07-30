<?
// define default settings
$pageWidth = 950;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>BragBuy! - Tell Your Friends</title>

	<!-- Load Style Sheets -->
	<link href="standard.css" rel="stylesheet" type="text/css">

	<script type="text/javascript">
	// Submit a form if Enter key is pressed
	function submitOnEnter(field,e){
		var keycode;
		if (window.event){
			keycode = window.event.keyCode;
		}else if (e){
			keycode = e.which;
		}else{
			return true;
		}
		if (keycode == 13){
			field.form.submit();
			return false;
		}else{
			return true;
		}
	}
	</script>

	<script>
	// Functions to pop and hide dropdown menu layer(s) ---
	// Seemingly identical functions required as multiple simultaneous firing causes conflicts

	// More Tabs Menu ---
	function tabsOn(divId, tabTop){
//	function tabsOn(event, divId, tabTop){
		// Fires if pointing at drop down tab widget - prevents event bubbling
//		var tabToElement = null;
//		if (event.relatedTarget){
//			tabToElement = event.relatedTarget;
//		}else if (event.tabToElement){
//			tabToElement = event.tabToElement;
//		}
////alert(tabToElement.tagName);
//document.getElementById("showTagName").innerHTML = tabToElement.tagName;
////		if (tabToElement && tabToElement.tagName != "A" && tabToElement.tagName != "IMG"){
//		if (tabToElement && tabToElement.tagName != "A"){
			tabsDown(divId, tabTop);
//		}
	}

	function tabsOut(event, divId, tabTop) {
		// Fires if mouse moves out of drop down menu - prevents event bubbling
		var tabToElement = null;
		if (event.relatedTarget){
			tabToElement = event.relatedTarget;
		}else if (event.tabToElement){
			tabToElement = event.tabToElement;
		}
//alert(tabToElement.tagName);
		if (tabToElement && tabToElement.tagName == "TABLE"){
			// Pause a sec to let things catch up
			setTimeout("tabsUp('"+divId+"', "+tabTop+");",50);
//			tabsUp(divId, tabTop);
		}
	}

	function tabsDown(divId, menuTop){
		// Slide down the menu with smoothing effect
//		setTimeout("showMenu('"+divId+"');",0);
		if(typeof(menuTopPos) == 'undefined' || typeof(menuTopPos) == 'object') menuTopPos=menuTop;
		if(menuTopPos <= 45){
			menuTopPos+=3;
			if (document.layers) document.layers[divId].top = menuTopPos;
			else if (document.all) document.all[divId].style.top = menuTopPos;
			else if (document.getElementById) document.getElementById(divId).style.top = menuTopPos;	
			setTimeout("tabsDown('"+divId+"');",1);
		}else{
			menuTopPos=menuTop;
		}
	}
	
	function tabsUp(divId, menuTop){
		// Slide up the menu with smoothing effect
//		setTimeout("showMenu('"+divId+"');",0);
		if(typeof menuTopPos == 'undefined') menuTopPos=menuTop;
		if(menuTopPos > -150){
			menuTopPos-=3;
			if (document.layers) document.layers[divId].top = menuTopPos;
			else if (document.all) document.all[divId].style.top = menuTopPos;
			else if (document.getElementById) document.getElementById(divId).style.top = menuTopPos;	
			setTimeout("tabsUp('"+divId+"');",1);
		}else{
			menuTopPos=top;
		}
	}

	// More Categories Menu ---
	function categoriesOn(event, divId, top){
		// Fires if pointing at drop down menu widget(s) - prevents event bubbling
//		var toElement = null;
//		if (event.relatedTarget){
//			toElement = event.relatedTarget;
//		}else if (event.toElement){
//			toElement = event.toElement;
//		}
////alert(toElement.tagName);
//		if (toElement && toElement.tagName != "A" && toElement.tagName != "IMG"){
			categoriesDown(divId, top);
//		}
	}

	function categoriesOut(event, divId, top) {
		// Fires if mouse moves out of drop down menu - prevents event bubbling
		var toElement = null;
		if (event.relatedTarget){
			toElement = event.relatedTarget;
		}else if (event.toElement){
			toElement = event.toElement;
		}
//alert(toElement.tagName);
		if (toElement && toElement.tagName == "DIV"){
			// Pause a sec to let things catch up
			setTimeout("categoriesUp('"+divId+"', "+top+");",50);
//			categoriesUp(divId, top);
		}
	}

	function categoriesDown(divId, top){
		// Slide down the menu with smoothing effect
//		setTimeout("showMenu('"+divId+"');",0);
		if(typeof topPos == 'undefined') topPos=top;
		if(topPos <= 150){
			topPos+=3;
			if (document.layers) document.layers[divId].top = topPos;
			else if (document.all) document.all[divId].style.top = topPos;
			else if (document.getElementById) document.getElementById(divId).style.top = topPos;	
			setTimeout("categoriesDown('"+divId+"');",1);
		}else{
			topPos=top;
		}
	}
	
	function categoriesUp(divId, top){
		// Slide up the menu with smoothing effect
//		setTimeout("showMenu('"+divId+"');",0);
		if(typeof topPos == 'undefined') topPos=top;
		if(topPos > -25){
			topPos-=3;
			if (document.layers) document.layers[divId].top = topPos;
			else if (document.all) document.all[divId].style.top = topPos;
			else if (document.getElementById) document.getElementById(divId).style.top = topPos;	
			setTimeout("categoriesUp('"+divId+"');",1);
		}else{
			topPos=top;
		}
	}
	</script>
</head>

<body bgcolor="#FFFFFF" onResize="window.location.reload(true);window.location=window.location;">

<script language="JavaScript1.2">
	// Must be interrogated within <body> tags
	browserWidth = document.body.clientWidth;
	document.write('<style>.pageContainer {position:absolute; top:0; left:'+((browserWidth/2)-(<?=$pageWidth;?>/2))+'px; width:<?=$pageWidth;?>;}</style>');
</script>



<!----------- debug -------------->
<!--<div id="showTagName"></div>-->



<!-- Page Container -->
<div align="center" class="pageContainer" id="pageContainer">
	<!-- BEGIN Header -->
	<!-- Background Masks (To Hide Stuff Behind) -->
	<div id="HeaderMask" style="position:absolute; top:0; left:0; background-color:#FFFFFF; width:<?=$pageWidth+2;?>; height:75; z-index:3;"></div>
	<div id="TabMask" style="position:absolute; top:0; left:150; background-color:#FFFFFF; width:405; height:50; z-index:5;"></div>
	<!-- Tabs -->
	<div id="HeaderTabs" class="roundedTops" style="position:absolute; top:24; left:150; width:400; height:25; border:thin solid #8A8A8A; z-index:6;">
		<!-- Tab 1 -->
		<div id="Tab1" class="roundedTopLeft" style="position:absolute; top:0; left:0; background-color:#25A800; width:100; height:25; z-index:5;">
			<img src="images/Tab1.png" alt="" width="100" height="25" border="0" class="roundedTopLeft" onMouseOver="this.style.backgroundColor='#8DC540'" onMouseOut="this.style.backgroundColor='#25A800'" onMouseLeave="this.style.backgroundColor='#25A800'">
		</div>
		<div id="TabSeperator1" style="position:absolute; top:0; left:100; background-color:#8A8A8A; width:1; height:25; z-index:5;"></div>
		<!-- Tab 2 -->
		<div id="Tab2" style="position:absolute; top:0; left:101; background-color:#25A800; width:100; height:25; z-index:5;"
			<img src="images/Tab2.png" alt="" width="100" height="25" border="0" onMouseOver="this.style.backgroundColor='#8DC540'" onMouseOut="this.style.backgroundColor='#25A800'" onMouseLeave="this.style.backgroundColor='#25A800'">
		</div>
		<div id="TabSeperator2" style="position:absolute; top:0; left:200; background-color:#8A8A8A; width:1; height:25; z-index:5;"></div>
		<!-- Tab 3 -->
		<div id="Tab3" style="position:absolute; top:0; left:201; background-color:#25A800; width:100; height:25; z-index:5;"
			<img src="images/Tab3.png" alt="" width="100" height="25" border="0" onMouseOver="this.style.backgroundColor='#8DC540'" onMouseOut="this.style.backgroundColor='#25A800'" onMouseLeave="this.style.backgroundColor='#25A800'">
		</div>
		<div id="TabSeperator3" style="position:absolute; top:0; left:300; background-color:#8A8A8A; width:1; height:25; z-index:5;"></div>
		<!-- Tab 4 -->
		<div id="Tab4" class="roundedTopRight" style="position:absolute; top:0; left:301; background-color:#25A800; width:100; height:25; z-index:5;" onClick="tabsDown('MoreTabs',-150);" onMouseOver="this.style.backgroundColor='#8DC540'" onMouseOut="this.style.backgroundColor='#25A800'" onMouseLeave="this.style.backgroundColor='#25A800'">
			<img src="images/Tab4.png" alt="" width="100" height="25" border="0" class="roundedTopRight">
		</div>
	</div>
	<!-- Drop Down Tab Menu Extras -->
	<div id="MoreTabs" align="center" class="roundedBottoms" style="position:absolute; top:-150; left:351; background-color:#DAD8CF; width:199; height:185; border:thin solid #8A8A8A; z-index:4;" onMouseOut="tabsOut(event,'MoreTabs',25);" onMouseLeave="tabsOut(event,'MoreTabs',25);">
		<table width="199" border="0" cellspacing="10" cellpadding="0" align="center" class="bigBlack">
		<?
		for ($section=4; $section <= 10; $section++){
		?>
		<tr>
			<td><a href="/index/section<?=$section;?>" class="menuBlack">Additional Tab Menu Item #<?=$section;?></a></td>
		</tr>
		<?
		}
		?>
		</table>
	</div>
	<!-- User Info Panel -->
	<div id="HeaderInfoPanel" class="roundedTops" style="position:absolute; top:5; left:<?=$pageWidth-300;?>; background-color:#25A800; width:300; height:60; border:thin solid #8A8A8A; z-index:3;">
		<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
		<table width="275" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyWhite">
		<tr>
			<td align="right">
				<a href="/index/#" class="bodyWhite">My BragBuy</a> &bull;
				<a href="/index/#" class="bodyWhite">Wish List</a> &bull;
				<a href="/index/#" class="bodyWhite">Credits(0)</a> &bull;
				<a href="/index/#" class="bodyWhite">Cart(0)</a>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="1" height="3" border="0"></td>
		</tr>
		<tr>
			<td align="right" class="bigWhite">
				Hello <strong>Guest</strong><img src="images/spacer.gif" alt="" width="10" height="1" border="0">
				<a href="/index/login" class="bodyWhite">Sign In</a> &bull; <a href="/index/register" class="bodyWhite">Register</a>
			</td>
		</tr>
		</table>
	</div>
	<!-- Main Header -->
	<div id="Header" class="roundedCorners" style="position:absolute; top:50; left:0; background-image:url(images/BGHeader.png); background-position:bottom; width:<?=$pageWidth;?>; height:100; border:thin solid #8A8A8A; z-index:3;">
		<!-- Logo -->
		<div id="HeaderLogo" style="position:absolute; top:2; left:5;"><img src="images/LogoHeader3.png" alt="" width="130" height="94" border="0"></div>
		<!-- Tagline -->
<!--		<div id="HeaderTagline" align="center" style="position:absolute; top:57; left:5; width:45;"><strong class="smallBlack">Tell Your<br>Friends</strong></div>-->
<!--		<div id="HeaderTagline" align="center" style="position:absolute; top:85; left:5; width:120;"><strong class="bodyWhite">Tell Your Friends!</strong></div>-->
		<!-- Logo -->
		<div id="HeaderBanner" style="position:absolute; top:5; left:150; width:468; height:60; background-color:#FFFFFF; border:thin solid #000000; z-index:3;">
			<img src="images/spacer.gif" alt="" width="1" height="20" border="0"><br>
			<div align="center" class="bigGray"><em>468x60 Banner</em></div>
		</div>
		<!-- Search Box -->
		<div id="HeaderSearchMask" class="roundedCorners" style="position:absolute; top:75; left:150; width:468; height:20; background-color:#FFFFFF; z-index:3;">
			<form action="" method="post" name="searchForm" id="searchForm"> <!-- Outside DIV for formatting -->
			<div id="HeaderSearch" style="position:absolute; top:1; left:7; width:422; background-color:#FFFFFF; z-index:2;">
				<table width="457" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td>
						<input type="text" name="searchBox" id="searchBox" value="Search BragBuy Here" style="width:435; height:18; border:none; outline:none; color:#AAAAAA;" onClick="this.value=''; this.onclick=null; this.style.color='000000'" onKeyPress="return submitenter(this,event)">
					</td>
					<td align="right">
						<img src="images/MagnifyingGlassSmallOff.png" alt="Search" width="18" height="18" border="0" onMouseOver="this.src='images/MagnifyingGlassSmallOn.png'" onMouseOut="this.src='images/MagnifyingGlassSmallOff.png'" onMouseLeave="this.src='images/MagnifyingGlassSmallOff.png'" onClick="searchForm.submit();">
					</td>
				</tr>
				</table>
			</div>
			</form>
		</div>
	</div>
	<!-- Top Categories -->
	<div id="HeaderCategories" class="roundedBottoms" style="position:absolute; top:130; left:0; background-color:#25A800; width:<?=$pageWidth;?>; height:50; border:thin solid #8A8A8A; z-index:1;">
		<img src="images/spacer.gif" alt="" width="1" height="26" border="0">
		<table width="<?=$pageWidth-25;?>" border="0" cellspacing="0" cellpadding="0" class="bigWhite">
		<tr>
			<td width="20%"><a href="/index/categories/category1" class="bigWhite"><strong>Top Category #1</strong></a></td>
			<td width="20%"><a href="/index/categories/category2" class="bigWhite"><strong>Top Category #2</strong></a></td>
			<td width="20%"><a href="/index/categories/category3" class="bigWhite"><strong>Top Category #3</strong></a></td>
			<td width="16%" onMouseOver="document.getElementById('DownArrow').src='images/DownArrowOn.gif';" onMouseDown="categoriesOn(event,'MoreCategories',0);"  onMouseOut="document.getElementById('DownArrow').src='images/DownArrow.gif';"><a class="bigWhite" style="cursor:pointer; text-decoration:none;"><strong>More Categories</strong>&nbsp;&nbsp;<img src="images/DownArrow.gif" id="DownArrow" name="DownArrow" alt="" width="9" height="9" border="0"></a></td>
<!--			<td width="16%" onMouseOver="document.getElementById('DownArrow').src='images/DownArrowOn.gif'; categoriesOn(event,'MoreCategories',0);" onMouseOut="document.getElementById('DownArrow').src='images/DownArrow.gif';"><a class="bigWhite" style="cursor:pointer; text-decoration:none;"><strong>More Categories</strong>&nbsp;&nbsp;<img src="images/DownArrow.gif" id="DownArrow" name="DownArrow" alt="" width="9" height="9" border="0"></a></td>-->
<!--			<td width="15%" style="cursor:pointer;" onMouseOver="menuDown('MoreCategories',0);"><!--<a href="#" class="bigWhite" onMouseOver="menuDown('MoreCategories',0);">--More Categories<!--</a>--<img src="images/spacer.gif" alt="" width="10" height="9" border="0"><img src="images/DownArrow.gif" alt="" width="9" height="9" border="0"></td>-->
			<td width="24%"></td>
		</tr>
		</table>
	</div>
	<!-- Drop Down Categories -->
	<div id="MoreCategories" align="center" class="roundedBottoms" style="position:absolute; top:-550; left:<?=(($pageWidth*.6)-10);?>; background-color:#DAD8CF; width:<?=$pageWidth/3;?>; height:185; border:thin solid #8A8A8A; z-index:0;" onMouseOut="categoriesOut(event,'MoreCategories',150);" onMouseLeave="divOut(event,'MoreCategories',150);">
		<table width="<?=$pageWidth/3;?>" border="0" cellspacing="10" cellpadding="0" align="center" class="bigBlack">
		<?
		for ($category=4; $category <= 10; $category++){
		?>
		<tr>
			<td><a href="/index/categories/category<?=$category;?>" class="menuBlack">Additional Category #<?=$category;?></a></td>
			<td><a href="/index/categories/category<?=$category+7;?>" class="menuBlack">Additional Category #<?=$category+7;?></a></td>
		</tr>
		<?
		}
		?>
		</table>
	</div>
	<!-- Bread Crumbs -->
	<div id="BreadCrumbs" style="position:absolute; top:180; left:0; width:<?=$pageWidth;?>; height:30; z-index:1;">
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0">
		<div align="left" class="bodyGray">
			<img src="images/spacer.gif" alt="" width="20" height="1" border="0">
			<a href="/index/home" class="bodyGray">Home</a>
		</div>
	</div>
	<!-- END Header -->

	<img src="images/spacer.gif" alt="" width="1" height="500" border="0">

	<!-- BEGIN Footer -->
	<!-- Footer Container -->
	<div align="center" class="footerContainer" id="footerContainer" style="position:static; width:<?=$pageWidth;?>;">
		<div id="Footer" class="roundedCorners" style="position:relative; top:0; left:0; background-color:#25A800; width:<?=$pageWidth;?>; height:100; border:thin solid #8A8A8A; z-index:2;">
			<br><br>
			<table width="500" border="0" cellspacing="0" cellpadding="0" align="center" class="bigWhite">
			<tr>
				<td><em>Text Links</em></td>
				<td align="right"><em>Badges</em></td>
			</tr>
			</table>
		</div>
		<!-- Copyright -->
		<div id="FooterCopyright" align="center" class="roundedBottoms" style="position:relative; top:-30; left:0; background-image:url(images/BGFooter.png); background-position:bottom; width:<?=$pageWidth;?>; height:75; border:thin solid #8A8A8A; z-index:1;">
			<br><br>
			<table border="0" cellspacing="0" cellpadding="0" align="center" class="smallGray">
			<tr>
				<td align="center">
					Copyright&copy; 2009-<? echo date("Y"); ?>, <a href="http://www.bragbuy.com" title="You're Already Here!" class="smallGray" style="text-decoration:underline;">BragBuy&reg;, LLC.</a>.&nbsp;&nbsp;All Rights Reserved.<br>
				</td>
			</tr>
			<!-- Attribution -->
			<tr>
				<td align="center">
					Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray" style="text-decoration:underline;">Network Resources</a>, Las Vegas-Dallas-Milwaukee
				</td>
			</tr>
			</table>
		</div>
	</div>
	<!-- END Footer -->
<br>
</div>

<!-- Social Networking Bar -->
<script>document.write('<div id="SocialBar" style="position:fixed; bottom:0; left:50; width:'+(browserWidth-100)+'; height:50; z-index:10;">');</script>
	<img src="images/spacer.gif" alt="" width="25" height="1" border="0">
	<img src="images/Icon-Facebook.png" alt="Facebook" title="Facebook" width="50" height="50" border="0">
	<img src="images/Icon-Twitter.png" alt="Twitter" title="Twitter" width="50" height="50" border="0">
	<img src="images/Icon-LinkedIn.png" alt="LinkedIn" title="LinkedIn" width="50" height="50" border="0">
	<img src="images/Icon-MySpace.png" alt="MySpace" title="MySpace" width="50" height="50" border="0">
	<img src="images/Icon-Buzz.png" alt="Google Buzz" title="Google Buzz" width="50" height="50" border="0">
	<img src="images/Icon-Digg.png" alt="Digg" title="Digg This" width="50" height="50" border="0">
	<img src="images/Icon-Reddit.png" alt="Reddit" title="Reddit" width="50" height="50" border="0">
	<img src="images/Icon-StumbledUpon.png" alt="StumbledUpon" title="Stumble It!" width="50" height="50" border="0">
	<img src="images/Icon-Delicious.png" alt="Delicious" title="Delicious" width="50" height="50" border="0">
	<img src="images/Icon-Blogger.png" alt="Blogger" title="Blogger" width="50" height="50" border="0">
	<img src="images/Icon-Flickr.png" alt="Flickr" title="Flickr" width="50" height="50" border="0">
	<img src="images/Icon-YouTube.png" alt="YouTube" title="YouTube" width="50" height="50" border="0">
	
	<!--Follow Us-->
</div>
<script>document.write('<div id="SocialBarBottom" class="footerCorners" style="position:fixed; bottom:0; left:50; width:'+(browserWidth-100)+'; height:30; background-color:#CFCFCF; background-image:url(images/BG-SocialBar.png); border:thin solid #C0C0C0; z-index:9;">');</script></div>

</body>
</html>
