<html>

<head>

<?
$url = explode('.', $_SERVER['HTTP_HOST']);
array_pop($url);
$site = array_pop($url);
if ($site == "toblerandassociates") echo'<META HTTP-EQUIV="refresh" CONTENT="0; url=http://www.footballforecast.com/mediakit">';
?>
<title>Dennis Tobler's Football Forecast Weekly www.footballforecast.com</title>
<meta name="keywords" content="football season 2010, handicapping, football forecast weekly, Free NFL football picks, top point spread, free college football picks, free picks, sports betting info, football broadcast, SPORTS PICKS, football shows, handicapper info, Sports Gambling, Free Sports Picks, NFL picks, Football">
<meta name="description" content="Dennis Tobler's Football Forecast Weekly featuring FREE PICKS and top point spread selections... PRICELESS insight!">
<meta name="revisit" content="7 days" />
<meta name="author" content="mindiikaeee, Dennis Tobler's Football Forecast Weekly">
<link href="css/style.css" type="text/css" rel="stylesheet">
<link rel="shortcut icon" href="http://www.footballforecast.com/ffc.ico">


<script type="text/javascript" language="javascript">
<!--
function PopUp() {
	var x=-30;
	var y=-60;
	if (document.layers) {
		x=x+(window.outerWidth-720)/2;
		y=y+(window.outerHeight-480)/2;
	}
	else {
		x= x + (screen.availWidth-720)/2;
		y= y + (screen.availHeight-480)/2;
	}
	if (x<0) x=0;
	if (y<0) y=0;
	var w=window.open("http://www.vegas35tv.com/livefeed.asp","","top="+y+",left="+x+",width=350,height=330,location=0,menubar=0,toolbar=0,status=0,resizable=0,scrollbars=0");
}
//-->
</SCRIPT>



</head>

<body onLoad="loadSWF(getVideoURL());">

<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>

<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>


<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px">
<br><br>
<div align="center">
	<div align="center">
		<table border="0" width="100%" cellspacing="0" cellpadding="0" id="table3" height="274">
			<tr>
				<td align="center" style="padding: 2px; font-family:Verdana; font-size:14pt; font-weight:bold">

			
			<span style="font-size: 4pt">&nbsp;</span>		
			
			
			
			
		<table border="0" cellspacing="1" cellpadding="0" id="table8" bgcolor="#A40000" width="400" height="119">
			<tr>
<td align="center" bgcolor="#FFFFFF">

<?
// Get RSS feed of all videos up on You Tube and write it to the cache
$rssURL = "http://gdata.youtube.com/feeds/api/users/DennisTobler/uploads";
$localFile = "cache/YouTubeVideos.xml";
$cacheMinutes = 5;

function fetchFeed(){
	global $rssURL, $localFile;
	$contents = file_get_contents($rssURL); //fetch RSS feed
	$fp = fopen($localFile, "w");
	fwrite($fp, $contents); //write contents of feed to cache file
	fclose($fp);
}

function outputRSSContent(){
	global $rssURL, $localFile, $cacheMinutes;
	if (!file_exists($localFile)){ //if cache file doesn't exist
		touch($localFile); //create it


		chmod($localFile, 0666);
		fetchFeed(); //then populate cache file with contents of RSS feed
	}
	else if (((time()-filemtime($localFile))/60)>$cacheMinutes)	fetchFeed(); //if age of cache file is greater than cache minutes setting get a fresh copy
//	readfile($localFile); //return the contents of the cache file
}

outputRSSContent(); //make sure we have a current XML file to work with.
?>

