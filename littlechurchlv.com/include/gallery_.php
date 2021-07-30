<!-- BEGIN INCLUDE Gallery -->

	<script>
	//Mouse pointer on image
	function swapImage(imgName, dest, cap) {
		if (document.images) {
			document[dest].src = imgName;
			if (cap != ""){
				document.getElementById("caption").innerHTML=cap;
			}
		}
	}
	</script>

	<script>
	// Pop open a child window to display larger image
	function popIt(image, caption, width, height) {
		popWin=window.open('about:blank','popup','scrollbars=no,width='+width+',height='+height+',center');
		with (popWin.document){
			writeln('<html><head><title>'+caption+'</title></head>');
			writeln('<body bgcolor=#FAE297 onload=window.resizeTo(document.getElementById(\'image\').width+40,document.getElementById(\'image\').height+150)>');
			writeln('<div align=right><a href=javascript:this.close();><img src=images/CloseWindow.gif alt=Close Window width=135 height=26 border=0></a>&nbsp;</div>');
			writeln('<div align=center><img src='+image+' name=image border=1 galleryimg=no><br>');
			writeln('<font face=sans-serif size=2 color=#000000><strong>'+caption+'</strong></font></div>');
			writeln('</body></html>');
		close();		
		}
		popWin.focus();
	}
	</script>

	<!-- Lightbox -->
	<script type="text/javascript" src="lightbox/lightbox.js"></script>
	<link rel="stylesheet" href="lightbox/lightbox.css" type="text/css" media="screen" />

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">




	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<?
