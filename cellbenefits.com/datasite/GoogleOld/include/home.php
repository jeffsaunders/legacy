<!-- BEGIN INCLUDE home.php -->

<? if ($_REQUEST['cookie'] == "yes"){ ?>
<script>
createCookie('username','<? echo $_SESSION['username']; ?>'); 
createCookie('password','<? echo $_SESSION['password']; ?>'); 
</script>
<? } ?>

<? if ($_REQUEST['cookie'] == "no"){ ?>
<script>
eraseCookie('username'); 
eraseCookie('password'); 
</script>
<? } ?>

<?
$query = "SELECT * FROM site_notes	WHERE type = 'welcome'";
$rs_welcome = mysql_query($query, $linkID);
$welcome = mysql_fetch_assoc($rs_welcome);

$query = "SELECT *, UNIX_TIMESTAMP(note_date) as date FROM site_notes
			WHERE display = 'T' AND
			type != 'welcome' AND
			start_date <= CURDATE() AND
			(end_date >= CURDATE() OR end_date IS NULL) AND
			show_".$_SESSION["user_level"]." = 'T'
			ORDER BY note_date DESC";
$rs_notes = mysql_query($query, $linkID);

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
</tr>
<tr>
	<td width="100%" height="25" bgcolor="#EFEFEF" style="border-top: 2px solid #4F1E96;" class="bigBlack">&nbsp;&nbsp;<strong>Telcom Admin Home Page</strong></td>
</tr>
</table>
<br><br>
<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
<tr>
	<td><strong><? echo $welcome["title"]; ?></strong></td>
</tr>
<tr>
	<td><br><? echo $welcome["note"]; ?></td>
</tr>
<?
if ($rs_notes){
	for ($counter=1; $counter <= mysql_num_rows($rs_notes); $counter++){
		$note = mysql_fetch_assoc($rs_notes);
		echo'
<tr>
	<td><br><br><strong>'.$note["title"].'</strong>'.iif($note["date"] == '', '', '<br><em class="smallBlack">'.date('l, F j, Y', $note["date"]).'</em></td>').'
</tr>
<tr>
	<td><br>'.$note["note"].'</td>
</tr>
			';
	}
}
?>
</table>

<!-- END INCLUDE home.php -->