<script>
// Open up the cached XML file we just downloaded
function loadXMLDoc(dname){
	if (window.XMLHttpRequest){
		xhttp = new XMLHttpRequest();
	}else{
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("GET",dname,false);
	xhttp.send();
	return xhttp.responseXML;
} 

// Scan the XML file looking for the URL of the latest video posted
function getVideoURL(){
	xmlDoc = loadXMLDoc("<?=$localFile?>");
	// if they are using a WebKit Borwser (Chrome, Safari, etc.)
	if (document.getElementsByTagNameNS != undefined){
		var url = xmlDoc.getElementsByTagNameNS("http://search.yahoo.com/mrss/","content")[0].getAttribute("url"); 
	}else{ // Non-WebKit (IE, Firefox, Opera, etc.)
		var url = xmlDoc.getElementsByTagName("media:content")[0].getAttribute("url"); 
	}
	// Strip off the crap
	SplitResult = url.split("?");
	// Add our own crap and return the entire URL
	return SplitResult[0]+"?fs=1&amp;hl=en_US&amp;rel=0";
}
</script>

<script type="text/javascript" src="swfobject.js">// SWFObject library for dynamic embed creation</script>
<script type="text/javascript">
function loadSWF(url){
	var flashvars = {};
	var params = {
		allowFullScreen: "true",
		allowscriptaccess: "always"
	};
	var attributes = {};
	// Create the embed object using the URL built above, put it in the "YouTubeMovie" DIV with the subsequent parameters (Width, Height, Min. Flash Version, BGColor, etc.)
	swfobject.embedSWF(url, "YouTubeMovie", "560", "340", "6", "#336699", flashvars, params, attributes);
}
</script>

<div id="YouTubeMovie">
	Please wait for YouTube to load
</div>

<!--<object width="560" height="340"><param name="movie" id="movie" value="http://www.youtube.com/v/4H6t_2k9A7s?fs=1&amp;hl=en_US&amp;rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/4H6t_2k9A7s?fs=1&amp;hl=en_US&amp;rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="560" height="340"></embed></object>-->



<!--
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"
  codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,79,0"
  id="ads0" width="218" height="117">
  <param name="movie" value="ani/ads.swf">
  <param name="quality" value="best">
  <param name="bgcolor" value="#FFFFFF">
    <embed name="ads0" src="ani/ads.swf"
     quality="best" bgcolor="#FFFFFF" swLiveConnect="true"
     width="218" height="117"
     type="application/x-shockwave-flash"
     pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
</object>





<br>
<!--<b><span style="font-size: 10pt">&nbsp;</span><span style="font-size: 15pt"><br>
</span><font face="Arial"><a href="https://secure.nr.net/footballforecast/signup.php">
<font style="font-size: 11.5pt">FREE USER REGISTRATION !</font></a><font style="font-size: 11.5pt"><br>
</font></font></b>
<font color="#808080"><span style="font-size: 7pt">Find out what you get for a 
free registration</span></font>-->
</td>


<!--<td align="center" style="padding:3px; cursor:hand; font-family:Verdana; font-size:10pt; color:#0000FF; onmouseover=; "this.style.background='#FFcb01'" onmouseout="this.style.background='#ffffff'" bgcolor="#FFFFFF">
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
		document.write('TYPE="application/x-oleobject" width="171" height="173"> ');
//		document.write('<PARAM NAME="url" VALUE="mov/SeasonTag.wmv">');
		document.write('<PARAM NAME="url" VALUE="mov/FSS.wmv">');
		document.write('<PARAM NAME="AutoStart" VALUE="true">');
		document.write('<PARAM NAME="AutoSize" VALUE="false">');
		document.write('<PARAM NAME="ShowControls" VALUE="1">');
		document.write('</OBJECT>');
	// Windows Media Player 6
	else{
		// IE
		document.write('<object id=MediaPlayer ');
		document.write('codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,7,1112" ');
		document.write('classid="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" ');
		document.write('standby="Loading Microsoft Media Player components..." ');
		document.write('type="application/x-oleobject" background="white" color="white" bgcolor="white" width="171" height="173">');
//		document.write('<param name="FileName" value="mov/SeasonTag.wmv">');  //Clip or meta file to play
		document.write('<param name="FileName" value="mov/FSS.wmv">');  //Clip or meta file to play
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
//		document.write('        filename="mov/SeasonTag.wmv"');
		document.write('        filename="mov/FSS.wmv"');
		document.write('        Name=MediaPlayer');
		document.write('        ShowControls=1');
		document.write('        ShowDisplay=0');
		document.write('		ShowTracker=1'); //Tracker (duh)
		document.write('		ShowStatusBar=1'); //Status, Position, Length, etc.
		document.write('		AutoSize=0'); //Adjust to fit clip
		document.write('        width=171');
		document.write('        height=173');
		document.write('		AutoStart=true>'); //Start playing automatically
		document.write('    </embed>');
		// Done
		document.write('</OBJECT>')
	}

</SCRIPT>
<!--

->
</td>-->
</tr>
</table>


<br>


<!-- Facebook Badge START --><a href="http://www.facebook.com/people/Dennis-Tobler/100001382180538" target="_TOP" style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; font-variant: normal; font-style: normal; font-weight: normal; color: #3B5998; text-decoration: none;" title="Dennis Tobler">Dennis Tobler</a><span style="font-family: &quot;lucida grande&quot;,tahoma,verdana,arial,sans-serif; font-size: 11px; line-height: 16px; font-variant: normal; font-style: normal; font-weight: normal; color: #555555; text-decoration: none;"></span> <br/><a href="http://www.facebook.com/people/Dennis-Tobler/100001382180538" target="_TOP" title="Dennis Tobler"><img src="http://badge.facebook.com/badge/100001382180538.588.281463933.png" width="360" height="136" style="border: 0px;" /></a> <!-- Facebook Badge END -->
<br><br><br>
		
<br>	</div>
	<p align="justify"><font face="Arial">
	<span style="font-size: 10pt; font-weight: 700"><br>WELCOME to DENNIS TOBLER'S FOOTBALL FORECAST!<br><br><br>
	Since the start of the new millenium, Mr. Tobler has travelled worldwide, professionally handicapping, consulting 
	gaming operations, and producing television programs featuring casinos and 
	sportsbooks. In 2010, the public anxiously awaits what Dennis Tobler will have to offer this football season!<br><br>
	Free football plays are available by clicking &quot;Access Free Plays&quot; on the menu above. Check back often for new plays!<br><br>
	To recieve Money Managed professional late information plays, sign up for my paid plays! Accessible the day of the game, you will be receiving the same plays that REAL pro gamblers in Las Vegas rely on.  <br> <br><br>
	Archived versions of Dennis Tobler's Football Forecast Weekly television show available on this website 
	can be accessed and seen worldwide with the simple click of a mouse. The
	popular football prediction show, based in the sports gaming &quot;Capital of the 
	World,&quot; Las Vegas, has been in production for over fifteen years! Special guest handicappers, Las Vegas powerplayers, the Football Forecast girls round out what the 
	<i>Orange County Register</i> has called &quot;America's #1 Football TV Show.&quot;<br>
	<br>
	The show features such Vegas illuminaries as Buzz Daly, who brings his 
	vast knowledge and objective views of the industry. Buzz is currently a columnist for Casino Player Magazine. His insights are priceless. James &quot;Jimbo&quot; Burford also adds his talents by releasing each 
	week, &quot;Jimbo's Jumbo Parlay.&quot; Jimbo has terrorized Las Vegas Sportsbooks 
	over the years with his ten and fifteen team parlays that have the Las Vegas 'books 
	quaking in their shoes!!! <br>
	<br> Add me on Facebook and check out my new YouTube Channel! Also, be sure to check FootballForecast.com often for updated YouTube videos on this home page...
	 <br>
	<br><br>


<table border="0" cellspacing="1" cellpadding="0" id="table10" bgcolor="#A40000" width="400" height="100">
			<tr>
<a href="http://www.kvbc.com/Global/story.asp?S=4087476" target="_blank">
<td style="cursor:hand; align="center" onmouseover="this.style.background='#FFE2A9'" onmouseout="this.style.background='#ffffff'" bgcolor="#FFFFFF">


<p align="center">
<font color="#0000FF" face="Arial"><b><span style="font-size: 12pt">CHECK OUT THE LATEST NEWS!<br></span><span style="font-size: 4pt">&nbsp;</span><span style="font-size: 12pt"><br>OUR FOOTBALL FORECASTER JIMBO</span><br><span style="font-size: 4pt">&nbsp;</span><br><span style="font-size: 17pt">WINS $400,000!</span></b></font></td></a>


</tr>
			</table>
		<br><br><br>
	 </span></font></p>
<!--	<p>
	<font color="#ff0000" style="font-size: 14pt; font-weight: 700" face="Arial">
	<a href="advertising_tv.php">Click Here</a> </font>
	<b><font face="Arial" color="#C80000"><span style="font-size: 14pt; ">For 
	Information On Advertising Opportunities.-->
	<br>
	<img border="0" src="images/transparent.gif" width="3" height="3" alt="football 
	forecast, betting picks, football broadcast, football shows, football 
	information, football handicapping, football picks, NFL picks, NCAA picks, 
	free football picks, free NFL picks, free NCAA picks, football betting tips, 
	live stream football, football season info, sports, football stats, football 
	radio, football scores, news, NFL, National Football League, sports central, 
	sports, central, sports commentary, sports articles, sports insight, sports 
	predictions, sports columns, sports columnists, sports knowledge, sports, 
	sports news, sports links, sports info, sports information, 
	sports-central.org, sports highlights, sports recaps, football predictions, 
	sports coverage, sports results, live sports coverage, sports awards, 
	baseball, basketball, football, hockey, tennis, sports polls, nba, nhl, nfl, 
	mlb, NCAA sports, college football, football analysis, athletics, football 
	athletes, collegiate sports, sports newsletter, football betting, football 
	bets, football picks, football betting, Football picks, NFL football, 
	handicapping, gambling, Free picks, college football, free picks, sports 
	handicapping, handicapping software, sports gambling, handicapping software, 
	handicapping, betting, gambling, handicapping, betting, gambling, sports, 
	sports gambling, picks, betting, picks, sports gambling, handicapping 
	software, Sports, odds, scores, football, basketball, baseball, free picks, 
	odds, news, lines, scores, handicapping, Free NFL football picks, free 
	college football picks, sports betting info, SPORTS PICKS, Sports Gambling 
	and Sportsbook Information,sports book info, Free Sports Picks, NFL picks, 
	Football, Basketball, Baseball, Gambling, sports betting, handicapping, 
	sports book, handicapper, professional handicappers league, handicappers, 
	free picks, guaranteed picks, sports handicappers, cappers, sports betting, 
	bet on sports, free sports picks, sportsbook reviews, contests, winners, 
	win, handicapping tools, baseball, football ,hockey, basketball, college 
	sports, sportsbooks, sports betting, sportsbetting, sport bets, picks, 
	gambling, bet advice, handicapping, football, baseball, basketball bets, 
	edge, sports, Las Vegas, Nevada, nfl, mlb, nhl, nba, lines, pointspreads, 
	point spreads, odds, sport service, teasers, sportbooks, sportsbooks, 
	services, gaming, selections, NFL picks weekly, nfl football picks, betting 
	handicapping odds, nfl predictions, weekly football predictions, weekly 
	handicapper picks, gambling sports, point spreads, top point spreads, point 
	spread selections, Las Vegas handicappers, handicapper top point spread 
	selection, football handicapper prediction, weekly pro football picks 
	betting, NFL Pick, football picks newsletter, football tv show, football 
	video"></span></font></b></div>
</td>


<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>


</tr>
</table>





<? include('footer.php'); ?>
</body>


</html>