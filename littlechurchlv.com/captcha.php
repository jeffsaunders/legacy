<?php
//session_start();

class CaptchaSecurityImages {

	var $font = 'brook23.ttf';

	function CaptchaSecurityImages($width='120',$height='40',$num1,$num2){
		/* generate equation */
//		$num1 = rand(1, 9);
//		$num2 = rand(0, 9);
//		$num1 = $_SESSION['captchaNum1'];
//		$num2 = $_SESSION['captchaNum2'];
		$equation = $num1.' + '.$num2.' =';
//		$answer = $num1 + $num2;
		/* font size will be 75% of the image height */
		$font_size = $height * 0.75;
		$image = imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colors */
		$background_color = imagecolorallocate($image, 255, 255, 255); //white
		$text_color = imagecolorallocate($image, 0, 0, 255); //blue
//      $noise_color = imagecolorallocate($image, 119, 0, 37); //burgundy
		$noise_color = imagecolorallocate($image, 136, 136, 136); //gray
		/* generate random dots in background */
		for( $i = 0; $i < ($width*$height)/3; $i++ ){
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i = 0; $i < ($width*$height)/150; $i++ ){
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $equation) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $equation) or die('Error in imagettftext function');
		/* output captcha image to browser */
		header('Content-Type: image/jpeg');
		imagejpeg($image);
		imagedestroy($image);
//		$_SESSION['security_code'] = $answer;
   }

}

$width = isset($_GET['width']) && $_GET['width'] < 600 ? $_GET['width'] : '120';
$height = isset($_GET['height']) && $_GET['height'] < 200 ? $_GET['height'] : '40';

$letter1 = substr($_GET['stm'],2,1);
$letter2 = substr($_GET['stm'],9,1);

$upperLetters = range(A,Z);
$num1 = array_search(strtoupper($letter1),$upperLetters);
$num2 = array_search(strtoupper($letter2),$upperLetters);

$captcha = new CaptchaSecurityImages($width,$height,$num1,$num2);

?>
