<?php

// This diagnostic file tests the connection between the program and the licensing server.

// It uses a standard HTTP protocol connection over port 80 to "www.key-vault.com".

$fp = fsockopen("www.key-vault.com", 80, $errno, $errstr, 10);

if ($fp) {

	echo "<p><font color='green'>Connection to license servers was tested and is ok.</font></p>";

} 
else {

	echo "<p><font color='red'><b>There is a problem connecting to the license servers.  You need to give the URL to this test file to your web hosting provider and ask them to fix the problem.</b><br><br><B>Error Message:</B> ".$errstr." <BR><B>Error Code:</B> ".$errno."</font></p>";

}

?>