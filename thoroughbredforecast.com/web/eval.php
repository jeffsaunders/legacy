<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<!-- Grab the database -->
<?php
	include("dbconnect.php");
	$query = "SELECT * FROM test";
	$rs_test = mysql_query($query, $linkID);
	$code = mysql_fetch_assoc($rs_test);
?>
<?php echo eval("?>".$code['code']."<?php ") ?>


</body>
</html>
