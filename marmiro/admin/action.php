<?
// Interrogate and reassign passed variables
$sec = $_REQUEST['sec'];
//$anchor = $_REQUEST['anchor'];
//$message = $_REQUEST['message'];
//$cargo = $_REQUEST['cargo'];
$task = $_REQUEST['task'];

// Connect to the database
include "../dbconnect.php";

// Grab my PHP functions library
include("../functions.php");

// Now, what to do...what to do?
switch($_REQUEST['task']){


///////////////////////////////////////
// Global Settings
case "editConfig":	// Update the site configuration information
	$query = sprintf(
		"UPDATE config SET
		title = '".$_REQUEST['title']."',
		description = '".$_REQUEST['description']."',
		keywords = '".$_REQUEST['keywords']."',
		facebook = '".$_REQUEST['facebook']."',
		twitter = '".$_REQUEST['twitter']."',
		youtube = '".$_REQUEST['youtube']."',
		request_thankyou = '".$_REQUEST['request_thankyou']."',
		contact_thankyou = '".$_REQUEST['contact_thankyou']."',
		slideshow_sort = '".$_REQUEST['slideshow_sort']."'");
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Global Website Configuration Updated";
	// Send 'em back
	header("Location: /admin/?sec=site&message=$message");
	exit;


///////////////////////////////////////
// Home Page
case "slideshowImagesPosition":	// Rearrange the slideshow image positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE slideshow
			SET	position = ".$_REQUEST['position'.$counter]."
			WHERE unique_id = ".$_REQUEST['id'.$counter]);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
	}
	// Tell 'em what you did
	$message = "Image Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=home&page=slideshow&message=$message");
	exit;

case "addSlideshowImage":	// Add a new blank slideshow image
	$query = sprintf(
		'INSERT INTO slideshow (
			image,
			description,
			position,
			display)
			VALUES (
			"NoImage.jpg",
			"New Blank Image",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Image Added";
	// Send 'em back
	header("Location: /admin/?sec=home&page=slideshow&message=$message");
	exit;

case "editSlideshowImage":	// Update the slideshow image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		//chmod($_FILES['newimage']['tmp_name'], 0755);
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], "'".dirname(__FILE__)."/../images/slideshow/" . basename($_FILES['newimage']['name'])."'")) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/slideshow/".basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			chmod(dirname(__FILE__)."/../images/slideshow/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE slideshow SET
			image = '".$_REQUEST['image']."',
			description = '".$_REQUEST['description']."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=home&page=slideshow&message=$message");
	exit;

