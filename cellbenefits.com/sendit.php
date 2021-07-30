<form action="http://216.131.124.157/palm.php" method="post" name="PushOrder" id="PushOrder">
<!--<form action="boo.php" method="post" name="PushOrder" id="PushOrder">-->
<?
// Connect to the database
include "dbconnect.php";
$query = "SELECT * FROM orders WHERE session_id = '4cdb7b179724f93fa4e043a981e8ab37'";
//echo $query;
$result = mysql_query($query, $linkID);
$fields = mysql_num_fields($result);
$row = mysql_fetch_assoc($result);
$i = 0; 
while ($i < $fields){
	echo '	<input type="hidden" name="'.mysql_field_name($result, $i).'" id="'.mysql_field_name($result, $i).'" value="'.$row[mysql_field_name($result, $i)].'">
';
	$i++; 
} 
mysql_free_result($result);
//	<td align="'.iif(mysql_field_type($result, $i)=="real","right","left").'" valign="top"><nobr>'.$row[mysql_field_name($result, $i)].'</nobr></td>';
?>
	<input type="hidden" name="delivery_time" id="delivery_time" value="<? echo date('Y-m-d H:i:s'); ?>">
	<input type="submit">
</form>
<script>
//function boo(id){
//	var date = new Date();
//	var year = date.getFullYear();
//	var month = date.getMonth() + 1;
//	var day = date.getDate();
//	var hour = date.getHours();
//	var minute = date.getMinutes();
//	var second = date.getSeconds();
//	var now = year + "-" + month + "-" + day + " " + hour + ":" + minute + ":" + second;
	
//document.getElementById(id).delivery_time.value
//	PushOrder.delivery_time.value=now;
//alert(document.PushOrder.confirm_time.value);
//response.write(document.PushOrder.session_id.value);
//alert(now);
//alert(document.getElementById("PushOrder").confirm_time.value);
//alert(id);

//}
//boo(form.PushOrder);

//PushOrder.submit();
</script>
