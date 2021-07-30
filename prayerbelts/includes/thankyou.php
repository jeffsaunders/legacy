<!-- BEGIN Include thankyou.php -->

<?
// See if they are just being thanked for joining or contacting
if (isset($_REQUEST['for'])){
?>
<div id="contactUs">
	<div id="contactHeadline">Thank You</div>
	<div align="center" id="contactText">
		<?
		if ($_REQUEST['for'] == "contact"){
		?>
		<p>Thank you for contacting us.  Someone will get back to you within one (1) business day.</p>
		<?
		}elseif ($_REQUEST['for'] == "joining"){
		?>
		<p>Thank you for joining our mailing list.  You should begin receiving news and information from us soon.</p>
		<?
		}else{
		?>
		<p>Thank you for inquiry.</p>
		<?
		}
		?>
	</div>
</div>

<?
}elseif (isset($_REQUEST['from']) && $_REQUEST['from'] == "fdgg"){
	// Before you go on, record what happened...
	// Build a record, starting with what the bank sent back
	$aRecord = $_REQUEST;
	// Break out the elements contained within the approval code and add them individually
	$approvalCode = explode(":", $_REQUEST['approval_code']);
	$aRecord['ApprovalNumber'] = substr($approvalCode[1], 0, 6); // First 6 digits.
	$aRecord['ReferenceNumber'] = substr($approvalCode[1], -10); // Last 10 digits.
	$aRecord['AVSCode'] = substr($approvalCode[2], 0, 3); // First 3 characters.
	// Write all that to a session variable for later use
	$_SESSION['aRecord'] = $aRecord;
	// Add customer information captured locally
	$aRecord['SalesTax'] = $_SESSION['SalesTax'];
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
		$qty += $_SESSION['Quantity'.$item];
		$item++;
	}
	// Now commence to writin'
	// Load CSV library
	require_once("classes/MyCSV.class.php");
	// Create the file handle to the CSV file
	$orders = new MyCSV("csv/SuccessfulOrders.csv");
	// Make sure it exists - if not, create it and write the first record...
	if (!$orders->exists()){
		// Create (and open) the file
		$orders->write("csv/SuccessfulOrders.csv",",");
		// Add the keys as column headers
		foreach(array_keys($aRecord) as $key){
			$orders->add_field($key);
		}
		// Make sure we can store up to 10 items per order - create the rest
		for ($item=$item; $item <= 10; $item++){
			$orders->add_field('Item'.$item);
			$orders->add_field('Title'.$item);
			$orders->add_field('Color'.$item);
			$orders->add_field('Size'.$item);
			$orders->add_field('Width'.$item);
			$orders->add_field('Quantity'.$item);
		}
		// Write the record
		$orders->insert($aRecord);
		// Close the file
		$orders->write();
	// It exists...
	}else{
		// Make sure it is writable (should be unless it was messed with)
		if ($orders->is_writeable()){
			// Write the record
			$orders->insert($aRecord);
			// Close the file
			$orders->write();
		}else{
			die("Something bad happened - the 'Orders' file is not writable");
		}
	}

	// Now build the receipt email
	$to = $_SESSION['Email'];
//	$to = 'jeffsaunders@gmail.com'; //Testing
	$subject = 'Your Prayer Belts Order';
	$message = '
<html>
<body style="font:normal 11px Verdana, Arial, Helvetica, sans-serif;">
<table width="800" align="center">
<tr>
	<td>
		<table width="100%">
		<tr>
			<td><img src="http://www.prayerbelts.com/images/logo.gif" alt="Prayer Belts Logo" border="0"></td>
			<td align="right" valign="bottom"><strong>'.date("m/d/y").'</strong></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td><hr width="100%" size="2"></td>
</tr>
<tr>
	<td>
		<br>
		<font size="+2">Thank you for your order.</font><br>Your order number is: <strong>'.$aRecord['ReferenceNumber'].'</strong>, paid for with your: <strong>'.$_REQUEST['cardnumber'].'</strong>
		<br><br>
	</td>
