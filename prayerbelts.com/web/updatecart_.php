<?
session_start();
//die();
switch($_REQUEST['Task']){

case "AddToCart": // Put an item in the cart
	$counter = 0;
	while (true){ // Do until I say stop
		if (isset($_SESSION['Item'.$counter]) && $_SESSION['Item'.$counter] == $_REQUEST['Item']){
			$_SESSION['Quantity'.$counter] += 1;
			break;
		}
		if (!$_SESSION['Item'.$counter]){
			$_SESSION['Item'.$counter] = $_REQUEST['Item'];
			$_SESSION['Title'.$counter] = $_REQUEST['Title'];
			$_SESSION['Image'.$counter] = $_REQUEST['Image'];
			$_SESSION['Color'.$counter] = $_REQUEST['Color'];
			$_SESSION['Size'.$counter] = $_REQUEST['Size'];
			$_SESSION['Width'.$counter] = $_REQUEST['Width'];
			$_SESSION['Price'.$counter] = $_REQUEST['Price'];
			$_SESSION['Quantity'.$counter] = 1;
			break;
		}
		$counter++;
	}
	header("Location: /?sec=cart");
	exit;

case "UpdateItem": // Update the quantity of an item
	$_SESSION['Quantity'.$_REQUEST['ItemNum']] = $_REQUEST['Quantity'];
	header("Location: /?sec=cart");
	exit;

case "RemoveItem": // Remove an item from the cart by changing it's quantity to zero
	$_SESSION['Quantity'.$_REQUEST['ItemNum']] = 0;
	header("Location: /?sec=cart");
	exit;

case "DestroyCart": // Wipe the cart completely out
	// Kill the old session!
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time()-42000, '/');
	session_destroy();
	header("Location: /?sec=cart");
	exit;

}; // End Switch
?>
