<?
/* This script creates images of text called via the standard <img> tag.  Below is an example:

<img src='TextIMG.php?text=Hello World&font=CACCHAMP.TTF&bold=yes&points=30&txtcolor=F8F6E8&shadow=000000&offset=2&width=400&height=50&left=10&top=30&angle=0&bgcolor=770025&transparent=yes&format=png' alt="" width="" height="" border="0">

The parameters are:

text		- Text to print.
font		- Font to use (i.e. "arial.ttf")...must exist on server, value can include relative path.
bold		- Bold the text, 'yes' or 'no'?
points		- Point size of the font (i.e. "12").
txtcolor	- HEX value of the text color (i.e. "000000" for black).
shadow		- HEX value of the shadow color.
shadowOffset- Number of pixels down and to the right to place the shadow.  Negative values will angle the shadow to the left instead.
width		- Width of resulting image in pixels.
height		- Height of resulting image in pixels.
left		- Number of pixels from the left to start text BASELINE (BOTTOM left corner).  Baseline reference is important if you print at an angle.
top			- Number of pixels from the top to place the text BASELINE.
angle		- Number of degrees counter-clockwise from horizontal to print the text (i.e. 90 would print from down to up, 180 would be upside-down).
			  Pivots at bottom-left baseline.
bgcolor		- HEX value of the background color.  Defines matte color if transparent.
transparent	- Transparent background, 'yes' or 'no'?
format		- Type of image file to create.  Valid values are "gif", "jpg" or "jpeg", and "png".

Now, LET'S DO IT!..............
*/

// First, some functions
// Is passed value valid HEX?
function is_hex($hexValue){
	if ($hexValue == dechex(hexdec($hexValue))){ //Convert passed value to decimal, then back to hex and compare with the original.  If it matches, it was valid hex.
		return true;
	}
	return false;
}

// Wrap text if string is too long
function wrap($fontSize, $angle, $fontFace, $string, $width, $offset){
    $ret = "";
    $arr = explode(' ', $string);
    foreach ($arr as $word){
		$teststring = $ret.' '.$word;
		$testbox = imagettfbbox($fontSize, $angle, $fontFace, $teststring);
		if ($testbox[2] + $offset > $width){
			$ret.=($ret==""?"":"\n").$word;
		}else{
			$ret.=($ret==""?"":' ').$word;
		}
	}
	return $ret;
}

// Draw text bolded
function drawboldtext($image, $size, $angle, $x_cord, $y_cord, $r, $g, $b, $fontfile, $text){
	$color = ImageColorAllocate($image, $r, $g, $b);
//	$_x = array(1, 0, 1, 0, -1, -1, 1, 0, -1); // A little aggressive
//	$_y = array(0, -1, -1, 0, 0, -1, 1, 1, 1);
	$_x = array(1, 0, 1, 0);
	$_y = array(0, -1, -1, 0);
	for ($n = 0; $n <= sizeof($_x)-1; $n++){
		ImageTTFText($image, $size, $angle, $x_cord+$_x[$n], $y_cord+$_y[$n], $color, $fontfile, $text);
	}
}

// Now, let's get the ball rolling....

// Assign passed values
$text = stripslashes($_REQUEST['text']); //Text to print
if ($text == "") $text = "Text Missing";

$font = $_REQUEST['font']; //Font to use (i.e. "arial.ttf")...must exist on server, value can include relative path
if (!file_exists($font)){$font = "arial.ttf"; $text = "Bad Font";}

$bold = $_REQUEST['bold']; //Bold 'yes' or 'no'
if ($bold != "yes") $bold = "no";

$points = $_REQUEST['points']; //Point size of the font (i.e. "12")
if (!is_numeric($points)) $points = 12;

$txtcolor = $_REQUEST['txtcolor']; //HEX value of the text color.
if (!is_hex(strtolower($txtcolor)) || strlen($txtcolor) != 6) $txtcolor = "000000"; //Black

$shadow = $_REQUEST['shadow']; //HEX value of the shadow color.
if (!is_hex(strtolower($shadow)) || strlen($shadow) != 6) $shadow = ""; //Blank, meaning "no shadow"

$shadowOffset = $_REQUEST['offset']; //Number of pixels down and to the right to place the shadow.  Negative values will angle the shadow to the left instead.
if (!is_numeric($shadowOffset)) $shadowOffset = 2;

