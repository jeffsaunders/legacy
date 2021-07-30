<?php 

// 
// This script tests a file to see if it can be read and written.

$filename = 'd:\\home\\localuser\\okemahalumni\\snippetmaster\\db.inc.php'; 

echo "Path to this script: " . __FILE__ . "<br>";

if (!file_exists($filename)) {
	echo "<p><font color='red'>The <b>".$filename."</b> file does not exist.</font>"; 
	echo "<p>What you must do, is ask your web host to explain why the <b>".$filename."</b> file is not able to be 'found' by the PHP software using the standard <a href='http://www.php.net/manual/en/function.file-exists.php'>file_exists()</a> function."; echo "<p>The file <b>must</b> exist, otherwise this script would not be able to run. (You can see that the <b>".$filename."</b> file is actually included in the file path to script that produced this error!";
	exit;
} 
if(!is_readable($filename)) { 
	echo "<p><font color='red'>Unable to read the contents of the <b>".$filename."</b> file.</font>";
	echo "<p>What you must do, is ask your web host to enable enough 'read' permissions for the <b>".$filename."</b> file so that SnippetMaster can 'see' it.";
	exit;
} 
if(!is_writable($filename)) { 
	echo "<p><font color='red'>Unable to write to the <b>".$filename."</b> file.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'write' permissions for the <b>".$filename."</b> file so that SnippetMaster can write information inside it.";
	exit;
} 

// Test actually writing of the file.
if (!@fopen($filename, "w")) {
	echo "<p><font color='red'>Unable to write data into the <b>".$filename."</b> file.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'write' permissions for the <b>".$filename."</b> file so that SnippetMaster can write information inside it. <p><b>NOTE:</b> Please be sure to tell your web host that the file <I>already</I> has write permissions. What is needed now is the actual ability to write content into the file.  The reason this test failed is because the actual step of writing information into the file was not successful. Your web host can look at the contents of this test PHP file to easily see what is actually failing.)";
	exit;
} 

echo "<p><font color='green'>Successful read and write for the <b>".$filename."</b> file.</font>"; 
 
?>