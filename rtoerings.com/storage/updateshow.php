<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>SGPN Admin System - Sports Gaming Radio</title>
</head>

<body>

<br><br>
<div align="center"><font size="+2"><strong>SGPN's Ugly (temp) Admin System</strong></font><br><br>
<em><font size="+1"><strong>Sports Gaming Radio</strong></font></em><hr width="250" noshade>
</div>
<?
// Interrogate and reassign passed variables
$tmp_name = $_GET['tmp_name'];
$show = $_GET['show'];
$available = $_GET['available'];
$title = $_GET['title'];
$host = $_GET['host'];
$description = $_GET['description'];
//$filename = $_GET['filename'];
$sessionid = $_GET['sessionid'];
$redirect = $_GET['redirect'];
$required_fields = $_GET['required_fields'];
$required_files = $_GET['required_files'];

// Extract the filename from the full path
$upload = $_REQUEST['file'];
$fullname = $upload['name'][0];
$splitstring = split("\\\\",$fullname);
$cnt = count($splitstring)-1;
$filename = $splitstring[$cnt];

// Check to make sure all the required fields are filled in
$error = 0;
// required normal fields
if ($required_fields){
	$splitstring = split(",",$required_fields);
	for($x=0; $x < count($splitstring); $x++){
		if (!$HTTP_POST_VARS[$splitstring[$x]]) {
		// if this is the first found error
			if ($error == 0){
				echo'<font size="+2"><strong>Please correct the following error(s) and resubmit:<br></font>';
			}
			// print the error
	        echo'<li type="disk"><font color="red">Required value <strong>'.$splitstring[$x].'</strong> is missing.</li></font>';
			$error = 1;
		}
	}
}
// required files
if ($required_files){
	$splitstring = split(",",$required_files);
	for($x=0; $x < count($splitstring); $x++){
//		$name = $splitstring[$x]."_name";
		$name = $splitstring[$x];
		if (!$$name) {
			if ($error == 0){
				echo'<font size="+2"><strong>Please correct the following error(s) and resubmit:<br></font>';
			}
			// print the error
	        echo'<li type="disk"><font color="red">Required value <strong>'.$splitstring[$x].'</strong> is missing.</li></font>';
			$error = 1;
		}
	}
}
// if there were any errors found bail out
if ($error != 0){
	exit('<br><br>Please use the <a href="javascript: history.go(-1);">back</a> button to correct this/these error(s).');
}else{
	// You're clear! Update Record
	include("./../../common/dbconnect.php"); // returns $linkID
	mysql_select_db("sportsgamingradio", $linkID);
	// Set the proper checkbox enum values
	if ($available){
		$is_available = "T";
	}else{
		$is_available = "F";
	}
	$query = "UPDATE radioshows SET date=now(), host='$host', description='$description', filename='$filename', available='$is_available' WHERE radioshows.show='$show' AND title='$title' LIMIT 1";
	$result = mysql_query($query, $linkID);
	// Move/Save File
	rename($tmp_name['name'][0], '/var/www/html/sportsgamingradio/media/radioshows/'. $filename);
//	$tempFile = $HTTP_POST_FILES['filename']['tmp_name'];
//	$dest = "/var/www/html/sportsgamingradio/media/radioshows/".$filename_name;
//	copy($filename, $dest);
	if ($result){
		echo'
			<script>
				alert("Show Update Successful");
				window.location.href = "radioshows.php";
			</script>
		';
	}else{
		echo'
			<script>
				alert("Update Failed - Please Try Again");
				history.go(-1);
			</script>
		';
	}
}
?>

</body>
</html>
