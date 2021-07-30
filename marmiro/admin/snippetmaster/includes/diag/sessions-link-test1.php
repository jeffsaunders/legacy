<?php

session_start(); 
error_reporting(E_ALL ^ E_NOTICE);

//
// TEST #1 - Test basic $_SESSION is working.
//
$_SESSION['test1'] = "<b>Test #1:</b> The PHP 'session_start()' function is working.";

if ( (isset($_SESSION['test1'])) && ($_SESSION['test1'] != "") ) {
	echo "<font color='green'>";
	echo $_SESSION['test1'];
	echo "</font>";

	echo "<p>Please click the link below to start test #2.";

	//
	// TEST #2 - Test if $_SESSION superglobal variable can be passed by URL.
	//
	$_SESSION['test2'] = "<b>Test #2:</b> PHP Session was passed successfully.";

	echo "<p><a href='sessions-link-test2.php'>Start php sessions link test #2</a>";
}

else {
	echo "<font color='red'>";
	echo "<b>Test #1 failed.</b><br>";
	echo "<p>It appears that your web server does not support the PHP 'session_start()' function properly. You must ask your web host to enable PHP 'sessions' support.";
	echo "<p>This is probably a mistake by your web host, because PHP 'sessions' support is a very very basic function of PHP.  I recommend contacting your web host and: <ol><li>Tell them that 'PHP Sessions is not working on the server'.</li><li>Give them the URL you used to start test #1.</li></ol>Your web host can perform the tests themselves and view the source code from the two test files to see what is the problem.";
	echo "<p>Once your web host has fixed this problem, then the software should work for you.";
	echo "</font>";
}

exit;

?>