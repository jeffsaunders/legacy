<?php

$db_host='localhost';
$db_name='footballforecast';
$db_user='tobler';
$db_pass='QC9BnGq5LHT9VZxM';

$link_admin_id='admin';
$link_admin_password='jerrysucks';

$ffc_admin_id='admin';
$ffc_admin_password='jerrysucks';

@mysql_connect($db_host,$db_user,$db_pass) or die("Can't connect to database. Please check the database setting");
@mysql_select_db($db_name) or die("Can't select database. Please check database name");
?>