case "deleteSlideshowImage":	// Delete a slideshow image
	$query = sprintf(
		"DELETE FROM slideshow
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_delete = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Slideshow Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=home&page=slideshow&message=$message");
	exit;


///////////////////////////////////////
// About Menu
// Events
case "addEvent":	// Add a new blank event
	$query = sprintf(
		'INSERT INTO events (
			event,
			start_date,
			end_date,
			display)
			VALUES (
			"NEW EVENT - EDIT ME",
			now(),
			now(),
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Event Added";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listevents&message=$message");
	exit;

case "editEvent":	// Update the event's information
	$query = sprintf(
		"UPDATE events SET
		event = '".$_REQUEST['event']."',
		start_date = '".$_REQUEST['start_date']."',
		end_date = '".$_REQUEST['end_date']."',
		location1 = '".$_REQUEST['location1']."',
		location2 = '".$_REQUEST['location2']."',
		link = '".$_REQUEST['link']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Event Information Updated";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listevents&message=$message");
	exit;

case "deleteEvent":	// Delete an event
	$query = sprintf(
		"DELETE FROM events
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Event Deleted";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listevents&message=$message");
	exit;

// References
case "referencesPositions":	// Rearrange the references positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `references`
			SET	position = ".$_REQUEST['position'.$counter]."
			WHERE unique_id = ".$_REQUEST['id'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "References Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listreferences&message=$message");
	exit;

case "addReference":	// Add a new blank reference
	$query = sprintf(
		'SELECT MAX(unique_id) as max
		FROM `references`');
//exit($query.'<br></br>');
	$rs_getmax = mysql_query($query, $linkID);
	$getmax = mysql_fetch_assoc($rs_getmax);
	$query = sprintf(
		'INSERT INTO `references` (
			unique_id,
			reference,
			location,
			position,
			display)
			VALUES (
			'.($getmax["max"]+1).',
			"NEW REFERENCE - EDIT ME",
			"NEW LOCATION",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Reference Added";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listreferences&message=$message");
	exit;

case "editReference":	// Update the reference's information
	$query = sprintf(
		"UPDATE `references` SET
		reference = '".$_REQUEST['reference']."',
		location = '".$_REQUEST['location']."',
		link = '".$_REQUEST['link']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Reference Information Updated";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listreferences&message=$message");
	exit;

case "deleteReference":	// Delete a reference
	// First, delete it
	$query = sprintf(
		"DELETE FROM `references`
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_delete = mysql_query($query, $linkID);
	// Then see how many are left
	$query = sprintf(
		"SELECT COUNT(*) FROM `references`");
//exit($query.'<br></br>');
	$rs_count = mysql_query($query, $linkID);
	$count = mysql_fetch_array($rs_count);
	$records = $count["0"];
	// Then shift the remaining records to fill in the gap
	for ($counter=1; $counter <= $records; $counter++){
		// See if this is the gap
		$query = sprintf(
			"SELECT unique_id FROM `references`
			WHERE unique_id = ".$counter);
//exit($query.'<br></br>');
		$rs_checkit = mysql_query($query, $linkID);
		// If it is the gap...
		if (mysql_num_rows($rs_checkit) == 0){
			// assign the missing number to the next row
			$query = sprintf(
				"UPDATE `references` SET
				unique_id = ".$counter."
				WHERE unique_id = ".($counter + 1));
//exit($query.'<br></br>');
			$rs_update = mysql_query($query, $linkID);
		}
		// Rinse, repeat.
	}
	// Tell 'em what you did
	$message = "Reference Deleted";
	// Send 'em back
	header("Location: /admin/?sec=about&page=listreferences&message=$message");
	exit;


///////////////////////////////////////
// Products Menu
case "positionProductCategories":	// Rearrange the product category positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `product_types`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Product Category Positions Updated";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addProductCategory":	// Add a new blank product gallery image
	$query = sprintf(
		'INSERT INTO product_types (
			product,
			label,
			description,
			position)
			VALUES (
			"New Product Name",
			"New Product Label",
			"EDIT ME!",
			0)');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Product Category Added";
	// Send 'em back
	header("Location: /admin/?sec=products&page=listproductcategories&message=$message");
	exit;

case "editProductCategory":	// Update the product category information
	$message = "";
	$query = sprintf(
		"UPDATE product_types SET
		product = '".$_REQUEST['product']."',
		label = '".$_REQUEST['label']."',
		description = '".addslashes($_REQUEST['description'])."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message .= "Product Category Information Updated";
	// Send 'em back
	header("Location: /admin/?sec=products&page=listproductcategories&message=$message");
	exit;

case "deleteProductCategory":	// Delete a product category
	$query = sprintf(
		"DELETE FROM product_types
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Product Category Deleted";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".$_REQUEST['return']."&message=$message");
	exit;

case "positionProductImages":	// Rearrange the product gallery images positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `gallery`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Product Gallery Images Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addProductImage":	// Add a new blank product gallery image
	$query = sprintf(
		'INSERT INTO gallery (
			product_id,
			image,
			description,
			position,
			display)
			VALUES (
			'.$_REQUEST['id'].',
			"NoImage.jpg",
			"New Blank Image",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Image Added";
	// Send 'em back
	header("Location: /admin/?sec=products&page=listproductimages&id=".$_REQUEST['id']."&message=$message");
	exit;

case "editProductImage":	// Update the product gallery image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], dirname(__FILE__)."/../images/gallery/" . basename($_FILES['newimage']['name']))) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/gallery/" . basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			// Make it readable
			chmod(dirname(__FILE__)."/../images/gallery/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE gallery SET
			image = '".$_REQUEST['image']."',
			description = '".addslashes($_REQUEST['description'])."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=products&page=listproductimages&id=".$_REQUEST['id']."&message=$message");
	exit;

case "deleteProductImage":	// Delete a product gallery image
	$query = sprintf(
		"DELETE FROM gallery
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Product Gallery Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".$_REQUEST['return']."&id=".$_REQUEST['id']."&message=$message");
	exit;

case "positionProducts":	// Rearrange the products display positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `products`
			SET	position = ".$_REQUEST['position'.$counter]."
			WHERE product_id = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Products Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".$_REQUEST['return']."&message=$message");
	exit;

case "addProduct":	// Add a new product
	$query = sprintf(
		"INSERT INTO products (
			product_type,
			material,
			model,
			image1,
			position,
			display)
			VALUES (
			'".$_REQUEST['product_type']."',
			'".$_REQUEST['material']."',
			'NEW PRODUCT - EDIT ME',
			'NoImage.jpg',
			0,
			'F')");
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Product Added";
	// Send 'em back
	header("Location: /admin/?sec=products".$_REQUEST['return']."&message=$message");
	exit;

case "editProduct":	// Update product information

//exit($_FILES['newimage']['error'][0]);
foreach ($_FILES['newimage']['error'] as $key => $error){
//exit($error);
//   if ($error == UPLOAD_ERR_OK) {
//       echo"$error_codes[$error]";
//       move_uploaded_file(
//         $_FILES["pictures"]["tmp_name"][$key],
//         $_FILES["pictures"]["name"][$key]
//       ) or die("Problems with upload");

		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'][$key].'" "'.dirname(__FILE__)."/../images/products/" . basename($_FILES['newimage']['name'][$key]).'"';
//exit($cmd);
		exec($cmd, $output, $return);
//	}
}



//exit(print_r($file));

	$query = 
		"UPDATE `products` SET
		model = '".$_REQUEST['model']."',
		description = '".$_REQUEST['description']."',
		image1 = '".$_REQUEST['image1']."',
		label1 = '".$_REQUEST['label1']."',
		image2 = '".$_REQUEST['image2']."',
		label2 = '".$_REQUEST['label2']."',
		image3 = '".$_REQUEST['image3']."',
		label3 = '".$_REQUEST['label3']."',
		image4 = '".$_REQUEST['image4']."',
		label4 = '".$_REQUEST['label4']."',
		image5 = '".$_REQUEST['image5']."',
		label5 = '".$_REQUEST['label5']."',
		image6 = '".$_REQUEST['image6']."',
		label6 = '".$_REQUEST['label6']."',
		bundle = '".$_REQUEST['bundle']."',
		show_details = '".$_REQUEST['show_details']."',
		breakdown = '".addslashes($_REQUEST['breakdown'])."',
		finishes = '".$_REQUEST['finishes']."',
		edges = '".$_REQUEST['edges']."',
		thicknesses = '".$_REQUEST['thicknesses']."',
		types = '".$_REQUEST['types']."',
		sizes = '".$_REQUEST['sizes']."',
		colors = '".$_REQUEST['colors']."',
		packaging = '".$_REQUEST['packaging']."',
		note = '".$_REQUEST['note']."',
		display = '".$_REQUEST['display']."'
		WHERE product_id = ".$_REQUEST['product_id'];
//		colors = '".htmlentities(addslashes($_REQUEST['colors']),ENT_QUOTES,'UTF-8')."',
//alert($query);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Product Updated";
	// Send 'em back
	header("Location: /admin/?sec=products".$_REQUEST['return']."&message=$message");
	exit;

case "deleteProduct":	// Delete a product
	$query = sprintf(
		"DELETE FROM products
		WHERE product_id = ".$_REQUEST['product_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Product Deleted";
	// Send 'em back
	header("Location: /admin/?sec=products&page=".$_REQUEST['return']."&cargo=".$_REQUEST['cargo']."&message=$message");
	exit;


///////////////////////////////////////
// Tech Specs Menu
// Technical Specifications
case "positionTechSpecs":	// Rearrange the technical specifications positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `tech_specs`
			SET	position = ".$_REQUEST['position'.$counter]."
			WHERE unique_id = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Technical Specifications Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;

case "addTechSpec":	// Add a new spec
	$query = sprintf(
		"INSERT INTO tech_specs (
			category,
			sample,
			dry_psi,
			wet_psi,
			cf_dry,
			cf_wet,
			water_absorption_pct,
			bulk_density,
			position,
			display)
			VALUES (
			'".$_REQUEST['category']."',
			'NEW SPECIFICATION - EDIT ME',
			0,
			0,
			0,
			0,
			0,
			0,
			0,
			'F')");
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Specification Row Added";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;

case "editSpecs":	// Update technical specifications information
	$query = sprintf(
		"UPDATE `tech_specs` SET
		category = '".$_REQUEST['category']."',
		label = '".$_REQUEST['label']."',
		sample = '".$_REQUEST['sample']."',
		dry_psi = ".iif(isset($_REQUEST['dry_psi']),$_REQUEST['dry_psi'],0).",
		wet_psi = ".iif(isset($_REQUEST['wet_psi']),$_REQUEST['wet_psi'],0).",
		finish = '".$_REQUEST['finish']."',
		size = '".$_REQUEST['size']."',
		cf_dry = ".iif(isset($_REQUEST['cf_dry']),$_REQUEST['cf_dry'],0).",
		cf_wet = ".iif(isset($_REQUEST['cf_wet']),$_REQUEST['cf_wet'],0).",
		result = '".$_REQUEST['result']."',
		notes = '".$_REQUEST['notes']."',
		water_absorption_pct = ".iif(isset($_REQUEST['water_absorption_pct']),$_REQUEST['water_absorption_pct'],0).",
		bulk_density = ".iif(isset($_REQUEST['bulk_density']),$_REQUEST['bulk_density'],0).",
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Technical Specifications Updated";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;

case "deleteTechSpec":	// Delete a technical specification
	$query = sprintf(
		"DELETE FROM tech_specs
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Technical Specification Deleted";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;

// Packaging
case "positionPkgSpecs":	// Rearrange the packaging specifications positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		if ($_REQUEST['cargo'] == "veneervarious"){
			$query = sprintf(
				"UPDATE `packaging`
				SET	`order` = ".$_REQUEST['position'.$counter]."
				WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
		}else{
			$query = sprintf(
				"UPDATE `packaging`
				SET	`position` = ".$_REQUEST['position'.$counter]."
				WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
		}
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Packaging Specifications Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addPkgSpec":	// Add a new packaging spec
	$query = sprintf(
		"INSERT INTO packaging (
			`material`,
			`group`,
			`order`,
			`position`,
			`display`)
			VALUES (
			'".urldecode($_REQUEST['material'])."',
			'".urldecode($_REQUEST['group'])."',
			0,
			0,
			'F')");
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Packaging Specification Row Added";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;

case "editPkgSpec":	// Update packaging specifications information
	$query = sprintf(
		"UPDATE `packaging` SET
		type = '".$_REQUEST['type']."',
		size = '".$_REQUEST['size']."',
		thickness = '".$_REQUEST['thickness']."',
		sqf_crate = '".$_REQUEST['sqf_crate']."',
		qty_crate = '".$_REQUEST['qty_crate']."',
		qty_bundle = '".$_REQUEST['qty_bundle']."',
		lbs_crate = '".$_REQUEST['lbs_crate']."',
		crate_type = '".$_REQUEST['crate_type']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Packaging Specifications Updated";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "deletePkgSpec":	// Delete a packaging specification
	$query = sprintf(
		"DELETE FROM packaging
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Packaging Specification Deleted";
	// Send 'em back
	header("Location: /admin/?sec=technical&page=".$_REQUEST['return']."&message=$message");
	exit;


///////////////////////////////////////
// Production Menu
// Factories
case "positionFactoryImages":	// Rearrange the factory images positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `gallery`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Factory Images Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addFactoryImage":	// Add a new blank factory image
	$query = sprintf(
		'INSERT INTO gallery (
			product_id,
			image,
			description,
			position,
			display)
			VALUES (
			200,
			"NoImage.jpg",
			"New Blank Image",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Image Added";
	// Send 'em back
	header("Location: /admin/?sec=production&page=listfactoryimages&message=$message");
	exit;

case "editFactoryImage":	// Update the factory image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']))) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			// Make it readable
			chmod(dirname(__FILE__)."/../images/locations/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE gallery SET
			image = '".$_REQUEST['image']."',
			description = '".$_REQUEST['description']."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=production&page=listfactoryimages&message=$message");
	exit;

case "deleteFactoryImage":	// Delete a factory image
	$query = sprintf(
		"DELETE FROM gallery
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Factory Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".$_REQUEST['return']."&message=$message");
	exit;
	
// Quarries
case "positionQuarries":	// Rearrange the quarry positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `locations`
			SET	`tab_position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Quarry Display Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addQuarry":	// Add a new quarry
//	$query = sprintf(
//		"SELECT MAX(facility_id) as max
//		FROM `locations`
//		WHERE `facility_type` = 'Quarries'");
	$query = sprintf(
		"SELECT MAX(facility_id) as max
		FROM `locations`");
//exit($query.'<br></br>');
	$rs_getmax = mysql_query($query, $linkID);
	$getmax = mysql_fetch_assoc($rs_getmax);
	$query = sprintf(
		'INSERT INTO locations (
			facility_id,
			tab_label,
			facility_name,
			facility_type,
			location,
			location_type,
			description,
			tab_position,
			position,
			display)
			VALUES (
			'.($getmax["max"]+1).',
			"New Tab",
			"New Quarry - EDIT ME",
			"Quarries",
			"New Location - EDIT ME",
			"Production",
			"New Description - EDIT ME",
			0,
			1,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Quarry Added";
	// Send 'em back
	header("Location: /admin/?sec=production&page=listquarries&message=$message");
	exit;

case "editQuarry":	// Update the quarry information
	$query = sprintf(
		"UPDATE locations SET
		tab_label = '".$_REQUEST['facility_name']."',
		facility_name = '".$_REQUEST['facility_name']."',
		location = '".$_REQUEST['location']."',
		description = '".$_REQUEST['description']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message .= "Quarry Information Updated";
	// Send 'em back
	header("Location: /admin/?sec=production&page=listquarries&message=$message");
	exit;

case "deleteQuarry":	// Delete a Quarry
	$query = sprintf(
		"DELETE FROM locations
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Quarry Deleted";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".$_REQUEST['return']."&message=$message");
	exit;

case "positionQuarryImages":	// Rearrange the quarry images positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `gallery`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Quarry Image Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addQuarryImage":	// Add a new quarry image
	$query = sprintf(
		'INSERT INTO gallery (
			product_id,
			image,
			description,
			position,
			display)
			VALUES (
			'.($_REQUEST["id"]).',
			"NoImage.jpg",
			"New Blank Image - EDIT ME",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Quarry Image Added";
	// Send 'em back
	header("Location: /admin/?sec=production&page=listquarryimages&id=".$_REQUEST["id"]."&message=$message");
	exit;

case "editQuarryImage":	// Update the quarry image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']))) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			// Make it readable
			chmod(dirname(__FILE__)."/../images/locations/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE gallery SET
			image = '".$_REQUEST['image']."',
			description = '".$_REQUEST['description']."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=production&page=listquarryimages&id=".$_REQUEST["id"]."&message=$message");
	exit;

case "deleteQuarryImage":	// Delete a Quarry Image
	$query = sprintf(
		"DELETE FROM gallery
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Quarry Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=production&page=".$_REQUEST['return']."&id=".$_REQUEST['id']."&message=$message");
	exit;

///////////////////////////////////////
// Portfolio Menu
// Residential
case "positionResidentialImages":	// Rearrange the residential images positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `gallery`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Residential Images Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addResidentialImage":	// Add a new blank residential image
	$query = sprintf(
		'INSERT INTO gallery (
			product_id,
			image,
			description,
			position,
			display)
			VALUES (
			101,
			"NoImage.jpg",
			"New Blank Image",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Image Added";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listresidentialimages&message=$message");
	exit;

case "editResidentialImage":	// Update the residential image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']))) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			// Make it readable
			chmod(dirname(__FILE__)."/../images/locations/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE gallery SET
			image = '".$_REQUEST['image']."',
			description = '".$_REQUEST['description']."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listresidentialimages&message=$message");
	exit;

case "deleteResidentialImage":	// Delete a residential image
	$query = sprintf(
		"DELETE FROM gallery
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Residential Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".$_REQUEST['return']."&message=$message");
	exit;

// Commercial
case "positionCommercial":	// Rearrange the commercial properties positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `locations`
			SET	`tab_position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Commercial Portfolio Display Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addCommercial":	// Add a new commercial property
	$query = sprintf(
		"SELECT MAX(facility_id) as max
		FROM `locations`");
//exit($query.'<br></br>');
	$rs_getmax = mysql_query($query, $linkID);
	$getmax = mysql_fetch_assoc($rs_getmax);
	$query = sprintf(
		'INSERT INTO locations (
			facility_id,
			tab_label,
			facility_name,
			facility_type,
			size,
			products,
			location_type,
			tab_position,
			position,
			display)
			VALUES (
			'.($getmax["max"]+1).',
			"EDIT ME",
			"New Quarry - EDIT ME",
			"Commercial",
			"",
			"",
			"Portfolio",
			0,
			99,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Commercial Property Added";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listcommercial&message=$message");
	exit;

case "editCommercial":	// Update the commercial property information
	$query = sprintf(
		"UPDATE locations SET
		tab_label = '".$_REQUEST['tab_label']."',
		facility_name = '".$_REQUEST['facility_name']."',
		size = '".$_REQUEST['size']."',
		products = '".$_REQUEST['products']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message .= "Commercial Property Information Updated";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listcommercial&message=$message");
	exit;

case "deleteCommercial":	// Delete a commercial property
	$query = sprintf(
		"DELETE FROM locations
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Commercial Property Deleted";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".$_REQUEST['return']."&message=$message");
	exit;

case "positionCommercialImages":	// Rearrange the commercial images positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `gallery`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Commercial Property Image Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addCommercialImage":	// Add a new commercial property image
	$query = sprintf(
		'INSERT INTO gallery (
			product_id,
			image,
			description,
			position,
			display)
			VALUES (
			'.($_REQUEST["id"]).',
			"NoImage.jpg",
			"New Blank Image - EDIT ME",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "New Commercial Property Image Added";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listcommercialimages&id=".$_REQUEST["id"]."&message=$message");
	exit;

case "editCommercialImage":	// Update the commercial image information
	$message = "";
	$update = true;
	// Was a file uploaded?
	if (is_uploaded_file($_FILES['newimage']['tmp_name'])){
		// move uploaded file
//error_reporting(E_ALL);
//ini_set("display_errors", 1); 
//		if (move_uploaded_file($_FILES['newimage']['tmp_name'], dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']))) {
		$cmd = 'mv "'.$_FILES['newimage']['tmp_name'].'" "'.dirname(__FILE__)."/../images/locations/" . basename($_FILES['newimage']['name']).'"';
//exit($cmd);
		exec($cmd, $output, $return);
		if($return == 0) { 
			// Make it readable
			chmod(dirname(__FILE__)."/../images/locations/".basename($_FILES['newimage']['name']), 0755);
			// Move successful
			$message .= "File Uploaded Successfully and ";
		}else{
			// Move failed
			$message .= "Image Upload Failed - Image Information NOT Updated";
			// Abort update
			$update = false;
		}
//exit(dirname(__FILE__).'<br></br>');
	}
	if ($update == true){
		$query = sprintf(
			"UPDATE gallery SET
			image = '".$_REQUEST['image']."',
			description = '".$_REQUEST['description']."',
			display = '".$_REQUEST['display']."'
			WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
		$rs_update = mysql_query($query, $linkID);
		// Tell 'em what you did
		$message .= "Image Information Updated";
	}
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=listcommercialimages&id=".$_REQUEST["id"]."&message=$message");
	exit;

case "deleteCommercialImage":	// Delete a Commercial Propertry Image
	$query = sprintf(
		"DELETE FROM gallery
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Commercial Property Image Deleted";
	// Send 'em back
	header("Location: /admin/?sec=portfolio&page=".$_REQUEST['return']."&id=".$_REQUEST['id']."&message=$message");
	exit;


///////////////////////////////////////
// Miscellaneous Items
// FAQ
case "positionFAQ":	// Rearrange the FAQ positions
	for ($counter=1; $counter <= $_REQUEST['counter']; $counter++){
		$query = sprintf(
			"UPDATE `faq`
			SET	`position` = ".$_REQUEST['position'.$counter]."
			WHERE `unique_id` = ".$_REQUEST['uid'.$counter]);
//echo $query.'<br></br>';
		$rs_update = mysql_query($query, $linkID);
	}
//exit('done');
	// Tell 'em what you did
	$message = "Questions Order Updated";
	// Send 'em back
	header("Location: /admin/?sec=misc&page=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "addFAQ":	// Add a new faq
	$query = sprintf(
		'INSERT INTO faq (
			line,
			question,
			answer,
			position,
			display)
			VALUES (
			"'.urldecode($_REQUEST['line']).'",
			"New Question - EDIT ME",
			"New Answer - EDIT ME",
			0,
			"F")');
//exit($query.'<br></br>');
	$rs_insert = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "Blank Image Added";
	// Send 'em back
	header("Location: /admin/?sec=misc&page=listfaq&cargo=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "editFAQ":	// Update FAQ information
	$query = sprintf(
		"UPDATE `faq` SET
		line = '".$_REQUEST['line']."',
		question = '".$_REQUEST['question']."',
		answer = '".$_REQUEST['answer']."',
		display = '".$_REQUEST['display']."'
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "FAQ Updated";
	// Send 'em back
	header("Location: /admin/?sec=misc&page=listfaq&cargo=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

case "deleteFAQ":	// Delete a faq
	$query = sprintf(
		"DELETE FROM faq
		WHERE unique_id = ".$_REQUEST['unique_id']);
//exit($query.'<br></br>');
	$rs_update = mysql_query($query, $linkID);
	// Tell 'em what you did
	$message = "FAQ Deleted";
	// Send 'em back
	header("Location: /admin/?sec=misc&page=listfaq&cargo=".urldecode($_REQUEST['return'])."&message=$message");
	exit;

}; // End Switch
?>

