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

function form_quotes($string){
	return str_replace("&amp;", "&", (htmlentities(stripslashes($string), ENT_QUOTES)));
}

?>