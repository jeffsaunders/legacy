<?
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Cell Benefits Orders</title>

	<!-- refresh page every 5 minutes -->
<!--	<meta http-equiv="refresh" content="300">-->

	<!-- Load Style Sheet -->
	<link href="../standard.css" rel="stylesheet" type="text/css">

	<script>
	function markRow(rowID,bg){
		if (document.getElementById(rowID).style.fontWeight == "bold"){
			document.getElementById(rowID).style.fontWeight = "normal";
			document.getElementById(rowID).bgColor = bg;
			document.getElementById(rowID).attributes["title"].value = "Click to Mark, Double-Click to View";
// For some unknown reason this doesn't work in IE, so I resorted to calling a function (swapBack()) on every onMouseOut...it's slower but it works in IE too.
//			document.getElementById(rowID).attributes["onmouseout"].value = "this.bgColor='"+bg+"'";
		}else{
			document.getElementById(rowID).bgColor = "#ffa500";
			document.getElementById(rowID).style.fontWeight = "bold";
			document.getElementById(rowID).attributes["title"].value = "Click to Unmark, Double-Click to View";
// This works in all browsers, even IE, but I can't set it back for some reason (see above).
//			document.getElementById(rowID).attributes["onmouseout"].value = "";
		}
	}

	// Need this function for conditional branching - can't do that inline in IE
	function swapBack(rowID,bg){
		if (document.getElementById(rowID).style.fontWeight != "bold"){
			document.getElementById(rowID).bgColor = bg;
		}
	}

	function popRow(rowID){
		alert("Coming Soon!");
		return true;
	}

	function enableDates(ID){
		if (document.getElementById(ID).value == "custom"){
			query.start_date.disabled = false;
			query.end_date.disabled = false;
			query.start_date.value = '';
			query.end_date.value = '';
			query.start_date.focus();
		}else{
			query.start_date.value = 'N/A';
			query.end_date.value = 'N/A';
			query.start_date.disabled = true;
			query.end_date.disabled = true;
		}
	}
	</script>
</head>

<body>

<?
// PHP Functions
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}

// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}
?>

<?
// Connect to the database
include "../dbconnect.php";
?>

<!-- Assign passed variables -->
<?
// Interrogate and reassign passed variables
$sort = $_REQUEST['sort'];
if (!$_REQUEST['sort']) $sort = "order_num";
$range = $_REQUEST['range'];
if (!$_REQUEST['range']) $range = "this_month";

// Build Query Criteria String
$criteria = "WHERE 1";
if ($_REQUEST['orders'] && $_REQUEST['near_orders'] && $_REQUEST['abandoned']) $criteria .= ""; // All Checked
if ($_REQUEST['orders'] && $_REQUEST['near_orders'] && !$_REQUEST['abandoned']) $criteria .= " AND info_time != 0"; // Orders & Near Orders Checked
if ($_REQUEST['orders'] && !$_REQUEST['near_orders'] && !$_REQUEST['abandoned']) $criteria .= " AND accept_terms = 'Yes'"; // Only Orders Checked
if (!$_REQUEST['orders'] && $_REQUEST['near_orders'] && $_REQUEST['abandoned']) $criteria .= " AND accept_terms = 'No'";  // Near Orders & Abandoned Checked
if (!$_REQUEST['orders'] && $_REQUEST['near_orders'] && !$_REQUEST['abandoned']) $criteria .= " AND accept_terms = 'No' AND info_time != 0"; // Only Near Orders Checked
if (!$_REQUEST['orders'] && !$_REQUEST['near_orders'] && $_REQUEST['abandoned']) $criteria .= " AND accept_terms = 'No' AND info_time = 0"; // Only Abandoned Checked
if (!$_REQUEST['orders'] && !$_REQUEST['near_orders'] && !$_REQUEST['abandoned']) $criteria .= " AND session_id = ''"; // Nothing Checked - session_id NEVER empty
if ($range == "today") $criteria .= " AND DATE(phone1_time) = DATE(NOW())";
if ($range == "yesterday") $criteria .= " AND DATE(phone1_time) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY))";
if ($range == "this_month") $criteria .= " AND MONTH(phone1_time) = MONTH(NOW()) AND YEAR(phone1_time) = YEAR(NOW())";
if ($range == "last_month"){
	if (date("n") == 1){
		 $criteria .= " AND MONTH(phone1_time) = '12' AND YEAR(phone1_time) = YEAR(NOW())-1";
	}else{
		 $criteria .= " AND MONTH(phone1_time) = MONTH(NOW())-1 AND YEAR(phone1_time) = YEAR(NOW())";
	}
}
if ($range == "this_year") $criteria .= " AND YEAR(phone1_time) = YEAR(NOW())";
if ($range == "last_year") $criteria .= " AND YEAR(phone1_time) = YEAR(NOW())-1";
if ($range == "custom") $criteria .= " AND DATE(phone1_time) >= '".date('Y-m-d',strtotime($_REQUEST['start_date']))."' AND DATE(phone1_time) <= '".date('Y-m-d',strtotime($_REQUEST['end_date']))."'";

