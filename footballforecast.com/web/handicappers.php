<?php
session_start();
include_once('includes/config.inc.php');
$query="SELECT * FROM handicap ORDER BY id ASC";
$result=mysql_query($query);
?>
<html>

<head>
<title>www.footballforecast.com Professional Handicapping - Football Handicapping</title>
<meta name="keywords" content="free picks, football shows, NFL picks, Free NFL football picks, SPORTS PICKS, Football, handicapping, sports betting info, handicapper info, football forecast weekly, Free Sports Picks, football broadcast, Sports Gambling, free college football picks">
<meta name="description" content="Professional handicapping, football handicapping, Dennis Tobler's Football Forecast Weekly">
<link href="css/style.css" type="text/css" rel="stylesheet">
<style>
<!--
	td { font-family: Verdana, Arial, Helvetica, sans-serif }
	.bodyline	{ background-color: #FFFFFF; border: 1px #98AAB1 solid; }

	.forumline	{ background-color: #FFFFFF; border: 2px #006699 solid; }

	td.row1	{ background-color: #EFEFEF; }
	p { font-family: Verdana, Arial, Helvetica, sans-serif }
	.postbody { font-size : 12px; line-height: 18px}
div.Section1
	{page:Section1;}
-->
</style>
</head>

<body>

<!-- Professional Handicapping, Football Handicapping -->

<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="Football handicapping, Professional handicapper, handicapping"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold; color:#000000">

<div align="center">
	<font color="#990000"><span style="font-size: 14pt">Our Handicappers</span></font></div>
<div align="center">
	&nbsp; <font color="#FFFFFE"><span style="font-size: 1pt">Professional handicapping, football handicapping, handicapping</span></font> </div>
<div align="center">
<?php
if($result && mysql_num_rows($result)>0) {
	while ($data=mysql_fetch_array($result)) {
?>
	<table border="0" width="600" cellspacing="1" cellpadding="5" id="table1" bgcolor="#C0C0C0" height="88">
		<tr>
			<td bgcolor="#FFFFFF" align="left" valign="top" colspan="2">
			<p align="center"><b><?php echo $data['name']; ?></b></td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" align="center" valign="top">
			<p align="center">
			<img src="<?php echo $data['photo']; ?>"><br>
			<br>
			<font face="Arial"><b><span style="font-size: 8pt">
			<a href="paidpicks.php">ACCESS PAID PICKS</a></span></b></font></td>
			<td bgcolor="#FFFFFF" align="left" valign="top">
			<?php echo $data['pick']; ?><br>
			<br>
			<?php echo $data['description']; ?>
		</tr>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF" align="center" colspan="2">
			<?php 
			if(isset($_SESSION['login_id'])) {
			?>
			<input onclick="window.location.href='https://www.paypal.com/subscriptions/business=winner%40footballforecast%2ecom&item_name=Pick%20Of%20The%20Week<?php echo urlencode('-'.$data['name']); ?>&item_number=pow&no_shipping=1&no_note=1&currency_code=USD&lc=US&a3=99%2e00&p3=1&t3=W&src=0&sra=1'" type="button" name="pay0" value="Buy Picks of The Week from <?php echo $data['name'];?> for $99"><br />
			<input onclick="window.location.href='https://www.paypal.com/subscriptions/business=winner%40footballforecast%2ecom&item_name=All%20Picks%20Subscription<?php echo urlencode('-'.$data['name']); ?>&item_number=pick_subscription&no_shipping=1&no_note=1&currency_code=USD&lc=US&a3=199%2e00&p3=1&t3=M&src=1&sra=1'" type="button" name="pay1" value="Buy All Picks from <?php echo $data['name'];?> for $199">
			<?php
			}
			else {
			?>
			<input onclick="alert('Please login to order picks.');location.href='login.php?url=handicappers.php';" type="button" name="pay0" value="Buy Picks of The Week from <?php echo $data['name'];?> for $99"><br />
			<input onclick="alert('Please login to order picks.');location.href='login.php?url=handicappers.php';" type="button" name="pay1" value="Buy All Picks from <?php echo $data['name'];?> for $199">

<br><hr size="1">
<p align="left"><b><font face="Arial" color="#B90000" size="2">If you are not using Credit Card or PayPal, we now offer alternative payment methods:</font></b></p>			<div align="center">
<b><font face="Arial" font size="3">
<A HREF="javascript:void(0)" onClick="window.open('wu.php', 'MyPopUp', 'width=432,height=270,toolbar=0,scrollbars=0,screenX=200,screenY=200,left=200,top=200')">
WESTERN UNION</A></font></b><br>
&nbsp;</div>

<?php
			}
			?>
			</td>
			</table>
			<p>&nbsp;</p>
<?php
	}
}
?>	
	</div>
</td>




<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="Football handicapping, Professional handicapper, handicapping"><br>
<embed src="sounds/nfl.asf" width="145" height="45" type="video/x-ms-asf" AUTOSTART="true"><br><br>
<? include('tdright.php'); ?>
</td>





</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>
