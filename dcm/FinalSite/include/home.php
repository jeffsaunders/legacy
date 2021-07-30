
<!-- BEGIN Include home.php -->

	<!-- Middle Section -->
	<div id="MiddleSectionContainer" style="position:relative; top:10px; left:0px; width:1000px; height:375px; background-color:#FFFFFF; z-index:1;">
		<!-- #BeginSnippet name="Starter Kit Menu" users="dcmclean" wysiwyg="no" -->
		<div id="StarterKitNavBox" style="position:absolute; top:0px; width:250px; height:375px; background-image:url(images/StarterKitBG.jpg); background-repeat:repeat-x; z-index:2;">
			<div id="StarterKitMenu" style="position:absolute; top:35px; width:250px; text-align:center; z-index:3;" class="titleBlack">
				<table border="0" cellspacing="10" align="center">
				<tr>
					<td align="center"><a href="/store/?main_page=index&cPath=65_70" class="menuBlack">Vacu-Grinder</a></td>
				</tr>
				<tr>
					<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
				</tr>
				<tr>
					<td align="center"><a href="/store/?main_page=index&cPath=66_81" class="menuBlack">Vacu-Sander</a></td>
				</tr>
				<tr>
					<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
				</tr>
				<tr>
					<td align="center"><a href="/store/?main_page=index&cPath=67_107" class="menuBlack">Vacu-Tools</a></td>
				</tr>
				<tr>
					<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
				</tr>
				<tr>
					<td align="center"><a href="/store/?main_page=index&cPath=68_109" class="menuBlack">Vacu-Systems</a></td>
				</tr>
				<tr>
					<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
				</tr>
				<tr>
					<td align="center"><a href="/store/?main_page=index&cPath=69_124" class="menuBlack">Vacuum Components</a></td>
				</tr>
				<tr>
					<td align="center"><img src="images/StarterKitNavBar.png" alt="" width="185" height="3" border="0"></td>
				</tr>
				</table>
			</div>
		</div>
		<!-- #EndSnippet -->
		<div id="MiddlePhotoBox" style="position:absolute; top:0px; right:0px; width:750px; height:375px; background-image:url(images/HomeMiddleImage.jpg); background-position:bottom right; background-repeat:no-repeat; z-index:2;">
			<div id="FrostyBox" style="position:absolute; top:120px; right:0px; width:625px; height:100px; z-index:3;" class="frostWhite">
				<div id="MiddleTagline" style="position:absolute; top:41px; right:0px; width:615px; text-align:center; vertical-align:middle; z-index:4;">
					<img src="images/MiddleTagline.png" alt="" width="549" height="17" border="0">
				</div>
			</div>
		</div>
	</div>
	<!-- Gallery Section -->
	<div id="GallerySectionContainer" style="position:relative; top:10px; left:0px; width:1000px; height:240px; background-color:#FFFFFF; z-index:1;">
		<div id="GalleryBox" style="position:absolute; top:10px; left:8px; width:975px; height:210px; z-index:2; border:4px #848484 solid;">
			<div id="GalleryLabel" style="position:absolute; top:0px; left:0px; width:975px; height:35px; background-color:#000F2F; z-index:3;">
				<div id="OurFeaturedProducts" style="position:absolute; top:8px; width:240px; text-align:center; z-index:3;" class="titleWhite">
					Our Featured Products
				</div>
			</div>
			<script type="text/javascript">
				$(window).load(function() {
					$("div#makeMeScrollable").smoothDivScroll({ 
						autoScroll: "onstart",
						autoScrollDirection: "right", 
						autoScrollStep: 1, 
						autoScrollInterval: 30,	
						mouseDownSpeedBooster: 1,
						startAtElementId: "startAtMe", 
						visibleHotSpots: "always",
						hotSpotsVisibleTime: 1000
					});
				});
			</script>
			<?
			// Grab the database
			include("dbconnect.php");
			// Get all the featured products
			$query = "SELECT products_id
						FROM featured
						WHERE status = '1';";
