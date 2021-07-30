<?
if (!($linkID = mysql_connect("localhost","root","1qazse4?")))
{
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
// returns $linkID
mysql_select_db("WMUHomes", $linkID);
?>
