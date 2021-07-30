<!-- BEGIN INCLUDE Home -->

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">


<table width="860" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Main Body -->
	<td valign="top" class="bodyBlack">
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<!-- Image -->
		<table width="340" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<!-- Chapel Front Large -->
			<td width="340" colspan="2" align="center"><img src="images/Front2_300.jpg" alt="" width="300" height="400" border="1"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
		</tr>
		<tr>
			<!-- RJ Best Of Las Vegas Bug & Scroller -->
			<td width="200" align="center" valign="bottom">
				<table width="200" border="0" cellspacing="0" cellpadding="0">
				<tr>
<!--					<td width="75" align="right"><img src="images/bolv.gif" alt="" width="70" height="61" border="0"></td>-->
					<td width="75" align="right"><img src="images/bolv2010.png" alt="" width="70" height="72" border="0"></td>
					<td width="125" align="center" class="smallBlack">
						<?
						// Build string of winning years for crawler
						$years = explode(",",$config["bolv_years"]);
						$last_year = $years[sizeof($years)-1]
						
						?>
						<strong>
						<span class="bigBlack"><? echo $last_year; ?> Winner!</span><br>
						<span class="bodyBlack"><? echo $config["bolv_consecutive"]; ?>th Straight Year</span><br>
						<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
						Voted Best Wedding<br>
						Chapel in Las Vegas<br>
						<? echo sizeof($years); ?> of the Last <? echo $config["bolv_duration"]; ?> Years<br>
						<img src="images/spacer.gif" alt="" width="1" height="2" border="0"><br>
						</strong>
					</td>
				</tr>
				</table>
<!--				<marquee behavior="scroll" direction="left" width="199" height="18" loop="" scrollamount="5" scrolldelay="0" truespeed class="bodyBlack">
				<?
				// Build string of winning years for crawler
				$marqueecontent="<nobr><strong class=\"bigBlack\">";
//				$years = explode(",",$row["bolv_years"]);  //Already done above
				for ($counter=1; $counter <= sizeof($years); $counter++){
					if ($counter < sizeof($years)){
						$marqueecontent .= $years[$counter-1];
						$marqueecontent .= "<img src=\"images/spacer.gif\" width=\"8\" height=\"1\" alt=\"\" border=\"0\">";
					}else{
						$marqueecontent .= "<font color=\"#FF0000\">".$years[$counter-1]."!</font></strong></nobr>";
					}
				}
				echo $marqueecontent;
				?>
				</marquee>-->

				<script language="JavaScript1.2">
				/*
				Cross browser Marquee script- © Dynamic Drive (www.dynamicdrive.com)
				For full source code, 100's more DHTML scripts, and Terms Of Use, visit http://www.dynamicdrive.com
				Credit MUST stay intact
				*/
				//Specify the marquee's width (in pixels)
				var marqueewidth="199px"
				//Specify the marquee's height
				var marqueeheight="18px"
				//Specify the marquee's marquee speed (larger is faster 1-10)
				var marqueespeed=1
				//configure background color:
				var marqueebgcolor="#F8F6E8"
				//Pause marquee onMousever (0=no. 1=yes)?
				var pauseit=0

				//Specify the marquee's content (don't delete <nobr> tag)
				//Keep all content on ONE line, and backslash any single quotations (ie: that\'s great):
//				var marqueecontent='<nobr><strong>1994<img src="images/spacer.gif" width="8" height="1" alt="" border="0">1995<img src="images/spacer.gif" width="8" height="1" alt="" border="0">1996<img src="images/spacer.gif" width="8" height="1" alt="" border="0">1998<img src="images/spacer.gif" width="8" height="1" alt="" border="0">1999<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2000<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2001<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2002<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2003<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2004<img src="images/spacer.gif" width="8" height="1" alt="" border="0">2005<img src="images/spacer.gif" width="8" height="1" alt="" border="0"><font color="#FF0000">2006!</font></strong></nobr>'
				<?
				// Build string of winning years for crawler
//				$row = mysql_fetch_assoc($rs_config);  //Already done above
				$marqueecontent="var marqueecontent='<nobr><strong>";
