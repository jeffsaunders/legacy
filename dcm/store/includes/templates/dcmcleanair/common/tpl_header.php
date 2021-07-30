<?
/**
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_header = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_header.php 4813 2006-10-23 02:13:53Z drbyte $
 */
?>

<!-- Bar along top -->
<div id="TopMarginMask" style="position:relative; top:0px; left:0px; width:1000px; height:10px; background-color:#000000;" z-index:3;">
<div id="TopBarContainer" style="position:relative; top:10px; left:0px; width:1000px; height:40px; background-color:#000000;" z-index:1;">
	<div id="HomeIcon" style="position:relative; top:10px; left:15px; width:20px; height:21px; z-index:2;">
		<a href="/home"><img src="/images/HomeIcon.png" alt="" width="20" height="21" border="0"></a>
	</div>
	<div id="PhoneNumber" style="position:relative; top:-7px; left:60px; width:150px; height:21px; vertical-align:bottom; z-index:2;" class="bigWhite">
		800.624.4518
	</div>
	<div id="TopMenuTab" style="position:relative; top:-32px; left:663px; width:322px; height:30px; vertical-align:bottom; background-image:url(/images/TopMenuTab.png); background-position:center bottom; background-repeat:no-repeat; z-index:3;">
		<div id="TopMenuTabMenu" style="position:relative; top:5px; left:0px; width:322px; vertical-align:bottom; z-index:4;" class="bodyWhite">
			<table border="0" cellspacing="5" cellpadding="0" align="center" class="bodyWhite">
			<tr>
				<td><a href="/contact_us" class="bodyWhite"><strong>Contact Us</strong></a></td>
				<td><strong>&nbsp;|&nbsp;</strong></td>
				<?
				if (!$_SESSION['customer_id']) {
				?>
				<td><a href="/store/?main_page=login" class="bodyWhite"><strong>Create An Account</strong></a></td>
				<td><strong>&nbsp;|&nbsp;</strong></td>
				<td><a href="/store/?main_page=login" class="bodyWhite"><strong>Customer Log In</strong></a></td>
				<?
				}else{
				?>
				<td><a href="/store/?main_page=account" class="bodyWhite"><strong>Account Settings</strong></a></td>
				<td><strong>&nbsp;|&nbsp;</strong></td>
				<td><a href="/store/?main_page=logoff" class="bodyWhite"><strong>Customer Log Out</strong></a></td>
				<?
				}
				?>
			</tr>
			</table>
		</div>
	</div>
</div>
<!-- Header -->
<div id="HeaderContainer" style="position:relative; top:10px; left:0px; width:1000px; height:85px; background-color:#FFFFFF; z-index:1;">
	<div id="HeaderLogo" style="position:relative; top:6px; left:15px; width:158px; height:74px; z-index:2;">
		<a href="/home"><img src="/images/HeaderLogo.jpg" alt="" width="158" height="74" border="0"></a>
	</div>
	<div id="HeaderVerticalBar" style="position:relative; top:-61px; left:175px; width:1px; height:63px; z-index:2;">
		<img src="/images/HeaderVerticalBar.gif" alt="" width="1" height="63" border="0">
	</div>
	<div id="HeaderTagline" style="position:relative; top:-103px; left:190px; width:231px; height:27px; z-index:2;">
		<img src="/images/HeaderTagline.png" alt="" width="231" height="27" border="0">
	</div>
	<form action="/store/index.php" method="get" name="searchForm" id="searchForm"> <!-- Outside DIV for formatting -->
<!--	<div id="HeaderSearchBox" style="position:relative; top:-155px; left:688px; width:300px; height:45px; vertical-align:bottom; z-index:2;">-->
	<div id="HeaderSearchBox" style="position:absolute; top:8px; left:688px; width:300px; height:45px; vertical-align:bottom; z-index:2;">
		<table border="0" align="right">
		<tr>
<!--			<td style="font-family:Pictos; font-size:18px;" class="flipTextHoriz">s</td>-->
			<td><img src="/images/MagnifyingGlass.png" alt="" width="20" height="20" border="0"></td>
			<td>
				<input type="text" name="keyword" id="keyword" value="Enter Keyword or Item #" style="width:200; Height:23px; background-color:#E3E3E3;" color:#AAAAAA;" onClick="this.value=''; this.onclick=null; this.style.color='000000'" onKeyPress="return submitenter(this,event)" class="roundedCorners">
				<input type="hidden" name="main_page" id="main_page" value="advanced_search_result">
				<input type="hidden" name="search_in_description" id="search_in_description" value="1">
			</td>
			<td><img src="/images/SearchButton.png" alt="" width="87" height="27" border="0" onClick="document.forms['searchForm'].submit();" style="cursor:pointer;"></td>
		</tr>
		</table>
	</div>
	</form>
	<div id="InfoBox" style="position:absolute; top:50px; left:580px; width:400px; height:40px; z-index:2;">
		<table border="0" align="right" class="smallBlack">
		<tr>
			<td valign="bottom"><strong>Welcome:</strong></td>
			<td valign="bottom"> 
				<?
				if (isset($_SESSION['customer_id'])){
					echo $_SESSION['customer_first_name']." ".$_SESSION['customer_last_name']."&nbsp;&nbsp;<a href='/store/?main_page=logoff' class='smallBlack'>(Log Out)</a>";
				}else{
					echo "Guest&nbsp;&nbsp;<a href='/store/?main_page=login' class='smallBlack'>(Log In)</a>";
				}
				?>
			</td>
			<td width="20"></td>
			<td valign="bottom"><img src="/images/CartIcon.png" alt="" width="18" height="13" border="0"> <a href="/store/?main_page=shopping_cart" class="smallBlack"><strong>My Cart</a>:</strong></td>
			<td valign="bottom">
				<?=$_SESSION['cart']->count_contents();?> Item<?=iif($_SESSION['cart']->count_contents() != 1, "s", "");?>
			</td>
		</tr>
		</table>
	</div>
