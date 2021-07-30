<?php
require_once("odbcmanager.php");
//name of system DSN in ODBC

$odbc_name="employees_list";

  $odbc_conn=new OdbcManager();
  $odbc_conn->connect($odbc_name);
  //import all data to array
  $odbc_data=$odbc_conn->return_import_values();
 //name of columns
  $odbc_data_column=$odbc_conn->columntable();
  $odbc_conn->close();
  
  print_r($odbc_data);
  //now you have array for all data
  
?>
