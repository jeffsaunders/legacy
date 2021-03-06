<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// Start me up
session_start();

// Reassign passed variables
$page = $_REQUEST['page'];

// Check for log out
if ($page == "logout"){
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_destroy();
}

// Grab the database
require_once ('../includes/connect.php');

// Get current conference info
//$query = "
//	SELECT *, UNIX_TIMESTAMP(start_date) AS start_date_ts, UNIX_TIMESTAMP(end_date) AS end_date_ts
//	FROM conferences
//	WHERE active = 1
//	ORDER BY start_date DESC
//	LIMIT 1
//";
//echo $query."<br>";
//$rs_conference = mysql_query($query, $confLink);
//$conference = mysql_fetch_assoc($rs_conference);

?>
<!DOCTYPE HTML><!-- HTML5 -->

<html>
<head>
	<title>Smart Women Buy Homes Website Administration</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Set a LITTLE style -->
	<style>
		body {background-color:#F9F9F9; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;}
		form select{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form textarea{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form input[type=text]{background-color:#FDFDFD; border:thin #C0C0C0 solid;}
		form input[type=checkbox]{background-color:#FDFDFD; border:thin #C0C0C0 solid;}

		.pageContainer {width:700px;}

		.menuContainer {position:fixed; top:0px; left:0px; width:100%; text-align:left; background-color:#F9F9F9; white-space:nowrap; overflow:hidden; z-index:100;}
		.menuContainer a{color:#000000;	font-size:12px;	text-decoration:none; text-transform:uppercase;	font-weight:normal;	margin-right:20px;}
		.menuContainer a:hover{color:#FF0000; text-decoration:underline;}

		.bodyContainer {position:relative; top:80px;}
	</style>
	<!-- Common scripts -->
<!--	<script src="js/functions.js" type="text/javascript"></script>-->
</head>

<body>

<div class="pageContainer" id="pageContainer">
	<div class="menuContainer" id="menuContainer">
		<h1>&nbsp;&nbsp;Smart Women Buy Homes Website Administration</h1>
		<span style=" margin:0px 0px 0px 10px;"></span>
		<?php
		// Make sure they are logged in
		if (isset($_SESSION['USERNAME'])){
		?>
		<a href="?page=config" title="Site Configuration Settings" disabled>Site Configuration</a>
		<a href="?page=promo" title="Promo Code Management">Promotional Codes</a>
		<a href="?page=reports" title="Reports">Reports</a>
		<a href="?page=logout" title="Log Out">Log Out</a>
		<?php
		}else{
		?>
		<a href="?page=login" title="Log In">Log In</a>
		<?php
		}
		?>
		<hr width="100%" size="2" noshade>
	</div>
	<div class="bodyContainer" id="bodyContainer">
		<!-- Main Body Include -->
		<?php
		// Make sure they are logged in
		if (isset($_SESSION['USERNAME'])){
			// Branch Content Based On Passed "page" Value
			switch($page){
				case "config": include("./include/config.php"); break;
				case "promo": include("./include/promo.php"); break;
				case "reports": include("./include/reports.php"); break;
				case "logout": include("./include/config.php"); break;
				default: include("./include/config.php"); break;
			} // End Switch
		}else{
			include("./include/login.php");
		}
		?>
	</div>
</div>

</body>
</html>
