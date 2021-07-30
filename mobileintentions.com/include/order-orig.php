<!-- BEGIN Include order.php -->

<?
// Write name, email, and zipcode to tracking database
//mysql_select_db("tracking", $linkID);
//$query = "INSERT INTO tracking (timestamp, name, zipcode, email) VALUES (NOW(),'$_GET[\'name\']','$zipcode','$_GET[\'email\']')";
//$query = "INSERT INTO tracking (timestamp, name, zipcode, email) VALUES (NOW(),'$_SESSION[\"zipcode\"]')";
//echo $query;
//$result = mysql_query($query, $linkID);
		// Not found
//		if (mysql_num_rows($result) < 1){
//			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for UNKNOWN LOCATION &nbsp;'.$zipcode.'</strong>';
		// Gotcha!
//		}else{
//			$row = mysql_fetch_assoc($result);
//			echo'<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Online Prices for '.$row["pref_city_state_name"].', '.$row["state"].' &nbsp;'.$zipcode.'</strong>';
//		};
		// Switch back
//		mysql_select_db("mobileintentions", $linkID);
		?>

<table width="780" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Label Tab -->
	<td height="24" colspan="3" background="images/TabTop.gif" class="bodyWhite">
		<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="bodyWhite"><strong>&nbsp;&nbsp;Secure Order System</strong></td>
			<!-- Site Seal -->
			<td valign="bottom">&nbsp;&nbsp;<script type="text/javascript">TrustLogo("/images/Padlock.gif", "SC","none");</script></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<!-- Left border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
	<!-- Content -->
	<td align="center">
		<iframe src="javascript:void(0)" name="body" id="body" width="921" height="520" marginwidth="0" marginheight="0" align="top" frameborder="0" allowtransparency="true"></iframe>
	</td>
	<!-- Right border -->
	<td width="2" bgcolor="#E20074">
		<img src="images/spacer.gif" alt="" width="2" height="2" border="0">
	</td>
</tr>
<tr>
	<!-- iframe footer -->
	<td width="100%" height="15" colspan="3" bgcolor="#E20074" class="smallWhite">
		<img src="images/spacer.gif" alt="" width="1" height="15" border="0">
	</td>
</tr>
</table>

<!--<br><br><br><div align="center"><font size="+1"><strong>Transferring . . .</strong></font></div>-->
<form action="https://www.wbsrecords.com/data/PhoneSelect.asp" method="post" name="order" id="order" target="body">
	<input name="ClientID" type="hidden" value="178"> <!--mobileintentions.com-->
	<input name="PhoneID" type="hidden" value="<? echo $prod_id; ?>">
</form>
<script>document.order.submit();</script>

<!-- END Include order.php -->	