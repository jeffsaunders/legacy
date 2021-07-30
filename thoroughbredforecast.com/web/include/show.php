<!-- BEGIN INCLUDE show.php -->

<table border="0" cellspacing="0" cellpadding="10" align="center">
<tr>
	<td class="bodyBlack">
		<!-- Image -->
		<table width="340" border="0" align="right" cellpadding="0" cellspacing="0">
		<tr>
			<td align="right" class="bodyBlack" style="position:relative;">

				<? if (!$cargo){
//					$show = "";
					$cargo = "Select Show Below";
				}
				?>

				<script src="/video/flowplayer-3.2.6.min.js"></script>
<!--				<script src="/video/flowplayer-3.2.9.min.js"></script>-->
				<div id="player" style="width:320px;height:240px;"></div>
				<script>
					flowplayer("player", "/video/flowplayer-3.2.7-0.swf", {
//					flowplayer("player", "/video/flowplayer-3.2.10.swf", {
						buffering: false,
						onFail: function() {
							document.getElementById("info").innerHTML =
								"You need the latest Flash version to view video. " +
								"Your version is " + this.getVersion();
						},
						clip: {
							<? if ($show){ ?>
							url: "/video/<? echo $show; ?>",
//							url: "http://74.124.5.20/2012 TRF Show.mp4",
//        provider: 'pseudo',
//        baseUrl: 'http://74.124.5.20',
//							url: "2012 TRF Show.mp4",

							autoPlay: true,
							autoBuffering: true
							<? } ?>
						}
					});
				</script>
 <!--       url: 'Extremists.flv',
 
        // make this clip use pseudostreaming plugin with "provider" property
        provider: 'pseudo',
 
        // all videos under this baseUrl support pseudostreaming on the server side
        baseUrl: 'http://pseudo01.hddn.com/vod/demo.flowplayervod'-->

<!--
				<SCRIPT LANGUAGE="JavaScript">
				var WMP7;
				if(navigator.appName!="Netscape"){
					WMP7 = new ActiveXObject('WMPlayer.OCX');
				}
			
				// Windows Media Player 7
				if(WMP7){
					document.write('<OBJECT ID=MediaPlayer ');
					document.write('CLASSID=CLSID:6BF52A52-394A-11D3-B153-00C04F79FAA6 ');
					document.write('standby="Loading Microsoft Windows Media Player components..." ');
					document.write('TYPE="application/x-oleobject" width="320" height="325"> ');
					document.write('<PARAM NAME="url" VALUE="video/<? echo $show; ?>">');
					document.write('<PARAM NAME="AutoStart" VALUE="true">');
					document.write('<PARAM NAME="AutoSize" VALUE="false">');
					document.write('<PARAM NAME="ShowControls" VALUE="1">');
					document.write('</OBJECT>');
				}
			
				// Windows Media Player 6
				else{
					// IE
					document.write('<object id=MediaPlayer ');
					document.write('codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112" ');
					document.write('classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" ');
					document.write('standby="Loading Microsoft Media Player components..." ');
					document.write('type="application/x-oleobject" background="white" color="white" bgcolor="white" width="320" height="340">');
					document.write('<param name="FileName" value="video/<? echo $show; ?>">');  //Clip or meta file to play
					document.write('<param name="AutoStart" value="1">'); //Start playing automatically
					document.write('<param name="AutoSize" value="0">'); //Adjust to fit clip
					document.write('<param name="ShowControls" value="1">'); //Control Panel
					document.write('<param name="ShowAudioControls" value="1">'); //Volume & Mute
					document.write('<param name="ShowPositionControls" value="1">'); //FF, RW, Skip, Playlist
					document.write('<param name="ShowTracker" value="1">'); //Tracker (duh)
					document.write('<param name="ShowStatusBar" value="1">'); //Status, Position, Length, etc.
					document.write('<param name="ShowGotoBar" value="0">'); //Clip List
					document.write('<param name="ShowDisplay" value="0">'); //Clip Name, Author, etc.
					document.write('<param name="EnableContextMenu" value="0">'); //Right-Click Menu
					document.write('<param name="AllowChangeDisplaySize" value="0">'); //Duh
					document.write('<param name="EnableFullScreenControls" value="0">'); //Duh
					document.write('<param name="SendPlayStateChangeEvents" value="0">'); //External Control Communications (I think??)
					document.write('<param name="TransparentAtStart" value="0">'); //Is player transparent when not playing 
					document.write('<param name="AnimationAtStart" value="1">'); //Is Windows Media logo animated
					// Netscape
					document.write('    <Embed type="application/x-mplayer2"');
					document.write('        pluginspage="http://www.microsoft.com/windows/windowsmedia/"');
					document.write('        filename="video/<? echo $show; ?>"');
					document.write('        Name=MediaPlayer');
					document.write('        ShowControls=1');
					document.write('        ShowDisplay=0');
					document.write('		ShowTracker=1'); //Tracker (duh)
					document.write('		ShowStatusBar=1'); //Status, Position, Length, etc.
					document.write('		AutoSize=0'); //Adjust to fit clip
					document.write('        width=320');
					document.write('        height=310');
					document.write('		AutoStart=true>'); //Start playing automatically
					document.write('    </embed>');
					// Done
					document.write('</OBJECT>')
				}
				</SCRIPT><br>
