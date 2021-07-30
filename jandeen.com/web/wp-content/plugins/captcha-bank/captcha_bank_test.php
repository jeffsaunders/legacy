<?php

if (isset($_GET['testimage']) && $_GET['testimage'] == '1')
								{
									$im    = imagecreate(225, 225);
									$white = imagecolorallocate($im, 255, 255, 255);
									$black = imagecolorallocate($im,   0,   0,   0);
									$red   = imagecolorallocate($im, 255,   0,   0);
									$green = imagecolorallocate($im,   0, 255,   0);
									$blue  = imagecolorallocate($im,   0,   0, 255);
								// draw the head
									imagearc($im, 100, 120, 200, 200,  0, 360, $black);
								// mouth
									imagearc($im, 100, 120, 150, 150, 25, 155, $red);
								// left and then the right eye
									imagearc($im,  60,  95,  50,  50,  0, 360, $green);
									imagearc($im, 140,  95,  50,  50,  0, 360, $blue);
									imagestring($im, 5, 15, 1, 'Captcha Bank Will Work!!', $blue);
									imagestring($im, 2, 5, 20, ':) :) :)', $black);
									imagestring($im, 2, 5, 30, ':) :)', $black);
									imagestring($im, 2, 5, 40, ':)', $black);
									imagestring($im, 2, 150, 20, '(: (: (:', $black);
									imagestring($im, 2, 168, 30, '(: (:', $black);
									imagestring($im, 2, 186, 40, '(:', $black);
									header('Content-type: image/png');
									imagepng($im, null, 3);
									exit;
								}

?>