</div>
<!-- Top Menu -->
<div id="TopMenuContainer" style="position:relative; top:10px; left:0px; width:1000px; height:85px; background-color:#000000; z-index:1;">
	<div id="OurCompanyMenu" style="position:relative; top:10px; left:0px; width:249px; height:80px; background-image:url(/images/TopMenuBG.jpg); background-repeat:repeat-x; z-index:2;" onMouseOver="show('OurCompanyDropdown');" onMouseOut="hide('OurCompanyDropdown');">
		<div id="OurCompany" style="position:relative; top:30px; width:249px; height:45px; text-align:center; z-index:3;" class="titleWhite">
			Our Company
		</div>
		<div id="TheFirstTheBest" style="position:relative; top:5px; width:249px; text-align:center; z-index:3;" class="bodyBlack">
			<em>The first. The best.</em>
		</div>
	</div>
	<div id="OurTechnologyMenu" style="position:relative; top:-70px; left:251px; width:248px; height:80px; background-image:url(/images/TopMenuBG.jpg); background-repeat:repeat-x; z-index:2;" onMouseOver="show('OurTechnologyDropdown');" onMouseOut="hide('OurTechnologyDropdown');">
		<div id="OurTechnology" style="position:absolute; top:30px; width:248px; height:45px; text-align:center; z-index:3;" class="titleWhite">
			Our Technology
		</div>
		<div id="ExperienceTheDifference" style="position:relative; top:50px; width:248px; text-align:center; z-index:3;" class="bodyBlack">
			<em>Experience the difference.</em>
		</div>
	</div>
	<div id="OurServiceMenu" style="position:relative; top:-150px; left:501px; width:248px; height:80px; background-image:url(/images/TopMenuBG.jpg); background-repeat:repeat-x; z-index:2;" onMouseOver="show('OurServiceDropdown');" onMouseOut="hide('OurServiceDropdown');">
		<div id="OurService" style="position:absolute; top:30px; width:248px; height:45px; text-align:center; z-index:3;" class="titleWhite">
			Our Service
		</div>
		<div id="SatisfactionGuaranteed" style="position:absolute; top:50px; width:248px; text-align:center; z-index:3;" class="bodyBlack">
			<em>Satisfaction guaranteed.</em>
		</div>
	</div>
	<div id="OurProductsMenu" style="position:relative; top:-230px; left:751px; width:249px; height:80px; background-image:url(/images/TopMenuBG.jpg); background-repeat:repeat-x; z-index:2;" onMouseOver="show('OurProductsDropdown');" onMouseOut="hide('OurProductsDropdown');">
		<div id="OurService" style="position:relative; top:30px; width:249px; height:45px; text-align:center; z-index:3;" class="titleWhite">
			Our Products
		</div>
		<div id="QualityThatLasts" style="position:relative; top:5px; width:249px; text-align:center; z-index:3;" class="bodyBlack">
			<em>Quality that lasts!</em>
		</div>
	</div>
</div>
<!-- Top Menu Dropdowns-->
<div id="OurCompanyDropdown" style="position:absolute; top:135px; width:249px; height:260px; text-align:center; background-color:#323433; z-index:4; visibility:hidden;" onMouseOver="show(this.id);" onMouseOut="hide(this.id);">
	<div id="OurCompanyAgain" style="position:absolute; top:40px; width:249px; height:45px; text-align:center; z-index:5;" class="titleWhite">
		Our Company
	</div>
	<div id="TheFirstTheBestAgain" style="position:absolute; top:60px; width:249px; text-align:center; z-index:5;" class="bodyBlack">
		<em>The first. The best.</em>
	</div>
	<div id="CompanyMenu" style="position:absolute; top:90px; width:249px; text-align:center; z-index:5;" class="titleWhite">
		<table border="0" cellspacing="10" align="center">
		<tr>
			<td align="center" class="titleWhite"><a href="/about_us" class="titleWhite">About Us</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/legacy" class="titleWhite">The Legacy Lives</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/certifications" class="titleWhite">Certifications</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/the_company_we_keep" class="titleWhite">The Company We Keep</a></td>
		</tr>
		</table>
	</div>