//echo $query."<br><br>";
			$rs_featured = mysql_query($query, $linkID) or die(mysql_error());
			?>
			<div id="makeMeScrollable" style="position:relative; top:35px; left:0px; width:975px; height:175px; background-color:#FFFFFF; z-index:3;">
				<div class="scrollingHotSpotLeft"></div>
				<div class="scrollingHotSpotRight"></div>
				<div class="scrollWrapper">
					<div class="scrollableArea">
						<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<?
							while ($featured = mysql_fetch_assoc($rs_featured)){
								// Get all the featured product's details
								$query = "SELECT p.products_price, p.products_image, d.products_name
											FROM products p, products_description d
											WHERE p.products_id = d.products_id
											AND p.products_id = '".$featured["products_id"]."';";
//echo $query."<br><br>";
								$rs_details = mysql_query($query, $linkID) or die(mysql_error());
								$details = mysql_fetch_assoc($rs_details)
							?>
							<td valign="top">
								<br>
								<table width="250" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="5"></td>
									<td width="240" height="135" align="center" valign="top">
										<a href="store/?main_page=product_info&products_id=<?=$featured["products_id"];?>" class="scrollerBlack"><img src="store/images/<?=iif($details["products_image"] != "", $details["products_image"], "no_picture.gif");?>" alt="<?=$details["products_name"];?>" height="100" border="0"><br>
										<?=$details["products_name"];?></a><br>
									</td>
									<td width="5"></td>
								</tr>
								<tr>
									<td colspan="3" align="center" valign="top">
										<strong class="bodyBlue">Price: <?=money_format('%(n',$details["products_price"]);?></strong>
									</td>
								</tr>
								</table>
							</td>
							<?
							}
							?>
						</tr>
						</table>				
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Navigation Boxes Section -->
	<div id="NavBoxesContainer" style="position:relative; top:10px; left:0px; width:1000px; height:140px; background-color:#FFFFFF; z-index:1;">
		<!-- #BeginSnippet name="Bottom Menu/Navigation Boxes" users="dcmclean" wysiwyg="no" -->
		<div id="LeftNavBox" style="position:absolute; top:0px; left:8px; width:315px; height:125px; z-index:2; border:2px #848484 solid; background-image:url(images/BottomNavBoxBG.jpg); background-repeat:repeat-x;">
			<div id="LeftNavBoxLabel" style="position:absolute; top:0px; left:0px; width:315px; height:35px; background-color:#000F2F; z-index:3;">
				<div id="RequestAndAccessQuotes" style="position:absolute; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
					<a href="/quote" class="titleWhite">Request and Access Quotes</a>
				</div>
			</div>
			<div id="QuoteCenter" style="position:absolute; top:55px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="/quote" class="titleWhite">QUOTE<br>CENTER</a>
			</div>
		</div>
		<div id="CenterNavBox" style="position:absolute; top:0px; left:340px; width:315px; height:125px; z-index:2; border:2px #848484 solid; background-image:url(images/BottomNavBoxBG.jpg); background-repeat:repeat-x;">
			<div id="CenterNavBoxLabel" style="position:absolute; top:0px; left:0px; width:315px; height:35px; background-color:#000F2F; z-index:3;">
				<div id="DownloadPrintedCatalog" style="position:absolute; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
					<a href="documents/DCMCleanAirCatalog2011.pdf" class="titleWhite">Download Printed Catalog</a>
				</div>
			</div>
			<div id="QuoteCenter" style="position:absolute; top:55px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="/catalog" class="titleWhite">BROWSE<br>CATALOG</a>
			</div>
		</div>
		<div id="RightNavBox" style="position:absolute; top:0px; left:672px; width:315px; height:125px; z-index:2; border:2px #848484 solid; background-image:url(images/BottomNavBoxBG.jpg); background-repeat:repeat-x;">
			<div id="RightNavBoxLabel" style="position:absolute; top:0px; left:0px; width:315px; height:35px; background-color:#000F2F; z-index:3;">
				<div id="AssemblyInstructions" style="position:absolute; top:8px; width:315px; text-align:center; z-index:3;" class="titleWhite">
					<a href="/assembly_instructions" class="titleWhite">Assembly Instructions</a>
				</div>
			</div>
			<div id="ProductDemonstration" style="position:absolute; top:55px; width:315px; text-align:center; z-index:3;" class="titleWhite">
				<a href="/assembly_instructions" class="titleWhite">PRODUCT<br>DEMONSTRATION</a>
			</div>
		</div>
		<!-- #EndSnippet -->
	</div>

<!-- END Include home.php -->

