<!-- Javascript Functions -->
<!-- Assign Clip URL to Link -->
<!-- External script that adds Flash based access to the clipboard from Javascript -->
<script type="text/javascript" src="zeroclipboard/ZeroClipboard.js"></script>
<script>
function popLink(url,id){
	// Set path to Flash applet
	ZeroClipboard.setMoviePath('zeroclipboard/ZeroClipboard.swf');
	// Create client object
	var clip = new ZeroClipboard.Client();
	// DOM event - assigne passed url to "Client"
	clip.addEventListener('mousedown',function(){
		clip.setText(url);
	});
	// Pop up a notifier that the value has been copied to the clipboard
	clip.addEventListener('complete',function(client,text) {
		alert('The following direct link to this video has been copied to your clipboard:\n\n' + text);
	});
	// Glue it back to the link and return
	clip.glue(id);
}
</script>

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
//foreach(myglob("/var/www/html/littlechurchlv.com/httpdocs/webcam/*.flv") as $filename) {
foreach(myglob("/var/www/webcam/*.flv") as $filename) {
 	// Get filename
//	$path = explode('/',$filename); // [7] => groom-bride@timestamp.flv
        $path = explode('/',$filename); // [4] => groom-bride@timestamp.flv
 	// Remove the ".flv"
//	$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
        $noext = explode('.',$path[4]); // [0] => groom-bride@timestamp
 	// Split the name into names & timestamp
	$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
	// Split the names
	$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride

	$size = filesize($filename);
	// Push it all on the array to display
//	array_push($files,array($path[7],date("m/d/y",$timestamp[1]),date("h:i a",$timestamp[1]),$couple[0],$couple[1],$size,date("H:i",$timestamp[1])));
        array_push($files,array($path[4],date("m/d/y",$timestamp[1]),date("h:i a",$timestamp[1]),$couple[0],$couple[1],$size,date("H:i",$timestamp[1])));
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
?>

<!-- Build page -->
<table border="0" cellspacing="10" cellpadding="0">
<tr>
	<td class="xbigBlack">Webcam Available Weddings</td>
	<td valign="bottom" class="bodyBlack"><em>(Sorted by <?=$sortby;?>)</em><br><img src="/images/spacer.gif" alt="" width="1" height="2" border="0"></td>
</tr>
</table>

<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#C0C0C0" class="bodyBlack">
<tr>
	<th><a href="?sec=webcam&sort=date" class="bodyBlack">Date</a></th>
	<th><a href="?sec=webcam&sort=time" class="bodyBlack">Time</a></th>
	<th><a href="?sec=webcam&sort=groom" class="bodyBlack">Groom</th>
	<th><a href="?sec=webcam&sort=bride" class="bodyBlack">Bride</th>
	<th><a href="?sec=webcam&sort=file" class="bodyBlack">Filename</th>
	<th><a href="?sec=webcam&sort=size" class="bodyBlack">Filesize</th>
	<th class="bodyBlack">Action</th>
</tr>
<?
// Jump to the top of the array
reset($files);
// Step through it
$rowCount = 0;
foreach ($files as $val) {
	// Alternate BG colors
	if($rowCount%2 == 0){
		$bgColor = "#FAFAFA";
	}else{
		$bgColor = "#E8E8E8";
	}
?>
<tr bgcolor="<?=$bgColor;?>">
	<td align="center"><?=$val[1];?></td>
	<td align="center"><?=$val[2];?></td>
	<td><?=$val[3];?></td>
	<td><?=$val[4];?></td>
	<td align="right"><?=$val[0];?></td>
	<td align="right"><?=number_format($val[5]);?></td>
	<td align="center">
		&nbsp;
<!--		<a href="editflash.php?date=<?=$val[1];?>&time=<?=$val[6];?>&groom=<?=$val[3];?>&bride=<?=$val[4];?>&filename=<?=$val[0];?>&sort=<?=$sort;?>">Edit</a>-->
<!--		<a href="javascript:void(0);" onClick="editClicked('<?=$val[1];?>','<?=$val[6];?>','<?=$val[3];?>','<?=$val[4];?>','<?=$sort;?>','<?=$val[0];?>');">Edit</a>-->
		<a href="javascript:void(0);" onClick="editClicked('<?=$val[1];?>','<?=$val[6];?>','<?=$val[3];?>','<?=$val[4];?>','<?=$val[0];?>');">Edit</a>
		&nbsp;&nbsp;&nbsp;
		<a href="javascript:void(0);" onClick="verifyDelete('<?=$val[0];?>','<?=$sort;?>');">Delete</a>
		&nbsp;&nbsp;&nbsp;
<!--		<a href="../webcam/<?=$val[0];?>">Watch</a>-->
		<a href="http://www.littlechurchlv.com/index/guests/webcam?task=<?=$val[0];?>" target="_blank">Watch</a>
		&nbsp;&nbsp;&nbsp;
		<a href="javascript:void(0);" id="<?=$val[0];?>_id" name="<?=$val[0];?>_id" onMouseOver="popLink('http://www.littlechurchlv.com/index/guests/webcam?task=<?=$val[0];?>',this);">Link</a>
		&nbsp;
	</td>
</tr>
<?
	$rowCount++;
}
?>
</table>

<!--<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td width="60" valign="top"><strong>*Note</strong> - </td>
	<td>Wedding files are archived on the first day of each month.  All weddings older than 60 days on that day are archived.  From that point, the oldest one will be between 61 and 90 days old until the first of the next month, after which those between 61 and 90 days old will be archived...the cycle repeats.  Therefore, from the 2nd day of the month on you will always see some weddings that are older than are available via the webcam page on the website.  Don't be concerned with these files.</td>
</tr>
</table>-->

<!-- Edit Filename -->
<script>
	function editClicked(date, time, groom, bride, theFilename) {
		document.editFilenameForm.date.value = date;
		document.editFilenameForm.time.value = time;
		document.editFilenameForm.groom.value = groom;
		document.editFilenameForm.bride.value = bride;
		document.editFilenameForm.filename.value = theFilename;
		document.getElementById('editFilenameHeader').innerHTML = '<span class="bigBlack">Edit <strong>'+groom+' - '+bride+'</strong> Wedding <em></span><br>('+theFilename+')</em>';
		show("editFilename");
	}
</script>

<script type="text/javascript">
	// Ajax script to rename file
	function editFilename(){
		if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{ // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		//	document.getElementById("nameStatus").innerHTML = "<font color='#000000'>Checking ...</font>";
		xmlhttp.open("GET","dbupdate.php?date="+document.getElementById("date").value+"&time="+document.getElementById("time").value+"&groom="+document.getElementById("groom").value+"&bride="+document.getElementById("bride").value+"&filename="+document.getElementById("filename").value+"&task=webcamRename");
		xmlhttp.send();
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById("editOutput").innerHTML = xmlhttp.responseText;
				show("editOutput");
			}
		}
	}
