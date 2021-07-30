<?
$uri = var_export($_POST, true);
// Connect to the database
include "dbconnect.php";
//$query = "INSERT INTO test (session_id, uri) VALUES (\"".$_REQUEST['sid']."\", \"".$_SERVER['REQUEST_URI']."\")";
$query = "INSERT INTO test (session_id, uri) VALUES (\"".$_REQUEST['session_id']."\", \"".$uri."\")";
echo $query.'<br></br>';
$rs_insert = mysql_query($query, $linkID);
?>