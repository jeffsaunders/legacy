<?
$dbServer = "localhost";
$dbUsername = "root";
$dbPassword = "1qazse4?";

/*if (!($emsLink = mysql_connect($dbServer, $dbUsername, $dbPassword))){
	die("<h3>Error - Could Not Connect to eWomen Events Database</h3>".mysql_error()."\n");
}
mysql_select_db("ems", $emsLink);

if (!($ewnLink = mysql_connect($dbServer, $dbUsername, $dbPassword, true))){
	die("<h3>Error - Could Not Connect to eWomen Members Database</h3>".mysql_error()."\n");
}
mysql_select_db("ewomen", $ewnLink);*/

if (!($confLink = mysql_connect($dbServer, $dbUsername, $dbPassword, true))){
	die("<h3>Error - Could Not Connect to eWomen Conference Database</h3>".mysql_error()."\n");
}
mysql_select_db("livehappy", $confLink);
?>
