<?
if (!($linkID = mysql_connect("localhost","marmiroc_danyial","danyial")))
{
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
// returns $linkID
mysql_select_db("marmiroc_website", $linkID);
?>
