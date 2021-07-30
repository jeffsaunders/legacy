<?
// This routine takes in a reference to an image, the dimensions it should be resized to, and what format to return.
// It returns the resized image (binary) in the format specified.
// It is called using the following example syntax and example:
// ResizeImage.php?image=[image path and name]&width=[width in pixels]&height=[height in pixels]&format=[3-letter format] (jpg, gif, png).
// 		HTML <img> tag -> <img src="ResizeImage.php?image=images/MyImage.jpg&width=375&height=250&format=png" alt="" width="375" height="250">
//		CSS xxx-image:url -> background-image:url(ResizeImage.php?image=images/MyImage.jpg&amp;width=375&amp;height=250&amp;format=png);

// Grab the passed values
$originalImage = $_REQUEST['image'];
$toWidth = $_REQUEST['width'];
$toHeight = $_REQUEST['height'];
$toFormat = $_REQUEST['format'];

// Get dimensions
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

// Simmer, and BAM!
switch($toFormat){
	case "gif":
        header("Content-type: image/gif");
	    imagetruecolortopalette($imageResized, true, 256); //Set to true color
        imageGIF($imageResized);
    case "jpg":
        header("Content-type: image/jpeg");
        imageJPEG($imageResized);
    case "jpeg":  //Just in case
        header("Content-type: image/jpeg");
        imageJPEG($imageResized);
    case "png":
        header("Content-type: image/png");
        imagePNG($imageResized);
}

// We're done, kill the handle.
imagedestroy($imageResized);
?>