</div>
<div id="OurTechnologyDropdown" style="position:absolute; top:135px; left:251px; width:248px; height:245px; text-align:center; background-color:#323433; z-index:4; visibility:hidden;" onMouseOver="show(this.id);" onMouseOut="hide(this.id);">
	<div id="OurTechnologyAgain" style="position:absolute; top:40px; width:248px; height:45px; text-align:center; z-index:3;" class="titleWhite">
		Our Technology
	</div>
	<div id="ExperienceTheDifferenceAgain" style="position:absolute; top:60px; width:248px; text-align:center; z-index:3;" class="bodyBlack">
		<em>Experience the difference.</em>
	</div>
	<div id="TechnologyMenu" style="position:absolute; top:90px; width:249px; text-align:center; z-index:5;" class="titleWhite">
		<table border="0" cellspacing="10" align="center">
		<tr>
			<td align="center" class="titleWhite"><a href="/test_results" class="titleWhite">Air Quality Test Results</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/technical_statistics" class="titleWhite">Technical Stats</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/assembly_instructions" class="titleWhite">Product Demonstration<br>(Assembly Instructions)</a></td>
		</tr>
		</table>
	</div>
</div>
<div id="OurServiceDropdown" style="position:absolute; top:135px; left:501px; width:248px; height:260px; text-align:center; background-color:#323433; z-index:4; visibility:hidden;" onMouseOver="show(this.id);" onMouseOut="hide(this.id);">
	<div id="OurServiceAgain" style="position:absolute; top:40px; width:248px; height:45px;text-align:center; z-index:3;" class="titleWhite">
		Our Service
	</div>
	<div id="SatisfactionGuaranteedAgain" style="position:absolute; top:60px; width:248px; text-align:center; z-index:3;" class="bodyBlack">
		<em>Satisfaction guaranteed.</em>
	</div>
	<div id="ServiceMenu" style="position:absolute; top:90px; width:249px; text-align:center; z-index:5;" class="titleWhite">
		<table border="0" cellspacing="10" align="center">
		<tr>
			<td align="center" class="titleWhite"><a href="/customer_service" class="titleWhite">Customer Service</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/assembly_instructions" class="titleWhite">Assembly Instructions</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/policies" class="titleWhite">Policies</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/government_services_administration" class="titleWhite">Special Account Set Up</a></td>
		</tr>
		</table>
	</div>
</div>
<div id="OurProductsDropdown" style="position:absolute; top:135px; left:751px; width:249px; height:290px; text-align:center; background-color:#323433; z-index:4; visibility:hidden;" onMouseOver="show(this.id);" onMouseOut="hide(this.id);">
	<div id="OurProductsAgain" style="position:absolute; top:40px; width:249px; height:45px;text-align:center; z-index:3;" class="titleWhite">
		Our Products
	</div>
	<div id="QualityThatLastsAgain" style="position:absolute; top:60px; width:249px; text-align:center; z-index:3;" class="bodyBlack">
		<em>Quality that lasts!</em>
	</div>
	<div id="ProductsMenu" style="position:absolute; top:90px; width:249px; text-align:center; z-index:5;" class="titleWhite">
		<table border="0" cellspacing="10" align="center">
		<tr>
			<td align="center" class="titleWhite"><a href="/store/?main_page=index&cPath=65" class="titleWhite">Vacu-Grinder</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/store/?main_page=index&cPath=66" class="titleWhite">Vacu-Sander</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/store/?main_page=index&cPath=67" class="titleWhite">Vacu-Tools</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/store/?main_page=index&cPath=68" class="titleWhite">Vacu-Systems</a></td>
		</tr>
		<tr>
			<td align="center" class="titleWhite"><a href="/store/?main_page=index&cPath=69" class="titleWhite">Vacuum Components</a></td>
		</tr>
		</table>
	</div>
</div>
<!-- Government Pricing Promo -->
<div id="GovPricingContainer" style="position:relative; top:10px; left:0px; width:1000px; height:51px; background-color:#FFFFFF; z-index:1;">
	<div id="GovPricingBox" style="position:relative; top:15px; width:800px; height:20px; background-color:#425779; z-index:2;">
		<div id="GovPricing" style="position:relative; top:2px; width:400px; left:395px; white-space:nowrap; z-index:3;" class="titleWhite">
			Need volume pricing? Government and special pricing available.
		</div>
	</div>
	<div id="GovPricingArrow" style="position:relative; top:-5px; left:800px; width:20px; height:20px; background-color:#425779; z-index:2;">
		<img src="/images/GovPricingArrow.jpg" alt="" width="20" height="20" border="0">
	</div>
	<div id="CallToActionBox" style="position:relative; top:-25px; left:820px; width:180px; height:20px; background-color:#000F2F; z-index:2;">
		<div id="CallToAction" style="position:relative; top:2px; width:180px; height:20px; white-space:nowrap; text-align:center; z-index:3;" class="titleBlue">
			&nbsp;&nbsp;&nbsp;<a href="/government_services_administration" class="titleBlue">Click here to learn more</a>.
		</div>
	</div>
</div>
