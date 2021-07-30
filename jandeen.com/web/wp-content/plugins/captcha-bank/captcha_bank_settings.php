<?php
error_reporting(0);
session_start();
global $wpdb;
if (isset($_REQUEST["banner"]))
{
	if(esc_attr($_REQUEST["banner"]) == "no") 
	{
		update_option("captcha-bank-banner", "no");
		?>
		<style type="text/css" >
			#buy_captcha_pro
			{
				display:none;
			}
		</style>
		<?php
	}
}
$settings = $wpdb -> get_col
(
	"SELECT settings_value FROM " . captcha_bank_settings() . " ORDER BY settings_id ASC"
);
$settings_array = array();
for($flag=0; $flag < count($settings); $flag++)
{
	array_push($settings_array, $settings[$flag]);
}
?>
<form id="captcha_settings" class="layout-form" method="post">
	<div class="widget-layout" >
		<div class="widget-layout-title">
			<h4><?php _e( "Captcha Bank Settings", captcha_bank ); ?></h4>
		</div>
		<div class="widget-layout-body">
			<div class="fluid-layout">
				<div class="layout-span12">
					<div id="captcha_settings_message" class="message green" style="display: none;"> 
						<p><strong><?php _e("Success! Captcha settings has been saved.", captcha_bank); ?></strong></p>
					</div>
					<div class="fluid-layout">
						<div class="layout-span8">
							<div class="widget-layout">
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php _e( "Captcha Label", captcha_bank ); ?> :</label>
										<div class = "layout-controls">
											<input name="ux_label" type="text" id="ux_label" class="layout-span12"  value="<?php echo $settings_array[0]; ?>"/>
										</div>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php _e( "Captcha Tooltip", captcha_bank ); ?> :</label>
										<div class = "layout-controls">
											<input name="ux_tooltip" type="text" id="ux_tooltip" class="layout-span12"  value="<?php echo $settings_array[1]; ?>"/>
										</div>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php _e( "Captcha on login form", captcha_bank ); ?> :</label>
										<div class = "layout-controls" style="margin-top: 9px;">
											<?php
											
											if($settings_array[23] == 1)
											{
												?>
												<input type="checkbox"  name="ux_captcha_on_login_form" checked="checked" id="ux_captcha_on_login_form" value="1" />
												<?php
											}
											else
											{
												?>
												<input type="checkbox"  name="ux_captcha_on_login_form" id="ux_captcha_on_login_form" value="1"  />
												<?php
											}
											?>
											
										</div>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php _e( "Captcha on Register form", captcha_bank ); ?> :</label>
										<div class = "layout-controls" style="margin-top: 9px;">
											<?php
											
											if($settings_array[26] == 1)
											{
												?>
												<input type="checkbox"  name="ux_captcha_on_register_form" checked="checked" id="ux_captcha_on_register_form" value="1" />
												<?php
											}
											else
											{
												?>
												<input type="checkbox"  name="ux_captcha_on_register_form" id="ux_captcha_on_register_form" value="1"  />
												<?php
											}
											?>
											
										</div>
									</div>
								</div>
								<div style="margin: 0px -3px;">
									<a href="http://tech-banker.com/captcha-bank/" target="_blank">
										<img src="<?php echo CAPTCHA_BK_PLUGIN_URL .'/assets/images/captcha_bank_settings.png';?>" style="width: 100%;" />
									</a>
								</div>
							</div>
							<button type="submit" id="ux_save_settings" class="btn btn-info"><?php _e("Save and Submit Changes", captcha_bank); ?></button>
						</div>
						<div class="layout-span4">
							<div class="widget-layout">
								<div class="widget-layout-title">
									<h4><?php _e( "Captcha Bank Preview", captcha_bank ); ?></h4>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<label class="layout-control-label"><?php echo $settings_array[0];?></label>
										<img id="captcha_image" title="<?php echo $settings_array[1];?>" style="border: 1px solid #000;margin-right: 15px; cursor: pointer;" src="<?php echo admin_url('admin-ajax.php') . "?sid=" .md5(uniqid());  ?>"  align="left" />
										<a style="float:left;" id="Refresh" href="#" title="Refresh Image" ><img src="<?php echo CAPTCHA_BK_PLUGIN_URL ."/refresh.png"?>" alt="Reload Image" height="25" width="25" onclick="this.blur()" align="bottom" border="0" /></a><br />
									</div>
									<div class="layout-control-group">
										<label><strong>Enter Code*:</strong></label>
										<input type="text" name="security_code" class="layout-span8" maxlength="16" style="margin-left:5px; " />	
									</div>
								</div>
							</div>
						</div>
						<div class="layout-span4">
							<div class="widget-layout">
								<div class="widget-layout-title">
									<h4><?php _e( "Captcha Bank Test", captcha_bank ); ?></h4>
								</div>
								<?php
								if (version_compare(PHP_VERSION, '5.2.0', '<'))
								{
									echo 'CaptchaBankImage requires PHP 5.2.0 or greater in order to run.  You are '
									.'using ' . PHP_VERSION . ' which is very outdated.  Please consider '
									.'upgrading to a newer, more secure version of PHP.<br /<br />';
									exit;
								}
								$GLOBALS['session_start_error'] = null;
								set_error_handler('session_error_handler', E_ALL);
								function session_test()
								{
									if (!isset($_GET['testimage'])) 
									{
										if (isset($_GET['tested'])) 
										{
											if (!isset($_SESSION['captchaBankImage_test_value'])) 
											{
												$GLOBALS['session_start_error'] = 
												"The session started successfully, but the test value "
												."was not found.<br />Click <a href=\"{$_SERVER['PHP_SELF']}\">"
												."here</a> to try the test again.<br />Make sure cookies are enabled in your browser.<br />";
											}
										} 
										else 
										{
											if ($GLOBALS['session_start_error'] != null) 
											{
												echo '<strong>Failed to start the PHP session.</strong><br /><br />'
												.'The <a href="http://php.net/sessions" target="_blank">session</a>'
												.' did not start properly.  This could indicate a problem '
												.'the PHP configuration on this server.<br /><br />'
												.'The following error occurred when attempting to call <i>session_start()</i>:<br />'
												.'<pre style="margin: 25px">' . htmlspecialchars($GLOBALS['session_start_error']) . '</pre>'
												.'<span style="color: #f00">In order for Captcha Bank to work, you '
												.'must resolve the error.</span><br /><br />'
												.'If after searching <a href="https://google.com" target="_blank">Google</a> '
												.'and <a href="http://stackoverflow.com/search" target="_blank">StackOverflow</a> '
												.'for causes to the problem and you still cannot resolve the error, contact '
												.'<a href="http://phpcaptcha.org/contact" target="_blank">the developers</a> '
												.'of Captcha Bank for assistance.<br />Provide as much information about the problem '
												.' and error as possible, and we can help resolve the issue.';
												exit;
											}
											$_SESSION['captchaBankImage_test_value'] = 'test';
											header('Location: admin.php?page=captcha_bank_setting&tested=1');
											exit;
										}
									}
								}
								function print_status($supported)
								{
									if ($supported)
									{
										echo "<span style=\"color: #00f\">Yes!</span>";
									}
									else 
									{
										echo "<span style=\"color: #f00; font-weight: bold\">No</span>";
									}
								}
								function session_error_handler($errno, $errstr, $errfile, $errline)
								{
									$GLOBALS['session_start_error'] = $errstr;
									return true;
								}
								?>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<p><?php _e( "This script will test your PHP installation to see if Captcha Bank will run on your server. ", captcha_bank ); ?></p>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "Session Functionality ", captcha_bank ); ?>:
										</strong>
										<?php print_status($GLOBALS['session_start_error'] == null); ?>
										<?php if ($GLOBALS['session_start_error'] != null): ?>
										<br /><span style="color: #f00">
											<?php _e( "There may be a problem with session support. ", captcha_bank ); ?></span><br />
											<?php echo $GLOBALS['session_start_error'] ?>
										<br />
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "GD Support ", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support = extension_loaded('gd')); ?>
									</div>
								</div>
									<?php if ($gd_support) $gd_info = gd_info(); else $gd_info = array(); ?>
									<?php if ($gd_support); ?>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "GD Version ", captcha_bank ); ?>:
										</strong>
										<?php echo $gd_info['GD Version']; ?>
									</div>
								</div>
									<?php //endif; ?>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "imageftbbox function ", captcha_bank ); ?>:
										</strong>
										<?php print_status(function_exists('imageftbbox')); ?>
										<?php if (function_exists('imageftbbox') == false): ?>
										<br />The <a href="http://php.net/imageftbbox" target="_new">imageftbbox()</a>
										<?php _e( "function is not included with your gd build.  This function is required. ", captcha_bank ); ?> 
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "TTF Support (FreeType) ", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support && $gd_info['FreeType Support']); ?>
										<?php if ($gd_support && $gd_info['FreeType Support'] == false): ?>
										<br />
										<?php _e( "No FreeType support.  You cannot use Captcha Bank 3.0, but can use 2.0 with gd fonts. ", captcha_bank ); ?>
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "JPEG Support ", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support && ((isset($gd_info['JPG Support']) || isset($gd_info['JPEG Support'])))); ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "PNG Support ", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support && $gd_info['PNG Support']); ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "GIF Read Support", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support && $gd_info['GIF Read Support']); ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "GIF Create Support", captcha_bank ); ?>:
										</strong>
										<?php print_status($gd_support && $gd_info['GIF Create Support']); ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "SQLite Support", captcha_bank ); ?>:
										</strong>
										<?php print_status(extension_loaded('pdo_sqlite')); ?><br />
										<?php if (extension_loaded('pdo_sqlite')): ?>
										<?php _e( "SQLite is available. If you choose to use it, Captcha Bank can support users who do not accept cookies.", captcha_bank ); ?>
										<?php else: ?>
										<?php _e( "No SQLite support. Captcha Bank will work but your visitors must accept cookies.", captcha_bank ); ?>
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "MySQL Support", captcha_bank ); ?>:
										</strong>
										<?php print_status(extension_loaded('pdo_mysql')); ?><br />
										<?php if (extension_loaded('pdo_mysql')): ?>
										<?php _e( "MySQL is available. If you choose to use it, Captcha Bank can support users who do not accept cookies by storing codes in MySQL.", captcha_bank ); ?>
										<?php else: ?>
										<?php _e( "No MySQL support. Captcha Bank will work but your visitors must accept cookies.", captcha_bank ); ?>
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<strong>
											<?php _e( "PostgreSQL Support", captcha_bank ); ?>:
										</strong>
										<?php print_status(extension_loaded('pdo_pgsql')); ?><br />
										<?php if (extension_loaded('pdo_pgsql')): ?>
										<?php _e( "PostgreSQL is available.", captcha_bank ); ?>
										<?php else: ?>
										<?php _e( "No PostgreSQL support.", captcha_bank ); ?>
										<?php endif; ?>
									</div>
								</div>
								<div class="widget-layout-body">
									<div class="layout-control-group">
										<?php if ($gd_support && function_exists('imageftbbox')): ?>
										<?php if ($GLOBALS['session_start_error'] != null): ?>
										<?php _e( "There is a warning, but otherwise you meet the requirements for using Captcha Bank.", captcha_bank ); ?>
										<?php else: ?>
										<?php _e( "Your server meets the requirements for using Captcha Bank!", captcha_bank ); ?>
										<?php endif; ?>
										<div style="margin-top:20px;text-align:center">
											<img src="<?php echo CAPTCHA_BK_PLUGIN_URL . '/captcha_bank_test.php?testimage=1' ?>" alt="Test Image" align="bottom" />
										</div>
										<?php else: ?>
										<?php _e( "Based on the requirements, you do not have what it takes to run Captcha Bank :", captcha_bank ); ?> :
										<?php endif; ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>

<script type="text/javascript">
	jQuery("#captcha_settings").validate
	({
		submitHandler: function(form)
		{
			jQuery.post(ajaxurl, jQuery(form).serialize() +"&param=update_settings&action=captcha_settings_library", function(data)
			{
				jQuery('#captcha_settings_message').css('display','block');
				jQuery('body,html').animate({
				scrollTop: jQuery('body,html').position().top}, 'slow');
				setTimeout(function()
				{
					jQuery('#captcha_settings_message').css('display','none');
					window.location.href = "admin.php?page=captcha_bank_setting";
				}, 2000);
			});
		}	
	});
	function OnlyNumbers(evt) 
	{
		var charCode = (evt.which) ? evt.which : event.keyCode;
		if ((charCode > 47 && charCode < 58) || charCode == 127 || charCode == 8) 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}
	
	jQuery('#Refresh').click(function(){
		document.getElementById('captcha_image').src = '<?php echo admin_url('admin-ajax.php') . "?sid=" ?>' + Math.random();
	});
</script>