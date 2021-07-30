<?
// Grab session
session_start();
// If the cart is empty, go back to the cart page
if (!$_SESSION['Item0']){
	header("Location: /?sec=cart");
}
// Get configuration settings
$xml = simplexml_load_file('xml/config.xml');
$json = json_encode($xml);
$config = json_decode($json, TRUE);
?>

<?
// Calculate totals
$item = 0;
while ($_SESSION['Item'.$item]){
//	echo "<br>";
//	echo $item."<br>";
//	echo $_SESSION['Item'.$item]."<br>";
//	echo $_SESSION['Title'.$item]."<br>";
//	echo $_SESSION['Image'.$item]."<br>";
//	echo $_SESSION['Color'.$item]."<br>";
//	echo $_SESSION['Size'.$item]."<br>";
//	echo $_SESSION['Width'.$item]."<br>";
//	echo $_SESSION['Quantity'.$item]."<br>";
//	echo $_SESSION['Price'.$item]."<br><br>";
	$quantity += $_SESSION['Quantity'.$item];
	$subTotal += $_SESSION['Price'.$item];
	$item++;
}
$shipping = ceil($quantity/$config['shipping']['increment']) * $config['shipping']['cost'];
//echo $shipping."<br>";
$taxTotal = $subTotal + $shipping; //Shipping is taxable in Texas
//echo $taxTotal."<br>";
$tax = round((($taxTotal*$config['salesTax']['rate'])/100), 2);
//echo $tax."<br>";
$total = $taxTotal + $tax;
//echo $total."<br>";
?>

<?
// Grab SHA Code
include("includes/fdgg-util_sha2.php");
?>

<!-- Build form to post -->
<!-- Testing -->
<!--<form action="https://connect.merchanttest.firstdataglobalgateway.com/IPGConnect/gateway/processing" method="POST" name="checkoutForm" id="checkoutForm">-->
<!-- Production -->
<form action="https://connect.firstdataglobalgateway.com/IPGConnect/gateway/processing" method="post" name="checkoutForm" id="checkoutForm">
<input type="hidden" name="authenticateTransaction" value="false"> <!-- Don't use 3-D security -->
<input type="hidden" name="txntype" value="sale">
<input type="hidden" name="timezone" value="<?=getTimezone();?>">
<input type="hidden" name="txndatetime" value="<?=getDateTime();?>">
<input type="hidden" name="hash" value="<?=createHash(number_format($total,2));?>">
<input type="hidden" name="storename" value="<?=getStorename();?>">
<input type="hidden" name="mode" value="fullpay"> <!-- All checkout forms hosted -->
<input type="hidden" name="chargetotal" value="<?=number_format($total,2);?>">
<!--<input type="hidden" name="oid" value="<?//=session_id();?>">-->
<input type="hidden" name="subtotal" value="<?=number_format($subTotal,2);?>">
<input type="hidden" name="tax" value="<?=number_format($tax,2);?>">
<input type="hidden" name="shipping" value="<?=number_format($shipping,2);?>">
<input type="hidden" name="trxOrigin" value="ECI"> <!-- Internet sale -->
<!--
<input size="50" type="hidden" name="paymentMethod" value="<?php// echo $_REQUEST["paymentMethod"] ?>"/> 
<input size="50" type="hidden" name="tdate" value="<?php// echo $_REQUEST["tdate"] ?>"/> 
-->
</form> 

<script>
	// Send it to FDGG
	document.forms['checkoutForm'].submit();
</script>

