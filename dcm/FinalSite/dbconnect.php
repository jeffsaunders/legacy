<?
if (!($linkID = mysql_connect("localhost","dcmclean_zencart","env0101")))
{
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
// returns $linkID
mysql_select_db("dcmclean_zc1", $linkID);
?>
