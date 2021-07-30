<!-- BEGIN INCLUDE login.php -->

<?
$_SESSION['user'] = "";
$_SESSION['user_level'] = "";
?>

<script>
function validate(theForm){
// Username
	if (theForm.username){
		if (theForm.username.value == ""){
			theForm.username.style.background="#FF0000";
			alert("Blank Usernames Not Allowed - Please Enter Your Username");
			theForm.username.style.background="#FFFFFF";
			theForm.username.focus();
			return false;
		}
	}
// Password
	if (theForm.password){
		if (theForm.password.value == ""){
			theForm.password.style.background="#FF0000";
			alert("Blank Passwords Not Allowed - Please Enter Your Password");
			theForm.password.style.background="#FFFFFF";
			theForm.password.focus();
			return false;
		}
	}
// Remember AND Forget
	if (theForm.remember){
		if (theForm.remember.checked && theForm.forget.checked){
			theForm.remember.style.background="#FF0000";
			theForm.forget.style.background="#FF0000";
			alert("I Cannot Both Remember And Forget You At The Same Time - Please Select Only One Or Neither");
			theForm.remember.style.background="#E5EBF9";
			theForm.forget.style.background="#E5EBF9";
			theForm.remember.focus();
			return false;
		}
	}
	return true;
}
</script>

<table width="950" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
<tr>
	<td width="250" align="center" valign="top">
		<br>
		<img src="images/GoogleLogo.gif" alt="Google" width="203" height="74" border="0">
	</td>
	<td width="700">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="1" height="40" border="0"></td>
		</tr>
		<tr>
			<td width="100%" height="25" bgcolor="#E5EBF9" style="border-top: 2px solid #3266CC;" class="bigBlack">&nbsp;&nbsp;<strong>Sign-In</strong></td>
		</tr>
		<tr>
			<td align="center">
				<img src="images/spacer.gif" alt="" width="1" height="50" border="0"><br>
				<form action="dbaccess.php" method="post" name="login" id="login" onSubmit="return validate(this);">
				<table width="400" border="0" cellspacing="4" cellpadding="0" align="center" style="border: 2px solid #E5EBF9;">
				<tr>
					<td bgcolor="#E5EBF9">
						<table width="100%" border="0" cellspacing="5" cellpadding="0" align="center">
						<tr>
							<td colspan="2" align="center" class="bodyBlack"><br><strong>Please enter your username and password.</strong><br><br></td>
						</tr>
						<tr>
							<td width="160" align="right" class="bodyBlack">Username:</td>
							<td width="240"><input type="text" name="username" id="username" value="" size="20" maxlength="50" style="width:150px;"></td>
						</tr>
						<tr>
							<td align="right" class="bodyBlack">Password:</td>
							<td><input type="password" name="password" id="password" size="20" maxlength="50" style="width:150px;"></td>
						</tr>
						<tr>
							<td colspan="2" align="center">
								<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td height="30" colspan="2" class="bodyBlack">
										<input type="checkbox" name="remember" id="remember" value="T">&nbsp;Remember me on this computer.
									</td>
								</tr>
								<tr>
									<td height="30" colspan="2" class="bodyBlack">
										<input type="checkbox" name="forget" id="forget" value="T">&nbsp;Forget me on this computer.
									</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td height="30" colspan="2" align="center" class="bodyBlack"><input type="submit" name="submit" id="submit" value="Submit"></td>
						</tr>
<?
if ($message != ""){
	echo'
						<tr>
							<td colspan="2" align="center" class="bodyBlack"><font color="#FF0000">'.stripslashes($message).'</font></td>
						</tr>
	';
}
?>
						</table>
					</td>	
				</tr>
				</table>
				<input type="hidden" name="task" id="task" value="login">
				</form>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>

<script>
if (readCookie('username')) login.username.value = readCookie('username');
if (readCookie('password')) login.password.value = readCookie('password');
</script>

<script>login.username.focus();</script>

<!-- END INCLUDE login.php -->
