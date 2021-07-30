<?
session_start();

$item = 0;
while ($_SESSION['Item'.$item]){
	echo "Item # -> ".$item."<br>";
	echo "Item -> ".$_SESSION['Item'.$item]."<br>";
	echo "Title -> ".$_SESSION['Title'.$item]."<br>";
	echo "Image -> ".$_SESSION['Image'.$item]."<br>";
	echo "Color -> ".$_SESSION['Color'.$item]."<br>";
	echo "Size -> ".$_SESSION['Size'.$item]."<br>";
	echo "Width -> ".$_SESSION['Width'.$item]."<br>";
	echo "Quantity -> ".$_SESSION['Quantity'.$item]."<br>";
	echo "<br>";
	$item++;
}
echo "Email -> ".$_SESSION['Email']."<br>";
echo "FirstName -> ".$_SESSION['FirstName']."<br>";
echo "MiddleName -> ".$_SESSION['MiddleName']."<br>";
echo "LastName -> ".$_SESSION['LastName']."<br>";
echo "ShippingAddress -> ".$_SESSION['ShippingAddress']."<br>";
echo "ShippingApt -> ".$_SESSION['ShippingApt']."<br>";
echo "ShippingCity -> ".$_SESSION['ShippingCity']."<br>";
echo "ShippingState -> ".$_SESSION['ShippingState']."<br>";
echo "ShippingZipCode -> ".$_SESSION['ShippingZipCode']."<br>";
echo "BillingAddress -> ".$_SESSION['BillingAddress']."<br>";
echo "BillingApt -> ".$_SESSION['BillingApt']."<br>";
echo "BillingCity -> ".$_SESSION['BillingCity']."<br>";
echo "BillingState -> ".$_SESSION['BillingState']."<br>";
echo "BillingZipCode -> ".$_SESSION['BillingZipCode']."<br>";
echo "aRecord -v "."<pre>";
print_r($_SESSION['aRecord'])."</pre><br>";
echo "<br>";


echo "<strong>Raw ------v</strong><br>";
while (list($key, $value) = each($_SESSION)){
	echo $key." = ".$value."<br>"; 
}
?>