// Build & Execute Query
$query = "SELECT * FROM orders ".$criteria." ORDER BY ".$sort;
//echo $query;
$result = mysql_query($query, $linkID);
?>

<table width="950" border="0" cellspacing="0" cellpadding="0">
<tr>
	<!-- Header Label -->
	<td valign="bottom">
		<strong class="xbigBlack">CellBenefits.com Orders</strong><br>
		<strong class="bodyBlack">Sorted by <? echo iif($sort == "order_num","order received",$sort."&nbsp;&nbsp;<span class='tinyBlack'>( <a href='javascript:document.query.submit();' class='tinyBlack'>Reset Sort</a> )</span>"); ?></strong><br>
		<strong class="smallBlack"><? echo mysql_num_rows($result); ?> Records Displayed</strong>
	</td>
	<!-- Search Criteria Form -->
	<td valign="top" class="bodyBlack">
		<table border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<form action="" method="get" name="query" id="query">
		<tr>
			<td colspan="7">Date Range:&nbsp;
				<select name="range" id="range" size="1" onChange="return enableDates(this.id);">
					<option value="all" <? echo iif($range == "all","selected",""); ?>>All</option>
					<option value="today" <? echo iif($range == "today","selected",""); ?>>Today</option>
					<option value="yesterday" <? echo iif($range == "yesterday","selected",""); ?>>Yesterday</option>
					<option value="this_month" <? echo iif($range == "this_month","selected",""); ?>>This Month</option>
					<option value="last_month" <? echo iif($range == "last_month","selected",""); ?>>Last Month</option>
					<option value="this_year" <? echo iif($range == "this_year","selected",""); ?>>This Year</option>
					<option value="last_year" <? echo iif($range == "last_year","selected",""); ?>>Last Year</option>
					<option value="custom" <? echo iif($range == "custom","selected",""); ?>>Custom</option>
				</select>&nbsp;&nbsp;
				Start Date: <input type="text" name="start_date" id="start_date" value="<? echo iif($range == "custom",$_REQUEST['start_date'],"N/A"); ?>" size="7" maxlength="10" <? echo iif($range != "custom","disabled",""); ?>>
				&nbsp;&nbsp;
				End Date: <input type="text" name="end_date" id="end_date" value="<? echo iif($range == "custom",$_REQUEST['end_date'],"N/A"); ?>" size="7" maxlength="10" <? echo iif($range != "custom","disabled",""); ?>>
			</td>
		</tr>
		<tr>
			<td colspan="7"><img src="../images/spacer.gif" alt="" width="1" height="5" border="0"></td>
		</tr>
		<tr>
			<td bgcolor="#00FF00" title="Show Complete Orders"><input type="checkbox" name="orders" title="Show Complete Orders" value="yes" <? echo iif($_REQUEST['orders'],"checked",""); ?>>Complete Orders</td>
			<td>&nbsp;&nbsp;</td>
			<td bgcolor="#FFFF00" title="Show Complete But Unconfirmed Orders"><input type="checkbox" name="near_orders" title="Show Complete But Unconfirmed Orders" value="yes" <? echo iif($_REQUEST['near_orders'],"checked",""); ?>>Near Orders</td>
			<td>&nbsp;&nbsp;</td>
			<td bgcolor="#E0E0E0" title="Show Abandoned Orders"><input type="checkbox" name="abandoned" title="Show Abandoned Orders" value="yes" <? echo iif($_REQUEST['abandoned'],"checked",""); ?>>Abandoned Orders</td>
			<td>&nbsp;</td>
			<td bgcolor="#FF0000" title="Undelivered Orders"><!--<input type="checkbox" name="abandoned" title="Show Abandoned Orders" value="yes" <? echo iif($_REQUEST['abandoned'],"checked",""); ?>>-->&nbsp;Undelivered Orders&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right"><input type="submit" value="Re-Submit" title="Submit New Query" style="height:20px; width:75px; font-family:sans-serif; font-size:10px;"></td>
			<td>&nbsp;&nbsp;&nbsp;</td>
			<td><a href="/admin" class="smallBlack" title="Return To Main Menu"><strong>Menu</strong></a></td>
		</tr>
		<input type="hidden" name="sort" id="sort" value="">
		</form>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2"><img src="../images/spacer.gif" alt="" width="1" height="5" border="0"></td>
