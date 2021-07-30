<?
// Assign passed value(s)
$filename = $_REQUEST['filename'];
$sort = $_REQUEST['sort'];
// Delete it!
$fullname = "/var/www/helix/Content/Archive/littlechurch/".$filename;
$success = unlink(stripslashes($fullname));
// tell 'em the outcome
if ($success == 1){
	echo'<script>alert("'.$filename.' Deleted");</script>';
}else{
	echo'<script>alert("'.$filename.' Delete Failed");</script>';
}
echo'<script>window.location="index.php?sort='.$sort.'";</script>';
?>