if (!$feature || $feature == "flowers"){
?>
	<tr>
		<!-- Main Body -->
		<td colspan="3" valign="top" class="bodyBlack">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
			<tr>
				<td class="xbigBlack">
					<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
					<strong>Floral Arrangements Photo Gallery</strong><br><br>
				</td>
			</tr>
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
						<td class="bodyBlack">
							<strong>Whether your wedding is traditional or you are affirming your love by renewing your vows, the Little Church of the West offers Weddings that are sure to make your special day memorable.<br><br>

							The following photo gallery exhibits some of the floral arrangements available in our "Forever True" package, custom made with over 20 years of floral design experience from our in-house flower shop.  These bouquets consists of a multiple variety of flowers that create both its beauty and volume.  Simpler versions are available in our  "Marry Me" package and are also available for an additional charge with our other packages.  This is by no means our limit when it comes to designing your perfect bridal bouquet, if you'd like to see something more please <a href="/index/contact/message/flowers" class="bodyBlack">email</a> the chapel and we'll do our best to accommodate your every wish.</strong>
							<!--The following photo gallery exhibits some of the floral arrangements that are available from our inhouse flower shop for your convenience.  If you don't see what you are looking for, please call or <a href="?sec=contact&cargo=flowers" class="bodyBlack">email</a> the chapel and we'll do our best to accomodate your wishes.<br><br>

							All bouquets are made of roses. Although these examples are red, roses naturally grow in any color except for black and blue. Please select the color of your choice when you make your <a href="https://secure.nr.net/littlechurchlv/?sec=reservations&cargo=1" class="bodyBlack">reservation</a>. All bouquets are made in a holder unless a hand-tied bouquet is requested.</strong>-->
						</td>
						<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center"><br><hr width="95%" size="1" color="#000000" noshade></td>
			</tr>
			</table>
		</td>
	</tr>
<?
if (false){
	// Grab flower gallery data
	$query = "SELECT * FROM gallery WHERE gallery = 'flowers' AND display = 'T' ORDER BY position";
	$rs_flowers = mysql_query($query, $linkID);
	// Grab some info from first record for default enlarged image
	$row = mysql_fetch_assoc($rs_flowers);
	$image = $row["image"];
	$caption = $row["name"].iif($row["note"] <> "", "<br>".$row["note"], "<br>&nbsp;");
?>
	<tr>
<!-- Moved to below
		<td width="320" align="center" valign="top" class="bodyBlack">
			<img src="images/gallery/flowers/<? echo $image; ?>" name="Image" id="Image" alt="" width="300" border="1"><br>
			<strong><a id=caption class="bodyBlack" style="text-decoration:none;"><? echo $caption; ?></a></strong>
			<div align="left">
			<ul>
				<li>We offer pre-designed Wedding or Renewal of Vows Packages for your convenience.<br><a href="?sec=packages" class="bodyBlack"><strong>Click Here for Wedding Packages</strong></a>.</li><br><br>
				<li><a href="https://secure.nr.net/littlechurchlv/?sec=reservations&cargo=1" class="bodyBlack"><strong>Click Here Now to Start Your Reservations</strong></a>.</li>
			</ul>
			</div>
			<img src="images/spacer.gif" alt="" width="320" height="1" border="0">
		</td>
-->
		<!-- Spacer -->
		<td>
			<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
		</td>
		<td valign="top">
			<table width="460" border="0" cellspacing="0" cellpadding="0">
<?
	// Go back to the top
	mysql_data_seek($rs_flowers, 0);
	// Step through all the images and display 'em
	for ($counter=1; $counter <= mysql_num_rows($rs_flowers); $counter++){
		$row = mysql_fetch_assoc($rs_flowers);
?>
			<tr>
				<td width="220" align="left" valign="top" class="bodyBlack">
					<!-- Image -->
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td width="80" align="left" class="smallBlack">
							<img src="images/gallery/flowers/<? echo $row["image"]; ?>" alt="<? echo $row["name"]; ?>" width="75" border="1" onMouseOver="swapImage('images/gallery/flowers/<? echo $row["image"]; ?>','Image','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>&nbsp;"); ?>')" onClick="javascript:popIt('images/gallery/flowers/<? echo $row["large_image"]; ?>','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>"); ?>','530','700');" style="cursor:pointer;"><br><div align="center"><span onMouseOver="swapImage('images/gallery/flowers/<? echo $row["image"]; ?>','Image','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>&nbsp;"); ?>')" style="cursor:pointer;"> Point to View</span><br><span onClick="javascript:popIt('images/gallery/flowers/<? echo $row["large_image"]; ?>','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>"); ?>','530','700');" style="cursor:pointer;">Click to Enlarge</span></div>
						</td>
						<td align="left" valign="top" class="bodyBlack">
							<strong><? echo $row["name"]; ?></strong><hr width="100%" size="1" color="#000000" noshade><? echo $row["description"]; ?>
						</td>
					</tr>
					</table>
				</td>
<?
		// Second column
		$counter++;
		$row = mysql_fetch_assoc($rs_flowers);
		if ($row != 0){ // If there is another image
?>
				<td width="220" align="left" valign="top" class="bodyBlack">
					<!-- Image -->
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td width="80" align="left" class="smallBlack">
							<img src="images/gallery/flowers/<? echo $row["image"]; ?>" alt="<? echo $row["name"]; ?>" width="75" border="1" onMouseOver="swapImage('images/gallery/flowers/<? echo $row["image"]; ?>','Image','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>&nbsp;"); ?>')" onClick="javascript:popIt('images/gallery/flowers/<? echo $row["large_image"]; ?>','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>"); ?>','530','700');" style="cursor:pointer;"><br><div align="center"><span onMouseOver="swapImage('images/gallery/flowers/<? echo $row["image"]; ?>','Image','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>&nbsp;"); ?>')" style="cursor:pointer;"> Point to View</span><br><span onClick="javascript:popIt('images/gallery/flowers/<? echo $row["large_image"]; ?>','<? echo addslashes($row["name"]).iif($row["note"] <> "", "<br>".$row["note"], "<br>"); ?>','530','700');" style="cursor:pointer;">Click to Enlarge</span></div>
						</td>
						<td align="left" valign="top" class="bodyBlack">
							<strong><? echo $row["name"]; ?></strong><hr width="80%" size="1" color="#000000" noshade><? echo $row["description"]; ?>
						</td>
					</tr>
					</table>
				</td>
			</tr>
<?
		}
		if ($counter < mysql_num_rows($rs_flowers)){ // If there are more images
?>
			<tr>
				<td colspan="2"><hr width="100%" size="1" color="#000000" noshade></td>
			</tr>
<?
		}
	}
