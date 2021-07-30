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
			<td width="600"><img src="images/products/<?=$prods['product'][$cnt]['titleImage'];?>" alt="" width="600" height="50" border="0"></td>
			<td width="300" align="right" valign="bottom">$<?=$prods['product'][$cnt]['price'];?> plus S&H<br><span class="detailFootnote">In Stock and Ready to Ship!</td>
		</tr>
		</table>
	</div>
	<div id="details">
		<table>
		<tr>
			<!-- Left Column -->
			<td width="350" valign="top">
				<table cellspacing="10">
				<!-- Enlarged image -->
				<tr>
					<td colspan="2">
						<table cellspacing="0" cellpadding="0">
						<tr>
							<td colspan="2"><img src="images/products/<?=$prods['product'][$cnt]['defaultImage'];?>" id="image<?=$cnt;?>" name="image<?=$cnt;?>" alt="" width="320" height="240" class="detailImage roundedCorners"></td>
						</tr>
						<tr>
							<td><div class="detailFootnote" style="height:0px; margin-top:5px;">Point to Magnify</div></td>
							<td align="right"><div class="detailFootnote" style="height:0px; margin-top:5px;">Use Scroll-Wheel to Zoom</div></td>
						</tr>
						</table>
					</td>
				</tr>
				<!-- Image thumbnails -->
				<tr>
					<td><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb1'];?>" id="thumb1" alt="" title="Click to Enlarge" width="152" class="detailImage roundedCorners" onClick="image<?=$cnt;?>.src='images/products/<?=$prods['product'][$cnt]['images']['image1'];?>';swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['images']['enlarge1'];?>');"></td>
					<td><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb2'];?>" id="thumb2" alt="" title="Click to Enlarge" width="152" class="detailImage roundedCorners" onClick="image<?=$cnt;?>.src='images/products/<?=$prods['product'][$cnt]['images']['image2'];?>';swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['images']['enlarge2'];?>');"></td>
				</tr>
				<tr>
					<td><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb3'];?>" id="thumb3" alt="" title="Click to Enlarge" width="152" class="detailImage roundedCorners" onClick="image<?=$cnt;?>.src='images/products/<?=$prods['product'][$cnt]['images']['image3'];?>';swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['images']['enlarge3'];?>');"></td>
					<td><img src="images/products/<?=$prods['product'][$cnt]['images']['thumb4'];?>" id="thumb4" alt="" title="Click to Enlarge" width="152" class="detailImage roundedCorners" onClick="image<?=$cnt;?>.src='images/products/<?=$prods['product'][$cnt]['images']['image4'];?>';swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['images']['enlarge4'];?>');"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><div class="detailFootnote">Click to Enlarge</div></td>
				</tr>
				</table>
				<!-- Initialize the magnifier for the default enlarged image -->
				<script>swapMagnifier(<?=$cnt;?>,'images/products/<?=$prods['product'][$cnt]['defaultEnlarge'];?>');</script>
			</td>
			<!-- Right column -->
			<td width="550" align="right" valign="top">
				<!-- Selection form -->
				<br>
				<form action="updatecart.php" method="get" name="<?=$prods['product'][$cnt]['item'];?>Form" id="<?=$prods['product'][$cnt]['item'];?>Form">
				<table width="500" border="0">
				<tr>
					<td width="75" align="left">Color:</td>
					<td width="225" align="left">
						<select name="Color" style="width:200px;">
							<?
							for ($clr=0; $clr < sizeof($prods['product'][$cnt]['color']); $clr++){
							?>
							<option value='<?=$prods['product'][$cnt]['color'][$clr]['colorValue'];?>'<?=($prods['product'][$cnt]['color'][$clr]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['color'][$clr]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['color'][$clr]['colorDesc'];?></option>
							<?
							}
							?>
						</select>
					</td>
					<!-- Add to cart button -->
					<td width="200" rowspan="2" align="right" valign="top">
						<img src="images/add-cart.jpg" alt="Add To Cart" width="89" height="28" border="0" title="Add This Item To Your Shopping Cart" onClick="document.forms['<?=$prods['product'][$cnt]['item'];?>Form'].submit();" style="cursor:pointer;"><br>
						<span class="detailFootnote">You May Adjust Quantity in Cart</span>
					</td>
				</tr>
				<tr>
					<td align="left">Size:</td>
					<td align="left">
						<select name="Size" style="width:200px;">
							<?
							for ($size=0; $size < sizeof($prods['product'][$cnt]['size']); $size++){
							?>
							<option value='<?=$prods['product'][$cnt]['size'][$size]['sizeValue'];?>'<?=($prods['product'][$cnt]['size'][$size]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['size'][$size]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['size'][$size]['sizeDesc'];?></option>
							<?
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="left">Width:</td>
					<td align="left">
						<select name="Width" style="width:200px;">
							<?
							for ($wdth=0; $wdth < sizeof($prods['product'][$cnt]['width']); $wdth++){
							?>
							<option value='<?=$prods['product'][$cnt]['width'][$wdth]['widthValue'];?>'<?=($prods['product'][$cnt]['width'][$wdth]['default'] == "Y" ? " selected" : "");?><?=($prods['product'][$cnt]['width'][$wdth]['disabled'] == "Y" ? " disabled" : "");?>><?=$prods['product'][$cnt]['width'][$wdth]['widthDesc'];?></option>
							<?
							}
							?>
						</select>
					</td>
					<!-- Mini social network icons -->
					<td align="right">
						<img src="images/share.jpg" alt="" width="153" height="24" border="0" usemap="#<?=$prods['product'][$cnt]['item'];?>MiniSocialMap" class="roundedCorners">
						<map name="<?=$prods['product'][$cnt]['item'];?>MiniSocialMap" id="<?=$prods['product'][$cnt]['item'];?>MiniSocialMap">
							<area shape="rect" coords="19,3,34,20" href="http://www.facebook.com/PrayerBelts" title="Like Us On Facebook!" target="_blank">
							<area shape="rect" coords="44,3,60,20" href="http://www.twitter.com/PrayerBelts" title="Follow Us On Twitter!" target="_blank">
							<area shape="rect" coords="69,3,84,20" href='mailto:?subject=New Prayer Belts!&body=Hey, check out this cool new Prayer Belt that says "<?=$prods['product'][$cnt]['title'];?>"! http://www.prayerbelts.com' title="Tell Your Friends About Us!">
						</map>
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2" style="padding-top:20px;"><div class="fb-like" data-send="false" data-width="450" data-show-faces="false"></div></td>
				</tr>
				</table>
				<input type="hidden" name="Item" id="Item" value="<?=$prods['product'][$cnt]['item'];?>">
				<input type="hidden" name="Title" id="Title" value="<?=$prods['product'][$cnt]['title'];?>">
				<input type="hidden" name="Image" id="Image" value="<?=$prods['product'][$cnt]['cartThumb'];?>">
				<input type="hidden" name="Price" id="Price" value="<?=$prods['product'][$cnt]['price'];?>">
				<input type="hidden" name="Task" id="Task" value="AddToCart">
				</form>
				<br>
				<!-- Product details -->
				<table width="550" cellspacing="0" cellpadding="10" class="detailInfoTable roundedCorners">
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
			</td>
		</tr>
		</table>
	</div>
</div>
<br>
<?
		// If there are more items, draw a seperator bar
		if($cnt+1 < sizeof($prods['product'])){
?>
<div id="detailsSeperator" class="roundedCorners">&nbsp;</div>
<?
		}
	}
}
?>

<!-- END Include product.php -->
