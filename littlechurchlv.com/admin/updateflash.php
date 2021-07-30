<?
// Assign passed value(s)
$sort = $_REQUEST['sort'];
$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$groom = $_REQUEST['groom'];
$bride = $_REQUEST['bride'];
$filename = $_REQUEST['filename'];
$path = $_REQUEST['path'];
// Build new filename
$newname = $groom."-".$bride."@".strtotime($date." ".$time).".flv";
// Rename it!
//$success = rename("/var/www/html/littlechurchlv.com/httpdocs/webcam/".stripslashes($filename), "/var/www/html/littlechurchlv.com/httpdocs/webcam/".stripslashes($newname));
$success = rename("/var/www/webcam/".stripslashes($filename), "/var/www/webcam/".stripslashes($newname));
// tell 'em the outcome
if ($success == 1){
	echo'<script>alert("'.$filename.' Renamed As '.$newname.'");</script>';
}else{
	echo'<script>alert("'.$filename.' Rename Failed");</script>';
}
echo'<script>window.location="flashcam.php?sort='.$sort.'";</script>';
?>
