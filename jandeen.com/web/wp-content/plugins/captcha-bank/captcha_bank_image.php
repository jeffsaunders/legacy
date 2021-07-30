<?php 
/**
 * Project:     Securimage: A PHP class for creating and managing form CAPTCHA images<br />
 * File:        securimage.php<br />
 *
 * Copyright (c) 2013, Drew Phillips
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 *    this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 *    this list of conditions and the following disclaimer in the documentation
 *    and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * Any modifications to the library should be indicated clearly in the source code
 * to inform users that the changes are not a part of the original software.<br /><br />
 *
 * If you found this script useful, please take a quick moment to rate it.<br />
 * http://www.hotscripts.com/rate/49400.html  Thanks.
 *
 * @link http://www.phpcaptcha.org Securimage PHP CAPTCHA
 * @link http://www.phpcaptcha.org/latest.zip Download Latest Version
 * @link http://www.phpcaptcha.org/Securimage_Docs/ Online Documentation
 * @copyright 2013 Drew Phillips
 * @author Drew Phillips <drew@drew-phillips.com>
 * @version 3.5.1 (June 21, 2013)
 * @package Securimage
 *
 */

class captcha_bank_image
{
	
	/**
     * Renders captcha as a JPEG image
     * @var int
     */
    const captchaBank_image_jpeg = 1;
    /**
     * Renders captcha as a PNG image (default)
     * @var int
     */
    const captchaBank_image_png  = 2;
    /**
     * Renders captcha as a GIF image
     * @var int
     */
    const captchaBank_image_gif  = 3;

    /**
     * Create a normal alphanumeric captcha
     * @var int
     */
    const captchaBank_string     = 0;
    /**
     * Create a captcha consisting of a simple math problem
     * @var int
     */
    const captchaBank_mathematics = 1;
    /**
     * Create a word based captcha using 2 words
     * @var int
     */
    const captchaBank_words      = 2;

    /*%*********************************************************************%*/
    // Properties

    /**
     * The width of the captcha image
     */
    public $image_width;
    /**
     * The height of the captcha image
     */
    public $image_height;
    /**
     * The type of the image, default = png
     */
    public $image_type   = self::captchaBank_image_png;

    /**
     * The background color of the captcha
     */
    public $image_bg_color = '#ffffff';
    /**
     * The color of the captcha text
     */
    public $text_color;
    /**
     * The color of the lines over the captcha
     */
    public $line_color;
    /**
     * The color of the noise that is drawn
     */
    public $noise_color    = '#707070';

    /**
     * How transparent to make the text 0 = completely opaque, 100 = invisible
     */
    public $text_transparency_percentage = 50;
    /**
     * Whether or not to draw the text transparently, true = use transparency, false = no transparency
     */
    public $use_transparent_text         = true;

    /**
     * The length of the captcha code
     */
    public $code_length;
    /**
     * Whether the captcha should be case sensitive (not recommended, use only for maximum protection)
     */
    public $f = true;
    /**
     * The character set to use for generating the captcha code
     */
    public $charset        = 'ABCDEFGHKLMNPRSTUVWYZabcdefghklmnprstuvwyz0123456789';
	
	public $charset_digits = '0123456789';
	
	public $charset_alphabets = 'ABCDEFGHKLMNPRSTUVWYZabcdefghklmnprstuvwyz';
    /**
     * How long in seconds a captcha remains valid, after this time it will not be accepted
     */
    public $expiry_time    = 900;

    /**
     * The session name CaptchaBankImage should use, only set this if your application uses a custom session name
     * It is recommended to set this value below so it is used by all CaptchaBankImage scripts
     */
    public $session_name   = null;

    /**
     * true to use the wordlist file, false to generate random captcha codes
     */
    public $use_wordlist   = false;

    /**
     * The level of distortion, 0.75 = normal, 1.0 = very high distortion
     */
    public $perturbation = 0.75;
    /**
     * How many lines to draw over the captcha code to increase security
     */
    public $num_lines;
    /**
     * The level of noise (random dots) to place on the image, 0-10
     */
    public $noise_level  =5;

    /**
     * The signature text to draw on the bottom corner of the image
     */
    public $image_signature = '';
    /**
     * The color of the signature text
     */
    public $signature_color = '#7a6ccc';
    /**
     * The path to the ttf font file to use for the signature text, defaults to $ttf_file (AHGBold.ttf)
     */
    public $signature_font;

	public $case_sensitive = false;


