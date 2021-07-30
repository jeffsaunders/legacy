<?php
session_start();
include_once('includes/config.inc.php');
if(!isset($_SESSION['login_id']) || $_SESSION['login_id']=='') {
	header('Location: login.php?url=paidpicks.php');
	die();
}
$query="SELECT * FROM subscription WHERE user_id='".$_SESSION['login_id']."' AND expire	>=CURDATE()";
$result=mysql_query($query);
if($result && mysql_num_rows($result)>0) {
	while ($data=mysql_fetch_array($result)) {		
		$handicapper[]=$data['handicapper'];
	}
}
$handicapper_list=@implode(',',$handicapper);
$query="SELECT pick.*,handicap.name FROM pick LEFT JOIN handicap ON handicap.id=pick.handicapper WHERE status='paid' AND handicapper IN (".$handicapper_list.") ORDER BY handicapper ASC, `date` DESC";
$result=mysql_query($query);
?>
<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Paid Picks. Weekly pro football picks.</title>
<meta name="description" content="Dennis Tobler's Football Forecast Weekly">
<link href="css/style.css" type="text/css" rel="stylesheet">
<style>
<!--
	td { font-family: Verdana, Arial, Helvetica, sans-serif }
	.bodyline	{ background-color: #FFFFFF; border: 1px #98AAB1 solid; }

	.forumline	{ background-color: #FFFFFF; border: 2px #006699 solid; }

	td.row1	{ background-color: #EFEFEF; }
	p { font-family: Verdana, Arial, Helvetica, sans-serif }
	.postbody { font-size : 12px; line-height: 18px}
-->
</style>
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold; color:#000000">

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Paid Plays<br>
	</span>Access for subscribers only.</font></div>
<div align="center">
	&nbsp;</div>
<div align="center">
	&nbsp;</div>
<div align="center">
<?php 
if($result && mysql_num_rows($result)>0) {
	$name='';
	while ($data=mysql_fetch_array($result)) {
		if($name<>$data['name']) {
			$name=$data['name'];
			echo '
<div align="justify">
'.$data['name'].'</div>
';
		}
?>
	<table border="0" width="100%" cellspacing="1" cellpadding="0" bgcolor="#C0C0C0" id="table1" height="63">
		<tr>
			<td bgcolor="#000000" height="18">
			<p align="center"><span class="postbody">
			<font face="Arial" style="font-size: 14pt" color="#FFFFFF"><?php echo $data['title']; ?></font></span></td>
		</tr>
		<tr>
			<td style="font-family: Arial; font-size: 10pt; font-weight: bold" bgcolor="#FFFFFF" align="center">
			<?php echo $data['description']; ?></td>
		</tr>
		</table>
	<p>&nbsp;</p>
<?php
	}
}
else {
	?>
	<div style="color: #FF0000">You currently don't have any purchased plays.<br>
		<br />
		To subscribe, please select your <a href="handicappers.php">handicapper</a> 
		from the menu.</div>
	<?php
}
?>
</div>
</td>



<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdright.php'); ?>
</td>




</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>
