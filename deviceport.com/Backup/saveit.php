<?
<?
if (!$_REQUEST['sid']){
	session_start();
	// Test for session id; if none or mismatch they deep-linked, force them to start from scratch
	if (!$_SESSION['SID']){ echo'<script>window.location="/?sec=home";</script>'; exit;}
	// Good, there is a cookie - assign it's value to a variable for easy work
	$SID = $_SESSION['SID'];
}else{
	$SID = $_REQUEST['sid'];
};

// Grab the URI so we know which domain we are using
$uri = explode("/",$_SERVER['REQUEST_URI']);

// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
$anchor = $_REQUEST['anchor'];
$message = $_REQUEST['message'];
$cargo = $_REQUEST['cargo'];
$task = $_REQUEST['task'];

// Connect to the database
include "dbconnect.php";

//Grab existing cart info, if it exists
$query = "SELECT * FROM orders WHERE session_id='".$SID."'";
$rs_cart = mysql_query($query, $linkID);

// Now, what to do...what to do?
switch($_REQUEST['task']){

case "addphone":	// Put a phone in the cart








}; // End Switch
?>
