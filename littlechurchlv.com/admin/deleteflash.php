<?
// Assign passed value(s)
$filename = $_REQUEST['filename'];
$sort = $_REQUEST['sort'];
// Delete it!
//$fullname = "/var/www/html/littlechurchlv.com/httpdocs/webcam/".$filename;
$fullname = "/var/www/webcam/".$filename;
$success = unlink(stripslashes($fullname));
// tell 'em the outcome
if ($success == 1){
	echo'<script>alert("'.$filename.' Deleted");</script>';
}else{
	echo'<script>alert("'.$filename.' Delete Failed");</script>';
}
echo'<script>window.location="flashcam.php?sort='.$sort.'";</script>';
?>
