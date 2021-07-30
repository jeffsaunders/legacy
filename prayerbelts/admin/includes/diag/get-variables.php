<?php

error_reporting(E_ALL ^ E_NOTICE);

// Run this test script like this:
//
//http://www.yourdomain.com/snippetmaster/includes/diag/get-variables.php?test=hello

if (!$_GET['test']) { 
    exit("<font color='red'>It looks like three is a problem with the <b>\$_GET</b> variables in your PHP configuration. <p>Usage:<p> <a href='".$_SERVER['PHP_SELF']."?test=hello'>".$_SERVER["HTTP_HOST"] . $_SERVER['PHP_SELF']."?test=hello</font>");
}


/*if ($_GET['test'] != "hello") { 
    exit("<font color='red'>It looks like three is a problem with the <b>\$_GET</b> variables in your PHP configuration. <p>Usage:<p> <a href='".$_SERVER['PHP_SELF']."?test=hello'>".$_SERVER["HTTP_HOST"] . $_SERVER['PHP_SELF']."?test=hello</font>");
}
*/
else {
	echo "<p>You should see the word 'hello' below.";
	echo "<hr><p>";
	echo $_GET['test'];
}

?>