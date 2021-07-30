<?php

echo "<p>According to the operating system this file is located at: <b>" . __FILE__ . "</b>";

echo "<p>PHP realpath() function says this file is located at: <b>" . realpath($_SERVER["PATH_TRANSLATED"]) . "</b>";

echo "<p>PHP \$_SERVER['PATH_TRANSLATED'] value says this file is located at: <b>" . $_SERVER["PATH_TRANSLATED"] . "</b>";

echo "<p>The problem is that the PHP \$_SERVER['PATH_TRANSLATED'] variable is different, which is messing up the script since it doesn't match the file system path. Your hosting provider can fix this by configuring PHP to use the same file path as the operating system.  (So PHP realpath() function and \$_SERVER['PATH_TRANSLATED'] values are the same.)</p>";

?>