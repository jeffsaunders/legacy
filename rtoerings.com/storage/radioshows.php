<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>SGPN Admin System - Sports Gaming Radio</title>
</head>

<body>

<br><br>
<div align="center"><font size="+2"><strong>SGPN's Ugly (temp) Admin System</strong></font><br><br>
<em><font size="+1"><strong>Sports Gaming Radio</strong></font></em><hr width="300" noshade>
<a href="/admin/index.php">Main Admin Menu</a><br>
<a href="index.php">SGR Admin Menu</a><br>

<!-- list shows with links -->
<?
// Connect to database
include("./../../common/dbconnect.php"); // returns $linkID

mysql_select_db("sportsgamingradio", $linkID);
$query = "SELECT *, UNIX_TIMESTAMP(date) AS date FROM radioshows ORDER BY 'category','title'";
$result = mysql_query($query, $linkID);
//$row = mysql_fetch_assoc($result);
$cat = $row["category"];
for ($counter=1; $counter <= mysql_num_rows($result); $counter++){ 
	$row = mysql_fetch_assoc($result);
	if ($row["category"] != $cat){
		echo '<hr width="250" noshade>';
		$cat = $row["category"];
	}
	if ($row["show"]){
//		echo'<a href="updateshowform.php?show='.$row["show"].'&title='.$row["title"].'">'.$row["show"].' - '.$row["title"].'</a>  <em>(updated '.strftime("%m/%d/%y",$row["date"]).')</em><br>';
		echo'<a href="updateshowform.php?show='.$row["show"].'&title='.$row["title"].'">'.$row["title"].' ('.$row["show"].')</a>  <em>(updated '.strftime("%m/%d/%y",$row["date"]).')</em><br>';
	}else{
		echo'<a href="updateshowform.php?show='.$row["show"].'&title='.$row["title"].'">'.$row["title"].'</a>  <em>(updated '.strftime("%m/%d/%y",$row["date"]).')</em><br>';
	}
}
?>
<hr width="250" noshade>
</div>

</body>
</html>