    /**
     * The type of captcha to create, either alphanumeric, or a math problem<br />
     */
    public $captcha_type  = self::captchaBank_string; // or self::captchaBank_mathematics;

    /**
     * The captcha namespace, use this if you have multiple forms on a single page, blank if you do not use multiple forms on one page
     */
    public $namespace;

    /**
     * The font file to use to draw the captcha code, leave blank for default font AHGBold.ttf
     */
    public $ttf_file;
    /**
     * The path to the wordlist file to use, leave blank for default words/words.txt
     */
    public $wordlist_file;
    /**
     * The directory to scan for background images, if set a random background will be chosen from this folder
     */
    public $background_directory;
	
    /**
     * Captcha ID if using static captcha
     */
    protected static $_captchaId = null;

    protected $im;
    protected $tmpimg;
    protected $bgimg;
    protected $iscale = 5;

    public $CaptchaBankImage_path = null;

    /**
     * The captcha challenge value (either the case-sensitive/insensitive word captcha, or the solution to the math captcha)
     */
    protected $code;

    /**
     * The display value of the captcha to draw on the image (the word captcha, or the math equation to present to the user)
     *
     */
    protected $code_display;

    /**
     * A value that can be passed to the constructor that can be used to generate a captcha image with a given value
     * This value does not get stored in the session or database and is only used when calling captcha_bank_image::display().
     * If a display_value was passed to the constructor and the captcha image is generated, the display_value will be used
     * as the string to draw on the captcha image.  Used only if captcha codes are generated and managed by a 3rd party app/library
     *
     */
    public $display_value;

    /**
     * Captcha code supplied by user [set from captcha_bank_image::check()]
     *
     * @var string
     */
    protected $captcha_code;

    /**
     * Flag that can be specified telling CaptchaBankImage not to call exit after generating a captcha image
     */
    protected $no_exit;

    /**
     * Flag indicating whether or not a PHP session should be started and used
     *
     * @var bool If true, no session will be started; if false, session will be started and used to store data (default)
     */
    protected $no_session;

    /**
     * Flag indicating whether or not HTTP headers will be sent when outputting captcha image
     *
     * @var bool If true (default) headers will be sent, if false, no headers are sent
     */
    protected $send_headers;

    /**
     * PDO connection when a database is used
     *
     * @var resource
     */
    protected $pdo_conn;

    // gd color resources that are allocated for drawing the image
    protected $gdbgcolor;
    protected $gdtextcolor;
    protected $gdlinecolor;
    protected $gdsignaturecolor;

    public function __construct($options = array())
    {
        $this->CaptchaBankImage_path = dirname(__FILE__);

        if(count($options) > 0)
		{
		
		$this->image_bg_color  = $this->initColor($this->image_bg_color,  '#ffffff');
		$this->text_color      = $this->initColor($options[6],      '#000000');
		$this->line_color      = $this->initColor($options[11],      '#616161');
		$this->noise_color     = $this->initColor($options[14],     '#616161');
		$this->signature_color = $this->initColor($options[22], '#616161');

		$this->ttf_file = CAPTCHA_BK_PLUGIN_DIR . '/assets/fonts' . '/'.$options[7];
		$this->code_length = $options[2];
		$this->image_width = $options[3];
		$this->image_height = $options[4];
			$this->bgimg = CAPTCHA_BK_PLUGIN_DIR . '/assets/backgrounds/'.$options[5]; 
		$this->num_lines = $options[9] == 1 ? $options[10] : 0;
		$this->noise_level = $options[12] == 1 ? $options[13] : 0;
		$this->use_transparent_text = $options[15] == 1 ? true : false;
		$this->text_transparency_percentage = $options[16];
		$this->image_signature = $options[20] == 1 ?  stripslashes($options[21]) : '';
		$this->case_sensitive = $options[8] == 1 ?  true : false;
		if($options[17] == "digits")
		{
			$this->charset = $this->charset_digits;
		}
		else if($options[17] == "alphabets")
		{
			$this->charset = $this->charset_alphabets;
		} 
	
		
		if($options[18] == 1)
		{
			$this->perturbation = $options[19];
		}
		}
        if (is_null($this->ttf_file)) {
            $this->ttf_file = $this->CaptchaBankImage_path . '/AHGBold.ttf';
        }
		
		
        $this->signature_font = $this->ttf_file;

        if (is_null($this->wordlist_file)) {
            $this->wordlist_file = $this->CaptchaBankImage_path . '/words/words.txt';
        }


        if (is_null($this->code_length) || (int)$this->code_length < 1) {
            $this->code_length = 6;
        }

        if (is_null($this->perturbation) || !is_numeric($this->perturbation)) {
            $this->perturbation = 0.75;
        }

        if (is_null($this->namespace) || !is_string($this->namespace)) {
            $this->namespace = 'default';
        }

        if (is_null($this->no_exit)) {
            $this->no_exit = false;
        }

        if (is_null($this->no_session)) {
            $this->no_session = false;
        }

        if (is_null($this->send_headers)) {
            $this->send_headers = true;
        }

        if ($this->no_session != true) {
            // Initialize session or attach to existing
            if ( session_id() == '' ) { // no session has been started yet, which is needed for validation
                if (!is_null($this->session_name) && trim($this->session_name) != '') {
                    session_name(trim($this->session_name)); // set session name if provided
                }
                session_start();
            }
        }
    }

