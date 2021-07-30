<?
	if (!($linkID = mysql_connect("localhost:/var/lib/mysql/mysql.sock","root","1qazse4?")))
	{
		print "<h3>Error - Could Not Connect to Database</h3>\n";
		exit;
	}
	mysql_select_db("vision_google", $linkID);
?>
