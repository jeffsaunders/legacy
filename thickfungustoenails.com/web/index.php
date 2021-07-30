<!-- Grab the database -->
<? include("dbconnect.php"); ?>

<!-- Assign passed (via path) values -->
<?
// Blow apart the passed path
$aPath = explode("/",$_SERVER['REQUEST_URI']);
// Pop (shift) off the annoying leading blank
array_shift($aPath);
// Assign passed values
$page = $aPath[0];
$sec = $aPath[1];
$feature = $aPath[2];
$task = $aPath[3];
$message = $aPath[4];
$test = $aPath[5];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<!--
Title - Nevada Foot Institute - Thick Fungus Nails Information 
Development Copyright 2010, Network Resources - Las Vegas, Nevada USA (www.nr.net)
Digital Art Copyright 2010, Network Resources
All Content Copyright 2010, Network Resources and Nevada Foot Institute Respectively
Authored by Jeff S. Saunders, Network Resources 05/31/10
Modified by Jeff S. Saunders, Network Resources 06/03/10
-->

<html>
<head>
	<title>Thick Fungus Nails Information brought to you by the Nevada Foot Institute - Las Vegas, Nevada</title>

	<!-- Meta Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta name="robots" content="all">
	<meta name="revisit-after" content="1 days">
	<meta name="classification" content="Medica Foot Care Treatment Clinic">
	<meta name="description" content="Thick Fungus Toenails Laser Treatment Information brought to you by the Nevada Foot Institute - Las Vegas, Nevada">
	<meta name="keywords" content="thick fungus toenails laser treatment, toenail fungus, laser treatment, cool breeze, foot doctor, nevada foot institute, nevada foot, nevadafoot, nevada, las vegas, vegas, podiatrist, podiatrics, podiatric, foot, feet, toe, toes, heel, heels, arch, arches, ankle, ankles, pain, foot pain, heel pain, toe pain, arch pain, ingrown, ingron nail, ingrown toenail, ingrown toenails, infected nail, infected nails, thickened nail, thickened nails, fungus, nail fungus, toe fungus, hammer toe, black-and-blue nails, corns, warts, bunion, bunyon, bunions, bunyons, spur, spurs, bone spur, bone spurs, heel spur, heel spurs, plantar, plantar fasciitis, plantar fascitis, planter fasciitis, planter fascitis, flat foot, flat feet, neuroma, neuromas, shockwave, shockwave therapy, non-invasive shockwave therapy, aksm/ortho, eswt, marek, neal marek, dr marek, dr neal marek, neal marek dpm, open saturday, speak spanish, se habla espanol">

	<!-- Define Home Base -->
	<base href="http://www.thickfungusnails.com/">

	<!-- Load Style Sheet -->
	<link href="nevadafoot.css" rel="stylesheet" type="text/css">

	<?