-->
				<div align="right" class="smallBlack"><em><strong><font color="#808080">Click This Box to View Full Screen</font></strong></em> &uarr;&uarr;&uarr;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
				<br>
				<div align="center"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"><strong><? echo stripslashes($cargo); ?></strong></div>
			</td>
		</tr>
<!--
		<tr>
			<td>
				<table width="325" border="0" cellspacing="0" cellpadding="0" align="right" class="smallBlack">
				<tr>
					<th width="50%" align="center">2006 Season</th>
					<th width="50%" align="center">2007 Season</th>
				</tr>
				<tr>
					<td colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
				</tr>
				<tr>
					<td><li><a href="?sec=show&show=Derby2006.asx&cargo=2006 Kentucky Derby Show" class="smallBlack">Kentucky Derby Show</a></li></td>
					<td><li><font color="#C0C0C0"><em>Kentucky Derby Show</em></font></li></li></td>
				</tr>
				<tr>
					<td><li><font color="#C0C0C0"><em>Preakness Special</em></font></li></td>
					<td><li><font color="#C0C0C0"><em>Preakness Special</em></font></li></li></td>
				</tr>
				<tr>
					<td><li><font color="#C0C0C0"><em>Belmont Special</em></font></li></td>
					<td><li><font color="#C0C0C0"><em>Belmont Special</em></font></li></td>
				</tr>
				<tr>
					<td><li><font color="#C0C0C0"><em>Breeder's Cup Preview</em></font></li></td>
					<td><li><font color="#C0C0C0"><em>Breeder's Cup Preview</em></font></li></li></td>
				</tr>
				</table>
			</td>
		</tr>
-->
		<tr>
			<td>
				<table width="320" border="0" cellspacing="0" cellpadding="0" align="right" class="smallBlack">
<!--				<tr>
					<th width="50%" align="center">2006 Season</th>
					<th width="50%" align="center">2007 Season</th>
				</tr>-->
				<tr>
					<td colspan="2" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="300" height="1" border="0"></td>
				</tr>
<!--				<tr>
					<td width="50%"><li><a href="?sec=show&show=MagicWay.asx&cargo=M%26S Racing Stable" class="smallBlack">Magic Way to the Races</a></li></td>
					<td width="50%"><li><a href="?sec=show&show=CarsonsCopper.asx&cargo=Carson%27s Copper Wins!" class="smallBlack">Carson's Copper WINS!</a></li></li></td>
				</tr>-->
				<tr>