</tr>
</table>

<!-- Show the orders that match the search criteria -->
<table border="0" cellspacing="2" cellpadding="3" class="bodyBlack">
<?
$fields = mysql_num_fields($result);
echo '
</tr>';
$r = 0;
while ($row = mysql_fetch_assoc($result)){
	if ($r%25 == 0){  // Evenly divisible by 25 -- every 25 rows print header
		$i = 0; 
		echo '
<tr>';
		while ($i < $fields){ 
			echo '
	<th align="center" bgcolor="#000000"><a onClick="document.query.sort.value=\''.mysql_field_name($result, $i).'\';document.query.submit();" title="Click to Sort" style="cursor:pointer;" class="bodyWhite">'.mysql_field_name($result, $i).'</a></th>';
			$i++; 
		}
		echo '
</tr>';
	}
	if ($row["accept_terms"] == 'Yes' && $row["delivery_time"] != 0 ){ // Complete order - make background green
		$bg = "#00ff00";
	}elseif ($row["accept_terms"] == 'Yes' && $row["delivery_time"] == 0){ // Complete order but POST delivery failed - make background red
		$bg = "#ff0000";
	}elseif ($row["info_time"] != 0 && $row["accept_terms"] == 'No'){ // Near order - make background yellow
		$bg = "#ffff00";
	}else{
		$bg = iif(is_even($r),"#e0e0e0","#f8f8f8"); // Abandoned order - make background alternating shades of gray
	}
//	echo'
//<tr id="row'.$r.'" onMouseOver="this.bgColor=\'#ffa500\'" onMouseOut="this.bgColor=\''.$bg.'\'" bgcolor="'.$bg.'" onClick="markRow(this.id,\''.$bg.'\');" //onDblClick="popRow(this.id);">';
	echo'
<tr id="row'.$r.'" title="Click to Mark, Double-Click to View" onMouseOver="this.bgColor=\'#ffa500\'" onMouseOut="swapBack(this.id,\''.$bg.'\');" bgcolor="'.$bg.'" onClick="markRow(this.id,\''.$bg.'\');" onDblClick="popRow(this.id);">';
	$i = 0; 
	while ($i < $fields){
		echo '
	<td align="'.iif(mysql_field_type($result, $i)=="real","right","left").'" valign="top"><nobr>'.$row[mysql_field_name($result, $i)].'</nobr></td>';
		$i++; 
	} 
	echo'
</tr>';
	$r++;
}
mysql_free_result($result);
?>
</table>

</body>
</html>
