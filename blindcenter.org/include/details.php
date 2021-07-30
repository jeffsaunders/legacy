<!-- BEGIN INCLUDE Details -->

<?
if ($_REQUEST['source'] == "announcements") {
	$query = "SELECT * FROM announcements WHERE article_id = ".$_REQUEST['article'];
	$rs_details = mysql_query($query, $linkID);
	$details = mysql_fetch_assoc($rs_details);
	echo $details["details"];
}
?>
<br>
	
<!-- END INCLUDE Details -->