</tr>
<tr>
	<td>
		<table width="100%">
		<tr>
			<td width="50%" align="center" valign="top">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Bill To:</td>
				</tr>
				<tr>
					<td>
						<strong>
						'.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>
						'.$_SESSION['BillingAddress'].' '.$_SESSION['BillingApt'].'<br>
						'.$_SESSION['BillingCity'].', '.$_SESSION['BillingState'].'&nbsp;&nbsp;'.$_SESSION['BillingZipCode'].'<br>
						</strong>
					</td>
				</tr>
				</table>
			</td>
			<td width="50%" align="center" valign="top">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Ship To:</td>
				</tr>
				<tr>
					<td>
						<strong>
						'.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>
						'.$_SESSION['ShippingAddress'].' '.$_SESSION['ShippingApt'].'<br>
						'.$_SESSION['ShippingCity'].', '.$_SESSION['ShippingState'].'&nbsp;&nbsp;'.$_SESSION['ShippingZipCode'].'<br>
						</strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<br>
		<table width="100%">
		<tr>
			<td width="440" align="center">Item</td>
			<td width="120" align="center">Quantity</td>
			<td width="120" align="right">Item Price</td>
			<td width="120" align="right">Item Total</td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
	';
	$item = 0;
	while ($_SESSION['Item'.$item]){
		if ($_SESSION['Quantity'.$item] > 0){
			$message .= '
		<tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90">MESSAGE:</td>
					<td width="350"><strong>'.$_SESSION['Title'.$item].'</strong></td>
				</tr>
				<tr>
					<td>COLOR:</td>
					<td><strong>'.$_SESSION['Color'.$item].'</strong></td>
				</tr>
				<tr>
					<td>SIZE:</td>
					<td><strong>'.$_SESSION['Size'.$item].'</strong></td>
				</tr>
				<tr>
					<td>WIDTH:</td>
					<td><strong>'.$_SESSION['Width'.$item].'</strong></td>
				</tr>
				</table>
			</td>
			<td align="center" valign="top"><strong>'.$_SESSION['Quantity'.$item].'</strong></td>
			<td align="right" valign="top"><strong>$'.number_format($_SESSION['Price'.$item], 2, '.', ',').'</strong></td>
			<td align="right" valign="top"><strong>$'.number_format($_SESSION['Price'.$item]*$_SESSION['Quantity'.$item], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
			';
			$subtotal += ($_SESSION['Price'.$item] * $_SESSION['Quantity'.$item]);
		}
		$item++;
	}
	$message .= '
		<tr>
			<td colspan="3" align="right">Subtotal:</td>
			<td align="right"><strong>$'.number_format($subtotal, 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Shipping &amp; Handling:</td>
			<td align="right"><strong>$'.number_format(ceil($qty/$config['shipping']['increment']) * $config['shipping']['cost'], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Sales Tax:</td>
			<td align="right"><strong>$'.number_format($_SESSION['SalesTax'], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="2"><hr width="100%" size="2"></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><strong><font size="+1">Total:</font></strong></td>
			<td align="right" valign="top"><strong><font size="+1">$'.number_format($_REQUEST['chargetotal'], 2, '.', ',').'</font></strong></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>