<!--					<td colspan="2"><li style="font-size:15px; color:#FF0000;"><a href="?sec=show&show=TRF%20Show%20Tease.flv&cargo=2012 Kentucky Derby Show Preview" class="bodyBlack"><strong style="font-size:15px; color:#FF0000;">2012 Kentucky Derby Show Preview</strong></a></li></li></td>-->
					<td colspan="2"><li style="font-size:15px; color:#FF0000;"><a href="?sec=show&show=2012%20TRF%20Show.flv&cargo=2012 Kentucky Derby Show" class="bodyBlack"><strong style="font-size:15px; color:#FF0000;">2012 Kentucky Derby Show</strong></a></li></li></td>
				</tr>
				<tr>
					<td colspan="2"><li style="font-size:15px;"><a href="?sec=show&show=1992%20TRF%20Show.mp4&cargo=1992 Kentucky Derby Show" class="bodyBlack"><strong style="font-size:15px;">1992 Kentucky Derby Show</strong></a></li></li></td>
				</tr>
<!--				<tr>
					<td><li><a href="?sec=show&show=CarsonsCopper.asx&cargo=Carson%27s Copper Wins!" class="smallBlack">Carson's Copper WINS!</a></li></li></td>
					<td><li><a href="?sec=show&show=KentuckyDerbyShow2006.wmv&cargo=2006 Kentucky Derby Show" class="smallBlack">2006 Kentucky Derby Show</a></li></li></td>
					<td><li><a href="?sec=show&show=InterviewWithProfessionalTrainerMikeCurtis-1992.flv&cargo=Professional Trainer Mike Curtis - 1992" class="smallBlack"><strong>Trainer Mike Curtis - 1992</strong></a></li></li></td>
					<td><li><a href="?sec=show&show=KentuckyDerbyShow2006.flv&cargo=2006 Kentucky Derby Show" class="smallBlack"><strong>2006 Kentucky Derby Show</strong></a></li></li></td>
				</tr>-->
				</table>
				<br><br><br>
			</td>
		</tr>


		</table>
		<!-- Text -->
		<strong>Thoroughbred Racing Forecast</strong> is a series of four Nationally Syndicated television specials featuring previews of the BIGGEST RACES in America!<br><br>
		The season premier is the <strong>Kentucky Derby Special</strong>, airing the first weekend in May each year, followed shortly by the <strong>Preakness</strong> and <strong>Belmont Specials</strong>, and finally rounding out the season with the <strong>Breeders Cup Preview</strong> in the Fall.<br><br>
		These programs give the viewer an inside look at these big races, with exclusive interviews from the Track with the Trainers, Jockeys, and Owners.<br><br>
		The show's host, <a href="?sec=host" class="bodyBlack">Dennis Tobler</a>, has been a staple in the race handicapping business in Las Vegas since 1982. Mr. Tobler has been a race horse owner for over 20 years with horses competing at the finest tracks in America. From his first stakes winner, <strong><em>"Golondrina"</em></strong> (Gr. II) in 1988, to <strong><em>"Wizard"</em></strong> (Gr. III) in 1991, to his most recent success, <strong><em>"Indy Weekend"</em></strong> (now standing stud in Oklahoma), Dennis has a unique overview of the entire industry.<br><br>
		As part of syndicates and privately, Mr. Tobler has had 32 winners (and many more winning races) at 10 different tracks. He has purchased yearlings and bought two-year-olds in training while working with some of the biggest names in the business. He also started, promoted and broadcast his winning selections on the "Racing Hotlines" known throughout the West on 976#'s, 900#'s, and 800#'s from 1983 through 1995. Dennis wrote, produced, directed, distributed, and incidently starred in, not only <strong>Thoroughbred Racing Forecast</strong>, but also spent 15 years as the host of the widely popular nationally syndicated television show <strong>Football Forecast Weekly</strong> (<a href="http://www.footballforecast.com" target="_blank" class="bodyBlack">footballforecast.com</a>).<br><br>
		Mr. Tobler retired from public handicapping in 2005, but still continues to bring his tremendous experience and expert knowledge to sports and racing fans through the television shows and as a co-owner of M&S Racing Stable.  With M&S no longer in operation, Dennis has launched his own racing enterprise &mdash; "<a href="?sec=stable" class="bodyBlack">Wise Guys Racing Stable</a>".
	</td>
</tr>
</table>

<!-- END INCLUDE show.php -->
