<!-- BEGIN INCLUDE Partners -->

<table width="100%" border="0" cellspacing="0" cellpadding="2">
<tr>
	<td width="250" align="left" valign="top"><img src="images/spacer.gif" alt="" width="2" height="5" border="0"><br><img src="images/reflections200.gif" alt="" width="200" height="164" border="0"></td>
	<td width="350" valign="middle" class="bigBlack"><br><strong>The efforts of the Blind Center of Nevada are carried out with the help and support of community minded companies and volunteers.<br><br>The list of community minded companies that have assisted the Center in our mission include:</strong><br></td>
	<td>&nbsp;</td>
</tr>
</table>

<table width="600" border="0" cellspacing="0" cellpadding="10">
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
		// Benefactors
		// Connect to the database
		include "dbconnect.php";
		// Build Query
		$query = "SELECT company_name, url FROM corppartners WHERE level = 'Benefactor' AND active = 'T' ORDER BY company_name";
		// Get the record
		$result = mysql_query( $query, $linkID);
		if (mysql_num_rows($result) > 0){
			echo '
				<tr>
					<td colspan="2" align="left" valign="top" class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Benefactor Partners<br><img src="images/blackdot.gif" alt="" width="600" height="1" border="0"><br></td>
				</tr>
			';
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				if (!$row["url"]){
					echo '<tr><td width="50%" align="left" valign="top" class="xbigBlack"><li><strong>'.$row["company_name"].'</strong></li></td>';
				}else{
					echo '<tr><td width="50%" align="left" valign="top" class="xbigBlack"><li><strong><a href="http://'.$row["url"].'" target="_blank" class="xbigBlack">'.$row["company_name"].'</a></strong></li></td>';
				}
				$counter++;
				if ($counter <= mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					if (!$row["url"]){
						echo '<td width="50%" align="left" valign="top" class="xbigBlack"><li><strong>'.$row["company_name"].'</strong></li></td>';
					}else{
						echo '<td width="50%" align="left" valign="top" class="xbigBlack"><li><strong><a href="http://'.$row["url"].'" target="_blank" class="xbigBlack">'.$row["company_name"].'</a></strong></li></td>';
					}
				}
				echo '</tr>';
			}
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
		// Advocates
		// Build Query
		$query = "SELECT company_name, url FROM corppartners WHERE level = 'Advocate' AND active = 'T' ORDER BY company_name";
		// Get the record
		$result = mysql_query( $query, $linkID);
		if (mysql_num_rows($result) > 0){
			echo '
				<tr>
					<td colspan="2" align="left" valign="top" class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Advocate Partners<br><img src="images/blackdot.gif" alt="" width="600" height="1" border="0"><br></td>
				</tr>
			';
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				if (!$row["url"]){
					echo '<tr><td width="50%" align="left" valign="top" class="bigBlack"><li><strong>'.$row["company_name"].'</strong></li></td>';
				}else{
					echo '<tr><td width="50%" align="left" valign="top" class="bigBlack"><li><strong><a href="http://'.$row["url"].'" target="_blank" class="bigBlack">'.$row["company_name"].'</a></strong></li></td>';
				}
				$counter++;
				if ($counter <= mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					if (!$row["url"]){
						echo '<td width="50%" align="left" valign="top" class="bigBlack"><li><strong>'.$row["company_name"].'</strong></li></td>';
					}else{
						echo '<td width="50%" align="left" valign="top" class="bigBlack"><li><strong><a href="http://'.$row["url"].'" target="_blank" class="bigBlack">'.$row["company_name"].'</a></strong></li></td>';
					}
				}
				echo '</tr>';
			}
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
		// Associates
		// Build Query
		$query = "SELECT company_name, url FROM corppartners WHERE level = 'Associate' AND active = 'T' ORDER BY company_name";
		// Get the record
		$result = mysql_query( $query, $linkID);
		if (mysql_num_rows($result) > 0){
			echo '
				<tr>
					<td colspan="2" align="left" valign="top" class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Associate Partners<br><img src="images/blackdot.gif" alt="" width="600" height="1" border="0"><br></td>
				</tr>
			';
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				if (!$row["url"]){
					echo '<tr><td width="50%" align="left" valign="top" class="bigBlack"><li>'.$row["company_name"].'</li></td>';
				}else{
					echo '<tr><td width="50%" align="left" valign="top" class="bigBlack"><li><a href="http://'.$row["url"].'" target="_blank" class="bigBlack">'.$row["company_name"].'</a></li></td>';
				}
				$counter++;
				if ($counter <= mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					if (!$row["url"]){
						echo '<td width="50%" align="left" valign="top" class="bigBlack"><li>'.$row["company_name"].'</li></td>';
					}else{
						echo '<td width="50%" align="left" valign="top" class="bigBlack"><li><a href="http://'.$row["url"].'" target="_blank" class="bigBlack">'.$row["company_name"].'</a></li></td>';
					}
				}
				echo '</tr>';
			}
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td valign="top">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<?
		// Supporters
		// Build Query
		$query = "SELECT company_name, url FROM corppartners WHERE level = 'Supporter' AND active = 'T' ORDER BY company_name";
		// Get the record
		$result = mysql_query( $query, $linkID);
		if (mysql_num_rows($result) > 0){
			echo '
				<tr>
					<td colspan="2" align="left" valign="top" class="xbigBlack"><br><img src="images/trianglebullet.gif" width="16" height="18" border="0"> Supporters<br><img src="images/blackdot.gif" alt="" width="600" height="1" border="0"><br></td>
				</tr>
			';
			for ($counter=1; $counter <= mysql_num_rows($result); $counter++){
				$row = mysql_fetch_assoc($result);
				if (!$row["url"]){
					echo '<tr><td width="50%" align="left" valign="top" class="bodyBlack"><li>'.$row["company_name"].'</li></td>';
				}else{
					echo '<tr><td width="50%" align="left" valign="top" class="bodyBlack"><li><a href="http://'.$row["url"].'" target="_blank" class="bodyBlack">'.$row["company_name"].'</a></li></td>';
				}
				$counter++;
				if ($counter <= mysql_num_rows($result)){
					$row = mysql_fetch_assoc($result);
					if (!$row["url"]){
						echo '<td width="50%" align="left" valign="top" class="bodyBlack"><li>'.$row["company_name"].'</li></td>';
					}else{
						echo '<td width="50%" align="left" valign="top" class="bodyBlack"><li><a href="http://'.$row["url"].'" target="_blank" class="bodyBlack">'.$row["company_name"].'</a></li></td>';
					}
				}
				echo '</tr>';
			}
		}
		?>
		</table>
	</td>
</tr>
<tr>
	<td align="right" class="xbigBlack">Want to help too?&nbsp;&nbsp;<a href="?sec=reflections" class="xbigBlack">Click here for more information.</a> <img src="images/trianglebullet.gif" width="16" height="18" border="0"></td>
</tr>
</table>

<!-- END INCLUDE Partners -->
