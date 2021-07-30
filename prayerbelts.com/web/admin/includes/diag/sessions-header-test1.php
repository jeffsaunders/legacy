<?php

// Purpose of this test is to see if sessions are passed when using php header redirect.
session_start(); 

// Get path to this script being run.
$_SESSION['SCRIPT_PATH'] = $_SERVER["PHP_SELF"];

header("location: sessions-header-test2.php");
exit;

?>