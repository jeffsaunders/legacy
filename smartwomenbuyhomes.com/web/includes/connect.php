<?php
$username = "root";
$password = "1qazse4?";
$hostname = "127.0.0.1";

// moved to Rackspace Cloud Hosting 2/25/2014
//$username = "swbh_webhost";
//$password = "C8FpUZ8NgbGT8dFv2gaY";
//$hostname = "f4fbaf0b6851ff7b04775fe75724bb866c069aed.rackspaceclouddb.com";

/*
$username = "swbh";
$password = "6f3f749c5bb4c0cf";
$hostname = "192.168.15.100"; 
*/

//$username = "eWNWebSites";
//$password = "zNyU59LFry5E9ajf";
//$hostname = "192.168.15.100"; 

//connection to the database
$dbhandle = mysql_connect($hostname, $username, $password) 
  or die("Unable to connect to MySQL Server");
  
//select a database to work with
$selected = mysql_select_db("swbh",$dbhandle) 
  or die('Can\'t use swbh : ' . mysql_error());

?>
