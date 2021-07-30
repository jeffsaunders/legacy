<?
// Connect to the database
//include("dbconnect.php");

// PHP Functions
//include("functions.php");

// Now, what to do...what to do?
switch($_REQUEST['task']){
	case "webcamRename": //Webcam file rename
		// Assign passed value(s)
		$date = $_REQUEST['date'];
		$time = $_REQUEST['time'];
		$groom = $_REQUEST['groom'];
		$bride = $_REQUEST['bride'];
		$filename = $_REQUEST['filename'];
		$path = $_REQUEST['path'];
		// Build new filename
		$newname = $groom."-".$bride."@".strtotime($date." ".$time).".flv";
		// Rename it!
//		$success = rename("/var/www/html/littlechurchlv.com/httpdocs/webcam/".stripslashes($filename), "/var/www/html/littlechurchlv.com/httpdocs/webcam/".stripslashes($newname));
		$success = rename("/var/www/webcam/".stripslashes($filename), "/var/www/webcam/".stripslashes($newname));
		// tell 'em the outcome
		if ($success == 1){ //Successful
?>
			<div align="center"><strong>File Renamed.</strong>&nbsp;&nbsp;&nbsp;<input type="button" name="OK" id="OK" value="Ok" onClick='hide("editOutput"); hide("editFilename"); window.location.reload(false);'></div>
<?
		}else{ //Failed
?>
			<div align="center"><strong><font color="#FF0000">Rename Failed!</font></strong>&nbsp;&nbsp;&nbsp;<input type="button" name="OK" id="OK" value="Ok" onClick='hide("editOutput"); hide("editFilename"); window.location.reload(false);'></div>
<?
		}
		exit;

	case "webcamDelete": //Webcam file delete
		// Assign passed value(s)
		$filename = $_REQUEST['filename'];
		// Delete it!
//		$fullname = "/var/www/html/littlechurchlv.com/httpdocs/webcam/".$filename;
		$fullname = "/var/www/webcam/".$filename;
		$success = unlink(stripslashes($fullname));
		// tell 'em the outcome
		if ($success == 1){
?>
			<div align="center"><strong>File Deleted.</strong>&nbsp;&nbsp;&nbsp;<input type="button" name="OK" id="OK" value="Ok" onClick='hide("deleteOutput"); hide("deleteFile"); window.location.reload(false);'></div>
<?
		}else{ //Failed
?>
			<div align="center"><strong><font color="#FF0000">Delete Failed!</font></strong>&nbsp;&nbsp;&nbsp;<input type="button" name="OK" id="OK" value="Ok" onClick='hide("deleteOutput"); hide("deleteFile"); window.location.reload(false);'></div>
<?
		}
		exit;







}; // End Switch
?>