    /**
     * Return the absolute path to the CaptchaBankImage directory
     */
    public static function getPath()
    {
        return dirname(__FILE__);
    }

    /**
     * Generate a new captcha ID or retrieve the current ID
     */
    public static function get_captcha_id($new = true, array $options = array())
    {
            return captcha_bank_image::$_captchaId;
    }

    /**
     * Validate a captcha code input against a captcha ID
     */
    public static function check_by_captcha_id()
    {
            return false;
    }


    /**
     * Used to serve a captcha image to the browser
     */
    public function  display($background_image = 'backgrounds/bg4.jpg')
    {
    	
        set_error_handler(array(&$this, 'errorHandler'));

        if($background_image != '' && is_readable($background_image)) {
            $this->bgimg = $background_image;
        }
		
        $this->Image();
    }

    /**
     * Check a submitted code against the stored value
     */
    public function check($code)
    {
        $this->code_entered = $code;
        $this->validate();
		
        return $this->correct_code;
    }

    /**
     * Return the code from the session or sqlite database if used.  If none exists yet, an empty string is returned
     */
    public function get_code($array = false, $returnExisting = false)
    {
        $code = '';
        $time = 0;
        $disp = 'error';

        if ($returnExisting && strlen($this->code) > 0) {
            if ($array) {
                return array('code' => $this->code,
                             'display' => $this->code_display,
                             'code_display' => $this->code_display,
                             'time' => 0);
            } else {
                return $this->code;
            }
        }

        if ($this->no_session != true) {
            if (isset($_SESSION['captchaBankImage_code_value'][$this->namespace]) &&
                    trim($_SESSION['captchaBankImage_code_value'][$this->namespace]) != '') {
                if ($this->expired_code(
                        $_SESSION['captchaBankImage_code_ctime'][$this->namespace]) == false) {
                    $code = $_SESSION['captchaBankImage_code_value'][$this->namespace];
                    $time = $_SESSION['captchaBankImage_code_ctime'][$this->namespace];
                    $disp = $_SESSION['captchaBankImage_code_disp'] [$this->namespace];
                }
            }
        }

        if ($array == true) {
            return array('code' => $code, 'ctime' => $time, 'display' => $disp);
        } else {
            return $code;
        }
    }

    /**
     * The main image drawing routing, responsible for constructing the entire image and serving it
     */
    protected function Image()
    {
        if( ($this->use_transparent_text == true || $this->bgimg != '') && function_exists('imagecreatetruecolor')) {
            $imagecreate = 'imagecreatetruecolor';
        } else {
            $imagecreate = 'imagecreate';
        }
        $this->im     = $imagecreate($this->image_width, $this->image_height);
        $this->tmpimg = $imagecreate($this->image_width * $this->iscale, $this->image_height * $this->iscale);
        $this->add_colors();
        imagepalettecopy($this->tmpimg, $this->im);

        $this->set_background();

        $code = '';

        if ($this->get_captcha_id(false) !== null) {
            // a captcha Id was supplied

            // check to see if a display_value for the captcha image was set
            if (is_string($this->display_value) && strlen($this->display_value) > 0) {
                $this->code_display = $this->display_value;
                $this->code         = ($this->case_sensitive) ?
                                       $this->display_value   :
                                       strtolower($this->display_value);
                $code = $this->code;
            } 
        }

        if ($code == '') {
            // if the code was not set using display_value or was not found in
            // the database, create a new code
            $this->create_code();
        }

        if ($this->noise_level > 0) {
            $this->draw_noise();
        }

        $this->draw_word();

        if ($this->perturbation > 0 && is_readable($this->ttf_file)) {
            $this->distorted_copy();
        }

        if ($this->num_lines > 0) {
            $this->draw_lines();
        }

        if (trim($this->image_signature) != '') {
            $this->add_signature();
        }

        $this->output();
    }

