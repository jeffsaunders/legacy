<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">

<!--
Copyright 2002, Vibrance, Inc.
Graphics by Jeff S. Saunders (c) 2002
Authored by Jeff S. Saunders 09/06/2002
Modified by Jeff S. Saunders 09/20/2002
-->

<html>
<head>
	<title>Vibrance!</title>

	<script language="javascript">

	//Load button images for flipping on mouse-overs
	if (document.images) {
		img1on = new Image();
		img1on.src = "images/btn_home_on.gif";
		img2on = new Image();
		img2on.src = "images/btn_about_on.gif";
		img3on = new Image();
		img3on.src = "images/btn_news_on.gif";
		img4on = new Image();
		img4on.src = "images/btn_articles_on.gif";
		img5on = new Image();
		img5on.src = "images/btn_survey_on.gif";
		img6on = new Image();
		img6on.src = "images/btn_store_on.gif";

		img1off = new Image();
		img1off.src = "images/btn_home_off.gif";
		img2off = new Image();
		img2off.src = "images/btn_about_off.gif";
		img3off = new Image();
		img3off.src = "images/btn_news_off.gif";
		img4off = new Image();
		img4off.src = "images/btn_articles_off.gif";
		img5off = new Image();
		img5off.src = "images/btn_survey_off.gif";
		img6off = new Image();
		img6off.src = "images/btn_store_off.gif";
	}
	//Mouse pointer on button
	function imgOn(imgName) {
		if (document.images) {
			document[imgName].src = eval(imgName + "on.src");
		}
	}
	//Mouse pointer off button
	function imgOff(imgName) {
		if (document.images) {
			document[imgName].src = eval(imgName + "off.src");
		}
	}
	</script>

</head>

<body>

<table border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td colspan="2"><img src="images/header_articles.gif" width="700" height="91" alt="" border="0"></td>
</tr>
<tr>
	<td width="167" valign="top" background="images/menu.gif" style="background-position: top; background-repeat: no-repeat;"><br>
		<table cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/blankbutton.gif" width="110" height="30" alt="" border="0"></td>
		</tr>
		<tr>
			<td><a href="index.php" onMouseOver="imgOn('img1')" onMouseOut="imgOff('img1')"><img src="images/btn_home_off.gif" alt="Welcome Page" name="img1" id="img1" width="110" height="30" border="0"></a></td>
		</tr>	
			<td><a href="about.php" onMouseOver="imgOn('img2')" onMouseOut="imgOff('img2')"><img src="images/btn_about_off.gif" alt="About Vibrance" name="img2" id="img2" width="110" height="30" border="0"></a></td>
		</tr>	
		</tr>	
			<td><a href="news.php" onMouseOver="imgOn('img3')" onMouseOut="imgOff('img3')"><img src="images/btn_news_off.gif" alt="News &amp; Information" name="img3" id="img3" width="110" height="30" border="0"></a></td>
		</tr>	
		<tr>
			<td><a href="articles.php" onMouseOver="imgOn('img4')" onMouseOut="imgOff('img4')"><img src="images/btn_articles_off.gif" alt="Anti-Aging Articles" name="img4" id="img4" width="110" height="30" border="0"></a></td>
		</tr>	
		<tr>
			<td><a href="survey.html" onMouseOver="imgOn('img5')" onMouseOut="imgOff('img5')"><img src="images/btn_survey_off.gif" alt="Wellness Survey" name="img5" id="img5" width="110" height="30" border="0"></a></td>
		</tr>	
		<tr>
			<td><a href="store.php" onMouseOver="imgOn('img6')" onMouseOut="imgOff('img6')"><img src="images/btn_store_off.gif" alt="Life Enhancement Products Store" name="img6" id="img6" width="110" height="30" border="0"></a></td>
		</tr>	
		<tr>
			<td><img src="images/spacer.gif" width="1" height="40" alt="" border="0"><br><img src="images/spacer.gif" width="10" height="1" alt="" border="0"><a href="store.php"><img src="images/visitstore.gif" alt="Life Enhancement Products Store" width="120" height="90" border="0"></a></td>
		</tr>
		</table>
	</td>
	<td><iframe src="article_menu.php" name="articles" id="articles" width="533" height="525" marginwidth="0" marginheight="0" align="top" scrolling="auto" frameborder="0"></iframe></td>
<!--	<td width="533" height="715" align="center" valign="top" background="images/articles_wm.jpg" style="background-position: top; background-repeat: no-repeat;"><font face="serif" size="+4"><br><br>Anti-Aging Articles...</font></td>-->
</tr>
<tr>
	<td colspan="2"><img src="images/footer.gif" alt="" width="700" height="55" border="0"></td>
</tr>
</table>

</body>
</html>
