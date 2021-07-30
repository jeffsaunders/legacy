<!DOCTYPE HTML> 
<!--<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">--> 
 
<html> 
<head> 
	<title>SasciBlackAndWhite.com</title> 
	<link href="standard.css" rel="stylesheet" type="text/css"> 
	<link href="common.css" rel="stylesheet" type="text/css"> 
</head> 
 
<body bgcolor="#000000" leftmargin="0" topmargin="0" marginwidth="0" onResize="window.location.reload(true);window.location=window.location;"> 
 
<script language="JavaScript1.2"> 
	// Must be interrogated within <body> tags
	browserWidth = document.body.clientWidth;
	document.write('<style>.pageContainer {position:absolute; top:0px; left:'+((browserWidth/2)-(980/2))+'px; width:980;}</style>');
	document.write('<style>.fixedContainer {position:fixed; top:0px; left:'+((browserWidth/2)-(980/2))+'px; width:980; height:100%;}</style>');
</script> 
 
<!-- Place scaled background --> 
<div> 
	<img id="background" src="images/Background.jpg" alt="" title=""> 
</div> 
 
<div class="fixedContainer" id="Layout" style="background-color:#000000; z-index:1;"> 
	<img src="images/spacer.gif" alt="" width="980" border="0"> 
</div> 
<div class="pageContainer" id="pageContainer"> 
	<div id="Singer" class="bigmenuWhite" style="position:relative; top:10px; left:10px; width:300px; height:485px; background-color:#000000; z-index:2;"> 
		<img src="images/Singer.jpg" alt="" width="300" height="485" border="0"><br> 
		Sasc<img src="images/spacer.gif" alt="" width="2" height="1" border="0">i Black & White Dance Club<br> 
		123 Rodeo Drive<br> 
		Beverly Hills, CA &nbsp;90210<br><br> 
		Open for Supper at 7:00, 7 Days<br> 
		Reservations: 310.555.1212<br><br> 
		<a href="http://maps.google.com/maps?jsid=1&hl=en&um=1&ie=UTF-8&q=Luxe+Hotel+Rodeo+Drive&fb=1&cid=0,0,16381774543400334032&near=Beverly+Hills,+CA&sa=X&ei=B3spTaXXC4L58Aa545C5AQ&ved=0CAMQkwMwAQ" target="_blank" class="bigmenuWhite">Click Here for Directions</a>
		<br>
	</div> 
	<div id="Header" style="position:absolute; top:10px; left:310px; width:660px; height:100px; background-color:#660000; z-index:2;"> 
		<div id="DecoLeft" style="position:absolute; top:0px; left:0px; width:100px; height:100px; z-index:3;"> 
			<img src="images/DecoHeaderLeft.png" alt="" width="100" height="100" border="0"> 
		</div> 
		<div id="DecoTop" style="position:absolute; top:0px; left:100px; width:465px; height:9px; background-image:url(images/DecoHeaderMiddle.png); background-repeat:repeat-x; z-index:3;"></div> 
		<div id="DecoRight" style="position:absolute; top:0px; right:0px; width:100px; height:100px; z-index:3;"> 
			<img src="images/DecoHeaderRight.png" alt="" width="100" height="100" border="0"> 
		</div> 
		<div id="Logo" style="position:absolute; top:10px; left:50px; width:150px; height:100px; z-index:3;"> 
			<img src="images/Logo.png" alt="Sasci Black & White" width="140" height="93" border="0"> 
		</div> 
		<div align="center" id="Menu" class="menuWhite" style="position:absolute; top:65px; left:200px; width:460px; height:100px; z-index:3;"> 
			<a href="home" class="menuWhite">Home</a>&nbsp;&nbsp;|&nbsp;
			<a href="info" class="menuWhite">Info</a>&nbsp;&nbsp;|&nbsp;
			<a href="calendar" class="menuWhite">Calendar</a>&nbsp;&nbsp;|&nbsp;
			<a href="video" class="menuWhite">Video</a>&nbsp;&nbsp;|&nbsp;
			<a href="shop" class="menuWhite">Shop</a>&nbsp;&nbsp;|&nbsp;
			<a href="reservations" class="menuWhite">Reservations</a> 
		</div> 
	</div> 
	<div id="Body" class="bigWhite" style="position:absolute; top:110px; left:310px; width:660px; z-index:2;"> 
		<?
		// Branch content based on "sec" value
		switch($sec){
			case "": include("include/home.php");break;
			case "home": include("include/home.php");break;
			case "info": include("include/info.php");break;
			case "calendar": include("include/calendar.php");break;
			case "video": include("include/video.php");break;
			case "shop": include("include/shop.php");break;
			case "reservations": include("include/reservations.php");break;
			default: include("include/home.php");break;
		} // End Switch
		?>

<!--		<div align="center" class="smallGray">
			<br><br>
			Copyright&copy; 2010-2011, <a href="http://www.sasciblackandwhite.com" title="You're Already Here!" class="smallGray" style="text-decoration:underline;">SasciBlackAndWhite.com&reg;</a>.&nbsp;&nbsp;All Rights Reserved.<br>
			Developed, Maintained, &amp; Hosted by <a href="http://www.nr.net" title="When Experience Matters." target="_blank" class="smallGray" style="text-decoration:underline;">Network Resources</a>, Las Vegas-Dallas-Milwaukee
		</div>--> 
	</div> 
</div> 
 
</body> 
</html> 
 
 