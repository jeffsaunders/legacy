<?php

session_start(); 

if ( (isset($_SESSION['test2'])) && ($_SESSION['test2'] != "") ) {
	echo "<font color='green'>";
	echo $_SESSION['test2'];
	echo "</font>";
}
else {
	echo "<font color='red'>";
	echo "<b>Test #2 failed.</b>";
	echo "<p>It appears that your web server does not support PHP 'session passing' properly. You must ask your web host to enable PHP 'session passing' support.";
	echo "<p>This is probably a mistake by your web host, because PHP 'session passing' support is a very basic function of PHP.  You must ask your web host to fix this problem. <ol><li>Tell them that 'PHP session passing is not working on the server'.</li><li>Give them the URL you used to start test #1.</li></ol>Your web host can perform the tests themselves and view the source code from the two test files to see what is the problem.";
	echo "<p>Once your web host has fixed this problem, then the software should work for you.";
	echo "</font>";
}

exit;



?>