</html>
	';

	// Build PDF Packing Slip
	// Load PDF library
	require('fpdf/fpdf.php');
	// Create file
	$pdf = new FPDF('P','pt','Letter');
	// Create page
	$pdf->AddPage();
	// Set the margins
	$pdf->SetMargins(50,50,50);

	// Header
	// Logo
	$pdf->Image('images/logo.jpg',50,25,300,0,'JPG');
	// Set the font and finish printing the header
	$pdf->SetFont('Arial','',16);
	$pdf->Cell(0,75,'PACKING SLIP',0,0,'R');
	// Draw a line
	$pdf->Line(50,90,560,90);

	// Shipping Information
	// Move the the starting position
	$pdf->SetXY(50,110);
	// Set the font to bold & print label
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(75,15,'SHIP TO:',0,0,'L');
	// Set the font back to normal and print the customer name & order date
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(300,15,$_SESSION['FirstName'].' '.$_SESSION['LastName'],0,0,'L');
	$pdf->Cell(0,15,date("m/d/y"),0,1,'R');
	// Indent
	$pdf->SetX(125);
	// Street address
	$pdf->Cell(300,15,$_SESSION['ShippingAddress'].' '.$_SESSION['ShippingApt'],0,1,'L');
	// Indent
	$pdf->SetX(125);
	// Rest of address
	$pdf->Cell(300,15,$_SESSION['ShippingCity'].', '.$_SESSION['ShippingState'].'  '.$_SESSION['ShippingZipCode'],0,1,'L');
	// Move down
	$pdf->SetY($pdf->GetY()+45);

	// Order Number
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(135,15,'ORDER NUMBER:',0,0,'L');
	$pdf->SetFont('Arial','',14);
	$pdf->Cell(0,15,$aRecord['ReferenceNumber'],0,1,'L');

	// Details Header with border
	$pdf->SetY($pdf->GetY()+10);
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(80,25,'FEATURE','TLB',0,'L');
	$pdf->Cell(350,25,'ITEM','TB',0,'C');
	$pdf->Cell(0,25,'QUANTITY','TRB',1,'R');

	// Item Details
	$item = 0;
	while ($_SESSION['Item'.$item]){
		if ($_SESSION['Quantity'.$item] > 0){
			$pdf->SetY($pdf->GetY()+10);
			$pdf->SetFont('Arial','',14);
			$pdf->Cell(80,15,'MESSAGE:',0,0,'L');
			$pdf->Cell(355,15,$_SESSION['Title'.$item],0,0,'L');
			$pdf->Cell(75,15,$_SESSION['Quantity'.$item],0,1,'C');
			$pdf->Cell(80,15,'COLOR:',0,0,'L');
			$pdf->Cell(355,15,$_SESSION['Color'.$item],0,1,'L');
			$pdf->Cell(80,15,'SIZE:',0,0,'L');
			$pdf->Cell(355,15,$_SESSION['Size'.$item],0,1,'L');
			$pdf->Cell(80,15,'WIDTH:',0,0,'L');
			$pdf->Cell(355,15,$_SESSION['Width'.$item],0,1,'L');
			// Bottom Line
			$pdf->SetY($pdf->GetY()+10);
			$pdf->Line(50,$pdf->GetY(),560,$pdf->GetY());
		}
		$item++;
	}

	// Close and save the file
	$pdf->Output('csv/packingslips/'.$aRecord["ReferenceNumber"].'.pdf','F');

	// To send HTML mail, the Content-type header must be set
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Additional headers
	$headers .= 'From: Prayer Belts <sales@prayerbelts.com>' . "\r\n";
	$headers .= 'Bcc: sales@prayerbelts.com' . "\r\n";
	$headers .= 'Bcc: info@rmsglobal.net' . "\r\n";
//	$headers .= 'Bcc: jeffsaunders@gmail.com' . "\r\n";  //Testing
	
	// Mail it
	mail($to, $subject, $message, $headers);

	// Now build the order email and attach the packing slip
	// Since this has a binary attachment it's a little more "touchy" about formatting and the order things are set in - don't mess with it!
	$to = 'sales@prayerbelts.com';
//	$to = 'jeffsaunders@gmail.com'; //Testing
	$subject = 'New Prayer Belts Order';
	// HTML email body
	$message = '
<html>
<body style="font:normal 11px Verdana, Arial, Helvetica, sans-serif;">
<table width="800" align="center">
<tr>
	<td>
		<table width="100%">
		<tr>
			<td><img src="http://www.prayerbelts.com/images/logo.gif" alt="Prayer Belts Logo" border="0"></td>
			<td align="right" valign="bottom">Order Timestamp: <strong>'.$aRecord['txndate_processed'].'</strong></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td><hr width="100%" size="2"></td>
