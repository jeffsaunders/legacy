<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Blind Center Upload Page</title>

	<script>
	function overwriteWarn(imgName) {
		cont=confirm("Submitting this form will overwrite the existing file\n\n                        Continue?");
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
$sid = md5(uniqid(rand()));  // Session ID
?>

<br>
<form action="/cgi-bin/upload.cgi?sid=<? echo $sid; ?>" enctype="multipart/form-data" method="post" name="showform" id="showform">
<table align="center" bgcolor="#E0E0E0">
<tr>
	<td>Filename:</td>
	<td><input type="file" name="filename" id="filename" value="" size="30" maxlength="255"></td>
</tr>
<tr>
	<td colspan="2" align="center">
	<input type="hidden" name="sessionid" value="<?= $sid ?>">
	<input type="hidden" name="redirect" value="http://www.blindcenter.org/upload/done.php"> <!-- Where to go after upload -->
<!--	<input type="hidden" name="required_fields" value="host">--> <!-- List required fields -->
	<input type="hidden" name="required_files" value="filename"> <!-- List required files -->
	<input type="button" name="submitform" value="&nbsp;&nbsp;&nbsp;Upload&nbsp;&nbsp;&nbsp;" onClick="postIt();">
	<input type="reset" name="resetform" value="Reset Form">
	</td>
</tr>
</form>
<tr>
	<td colspan="2" align="center" bgcolor="#C0C0C0"><font size="-1"><strong>* File uploads can take time. &nbsp;Press <em>"Update"</em> only once and please be patient.</strong></font></td>
</tr>
</table>

<br>
<!-- Upload Progress Bar -->
<div align="center"><iframe src="blank.php" name="barframe" id="barframe" width="450" height="100" marginwidth="0" marginheight="0" align="top" scrolling="no" frameborder="0"></iframe></div>

</div>

</body>
</html>
