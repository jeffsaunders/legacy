<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>SGPN Admin System - Sports Gaming Radio</title>

	<script>
	function overwriteWarn(imgName) {
		cont=confirm("Submitting this form will overwrite the existing show\n\n                        Continue?");
		if (cont==false){
			form.showform.focus();
		}else{
			postIt();
//			document.showform.submit();
		}
	}
	</script>
	
	<script>
		// Progress Bar file for IFRAME
		var postLocation="pgbar.php";

		// add any extension that you do no want to upload to the list 
		// below they should be placed with in the /^ and / characters
		// separate each extension by a pipe symbol |	
		var re = /^(\.php)|(\.sh)/;  // disallow shell scripts and php

		// dofilter = false; if you don't want this filtering
		var dofilter=true;

		// this function will match each of the filenames with a
		// given list of banned extension. If any one of the
		// extensions match, an alert will be popped up and the
		// upload will not continue;
 		function check_types(){
			with(document.forms[0]){
				for(i=0 ; i < elements.length ; i++){
					if(elements[i].value.match(re)){
						alert('Sorry ' + elements[i].value + ' is not allowed');
						return false;
					}
				}
			}
			return true;
		}

		function postIt(){
			if(check_types() == false){
				return false;
			}
			baseUrl = postLocation;
			sid = document.forms[0].sessionid.value;
			iTotal = escape("-1");
			baseUrl += "?iTotal=" + iTotal;
			baseUrl += "&iRead=0";
			baseUrl += "&iStatus=1";
			baseUrl += "&sessionid=" + sid;

			document.getElementById('barframe').src = baseUrl;
			document.forms[0].submit();
		}
	</script>

</head>

<body>

<?
// Interrogate and reassign passed variables
//$sec = $_GET['sec'];
//$filename = $_GET['filename'];
$show = $_GET['show'];
$title = $_GET['title'];
?>

<br><br>
<div align="center"><font size="+2"><strong>SGPN's Ugly (temp) Admin System</strong></font><br><br>
<em><font size="+1"><strong>Sports Gaming Radio</strong></font></em><hr width="250" noshade>
<a href="/admin/index.php">Main Admin Menu</a><br>
<a href="index.php">SGR Admin Menu</a><br>
<a href="radioshows.php">SGR Shows Menu</a><br>

<!-- list shows with links -->
<?
// Connect to database
include("./../../common/dbconnect.php"); // returns $linkID

mysql_select_db("sportsgamingradio", $linkID);
$query = "SELECT *, UNIX_TIMESTAMP(date) AS date FROM radioshows WHERE radioshows.show = '".$show."' AND title = '".$title."' LIMIT 1";
$result = mysql_query($query, $linkID);
$row = mysql_fetch_assoc($result);
if ($row["available"] == "T"){
	$check = "checked";
}else{
	$check = "";
}
$sid = md5(uniqid(rand()));  // Session ID
?>

<br>
<!--<form action="updateshow.php" enctype="multipart/form-data" method="post" name="showform" id="showform">-->
<form action="/cgi-bin/upload.cgi?sid=<? echo $sid; ?>" enctype="multipart/form-data" method="post" name="showform" id="showform">
<table bgcolor="#E0E0E0">
<tr>
	<td colspan="2" align="center" bgcolor="#C0C0C0"><font size="+1">Update the <? echo $row["title"]; ?></font></td>
</tr>
<tr>
<!--	<td>Show:</td>
	<td><input type="text" name="show" id="show" value="<?// echo $row["show"]; ?>" size="30" readonly style="background-color: #D3D3D3">&nbsp;&nbsp;&nbsp;&nbsp;Available? <input type="checkbox" name="available" id="available" <?// echo $check; ?>></td>-->
	<input type="hidden" name="show" value="<? echo $row["show"]; ?>">
	<td>Show:</td>
	<td><input type="text" name="title" id="title" value="<? echo $row["title"]; ?>" size="50" readonly style="background-color: #D3D3D3"></td>
</tr>
<tr>
	<td>Host:</td>
<!--	<td><select name="host" id="host" value="<?// echo $row["host"]; ?>" size="1">
			<option>Rod Myers&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<option>Pete Allman</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;Available? <input type="checkbox" name="available" id="available" <?// echo $check; ?>>
	</td>-->
	<td><input type="text" name="host" id="host" value="<? echo $row["host"]; ?>" size="30">&nbsp;&nbsp;&nbsp;&nbsp;Available? <input type="checkbox" name="available" id="available" <? echo $check; ?>></td>
</tr>
<!--<tr>
	<td>Title:</td>
	<td><input type="text" name="title" id="title" value="<?// echo $row["title"]; ?>" size="30" readonly style="background-color: #D3D3D3"></td>
</tr>-->
<tr>
	<td>Clip Description:</td>
	<td><textarea cols="40" rows="4" name="description" id="description" wrap="soft"><? echo $row["description"]; ?></textarea></td>
</tr>
<tr>
	<td>Clip Filename:</td>
	<td><input type="file" name="filename" id="filename" value="" size="30" maxlength="255"></td>
</tr>
<tr>
	<td colspan="2" align="center">
	<input type="hidden" name="sessionid" value="<?= $sid ?>">
	<input type="hidden" name="redirect" value="http://www.sgpn.net/admin/sgr/updateshow.php"> <!-- Where to go after upload -->
<!--	<input type="hidden" name="required_fields" value="host">--> <!-- List required fields -->
	<input type="hidden" name="required_files" value="host,filename"> <!-- List required files -->
	<input type="button" name="submitform" value="&nbsp;&nbsp;&nbsp;Update&nbsp;&nbsp;&nbsp;" onClick="overwriteWarn();">
	<input type="reset" name="resetform" value="Reset Form">
	</td>
</tr>
</form>
<tr>
	<td colspan="2" align="center" bgcolor="#C0C0C0"><font size="-1"><strong>* File uploads can take time. &nbsp;Press <em>"Update"</em> only once and be patient.</strong></font></td>
</tr>
</table>

<br>
<!-- Upload Progress Bar -->
<iframe src="blank.php" name="barframe" id="barframe" width="450" height="100" marginwidth="0" marginheight="0" align="top" scrolling="no" frameborder="0"></iframe>

</div>

</body>
</html>