?>
			</table>
			<br>
		</td>
		<!-- Enlarged Image -->
		<td width="320" align="center" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
			<tr>
				<td align="center">
					<img src="images/gallery/flowers/<? echo $image; ?>" name="Image" id="Image" alt="" width="300" border="1" galleryimg="no"><br>
					<strong><a id=caption class="bodyBlack" style="text-decoration:none;"><? echo $caption; ?></a></strong><br>
					<br>
				</td>
			</tr>
<!--			<tr>
				<td align="center">
<!--
onClick="swapImage('images/gallery/flowers/LargeHandTied2-Big.jpg','Image','')"
<br><p onClick=\"swapImage(\'images/gallery/flowers/LargeHandTied2-Big.jpg\',\'Image\',\'\')\">Click for Next Image</p>
--
<?
If ($row["quantity"] > 1){
	echo'				<a onClick=\"swapImage(\'images/gallery/flowers/LargeHandTied2-Big.jpg\',\'Image\',\'\')\" class="bodyBlack">Click for Next Image</a><br>';
}else{
	echo'				<br><br>';
}
?>
				</td>
			</tr>-->
			<tr>
				<td>
					<ul>
						<li>We offer pre-designed Wedding or Renewal of Vows Packages for your convenience.<br><a href="?sec=packages" class="bodyBlack"><strong>Click Here for Wedding Packages</strong></a>.</li><br><br>
						<li><a href="https://secure.nr.net/littlechurchlv/?sec=reservations&cargo=1" class="bodyBlack"><strong>Click Here Now to Start Your Reservations</strong></a>.</li>
					</ul>
				</td>
			</tr>
			</table>
<!--			<img src="images/spacer.gif" alt="" width="320" height="1" border="0">-->
		</td>
	</tr>
<?
}
?>






		<!-- Spacer -->
		<td>
			<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
		</td>
		<td valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/RegalHandTied.jpg" rel="lightbox" Title="'Regal' Hand-Tied Bouquet"><img src="images/gallery/flowers/RegalHandTied.jpg" alt="'Regal' Hand-Tied Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Regal" hand-tied bouquet of Mango Calla Lilies accentuated with a whimsical swirl of gold metallic wire.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Calla Lilies are available in White, Blush Pink, Mango, Dark Purple, and Yellow. <em>*colors limited by season</em></li>
										<li>Wire available in Apple Green, Aqua, Black, Chocolate, Copper, Gold, Hot Pink, Purple, Red, Royal Blue, and Silver.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/EverFaithfulHandTied.jpg" rel="lightbox" Title="'Ever Faithful' Hand-Tied Bouquet"><img src="images/gallery/flowers/EverFaithfulHandTied.jpg" alt="'Ever Faithful' Hand-Tied Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Ever Faithful" hand-tied bouquet of Dark Purple Schwartz Calla Lilies, Cool Water Violet Roses, Purple Lisianthus and Purple Statice surrounded by Seeded Eucalyptus.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Calla Lilies are available in White, Blush Pink, Mango, Dark Purple, and Yellow. <em>*colors limited by season</em></li>
										<li>Roses are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Lisianthus is available in White, Lavender, Purple, Pink, and Yellow.</li>
										<li>Statice is available in White, Light Blue, Lavender, Purple, Pink, and Yellow.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/BeautifulHandTied.jpg" rel="lightbox" Title="'Beautiful' Hand-Tied Bouquet"><img src="images/gallery/flowers/BeautifulHandTied.jpg" alt="'Beautiful' Hand-Tied Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Beautiful" hand-tied bouquet of richly colored Gerbera Daisy's, Circus Roses, Freesia, and Monkey Tails.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Gerbera Daisy's are available in White, Pink, Magenta, Red, Burgundy, Peach, Orange, and Yellow.</li>
										<li>Circus Roses are Yellow roses with Orange tips.</li>
										<li>Freesia is available in White, Lavender, Purple, Pink, Magenta, Red, Orange, and Yellow.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/SimplyElegant.jpg" rel="lightbox" Title="'Simply Elegant' Bouquet"><img src="images/gallery/flowers/SimplyElegant.jpg" alt="'Simply Elegant' Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Simply Elegant" long lasting white bouquet of Mini Calla Lilies, Mt. Everest Roses, Mini Carnations, and Stephanotis.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Calla Lilies are available in White, Blush Pink, Mango, Dark Purple, and Yellow. <em>*colors limited by season</em></li>
										<li>Roses are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Carnations are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Stephanotis is available in White only.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="99%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/TrueDelaration.jpg" rel="lightbox" Title="'True Delaration of Love' Bouquet"><img src="images/gallery/flowers/TrueDelaration.jpg" alt="'True Delaration of Love' Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"True Declaration of Love" with Red Roses, Black Magic Roses, Tulips, Carnations, and Hypericum Berries all hand-tied together with Ti Leaf.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Roses are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Tulips are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Carnations are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Hypericum Berries are available Pink, Red, Burgundy, Peach, Orange, Green, and Brown.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="99%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="120" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/HavePurePassion.jpg" rel="lightbox" Title="'Have Pure Passion' Bouquet"><img src="images/gallery/flowers/HavePurePassion.jpg" alt="'Have Pure Passion' Bouquet" width="100" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Have Pure Passion" with Hot Lady Pink Roses, Pink Tulips, Pink Lisianthus, White Stock, Pink Wax Flower all enhanced with Tree Fern and indulged with solitaire rhinestones.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Roses are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Tulips are available in most naturally grown colors. <em>(no blue or black)</em></li>
										<li>Lisianthus is available in White, Lavender, Purple, Pink, and Yellow.</li>
										<li>Wax Flower is available in White, Ivory, Pink, and Lavender.</li>
										<li>Stock is available in White, Lavender, Purple, Pink, Magenta, Peach, and Yellow.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td width="100%" align="left" valign="top" class="bodyBlack">
					<table border="0" cellspacing="0" cellpadding="0" align="left">
					<tr>
						<td>
							<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="bodyBlack">
							<tr>
								<td width="208" rowspan="2" align="center" valign="top">
									<a href="images/gallery/flowers/Magnificent.jpg" rel="lightbox" Title="'Magnificent' Bouquet"><img src="images/gallery/flowers/Magnificent.jpg" alt="'Magnificent' Bouquet" height="125" border="0"></a><br>
									<strong class="smallBlack">Click to Enlarge</strong>
								</td>
								<td>
									<strong>"Magnificent" bouquet of Blush Calla Lilies, Ivory Vandella Roses, and Pink Wax Flower adorned with Italian Ruscus.<br><br></strong>
								</td>
							</tr>
							<tr>
								<td valign="top">
									<ul>
										<li>Calla Lilies are available in White, Blush Pink, Mango, Dark Purple, and Yellow.<br><em>*colors limited by season</em></li>
										<li>Wax Flower is available in White, Ivory, Pink, and Lavender.</li>
									</ul>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
