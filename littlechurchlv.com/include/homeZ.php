			<!-- BEGIN Include home.php -->
			
			<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
			
			<script type="text/javascript" src="/fadeslideshow.js">
				/***********************************************
				* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
				* This notice MUST stay intact for legal use
				* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
				***********************************************/
			</script>
			
			<!-- Rotating Images -->
			<script type="text/javascript">
//				Full documentation -> http://www.dynamicdrive.com/dynamicindex14/fadeinslideshow.htm			
			var mygallery=new fadeSlideShow({
				wrapperid: "fadeshow1", //ID of blank DIV on page to house Slideshow
				dimensions: [230, 405], //width/height of gallery in pixels. Should reflect dimensions of largest image
//					imagearray: [
//						["path_to_image", "optional_url", "optional_linktarget", "optional_description"],
//						["dog.jpg", "", "", "This image has a description but no hyperlink/target"],
//						["http://i29.tinypic.com/xp3hns.jpg", "http://en.wikipedia.org/wiki/Cave", "_new", "Nice Picture!"] //<--no trailing comma after very last image
//					],
				imagearray: [
					["/images/Home01.jpg"],
					["/images/Home02.jpg"],
					["/images/Home03.jpg"],
					["/images/Home04.jpg"],
					["/images/Home05.jpg"]
				],
//					displaymode: {type:'auto|manual', pause:milliseconds, cycles:0|integer, wraparound:true|false, randomize:true|false},
//					The "cycles" option when set to 0 will cause the slideshow to rotate perpetually in automatic mode, while any number larger than 0 means it will stop after x cycles.
//					The "warparound" option when set to false will disable the user's ability in manual mode to go past the very first and last slide when clicking on the navigation links to manually view the slides.
//					The "randomize" option when set to true will shuffle the display order of the images, so they appear in a different order each time the page is loaded.
//					In the following, the slideshow will auto run and stop after 3 complete cycles. Each time the page is reloaded, the order of the images randomly changes:
//					displaymode: {type:'auto', pause:3000, cycles:3, wraparound:true, randomize:true},
//					In the following, the slideshow will be put in manual mode, with the ability to loop back to the beginning of the slideshow disabled:
//					displaymode: {type:'manual', pause:2000, cycles:0, wraparound:false},
//					In manual mode, you must define your own "prev" and "next" controls to let the user control the slideshow. See "togglerid" option below for more info.
				displaymode: {type:'auto', pause:10000, cycles:0, wraparound:false, randomize:false},
				persist: false, //remember last viewed slide and recall within same session?
				fadeduration: 1000, //transition duration (milliseconds)
//					descreveal: "ondemand|always",
//					For a slideshow in which at least one image has a description associated with it, this option dictates the style of the Description Panel. The two choices are "ondemand" and "always". The former reveals the description when the user mouses over the slideshow, while the later shows a persistent description panel at the foot of the slideshow.
				descreveal: "ondemand",
//					togglerid: "slideshowtoggler"
//					Use this option if you wish to create navigational controls that allow the user to explicitly move back and forth between slides, whether the slideshow is in "auto" or "manual" mode. Set "togglerid" to the ID of another DIV on your page that will house the navigation controls for the slideshow
//					The DIV on the page with the corresponding ID attribute will be parsed by the script for links carrying a certain CSS class.
//					--- Example of toggler html code ---
//					<div id="fadeshow2"></div>
//					<div id="fadeshow2toggler" style="width:250px; text-align:center; margin-top:10px">
//					<a href="#" class="prev"><img src="http://i31.tinypic.com/302rn5v.png" style="border-width:0" /></a>  <span class="status" style="margin:0 50px; font-weight:bold"></span> <a href="#" class="next"><img src="http://i30.tinypic.com/lzkux.png" style="border-width:0" /></a>
//					</div>
				togglerid: ""
			})
			</script>

			<!-- Animated Testimonials -->
			<script type="text/javascript">
			var mytestimonials=new fadeSlideShow({
				wrapperid: "testimonials", //ID of blank DIV on page to house Slideshow
				dimensions: [210, 230], //width/height of gallery in pixels. Should reflect dimensions of largest image
				imagearray: [
				<?
				// Grab quotes & build images of them dynamically
				$query = "SELECT quotes.* FROM (SELECT unique_id FROM quotes WHERE display <> 'F' ORDER BY rand() LIMIT 0,30) AS random_quotes JOIN quotes ON quotes.unique_id = random_quotes.unique_id";
				$rs_quotes = mysql_query($query, $linkID2);
				for ($quote_cnt=1; $quote_cnt <= mysql_num_rows($rs_quotes); $quote_cnt++){
					$quote_row = mysql_fetch_assoc($rs_quotes);
				?>
					["TextIMG.php?text=&ldquo;<?=urlencode($quote_row["text"])."&rdquo;%0d%0a%0a%20%20%20%20%20-%20".urlencode($quote_row["name"]);?>&font=bair.ttf&bold=no&points=14&txtcolor=F8F6E8&shadow=000000&offset=1&width=210&height=230&left=2&top=14&angle=0&bgcolor=770025&transparent=no&format=png"]<?=iif($quote_cnt < mysql_num_rows($rs_quotes), ",", "");?>
				<?
				}
				?>
				],
				displaymode: {type:'auto', pause:6600, cycles:0, wraparound:false, randomize:true}, // 6.6 seconds so it's always offset from the pictures
				persist: false, //remember last viewed slide and recall within same session?
				fadeduration: 1000, //transition duration (milliseconds)
				descreveal: "ondemand",
				togglerid: ""
			})
			</script>

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

			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3">
					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
				</td>
			</tr>
			<tr>
				<td valign="top">
					<!-- Left Column -->
					<table width="225" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
							<!-- Image Slideshow -->
							<div id="fadeshow1" style="display:inline-block; background:transparent; z-index:500"></div>
						</td>
					</tr>
					<tr>
						<td>
							<!-- Spacer -->
							<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
						</td>
					</tr>
					<tr>
						<td>
							<!-- Testimonials -->
							<table width="225" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td background="images/225BurgundyBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
							</tr>
							<tr>
								<td align="center" background="images/225BurgundyBGMiddle.gif">
									<!-- Testimonials Slideshow -->
									<a href="/index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families">
									<div id="testimonials" style="display:inline-block; background:transparent; z-index:500"></div>
									</a>
									<?=iif(stristr($navigator_user_agent, 'msie'), '<img src="images/spacer.gif" alt="" width="225" height="10" border="0"><br>', '');?>
								</td>
							</tr>
							<tr>
								<td background="images/225BurgundyBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
							</tr>
							</table>
						</td>
					</tr>	
					</table>
				</td>
				<!-- Spacer -->
				<td><img src="images/spacer.gif" alt="" width="1" height="10" border="0"></td>
				<td valign="top">
					<!-- Right Column -->
					<table width="665" border="0" cellspacing="0" cellpadding="0" align="right">
					<tr>
						<td>
							<!-- Flash Player -->
							<div style="position:relative; top:0; left:0; z-index:1;">
								<script language="JavaScript" type="text/javascript">
									AC_FL_RunContent(
										'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0',
										'width', '665',
										'height', '467',
										'src', 'flash/HomePage',
										'quality', 'high',
										'pluginspage', 'http://www.adobe.com/go/getflashplayer',
										'align', 'middle',
										'play', 'true',
										'loop', 'true',
										'scale', 'showall',
										'wmode', 'transparent',
										'devicefont', 'false',
										'id', 'flash/HomePage',
										'bgcolor', '#ffffff',
										'name', 'flash/HomePage',
										'menu', 'true',
										'allowFullScreen', 'false',
										'allowScriptAccess','sameDomain',
										'movie', 'flash/HomePage',
										'salign', ''
										); //end AC code
								</script>
								<noscript>
									<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="665" height="467" id="flash/HomePage" align="middle">
									<param name="allowScriptAccess" value="sameDomain" />
									<param name="allowFullScreen" value="false" />
									<param name="movie" value="flash/HomePage.swf" /><param name="quality" value="high" /><param name="bgcolor" value="#ffffff" />	<embed src="flash/HomePage.swf" quality="high" bgcolor="#ffffff" width="665" height="467" name="flash/HomePage" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
									</object>
								</noscript>
								<!-- Top Border -->
								<div style="position:absolute; top:0; right:0; z-index:20;">
									<img src="images/665BGTopTrans.gif" alt="" width="665" height="20" border="0">
								<div>
								<!-- Middle Border -->
								<div style="position:absolute; top:20; right:0; z-index:20;">
									<img src="images/665BGMiddleTrans.gif" alt="" width="665" height="427" border="0">
								<div>
								<!-- Bottom Border -->
								<div style="position:absolute; top:427; right:0; z-index:20;">
									<img src="images/665BGBottomTrans.gif" alt="" width="665" height="20" border="0">
								<div>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<!-- Spacer -->
							<img src="images/spacer.gif" alt="" width="1" height="<?=iif(stristr($navigator_user_agent, "firefox"), "10", "5");?>" border="0"><br>
						</td>
					</tr>
					<tr>
						<td>
							<!-- Testimonials -->
							<table width="665" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
							</tr>
							<tr>
								<td align="center" background="images/665WhiteBGMiddle.gif">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td><img src="images/spacer.gif" alt="" width="15" height="168" border="0"></td>
										<td valign="top" class="bodyDarkGray">
											<span class="bigBlack"><strong>Welcome to the World Famous Little Church of the West Wedding Chapel</strong></span><br><br>
											<?=$config2["home_text"];?>
										</td>
										<td><img src="images/spacer.gif" alt="" width="15" height="158" border="0"></td>
									</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td background="images/665WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
							</tr>
							</table>
						</td>
					</tr>	
					</table>
				</td>
			</tr>
			</table>

			<!-- END Include home.php -->	
