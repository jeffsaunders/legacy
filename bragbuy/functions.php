<?
// Is passed value odd?
function is_odd($num){
	return (is_numeric($num)&($num&1));
}

// Is passed value even?
function is_even($num){
	return (is_numeric($num)&(!($num&1)));
}

// Is passed value a multiple of the other passed value?
function is_multiple($dividend, $divisor){
//	$remainder = ($dividend % $dividor);
//	return (iif($remainder == 0, true, false));
	if ($dividend == 0) return false;
	if ($divisor == 0) return false;
	return (iif(($dividend % $divisor) == 0, true, false));
}

// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}

function resizeImage($originalImage,$toWidth,$toHeight){
	// Get the original geometry and calculate scales
	list($width, $height) = getimagesize($originalImage);
	$xscale=$width/$toWidth;
	$yscale=$height/$toHeight;
	// Recalculate new size with default ratio
	if ($yscale>$xscale){
		$new_width = round($width * (1/$yscale));
		$new_height = round($height * (1/$yscale));
	}else{
		$new_width = round($width * (1/$xscale));
		$new_height = round($height * (1/$xscale));
	}
	// Resize the original image
	$imageResized = imagecreatetruecolor($new_width, $new_height);
	$imageTmp     = imagecreatefromjpeg ($originalImage);
	imagecopyresampled($imageResized, $imageTmp, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	return $imageResized;
}

/*
function add_param($query, $var, $val)
{
	$s = $query;

	if ($val)
		$replace = "\\1$val\\3";
	else
		$replace = "";

	if (ereg("(&$var=)([^&]*)(&)", $s))
		$s = ereg_replace("(&$var=)([^&]*)(&)", $replace, $s);
	elseif (ereg("(&$var=)([^&]*)()$", $s))
		$s = ereg_replace("(&$var=)([^&]*)()$", $replace, $s);
	elseif (ereg("^($var=)([^&]*)(&)", $s))
		$s = ereg_replace("^($var=)([^&]*)(&)", $replace, $s);
	elseif (ereg("^($var=)([^&]*)()$", $s))
		$s = ereg_replace("^($var=)([^&]*)()$", $replace, $s);
	else {
		if ($s)
			$s .= "&";
		$s .= "$var=$val";
	}
	
	if ($s)
		$s = "?" . $s;
	
	return $s;
}
*/
?>