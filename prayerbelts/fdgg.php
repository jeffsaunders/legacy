<?
// grab session
session_start();
// if the cart is empty, go back to the cart page
if (!$_SESSION['Item0']){
//	header("Location: /?sec=cart");
?>	
<script>
	top.location = "/?sec=cart";
</script>
<?
}

// get configuration settings
$xml = simplexml_load_file('xml/config.xml');
$json = json_encode($xml);
$config = json_decode($json, true);

// calculate totals
$item = 0;
while ($_SESSION['Item'.$item]){
	$quantity += $_SESSION['Quantity'.$item];
	$subTotal += ($_SESSION['Price'.$item] * $_SESSION['Quantity'.$item]) * (isset($_SESSION['ItemDiscount']) ? $_SESSION['ItemDiscount'] : 1);
	$item++;
}
$shipping = ceil($quantity/$config['shipping']['increment']) * $config['shipping']['cost'] * (isset($_SESSION['ShippingDiscount']) ? $_SESSION['ShippingDiscount'] : 1);
// Test if ShippingState is among those we collect tax for
$taxTotal = $subTotal;
$tax = 0;
for ($cnt=0; $cnt < sizeof($config['salesTax']); $cnt++){
	// if the shipping state is found, add tax
	if($config['salesTax'][$cnt]['state'] == $_SESSION['ShippingState']){
		if($config['salesTax'][$cnt]['taxShipping'] == "Y"){
			$taxTotal = $subTotal + $shipping; //shipping is taxable in Texas, etc.
		}
		$tax = round((($taxTotal*$config['salesTax'][$cnt]['rate'])/100), 2);
	}
}
// Store the sales tax
$_SESSION['SalesTax'] = $tax;
$total = $taxTotal + $tax;
if ($taxTotal == $subTotal){ // Shipping not already added pre-tax
	$total += $shipping;
}
//echo $shipping."<br>";
//echo $taxTotal."<br>";
//echo $tax."<br>";
//echo $subTotal."<br>";
//echo $total."<br>";
//die();

// Passing "&test=Y" submits a $0 charge for testing
if ($_REQUEST['test'] == "Y"){
	$shipping = 0;
	$taxtotal = 0;
	$tax = 0;
	$subTotal = 0;
	$total = 0;
}

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
	<input type="hidden" name="hash" value="<?=createHash(number_format($total,2,'.',''));?>">
	<input type="hidden" name="storename" value="<?=getStorename();?>">
<!--<input type="hidden" name="storename" value="1909834738">-->
	<input type="hidden" name="mode" value="payonly"> <!-- Only run the card -->
	<input type="hidden" name="chargetotal" value="<?=number_format($total,2,'.','');?>">
	<input type="hidden" name="subtotal" value="<?=number_format($subTotal,2,'.','');?>">
	<input type="hidden" name="tax" value="<?=number_format($tax,2);?>">
	<input type="hidden" name="shipping" value="<?=number_format($shipping,2,'.','');?>">
	<input type="hidden" name="trxOrigin" value="ECI"> <!-- Internet sale -->
	<input type="hidden" name="bname" value="<?=$_SESSION['FirstName']." ".$_SESSION['LastName'];?>">
	<input type="hidden" name="baddr1" value="<?=$_SESSION['BillingAddress'];?>">
	<input type="hidden" name="bcity" value="<?=$_SESSION['BillingCity'];?>">
	<input type="hidden" name="bstate" value="<?=$_SESSION['BillingState'];?>">
	<input type="hidden" name="bcountry" value="US">
	<input type="hidden" name="bzip" value="<?=$_SESSION['BillingZipCode'];?>">
<!--<input type="hidden" name="cardnumber" value="4111111111111111">-->
</form> 

<?//die();?>

<script>
	// Send to FDGG
	document.forms['checkoutForm'].submit();
</script>

