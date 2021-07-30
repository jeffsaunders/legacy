Here is a PHP script that simply demonstrates encryption and decryption...just point to any database, no tables needed. 
I previously had problems trying to do this sort of thing on the command line as I guess some of the characters that were produced after encryption could not be displayed properly so when I copied and pasted I wasn't copying the correct thing. Therefore this script puts everything in variables making it reliable and actually works :) 

<?php 

$db_host = 'localhost or yourip'; 
$db_name = 'yourdatabasename'; 
$db_user = 'yourusername'; 
$db_pass = 'yourpassword'; 


//A made up keystring taken from http://webnet77.com/cgi-bin/helpers/passwords.pl 
$key_string = '6afgCems46e6NC8JmVzFoN9eda471T'; 
$my_secret_number = '1234123412341235'; 

echo 'My secret number to be converted is <b>'.$my_secret_number.'</b><br /><br />'; 

mysql_connect($db_host, $db_user, $db_pass); 
mysql_select_db($db_name) or die(mysql_error()); 

//$my_secret_number is a pretend secret number 


//ENCRYPT 
$query = "SELECT AES_ENCRYPT('$my_secret_number','$key_string')"; 
$result = mysql_query($query) or die(mysql_error()); 

echo '<b>Select statement is:</b>'.$query.'<br />'; 

while($row = mysql_fetch_array($result)){ 
$encrypted_string = $row[0]; 
echo '<b>Secret number encrypted:</b>'.$row[0].'<br /><br />'; 
} 


//DECRYPT 
$query2 = "SELECT AES_DECRYPT('$encrypted_string','$key_string')"; 
$result2 = mysql_query($query2) or die(mysql_error()); 

echo '<b>Select statement is:</b>'.$query2.'<br />'; 

while($row2 = mysql_fetch_array($result2)){ 
echo '<b>Secret number (oce decrypted:</b>'.$row2[0].'<br />'; 
} 

?>
