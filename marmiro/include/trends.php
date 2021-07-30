<!-- BEGIN Include trends.php -->

			<script>
				// Swap the tab class on mouseover and mouseout events
				// Since the logic in this function varies on occasion, just load it from each include instead of globally
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
			if (strtoupper($tab) == "VIRTUAL CATALOG"){$tabCnt = 1;};
			if (strtoupper($tab) == "MARMIRO LITERATURE"){$tabCnt = 2;};
			if (strtoupper($tab) == "4X4 SAMPLE KITS"){$tabCnt = 3;};
			if (strtoupper($tab) == "PRODUCT LINE BOARDS"){$tabCnt = 4;};
			if (strtoupper($tab) == "DISTRIBUTOR DISPLAYS"){$tabCnt = 5;};
			if (strtoupper($tab) == "REQUEST MARKETING TRENDS"){$tabCnt = 6;};
			?>
			<div id="productTabsContainer">
				<strong class="sectionLabel">Marketing Trends</strong>
				<!-- Tabs -->
				<div id="tabsContainer">
					<table>
					<tr>
						<td>
							<div id="tabContainer1" class="<?=iif($tabCnt == 1, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(1);" onClick="location.href='?sec=trends&tab=virtual catalog';">
								Virtual Catalog
							</div>
						</td>
						<td>
							<div id="tabContainer2" class="<?=iif($tabCnt == 2, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(2);" onClick="location.href='?sec=trends&tab=marmiro literature';">
								Marmiro Literature
							</div>
						</td>
						<td>
							<div id="tabContainer3" class="<?=iif($tabCnt == 3, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(3);" onClick="location.href='?sec=trends&tab=4x4 sample kits';">
								4x4 Sample Kits
							</div>
						</td>
						<td>
							<div id="tabContainer4" class="<?=iif($tabCnt == 4, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(4);" onClick="location.href='?sec=trends&tab=product line boards';">
								Product Line Boards
							</div>
						</td>
						<td>
							<div id="tabContainer5" class="<?=iif($tabCnt == 5, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(5);" onClick="location.href='?sec=trends&tab=distributor displays';">
								Distributor Displays
							</div>
						</td>
						<td>
							<div id="tabContainer6" class="<?=iif($tabCnt == 6, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(6);" onClick="location.href='?sec=trends&tab=request marketing trends';">
								Request Marketing Trends
							</div>
						</td>
					</tr>
					</table>
				</div>
			</div>
			<div id="productInfoContainer">
				<!-- Virtual Catalog DIV -->
				<div id="infoContainer1" class="infoContainer" style="<?=iif($tabCnt == 1, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<!-- #BeginSnippet name="Virtual Catalog Tab" users="marmiroc" wysiwyg="no" -->
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td colspan="2" class="infoLabel">Virtual Catalog</td>
					</tr>
					<tr>
						<td>
							<a href="images/documents/Catalog.pdf" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;"><img src="ResizeImage.php?image=images/Catalog.jpg&amp;width=474&amp;height=1000&amp;format=jpg" alt="Catalog" title="Click Here to View Catalog" width="474" height="629" border="0" class="imageContainer"></a>
						</td>
						<td width="100%" valign="top" class="staticContainer">
							<div align="center"><br><br><br><br><br><br><br><br><br><a href="images/documents/Catalog.pdf" onclick="window.open(this.href); return false;" onkeypress="window.open(this.href); return false;" class="bodyText" style="font-size:18px;">Click Here to View Catalog</a></div>
						</td>
					</tr>
					</table>
					<!-- #EndSnippet -->
				</div>
				<!-- Marmiro Literature DIV -->
				<div id="infoContainer2" class="infoContainer" style="<?=iif($tabCnt == 2, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<!-- #BeginSnippet name="Marmiro Literature Tab" users="marmiroc" wysiwyg="no" -->
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td class="infoLabel">Marmiro Literature</td>
					</tr>
					<tr>
						<td>
							<img src="ResizeImage.php?image=images/MarmiroLiterature.jpg&amp;width=900&amp;height=1000&amp;format=jpg" alt="Marmiro Literature" title="Marmiro Literature" width="900" height="596" border="0" class="imageContainer">
							<!--<img src="images/MarmiroLiterature.jpg" alt="Marmiro Literature" title="Marmiro Literature" width="900" height="596" border="0" class="imageContainer">-->
						</td>
					</tr>
					</table>
					<!-- #EndSnippet -->
				</div>
				<!-- 4x4 Sample Kits DIV -->
				<div id="infoContainer3" class="infoContainer" style="<?=iif($tabCnt == 3, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<!-- #BeginSnippet name="4x4 Sample Kits Tab" users="marmiroc" wysiwyg="no" -->
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td class="infoLabel">4x4 Sample Kits</td>
					</tr>
					<tr>
						<td>
							<img src="ResizeImage.php?image=images/SampleKit.jpg&amp;width=900&amp;height=1000&amp;format=jpg" alt="Sample Kit" title="4x4 Sample Kit" width="900" height="597" border="0" class="imageContainer">
						</td>
					</tr>
					</table>
					<!-- #EndSnippet -->
				</div>
				<!-- Product Line Boards DIV -->
				<div id="infoContainer4" class="infoContainer" style="<?=iif($tabCnt == 4, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<!-- #BeginSnippet name="Product Line Boards Tab" users="marmiroc" wysiwyg="no" -->
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td class="infoLabel">Product Line Boards</td>
					</tr>
					<tr>
						<td>
							<img src="ResizeImage.php?image=images/ProductLineBoards.jpg&amp;width=900&amp;height=1000&amp;format=jpg" alt="Product Line Boards" title="Product Line Boards" width="900" height="648" border="0" class="imageContainer">
						</td>
					</tr>
					</table>
					<!-- #EndSnippet -->
				</div>
				<!-- Distributor Displays DIV -->
				<div id="infoContainer5" class="infoContainer" style="<?=iif($tabCnt == 5, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<!-- #BeginSnippet name="Distributor Displays Tab" users="marmiroc" wysiwyg="no" -->
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td class="infoLabel">Distributor Displays</td>
					</tr>
					<tr>
						<td>
							<img src="ResizeImage.php?image=images/DistributorDisplays.jpg&amp;width=900&amp;height=1000&amp;format=jpg" alt="Distributor Displays" title="Distributor Displays" width="900" height="472" border="0" class="imageContainer">
						</td>
					</tr>
					</table>
					<!-- #EndSnippet -->
				</div>
				<!-- Request Marketing Trends DIV -->
				<div id="infoContainer6" class="infoContainer" style="<?=iif($tabCnt == 6, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="940" cellspacing="20" align="center">
					<tr>
						<td colspan="2" class="infoLabel">Request Marketing Trends</td>
					</tr>