$width = $_REQUEST['width']; //Width of resulting image
if (!is_numeric($width)) $width = 400;

$height = $_REQUEST['height']; //Height of resulting image
if (!is_numeric($height)) $height = 40;

$left = $_REQUEST['left']; //Number of pixels from the left to start text BASELINE (important if you print at an angle)
if (!is_numeric($left)) $left = 0;

$top = $_REQUEST['top']; //Number of pixels from the top to place the text BASELINE
if (!is_numeric($top)) $top = $points+2;

$angle = $_REQUEST['angle']; //Number of degrees from horizontal to print the text (i.e. 90 would print from down to up, 180 would be upside-down)
if (!is_numeric($angle)) $angle = 0;

$bgcolor = $_REQUEST['bgcolor']; //HEX value of the background color.  Matte color if transparent
if (!is_hex(strtolower($bgcolor)) || strlen($bgcolor) != 6) $bgcolor = "FFFFFF"; //White

$transparent = $_REQUEST['transparent']; //Transparent background 'yes' or 'no'
if ($transparent != "yes") $transparent = "no";

$format = strtolower($_REQUEST['format']); //Type of image file to create
$formats = array("gif", "jpeg", "jpg", "png");
$found = false;
for($f = 0; $f <= sizeof($formats)-1; $f++){
	if ($format == $formats[$f]){
		$found = true;
		break;
	}
}	
if (!$found) $format = "png";

// Create the image
$img = imagecreatetruecolor($width, $height);

// Set it's characteristics
$textColor = imagecolorallocate($img, hexdec('0x'.$txtcolor{0}.$txtcolor{1}), hexdec('0x'.$txtcolor{2}.$txtcolor{3}), hexdec('0x'.$txtcolor{4}.$txtcolor{5}));
$shadowColor = imagecolorallocate($img, hexdec('0x'.$shadow{0}.$shadow{1}), hexdec('0x'.$shadow{2}.$shadow{3}), hexdec('0x'.$shadow{4}.$shadow{5}));
$background = imagecolorallocate($img, hexdec('0x'.$bgcolor{0}.$bgcolor{1}), hexdec('0x'.$bgcolor{2}.$bgcolor{3}), hexdec('0x'.$bgcolor{4}.$bgcolor{5}));
imagefilledrectangle($img, 0, 0, $width-1, $height-1, $background);
if ($transparent == "yes"){
	$transparent = imagecolortransparent($img, $background); // Uses bgcolor as matte
}

// Add some shadow to the text if that's what you want
if ($shadow !=""){
	if ($bold == "yes"){
		drawboldtext($img, $points, $angle, $left+$shadowOffset, $top+abs($shadowOffset), hexdec('0x'.$shadow{0}.$shadow{1}), hexdec('0x'.$shadow{2}.$shadow{3}), hexdec('0x'.$shadow{4}.$shadow{5}), $font, wrap($points, $angle, $font, $text, $width, $left));
	}else{
		imagettftext($img, $points, $angle, $left+2, $top+2, $shadowColor, $font, wrap($points, $angle, $font, $text, $width, $left));
	}
}

// Now stir in the text
if ($bold == "yes"){
	drawboldtext($img, $points, $angle, $left, $top, hexdec('0x'.$txtcolor{0}.$txtcolor{1}), hexdec('0x'.$txtcolor{2}.$txtcolor{3}), hexdec('0x'.$txtcolor{4}.$txtcolor{5}), $font, wrap($points, $angle, $font, $text, $width, $left));
}else{
//	imagettftext($img, $points, $angle, $left, $top, $textColor, $font, $text);
	imagettftext($img, $points, $angle, $left, $top, $textColor, $font, wrap($points, $angle, $font, $text, $width, $left));
}

// Simmer, and BAM!
switch($format){
	case "gif":
        header("Content-type: image/gif");
	    imagetruecolortopalette($img, true, 256); //Set to true color
        imageGIF($img);
    case "jpeg":
        header("Content-type: image/jpeg");
        imageJPEG($img);
    case "jpg":
        header("Content-type: image/jpeg");
        imageJPEG($img);
    case "png":
        header("Content-type: image/png");
        imagePNG($img);
}

// We're done, kill the handle.
imagedestroy($img);

?>