    /**
     * Allocate the colors to be used for the image
     */
    protected function add_colors()
    {
        // allocate bg color first for imagecreate
        $this->gdbgcolor = imagecolorallocate($this->im,
                                              $this->image_bg_color->r,
                                              $this->image_bg_color->g,
                                              $this->image_bg_color->b);

        $alpha = intval($this->text_transparency_percentage / 100 * 127);

        if ($this->use_transparent_text == true) {
            $this->gdtextcolor = imagecolorallocatealpha($this->im,
                                                         $this->text_color->r,
                                                         $this->text_color->g,
                                                         $this->text_color->b,
                                                         $alpha);
            $this->gdlinecolor = imagecolorallocatealpha($this->im,
                                                         $this->line_color->r,
                                                         $this->line_color->g,
                                                         $this->line_color->b,
                                                         $alpha);
            $this->gdnoisecolor = imagecolorallocatealpha($this->im,
                                                          $this->noise_color->r,
                                                          $this->noise_color->g,
                                                          $this->noise_color->b,
                                                          $alpha);
        } else {
            $this->gdtextcolor = imagecolorallocate($this->im,
                                                    $this->text_color->r,
                                                    $this->text_color->g,
                                                    $this->text_color->b);
            $this->gdlinecolor = imagecolorallocate($this->im,
                                                    $this->line_color->r,
                                                    $this->line_color->g,
                                                    $this->line_color->b);
            $this->gdnoisecolor = imagecolorallocate($this->im,
                                                          $this->noise_color->r,
                                                          $this->noise_color->g,
                                                          $this->noise_color->b);
        }
		
        $this->gdsignaturecolor = imagecolorallocate($this->im,
                                                     $this->signature_color->r,
                                                     $this->signature_color->g,
                                                     $this->signature_color->b);

    }

    /**
     * The the background color, or background image to be used
     */
    protected function set_background()
    {
        // set background color of image by drawing a rectangle since imagecreatetruecolor doesn't set a bg color
        imagefilledrectangle($this->im, 0, 0,
                             $this->image_width, $this->image_height,
                             $this->gdbgcolor);
        imagefilledrectangle($this->tmpimg, 0, 0,
                             $this->image_width * $this->iscale, $this->image_height * $this->iscale,
                             $this->gdbgcolor);

        if ($this->bgimg == '') {
            if ($this->background_directory != null &&
                is_dir($this->background_directory) &&
                is_readable($this->background_directory))
            {
                $img = $this->get_background_from_directory();
                if ($img != false) {
                    $this->bgimg = $img;
                }
            }
        }

        if ($this->bgimg == '') {
            return;
        }

        $dat = @getimagesize($this->bgimg);
        if($dat == false) {
            return;
        }

        switch($dat[2]) {
            case 1:  $newim = @imagecreatefromgif($this->bgimg); break;
            case 2:  $newim = @imagecreatefromjpeg($this->bgimg); break;
            case 3:  $newim = @imagecreatefrompng($this->bgimg); break;
            default: return;
        }

        if(!$newim) return;

        imagecopyresized($this->im, $newim, 0, 0, 0, 0,
                         $this->image_width, $this->image_height,
                         imagesx($newim), imagesy($newim));
    }

    /**
     * Scan the directory for a background image to use
     */
    protected function get_background_from_directory()
    {
        $images = array();

        if ( ($dh = opendir($this->background_directory)) !== false) {
            while (($file = readdir($dh)) !== false) {
                if (preg_match('/(jpg|gif|png)$/i', $file)) $images[] = $file;
            }

            closedir($dh);

            if (sizeof($images) > 0) {
                return rtrim($this->background_directory, '/') . '/' . $images[mt_rand(0, sizeof($images)-1)];
            }
        }

        return false;
    }

