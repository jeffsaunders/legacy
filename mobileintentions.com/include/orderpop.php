<br><br><br><div align="center"><font size="+1"><strong>Transferring . . .</strong></font></div>
<?
$prod_id = $_GET['prod'];
echo'
<form action="https://www.wbsrecords.com/data/PhoneSelect.asp" method="post" name="order" id="order" target="_self">
	<input name="ClientID" type="hidden" value="178"> <!--mobileintentions.com-->
	<input name="PhoneID" type="hidden" value="'.$prod_id.'">
</form>
';
?>

<script>document.order.submit();</script>