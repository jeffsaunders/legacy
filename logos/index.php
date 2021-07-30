<?
// SHOW ME THE EERRRROORRSS.....
error_reporting( E_ALL & ~E_DEPRECATED);
ini_set('display_errors', true);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Logos</title>
</head>

<body>

<?
// PHP Functions
// Break apart a path to a filename into array elements
function myglob ($pattern) {
	$path_parts = pathinfo ($pattern);
	$pattern = '^' . str_replace (array ('*',  '?'), array ('(.+)', '(.)'), $path_parts['basename'] . '$');
	$dir = opendir ($path_parts['dirname']);
	while ($file = readdir ($dir)) {
		if (ereg ($pattern, $file)) $result[] = "{$path_parts['dirname']}/$file";
	}
	closedir ($dir);
	if (isset($result))return $result;
	return (array) null;
}

// Sort by filename
//function SortByFilename($a, $b) {
//	return strnatcasecmp($a[0], $b[0]);
//}

// Build array of all the filenames with GIF, JPG, and PNG extension
$files = array();
// Remove (pop off) the annoying empty element that creates
$pop = array_pop($files);
// Break up the full path to each filename and push the values onto the stack
$extention = array('gif','jpg','png');
foreach($extention as $filetype) {
	foreach(myglob("./*.".$filetype) as $filename) {
		// Get filename
		$path = explode('/',$filename);
		// Push it on the array
		array_push($files, $path[count($path)-1]);
	}
}
// Sort the results
//usort($files, "SortByFilename");
sort($files);
//print_r($files);

//count them and divide by 3

$logocount = count($files);
$logoincrement = ceil($logocount/3);
//echo ($logocount)."<br>";
//echo ($logocount/3)."<br>";
//echo (ceil($logocount/3))."<br>";

//loop through and display them in 3 columns

?>


<?
//foreach($files as $filename){
//for ($counter=0; $counter < $logoincrement; $counter++){
for ($counter=0; $counter < $logocount; $counter++){
?>
<img src="/images/spacer.gif" alt="" width="1" height="20" border="0"><br>
<img src="/images/spacer.gif" alt="" width="1" height="20" border="0"><img border="0" src="<?=$files[$counter];?>"><!--<img src="/images/spacer.gif" alt="" width="1" height="20" border="0"><img border="0" src="<?=$files[$counter+$logoincrement];?>"><img src="/images/spacer.gif" alt="" width="1" height="20" border="0"><img border="0" src="<?=$files[$counter+($logoincrement*2)];?>">--><br>
<?
}
?>


</body>
</html>
