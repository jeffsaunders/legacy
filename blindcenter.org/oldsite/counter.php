<?php

/* Simple Counter Script

This script reads a value from a text file and returns either the value as text or a series of graphics, one each representing each digit of the counter's value.  Then it increments the value and updates it in the file.

To call it simply include the following code (modified to fit your configuration) in the appropiate place within your html (remember to name it with a ".php" extention):

<?php $style = "image"; $dir = "images"; include("counter.php"); ?>

Legal "style" values are:	"text" to put print the value in text
							"image", for graphic images of digits
							"quiet" to not print anything at all - used to just maintain the
							 value in the file, but not displaying it on the page.
							 
"dir" is the directory containing the graphic images of the digits, relative to the URL.  The include function calls this file.

*/

// open/create file storing counter value - must be fully qualified
// *nix might look like "/var/httpd/html/counter.txt" for example
if(file_exists('/var/www/html/blindcenter/counter.txt')) {
	$fh = fopen('/var/www/html/blindcenter/counter.txt','r+');
}
else {
	$fh = fopen('/var/www/html/blindcenter/counter.txt','w+');
	chmod('/var/www/html/blindcenter/counter.txt', 0777);
}
// read the value - reads up to 10 digits, as if it could ever get THAT big. :-)
$val = fgets($fh, 10);
// convert it to integer
$num = (int) $val + 1;
// go to tof
fseek($fh, 0);
// write old value + 1
fputs($fh, $num);
//close the file
fclose($fh);

// Display the counter value
switch($style) { 
	// if $style = "text"
	case "text":
	echo $num; 
	break;
	// if $style = "image"
	case "image":
	$x = 0;
	$ctr = strlen($num);
	while($x < $ctr) {
		$digit = substr($num, $x, 1); 
		// change ".gif" to ".jpg" or ".png" accordingly
		echo("<img src='$dir/$digit.gif'>");
		$x++;
	}
	break;
	// if $style = "quiet" don't say anything
	case "quiet":
	break;
	// else
	default: 
	echo("counter error: invalid style!");
	break;
}
?>
