<?php

session_start(); 

if ( (isset($_SESSION['SCRIPT_PATH'])) && ($_SESSION['SCRIPT_PATH'] != "") ) {
	echo "<font color='green'>";
	echo "<b>Test Results:</b> " . $_SESSION['SCRIPT_PATH'];
	echo "</font>";

	echo "<hr>";
	echo "<p>You should see a file path displayed above the line.";
}
else {
	echo "<font color='red'>";
	echo "<b>Test failed.</b>";
	echo "<p>It appears that your web server does not support PHP 'session passing' properly when using a php header redirect. You must ask your web host to enable PHP 'session passing' support so that session info is passed when using a standard header redirect like this:";
	echo "<p><b>header('location: file.php');</b>";
	echo "<p>This configuration problem is probably a mistake by your web host, because PHP 'session passing' support is a very basic function of PHP.  You must ask your web host to fix this problem. <ol><li>Tell them that 'PHP session passing is not working on the server properly'.</li><li>Give them the URL you used to start this test.</li></ol>Your web host can perform the tests themselves and view the source code from the two test files to see what is the problem.";
	echo "<p>Once your web host has fixed this problem, then the program should work for you.";
	echo "<p><b>Note:</b> If you want to re-run this test, you must close this browser window and open a new one for the test. Otherwise, the test will not be accurate.";
	echo "</font>";
}

exit;



?>