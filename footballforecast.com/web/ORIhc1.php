<?php
session_start();
include_once('includes/config.inc.php');
$query="SELECT * FROM handicap WHERE id=1";
$result=mysql_query($query);

//handle paypal return page
if(isset($_GET['success']) && strlen($_GET['member'])==32) {
    if($_GET['type']==md5('full')) {
        $subscription_status='monthly';
        $subscription_length='1 MONTH';
    }
    elseif($_GET['type']==md5('pow')) {
        $subscription_status='weekly';
        $subscription_length='7 DAY';
    }
    else {
        break;
    }
    $query="SELECT * FROM subscription WHERE md5(CONCAT('ffc_',user_id))='".$_GET['member']."' AND handicapper=1";
    $result=mysql_query($query);
    if($result && mysql_num_rows($result)) {
        $data=mysql_fetch_array($result);
        if($data['expire']>=date('Y-m-d')) {
            $query="UPDATE subscription SET `date`=CURDATE(), type='".$subscription_status."', `expire`=`expire`+ INTERVAL ".$subscription_length." WHERE no='".$data['no']."'";
            mysql_query($query);
        }
        else {
            $query="UPDATE subscription SET `date`=CURDATE(), type='".$subscription_status."', `expire`=CURDATE()+ INTERVAL ".$subscription_length." WHERE no='".$data['no']."'";
            mysql_query($query);
        }
    }
    else {
        //get user id first
        $query="SELECT login_id FROM member WHERE md5(CONCAT('ffc_',login_id))='".$_GET['member']."'";
        $result=mysql_query($query);
        $data=@mysql_fetch_array($result);
        $query="INSERT INTO subscription SET `date`=CURDATE(), user_id='".$data['login_id']."', handicapper=1, type='".$subscription_status."', expire=CURDATE() + INTERVAL ".$subscription_length."";
        mysql_query($query);
    }
    echo $query;
	//check for txn id whether it has been used before
	$message='Thank you for your payment. We\'ll process and activate your subscription once we get the payment clearance.';
}

?>
<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Handicapping. Sports Gambling and Sportsbook Information</title> 
<meta name="keywords" content="football broadcast, NFL picks, sports betting info, free college football picks, free picks, Football, SPORTS PICKS, handicapping, football shows, Free NFL football picks, handicapper info, football forecast weekly, Free Sports Picks, Sports Gambling">
<meta name="description" content="Dennis Tobler's Football Forecast Weekly, SPORTS PICKS, odds, betting">
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
<div align="center" style="color: #FF0000; ">
	<?php echo $message; ?></div>
<div align="center">
<?php
if($result && mysql_num_rows($result)>0) {
	while ($data=mysql_fetch_array($result)) {
?>
	<table border="0" width="600" cellspacing="1" cellpadding="5" id="table1" bgcolor="#C0C0C0" height="88">
		<tr>
			<td bgcolor="#FFFFFF" align="left" valign="top" colspan="2" style="font-family: Arial; font-size: 14pt; color: #800000">
			<p align="center"><b><?php echo $data['name']; ?></b></td>
		</tr>
		<tr style="font-size: 10pt;">
			<td bgcolor="#FFFFFF" align="center" valign="top">
			<p align="center">
			<img src="<?php echo $data['photo']; ?>"><br>
			<br>
			<font face="Arial"><b><span style="font-size: 8pt">
			<a href="paidpicks.php">ACCESS PAID PICKS</a></span></b></font></td>
			<td bgcolor="#FFFFFF" align="left" valign="top">
			<?php echo $data['description']; ?>
			<br /><br />
			<?php 
			if(isset($_SESSION['login_id'])) {
			?>
			<div align="center">
			<input onclick="window.location.href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=billing%40footballforecast%2ecom&item_name=Pick%20Of%20The%20Week<?php echo urlencode('-'.$data['name']); ?>&item_number=pow&no_shipping=1&no_note=1&amount=99%2e00&no_shipping=0&no_note=1&currency_code=USD&return=<?php echo urlencode('http://www.footballforecast.com/hc1.php?success=1&type='.md5('pow').'&member='.md5('ffc_'.$_SESSION['login_id']));?>'" type="button" name="pay" value="Buy Picks of The Week from <?php echo $data['name'];?> for $99"><br /><br />
			<input onclick="window.location.href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick-subscriptions&business=billing%40footballforecast%2ecom&item_name=All%20Picks%20Subscription<?php echo urlencode('-'.$data['name']); ?>&item_number=pick_subscription&no_shipping=1&no_note=1&currency_code=USD&lc=US&a3=199%2e00&p3=1&t3=M&src=1&sra=1&return=<?php echo urlencode('http://www.footballforecast.com/hc1.php?success=1&type=full&member='.md5('ffc_'.$_SESSION['login_id']));?>'" type="button" name="pay" value="Buy All Picks from <?php echo $data['name'];?> for $199">
			<form action=""></form>
			</div>
			<?php
			}
			else {
			?>
			<div align="center">
			<input onclick="alert('Please login to order picks.');location.href='login.php?url=hc1.php';" type="button" name="pay" value="Buy Picks of The Week from <?php echo $data['name'];?> for $99"><br /><br />
			<input onclick="alert('Please login to order picks.');location.href='login.php?url=hc1.php';" type="button" name="pay" value="Buy All Picks from <?php echo $data['name'];?> for $199">
			</div>
			<?php
			}
			?>
		</tr>
		</table>
	<p>&nbsp;</p>
<?php
	}
}
/*
&return=http%3A%2F%2Fwww.footballforecast.com%2Fhc1.php&cancel_return=http%3A%2F%2Fwww.footballforecast.com%2Fhc1.php%3Ffail%3D1&notify_url=http%3A%2F%2Fwww.footballforecast.com%2Fipn.php&custom=handicapper-1,member-<?php echo $_SESSION['login_id']?>
&return=http%3A%2F%2Fwww.footballforecast.com%2Fhc1.php&cancel_return=http%3A%2F%2Fwww.footballforecast.com%2Fhc1.php%3Ffail%3D1&notify_url=http%3A%2F%2Fwww.footballforecast.com%2Fipn.php&custom=handicapper-1,member-<?php echo $_SESSION['login_id']?>
*/
?>	
	</div>
</td>



<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="free picks, guaranteed picks, sports handicappers, cappers, sports betting, bet on sports, free sports picks, sportsbook reviews, contests, winners, win, handicapping tools, baseball, football ,hockey, basketball, college sports, sportsbooks, sports betting, sportsbetting, sport bets, picks, gambling, bet advice, handicapping"><br>
<embed src="sounds/nfl.asf" width="145" height="45" type="video/x-ms-asf" AUTOSTART="true"><br><br>
<? include('tdright.php'); ?>
</td>




</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>
