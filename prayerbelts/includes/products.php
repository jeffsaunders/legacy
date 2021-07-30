<!-- BEGIN Include product.php -->

<!-- Power Zoomer Scripts -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/ddpowerzoomer.js">
/***********************************************
* Image Power Zoomer- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/
</script>
<script type="text/javascript">
	// Set up magnify effect
	// Function to swap the HiRes image for the magnification
	function swapMagnifier(num,newIMG){
		jQuery(document).ready(function($){
			$('#image'+num).addpowerzoom({
				defaultpower: 3,
				powerrange: [2,9],
				largeimage: newIMG,
				magnifiersize: [150,150]
			})
		})
	}
</script>

<!-- Facebook Javascript SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="overview">
	<p>Prayer Belts are 100% color-fast polyester with sturdy metal D-Ring loop-thru closures.  The embroidered faith-affirming messages are centered on the belt so they can be viewed across the back of the wearer's waist, like a billboard.</p>

	<p>We are introducing Prayer Belts with the following faith-affirming messages:</p>
	<br>
</div>
<div id="detailsSeperator" class="roundedCorners">&nbsp;</div>
<?
// Load up the products XML
$xml = simplexml_load_file('xml/products.xml');
$json = json_encode($xml);
$prods = json_decode($json, TRUE);
//print_r($prods);
for ($cnt=0; $cnt < sizeof($prods['product']); $cnt++){
	// If the item is "in stock" then display it
	if($prods['product'][$cnt]['inStock'] == "Y"){
?>
<div id="detail">
	<div id="detailHeadline">
		<table>
		<tr>
			<td width="450"><img src="images/products/<?=$prods['product'][$cnt]['titleImage'];?>" alt="" width="400"border="0"></td>
			<td width="450" align="right"><img src="images/products/<?=$prods['product'][$cnt+1]['titleImage'];?>" alt="" width="400"border="0"></td>
		</tr>
		</table>
	</div>
	<div id="details">
		<table>
		<tr>
			<!-- Left Column -->
			<td width="270" valign="top">
				<table cellspacing="10">
				<!-- Enlarged image -->
				<tr>
					<td colspan="2">
						<table cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2"><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['defaultImage'];?>" id="image<?=$cnt;?>" name="image<?=$cnt;?>" alt="" width="240" class="detailImage roundedCorners"></a></td>
						</tr>
						<tr>
							<td><div class="detailFootnote" style="height:0px; margin-top:5px;">Point to Magnify</div></td>
							<td align="right"><div class="detailFootnote" style="height:0px; margin-top:5px;">Scroll-Wheel to Zoom</div></td>
						</tr>
						</table>
					</td>
				</tr>
				<!-- Image thumbnails -->
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb1'];?>" id="thumb<?=$cnt;?>-1" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb2'];?>" id="thumb<?=$cnt;?>-2" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb3'];?>" id="thumb<?=$cnt;?>-3" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb4'];?>" id="thumb<?=$cnt;?>-4" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb5'];?>" id="thumb<?=$cnt;?>-5" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');"><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb6'];?>" id="thumb<?=$cnt;?>-6" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><a href="javascript:void(0);" onClick="show('overlayMask'); show('inJesusGallery');" class="detailFootnote">Click to Enlarge</a></td>
				</tr>
				<!-- Add to cart button -->
				<tr>
					<td colspan="2" align="center"">
						<img src="images/add-cart.jpg" alt="Add To Cart" width="89" height="28" border="0" title="Add This Item To Your Shopping Cart" onClick="document.forms['<?=$prods['product'][$cnt]['item'];?>Form'].submit();" style="cursor:pointer;"><br>
						<span class="detailFootnote">You May Adjust Quantity in Cart</span>
					</td>
				</tr>
				</table>
				<!-- Initialize the magnifier for the default enlarged image -->
				<script>swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['defaultEnlarge'];?>');</script>
				<form action="updatecart.php" method="get" name="<?=$prods['product'][$cnt]['item'];?>Form" id="<?=$prods['product'][$cnt]['item'];?>Form">
					<input type="hidden" name="Color" id="Color" value="<?=$prods['product'][$cnt]['color'][1]['colorValue'];?>">
					<input type="hidden" name="Size" id="Size" value="<?=$prods['product'][$cnt]['size'][1]['sizeValue'];?>">
					<input type="hidden" name="Width" id="Width" value="<?=$prods['product'][$cnt]['width'][1]['widthValue'];?>">
					<input type="hidden" name="Item" id="Item" value="<?=$prods['product'][$cnt]['item'];?>">
					<input type="hidden" name="Title" id="Title" value="<?=$prods['product'][$cnt]['title'];?>">
					<input type="hidden" name="Image" id="Image" value="<?=$prods['product'][$cnt]['cartThumb'];?>">
					<input type="hidden" name="Price" id="Price" value="<?=$prods['product'][$cnt]['price'];?>">
					<input type="hidden" name="Task" id="Task" value="AddToCart">
				</form>
			</td>
			<!-- Center column -->
			<td width="360" align="center" valign="top">
				<br>
				<table border="0">
				<tr>
					<td align="right" class="detailPrice">$<?=$prods['product'][$cnt]['price'];?> plus S&H<br><span class="detailFootnote">In Stock and Ready to Ship!</span></td>
				</tr>
				</table>
				<table width="300" border="0">
				<tr>
					<td width="60" align="left" style="font-weight:normal;">Color:</td>
					<td width="240" align="left">
<!--						<select name="Color" style="width:200px;">
							<?
							for ($clr=0; $clr < sizeof($prods['product'][$cnt]['color']); $clr++){
							?>
							<option value='<?=$prods['product'][$cnt]['color'][$clr]['colorValue'];?>'<?=($prods['product'][$cnt]['color'][$clr]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['color'][$clr]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['color'][$clr]['colorDesc'];?></option>
							<?
							}
							?>
						</select>-->
						<?=$prods['product'][$cnt]['color'][1]['colorDesc'];?>
					</td>
				</tr>
				<tr>
					<td align="left" style="font-weight:normal;">Size:</td>
					<td align="left">
<!--						<select name="Size" style="width:200px;">
							<?
							for ($size=0; $size < sizeof($prods['product'][$cnt]['size']); $size++){
							?>
							<option value='<?=$prods['product'][$cnt]['size'][$size]['sizeValue'];?>'<?=($prods['product'][$cnt]['size'][$size]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['size'][$size]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['size'][$size]['sizeDesc'];?></option>
							<?
							}
							?>
						</select>-->
						<?=$prods['product'][$cnt]['size'][1]['sizeDesc'];?>
					</td>
				</tr>
				<tr>
					<td align="left" style="font-weight:normal;">Width:</td>
					<td align="left">
<!--						<select name="Width" style="width:200px;">
							<?
							for ($wdth=0; $wdth < sizeof($prods['product'][$cnt]['width']); $wdth++){
							?>
							<option value='<?=$prods['product'][$cnt]['width'][$wdth]['widthValue'];?>'<?=($prods['product'][$cnt]['width'][$wdth]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['width'][$wdth]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['width'][$wdth]['widthDesc'];?></option>
							<?
							}
							?>
						</select>-->
						<?=$prods['product'][$cnt]['width'][1]['widthDesc'];?>
					</td>
				</tr>
				</table>
				<br>
				<!-- Product details -->
				<table width="350" cellspacing="0" cellpadding="10" class="detailInfoTable roundedCorners">
				<tr>
					<td align="center" class="detailInfoTableHeader">Product Information</td>
				</tr>
				<tr>
					<td class="detailInfoTableContent roundedBottoms">
						<ul>
							<?
							for ($bullet=0; $bullet < sizeof($prods['product'][$cnt]['detail']); $bullet++){
							?>
							<li><?=$prods['product'][$cnt]['detail'][$bullet];?></li>
							<?
							}
							?>
						</ul>
					</td>
				</tr>
				</table>
				<div align="right"><a href="?sec=returns">Shipping & Returns Policy</a></div>
				<br>
				<table width="320" border="0">
				<tr>
					<td align="center"><div class="fb-like" data-send="false" data-width="320" data-show-faces="false"></div></td>
				</tr>
				<!-- Mini social network icons -->
				<tr>
					<td align="center">
						<br>
						<img src="images/share.jpg" alt="" width="153" height="24" border="0" usemap="#<?=$prods['product'][$cnt]['item'];?>MiniSocialMap" class="roundedCorners">
						<map name="<?=$prods['product'][$cnt]['item'];?>MiniSocialMap" id="<?=$prods['product'][$cnt]['item'];?>MiniSocialMap">
							<area shape="rect" coords="19,3,34,20" href="http://www.facebook.com/PrayerBelts" title="Like Us On Facebook!" target="_blank">
							<area shape="rect" coords="44,3,60,20" href="http://www.twitter.com/PrayerBelts" title="Follow Us On Twitter!" target="_blank">
							<area shape="rect" coords="69,3,84,20" href='mailto:?subject=New Prayer Belts!&body=Hey, check out this cool new Prayer Belt that says "<?=$prods['product'][$cnt]['title'];?>"! http://www.prayerbelts.com' title="Tell Your Friends About Us!">
						</map>
					</td>
				</tr>
				</table>
			</td>
			<!-- Right Column -->
			<td width="270" valign="top">
				<table cellspacing="10">
				<!-- Enlarged image -->
				<tr>
					<td colspan="2">
						<table cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2"><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['defaultImage'];?>" id="image<?=$cnt+1;?>" name="image<?=$cnt+1;?>" alt="" width="240" class="detailImage roundedCorners"></a></td>
						</tr>
						<tr>
							<td><div class="detailFootnote" style="height:0px; margin-top:5px;">Point to Magnify</div></td>
							<td align="right"><div class="detailFootnote" style="height:0px; margin-top:5px;">Scroll-Wheel to Zoom</div></td>
						</tr>
						</table>
					</td>
				</tr>
				<!-- Image thumbnails -->
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb1'];?>" id="thumb<?=$cnt+1;?>-1" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb2'];?>" id="thumb<?=$cnt+1;?>-2" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb3'];?>" id="thumb<?=$cnt+1;?>-3" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb4'];?>" id="thumb<?=$cnt+1;?>-4" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb5'];?>" id="thumb<?=$cnt+1;?>-5" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
					<td><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');"><img src="images/products/<?=$prods['product'][$cnt+1]['images']['thumb6'];?>" id="thumb<?=$cnt+1;?>-6" alt="" title="Click to Enlarge" width="112" class="detailImage roundedCorners" onClick=""></a></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><a href="javascript:void(0);" onClick="show('overlayMask'); show('JesusIsGallery');" class="detailFootnote">Click to Enlarge</a></td>
				</tr>
				<!-- Add to cart button -->
				<tr>
					<td colspan="2" align="center"">
						<img src="images/add-cart.jpg" alt="Add To Cart" width="89" height="28" border="0" title="Add This Item To Your Shopping Cart" onClick="document.forms['<?=$prods['product'][$cnt+1]['item'];?>Form'].submit();" style="cursor:pointer;"><br>
						<span class="detailFootnote">You May Adjust Quantity in Cart</span>
					</td>
				</tr>
				</table>
				<!-- Initialize the magnifier for the default enlarged image -->
				<script>swapMagnifier(<?=$cnt+1;?>,'images/products/<?=$prods['product'][$cnt+1]['defaultEnlarge'];?>');</script>
				<form action="updatecart.php" method="get" name="<?=$prods['product'][$cnt+1]['item'];?>Form" id="<?=$prods['product'][$cnt+1]['item'];?>Form">
					<input type="hidden" name="Color" id="Color" value="<?=$prods['product'][$cnt+1]['color'][1]['colorValue'];?>">
					<input type="hidden" name="Size" id="Size" value="<?=$prods['product'][$cnt+1]['size'][1]['sizeValue'];?>">
					<input type="hidden" name="Width" id="Width" value="<?=$prods['product'][$cnt+1]['width'][1]['widthValue'];?>">
					<input type="hidden" name="Item" id="Item" value="<?=$prods['product'][$cnt+1]['item'];?>">
					<input type="hidden" name="Title" id="Title" value="<?=$prods['product'][$cnt+1]['title'];?>">
					<input type="hidden" name="Image" id="Image" value="<?=$prods['product'][$cnt+1]['cartThumb'];?>">
					<input type="hidden" name="Price" id="Price" value="<?=$prods['product'][$cnt+1]['price'];?>">
					<input type="hidden" name="Task" id="Task" value="AddToCart">
				</form>
			</td>
		</tr>
		</table>
	</div>
</div>
<br>
<?
		$cnt++;
		// If there are more items, draw a seperator bar
		if($cnt+1 < sizeof($prods['product'])){
?>
<div id="detailsSeperator" class="roundedCorners">&nbsp;</div>
<?
		}
	}
}
?>

<!-- Popup Galleries -->
<script>
	// --- Flip Layers
	function show(id) {
		document.getElementById(id).style.visibility = "visible";
		document.getElementById(id).style.display = "block";
	}
	function hide(id) {
		document.getElementById(id).style.visibility = "hidden";
		document.getElementById(id).style.display = "none";
	}
</script>

<script language="javascript" type="text/javascript" src="js/swfobject.js"></script>

<div id="overlayMask" style="position:fixed; top:0px; left:0px; width:100%; height:100%; z-index:999; display:none; visibility:hidden;">
	<img src="images/Overlay.png" alt="" width="100%" height="100%">
</div>

<div id="inJesusGallery" style="position:absolute; top:0px; left:50%; margin-left:-460px; width:920px; height:620px; border:solid white 15px; background-color:#FFFFFF; z-index:1000; display:none; visibility:hidden;" class="roundedCorners">
	<div id="inJesusGalleryFrame">
		<?
		include("includes/InJesusGallery.php");
		?>
	</div>
</div>

<div id="JesusIsGallery" style="position:absolute; top:0px; left:50%; margin-left:-460px; width:920px; height:620px; border:solid white 15px; background-color:#FFFFFF; z-index:1000; display:none; visibility:hidden;" class="roundedCorners">
	<div id="JesusIsGalleryFrame">
		<?
		include("includes/JesusIsGallery.php");
		?>
	</div>
</div>

<!-- END Include product.php -->
