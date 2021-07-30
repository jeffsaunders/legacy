<form id="captcha_documentation" class="layout-form" method="post">
	<div class="widget-layout" >
		<div class="widget-layout-title">
			<h4><?php _e( "Captcha Bank - Documentation", captcha_bank ); ?></h4>
		</div>
		<div class="widget-layout-body" style="margin:10px;">
			<div class="fluid-layout">
				<div class="layout-span12">
					<form id="captcha_documentation" class="form-horizontal" method="post">
						<div class="fluid-layout">
							<div class="layout-span8">
								<div class="widget-layout">
									<div class="widget-layout-body">
										<iframe width="690" height="320" src="//www.youtube.com/embed/jxq9_f7uYfM" frameborder="0" allowfullscreen></iframe>
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
					</form>
				</div>
			</div>
		</div>
	</div>
</form>