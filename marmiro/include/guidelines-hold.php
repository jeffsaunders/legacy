<!-- BEGIN Include guidelines.php -->

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
			if (strtoupper($tab) == "THIN VENEER"){$tabCnt = 1;};
			// Right now there is only one, but in anticipation of more I created a couple stubs
//			if (strtoupper($tab) == "ANOTHER PRODUCT"){$tabCnt = 1;};
//			if (strtoupper($tab) == "ANOTHER PRODUCT"){$tabCnt = 1;};
			?>
			<div id="productTabsContainer">
				<strong class="sectionLabel">Installation Guidelines</strong>
				<!-- Tabs -->
				<div id="tabsContainer">
					<table>
					<tr>
						<td>
							<div id="tabContainer1" class="<?=iif($tabCnt == 1, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(1);" onClick="location.href='?sec=guidelines&prod=&tab=thin veneer';">
								Thin Veneer
							</div>
						</td>
<!-- These are for future use
						<td>
							<div id="tabContainer2" class="<?=iif($tabCnt == 2, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(2);" onClick="location.href='?sec=guidelines&prod=&tab=another product';">
								Another Product
							</div>
						</td>
						<td>
							<div id="tabContainer3" class="<?=iif($tabCnt == 3, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(3);" onClick="location.href='?sec=guidelines&prod=&tab=another product';">
								Another Product
							</div>
						</td>
-->
					</tr>
					</table>
				</div>
			</div>
			<div id="productInfoContainer">
				<!-- Thin Veneer DIV -->
				<div id="infoContainer1" class="infoContainer" style="<?=iif($tabCnt == 1, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- #BeginSnippet name="Thin Veneer Tab" users="marmiroc" wysiwyg="no" -->
							<table width="875" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="325" valign="top">
									<!-- Thumbnails -->
									<table width="325" border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="140" align="center" valign="top">
											<a onClick="document.getElementById('image').src='images/documents/Thin_Veneer_to_Upload-090608.jpg'" class="detailsThumbnail"><img src="images/documents/Thin_Veneer_to_Upload-090608.jpg" alt="Thin_Veneer_to_Upload-090608.jpg" title="Click to View Enlarged" width="140" border="0" class="imageBorder"></a><br>Page 1
										</td>
										<td width="20"></td>
										<td width="140" align="center" valign="top">
											<a onClick="document.getElementById('image').src='images/documents/090608.jpg'" class="detailsThumbnail"><img src="images/documents/090608.jpg" alt="090608.jpg&uacute;" title="Click to View Enlarged" width="140" border="0" class="imageBorder"></a><br>Page 2
										</td>
										<td width="25"></td>
									</tr>
									<tr>
										<td height="10" colspan="2"></td>
									</tr>
									</table>
								</td>
								<!-- Enlarged image -->
								<td width="550" valign="top">
									<img name="image" id="image" src="images/documents/Thin_Veneer_to_Upload-090608.jpg" alt="Thin Veneer Installion Guidelines" width="540" border="0" class="imageBorder">
								</td>
							</tr>
							</table>
							<br>
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
<!-- These are for future use
				<div id="infoContainer2" class="infoContainer" style="<?=iif($tabCnt == 2, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- {#}BeginSnippet name="Tab 2 Subject" users="marmiroc" -->

							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
				<div id="infoContainer3" class="infoContainer" style="<?=iif($tabCnt == 3, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- {#}BeginSnippet name="Tab 3 Subject" users="marmiroc" -->

							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
-->
			</div>

<!-- END Include guidelines.php -->
