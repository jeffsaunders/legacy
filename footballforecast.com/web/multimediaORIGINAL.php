<?php
session_start();
include_once('includes/config.inc.php');
if(!isset($_SESSION['login_id'])) {
	header('Location: login.php?url=multimedia.php');
	die();
}
//get latest clip from database
$query="SELECT * FROM movie WHERE status='tv_multimedia' ORDER BY id DESC LIMIT 0,1";
$result=mysql_query($query);
if($result && mysql_num_rows($result)>0) {
	$data=mysql_fetch_array($result);
}
?>
<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Free Weekly Football Video, Football analysis</title>
<meta name="keywords" content="free college football picks, football broadcast, handicapper info, NFL picks, football forecast weekly, free picks, SPORTS PICKS, Sports Gambling, football, free NFL football picks, sports betting info, football shows, Free Sports Picks, handicapping">
<meta name="description" content="Dennis Tobler's Football Forecast Weekly. Guaranteed picks, sports insight">
<link href="css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">
<p align="center"><font color="#990000"><span style="font-size: 14pt">TV Multimedia</span></font></p>
<table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td style="font-family:Arial; font-size:14pt; font-weight:bold" align="center" bgcolor="#FFFFFF"><?php echo $data['title']; ?></td>
  </tr>
  <tr>
    <td style="font-family:Arial; font-size:10pt; font-weight:bold" align="center" bgcolor="#FFFFFF"><?php echo $data['description']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF">
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
document.write('<PARAM NAME="url" VALUE="<?php echo $data['movie']; ?>">'); 
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
document.write('<param name="FileName" value="<?php echo $data['movie']?>">'); //Clip or meta file to play 
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
document.write(' <Embed type="application/x-mplayer2"'); 
document.write(' pluginspage="http://www.microsoft.com/windows/windowsmedia/"'); 
document.write(' filename="<?php echo $data['movie']?>"'); 
document.write(' Name=MediaPlayer'); 
document.write(' ShowControls=1'); 
document.write(' ShowDisplay=0'); 
document.write(' ShowTracker=1'); //Tracker (duh) 
document.write(' ShowStatusBar=1'); //Status, Position, Length, etc. 
document.write(' AutoSize=0'); //Adjust to fit clip 
document.write(' width=320'); 
document.write(' height=340'); 
document.write(' AutoStart=true>'); //Start playing automatically 
document.write(' </embed>'); 
// Done 
document.write('</OBJECT>') 
} 
</SCRIPT>    
    </td>
  </tr>
</table>
</td>



<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="footballÊforecast, betting picks, football broadcast, football shows, football information, football handicapping, football picks, NFL picks, NCAA picks, free football picks, free NFL picks, free NCAA picks, football betting tips, live stream football, football season info, sports, football stats, football radio, football scores, news"><br>
<? include('tdright.php'); ?>
</td>




</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>