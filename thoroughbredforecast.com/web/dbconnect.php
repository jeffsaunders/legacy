<?
if (!($linkID = mysql_connect("localhost","tobler","QC9BnGq5LHT9VZxM")))
{
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
// returns $linkID
mysql_select_db("thoroughbredforecast", $linkID);
?>
