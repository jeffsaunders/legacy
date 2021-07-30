<?
// Old Database
if (!($linkID = mysql_connect("localhost","littlechurchlv","*CF9996"))){
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
mysql_select_db("littlechurch", $linkID) or die(mysql_error());

// New Database
if (!($linkID2 = mysql_connect("localhost","littlechurchlv","*CF9996", true))){ //"true" indicates new link to same resource
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}
mysql_select_db("littlechurch_new", $linkID2) or die(mysql_error());
?>
