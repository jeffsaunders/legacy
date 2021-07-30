<!-- BEGIN Include declined.php -->

<?
$status = $_REQUEST['status'];
$message = $_REQUEST['fail_reason'];
// If we are just getting the decline from the bank, store it first
if (isset($_REQUEST['from']) && $_REQUEST['from'] == "fdgg"){
	// Before you go, record what happened...
	// Build a record, starting with what the bank sent back
	$aRecord = $_REQUEST;
	// Add customer information captured locally
	$aRecord['Email'] = $_SESSION['Email'];
	$aRecord['FirstName'] = $_SESSION['FirstName'];
	$aRecord['MiddleName'] = $_SESSION['MiddleName'];
	$aRecord['LastName'] = $_SESSION['LastName'];
	$aRecord['ShippingAddress'] = $_SESSION['ShippingAddress'];
	$aRecord['ShippingApt'] = $_SESSION['ShippingApt'];
	$aRecord['ShippingCity'] = $_SESSION['ShippingCity'];
	$aRecord['ShippingState'] = $_SESSION['ShippingState'];
	$aRecord['ShippingZipCode'] = $_SESSION['ShippingZipCode'];
	$aRecord['BillingAddress'] = $_SESSION['BillingAddress'];
	$aRecord['BillingApt'] = $_SESSION['BillingApt'];
	$aRecord['BillingCity'] = $_SESSION['BillingCity'];
	$aRecord['BillingState'] = $_SESSION['BillingState'];
	$aRecord['BillingZipCode'] = $_SESSION['BillingZipCode'];
	// Finally, add the items they were buying
	$item = 0;
	while ($_SESSION['Item'.$item]){
		$aRecord['Item'.$item] = $_SESSION['Item'.$item];
		$aRecord['Title'.$item] = $_SESSION['Title'.$item];
		$aRecord['Color'.$item] = $_SESSION['Color'.$item];
		$aRecord['Size'.$item] = $_SESSION['Size'.$item];
		$aRecord['Width'.$item] = $_SESSION['Width'.$item];
		$aRecord['Quantity'.$item] = $_SESSION['Quantity'.$item];
		$item++;
	}
	// Now commence to writin'
	// Load CSV library
	require_once("classes/MyCSV.class.php");
	// Create the file handle to the CSV file
	$fails = new MyCSV("csv/FailedOrders.csv");
	// Make sure it exists - if not, create it and write the first record...
	if (!$fails->exists()){
		// Create (and open) the file
		$fails->write("csv/FailedOrders.csv",",");
		// Add the keys as column headers
		foreach(array_keys($aRecord) as $key){
			$fails->add_field($key);
		}
		// Make sure we can store up to 10 items per order - create the rest
		for ($item=$item; $item <= 10; $item++){
			$fails->add_field('Item'.$item);
			$fails->add_field('Title'.$item);
			$fails->add_field('Color'.$item);
			$fails->add_field('Size'.$item);
			$fails->add_field('Width'.$item);
			$fails->add_field('Quantity'.$item);
		}
		// Write the record
		$fails->insert($aRecord);
		// Close the file
		$fails->write();
	// It exists...
	}else{
		// Make sure it is writable (should be unless it was messed with)
		if ($fails->is_writeable()){
			// Write the record
			$fails->insert($aRecord);
			// Close the file
			$fails->write();
		}else{
			die("Something bad happened - the 'Declines' file is not writable");
		}
	}
//die();
	// Then tell them what happened, breaking out of the iframe to do it
?>
<script>
	top.location = "/?sec=declined&status=<?=$status;?>&fail_reason=<?=$message;?>";
</script>
<?
}
?>

<div id="declined">
	<div id="declinedHeadline">We're Sorry</div>
	<div id="declinedText">
		There seems to be a problem with your order.  The bank returned the following error message:
		<br><br>
		<table>
		<tr>
			<td>Payment Status:</td>
			<td><strong><?=$status;?></strong></td>
		</tr>
		<tr>
			<td>Details (If Any):</td>
			<td><strong><?=$message;?></strong></td>
		</tr>
		</table>
		<br>
		We truly appreciate your business.  As a convenience, your shopping cart and checkout information has been saved.  If you wish to try checking out again, please click <a href="/?sec=checkout">HERE</a> or click the orange "Checkout" button found in the far upper-right corner.
	</div>
</div>

<!-- END Include declined.php -->
