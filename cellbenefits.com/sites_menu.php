<?
header("Cache-control: private");  // IE 6 Fix.
?>
<?
// Connect to the database
include "dbconnect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>xBenefits Sites</title>

	<!-- Favorite Icon -->
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon"> 

	<!-- Load Style Sheet -->
	<link href="standard.css" rel="stylesheet" type="text/css">

</head>

<body>

<div align="center" class="xbigBlack"><strong>Active xBenefits Sites</strong><br><br></div>
<!--
<thead>
	<tr>
		<td colspan="4" align="center" class="xbigBlack"><strong>Active xBenefits Sites</strong></td>
	</tr>
</thead>
-->
<table border="0" cellspacing="0" cellpadding="5" align="center" class="borderBlack">
<tr bgcolor="#000000">
	<td align="center" class="bigWhite"><strong>Partner</strong></td>
	<td align="center" class="bigWhite"><strong>Carrier</strong></td>
	<td align="center" class="bigWhite"><strong>Client</strong></td>
	<td align="center" class="bigWhite"><strong>Site</strong></td>
</tr>
	<?
	$partner = "";
	$branding = "";
	$query = "SELECT * FROM sites WHERE active = 'T' ORDER BY partner, branding DESC, domain, site";
	$rs_sites = mysql_query($query, $linkID);
	for ($counter=1; $counter <= mysql_num_rows($rs_sites); $counter++){
		$row = mysql_fetch_assoc($rs_sites);
		if ($row["branding"] == "att"){
			$carrier = "AT&T";
			$bg = "#0780C0";
			$class = "bodyWhite";
		}
		if ($row["branding"] == "sprint"){
			$carrier = "Sprint-Nextel";
			$bg = "#FFE100";
			$class = "bodyBlack";
		}
		if ($row["branding"] == "verizon"){
			$carrier = "Verizon";
			$bg = "#B90000";
			$class = "bodyBlack";
		}
		if ($partner != "" && $row["partner"] != $partner){
			echo'
<tr>
	<td colspan="4" bgcolor="#000000"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
</tr>			
			';
		}
		echo'
<tr bgcolor="'.$bg.'" class="'.$class.'">
		';
		if ($row["partner"] != $partner){
			echo'
	<td><strong>'.$row["partner"].'</strong></td>
			';
		}else{
			echo'
	<td>&nbsp;</td>
			';
		}
		if ($row["branding"] != $branding || $row["partner"] != $partner){
			echo'
	<td><strong>'.$carrier.'</strong></td>
			';
		}else{
			echo'
	<td>&nbsp;</td>
			';
		}
		$partner = $row["partner"];
		$branding = $row["branding"];
		echo'
	<td><strong>'.$row["label"].'</strong></td>
	<td><a href="http://'.$row["site"].'.'.$row["domain"].'" class="'.$class.'"><strong>'.$row["site"].'.'.$row["domain"].'</strong></a></td>
</tr>
		';
	?>
	<?
	}
	?>

</table>
	
</body>
</html>
