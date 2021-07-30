<?php
$username = "bmccarthy";
$password = "..aqq12W";
$hostname = "205.178.146.107"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL Server");
  
//select a database to work with
$selected = mysql_select_db("swbh",$dbhandle) 
  or die('Can\'t use swbh : ' . mysql_error());

?>
