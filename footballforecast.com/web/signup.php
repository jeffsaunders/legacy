<?php
include_once('includes/config.inc.php');
//handle login form submission
if(isset($_POST['name'])) {
	//check login id
	$query="SELECT * FROM member WHERE login_id='".$_POST['login_id']."'";
	$result=mysql_query($query);
	if($result) {
		if(mysql_num_rows($result)==0) {
			$query="INSERT INTO member SET name='".$_POST['name']."', email='".$_POST['email']."', 
			address='".$_POST['address']."', city='".$_POST['city']."', state='".$_POST['state']."', 
			phone='".$_POST['phone']."', login_id='".$_POST['login_id']."', `password`='".$_POST['password']."', 
			status='free', registration_date=CURDATE()";
			mysql_query($query);
			if(mysql_affected_rows()>0) {
				$_POST=array();
				$message='Member registration has been completed. You can login at the folowing form';
				$complete=1;
			}
			else {
				$message='Unable to register member to database. Please try again later';
			}
		}
		else {
			$message='Login ID has been used. Please choose another ID';
		}
	}
}
?>
<html>

<head>
<title>www.footballforecast.com Dennis Tobler's Football Forecast Weekly. Signup. Free Picks. Professional handicappers league.</title>
<meta name="keywords" content="Free NFL football picks, free picks, football broadcast, football shows, Sports Gambling, NFL picks, football forecast weekly, free college football picks, SPORTS PICKS, handicapper info, Free Sports Picks, football, handicapping, sports betting info">
<meta name="description" content="Dennis Tobler's Football Forecast Weekly, free weekly football picks, sports betting.">
<link href="css/style.css" type="text/css" rel="stylesheet">

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}
//-->
</script>
</head>

<body>
<? include('header.php'); ?>


<table border="0" width="100%" cellspacing="0" cellpadding="0" bgcolor=#336600>
<tr>



<td width="180" align=center valign="top">
<img border="0" src="images/spacer_content.gif" width="180" height="1"><br>
<? include('tdleft.php'); ?>
</td>




<td bgcolor="#FFFFFF" align="left" valign="top" style="padding: 10px; font-family:Arial; font-size:10pt; font-weight:bold">