</tr>
<tr>
	<td>
		<font size="+2">New Order</font><br><br>
		<table>
		<tr>
			<td>Order Number:</td>
			<td><strong>'.$aRecord['ReferenceNumber'].'</strong></td>
		</tr>
		<tr>
			<td>Payment Method:</td>
			<td><strong>'.$_REQUEST['cardnumber'].'</strong>&nbsp;&nbsp;Exp. <strong>'.$_REQUEST['expmonth'].'/'.$_REQUEST['expyear'].'</strong></td>
		</tr>
		<tr>
			<td>Approval Code:</td>
			<td><strong>'.$aRecord['ApprovalNumber'].'</strong></td>
		</tr>
		<tr>
			<td>AVS Code:</td>
			<td><strong>'.$aRecord['AVSCode'].'</strong></td>
		</tr>
		</table>
		<br>
	</td>
</tr>
<tr>
	<td>
		<table width="100%">
		<tr>
			<td width="50%" align="center" valign="top">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Bill To:</td>
				</tr>
				<tr>
					<td>
						<strong>
						'.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>
						'.$_SESSION['BillingAddress'].' '.$_SESSION['BillingApt'].'<br>
						'.$_SESSION['BillingCity'].', '.$_SESSION['BillingState'].'&nbsp;&nbsp;'.$_SESSION['BillingZipCode'].'<br>
						'.$_SESSION['Email'].'<br>
						</strong>
					</td>
				</tr>
				</table>
			</td>
			<td width="50%" align="center" valign="top">
				<table width="95%" border="1" cellspacing="0" cellpadding="5" align="center">
				<tr>
					<td>Ship To:</td>
				</tr>
				<tr>
					<td>
						<strong>
						'.$_SESSION['FirstName'].' '.$_SESSION['LastName'].'<br>
						'.$_SESSION['ShippingAddress'].' '.$_SESSION['ShippingApt'].'<br>
						'.$_SESSION['ShippingCity'].', '.$_SESSION['ShippingState'].'&nbsp;&nbsp;'.$_SESSION['ShippingZipCode'].'<br>
						<br>
						</strong>
					</td>
				</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<br>
		<table width="100%">
		<tr>
			<td width="440" align="center">Item</td>
			<td width="120" align="center">Quantity</td>
			<td width="120" align="right">Item Price</td>
			<td width="120" align="right">Item Total</td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
	';
	$item = 0;
	while ($_SESSION['Item'.$item]){
		if ($_SESSION['Quantity'.$item] > 0){
			$message .= '
		<tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td width="90">MESSAGE:</td>
					<td width="350"><strong>'.$_SESSION['Title'.$item].'</strong></td>
				</tr>
				<tr>
					<td>COLOR:</td>
					<td><strong>'.$_SESSION['Color'.$item].'</strong></td>
				</tr>
				<tr>
					<td>SIZE:</td>
					<td><strong>'.$_SESSION['Size'.$item].'</strong></td>
				</tr>
				<tr>
					<td>WIDTH:</td>
					<td><strong>'.$_SESSION['Width'.$item].'</strong></td>
				</tr>
				</table>
			</td>
			<td align="center" valign="top"><strong>'.$_SESSION['Quantity'.$item].'</strong></td>
			<td align="right" valign="top"><strong>$'.number_format($_SESSION['Price'.$item], 2, '.', ',').'</strong></td>
			<td align="right" valign="top"><strong>$'.number_format($_SESSION['Price'.$item]*$_SESSION['Quantity'.$item], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="5"><hr width="100%" size="2"></td>
		</tr>
			';
			$subtotal += ($_SESSION['Price'.$item] * $_SESSION['Quantity'.$item]);
		}
		$item++;
	}
	$message .= '
		<tr>
			<td colspan="3" align="right">Subtotal:</td>
			<td align="right"><strong>$'.number_format($subtotal, 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Shipping &amp; Handling:</td>
			<td align="right"><strong>$'.number_format(ceil($qty/$config['shipping']['increment']) * $config['shipping']['cost'], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="3" align="right">Sales Tax:</td>
			<td align="right"><strong>$'.number_format($_SESSION['SalesTax'], 2, '.', ',').'</strong></td>
		</tr>
		<tr>
			<td colspan="2"></td>
			<td colspan="2"><hr width="100%" size="2"></td>
		</tr>
		<tr>
			<td colspan="3" align="right"><strong><font size="+1">Total:</font></strong></td>
			<td align="right" valign="top"><strong><font size="+1">$'.number_format($_REQUEST['chargetotal'], 2, '.', ',').'</font></strong></td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>

