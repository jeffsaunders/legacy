<!-- BEGIN Include terms.php -->

<table width="930" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center" bgcolor="<? echo $content_bgcolor; ?>">
	
	<!-- Step Label -->
		
		<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
		<table width="900" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td class="superbigBlack">Terms & Conditions</td>
		</tr>
		</table>
		<script>
		function CheckIsIE(){
			if (navigator.appName.toUpperCase() == 'MICROSOFT INTERNET EXPLORER'){
				return true;
			}else{
				return false;
			}
		}
		</script>
<?
// Sprint-Nextel sites
if ($sprint_site == "T" || $nextel_site == "T" ){
?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
		<tr bgcolor="<? echo $border_bgcolor; ?>">
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="200" align="right">&nbsp;</td>
			<td height="30" width="498" align="center" class="bodyWhite" style="padding:5px;">&nbsp;<strong>Sprint Terms &amp; Conditions</strong></td>
			<td width="200" align="right"><a href="javascript:PrintSprint();" class="smallWhite"><strong>Print Sprint Terms</strong></a>&nbsp;&nbsp;</td>
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr>
			<td width="100%" colspan="3">
				<script>
				function PrintSprint(){
					if (CheckIsIE() == true){
						document.sprint.focus();
						document.sprint.print();
					}else{
						window.frames['sprint'].focus();
						window.frames['sprint'].print();
					}
				}
				</script> 
				<iframe src="include/SprintTerms.php" name="sprint" id="sprint" width="900" height="200" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
			</td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="900" height="1" border="0"></td>
		</tr>
		</table>
<?
}
// AT&T sites
if ($cingular_site == "T"){
?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
		<tr bgcolor="<? echo $border_bgcolor; ?>">
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="200" align="right">&nbsp;</td>
			<td height="30" width="498" align="center" class="bodyWhite" style="padding:5px;">&nbsp;<strong>AT&amp;T Terms &amp; Conditions</strong></td>
			<td width="100" align="right"><a href="javascript:PrintSprint();" class="smallWhite"><strong>Print AT&amp;T Terms</strong></a>&nbsp;&nbsp;</td>
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr>
			<td width="100%" colspan="3">
				<script>
				function PrintATT(){
					if (CheckIsIE() == true){
						document.att.focus();
						document.att.print();
					}else{
						window.frames['att'].focus();
						window.frames['att'].print();
					}
				}
				</script> 
				<iframe src="include/AT&TTerms.php" name="att" id="att" width="900" height="200" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
			</td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="900" height="1" border="0"></td>
		</tr>
		</table>
<?
}
// Verizon sites
if ($verizon_site == "T"){
?>
		<br>
		<table width="900" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
		<tr bgcolor="<? echo $border_bgcolor; ?>">
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
			<td width="200" align="right">&nbsp;</td>
			<td height="30" width="498" align="center" class="bodyWhite" style="padding:5px;">&nbsp;<strong>Verizon Wireless Terms &amp; Conditions</strong></td>
			<td width="200" align="right"><a href="javascript:PrintSprint();" class="smallWhite"><strong>Print Verizon Terms</strong></a>&nbsp;&nbsp;</td>
			<td rowspan="99" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="1" height="1" border="0"></td>
		</tr>
		<tr>
			<td width="100%" colspan="3">
				<script>
				function PrintVerizon(){
					if (CheckIsIE() == true){
						document.verizon.focus();
						document.verizon.print();
					}else{
						window.frames['verizon'].focus();
						window.frames['verizon'].print();
					}
				}
				</script> 
				<iframe src="include/VerizonTerms.php" name="verizon" id="verizon" width="900" height="200" marginwidth="5" marginheight="5" align="top" scrolling="yes" frameborder="0"></iframe>
			</td>
		</tr>
		<tr>
			<td colspan="3" bgcolor="<? echo $border_bgcolor; ?>"><img src="images/spacer.gif" alt="" width="900" height="1" border="0"></td>
		</tr>
		</table>
<?
}
?>
		<br>
	</td>
</tr>
</table>

<!-- END Include terms.php -->
