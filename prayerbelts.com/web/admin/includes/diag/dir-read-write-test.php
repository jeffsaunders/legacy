<?php 

//
// This will test the specified folder to see if it exists, is readable, is writable, and if we can actually create a writable file inside.
//

$folder = 'D:\hshome\phillipt\dddd.com\snippetmaster\snippet-db'; 

echo "Path to this script:   " . __FILE__ . "<p>";

if (realpath($folder) == "") {

	echo "<p><font color='red'>The 'real path' to the <b>".$folder."</b> folder is not working.</font>"; 
	echo "<p>What you must do, is ask your web host to explain why the <b>realpath('".$folder."')</b> PHP function is returning no value. (They can view the contents of this test file to see what is broken.)<p> The 'realpath()' PHP function is a standard PHP function to determine the actual full path to any specified folder. On your web server, it is not working properly. This is most likely because the PHP version you are using is very very old (over 3 years old). <p> Your web hosting provider should be able to fix this problem in about 10 seconds.";
	exit;
}


if (!file_exists($folder)) {
	echo "<p><font color='red'>The <b>".$folder."</b> folder does not exist.</font>"; 
	echo "<p>What you must do, is ask your web host to explain why the <b>".$folder."</b> folder is not able to be 'found' by the PHP software using the standard <a href='http://www.php.net/manual/en/function.file-exists.php'>file_exists()</a> function.  The folder <b>must</b> exist, otherwise this script would not be able to run. (You can see that the <b>".$folder."</b> folder is actually included in the folder path to script that produced this error!";
	exit;
} 
if (!is_dir($folder)) { 
	echo "<p><font color='red'>The <b>".$folder."</b> path exists, but it is not being reported by PHP as a directory.</font>"; 
	echo "<p>What you must do is ask your web host to explain why the <b>".$folder."</b> folder seems to exist, but the PHP software is not able to see it as a folder/directory using the standard <a href='http://www.php.net/manual/en/function.is-dir.php'>is_dir()</a> function.";
	exit;
}
if(!is_readable($folder)) { 
	echo "<p><font color='red'>I was unable to read the contents of the <b>".$folder."</b> folder.</font>";
	echo "<p>What you must do, is ask your web host to enable enough 'read' permissions for the <b>".$folder."</b> folder so that SnippetMaster can at least 'see' the files that are listed inside it. Otherwise, SnippetMaster is not able to display the folder listing of files that you can edit.";
	exit;
} 
if(!opendir($folder)) { 
	echo "<p><font color='red'>I was unable to open the <b>".$folder."</b> folder for reading.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'read' permissions for the <b>".$folder."</b> folder so that SnippetMaster can at least 'see' the files that are listed inside it. Otherwise, SnippetMaster is not able to display the folder listing of files that you can edit.";
	exit;
} 
if(!is_writable($folder)) { 
	echo "<p><font color='red'>I was unable to write to the <b>".$folder."</b> folder.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'write' permissions for the <b>".$folder."</b> folder so that SnippetMaster can write new files and folders inside it. Otherwise, SnippetMaster is not able to create the database folder and files that are necessary to operate.";
	exit;
} 

// Test actually writing of a file.
$filename = $folder . "/test.txt";
$fp = fopen($filename, "w");
if (!$fp) {
	echo "<p><font color='red'>I was unable to open the test file into 'write mode' that was created inside the <b>".$folder."</b> folder.</font>"; 
	echo "<p>What you must do, is ask your web host to enable enough 'write' permissions for the <b>".$folder."</b> folder so that SnippetMaster can write new files and folders inside it. Otherwise, SnippetMaster is not able to create the database files that are necessary to operate.<p><br>NOTE:</b> Please be sure to tell your web host that the folder already has write permissions. What is needed now is the actual ability to write new files into the folder.  The reason this test failed is because the actual step of creating a new file inside the folder in 'write mode' was not successful. Your web host can look at the contents of this test PHP file to easily see what is actually failing.)";
	exit;
} 
else {
	if (!fwrite($fp, "You can delete this file.")) {
		echo "<p><font color='red'>I was unable to write into the test file that was created inside the <b>".$folder."</b> folder.</font>"; 
		echo "<p>What you must do, is ask your web host to enable enough 'write' permissions for the <b>".$folder."</b> folder so that SnippetMaster can write content into files that are created inside it. Otherwise, SnippetMaster is not able to create the database files that are necessary to operate.<p><br>NOTE:</b> Please be sure to tell your web host that the folder already has write permissions and the test file was created. What is needed now is the actual ability to write something into the file that was created in the folder.  The reason this test failed is because the actual step of writing content into the test file that was created was not successful. Your web host can look at the contents of this test PHP file to easily see what is actually failing.)";
		unlink($filename);
		exit;
	}
	else { 
		fclose($fp);
		unlink($filename);
	}
}

echo "<p><font color='green'>Successfully read, open, and write for the <b>".$folder."</b> folder.</font>"; 
 
?>