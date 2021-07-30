<!-- BEGIN Include aboutstone.php -->

			<script>
				// Swap the tab class on mouseover and mouseout events
				function flipTab(id){
					if(document.getElementById('infoContainer'+id).style.visibility != 'visible'){
						document.getElementById('tabContainer'+id).className = 'tabContainer';
					}else{
						document.getElementById('tabContainer'+id).className = 'tabHover';
					}
				}
			</script>
			<?
			// This page is static - define tab labels and numbers manually based on passed "tab" value
			$tabCnt = 1;
			if (strtoupper($tab) == "BENEFITS"){$tabCnt = 1;};
			if (strtoupper($tab) == "MATERIALS"){$tabCnt = 2;};
			if (strtoupper($tab) == "FINISHES"){$tabCnt = 3;};
			?>
			<div id="productTabsContainer">
				<strong class="sectionLabel">About Natural Stones</strong>
				<!-- Tabs -->
				<div id="tabsContainer">
					<table>
					<tr>
						<td>
							<div id="tabContainer1" class="<?=iif($tabCnt == 1, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(1);" onClick="location.href='?sec=aboutstone&prod=&tab=benefits';">
								Benefits
							</div>
						</td>
						<td>
							<div id="tabContainer2" class="<?=iif($tabCnt == 2, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(2);" onClick="location.href='?sec=aboutstone&prod=&tab=materials';">
								Materials
							</div>
						</td>
						<td>
							<div id="tabContainer3" class="<?=iif($tabCnt == 3, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(3);" onClick="location.href='?sec=aboutstone&prod=&tab=finishes';">
								Finishes
							</div>
						</td>
					</tr>
					</table>
				</div>
			</div>
			<div id="productInfoContainer">
				<!-- Benefits DIV -->
				<div id="infoContainer1" class="infoContainer" style="<?=iif($tabCnt == 1, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td class="staticContainer">
							<!-- #BeginSnippet name="Benefits of Natural Stone" users="marmiroc" -->
							<p>Natural Stone has been the premium building material of choice since the beginning of time.</p>
							
							<p><strong class="sectionLabel">Benefits of Natural Stone: </strong></p>
							
							<ul>
							    <li>Traditional Beauty</li>
							    <li>Durability</li>
							    <li>Long Lasting</li>
							    <li>Easy Maintenance</li>
							    <li>Superior Quality</li>
							    <li>Affordability</li>
							    <li>Property Value Increase</li>
							</ul>
							
							<p>Stone is a natural product; no two pieces are exactly alike. Because there are scores of natural stones to consider, please contact your Marmiro Stones representative for guidance on choosing the right product.</p> 
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
				<!-- Materials DIV -->
				<div id="infoContainer2" class="infoContainer" style="<?=iif($tabCnt == 2, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td class="staticContainer">
							<!-- #BeginSnippet name="Natural Stone Materials" users="marmiroc" -->
							<p><strong class="sectionLabel">Marble</strong></p>
							<ul>
								<p><em>&ldquo;A metamorphic crystalline rock composed predominately of crystalline grains of calcite, dolomite, or serpentine, and capable of taking a polish.&rdquo;</em></p>
							
								<p>Marble adds a sophisticated element to your property. It is a common choice for floors, wall coverings, table tops, bathroom walls, floors, vanity tops, tub decks, and showers. It can also be used in exterior applications such as pool decks, patios, drive ways, and wall coverings in various finishes like antiqued, sandblasted, and brushed.</p>
							</ul>
							<p><strong class="sectionLabel">Travertine</strong></p>
							<ul>
								<p><em>&ldquo;A light &ndash;colored porous calcite, CaCO3, deposited from solution in ground or surface waters and forming, among other deposits.&rdquo;</em></p>
							
								<p>Travertine is one of the most popular stones for interior and exterior wall cladding, paving, statuary, and curbing. The surface can be left in its natural state with the small holes and pits unfilled. This is a warmer aged look which will acquire a beautiful patina over time. The holes can be filled in order to increase the durability.</p>
							</ul>
							<p><strong class="sectionLabel">Limestone</strong></p>
							<ul>
								<p><em>&ldquo;A sedimentary rock composed primarily of calcite or dolomite.&rdquo;</em></p>
							
								<p>It is widely used as a building stone because it is readily available easy to handle. Popular applications include countertops, wall cladding, interior and exterior flooring.</p>
							</ul>
							<p><strong class="sectionLabel">Slate</strong></p>
							<ul>
								<p><em>&ldquo;A very fine-grained metamorphic rock derived from sedimentary shale rock. Characterized by an excellent parallel cleavage, and entirely independent of original bedding, slate may be split easily into relatively thin slabs.&rdquo;</em></p>
							
								<p>Slate is one of the common stones that are used for exterior paving, walkways, garden, wall covers. Tiles are known to be irregular in shape which allows for some creative applications.</p>
							</ul>
							<p><strong class="sectionLabel">Sandstone</strong></p>
							<ul>
								<p><em>&ldquo;Sedimentary rock composed mainly of sand-sized minerals or rock grains. Most sandstone is composed of quartz and feldspar.&rdquo;</em></p>
							
								<p>Sandstones vary widely in color due to different minerals and clays found in the stone. Sandstone is light gray to yellow or red. Bluestone is a dense, hard, fine grained sandstone quarried in United States.</p>
							</ul>
							<p><strong class="sectionLabel">Granite</strong></p>
							<ul>
								<p><em>&ldquo;A very hard rock consisting of quartz and feldspars.&rdquo;</em></p>
							
								<p>Available in a striking array of colors, granite's durability and longevity make it ideal for kitchen countertops and other heavily used surfaces including table tops and floors. It is one of the most bacteria-resistant kitchen surfaces and it will not stain under normal use. Because of its exceptional strength, granite is well suited for exterior applications such as cladding, paving, and curbing.</p>
							</ul>
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
				<!-- Finishes DIV -->
				<div id="infoContainer3" class="infoContainer" style="<?=iif($tabCnt == 3, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td class="staticContainer">
							<!-- #BeginSnippet name="Natural Stone Finishes" users="marmiroc" -->
							<p><strong class="sectionLabel">Antiqued</strong></p>
							<ul>
								<p>Also known as tumbled, delivers a smooth or slightly pitted surface and broken, rounded edges and corners. Suitable for exterior and interior use, ideal for areas where slip resistance might be a concern such as showers, patios, and pool decks.</p>
							</ul>
							<p><strong class="sectionLabel">Brushed</strong></p>
							<ul>
								<p>Brushed finish is a textured, matte finish that gives the stone a classic antiqued look.</p>
							</ul>
							<p><strong class="sectionLabel">Flamed</strong></p>
							<ul>
								<p>A flamed finish is achieved by heating the surface of the stone to extreme temperatures, followed by rapid cooling. The surface of the stone pops and chips leaving a rough, unrefined texture. This process is usually done with granite. Flamed stone has a highly textured surface, making it ideal for areas where slip resistance might be a concern.</p>
							</ul>
							<p><strong class="sectionLabel">Grass</strong></p>
							<ul>
								<p>Scratched surface with various depth dimensions running through the finished side. Non-slippery surface suitable for both floor and wall applications.</p>
							</ul>
							<p><strong class="sectionLabel">Groove</strong></p>
							<ul>
								<p>Deeply grooved vertical lines in the surface of the stone.</p>
							</ul>
							<p><strong class="sectionLabel">Honed</strong></p>
							<ul>
								<p>Honed surface provides a flat, matte or satin finish, creating a more informal and softer look.</p>
							
								<p>This finish is created by stopping short of the last stage of polishing. A honed finish stains and scratches more easily and requires more maintenance. It has a satin smooth surface with relatively little light reflection.</p>
							</ul>
							<p><strong class="sectionLabel">Polished</strong></p>
							<ul>
								<p>The mirror-like shine is accomplished by using progressively finer polishing heads during the polishing process, similar to the way that sandpaper smoothes hardwood furniture. Usually a very formal look used for interior installations. It reflects light and emphasizes the color markings of the material.</p>
							</ul>
							<p><strong class="sectionLabel">Sandblasted</strong></p>
							<ul>
								<p>Surfaces have a distinct textured feel with good friction caused by the application of sand and pressure. Less color intensity when dry and more when wet. Suitable for floors and walls.</p>
							</ul>
							<p><strong class="sectionLabel">Natural</strong></p>
							<ul>
								<p>Natural-cut stone offers a matte finish. After initial cutting, the stone is processed to remove the heaviest saw marks but not enough to achieve a honed finish. You can purchase granite, marble and limestone this way, typically on a special order basis.</p>
							</ul>
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include aboutstone.php -->
