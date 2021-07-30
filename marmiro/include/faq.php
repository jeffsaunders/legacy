<!-- BEGIN Include faq.php -->

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

			<!-- Tabs -->
			<div id="productTabsContainer">
				<strong class="sectionLabel">Frequently Asked Questions</strong>
				<div id="tabsContainer">
					<table>
					<tr>
			<?
			// Group all of the question by "line"
			$query = "SELECT DISTINCT line
						FROM faq
						ORDER BY 'position' ASC;";
//echo $query."<br><br>";
			$rs_tabs = mysql_query($query, $linkID);
			// Start a counter for the tab number
			$tabCnt = 0;
			// Define which tab is in focus - default to the first one, value can be overridden below
			$showDiv = 1;
			while ($tabLabel = mysql_fetch_assoc($rs_tabs)){
				// Increment counter
				$tabCnt++;
				// If this tab matches the one passed in the URL, make it the one in focus
				if (strtoupper(urldecode($tab)) == strtoupper($tabLabel["line"])){
					// Make it red
					$tabClass = "tabHover";
					// Flag it's accompanying DIV as being in focus
					$showDiv = $tabCnt;
					// Store label name for later use
					$packageLabel = $tabLabel["line"];
				// it's not the "one"
				}else{
					// Make it normal
					$tabClass = "tabContainer";
				}
			?>
						<td>
							<div id="tabContainer<?=$tabCnt;?>" class="<?=$tabClass;?>" onMouseOver="this.className='tabHover';" onMouseOut="flipTab(<?=$tabCnt;?>);" onClick="location.href='?sec=<?=$sec;?>&prod=<?=$prod;?>&tab=<?=strtolower($tabLabel["line"]);?>';">
								<?=$tabLabel["line"];?>
							</div>
						</td>
			<?
			}
			?>
					</tr>
					</table>
				</div>
			</div>
			<!-- DIVs for each tab -->
			<div id="productInfoContainer">
				<?
				mysql_data_seek($rs_tabs, 0);
				$divCnt = 0;
				while ($div = mysql_fetch_assoc($rs_tabs)){
					$divCnt++;
				?>
				<div id="infoContainer<?=$divCnt;?>" class="infoContainer"<?=iif($divCnt == $showDiv, ' style="display:block; visibility:visible;"', ' style="display:none; visibility:hidden;"');?>>
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td class="staticContainer">
					<?
					$query = "SELECT *
								FROM faq
								WHERE line = '".$div["line"]."'
								AND display = 'T'
								ORDER BY position ASC;";
//echo $query."<br><br>";
					$rs_faq = mysql_query($query, $linkID);
					// Start a counter for the FAQ number
					$faqCnt = 0;
					while ($faq = mysql_fetch_assoc($rs_faq)){
						// Increment counter
						$faqCnt++;
					?>
							<!-- Question -->
							<strong class="sectionLabel"><li><?=$faq["question"];?></li></strong>
							<!-- Answer -->
							<ul>
								<?=$faq["answer"];?>
							</ul>
					<?
					}
					?>
						</td>
					</tr>
					</table>
				</div>
				<?
				}
				?>
			</div>

<!-- END Include faq.php -->