    /**
     * Generates the code or math problem and saves the value to the session
     */
    public function create_code()
    {
        $this->code = false;

        switch($this->captcha_type) {
            case self::captchaBank_mathematics:
            {
                do {
                    $signs = array('+', '-', 'x');
                    $left  = mt_rand(1, 10);
                    $right = mt_rand(1, 5);
                    $sign  = $signs[mt_rand(0, 2)];

                    switch($sign) {
                        case 'x': $c = $left * $right; break;
                        case '-': $c = $left - $right; break;
                        default:  $c = $left + $right; break;
                    }
                } while ($c <= 0); // no negative #'s or 0

                $this->code         = $c;
                $this->code_display = "$left $sign $right";
                break;
            }

            case self::captchaBank_words:
                $words = $this->access_code_from_file(2);
                $this->code = implode(' ', $words);
                $this->code_display = $this->code;
                break;

            default:
            {
                if ($this->use_wordlist && is_readable($this->wordlist_file)) {
                    $this->code = $this->access_code_from_file();
                }

                if ($this->code == false) {
                    $this->code = $this->generate_code($this->code_length);
                }

                $this->code_display = $this->code;
                $this->code         = ($this->case_sensitive) ? $this->code : strtolower($this->code);
            } // default
        }

         $this->save_data();
    }

