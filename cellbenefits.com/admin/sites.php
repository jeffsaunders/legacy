<?
header("Cache-control: private");  // IE 6 Fix.
?>
<?
// Connect to the database
include "../dbconnect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>xBenefits Sites</title>

	<!-- Favorite Icon -->
	<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"> 

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

</head>

<body>

<div align="center" class="xbigBlack"><strong>Active xBenefits Sites</strong><br><a href="http://www.cellbenefits.com/admin" class="smallBlack" style="text-decoration: underline;"><strong>Return to Menu</strong></a><br><br></div>
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
	<td align="center" class="bigWhite"><strong>NVP</strong></td>
	<td align="center" class="bigWhite"><strong>Gift Card</strong></td>
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
			$nvp = $row["cingular_discount"];
		}
		if ($row["branding"] == "sprint"){
			$carrier = "Sprint-Nextel";
			$bg = "#FFE100";
			$class = "bodyBlack";
			$nvp = $row["sprint_discount"];
		}
		if ($row["branding"] == "verizon"){
			$carrier = "Verizon";
			$bg = "#B90000";
			$class = "bodyWhite";
			$nvp = $row["verizon_discount"];
		}
		if ($partner != "" && $row["partner"] != $partner){
			echo'
<tr>
	<td colspan="6" bgcolor="#000000"><img src="../images/spacer.gif" alt="" width="1" height="1" border="0"></td>
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
	<td><a href="http://'.$row["site"].'.'.$row["domain"].'" target="_blank" class="'.$class.'"><strong>'.$row["site"].'.'.$row["domain"].'</strong></a></td>
	<td align="right"><strong>'.$nvp.'%</strong></td>
	<td align="right"><strong>$'.$row["gift_card"].'</strong></td>
</tr>
		';
	?>
	<?
	}
	?>

</table>
	
</body>
</html>