<!--			<tr>
				<td><img src="images/spacer.gif" alt="" width="1" height="20" border="0"></td>
			</tr>-->
			</table>
			
			
			
			
			
			
			
			
			

<?
}elseif ($feature == "photos"){
?>
	<tr>
		<!-- Main Body -->
		<td valign="top" class="bodyBlack">
			<br>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
			<tr>
				<td colspan="3" class="xbigBlack">
					<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
					<strong>Photo Gallery</strong><br><br>
				</td>
			</tr>
			<tr>
				<td align="center" class="bodyBlack"><br><br><br><strong>&mdash; Coming Soon &mdash;</strong></td>
			</tr>
			</table>
		</td>
	</tr>
<?
}elseif ($task == "grounds"){
	// Not terribly fond of this layout but it's the way Greg wanted it...
?>
	<tr>
		<!-- Main Body -->
		<td valign="top" class="bodyBlack">
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td colspan="2" class="xbigBlack">
							<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
							<strong>Chapel &amp; Grounds Photo Gallery</strong><br><br>
						</td>
						<td rowspan="2" valign="top">
							<img src="images/360Tour.gif" alt="" width="200" height="125" border="0" onMouseOver="show('360Tour');" style="cursor:pointer;">
						</td>
					</tr>
					<tr>
						<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
						<td class="bodyBlack">
							<strong>We invite you to enjoy a quick pictorial tour of our beautiful one acre grounds and our historic chapel.<br><br>Located directly on the World Famous Las Vegas "Strip", yet worlds away from the neon and plastic, The Little Church of the West is an oasis of love and romance in a setting reminiscent of the Las Vegas of yesteryear.</strong>
						</td>
<!--						<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>-->
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td align="center"><br><hr width="860" size="1" color="#000000" noshade></td>
			</tr>
			<tr>
				<td align="center">
					<?
					// Grab grounds gallery data
					$query = "SELECT * FROM gallery WHERE gallery = 'grounds' AND display = 'T' ORDER BY location ASC, position ASC";
					$rs_grounds = mysql_query($query, $linkID);
					$row = mysql_fetch_assoc($rs_grounds);
					?>
					<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td rowspan="99"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
						<td width="415" align="center" valign="top">
							<div id="galleryContainer" style="position:relative; width:415; height:400; align:center; display:block;">
								<img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
								<img src="images/gallery/grounds/<? echo $row["image"]; ?>" alt="" name="image" id="image" border="1">
								<br><strong id="caption"><? echo $row["caption"]; ?></strong>
								<div id="360Tour" style="position:absolute; top:0; left:0; width:415; height:415; z-index:1; background-color:#f8f6e8; visibility:hidden">
									<img src="images/spacer.gif" alt="" width="1" height="1" border="0"><br>
									<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
<!-- I *HATE* that all the crap HAS to reside in the site root!! -->
<!-- Add code to check for JVM - link to download if not installed -->
									<applet
										codebase  = "."
										archive   = "/twviewer.jar"
										code      = "com.easypano.tw.TWViewer.class"
										name      = "TWViewer"
										width     = "375"
										height    = "300"
										hspace    = "0"
										vspace    = "0"
										mayscript = "true"
											>
										<PARAM name = iniFile value = "Config_LITTLECHAPEL.txt">
										<PARAM name = skin.bgcolor value = "248, 246, 232">
										<PARAM name = skin.waitingimg value = "360TourSplash.jpg">
										<PARAM name = skin.archive value = "Skin_LITTLECHAPEL.zip">
										<PARAM name = skin.archive.itemnum value = "21">
										<PARAM name = progress.color value = "58, 110, 165">
										<PARAM name = progress.bounds value = "53, 267, 268, 21">
										<PARAM name = comappletname value = "UserApplet1">
									</applet>
								</div>
							</div>
						</td>
						<td><img src="images/spacer.gif" alt="" width="12" height="1" border="0"></td>
						<td valign="top">
							<table border="0" cellspacing="5" cellpadding="0">
							<?
							// Step through all the exterior pics and display 'em
							$rowcounter = 0;
							// Go back to the top
							mysql_data_seek($rs_grounds, 0);
							for ($counter=1; $counter <= mysql_num_rows($rs_grounds); $counter++){
								$rowcounter++;
								if ($rowcounter < 6){
									// 3 at a time
									echo'<tr>';
									for ($cntr=1; $cntr <= 3; $cntr++){
										if ($counter > mysql_num_rows($rs_grounds)){break;}
										$row = mysql_fetch_assoc($rs_grounds);
										echo'	<td width="33%" align="center"><img src="images/gallery/grounds/'.$row["image"].'" alt="" height="75" border="1" onMouseOver="image.src=\'images/gallery/grounds/'.$row["image"].'\';document.getElementById(\'caption\').innerHTML = \''.$row["caption"].'\';hide(\'360Tour\');" style="cursor:pointer;"></td>';
										if ($cntr < 3){$counter++;}
									}
									echo'</tr>';
								}else{
									if ($rowcounter == 6){
										echo'
													</table>
												</td>
											</tr>
											<tr>
												<td colspan="3" valign="top">
													<table border="0" cellspacing="5" cellpadding="0">
										';
									}
									echo'<tr>';
									// 7 at a time
									for ($cntr=1; $cntr <= 7; $cntr++){
										if ($counter > mysql_num_rows($rs_grounds)){break;}
										$row = mysql_fetch_assoc($rs_grounds);
										echo'	<td width="14%" align="center"><img src="images/gallery/grounds/'.$row["image"].'" alt="" height="75" border="1" onMouseOver="image.src=\'images/gallery/grounds/'.$row["image"].'\';document.getElementById(\'caption\').innerHTML = \''.$row["caption"].'\';hide(\'360Tour\');" style="cursor:pointer;"></td>';
										if ($cntr < 7){$counter++;}
									}
									echo'</tr>';
								}
							}
							?>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
<?
}
?>
	</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- END INCLUDE Gallery -->