//	if (!$sec || $sec == "home"){
	if ($sec != "information"){
	?>
	<!-- Flash (Generated with CS4 AS3) -->
	<script language="JavaScript" type="text/javascript">
	<!--
	//v1.7
	// Flash Player Version Detection
	// Detect Client Browser type
	// Copyright 2005-2008 Adobe Systems Incorporated.  All rights reserved.
	var isIE  = (navigator.appVersion.indexOf("MSIE") != -1) ? true : false;
	var isWin = (navigator.appVersion.toLowerCase().indexOf("win") != -1) ? true : false;
	var isOpera = (navigator.userAgent.indexOf("Opera") != -1) ? true : false;
	function ControlVersion()
	{
		var version;
		var axo;
		var e;
		// NOTE : new ActiveXObject(strFoo) throws an exception if strFoo isn't in the registry
		try {
			// version will be set for 7.X or greater players
			axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.7");
			version = axo.GetVariable("$version");
		} catch (e) {
		}
		if (!version)
		{
			try {
				// version will be set for 6.X players only
				axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.6");
				
				// installed player is some revision of 6.0
				// GetVariable("$version") crashes for versions 6.0.22 through 6.0.29,
				// so we have to be careful. 
				
				// default to the first public version
				version = "WIN 6,0,21,0";
				// throws if AllowScripAccess does not exist (introduced in 6.0r47)		
				axo.AllowScriptAccess = "always";
				// safe to call for 6.0r47 or greater
				version = axo.GetVariable("$version");
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 4.X or 5.X player
				axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
				version = axo.GetVariable("$version");
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 3.X player
				axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash.3");
				version = "WIN 3,0,18,0";
			} catch (e) {
			}
		}
		if (!version)
		{
			try {
				// version will be set for 2.X player
				axo = new ActiveXObject("ShockwaveFlash.ShockwaveFlash");
				version = "WIN 2,0,0,11";
			} catch (e) {
				version = -1;
			}
		}
		
		return version;
	}
	// JavaScript helper required to detect Flash Player PlugIn version information
	function GetSwfVer(){
		// NS/Opera version >= 3 check for Flash plugin in plugin array
		var flashVer = -1;
		
		if (navigator.plugins != null && navigator.plugins.length > 0) {
			if (navigator.plugins["Shockwave Flash 2.0"] || navigator.plugins["Shockwave Flash"]) {
				var swVer2 = navigator.plugins["Shockwave Flash 2.0"] ? " 2.0" : "";
				var flashDescription = navigator.plugins["Shockwave Flash" + swVer2].description;
				var descArray = flashDescription.split(" ");
				var tempArrayMajor = descArray[2].split(".");			
				var versionMajor = tempArrayMajor[0];
				var versionMinor = tempArrayMajor[1];
				var versionRevision = descArray[3];
				if (versionRevision == "") {
					versionRevision = descArray[4];
				}
				if (versionRevision[0] == "d") {
					versionRevision = versionRevision.substring(1);
				} else if (versionRevision[0] == "r") {
					versionRevision = versionRevision.substring(1);
					if (versionRevision.indexOf("d") > 0) {
						versionRevision = versionRevision.substring(0, versionRevision.indexOf("d"));
					}
				}
				var flashVer = versionMajor + "." + versionMinor + "." + versionRevision;
			}
		}
		// MSN/WebTV 2.6 supports Flash 4
		else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.6") != -1) flashVer = 4;
		// WebTV 2.5 supports Flash 3
		else if (navigator.userAgent.toLowerCase().indexOf("webtv/2.5") != -1) flashVer = 3;
		// older WebTV supports Flash 2
		else if (navigator.userAgent.toLowerCase().indexOf("webtv") != -1) flashVer = 2;
		else if ( isIE && isWin && !isOpera ) {
			flashVer = ControlVersion();
		}	
		return flashVer;
	}
	// When called with reqMajorVer, reqMinorVer, reqRevision returns true if that version or greater is available
	function DetectFlashVer(reqMajorVer, reqMinorVer, reqRevision)
	{
		versionStr = GetSwfVer();
		if (versionStr == -1 ) {
			return false;
		} else if (versionStr != 0) {
			if(isIE && isWin && !isOpera) {
				// Given "WIN 2,0,0,11"
				tempArray         = versionStr.split(" "); 	// ["WIN", "2,0,0,11"]
				tempString        = tempArray[1];			// "2,0,0,11"
				versionArray      = tempString.split(",");	// ['2', '0', '0', '11']
			} else {
				versionArray      = versionStr.split(".");
			}
			var versionMajor      = versionArray[0];
			var versionMinor      = versionArray[1];
			var versionRevision   = versionArray[2];
	        	// is the major.revision >= requested major.revision AND the minor version >= requested minor
			if (versionMajor > parseFloat(reqMajorVer)) {
				return true;
			} else if (versionMajor == parseFloat(reqMajorVer)) {
				if (versionMinor > parseFloat(reqMinorVer))
					return true;
				else if (versionMinor == parseFloat(reqMinorVer)) {
					if (versionRevision >= parseFloat(reqRevision))
						return true;
				}
			}
			return false;
		}
	}
	function AC_AddExtension(src, ext)
	{
	  if (src.indexOf('?') != -1)
	    return src.replace(/\?/, ext+'?'); 
	  else
	    return src + ext;
	}
	function AC_Generateobj(objAttrs, params, embedAttrs) 
	{ 
	  var str = '';
	  if (isIE && isWin && !isOpera)
	  {
	    str += '<object ';
	    for (var i in objAttrs)
	    {
	      str += i + '="' + objAttrs[i] + '" ';
	    }
	    str += '>';
	    for (var i in params)
	    {
	      str += '<param name="' + i + '" value="' + params[i] + '" /> ';
	    }
	    str += '</object>';
	  }
	  else
	  {
	    str += '<embed ';
	    for (var i in embedAttrs)
	    {
	      str += i + '="' + embedAttrs[i] + '" ';
	    }
	    str += '> </embed>';
	  }
	  document.write(str);
	}
	function AC_FL_RunContent(){
	  var ret = 
	    AC_GetArgs
	    (  arguments, ".swf", "movie", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000"
	     , "application/x-shockwave-flash"
	    );
	  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
	}
	function AC_SW_RunContent(){
	  var ret = 
	    AC_GetArgs
	    (  arguments, ".dcr", "src", "clsid:166B1BCA-3F9C-11CF-8075-444553540000"
	     , null
	    );
	  AC_Generateobj(ret.objAttrs, ret.params, ret.embedAttrs);
	}
	function AC_GetArgs(args, ext, srcParamName, classid, mimeType){
	  var ret = new Object();
	  ret.embedAttrs = new Object();
	  ret.params = new Object();
	  ret.objAttrs = new Object();
	  for (var i=0; i < args.length; i=i+2){
	    var currArg = args[i].toLowerCase();    
	    switch (currArg){	
	      case "classid":
	        break;
	      case "pluginspage":
	        ret.embedAttrs[args[i]] = args[i+1];
	        break;
	      case "src":
	      case "movie":	
	        args[i+1] = AC_AddExtension(args[i+1], ext);
	        ret.embedAttrs["src"] = args[i+1];
	        ret.params[srcParamName] = args[i+1];
	        break;
	      case "onafterupdate":
	      case "onbeforeupdate":
	      case "onblur":
	      case "oncellchange":
	      case "onclick":
	      case "ondblclick":
	      case "ondrag":
	      case "ondragend":
	      case "ondragenter":
	      case "ondragleave":
	      case "ondragover":
	      case "ondrop":
	      case "onfinish":
	      case "onfocus":
	      case "onhelp":
	      case "onmousedown":
	      case "onmouseup":
	      case "onmouseover":
	      case "onmousemove":
	      case "onmouseout":
	      case "onkeypress":
	      case "onkeydown":
	      case "onkeyup":
	      case "onload":
	      case "onlosecapture":
	      case "onpropertychange":
	      case "onreadystatechange":
	      case "onrowsdelete":
	      case "onrowenter":
	      case "onrowexit":
	      case "onrowsinserted":
	      case "onstart":
	      case "onscroll":
	      case "onbeforeeditfocus":
	      case "onactivate":
	      case "onbeforedeactivate":
	      case "ondeactivate":
	      case "type":
	      case "codebase":
	      case "id":
	        ret.objAttrs[args[i]] = args[i+1];
	        break;
	      case "width":
	      case "height":
	      case "align":
	      case "vspace": 
	      case "hspace":
	      case "class":
	      case "title":
	      case "accesskey":
	      case "name":
	      case "tabindex":
	        ret.embedAttrs[args[i]] = ret.objAttrs[args[i]] = args[i+1];
	        break;
	      default:
	        ret.embedAttrs[args[i]] = ret.params[args[i]] = args[i+1];
	    }
	  }
	  ret.objAttrs["classid"] = classid;
	  if (mimeType) ret.embedAttrs["type"] = mimeType;
	  return ret;
	}
	// -->
	</script>
	<?
	}
	?>
	
