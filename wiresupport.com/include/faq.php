<!-- BEGIN Include faq.php -->

<table width="920" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td width="199" align="center" valign="bottom" background="images/<? echo $tab; ?>" class="<? echo $tab_class; ?>"><strong>Common Questions</strong></td>
	<td><img src="images/spacer.gif" alt="" width="721" height="25" border="0"></td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFFF" style="border-left: 1px solid <? echo $border_color; ?>; border-right: 1px solid <? echo $border_color; ?>;">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/spacer.gif" alt="" width="0" height="400" border="0"></td>
			<td align="center" valign="top">
				<br><br>
				<table width="850" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
				<?
				// Not the most efficient way to do this, but the FAQ is short...
				$aFaq = explode(',',$faq); //from site config
				foreach($aFaq as $number){
					$query = "SELECT * FROM faq WHERE display = 'T' AND unique_id = '".$number."'";
					$result = mysql_query($query, $linkID);
					$row = mysql_fetch_assoc($result);
					echo'
				<tr>
					<td class="bodyBlack"><li><strong>'.$row["question"].'</strong></td>
				</tr>
				<tr>
					<td><ul>'.$row["answer"].'<br><br></td>
				</tr>
					';
				}
				?>
				</table>
				<br>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td colspan="2" bgcolor="<? echo $bar_color; ?>"><img src="images/spacer.gif" alt="" width="920" height="5" border="0"></td>
</tr>
</table>

<!-- END Include faq.php -->