    /**
     * Draws the captcha code on the image
     */
    protected function draw_word()
    {
        $width2  = $this->image_width * $this->iscale;
        $height2 = $this->image_height * $this->iscale;

        if (!is_readable($this->ttf_file)) {
            imagestring($this->im, 4, 10, ($this->image_height / 2) - 5, 'Failed to load TTF font file!', $this->gdtextcolor);
        } else {
            if ($this->perturbation > 0) {
                $font_size = $height2 * .4;
                $bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
                $tx = $bb[4] - $bb[0];
                $ty = $bb[5] - $bb[1];
                $x  = floor($width2 / 2 - $tx / 2 - $bb[0]);
                $y  = round($height2 / 2 - $ty / 2 - $bb[1]);

                imagettftext($this->tmpimg, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
            } else {
                $font_size = $this->image_height * .4;
                $bb = imageftbbox($font_size, 0, $this->ttf_file, $this->code_display);
                $tx = $bb[4] - $bb[0];
                $ty = $bb[5] - $bb[1];
                $x  = floor($this->image_width / 2 - $tx / 2 - $bb[0]);
                $y  = round($this->image_height / 2 - $ty / 2 - $bb[1]);

                imagettftext($this->im, $font_size, 0, $x, $y, $this->gdtextcolor, $this->ttf_file, $this->code_display);
            }
        }

      

    }

    /**
     * Copies the captcha image to the final image with distortion applied
     */
    protected function distorted_copy()
    {
        $numpoles = 3; // distortion factor
        // make array of poles AKA attractor points
        for ($i = 0; $i < $numpoles; ++ $i) {
            $px[$i]  = mt_rand($this->image_width  * 0.2, $this->image_width  * 0.8);
            $py[$i]  = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
            $rad[$i] = mt_rand($this->image_height * 0.2, $this->image_height * 0.8);
            $tmp     = ((- $this->frand()) * 0.15) - .15;
            $amp[$i] = $this->perturbation * $tmp;
        }

        $bgCol = imagecolorat($this->tmpimg, 0, 0);
        $width2 = $this->iscale * $this->image_width;
        $height2 = $this->iscale * $this->image_height;
        imagepalettecopy($this->im, $this->tmpimg); // copy palette to final image so text colors come across
        // loop over $img pixels, take pixels from $tmpimg with distortion field
        for ($ix = 0; $ix < $this->image_width; ++ $ix) {
            for ($iy = 0; $iy < $this->image_height; ++ $iy) {
                $x = $ix;
                $y = $iy;
                for ($i = 0; $i < $numpoles; ++ $i) {
                    $dx = $ix - $px[$i];
                    $dy = $iy - $py[$i];
                    if ($dx == 0 && $dy == 0) {
                        continue;
                    }
                    $r = sqrt($dx * $dx + $dy * $dy);
                    if ($r > $rad[$i]) {
                        continue;
                    }
                    $rscale = $amp[$i] * sin(3.14 * $r / $rad[$i]);
                    $x += $dx * $rscale;
                    $y += $dy * $rscale;
                }
                $c = $bgCol;
                $x *= $this->iscale;
                $y *= $this->iscale;
                if ($x >= 0 && $x < $width2 && $y >= 0 && $y < $height2) {
                    $c = imagecolorat($this->tmpimg, $x, $y);
                }
                if ($c != $bgCol) { // only copy pixels of letters to preserve any background image
                    imagesetpixel($this->im, $ix, $iy, $c);
                }
            }
        }
    }

    /**
     * Draws distorted lines on the image
     */
    protected function draw_lines()
    {
        for ($line = 0; $line < $this->num_lines; ++ $line) {
            $x = $this->image_width * (1 + $line) / ($this->num_lines + 1);
            $x += (0.5 - $this->frand()) * $this->image_width / $this->num_lines;
            $y = mt_rand($this->image_height * 0.1, $this->image_height * 0.9);

            $theta = ($this->frand() - 0.5) * M_PI * 0.7;
            $w = $this->image_width;
            $len = mt_rand($w * 0.4, $w * 0.7);
            $lwid = mt_rand(0, 2);

            $k = $this->frand() * 0.6 + 0.2;
            $k = $k * $k * 0.5;
            $phi = $this->frand() * 6.28;
            $step = 0.5;
            $dx = $step * cos($theta);
            $dy = $step * sin($theta);
            $n = $len / $step;
            $amp = 1.5 * $this->frand() / ($k + 5.0 / $len);
            $x0 = $x - 0.5 * $len * cos($theta);
            $y0 = $y - 0.5 * $len * sin($theta);

            $ldx = round(- $dy * $lwid);
            $ldy = round($dx * $lwid);

            for ($i = 0; $i < $n; ++ $i) {
                $x = $x0 + $i * $dx + $amp * $dy * sin($k * $i * $step + $phi);
                $y = $y0 + $i * $dy - $amp * $dx * sin($k * $i * $step + $phi);
                imagefilledrectangle($this->im, $x, $y, $x + $lwid, $y + $lwid, $this->gdlinecolor);
            }
        }
    }

    /**
     * Draws random noise on the image
     */
    protected function draw_noise()
    {
        if ($this->noise_level > 10) {
            $noise_level = 10;
        } else {
            $noise_level = $this->noise_level;
        }

        $t0 = microtime(true);

        $noise_level *= 125; // an arbitrary number that works well on a 1-10 scale

        $points = $this->image_width * $this->image_height * $this->iscale;
        $height = $this->image_height * $this->iscale;
        $width  = $this->image_width * $this->iscale;
        for ($i = 0; $i < $noise_level; ++$i) {
            $x = mt_rand(10, $width);
            $y = mt_rand(10, $height);
            $size = mt_rand(7, 10);
            if ($x - $size <= 0 && $y - $size <= 0) continue; // dont cover 0,0 since it is used by imagedistortedcopy
            imagefilledarc($this->tmpimg, $x, $y, $size, $size, 0, 360, $this->gdnoisecolor, IMG_ARC_PIE);
        }

        $t1 = microtime(true);

        $t = $t1 - $t0;

    }

    /**
    * Print signature text on image
    */
    protected function add_signature()
    {
        $bbox = imagettfbbox(10, 0, $this->signature_font, $this->image_signature);
        $textlen = $bbox[2] - $bbox[0];
        $x = $this->image_width - $textlen - 5;
        $y = $this->image_height - 3;

        imagettftext($this->im, 10, 0, $x, $y, $this->gdsignaturecolor, $this->signature_font, $this->image_signature);
    }

    /**
     * Sends the appropriate image and cache headers and outputs image to the browser
     */
    protected function output()
    {
        if ($this->canSendHeaders() || $this->send_headers == false) {
            if ($this->send_headers) {
                // only send the content-type headers if no headers have been output
                // this will ease debugging on misconfigured servers where warnings
                // may have been output which break the image and prevent easily viewing
                // source to see the error.
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check=0", false);
                header("Pragma: no-cache");
            }

            switch ($this->image_type) {
                case self::captchaBank_image_jpeg:
                    if ($this->send_headers) header("Content-Type: image/jpeg");
                    imagejpeg($this->im, null, 90);
                    break;
                case self::captchaBank_image_gif:
                    if ($this->send_headers) header("Content-Type: image/gif");
                    imagegif($this->im);
                    break;
                default:
                    if ($this->send_headers) header("Content-Type: image/png");
                    imagepng($this->im);
                    break;
            }
        } else {
            echo '<hr /><strong>'
                .'Failed to generate captcha image, content has already been '
                .'output.<br />This is most likely due to misconfiguration or '
                .'a PHP error was sent to the browser.</strong>';
        }

        imagedestroy($this->im);
        restore_error_handler();

        if (!$this->no_exit) exit;
    }

    /**
     * Gets a captcha code from a wordlist
     */
    protected function access_code_from_file($numWords = 1)
    {
        $fp = fopen($this->wordlist_file, 'rb');
        if (!$fp) return false;

        $fsize = filesize($this->wordlist_file);
        if ($fsize < 128) return false; // too small of a list to be effective

        if ((int)$numWords < 1 || (int)$numWords > 5) $numWords = 1;

        $words = array();
        $i = 0;
        do {
            fseek($fp, mt_rand(0, $fsize - 64), SEEK_SET); // seek to a random position of file from 0 to filesize-64
            $data = fread($fp, 64); // read a chunk from our random position
            $data = preg_replace("/\r?\n/", "\n", $data);

            $start = @strpos($data, "\n", mt_rand(0, 56)) + 1; // random start position
            $end   = @strpos($data, "\n", $start);          // find end of word

            if ($start === false) {
                // picked start position at end of file
                continue;
            } else if ($end === false) {
                $end = strlen($data);
            }

            $word = strtolower(substr($data, $start, $end - $start)); // return a line of the file
            $words[] = $word;
        } while (++$i < $numWords);

        fclose($fp);

        if ($numWords < 2) {
            return $words[0];
        } else {
            return $words;
        }
    }

    /**
     * Generates a random captcha code from the set character set
     */
    protected function generate_code()
    {
        $code = '';

        if (function_exists('mb_strlen')) {
            for($i = 1, $cslen = mb_strlen($this->charset); $i <= $this->code_length; ++$i) {
                $code .= mb_substr($this->charset, mt_rand(0, $cslen - 1), 1, 'UTF-8');
            }
        } else {
            for($i = 1, $cslen = strlen($this->charset); $i <= $this->code_length; ++$i) {
                $code .= substr($this->charset, mt_rand(0, $cslen - 1), 1);
            }
        }

        return $code;
    }

    /**
     * Checks the entered code against the value stored in the session or sqlite database, handles case sensitivity
     * Also clears the stored codes if the code was entered correctly to prevent re-use
     */
    protected function validate()
    {
        if (!is_string($this->code) || strlen($this->code) == 0) {
            $code = $this->get_code();
            // returns stored code, or an empty string if no stored code was found
            // checks the session and database if enabled
        } else {
            $code = $this->code;
        }

        if ($this->case_sensitive == false && preg_match('/[A-Z]/', $code)) {
            // case sensitive was set from captcha_bank_show.php but not in class
            // the code saved in the session has capitals so set case sensitive to true
            $this->case_sensitive = true;
        }

        $code_entered = trim( (($this->case_sensitive) ? $this->code_entered
                                                       : strtolower($this->code_entered))
                        );
        $this->correct_code = false;

        if ($code != '') {
            if (strpos($code, ' ') !== false) {
                // for multi word captchas, remove more than once space from input
                $code_entered = preg_replace('/\s+/', ' ', $code_entered);
                $code_entered = strtolower($code_entered);
            }

            if ($code == $code_entered) {
                $this->correct_code = true;
                if ($this->no_session != true) {
                    $_SESSION['captchaBankImage_code_value'][$this->namespace] = '';
                    $_SESSION['captchaBankImage_code_ctime'][$this->namespace] = '';
                }
            }
        }
    }

    /**
     * Save data to session namespace and database if used
     */
    protected function save_data()
    {
        if ($this->no_session != true) {
            if (isset($_SESSION['captchaBankImage_code_value']) && is_scalar($_SESSION['captchaBankImage_code_value'])) {
                // fix for migration from v2 - v3
                unset($_SESSION['captchaBankImage_code_value']);
                unset($_SESSION['captchaBankImage_code_ctime']);
            }

            $_SESSION['captchaBankImage_code_disp'] [$this->namespace] = $this->code_display;
            $_SESSION['captchaBankImage_code_value'][$this->namespace] = $this->code;
            $_SESSION['captchaBankImage_code_ctime'][$this->namespace] = time();
        }
    }

    /**
     * Checks to see if the captcha code has expired and cannot be used
     * @param unknown_type $creation_time
     */
    protected function expired_code($creation_time)
    {
        $expired = true;

        if (!is_numeric($this->expiry_time) || $this->expiry_time < 1) {
            $expired = false;
        } else if (time() - $creation_time < $this->expiry_time) {
            $expired = false;
        }

        return $expired;
    }

    /**
     * Checks to see if headers can be sent and if any error has been output to the browser
     *
     * @return bool true if headers haven't been sent and no output/errors will break images, false if unsafe
     */
    protected function canSendHeaders()
    {
        if (headers_sent()) {
            // output has been flushed and headers have already been sent
            return false;
        } else if (strlen((string)ob_get_contents()) > 0) {
            // headers haven't been sent, but there is data in the buffer that will break image data
            return false;
        }

        return true;
    }

    /**
     * Return a random float between 0 and 0.9999
     *
     * @return float Random float between 0 and 0.9999
     */
    function frand()
    {
        return 0.0001 * mt_rand(0,9999);
    }

    /**
     * Convert an html color code to a CaptchaBankImage_Color
     * @param string $color
     * @param CaptchaBankImage_Color $default The defalt color to use if $color is invalid
     */
    protected function initColor($color, $default)
    {
        if ($color == null) {
            return new CaptchaBankImage_Color($default);
        } else if (is_string($color)) {
            try {
                return new CaptchaBankImage_Color($color);
            } catch(Exception $e) {
                return new CaptchaBankImage_Color($default);
            }
        } else if (is_array($color) && sizeof($color) == 3) {
            return new CaptchaBankImage_Color($color[0], $color[1], $color[2]);
        } else {
            return new CaptchaBankImage_Color($default);
        }
    }

    /**
     * Error handler used when outputting captcha image
     * This error handler helps determine if any errors raised would
     * prevent captcha image from displaying.  If they have
     * no effect on the output buffer or headers, true is returned so
     * the script can continue processing.
     * @param int $errno
     * @param string $errstr
     * @param string $errfile
     * @param int $errline
     * @param array $errcontext
     * @return boolean true if handled, false if PHP should handle
     */
    public function errorHandler($errno, $errstr, $errfile = '', $errline = 0, $errcontext = array())
    {
        // get the current error reporting level
        $level = error_reporting();

        // if error was supressed or $errno not set in current error level
        if ($level == 0 || ($level & $errno) == 0) {
            return true;
        }

        return false;
    }
	
	
}


/**
 * Color object for CaptchaBankImage CAPTCHA
 */
class CaptchaBankImage_Color
{
    public $r;
    public $g;
    public $b;