</script>

<script>document.write('<div id="editFilename" style="position:fixed; top:250; left:'+((browserWidth/2)-200)+'px; width:400; z-index:10; visibility:hidden; display:none;">');</script>
	<form action="dbupdate.php" method="post" name="editFilenameForm" id="editFilenameForm">
		<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#808080" class="bodyBlack">
		<tr>
			<td align="center"><div id="editFilenameHeader"></div></td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#C0C0C0" class="bodyBlack">
				<tr>
					<td width="25" rowspan="4"><br><br></td>
					<td width="70"><br>Date:</td>
					<td width="300"><br><input type="text" name="date" id="date" value="" size="20" maxlength="8" tabindex="1"></td>
				</tr>
				<tr>
					<td>Time:</td>
					<td><input type="text" name="time" id="time" value="" size="20" maxlength="5" tabindex="2"><font size="-2"> *Military Time</font></td>
				</tr>
				<tr>
					<td>Groom:</td>
					<td><input type="text" name="groom" id="groom" value="" size="40" maxlength="40" tabindex="3"></td>
				</tr>
				<tr>
					<td>Bride:</td>
					<td><input type="text" name="bride" id="bride" value="" size="40" maxlength="40" tabindex="4"></td>
				</tr>
				<tr>
					<td colspan="3" align="center">
						<input type="hidden" name="filename" id="filename" value="">
						<input type="hidden" name="task" id="task" value="webcamRename"><br>
						<input type="button" name="submit" id="submit" value="Update" onClick="editFilename();">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="button" name="Cancel" id="Cancel" value="Cancel" onClick="hide('editFilename');"><br><br>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
		<div id="editOutput" style="position:relative; top:-45; left:50; width:300; height:40; background-color:#C0C0C0; z-index:4; visibility:hidden; display:none;"></div>
	</form>
</div>

<!-- Delete File -->
<script>
function verifyDelete(filename){
	document.deleteFilenameForm.file_name.value = filename;
	document.getElementById("deleteFilename").innerHTML = "<strong class='bigBlack'>Delete "+filename+"</strong>";
	show("deleteFile");
}
</script>

<script type="text/javascript">
	// Ajax script to rename file
	function deleteFile(){
		if (window.XMLHttpRequest){ // code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{ // code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		//	document.getElementById("nameStatus").innerHTML = "<font color='#000000'>Checking ...</font>";
		xmlhttp.open("GET","dbupdate.php?filename="+document.getElementById("file_name").value+"&task=webcamDelete");
		xmlhttp.send();
		xmlhttp.onreadystatechange = function(){
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
				document.getElementById("deleteOutput").innerHTML = xmlhttp.responseText;
				show("deleteOutput");
			}
		}
	}
</script>

<script>document.write('<div id="deleteFile" style="position:fixed; top:250; left:'+((browserWidth/2)-200)+'px; width:400; z-index:10; visibility:hidden; display:none;">');</script>
<form action="dbupdate.php" method="post" name="deleteFilenameForm" id="deleteFilenameForm">
	<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" bgcolor="#808080" class="bodyBlack">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#C0C0C0" class="bodyBlack">
			<tr>
				<td align="center" class="bodyBlack">
					<br>
					<div id="deleteFilename"></div><br>
					This action is PERMANENT and there is NO undelete.<br><br>
					Are You Sure?<br><br>
					<input type="hidden" name="file_name" id="file_name" value="">
					<input type="button" name="Delete" id="Delete" value="Delete" onClick="deleteFile();">&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" name="Cancel" id="Cancel" value="Cancel" onClick="hide('deleteFile');"><br><br>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
	<div id="deleteOutput" style="position:relative; top:-45; left:50; width:300; height:40; background-color:#C0C0C0; z-index:40; visibility:hidden; display:none;"></div>
</div>
</form>