<?php
//DISPLAY REGISTRATION FORM
if($complete<>1) {
?>
<div align="center">
	<font color="#990000"><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15"> User 
	Registration
	<img border="0" src="images/lock.jpg" width="12" height="15"></span></font><table cellSpacing="0" cellPadding="0" width="100%" bgColor="#336600" border="0" id="table1">
		<tr>
			<td style="PADDING-RIGHT: 10px; PADDING-LEFT: 10px; FONT-WEIGHT: bold; FONT-SIZE: 10pt; PADDING-BOTTOM: 10px; PADDING-TOP: 10px; FONT-FAMILY: Arial" vAlign="top" align="left" bgColor="#ffffff">

				<div align="center">
			<p style="margin-top: 0; margin-bottom: 0">
			<span style="font-weight: 400">(You must&nbsp;have an account before 
			buying handicapper picks)</span></p>
				</div>
			</td>
		</tr>
	</table>
</div>
<div align="center" style="color: #FF0000;">
	<?php echo $message; ?></div>
<form action="signup.php" method="post" name="form1" onSubmit="MM_validateForm('name','','R','email','','RisEmail','login_id','','R','password','','R');return document.MM_returnValue">
  <div align="center">
  <table width="400" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; "><strong>Member Profile </strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Name</td>
      <td><input name="name" type="text" id="name" size="25" value="<?php echo stripslashes($_POST['name']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Email</td>
      <td><input name="email" type="text" id="email" size="25" value="<?php echo stripslashes($_POST['email']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Address</td>
      <td><input name="address" type="text" id="address" size="25" value="<?php echo stripslashes($_POST['address']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">City</td>
      <td><input name="city" type="text" id="city" size="25" value="<?php echo stripslashes($_POST['city']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">State</td>
      <td><input name="state" type="text" id="state" size="25" value="<?php echo stripslashes($_POST['state']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Phone</td>
      <td><input name="phone" type="text" id="phone" size="25" value="<?php echo stripslashes($_POST['phone']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="right">&nbsp;</td>
    </tr>
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; " align="right">
		<p align="center">
		<strong>Choose User Login</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Member ID </td>
      <td><input name="login_id" type="text" id="login_id" size="25" value="<?php echo stripslashes($_POST['login_id']); ?>"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Password</td>
      <td><input name="password" type="password" id="password" value="" size="25" value="<?php echo stripslashes($_POST['password']); ?>"></td>
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFFFFF">

<p align="center" style="margin-top: 0; margin-bottom: 0">
<font color="#990000" face="Verdana"><span style="font-size: 7pt">
<textarea rows="5" name="Terms" cols="61" style="font-family: Verdana; font-size: 8pt; color: #666666">User Registration & Membership Conditions

---- Free User Registration ---- 
With this Free Signup you gain access to the Weekly Video, the Archives, and the Weekly Free Picks.

---- Memberships ----
1. Weekly Membership (1-time charge, NOT recurring)
As registered user purchasing this membership you gain access to all the above items, plus your card will be charged once $99 for access to the chosen Handicapper's weekly picks. After completing the signup and payment, you will be redirected back to the login page. All you need to do is login, the free and purchased items are accessible for you from the menu using the MEMBER AREA link. After the 7 days, your Paid Membership will expire, the weekly picks from the selected Handicapper are inaccessible, but your Free Membership will remain intact, allowing access to all above listed items throughout this season.

2. Monthly Subscription (monthly recurring)
As registered user purchasing this membership you gain access to all the above items, plus your card will be charged $199 for access to the chosen Handicapper's weekly picks. This charge is recurring monthly until the end of this season. At the end of this season the charge will stop automatically. After completing the signup and payment, you will be redirected back to the login page. All you need to do is login, the free and purchased items are accessible for you from the menu using the MEMBER AREA link. At the end of this season your Paid Monthly (full) Membership will expire, you will receive a confirmation email that there are no charges. You can cancel your subscription any time without additional charges. Your Free Membership will remain intact, allowing access to all above listed Free items for this season.
</textarea></span></font></p></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="center">
		<input name="save" type="submit" id="save" value="Complete Signup"></td>
    </tr>
  </table>
	</div>
</form>
<?php
}
else {
	//DISPLAY LOGIN FORM
?>
<div align="center">
	<font color="#990000"><span style="font-size: 14pt">
	<img border="0" src="images/lock.jpg" width="12" height="15"> User Registration Completed
	<img border="0" src="images/lock.jpg" width="12" height="15"></span></font></div>
<form name="form1" method="post" action="member.php">
<div align="center" style="color: #FF0000;">
	<?php echo $message; ?></div>
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="0" style="font: arial; font-size: 10pt; font-weight: bold;">
    <tr>
      <td align=right>Login ID </td>
      <td width="5" align="center">:</td>
      <td><input name="login_id" type="text" id="login_id" size="25"></td>
    </tr>
    <tr>
      <td align="right">Password</td>
      <td width="5" align="center">:</td>
      <td><input name="password" type="password" id="password" size="25"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td width="5" align="center">&nbsp;</td>
      <td><input type="submit" name="Submit" value="Login"></td>
    </tr>
  </table>
</form>

<?php	
}
?>
</td>



<td align="center" valign="top" width="180">
<img border="0" src="images/spacer_content.gif" width="180" height="1" alt="bet advice, handicapping, football picks newsletter, football tv show, football video, football forecast, sports commentary, college football, sports gambling, NFL picks, sports betting, guaranteed picks, point spreads, odds, NFL weekly pics, sports insight"><br>
<? include('tdright.php'); ?>
</td>




</tr>
</table>



<? include('footer.php'); ?>
</body>

</html>