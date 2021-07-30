<html>

<head>
<title>Dennis Tobler's Football Forecast Weekly</title>
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

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15"> User Login
	<img border="0" src="images/lock.jpg" width="12" height="15"></span></font></div>
<div align="center">
			<div align="justify">
	&nbsp;</div>
			<div align="justify">
	&nbsp;</div>
			<div align="justify">
	&nbsp;</div>
	</div>
	<span style="font-size: 14pt; font-weight: 400">
<div align="center">
<form name="form1" method="post" action="member.php">
  <table bgcolor="#CCCCCC" width="275" border="0" align="center" cellpadding="5" cellspacing="1" style="font: arial; font-size: 10pt; font-weight: bold;">
    <tr>
      <td align=right width="252" colspan="2" bgcolor="#000000">
		<p align="center"><font color="#FFFFFF">Login - Existing Users</font></td>
      </tr>
    <tr bgcolor="#FFFFFF">
      <td align=right width="69">User ID </td>
      <td width="183"><input name="login_id" type="text" id="login_id" size="25"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right" width="69">Password</td>
      <td width="183"><input name="password" type="password" id="password" size="25"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="center">
      <input type="hidden" name="url" value="<?php echo $_GET['url']?>">
      <input type="submit" name="Submit" value="Login"></td>
    </tr>
  </table>
</form>
<div align="center">
	<div align="center">
			<p style="margin-top: 0; margin-bottom: 0">
			&nbsp;</p>
	</div>
	<div align="center">
			<p style="margin-top: 0; margin-bottom: 0">
			<font color="#808080">If you are not a 
			registered user, please<br>
			</font></span><span style="font-size: 18pt; ">
			<a href="https://secure.nr.net/footballforecast/signup.php">CLICK HERE TO 
			SIGN UP</a></span><span style="font-size: 14pt; font-weight: 400"><font color="#808080"><span style="font-size: 8pt; font-weight: 400"><br>
			(You must&nbsp; be a registered user 
			before buying plays)</span></font></p>
	</div>
	<p>&nbsp;</div>
<div align="center">
	<font face="Verdana" color="#CCCCCC">
	<span style="font-size: 8pt; font-weight: 400">Dennis Tobler's Football 
	Forecast Weekly</span></font></div>
<div align="justify">
	&nbsp;</div>
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