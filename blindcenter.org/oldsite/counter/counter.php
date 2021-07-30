<?php

// Image format if $style = "image"
$format = ".gif";
// open file storing counter value
$fh = fopen('c:\netscape\server\docs\blindcenter\counter.txt','r+');
// read the value
$val = fgets($fh, 10);
// convert it to integer
$num = (int) $val;
// tof
fseek($fh, 0);
// write old value + 1
fputs($fh, $num + 1);
//close the file
fclose($fh);

// Display the counter value
switch($type) { 
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
		echo("<img src=\"$dir/$digit$format\">");
		$x++;
	}
	break;
	// if $style = "quiet" don't say anything
	case "quiet":
	break;
	// else
	default: 
	echo("counter <b>error</b>: invalid style.");
	break;
}
?>