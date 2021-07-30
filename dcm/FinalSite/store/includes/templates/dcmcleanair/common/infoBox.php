<?
// Start the session
session_start(); 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>

	<!-- Load Style Sheets -->
	<link href="/css/common.css" rel="stylesheet" type="text/css">
	<![if (!IE)|(IE 9)]>
		<link href="/css/standard.css" rel="stylesheet" type="text/css">
	<![endif]>
	<!-- Change this to ie.css -->
	<!--[if lt IE 9]>
		<link href="/css/standard.css" rel="stylesheet" type="text/css">
<!--		<div style="position:absolute; top:0; left:0; background-color:#FF0000; font-family:Myvetica,sans-serif; font-size:10px; color:#FFFFFF; z-index:9999999;">
			<strong>*Notice - You are using Internet Explorer below version 9, so things may not look as good as they should, YET.</strong>
		</div>-->
	<![endif]-->
</head>

	<body bgcolor="#FFFFFF">
		<table border="0" align="right" class="smallBlack" bgcolor="#FFFFFF">
		<tr>
			<td valign="bottom"><strong>Welcome:</strong></td>
			<td valign="bottom">{Logged In User}</td>
			<td width="20"></td>
			<td valign="bottom"><img src="/images/CartIcon.png" alt="" width="18" height="13" border="0"> <a href="/store/?main_page=shopping_cart" class="smallBlack"><strong>My Cart</a>:</strong></td>
			<td valign="bottom">
				<?
				echo $_SESSION['cart']->count_contents();
				?>
				Items
			</td>
		</tr>
		</table>
</body></html>
