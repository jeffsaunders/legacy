<?
// Assign passed values
$sec = $_REQUEST['sec'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Mobile Phone Oriented Websites Portfolio</title>
	<link href="standard.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<!--<tr>
	<td><a href="?sec=home" class="bodyDarkGray"><strong>Home</strong></a></td>
</tr>-->
<tr>
	<td>
		<?
		// Branch content based on "sec" value
		switch($sec){
			case "": include("home.php");break;
			case "home": include("home.php");break;
			case "xbenefits": include("xbenefits.php");break;
			case "visconnect": include("visconnect.php");break;
			case "mobileintentions": include("mobileintentions.php");break;
			case "ywr": include("ywr.php");break;
			case "deviceport": include("deviceport.php");break;
			case "wiresupport": include("wiresupport.php");break;
			case "cellularmgmt": include("cellularmgmt.php");break;
			case "goliathreports": include("goliathreports.php");break;
			case "inputorders": include("inputorders.php");break;
			default: include("home.php");break;
		} // End Switch
		?>
	</td>
</tr>
<tr>
	<td colspan="2"><hr width="860" size="1" color="#000000" noshade></td>
</tr>
<tr>
	<td colspan="2">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td valign="top"><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><a href="?sec=home" class="xbigDarkGray"><strong>Home</strong></a></td>
			<td align="right"><!--<a href="http://www.bullseyecreations.com" class="xbigDarkGray"><img src="images/BullseyeLogoSmall.jpg" title="The Bullseye Factory &brvbar; On-Target Business Imaging!" width="100" border="0"></a>--><a href="http://www.rmsglobal.net" class="xbigDarkGray"><img src="images/RMSLogo.gif" width="75" border="0"></a><img src="images/spacer.gif" alt="" width="15" height="1" border="0"><br><br></td>
		</tr>
		</table>
	
	
	
	</td>
</tr>
</table>

</body>
</html>
