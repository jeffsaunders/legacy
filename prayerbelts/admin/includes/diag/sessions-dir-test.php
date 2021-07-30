<?php

$path = ini_get('session.save_path');

if (!is_dir($path)) {
    exit("<font color='red'>The Session Directory specified in your PHP configuration (session.save_path) does not exist: <p><b>".$path."</b><p>You should show your web host or server administrator this test page and ask them to fix the problem.  (It should take them only a few minutes to fix this problem.)</font>");
}
if (!is_readable($path)) {
    exit("<font color='red'>There is insufficient read permissions for the Session Directory specified in your PHP configuration (session.save_path):<p> <b>".$path."</b><p>You should show your web host or server administrator this test page and ask them to fix the problem. (It should take them only a few minutes to fix this problem.)</font>");
}
if (!is_writable($path)) {
    exit("<font color='red'>There is insufficient write permissions for the Session Directory specified in your PHP configuration (session.save_path):<p> <b>".$path."</b><p>You should show your web host or server administrator this test page and ask them to fix the problem. (It should take them only a few minutes to fix this problem.)</font>");
}
else {
	echo "<p>You should see a listing of files in the Session Directory (<b>".$path."</b>) below.<p>If you do not see any files listed, or if the files listed are not PHP session files, then there is a problem.";
	echo "<hr><p>";
	$dh = opendir($path);
	while ($file = readdir($dh)) {
		echo $file . "<br>";
		}
}

?>