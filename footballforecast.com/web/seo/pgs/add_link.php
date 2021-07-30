<?php
include_once('includes/config.inc.php');
if(isset($_POST['name'])) {
	$query="INSERT INTO link SET name='".$_POST['name']."', description='".$_POST['description']."', 
	url='".$_POST['url']."', admin='".$_POST['admin_name']."', email='".$_POST['email']."', comment='".$_POST['message']."'";
	mysql_query($query);
	if(mysql_affected_rows()>0) {
		$message='Link Inquiry has been submitted';
	}
	else {
		$message='Unable to add link to database, please try again later';
	}
}
?>
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
<script type="text/javascript" src="stm31.js"></script>
<script type="text/javascript" src="menu.js"></script>

<br>

<center>


</td>
<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">
<div align="center">
	<font color="#990000"><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15">Link Inquiry Form
	<img border="0" src="images/lock.jpg" width="12" height="15"></span></font></div>
<form name="form1" method="post" action="add_link.php">
<div align="center" style="color: #FF0000"><?php echo $message; ?></div>
  <table width="500" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt; font-weight: bold;">
    <tr align="center" bgcolor="#000000;">
      <td colspan="2" style="color:#FFFFFF; font-size: 14px; ">Information About Your Website</td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Website Name </td>
      <td><input name="name" type="text" id="name" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>URL</td>
      <td><input name="url" type="text" id="url" size="35"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Site Description</td>
      <td><textarea name="description" cols="30" rows="3" id="description"></textarea></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Your Name </td>
      <td><input name="admin_name" type="text" id="admin_name" size="30"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Email</td>
      <td><input name="email" type="text" id="email" size="30"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td>Additional Message</td>
      <td><textarea name="message" cols="30" rows="3" id="message"></textarea></td>
    </tr>
    <tr bgcolor="#EEEEEE">
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="Submit Link"></td>
    </tr>
  </table>
</form>
</td>

<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('right_td.php'); ?>
</td>

</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>