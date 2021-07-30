<!doctype html public "-//w3c//dtd html 4.0 transitional//en">

<!--
Thank the Community Minded Companies
(I guess mine isn't one)

Design Copyright 2001 Network Resources
Images Copyright 2002 ISIGHT Center for the Blind
Authored by Jeff S. Saunders 05/30/2002
Modified by Jeff S. Saunders 08/20/2002
-->

<html>

<head>
	<title>Blind Center of Nevada</title>
</head>
	
<body bgcolor="white">

<table width="600" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="190" height="180" valign="top" align="left"><img src="media/blindcenterlogo180.jpg" alt="" width="180" height="140" border="0"><div align="center"><br><br><a href="index.php"><b>HOME</b></a></div></td>
	<td align="center" valign="top"><br>
		<table border="0" cellspacing="0" cellpadding="0" align="right">
		<tr>
			<td align="center"><font size="+1">We would like to thank the following community minded companies that have assisted the center in our mission:<br></font></td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<?
				// Connect to the database
				include "dbconnect.php";

				// Get the record
				$result = mysql_query("SELECT company_name, url FROM corppartners WHERE level = 'Benefactor' ORDER BY company_name", $linkID);
				if (mysql_num_rows($result) > 0){
					print "
						<tr>
							<td align=\"left\" valign=\"top\"><br><br><img src=\"media/tiranglebullet.jpg\" width=\"16\" height=\"18\" border=\"0\"><font size=\"+1\"> Benefactor Partners</font><br><br></td>
						</tr>";
					for ($counter=1; $counter <= mysql_num_rows($result); $counter++)
					{
						$row = mysql_fetch_assoc($result);
						if (!$row["url"]){
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b>".$row["company_name"]."</b></font></li></td></tr>";
						}else{
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b><a href=\"http://".$row["url"]."\">".$row["company_name"]."</a></b></font></li></td></tr>";
						}
					}
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<?
				// Connect to the database
				include "dbconnect.php";

				// Get the record
				$result = mysql_query("SELECT company_name, url FROM corppartners WHERE level = 'Advocate' ORDER BY company_name", $linkID);
				if (mysql_num_rows($result) > 0){
					print "
						<tr>
							<td align=\"left\" valign=\"top\"><br><br><img src=\"media/tiranglebullet.jpg\" width=\"16\" height=\"18\" border=\"0\"><font size=\"+1\"> Advocate Partners</font><br><br></td>
						</tr>";
					for ($counter=1; $counter <= mysql_num_rows($result); $counter++)
					{
						$row = mysql_fetch_assoc($result);
						if (!$row["url"]){
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b>".$row["company_name"]."</b></font></li></td></tr>";
						}else{
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b><a href=\"http://".$row["url"]."\">".$row["company_name"]."</a></b></font></li></td></tr>";
						}
					}
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<?
				// Connect to the database
				include "dbconnect.php";

				// Get the record
				$result = mysql_query("SELECT company_name, url FROM corppartners WHERE level = 'Patron' ORDER BY company_name", $linkID);
				if (mysql_num_rows($result) > 0){
					print "
						<tr>
							<td align=\"left\" valign=\"top\"><br><br><img src=\"media/tiranglebullet.jpg\" width=\"16\" height=\"18\" border=\"0\"><font size=\"+1\"> Patron Partners</font><br><br></td>
						</tr>";
					for ($counter=1; $counter <= mysql_num_rows($result); $counter++)
					{
						$row = mysql_fetch_assoc($result);
						if (!$row["url"]){
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b>".$row["company_name"]."</b></font></li></td></tr>";
						}else{
							print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b><a href=\"http://".$row["url"]."\">".$row["company_name"]."</a></b></font></li></td></tr>";
						}
					}
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<?
				// Connect to the database
				include "dbconnect.php";

				// Get the record
				$result = mysql_query("SELECT company_name FROM corppartners WHERE level = 'Associate' ORDER BY company_name", $linkID);
				if (mysql_num_rows($result) > 0){
					print "
						<tr>
							<td align=\"left\" valign=\"top\"><br><br><img src=\"media/tiranglebullet.jpg\" width=\"16\" height=\"18\" border=\"0\"><font size=\"+1\"> Associate Partners</font><br><br></td>
						</tr>";
					for ($counter=1; $counter <= mysql_num_rows($result); $counter++)
					{
						$row = mysql_fetch_assoc($result);
						print "<tr><td width=\"380\" align=\"left\"><font size=\"+2\"><li><b>".$row["company_name"]."</b></font></li></td></tr>";
					}
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table border="0" cellspacing="0" cellpadding="0" align="right">
				<?
				// Connect to the database
				include "dbconnect.php";

				// Get the record
				$result = mysql_query("SELECT company_name FROM corppartners WHERE level = 'Supporter' ORDER BY company_name", $linkID);
				if (mysql_num_rows($result) > 0){
					print "
						<tr>
							<td align=\"left\" valign=\"top\"><br><br><img src=\"media/tiranglebullet.jpg\" width=\"16\" height=\"18\" border=\"0\"><font size=\"+1\"> Supporters</font><br><br></td>
						</tr>";
					for ($counter=1; $counter <= mysql_num_rows($result); $counter++)
					{
						$row = mysql_fetch_assoc($result);
						print "<tr><td width=\"190\" align=\"left\"><li><font size=\"-1\"><b>".$row["company_name"]."</b></li></font></td>";
						$counter++;
						if ($counter <= mysql_num_rows($result))
						{
							$row = mysql_fetch_assoc($result);
							print "<td width=\"190\" align=\"left\" valign=\"top\"><li><font size=\"-1\"><b>".$row["company_name"]."</b></li></font></td>";
						}
						print "</tr>";
					}
				}
				?>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>

</body>
</html>