//				$years = explode(",",$row["bolv_years"]);  //Already done above
				for ($counter=1; $counter <= sizeof($years); $counter++){
					if ($counter < sizeof($years)){
						$marqueecontent .= $years[$counter-1];
						$marqueecontent .= "<img src=\"images/spacer.gif\" width=\"8\" height=\"1\" alt=\"\" border=\"0\">";
					}else{
						$marqueecontent .= "<font color=\"#FF0000\">".$years[$counter-1]."!</font></strong></nobr>'";
					}
				}
				echo $marqueecontent;
				?>

				////NO NEED TO EDIT BELOW THIS LINE////////////
				marqueespeed=(document.all)? marqueespeed : Math.max(1, marqueespeed-1) //slow speed down by 1 for NS
				var copyspeed=marqueespeed
				var pausespeed=(pauseit==0)? copyspeed: 0
				var iedom=document.all||document.getElementById
				if (iedom)
				document.write('<span id="temp" style="visibility:hidden;position:absolute;top:-100px;left:-9000px">'+marqueecontent+'</span>')
				var actualwidth=''
				var cross_marquee, ns_marquee
				
				function populate(){
				if (iedom){
				cross_marquee=document.getElementById? document.getElementById("iemarquee") : document.all.iemarquee
				cross_marquee.style.left=parseInt(marqueewidth)+8+"px"
				cross_marquee.innerHTML=marqueecontent
				actualwidth=document.all? temp.offsetWidth : document.getElementById("temp").offsetWidth
				}
				else if (document.layers){
				ns_marquee=document.ns_marquee.document.ns_marquee2
				ns_marquee.left=parseInt(marqueewidth)+8
				ns_marquee.document.write(marqueecontent)
				ns_marquee.document.close()
				actualwidth=ns_marquee.document.width
				}
				lefttime=setInterval("scrollmarquee()",20)
				}
				window.onload=populate
				
				function scrollmarquee(){
				if (iedom){
				if (parseInt(cross_marquee.style.left)>(actualwidth*(-1)+8))
				cross_marquee.style.left=parseInt(cross_marquee.style.left)-copyspeed+"px"
				else
				cross_marquee.style.left=parseInt(marqueewidth)+8+"px"
				
				}
				else if (document.layers){
				if (ns_marquee.left>(actualwidth*(-1)+8))
				ns_marquee.left-=copyspeed
				else
				ns_marquee.left=parseInt(marqueewidth)+8
				}
				}
				
				if (iedom||document.layers){
				with (document){
				document.write('<table border="0" cellspacing="0" cellpadding="0"><td>')
				if (iedom){
				write('<div style="position:relative;width:'+marqueewidth+';height:'+marqueeheight+';overflow:hidden">')
				write('<div style="position:absolute;width:'+marqueewidth+';height:'+marqueeheight+';background-color:'+marqueebgcolor+'" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">')
				write('<div id="iemarquee" style="position:absolute;left:0px;top:0px"></div>')
				write('</div></div>')
				}
				else if (document.layers){
				write('<ilayer width='+marqueewidth+' height='+marqueeheight+' name="ns_marquee" bgColor='+marqueebgcolor+'>')
				write('<layer name="ns_marquee2" left=0 top=0 onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed"></layer>')
				write('</ilayer>')
				}
				document.write('</td></table>')
				}
				}
				</script>
			</td>
			<!-- National Register of Historic Places Bug -->
			<td width="120" align="right"><img src="images/NationalRegisterV.png" alt="" width="115" height="100" border="0"></td>
		</tr>
		</table>
	</td>
	<td valign="top" class="bodyBlack">		
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<!-- Image -->
		<table width="350" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<!-- Header -->
			<td><img src="images/Header2.png" alt="" width="350" height="100" border="0"></td>
		</tr>
		</table>
		<!-- Image -->
		<table width="115" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<!-- Chapel Front Small -->
			<td align="right"><img src="images/Front3_100.jpg" alt="" width="100" height="150" border="1"></td>
		</tr>
		</table><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<!-- Text -->
		<p><br><br><br><br><br><br>Las Vegas is known as the <em>"Wedding Capital of the World"</em> and <strong>The Little Church of the West</strong> is the couples' favorite place in Las Vegas to get married.</p>
		<!-- Image -->
		<table width="200" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
			<!-- Image Collage -->
			<td align="left"><br><img src="images/spacer.gif" alt="" width="15" height="1" border="0"><img src="images/HomeCollage3_190.gif" alt="" width="190" height="300" border="0"><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
		</tr>
		</table>
		<p>This quaint chapel, with its expert staff providing personal attention and a wide variety of services, makes your wedding a most memorable event.</p>

		<p>Many couples choose The Little Church of the West for its unique history and setting; free standing amid one acre of beautiful landscape, directly on the Las Vegas Strip.</p>
		<!-- Image -->
		<table width="245" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<!-- Chapel Interior Collage -->
			<td align="right"><br><img src="images/HomeCollage4_255.gif" alt="" width="255" height="195" border="0"></td>
		</tr>
		</table>
	</td>
	<td width="12"><img src="images/spacer.gif" alt="" width="12" height="500" border="0"><br></td>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- END INCLUDE Home -->
