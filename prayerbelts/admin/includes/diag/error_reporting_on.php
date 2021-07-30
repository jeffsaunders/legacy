<?php

session_start(); 
ob_start();

// Use "E_ALL" during development...
error_reporting(E_ALL ^ E_NOTICE);

//error_reporting(0);	// Supress ALL errors
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

if (!ini_get('safe_mode')) {
	set_time_limit(60); 
}



if ($_SERVER) { extract( $_SERVER, EXTR_SKIP); }
if ($_SESSION) { extract( $_SESSION, EXTR_SKIP); }
if ($_COOKIE) { extract( $_COOKIE, EXTR_SKIP); }
if ($_REQUEST) { extract( $_REQUEST, EXTR_SKIP); }
if ($_POST) { extract( $_POST, EXTR_SKIP); }
if ($_GET) { extract( $_GET, EXTR_SKIP); }
//if ($_REQUEST) { unset($_REQUEST); }
//print_r($_COOKIE);
//echo "<br><br>";
//print_r($_REQUEST);
//print_r($_GET);
//print_r($_POST);

//--- to remove?
// Not used anywhere? 
// Maybe replace our "getScriptURL" function with it?
$rootURL = "";
if ($_SERVER['HTTPS'] == "on") {
	$rootURL .= "https://";
} else {
	$rootURL .= "http://";
}
$rootURL .= $_SERVER['SERVER_NAME'];
if ($_SERVER['SERVER_PORT'] != "80") {
	$rootURL .= ":" . $_SERVER['SERVER_PORT'];
}
$rootURL .= substr($_SERVER['SCRIPT_NAME'], 0, strpos($_SERVER['SCRIPT_NAME'], "/index.php"));
//---



require_once("../../includes/globals.inc.php");
//require_once("../../includes/vars.inc.php");
//require("../../includes/config.inc.php");

//require_once("../../includes/shared.lib.php");


echo "Error reporting is on.  No problems.";


?>