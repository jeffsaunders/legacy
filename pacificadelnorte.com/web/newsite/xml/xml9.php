<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>

<?

function get_feed($url){
//	$handle = curl_init("http://www.wunderground.com/auto/rss_full/global/stations/78760.xml");
	$handle = curl_init($url);
	curl_setopt($handle, CURLOPT_HEADER, 0);
	curl_setopt($handle, CURLOPT_RETURNTRANSFER, 1);
	$rawfeed = curl_exec($handle);
	curl_close($handle);
	return $rawfeed;
}

function parse_tag($tag,$string){
	$offset = strpos($string,"</" . $tag . ">")+1;
	$start = strpos($string,"<" . $tag . ">", $offset);
	$start = $start + strlen("<" . $tag . ">");
	$end = (strpos($string, "</" . $tag . ">", $offset));
	$length = ($end - $start);
	$result = substr($string, $start, $length);
	return $result;
} 

function parse_text($begin,$end,$string){
//	$offset = strpos($string,$begin)+1;
	$start = strpos($string, $begin);
//echo $start." ";
	$start = $start + strlen($begin);
//echo $start." ";
	$stop = (strpos($string, $end, $start))+1;
//echo $stop." ";
	$length = ($stop - $start);
//echo $length." ";
	$result = substr($string, $start, $length);
	return $result;
} 

$rawfeed = get_feed("http://www.wunderground.com/auto/rss_full/global/stations/78760.xml");
//echo $rawfeed;
$conditions = parse_tag("description",$rawfeed);
echo $conditions."<br>";
$temperature = parse_text("Temperature: ", "C |", $conditions);
echo $temperature."<br>";
$humidity = parse_text("Humidity: ", "% |", $conditions);
echo $humidity."<br>";
$pressure = parse_text("Pressure: ", "a |", $conditions);
echo $pressure."<br>";
$condition = parse_text("Conditions: ", " |", $conditions);
echo $condition."<br>";
$wind_dir = parse_text("Wind Direction: ", " |", $conditions);
$wind_spd = parse_text("Wind Speed: ", " |", $conditions);
$wind = $wind_dir."@".$wind_spd;
echo $wind."<br>";
$time = parse_text("Updated: ", "T", $conditions);
echo $time."<br>";
?>

</body>
</html>
