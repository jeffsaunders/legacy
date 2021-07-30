<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 15511 2010-02-18 07:19:44Z drbyte $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>


	<!-- Navigation Boxes Section -->
	<!-- #BeginSnippet name="Store Pages Bottom Menu" users="dcmclean" wysiwyg="no" -->
	<div id="NavBoxesContainer" style="position:relative; top:0px; left:0px; width:1000px; height:50px; background-color:#FFFFFF; z-index:1;">
		<br>
		<div id="LeftNavBox" style="position:relative; top:0px; left:8px; width:315px; height:35px; background-color:#000F2F; z-index:2; border:2px #848484 solid;">
			<div id="RequestAndAccessQuotes" style="position:relative; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="/quote" class="titleWhite">Request and Access Quotes</a>
			</div>
		</div>
		<div id="CenterNavBox" style="position:relative; top:-39px; left:340px; width:315px; height:35px; background-color:#000F2F; z-index:2; border:2px #848484 solid;">
			<div id="DownloadPrintedCatalog" style="position:relative; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="documents/DCMCleanAirCatalog2011.pdf" class="titleWhite">Download Printed Catalog</a>
			</div>
		</div>
		<div id="RightNavBox" style="position:relative; top:-78px; left:672px; width:315px; height:35px; background-color:#000F2F; z-index:2; border:2px #848484 solid;">
			<div id="AssemblyInstructions" style="position:relative; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="/assembly_instructions" class="titleWhite">Assembly Instructions</a>
			</div>
		</div>
	</div>
	<!-- #EndSnippet -->
	<!-- Footer -->
	<!-- #BeginSnippet name="Store Pages Footer" users="dcmclean" wysiwyg="no" -->
	<div id="FooterContainer" style="position:relative; top:0px; left:0px; width:1000px; height:40px; background-color:#FFFFFF; z-index:1;">
		<div id="FooterMenu" style="position:relative; top:5px; left:10px; width:350px; vertical-align:bottom; z-index:2;" class="bodyBlue">
			<table border="0" cellspacing="5" cellpadding="0" class="bodyBlue">
			<tr>
				<td><a href="/privacy_policy" class="bodyBlue"><strong>Privacy Policy</strong></a></td>
				<td><strong>&nbsp;|&nbsp;</strong></td>
				<td><a href="/store/?main_page=shippinginfo" class="bodyBlue"><strong>Shipping & Returns</strong></a></td>
				<td><strong>&nbsp;|&nbsp;</strong></td>
				<td><a href="/frequently_asked_questions" class="bodyBlue"><strong>F.A.Q.</strong></a></td>
			</tr>
			</table>
		</div>
		<div id="FooterCopyright" style="position:relative; top:-15px; left:385px; width:600px; text-align:right; vertical-align:bottom; z-index:2;" class="bodyBlack">
			&copy; <?=date('Y');?>, DCM Clean Air Products, Inc. All Rights Reserved.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Developed by: <a href="http://www.envisionworks.org" target="_blank" class="bodyBlack">Envision Works, Inc.</a>
		</div>
	</div>
	<!-- #EndSnippet -->
	<br><br>