<!-- Version with image on the left for page layout consistancy.  Marmiro asked to have it removed in favor of inconsistency...
					<tr>
						<td width="375">
							<img src="images/showstand.jpg" alt="" width="375" height="900" border="0" class="imageContainer"></a>
						</td>
						<td valign="top">
							<?
							// If the form was submitted and the user is sent back here
//							if ($prod == "sent"){
							?>
							<div align="center">
								<br><br>
								<strong><?=$config["request_thankyou"];?></strong>
							</div>
							<?
							// Display the form
//							}else{
							?>
							<script type="text/javascript" src="js/swfobject.js"></script>
							<div id="CC2184454" style="z-index:1;">Form Object</div>
							<script type="text/javascript">
								var so = new SWFObject("flash/requestform.swf", "xml/requestform.xml", "500", "902", "7,0,0,0", "#ffffff");so.addParam("classid", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000");so.addParam("quality", "high");so.addParam("scale", "noscale");so.addParam("salign", "lt");so.addParam("FlashVars", "xmlfile=xml/requestform.xml&w=500&h=902");so.write("CC2184454");
							</script> 
							<?
//							}
							?>
						</td>
					</tr>
-->
					<tr>
						<td width="940" align="center">
							<?
							// If the form was submitted and the user is sent back here
							if ($prod == "sent"){
							?>
							<div align="center">
								<br><br>
								<strong><?=$config["request_thankyou"];?></strong>
							</div>
							<?
							// Display the form
							}else{
							?>
							<script type="text/javascript" src="js/swfobject.js"></script>
							<div id="CC2184454" style="z-index:0;"></div>
							<script type="text/javascript">
								var so = new SWFObject("flash/requestform.swf", "xml/requestform.xml", "900", "902", "7,0,0,0", "#ffffff");so.addParam("classid", "clsid:d27cdb6e-ae6d-11cf-96b8-444553540000");so.addParam("quality", "high");so.addParam("scale", "noscale");so.addParam("salign", "lt");so.addParam("FlashVars", "xmlfile=xml/requestform.xml&w=900&h=902");so.write("CC2184454");
							</script> 
							<?
							}
							?>
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include trends.php -->
