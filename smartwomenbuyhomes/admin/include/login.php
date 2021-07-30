<form action="" method="post" name="loginForm" id="loginForm"> 
<table>
<tr>
	<td colspan="2"><h2>Administrator Login</h2></td>
</tr>
<tr>
	<td>Username:</td>
	<td><input id="userName" name="userName" type="text" style="width:154px;"></td>
</tr>
<tr>
	<td>Password:</td>
	<td><input id="password" name="password" type="password" style="width:150px;"></td>
</tr>
<tr>
	<td colspan="2"><br><input type="submit" name="loginButton" id="loginButton" value="Log In"></td>
</tr>
<tr>
	<td colspan="2"><p><strong><font color="#FF0000"><?php echo ($message) ? $message : ''; ?></font></strong></p></td>
</tr>
</table>
</form>
			