</html>
	';

	// Generate a random hash for the content boundries
	$random_hash = strtoupper(md5(uniqid(time())));
	// As referenced to above, this is specifically in this order
	$headers = "From: Prayer Belts <sales@prayerbelts.com>\r\nReply-To: Prayer Belts <sales@prayerbelts.com>";
	$headers .= "Bcc: info@rmsglobal.net";
	$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
	// chunk up the attachment as an encoded block
	$attachment = chunk_split(base64_encode(file_get_contents("csv/packingslips/".$aRecord["ReferenceNumber"].".pdf")));
	// Once again, order is important!!
	/*
	To add a plain-text version add the following lines between
			Content-Type: multipart/alternative; boundary='PHP-alt-$random_hash' (2nd after "output=")
	and
			--PHP-mixed-$random_hash (3rd after "output=")
	below:
			--PHP-alt-$random_hash
			Content-Type: text/plain; charset='iso-8859-1'
			Content-Transfer-Encoding: 7bit

			$text;
	Of course, assign the plain-text content to the $text variable first.
	*/

	$output = "
--PHP-mixed-$random_hash;
Content-Type: multipart/alternative; boundary='PHP-alt-$random_hash'
--PHP-mixed-$random_hash
Content-Type: text/html; charset='iso-8859-1'
Content-Transfer-Encoding: 7bit

$message;

--PHP-mixed-$random_hash
Content-Type: application/pdf; name=PackingSlip_".$aRecord["ReferenceNumber"].".pdf
Content-Transfer-Encoding: base64
Content-Disposition: attachment

$attachment

--PHP-mixed-$random_hash--";

	echo @mail($to, $subject, $output, $headers);

//die();	

	// Then tell them what happened, breaking out of the iframe to do it
?>
<script>
	top.location = "/?sec=thankyou";
