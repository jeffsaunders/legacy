<?php 

$folder = "/home/content/b/a/r/barnegattwp/html"; 

echo "This script runs several tests to see if the specified folder is readable. If there is a problem, then the error will be displayed. Otherwise, all files found in the test folder will be listed. <p>";

echo "Path to this script: " . __FILE__ . "<p>";

echo "Specified folder: " .$folder . "<br>";
echo "'Real' folder path: " . realpath($folder);

if (!file_exists($folder)) {
	echo "<p><font color='red'>The <b>".$folder."</b> folder does not exist.</font>"; 
	echo "<p>What you must do, is ask your web host to explain why the <b>".$folder."</b> folder is not able to be 'found' by the PHP software using the standard <a href='http://www.php.net/manual/en/function.file-exists.php'>file_exists()</a> function.<p>  The folder <b>must</b> exist, otherwise this script would not be able to run. (You can see that the <b>".$folder."</b> folder is actually included in the folder path to script that produced this error!";
	exit;
} 
if (!is_dir($folder)) { 
	echo "<p><font color='red'>The <b>".$folder."</b> path exists, but it is not being reported by PHP as a directory.</font>"; 
	echo "<p>What you must do is ask your web host to explain why the <b>".$folder."</b> folder seems to exist, but the PHP software is not able to see it as a folder/directory using the standard <a href='http://www.php.net/manual/en/function.is-dir.php'>is_dir()</a> function.";
	exit;
}
if(!is_readable($folder)) { 
	echo "<p><font color='red'>Unable to read the contents of the <b>".$folder."</b> folder.</font>";
	echo "<p>What you must do, is ask your web host to enable enough 'read' permissions for the <b>".$folder."</b> folder so that SnippetMaster can at least 'see' the files that are listed inside it. Otherwise, The softwrae is not able to display the folder listing of files that you can edit.";
	exit;
} 
if(!($handle = opendir($folder))) { 
	echo "<p><font color='red'>Unable to open the <b>".$folder."</b> folder for reading.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'read' permissions for the <b>".$folder."</b> folder so that SnippetMaster can at least 'see' the files that are listed inside it. Otherwise, the software is not able to display the folder listing of files that you can edit.";
	exit;
} 

echo "<p><font color='green'>Successfully opened and read this folder: <b>".$folder."</b> </font><p>Here is a listing of the files in the folder:</p>"; 


// Show a listing of all files for the test folder.
while (false !== ($file = readdir($handle))) {
	if ($file != "." && $file != "..") {
		echo $file . "\n<br>";
	}
}
closedir($handle);
 

?>