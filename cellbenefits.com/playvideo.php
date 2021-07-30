<?
// Connect to the database & lookup the phone
include "dbconnect.php";
$query = "SELECT * FROM phones WHERE product_id = ".$_REQUEST['Phone_ID'];
$result = mysql_query($query, $linkID);
$row = mysql_fetch_assoc($result);

// Sprint-Nextel sites
if ($row["carrier"] == "Sprint" || $row["carrier"] == "Nextel" ){
	$header_class = "smallBlack";
	$bar_color = "#FFE100";
	$border_color = "#BEBEBE";

// Cingular/AT&T sites
}elseif ($row["carrier"] == "AT&T" ){
	$header_class = "bigWhite";
	$bar_color = "#0780C0";
	$border_color = "#0780C0";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><? echo $row["carrier"]; ?> Video - <? echo $row["manufacturer"]; ?> <? echo $row["model"]; ?></title>
	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">
</head>

<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<!-- Header -->
	<td width="100%" height="35" valign="top" bgcolor="<? echo $bar_color; ?>">
		<table width="100%" border="0" cellspacing="0" cellpadding="5" class="<? echo $header_class; ?>">
		<tr>
			<td valign="top"><strong><? echo $row["label"]; ?></strong></td>
			<td align="right" valign="top"><img src="images/<? echo $row["carrier"]; ?>LogoXSmall.gif" alt="" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<br>
			<? echo $row["video"]; ?>
		<br><br>
	</td>
</tr>
</tr>
	<td width="100%" height="5" bgcolor="<? echo $bar_color; ?>"></td>
</tr>
</table>

</body>
</html>