</script>
<?
}else{
	if (!$_SESSION['Item0']){ //No session, send 'em home (probably refreshed the receipt page after session killed)
//		header("Location: /");
?>
<script>
	window.location = "/";
</script>
<?
	}
?>

<!-- Thank You page -->
<div id="thankYou">
	<div id="thankYouHeadline">Thank You for Your Order</div>
	<div id="cartContents">
		<table cellspacing="10" cellpadding="0">
		<tr>
			<td colspan="5" align="center">
				<br>
				Your order number is: <strong><?=$_SESSION['aRecord']['ReferenceNumber'];?></strong>, paid for with your: <strong><?=$_SESSION['aRecord']['cardnumber'];?></strong><br>
				A copy of this order confirmation has been emailed to: <strong><?=$_SESSION['Email'];?></strong>
				<br><br>
			</td>
		</tr>
		<tr>
			<td colspan="5">
				<table width="100%">
				<tr>
					<td width="50%">
						<table width="95%" cellspacing="0" cellpadding="5">
						<tr>
							<td class="cartDetailHeader roundedCorners">Bill To:</td>
						</tr>
						<tr>
							<td class="roundedBottoms">
								<?=$_SESSION['FirstName'].' '.$_SESSION['LastName'];?><br>
								<?=$_SESSION['BillingAddress'].' '.$_SESSION['BillingApt'];?><br>
								<?=$_SESSION['BillingCity'].', '.$_SESSION['BillingState'].'&nbsp;&nbsp;'.$_SESSION['BillingZipCode'];?><br>
							</td>
						</tr>
						</table>
					</td>
					<td width="50%" align="right">
						<table width="95%" cellspacing="0" cellpadding="5" align="right">
						<tr>
							<td class="cartDetailHeader roundedCorners">Ship To:</td>
						</tr>
						<tr>
							<td class="roundedBottoms">
								<?=$_SESSION['FirstName'].' '.$_SESSION['LastName'];?><br>
								<?=$_SESSION['ShippingAddress'].' '.$_SESSION['ShippingApt'];?><br>
								<?=$_SESSION['ShippingCity'].', '.$_SESSION['ShippingState'].'&nbsp;&nbsp;'.$_SESSION['ShippingZipCode'];?><br>
							</td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
				<br>
			</td>
		</tr>
		<tr>
			<td width="160" class="cartDetailHeader roundedCorners">Item</td>
			<td width="380" class="cartDetailHeader roundedCorners">Attributes</td>
			<td width="120" class="cartDetailHeader roundedCorners">Quantity</td>
			<td width="120" class="cartDetailHeader roundedCorners">Item Price</td>
			<td width="120" class="cartDetailHeader roundedCorners">Item Total</td>
		</tr>
		<?
		$item = 0;
		while ($_SESSION['Item'.$item]){
			if ($_SESSION['Quantity'.$item] > 0){
		?>
		<tr>
			<td valign="top"><img src="images/products/<?=$_SESSION['Image'.$item];?>" alt="" width="" height="" border="0" class="detailImage roundedCorners"></td>
			<td valign="top">
				<table cellspacing="0" cellpadding="0">
				<tr>
					<td width="90"><strong>MESSAGE:</strong></td>
					<td width="260"><?=$_SESSION['Title'.$item];?></td>
				</tr>
				<tr>
					<td><strong>COLOR:</strong></td>
					<td><?=$_SESSION['Color'.$item];?></td>
				</tr>
				<tr>
					<td><strong>SIZE:</strong></td>
					<td><?=$_SESSION['Size'.$item];?></td>
				</tr>
				<tr>
					<td><strong>WIDTH:</strong></td>
					<td><?=$_SESSION['Width'.$item];?></td>
				</tr>
				</table>
			</td>
			<td align="center" valign="top">
				<?=$_SESSION['Quantity'.$item];?>
			</td>
			<td align="right" valign="top">$<?=number_format($_SESSION['Price'.$item], 2, '.', ',');?></td>
			<td align="right" valign="top">$<?=number_format($_SESSION['Price'.$item]*$_SESSION['Quantity'.$item], 2, '.', ',');?></td>
		</tr>
		<!-- Seperator -->
		<tr>
			<td colspan="5"><hr width="100%" size="2" color="#F0F0F0"></td>
		</tr>
		<?
				$qty += $_SESSION['Quantity'.$item];
				$subtotal += ($_SESSION['Price'.$item] * $_SESSION['Quantity'.$item]);
			}
			$item++;
		}
		?>
		<tr>
			<td colspan="4" align="right"><strong>Subtotal:</strong></td>
			<td align="right"><strong>$<?=number_format($subTotal, 2, '.', ',');?></strong></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><strong>Shipping &amp; Handling:</strong></td>
			<td align="right"><strong>$<?=number_format(ceil($qty/$config['shipping']['increment']) * $config['shipping']['cost'], 2, '.', ',');?></strong></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><strong>Sales Tax:</strong></td>
			<td align="right"><strong>$<?=number_format($_SESSION['SalesTax'], 2, '.', ',');?></strong></td>
		</tr>
		<tr>
			<td colspan="4" align="right"><strong>Total:</strong></td>
			<td align="right" valign="top"><strong style="font-size:18px;">$<?=number_format($_SESSION['aRecord']['chargetotal'], 2, '.', ',');?></strong></td>
		</tr>
		</table>
	</div>
</div>

<?
	// Kill the old session!
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_destroy();
}
?>

<!-- END Include thankyou.php -->
