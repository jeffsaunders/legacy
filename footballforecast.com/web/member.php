<?php
session_start();
include_once('includes/config.inc.php');
if(isset($_POST['login_id'])) {
	$query="SELECT * FROM member WHERE login_id='".$_POST['login_id']."' AND `password`='".$_POST['password']."'";
	$result=mysql_query($query);
	if($result && mysql_num_rows($result)>0) {
		$data=mysql_fetch_array($result);
		$_SESSION['member_login']=true;
		$_SESSION['login_id']=$data['login_id'];
		$_SESSION['status']=$data['status'];
		if(!isset($_POST['url']) || $_POST['url']=='') {
			header('Location: login_welcome.php');
			die();
		}
		else {
			header('Location: '.stripslashes($_POST['url']));
			die();
		}
	}
}

if(isset($_GET['logout'])) {
	unset($_SESSION['member_login']);
	unset($_SESSION['login_id']);
	unset($_SESSION['status']);
}

if(!isset($_SESSION['member_login'])) {
	header('Location: login.php?url='.urlencode('member.php?action=profile'));
	die();
}
else {
	if(isset($_POST['name'])) {
		$query="UPDATE member SET name='".$_POST['name']."', email='".$_POST['email']."', 
		address='".$_POST['address']."', city='".$_POST['city']."', state='".$_POST['state']."', 
		phone='".$_POST['phone']."', `password`='".$_POST['password']."' WHERE login_id='".$_POST['login_id']."'";
		mysql_query($query);
		if(mysql_affected_rows()>0) {
			$message='Your profile has been updated.';
		}
		else {
			$message='Unable to update your profile. Please try again later';
		}
	}
	$query="SELECT * FROM member WHERE login_id='".$_SESSION['login_id']."'";
	$result=mysql_query($query);
	$data=mysql_fetch_array($result);
	$content='
<div align="center" style="color: #FF0000;">
	'.$message.'</div>
<form action="member.php" method="post" name="form1" onSubmit="MM_validateForm(\'name\',\'\',\'R\',\'email\',\'\',\'RisEmail\',\'login_id\',\'\',\'R\',\'password\',\'\',\'R\');return document.MM_returnValue">
  <div align="center">
  <table width="400" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCCC" style="font-family: Arial; font-size: 10pt">
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; "><strong>Member Profile </strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Name</td>
      <td><input name="name" type="text" id="name" size="25" value="'.$data['name'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Email</td>
      <td><input name="email" type="text" id="email" size="25" value="'.$data['email'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Address</td>
      <td><input name="address" type="text" id="address" size="25" value="'.$data['address'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">City</td>
      <td><input name="city" type="text" id="city" size="25" value="'.$data['city'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">State</td>
      <td><input name="state" type="text" id="state" size="25" value="'.$data['state'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Phone</td>
      <td><input name="phone" type="text" id="phone" size="25" value="'.$data['phone'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="right">&nbsp;</td>
    </tr>
    <tr align="center">
      <td colspan="2" bgcolor="#000000" style="color:#FFFFFF; font-size: 14px; " align="right">
		<p align="center">
		<strong>Login information</strong></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Member ID </td>
      <td><input name="old_login_id" readonly disabled type="text" id="login_id" size="25" value="'.$data['login_id'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td align="right">Password</td>
      <td><input name="password" type="password" id="password" size="25" value="'.$data['password'].'"></td>
    </tr>
    <tr bgcolor="#FFFFFF">
      <td colspan="2" align="center"><input name="save" type="submit" id="save" value="Save Profile"></td>
    </tr>
  </table>
  <input type="hidden" name="login_id" value="'.$data['login_id'].'">
	</div>
</form>
';
}
?>
<html>

<head>
<title>Dennis Tobler's Football Forecast Weekly</title>
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
<!--
<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#000000">
  <tr align="center" bgcolor="#9C0000">
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?action=profile" class="admin_menu">
	<font color="#FFFFFF">Profile</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="paidpicks.php" class="admin_menu">
	<font color="#FFFFFF">Paid Picks</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="freepicks.php" class="admin_menu">
	<font color="#FFFFFF">Free Picks</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="multimedia.php" class="admin_menu">
	<font color="#FFFFFF">Multimedia</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="archives.php" class="admin_menu">
	<font color="#FFFFFF">Video Archives</font></a></td>
    <td class="admin_menu" style="border:1px solid #C0C0C0; font-family: Arial; font-size: 8pt; font-weight: bold"><a href="?logout=1" class="admin_menu">
	<font color="#FFFFFF">Logout</font></a></td>
  </tr>
</table>
-->
<br />
<?php echo $content; ?>
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
