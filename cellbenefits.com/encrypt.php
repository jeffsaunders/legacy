<?php 

include "dbconnect.php";

//A made up keystring taken from http://webnet77.com/cgi-bin/helpers/passwords.pl 
$key_string = '6afgCems46e6NC8JmVzFoN9eda471T'; 
$my_secret_number = '1234123412341235'; 

echo 'My secret number to be converted is <b>'.$my_secret_number.'</b><br /><br />'; 

//mysql_connect($db_host, $db_user, $db_pass); 
//mysql_select_db($db_name) or die(mysql_error()); 

//$my_secret_number is a pretend secret number 


//ENCRYPT 
//$query = "INSERT INTO test (code) VALUES(AES_ENCRYPT('".$my_secret_number."','".$key_string."'))"; 

//echo '<b>Select statement is:</b>'.$query.'<br />'; 
//$result = mysql_query($query) or die(mysql_error()); 

//while($row = mysql_fetch_array($result)){ 
//$encrypted_string = $row[0]; 
//echo '<b>Secret number encrypted:</b>'.$row[0].'<br /><br />'; 
//} 


//DECRYPT 
$query2 = "SELECT AES_DECRYPT(code,'".$key_string."') as output WHERE unique_id = 1"; 

echo '<b>Select statement is:</b>'.$query2.'<br />'; 
$result2 = mysql_query($query2) or die(mysql_error()); 

while($row2 = mysql_fetch_array($result2)){ 
echo '<b>Secret number (oce decrypted:</b>'.$row2[0].'<br />'; 
} 

?>
