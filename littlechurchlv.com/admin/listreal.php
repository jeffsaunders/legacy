<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?

// Functions

// Break apart a path to a filename into array elements
function myglob ($pattern) {
	$path_parts = pathinfo ($pattern);
	$pattern = '^' . str_replace (array ('*',  '?'), array ('(.+)', '(.)'), $path_parts['basename'] . '$');
	$dir = opendir ($path_parts['dirname']);
	while ($file = readdir ($dir)) {
		if (ereg ($pattern, $file)) $result[] = "{$path_parts['dirname']}/$file";
	}
	closedir ($dir);
	if (isset($result))return $result;
	return (array) null;
}

// Sort an array into "natural" order...as a human would order it
function compare($a, $b) {
	return strnatcasecmp($a[0], $b[0]);
}

// Search for the first occurance of a passed value in ANY element of any dimension array.
function multi_array_search($search_value, $the_array){
	if (is_array($the_array)){
		foreach ($the_array as $key => $value){
			// Special code added for this implementation.
			// Does the comparison UPPER to UPPER. The passed $search_value must be all upper!
			// Remove this if() to restore case sensitive comparisons...
			if (is_string($value)){
				$the_array[$key] = strtoupper($value);
			}
			// ...and change the comparison back to $value.
//			$result = multi_array_search($search_value, $value);
			$result = multi_array_search($search_value, $the_array[$key]);
			if (is_array($result)){
				$return = $result;
				array_unshift($return, $key);
				return $return;
			}elseif ($result == true){
				$return[] = $key;
				return $return;
			}
		}
		return false;
	}else{
		if ($search_value == $the_array){
			return true;
		}else return false;
	}
}


//		$weddings = array(array());
		$weddings = array();
		// Remove (pop off) the annoying empty element that creates
		$pop = array_pop($weddings);
		// Break up the full path to each filename and push the values onto the stack
		foreach(myglob("/var/www/helix/Content/Archive/littlechurch/*.rm") as $filename) {
			$path = explode('/',$filename); // [7] => groom-bride@timestamp.rm
//			$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
//			$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
//echo $timestamp[0];
//			$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride
			// If the date they selected is the date of the embedded timestamp, push it onto the stack, if not, skip it.
			// End result is an array of filename info for ONLY the clips from the date they specified.
//			if (date("mdy",$date) == date("mdy",$timestamp[1])){
//				array_push($weddings,array($timestamp[1],$couple[0],$couple[1],$path[7]));
//			}
			array_push($weddings,array($path[7]));
		}

		// Sort the results by timestamp
		usort($weddings, "compare");

// Debug
//print_r($weddings);

//reset($weddings);
//while (list(, $filname) = each($weddings)) {
//   echo "Value: $filename<br />\n";
//}

//foreach ($weddings as $filename) {
//  echo "Value: $filename<br>\n";
//}

//foreach ($weddings as $key => $filename) {
//   echo "Key: $key; Value: $filename<br />\n";
//}

foreach ($weddings as $val) {
   foreach ($val as $filename) {
       echo "$filename<br>\n";
   }
}


?>


</body>
</html>