    /**
     * Create a new CaptchaBankImage_Color object.<br />
     * Constructor expects 1 or 3 arguments.<br />
     * When passing a single argument, specify the color using HTML hex format,<br />
     * when passing 3 arguments, specify each RGB component (from 0-255) individually.<br />
     * $color = new CaptchaBankImage_Color('#0080FF') or <br />
     * $color = new CaptchaBankImage_Color(0, 128, 255)
     *
     * @param string $color
     * @throws Exception
     */
    public function __construct($color = '#ffffff')
    {
    	
        $args = func_get_args();

        if (sizeof($args) == 0) {
            $this->r = 255;
            $this->g = 255;
            $this->b = 255;
        } else if (sizeof($args) == 1) {
            // set based on html code
            if (substr($color, 0, 1) == '#') {
                $color = substr($color, 1);
            }

            if (strlen($color) != 3 && strlen($color) != 6) {
                throw new InvalidArgumentException(
                  'Invalid HTML color code passed to CaptchaBankImage_Color'
                );
            }

            $this->constructHTML($color);
        } else if (sizeof($args) == 3) {
            $this->constructRGB($args[0], $args[1], $args[2]);
        } else {
            throw new InvalidArgumentException(
              'CaptchaBankImage_Color constructor expects 0, 1 or 3 arguments; ' . sizeof($args) . ' given'
            );
        }
    }

    /**
     * Construct from an rgb triplet
     * @param int $red The red component, 0-255
     * @param int $green The green component, 0-255
     * @param int $blue The blue component, 0-255
     */
    protected function constructRGB($red, $green, $blue)
    {
        if ($red < 0)     $red   = 0;
        if ($red > 255)   $red   = 255;
        if ($green < 0)   $green = 0;
        if ($green > 255) $green = 255;
        if ($blue < 0)    $blue  = 0;
        if ($blue > 255)  $blue  = 255;

        $this->r = $red;
        $this->g = $green;
        $this->b = $blue;
    }

    /**
     * Construct from an html hex color code
     * @param string $color
     */
    protected function constructHTML($color)
    {
        if (strlen($color) == 3) {
            $red   = str_repeat(substr($color, 0, 1), 2);
            $green = str_repeat(substr($color, 1, 1), 2);
            $blue  = str_repeat(substr($color, 2, 1), 2);
        } else {
            $red   = substr($color, 0, 2);
            $green = substr($color, 2, 2);
            $blue  = substr($color, 4, 2);
        }

        $this->r = hexdec($red);
        $this->g = hexdec($green);
        $this->b = hexdec($blue);
    }
}
?>