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
			// Default to tab 1 if none passed
			$tabCnt = 1;
			// To add another tab, copy one of these and add it it after the last one, or wherever you want to place it, then edit it accordingly
			// Then proceed to adding the tab code below
			if (strtoupper($tab) == "THIN VENEER"){$tabCnt = 1;};
			if (strtoupper($tab) == "PAVERS"){$tabCnt = 2;};
			if (strtoupper($tab) == "COPING"){$tabCnt = 3;};
			?>
			<div id="productTabsContainer">
				<strong class="sectionLabel">Installation Guidelines</strong>
				<!-- Tabs -->
				<div id="tabsContainer">
					<table>
					<tr>
						<!-- To add another tab, copy one of these from <td> to </td> and add it after the last one or wherever in between, then edit it -->
						<!-- Then proceed to adding the tab content below -->
						<td>
							<div id="tabContainer1" class="<?=iif($tabCnt == 1, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(1);" onClick="location.href='?sec=guidelines&prod=&tab=thin veneer';">
								Thin Veneer
							</div>
						</td>
						<td>
							<div id="tabContainer2" class="<?=iif($tabCnt == 2, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(2);" onClick="location.href='?sec=guidelines&prod=&tab=pavers';">
								Pavers
							</div>
						</td>
						<td>
							<div id="tabContainer3" class="<?=iif($tabCnt == 3, "tabHover", "tabContainer");?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(3);" onClick="location.href='?sec=guidelines&prod=&tab=coping';">
								Coping
							</div>
						</td>

					</tr>
					</table>
				</div>
			</div>
			<div id="productInfoContainer">
				<!-- To add another tab, copy one of these from <div> to </div> and add it after the last one or wherever in between, then edit it -->
				<!-- Then proceed to adding the tab content below -->
				<!-- Thin Veneer DIV -->
				<div id="infoContainer1" class="infoContainer" style="<?=iif($tabCnt == 1, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- #BeginSnippet name="thin-veneer-install-guidelines" users="marmiroc" wysiwyg="yes" -->
							<table width="875" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top">
									<!-- Thumbnails -->
									<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="140" align="center" valign="top">
											<a href="images/documents/thin-veneer-installation-guideline-marmiro-stones.pdf" class="eventLink" target="_blank"><img src="images/documents/thin-veneer-installation-guideline-marmiro-stones.jpg" alt="Click to Download Thin Veneer Installation Guideline" title="Click to Download" width="140" border="0" class="imageBorder"></a><br><a href="images/documents/thin-veneer-installation-guideline-marmiro-stones.pdf" class="eventLink" target="_blank">Download Thin Veneer Installation Guildeline</a>
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
							<!-- #EndSnippet -->
							<br>
						</td>
					</tr>
					</table>
				</div>
				<!-- Paver DIV -->
				<div id="infoContainer2" class="infoContainer" style="<?=iif($tabCnt == 2, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- #BeginSnippet name="paver-install-guidelines" users="marmiroc" wysiwyg="yes" -->
							<table width="875" border="o" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top">
									<!-- Thumbnails -->
									<table border="o" cellspacing="0" cellpadding="0" align="center">
									<tr>
										<td width="140" align="center" valign="top">
											<a href="images/documents/paver-mortared-installation-guideline-marmiro-stones.pdf" class="detailsThumbnail" target="_blank"><img src="images/documents/paver-mortared-installation-guideline-marmiro-stones.jpg" alt="Click to Download Installation Guideline" title="Click to Download" width="140" border="0" class="imageBorder"></a><br><a href="images/documents/paver-mortared-installation-guideline-marmiro-stones.pdf" class="eventLink" target="_blank">Download Paver Mortared Installation Guildeline </a>
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
										<a href="images/documents/paver-dry-laid-lobascio-installation-guideline-marmiro-stones.pdf" class="detailsThumbnail" target="_blank"><img src="images/documents/paver-dry-laid-lobascio-installation-guideline-marmiro-stones.jpg" alt="Click to Download Installation Guideline" title="Click to Download" width="140" border="0" class="imageBorder"></a><br><a href="images/documents/paver-dry-laid-lobascio-installation-guideline-marmiro-stones.pdf" class="eventLink" target="_blank">Download Paver Dry Laid (Lobascio) Installation Guildeline </a>	
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
										<a href="images/documents/paver-dry-laid-installation-guideline-marmiro-stones.pdf" class="detailsThumbnail" target="_blank"><img src="images/documents/paver-dry-laid-installation-guideline-marmiro-stones" alt="Click to Download Paver Dry Laid Installation Guideline" title="Click to Download" width="140" border="0" class="imageBorder"></a><br><a href="images/documents/paver-dry-laid-installation-guideline-marmiro-stones.pdf" target="_blank" class="eventLink">Download Paver Dry Laid Installation Guildeline </a>		
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
							<br>
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
				<!-- Coping DIV -->
				<div id="infoContainer3" class="infoContainer" style="<?=iif($tabCnt == 3, "display:block; visibility:visible;", "display:none; visibility:hidden;");?>">
					<table width="920" cellspacing="20" align="center">
					<tr>
						<td>
							<!-- #BeginSnippet name="coping-install-guidelines" users="marmiroc" wysiwyg="yes" -->
							<table width="875" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td valign="top">
									<!-- Thumbnails -->
									<table border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td width="140" align="center" valign="top">
											<a href="images/documents/paver-mortared-installation-guideline-marmiro-stones.pdf" class="detailsThumbnail" target="_blank"><img src="images/documents/paver-mortared-installation-guideline-marmiro-stones.jpg" alt="Click to Download Installation Guideline" title="Click to Download" width="140" border="0" class="imageBorder"></a><br><a href="images/documents/paver-mortared-installation-guideline-marmiro-stones.pdf" class="eventLink" target="_blank">Download Paver Mortared Installation Guildeline </a>
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
										<td width="40"></td>
										<td width="140" align="center" valign="top">
											<!-- Thumbnail & Link -->
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
							<br>
							<!-- #EndSnippet -->
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include guidelines.php -->