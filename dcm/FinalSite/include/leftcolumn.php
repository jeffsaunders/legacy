
<!-- BEGIN Include leftcolumn.php -->

		<!-- Left Column -->
		<div id="LeftColumnContainer" style="position:relative; top:10px; left:0px; width:250px; background-color:#FFFFFF; z-index:2;">
			<!-- Starter Kit Nav -->
			<div id="StarterKitNavBox" style="position:relative; top:-10px; width:250px; height:375px; background-image:url(images/StarterKitBG.jpg); background-repeat:repeat-x; z-index:3;">
				<!-- #BeginSnippet name="Starter Kit Menu" users="dcmclean" wysiwyg="no" -->
				<div id="StarterKitMenu" style="position:relative; top:14px; left:0px; width:250px; text-align:center; z-index:4;" class="titleBlack">
					<br>
					<table border="0" cellspacing="10" align="center">
					<tr>
						<td align="center"><a href="/store/?main_page=index&cPath=65" class="menuBlack">Vacu-Grinder</a></td>
					</tr>
					<tr>
						<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
					</tr>
					<tr>
						<td align="center"><a href="/store/?main_page=index&cPath=66" class="menuBlack">Vacu-Sander</a></td>
					</tr>
					<tr>
						<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
					</tr>
					<tr>
						<td align="center"><a href="/store/?main_page=index&cPath=67" class="menuBlack">Vacu-Tools</a></td>
					</tr>
					<tr>
						<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
					</tr>
					<tr>
						<td align="center"><a href="/store/?main_page=index&cPath=68" class="menuBlack">Vacu-System</a></td>
					</tr>
					<tr>
						<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
					</tr>
					<tr>
						<td align="center"><a href="/store/?main_page=index&cPath=69" class="menuBlack">Vacu-Components</a></td>
					</tr>
					<tr>
						<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
					</tr>
					</table>
				</div>
				<!-- #EndSnippet -->
			</div>
			<?
			// Grab the database
			include("dbconnect.php");
			// Get a random featured product
			$query = "SELECT products_id
						FROM featured
						WHERE status = '1'
						ORDER BY rand()
						LIMIT 1;";
//echo $query."<br><br>";
			$rs_featured = mysql_query($query, $linkID) or die(mysql_error());
			$featured = mysql_fetch_assoc($rs_featured);
			// Get all the featured product's details
			$query = "SELECT p.products_price, p.products_image, d.products_name
						FROM products p, products_description d
						WHERE p.products_id = d.products_id
						AND p.products_id = '".$featured["products_id"]."';";
//echo $query."<br><br>";
			$rs_details = mysql_query($query, $linkID) or die(mysql_error());
			$details = mysql_fetch_assoc($rs_details)
			?>
			<!-- Promo Box -->
			<div id="PromoBox" style="position:relative; top:5px; left:10px; width:230px; text-align:center; background-color:#FFFFFF; border:black thin solid; display:block; z-index:4;">
				<br>
				<strong class="titleBlack">&mdash; Featured Product &mdash;</strong><br>
				<br><a href="store/?main_page=product_info&products_id=<?=$featured["products_id"];?>" class="scrollerBlack"><?=$details["products_name"];?><br><br>
				<strong class="bigBlue"><em><?=money_format('%(n',$details["products_price"]);?></em></strong><br><br>
				<img src="store/images/products/<?=iif($details["products_image"] != "", $details["products_image"], "no_picture.gif");?>" alt="<?=$details["products_name"];?>" width="200" border="0"></a><br><br>
				<div id="PricingBox" style="position:relative; bottom:0px; width:230px; height:20px; background-color:#425779; z-index:2;">
					<div id="PricingArrow" style="position:relative; top:0px; left:15px; width:20px; height:20px; background-color:#425779; z-index:3;">
						<img src="images/GovPricingArrow.jpg" alt="" width="20" height="20" border="0">
					</div>
					<div id="CallToActionBox" style="position:relative; top:-20px; left:30px; width:200px; height:20px; background-color:#000F2F; z-index:2;">
						<div id="CallToAction" style="position:relative; top:2px; width:200px; height:20px; white-space:nowrap; text-align:left; z-index:3;" class="titleBlue">
							&nbsp;&nbsp;&nbsp;<a href="store/?main_page=product_info&products_id=<?=$featured["products_id"];?>" class="titleOrange">Click Here to ORDER NOW!</a>
						</div>
					</div>
				</div>
<!--				<img src="images/WidgetPromoBox.jpg" alt="" width="218" height="274" border="0">-->
			</div>
			<br><br><br>
		</div>

<!-- END Include leftcolumn.php -->

