<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Little Church of the West Webcam Management Console</title>
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

// Assign passed value(s)
$sort = $_REQUEST['sort'];
$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$groom = $_REQUEST['groom'];
$bride = $_REQUEST['bride'];
$filename = $_REQUEST['filename'];
//echo $filename;

// Build array of wedding file information
//$files = array();
// Remove (pop off) the annoying empty element that creates
//$pop = array_pop($files);
// Break up the full path to each filename and push the values onto the stack
//foreach(myglob("/var/www/helix/Content/Archive/littlechurch/*.rm") as $filename) {
	// Get filename
//	$path = explode('/',$filename); // [7] => groom-bride@timestamp.rm
	// Remove the ".rm"
//	$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
	// Split the name into names & timestamp
//	$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
	// Split the names
//	$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride

//	$size = filesize($filename);
	// Push it all on the array to display
//	array_push($files,array($path[7],date("m/d/y",$timestamp[1]),date("h:i a",$timestamp[1]),$couple[0],$couple[1],$size));
//}


// Build page
echo'
<form action="updatefile.php" method="post">
<font face="sans-serif">
<table width="700" border="0" cellspacing="2" cellpadding="0" align="center" bgcolor="#808080">
<tr>
	<td>
		<table width="700" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#808080">
		<tr>
			<td align="center"><strong><font size="+2">Little Church of the West Webcam Console</font><br><font size="+1">- Edit Wedding Filename -</font></strong><br><hr width="100%" size="1" color="#000000" noshade></td>
		</tr>
		<tr>
			<td align="center">Edit <strong>'.stripslashes($groom).' - '.stripslashes($bride).'</strong> Wedding <em>('.stripslashes($filename).')</em></td>
		</tr>
		<tr>
			<td>
				<table width="700" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#C0C0C0">
				<tr>
					<td width="30%" rowspan="4"><br><br></td>
					<td width="10%"><br>Date:</td>
					<td width="60%"><br><input type="text" name="date" id="date" value="'.$date.'" size="20" maxlength="8" tabindex="1"></td>
				</tr>
				<tr>
					<td>Time:</td>
					<td><input type="text" name="time" id="time" value="'.$time.'" size="20" maxlength="5" tabindex="2"><font size="-2"> *Military Time</font></td>
				</tr>
				<tr>
					<td>Groom:</td>
					<td><input type="text" name="groom" id="groom" value="'.stripslashes($groom).'" size="40" maxlength="40" tabindex="3"></td>
				</tr>
				<tr>
					<td>Bride:</td>
					<td><input type="text" name="bride" id="bride" value="'.stripslashes($bride).'" size="40" maxlength="40" tabindex="4"></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="hidden" name="sort" id="sort" value="'.$sort.'">
						<input type="hidden" name="filename" id="filename" value="'.stripslashes($filename).'"><br>
						<input type="submit" name="submit" id="submit" value="Update">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" name="Cancel" id="Cancel" value="Cancel" onClick="history.back();"><br><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</font>
</form>
';
?>

<!-- Put the cursor in the Date field -->
<script>document.forms[0].date.focus();</script>

</body>
</html>