</head>

<body bgcolor="#F0F0FF" leftmargin="0" topmargin="10">

<table width="870" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#090982"><!-- Blue Border -->
<tr>
	<td>
		<table width="860" border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#ECEDEF"><!-- Light Inner Border -->
		<tr>
			<td>
				<table width="850" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#ECEDEF"><!-- Main Container -->
				<tr>
					<td height="300">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" background="images/Header.jpg">
						<tr>
							<!-- Header -->
							<td>
								<a href="http://www.nevadafoot.com" target="_self" title="Nevada Foot Institute"><img src="images/spacer.gif" alt="" width="300" height="300" border="0"></a>
							</td>
							<td><img src="images/spacer.gif" alt="" width="550" height="300" border="0"></td>
						</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<!-- Tagline -->
							<td height="40" align="center" bgcolor="#090982" class="xbigWhite">
								<strong><em>&ndash; Nevada's Source for Laser Treatment of Thick Fungus Nails &ndash;</em></strong>
							</td>
						</tr>
						<tr>
							<!-- Content -->
							<td align="center">
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<?
//								if (!$sec || $sec == "home"){
								if ($sec != "information" && $sec != "pictures"){ // Home Page
								?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="250"><img src="images/CoolBreezeLaser1.jpg" alt="" width="250" height="350" border="1"></td>
									<td width="600" valign="top">
										<!-- Flash Animation -->
										<div style="position:relative;>
											<!-- I have NO idea why the following line needs to be there, AS-IS, but without it all Hell breaks loose -->
											<!--<div onClick="window.location='/index/information';">
											<script language="JavaScript" type="text/javascript">
												AC_FL_RunContent(
													'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0',
													'width', '600',
													'height', '350',
													'src', 'flash/ThickNails',
													'quality', 'high',
													'pluginspage', 'http://www.adobe.com/go/getflashplayer',
													'align', 'middle',
													'play', 'true',
													'loop', 'false',
													'scale', 'showall',
													'wmode', 'transparent',
													'devicefont', 'false',
													'id', 'ThickNails',
													'bgcolor', '#ffffff',
													'name', 'ThickNails',
													'menu', 'true',
													'allowFullScreen', 'false',
													'allowScriptAccess','sameDomain',
													'movie', 'flash/ThickNails',
													'salign', ''
													); //end AC code
											</script>
											<noscript>
												<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="600" height="350" id="ThickNails" align="middle">
												<param name="allowScriptAccess" value="sameDomain" />
												<param name="allowFullScreen" value="false" />
												<param name="wmode" value="transparent" />
												<param name="loop" value="false" />
												<param name="movie" value="flash/ThickNails.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="flash/ThickNails.swf" quality="high" bgcolor="#ffffff" width="600" height="350" name="ThickNails" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" wmode="transparent" loop="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
												</object>
											</noscript>
											<!-- Transparent clickable image on top of Flash -->
											<div id="ClickableRegion" style="position:absolute; top:0px; left:0px; width:600px; height:350px; z-index:9999;">
												<a href="/index/information" title="Click Here for Thick Fungus Nails Information">
													<img src="images/spacer.gif" alt="" width="600" height="350" border="0">
												</a>
											</div>
										</div>
									</td>
								</tr>
								</table>
								<br>
								<?
								}elseif ($sec == "information"){ //Ailment & Treatment Information
									// Grab information
									$query = "SELECT * FROM fungus_nails_content WHERE display <> 'F' ORDER BY paragraph";
									$rs_content = mysql_query($query, $linkID);
									$content = mysql_fetch_assoc($rs_content);
								?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
								<tr>
									<!-- Picture -->
									<td valign="top"><img src="images/FungusBigToe.jpg" alt="" width="250" height="275" border="1"></td>
									<!-- Left Column Spacer -->
									<td><img src="images/spacer.gif" alt="" width="15" height="1" border="0"></td>
									<!-- Paragraph Title & Content -->
									<td>
										<br><strong class="bigBlue"><li><?=$content["title"];?></li></strong>
										<ul><?=$content["content"];?></ul><br>
									</td>
									<!-- Right Column Spacer -->
									<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
								</tr>
								</table>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
								<tr>
									<!-- Left Column Spacer -->
									<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
									<!-- Paragraph Title & Content -->
									<td valign="top">
										<?
										for ($cnt=2; $cnt <= mysql_num_rows($rs_content); $cnt++){
											$content = mysql_fetch_assoc($rs_content);
										?>
										<br><strong class="bigBlue"><li><?=$content["title"];?></li></strong>
										<ul><?=$content["content"];?></ul>
										<?
										}
										?>
									</td>
									<!-- Right Column Spacer -->
									<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
									<!-- Toe Pictures (Before & After) -->
									<td align="center" valign="top">
										<img src="images/Before1-100.jpg" alt="Before" width="100" height="100" border="1"><br>Before<br>
										<img src="images/After1-100.jpg" alt="After" width="100" height="100" border="1"><br>*After<br><br>
										<img src="images/Before2-100.jpg" alt="Before" width="100" height="100" border="1"><br>Before<br>
										<img src="images/After2-100.jpg" alt="After" width="100" height="100" border="1"><br>*After<br><br>
										<img src="images/Before3-100.jpg" alt="Before" width="100" height="100" border="1"><br>Before<br>
										<img src="images/After3-100.jpg" alt="After" width="100" height="100" border="1"><br>*After<br><br>
										<img src="images/Before4-100.jpg" alt="Before" width="100" height="100" border="1"><br>Before<br>
										<img src="images/After4-100.jpg" alt="After" width="100" height="100" border="1"><br>*After<br><br>
<!--										<div align="right"><strong class="smallBlue"><em>*Results May Vary</em></strong></div><br>-->
									</td>
								</tr>
								<tr>
									<td colspan="4" align="right" class="smallBlue">
										<strong><em>
										*Individual Results May Vary<br>
										**Laser Treatment is Considered Investigational<br><br>
										</em></strong>
									</td>
								</tr>
								</table>
								<?
								}elseif ($sec == "pictures"){
									// Grab information
									$query = "SELECT * FROM fungus_nails_content WHERE paragraph = 6";
									$rs_content = mysql_query($query, $linkID);
									$content = mysql_fetch_assoc($rs_content);
								?>
								<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
								<tr>
									<!-- Left Column Spacer -->
									<td rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
									<!-- Introduction -->
									<td>
										<br><strong class="bigBlue"><li>So, what do Thick Fungus Toenails look like?</li></strong>
										<ul>The toenail may become yellow in appearance and deformed. Discoloration and flaking of the toenail may occur. The nail may separate and lift from the nail bed making it easier for the nail fungus to spread.<br><br>
										The following are some examples of Thick Fungus Toenails:</ul>
									</td>
									<!-- Right Column Spacer -->
									<td rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
								</tr>
								<tr>
									<!-- Picture Gallery -->
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/SH1.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/SH2.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/AR2.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/FullFeet7.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/OneFoot2b.jpg" alt="" width="271" border="1"></td>
											<td align="center" valign="top"><img src="images/OneFoot3b.jpg" alt="" width="270" border="1"></td>
											<td align="right" valign="top"><img src="images/OneFoot4b.jpg" alt="" width="271" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/FullFeet3.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/FullFeet6.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/FullFeet1.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/FullFeet4.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/OneFoot1.jpg" alt="" width="271" border="1"></td>
											<td align="center" valign="top"><img src="images/OneFoot1b.jpg" alt="" width="270" border="1"></td>
											<td align="right" valign="top"><img src="images/OneFoot4.jpg" alt="" width="271" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/FullFeet2.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/FullFeet5.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/FullFeet8.jpg" alt="" width="410" border="1"></td>
											<td align="right" valign="top"><img src="images/TwoFeet.jpg" alt="" width="410" border="1"></td>
										</tr>
										</table>
										<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="left" valign="top"><img src="images/OneFoot3.jpg" alt="" width="271" border="1"></td>
											<td align="center" valign="top"><img src="images/OneFoot2.jpg" alt="" width="270" border="1"></td>
											<td align="right" valign="top"><img src="images/OneFoot5.jpg" alt="" width="271" border="1"></td>
										</tr>
										</table>
									</td>
								</tr>
								<!-- Lower Section -->
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
										<tr>
											<td colspan="2">
												<br><br><strong class="bigBlue"><li>What sort of results can I expect?</li></strong>
												<ul><?=$content["content"];?></ul>
											</td>
											<td width="10"></td>
											<td width="100" align="center"><br><br><br><br><img src="images/Patent-1-(Before).jpg" alt="Before" width="100" height="100" border="1"><br>Before</td>
											<td width="5"></td>
											<td width="100" align="center"><br><br><br><br><img src="images/Patient-1-(After-2-months).jpg" alt="*After 2 Months" width="100" height="100" border="1"><br>*After 2 Months</td>
											<td width="15"></td>
											<td width="100" align="center"><br><br><br><br><img src="images/Patient-2-(Before).jpg" alt="Before" width="100" height="100" border="1"><br>Before</td>
											<td width="5"></td>
											<td width="100" align="center"><br><br><br><br><img src="images/Patient-2-(After-3-months).jpg" alt="*After 3 Months" width="100" height="100" border="1"><br>*After 3 Months</td>
										</tr>
										</table>
										<br>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
											<td width="130" align="center"><img src="images/Patient-3-(Before).jpg" alt="Before" width="130" height="130" border="1"><br>Before</td>
											<td width="5"></td>
											<td width="130" align="center"><img src="images/Patient-3-(3-months).jpg" alt="*After 3 Months" width="130" height="130" border="1"><br>*After 3 Months</td>
											<td width="5"></td>
											<td width="130" align="center"><img src="images/Patient-3-(after-7-months).jpg" alt="*After 7 Months" width="130" height="130" border="1"><br>*After 7 Months</td>
											<td width="25"></td>
											<td width="130" align="center"><img src="images/Patient-4-(Before).jpg" alt="Before" width="130" height="130" border="1"><br>Before</td>
											<td width="5"></td>
											<td width="130" align="center"><img src="images/Patient-4-(3-months).jpg" alt="*After 3 Months" width="130" height="130" border="1"><br>*After 3 Months</td>
											<td width="5"></td>
											<td width="130" align="center"><img src="images/Patient-4-(after-7-months).jpg" alt="*After 7 Months" width="130" height="130" border="1"><br>*After 7 Months</td>
										</tr>
										</table>
										<br>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlue">
											<td width="200" align="center"><img src="images/Patient-5-(Before).jpg" alt="Before" width="200" height="200" border="1"><br>Before</td>
											<td width="8"></td>
											<td width="200" align="center"><img src="images/Patient-5-(3-months).jpg" alt="*After 3 Months" width="200" height="200" border="1"><br>*After 3 Months</td>
											<td width="8"></td>
											<td width="200" align="center"><img src="images/Patient-5-(6-months).jpg" alt="*After 6 Months" width="200" height="200" border="1"><br>*After 6 Months</td>
											<td width="8"></td>
											<td width="200" align="center"><img src="images/Patient-5-after-12-months).jpg" alt="*After 12 Months" width="200" height="200" border="1"><br>*After 12 Months</td>
										</tr>
										</table>
<!--										<br><div align="right"><strong><em>*Results May Vary</em></strong></div>-->
										<br>
										<div align="right">
											<strong><em>
											*Individual Results May Vary<br>
											**Laser Treatment is Considered Investigational
											</em></strong>
										</div>
									</td>
								</tr>
								</table>
								<br>
								<?
								}
								?>
								<!-- Call To Action -->
								<strong class="xbigBlue"><a href="http://www.nevadafoot.com" title="Nevada's Source for Laser Treatment of Thick Fungus Nails" target="_self" class="xbigBlue">Click Here to visit Nevada Foot Institute's Website</a><br>
								or Call (702)438-2425 to Make an Appointment Today!
								<!-- Spacer -->
								<br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<!-- Menu -->
								<a href="/" title="Home Page" class="bigBlue">Home</a> &diams; <a href="/index/information" title="Thick Fungus Nails Information" class="bigBlue">Information</a> &diams; <a href="/index/pictures" title="Thick Fungus Nails Pictures" class="bigBlue">Pictures</a> &diams; <a href="http://www.nevadafoot.com" title="Nevada's Source for Laser Treatment of Thick Fungus Nails" class="bigBlue">NevadaFoot.com</a></strong>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Copyright -->
	<td align="center" valign="middle" class="bodyGray">
		<strong>Copyright&copy; 2004-<?=date("Y");?>, <a href="http://www.nevadafoot.com" title="Nevada's Source for Laser Treatment of Thick Fungus Nails" class="bodyGray">Nevada Foot Institute</a>&#174;.&nbsp;&nbsp;All Rights Reserved.<br>
		Proudly Developed &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="bodyGray">Network Resources</a>, Las Vegas-Dallas-Milwaukee<br><br>
	</td>
</tr>
</table>

</body>
</html>

