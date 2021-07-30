<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Little Church of the West Webcam Management Console</title>

	<!-- refresh page every 5 minutes -->
	<meta http-equiv="refresh" content="300">

	<!-- Confirm Delete -->
	<script>
	function verify_delete(filename, sort){
		var do_it = confirm("Delete "+filename+"\n\nThis action is PERMANENT and there is NO undelete.\n\t      Are You Sure?");
		if (do_it == true){
			window.location="deletefile.php?filename="+filename+"&sort="+sort;
		}
	}
	</script>

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
function SortByFilename($a, $b) {
	return strnatcasecmp($a[0], $b[0]);
}

// Sort by date (convert date+time to timestamp then sort)
function SortByDate($a, $b) {
//	return strnatcasecmp($a[1], $b[1]);
	return strnatcasecmp(strtotime($a[1]." ".$a[2]), strtotime($b[1]." ".$b[2]));
}

// Sort by time (convert time to timestamp then sort)
function SortByTime($a, $b) {
//	return strnatcasecmp($a[2], $b[2]);
	return strnatcasecmp(strtotime($a[2]), strtotime($b[2]));
}

// Sort by groom
function SortByGroom($a, $b) {
	return strnatcasecmp($a[3], $b[3]);
}

// Sort by bride
function SortByBride($a, $b) {
	return strnatcasecmp($a[4], $b[4]);
}

// Sort by filesize
function SortBySize($a, $b) {
	return strnatcasecmp($a[5], $b[5]);
}

// Assign passed value(s)
$sort = $_REQUEST['sort'];
// Build array of wedding file information
$files = array();
// Remove (pop off) the annoying empty element that creates
$pop = array_pop($files);
// Break up the full path to each filename and push the values onto the stack
foreach(myglob("/var/www/helix/Content/Archive/littlechurch/*.rm") as $filename) {
	// Get filename
	$path = explode('/',$filename); // [7] => groom-bride@timestamp.rm
	// Remove the ".rm"
	$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
	// Split the name into names & timestamp
	$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
	// Split the names
	$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride

	$size = filesize($filename);
	// Push it all on the array to display
	array_push($files,array($path[7],date("m/d/y",$timestamp[1]),date("h:i a",$timestamp[1]),$couple[0],$couple[1],$size,date("H:i",$timestamp[1])));
}
// Sort the results
if ($sort == "date"){
	usort($files, "SortByDate");
	$sortby = "Date";
}elseif ($sort == "time"){
	usort($files, "SortByTime");
	$sortby = "Time";
}elseif ($sort == "groom"){
	usort($files, "SortByGroom");
	$sortby = "Groom";
}elseif ($sort == "bride"){
	usort($files, "SortByBride");
	$sortby = "Bride";
}elseif ($sort == "size"){
	usort($files, "SortBySize");
	$sortby = "Filesize";
}else{  //!$sort too
	usort($files, "SortByFilename");
	$sortby = "Filename";
}
// Build page
echo'
<font face="sans-serif">
<table width="900" border="0" cellspacing="2" cellpadding="0" align="center" bgcolor="#808080">
<tr>
	<td>
		<table width="900" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#808080">
		<tr>
			<td colspan="7" align="center"><strong><font size="+2">Little Church of the West Webcam File Management Console</font><br><font size="+1">- Available Weddings File List -<br></font><font size="2">(Sorted by '.$sortby.')</font></strong><br><hr width="100%" size="1" color="#000000" noshade></td>
		</tr>
		<tr>
			<th><a href="?sort=date">Date</a></th>
			<th><a href="?sort=time">Time</a></th>
			<th><a href="?sort=groom">Groom</th>
			<th><a href="?sort=bride">Bride</th>
			<th><a href="?sort=file">Filename</th>
			<th><a href="?sort=size">Filesize</th>
			<th>Action</th>
		</tr>
';
// Jump to the top of the array
reset($files);
// Step through it
foreach ($files as $val) {
	echo '
		<tr bgcolor="#C0C0C0">
			<td align="center">'.$val[1].'</td>
			<td align="center">'.$val[2].'</td>
			<td>'.$val[3].'</td>
			<td>'.$val[4].'</td>
			<td align="right">'.$val[0].'</td>
			<td align="right">'.number_format($val[5]).'</td>
			<td align="center">
				&nbsp;
				<a href="editfile.php?date='.$val[1].'&time='.$val[6].'&groom='.$val[3].'&bride='.$val[4].'&filename='.$val[0].'&sort='.$sort.'">Edit</a>
				&nbsp;&nbsp;&nbsp;
				<a href="#" onClick=verify_delete("'.$val[0].'","'.$sort.'");>Delete</a>
				&nbsp;&nbsp;&nbsp;
				<a href="http://helix.littlechurchlv.com/ramgen/encoder/littlechurch/'.$val[0].'">Watch</a>
				&nbsp;
			</td>
		</tr>
	';
}
echo '
		</table>
	</td>
</tr>
</table>
';
?>

<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="60" valign="top"><strong>*Note</strong> - </td>
<!--	<td>&nbsp;&nbsp;</td>-->
	<td>Wedding files are archived on the first day of each month.  All weddings older than 30 days on that day are archived.  From that point, the oldest one will be between 31 and 60 days old until the first of the next month, after which those between 31 and 60 days old will be archived...the cycle repeats.  Therefore, from the 2nd day of the month on you will always see some weddings that are older than are available via the webcam page on the website.  Don't be concerned with these files.</td>
</tr>
</table>
</font>

</body>
</html>
