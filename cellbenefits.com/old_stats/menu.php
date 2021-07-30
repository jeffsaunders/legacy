<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>CellBenefits.com WebSite Statistics Menu</title>
</head>

<body>

<?
// Connect to the database
include "../dbconnect.php";
?>
<!--<img src="../images/spacer.gif" alt="" width="1" height="13" border="0"><br>-->
<table border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center" bgcolor="#CCCCDD"><strong><font face="sans-serif" size="4" color="#000000">Select Site</font></strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td height="75" align="center" bgcolor="#808080"><a href="cellbenefits.html" target="body" title="Domain Wide Usage Report"><strong><font face="sans-serif" size="5" color="#FFFFFF">All Sites Report</a><br>(Cumulative)</font></strong></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
</tr>
<?
// Grab site setup information
$result = mysql_query("SELECT * FROM sites WHERE 1 ORDER BY site", $linkID);
for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
	$config = mysql_fetch_assoc($result);
?>
<tr>
	<td><a href="<? echo $config['site']; ?>.html" target="body"><img src="../images/<? echo $config['logo']; ?>" alt="<? echo $config['label']; ?> Usage Report" width="200" height="75" border="0"></a></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
</tr>
<?
};
?>
<tr>
	<td><a style="cursor:hand;"><img src="../images/YahooLogo.jpg" alt="Yahoo Usage Report" width="200" height="75" border="0"></a></td>
	<td bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" width="2" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="#CCCCDD"><img src="../images/spacer.gif" alt="" height="2" border="0"></td>
</tr>
</table>

</body>
</html>
