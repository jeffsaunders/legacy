			<!-- BEGIN include webcam.php -->

			<!-- Interrogate and reassign passed variables -->
			<?
			$date = $_REQUEST['date'];
			$groom = $_REQUEST['groom'];
			$bride = $_REQUEST['bride'];
			?>
			
			<!-- Build list of available wedding clips -->
			<?
			// Functions
			
			// Break apart a path to a filename into array elements
			function myglob ($pattern) {
				$path_parts = pathinfo ($pattern);
				$pattern = '^' . str_replace (array ('*',  '?'), array ('(.+)', '(.)'), $path_parts['basename'] . '$');
				$dir = opendir ($path_parts['dirname']);
				while ($file = readdir ($dir)) {
					if (ereg ($pattern, $file)) $result[] = "{$path_parts['dirname']}/$file";
				}
				closedir ($dir);
				if (isset($result))return $result;
				return (array) null;
			}
			
			// Sort an array into "natural" order...as a human would order it
			function compare($a, $b) {
				return strnatcasecmp($a[0], $b[0]);
			}
			
			// Search for the first occurance of a passed value in ANY element of any dimension array.
			function multi_array_search($search_value, $the_array){
				if (is_array($the_array)){
					foreach ($the_array as $key => $value){
						// Special code added for this implementation.
						// Does the comparison UPPER to UPPER. The passed $search_value must be all upper!
						// Remove this if() to restore case sensitive comparisons...
						if (is_string($value)){
							$the_array[$key] = strtoupper($value);
						}
						// ...and change the comparison back to $value.
						$result = multi_array_search(stripslashes($search_value), $the_array[$key]);
						if (is_array($result)){
							$return = $result;
							array_unshift($return, $key);
							return $return;
						}elseif ($result == true){
							$return[] = $key;
							return $return;
						}
					}
					return false;
				}else{
					if ($search_value == $the_array){
						return true;
					}else return false;
				}
			}
			
			function find_video($groom_name, $bride_name, $array){
//print_r($array);
				foreach ($array as $key => $wedding){
					if (strtoupper($wedding[1]) == strtoupper($groom_name) && strtoupper($wedding[2]) == strtoupper($bride_name)){
//print_r($wedding);
						return $wedding;
			//		}else{
			//			return false;
					}
				}
			}
			?>
			
			<?
			// Here we go...........
			$clipname = "/webcam/stock/HistoryOfTheLittleChurch.flv";
			// Anything passed?  If so, are they all good to go?
			if ($date != "" || $groom != "" || $bride != "") {
				// Start a string of what's wrong, in case something is.
				$errorstring = "The following is missing:\\n\\n";
				if ($date != "" && $groom != "" && $bride != "") {
					// Create a multidimensional array to hold the filename info
					$weddings = array(array());
					// Remove (pop off) the annoying empty element that creates
					$pop = array_pop($weddings);
					// Break up the full path to each filename and push the values onto the stack
//					foreach(myglob("/var/www/html/littlechurchlv.com/httpdocs/webcam/*.flv") as $filename) {
					foreach(myglob("/var/www/webcam/*.flv") as $filename) {
//						$path = explode('/',$filename); // [7] => groom-bride@timestamp.flv
//						$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
						$path = explode('/',$filename); // [4] => groom-bride@timestamp.flv
						$noext = explode('.',$path[4]); // [0] => groom-bride@timestamp
						$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
//echo $timestamp[0];
						$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride
						// If the date they selected is the date of the embedded timestamp, push it onto the stack, if not, skip it.
						// End result is an array of filename info for ONLY the clips from the date they specified.
						if (date("mdy",$date) == date("mdy",$timestamp[1])){
//							array_push($weddings,array($timestamp[1],$couple[0],$couple[1],$path[7]));
							array_push($weddings,array($timestamp[1],$couple[0],$couple[1],$path[4]));
						}
					}
			
					// Sort the results by timestamp
					usort($weddings, "compare");

// Debug
//print_r($weddings);

//reset($weddings);
//while (list($key, list($ftimestamp, $fgroom, $fbride, $filename)) = each($weddings)) {
//	echo date("m/d/y@h:ia", $ftimestamp)." $fgroom-$fbride $filename<br>";
//}
			
					// Search for a filename that matches the entered info.
					// Look for Groom first.
			//		$result = multi_array_search(strtoupper($groom), $weddings);
					// Look for BOTH names instead.....
					$result = find_video(strtoupper(stripslashes(trim($groom))), strtoupper(stripslashes(trim($bride))), $weddings);
//print_r($result);
//echo $result[3];
					// If you find it, make sure the Bride's name is the one entered.
			//		if ($result && strtoupper($weddings[$result[0]][2]) == strtoupper(stripslashes($bride))){
			//		if (strtoupper($weddings[$result[0]][1]) == strtoupper(stripslashes($groom)) && strtoupper($weddings[$result[0]][2]) == strtoupper(stripslashes($bride))){
					// If result isn't false then it was found
					if ($result){
						// Set the name of the file to play.
			//			$clipname = $weddings[$result[0]][3];
			//			$timestamp = $weddings[$result[0]][0];
						$clipname = "/webcam/".$result[3];
						$timestamp = $result[0];
			//			echo $clipname;
			//			echo $timestamp;
					}else{
						// Tell them they goofed.
						echo '<script>alert("We\'re sorry, no wedding was found\\nfor that date with those names\\n\\nPlease try again.");</script>';
			//			echo 'Go Fish!';
					}

// Debug
//$result = multi_array_search($bride, $weddings);
//print_r($result);
//if (!$result) echo "boo!";

				// No match. Build a list of what's wrong and pop up an alert box to tell them.
				}else{
					if($date == "")	$errorstring .= "- Wedding Date\\n";
					if($groom == "") $errorstring .= "- Groom's Last Name\\n";
					if($bride == "") $errorstring .= "- Bride's Last Name\\n";
					echo '<script>alert("'.$errorstring.'");</script>';
				}
			}elseif ($task != ""){
				$clipname = "/webcam/".$task;
//				if (file_exists("/var/www/html/littlechurchlv.com/httpdocs/".$clipname)){
				if (file_exists("/var/www/".$clipname)){
					$noext = explode('.',$task); // [0] => groom-bride@timestamp
					$split = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
					$couple = explode('-',$split[0]); // [0] => groom, [1] => bride
					if ($task == ""){
						$groom = $couple[0];
					}
					$bride = $couple[1];
					$timestamp = $split[1];
				}else{
					echo '<script>alert("We\'re sorry, that wedding is no longer available.");document.location="/index/guests/webcam";</script>';
				}
			}
			?>

			<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td colspan="3"><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
			</tr>
			<tr>
				<!-- Left Column -->
				<td valign="top">
					<!-- Intro -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<td>
									<!-- DropCap Image -->
									<table border="0" cellspacing="0" cellpadding="0" align="left">
									<tr>
										<td>
											<img src='TextIMG.php?text=<?=substr($config2["webcam_intro"],0,1);?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=40&height=30&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=substr($config2["webcam_intro"],0,1);?>" border="0">
										</td>
									</tr>
									</table>
									<?=substr($config2["webcam_intro"],1);?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Reserve Now Button -->
					<div align="center">
						<a href="index/reservations" title="Click to Start You Reservation Now!"><img src="images/Buttons/Reserve-Off.png" alt="Reserve" name="btnReserve" id="btnReserve" width="200" height="35" border="0" onMouseOver="this.src='images/Buttons/Reserve-On.png'" onMouseOut="this.src='images/Buttons/Reserve-Off.png'" onMouseLeave="this.src='images/Buttons/Reserve-Off.png'"></a>
					</div>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Promotions -->
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225WhiteBGTop.gif"><img src="images/Ribbons225x20.png" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td background="images/225WhiteBGMiddle.gif">
							<table width="200" border="0" cellspacing="0" cellpadding="0" align="center" class="bodyDarkGray">
							<tr>
								<!-- Intentionally outside of <td></td> tags to eliminate forced <br> at bottom -->
								<form action="" method="post" name="clip" id="clip">
								<td>
									<?=$config2["webcam_text"];?><br><br>
									<table border="0" cellspacing="0" cellpadding="2" align="center" class="bodyDarkGray">
									<tr>
										<td>
											<select name="date" id="date" style="width:200px; color:#F9F6E9; font-weight:bold; background-color:#760025;" value="<? echo $date; ?>">
												<?
												// Build selection list of available archived file dates.
												// What's today's date?
												$now  = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
												// What month & year is it?
												$thismonth = date("m");
												$thisyear = date("Y");
												// How many days were there last month?
												$lastday = strftime("%d", mktime(0, 0, 0, date("m"), 0, date("Y")));
												// What is the oldest day we are still offering? (# of days last month + 1)
												// Was 86400 seconds (24 hours) but daylight saving time made a 23 hour Sunday - changed it to 4000 seconds less (~1 hour)
//TEMP!  changed this to 2 months ONLY for the month of May to accomodate the 2 weeks worth of videos with no sound that have been re-encoded.
//													$then = $now-((($lastday+1)*82400)*2);
												$then = $now-(($lastday+1)*82400);
												//build an option list of the valid dates
//													for($counter = 0; $counter <= $lastday+1; $counter++){  // changed to list dates in reverse order
//													for($counter = $lastday*2; $counter >= 0; $counter--){
												for($counter = $lastday; $counter >= 0; $counter--){
													$targetdate = $then+(86400*$counter);
													// If it's Sat. or Sun. make the background a little darker.
													if (date("w",$targetdate)==0 || date("w",$targetdate)==6){
														// If a date is already selected make it the one that shows.
														if ($targetdate == $date){
															echo "<option value=\"$targetdate\" style=\"background-color:#760025;\" selected>".date("D, M d, Y", $targetdate)."</option>\n";
														// ...otherwise don't.
														}else{
															echo "<option value=\"$targetdate\" style=\"background-color:#760025;\">".date("D, M d, Y", $targetdate)."</option>\n";
														}
													// It's M-F, make the background lighter.
													}else{
														if ($targetdate == $date){
															echo "<option value=\"$targetdate\" style=\"background-color:#BC8181;\" selected>".date("D, M d, Y", $targetdate)."</option>\n";
														}else{
															echo "<option value=\"$targetdate\" style=\"background-color:#BC8181;\">".date("D, M d, Y", $targetdate)."</option>\n";
														}
													}
												}
												?>
											</select><br>
											<label for="date"><strong class="bodyDarkGray">Wedding Date</strong></label>
										</td>
									</tr>
									<tr>
										<td><br><input type="text" name="groom" id="groom" style="width:200px; color:#F9F6E9; font-weight:bold; background-color:#760025;" value="<? echo stripslashes($groom); ?>"><br><label for="groom"><strong class="bodyDarkGray">Groom's Last Name</strong></label></td>
									</tr>
									<tr>
										<td><br><input type="text" name="bride" id="bride" style="width:200px; color:#F9F6E9; font-weight:bold; background-color:#760025;" value="<? echo stripslashes($bride); ?>"><br><label for="bride"><strong class="bodyDarkGray">Bride's Maiden Name</strong></label></td>
									</tr>
									<tr>
										<td align="center"><input type="hidden" name="task" id="task" value="<? echo $task; ?>"><br><input type="submit" value="Retrieve Video"></td>
									</tr>
									</table>
									<span class="smallDarkGray"><br>*Note - The chapel webcam is a premium service which must have been requested prior to the ceremony. Not all weddings are available.</span>
								</td>
								<!-- Intentionally outside of <td></td> tags to eliminate forced <br> above tag -->
								</form>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/225WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>
					
<!-- Maybe on regular pages say something like "Looking for something a little 'different'?  Click here to view our Featured Packages" -->

					<!-- Spacer --
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Testimonials --
					<table width="225" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/225BurgundyBGTop.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" background="images/225BurgundyBGMiddle.gif">
							<!-- Testimonials Slideshow --
							<a href="/index/experience/testimonials" title="Some Kind Words from Happy Couples and their Families">
							<div id="testimonials" style="display:inline-block; background:transparent; z-index:500"></div>
							</a>
							<?=iif(stristr($navigator_user_agent, 'msie'), '<img src="images/spacer.gif" alt="" width="225" height="10" border="0"><br>', '');?>
						</td>
					</tr>
					<tr>
						<td background="images/225BurgundyBGBottom.gif"><img src="images/spacer.gif" alt="" width="225" height="20" border="0"></td>
					</tr>
					</table>-->
				</td>

				<!-- Spacer -->
				<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>

				<!-- Right Column -->
				<td valign="top">
					<!-- Webcam -->
					<table width="665" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" valign="top" background="images/665WhiteBGMiddle.gif">
							<table width="630" border="0" cellspacing="0" cellpadding="0" align="center" background="images/Ribbons.png" style="background-attachment:scroll; background-position:top right; background-repeat:no-repeat;">
							<tr>
								<td>
									<table width="625" border="0" cellspacing="0" cellpadding="0" align="center">
									<!-- Page Title -->
									<tr>
										<td colspan="3" class="bodyDarkGray">
											<img src='TextIMG.php?text=<?=$config2["webcam_title"];?>&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="<?=$config2["webcam_title"];?>" border="0"><br><br>
										</td>
									</tr>
									<tr>
										<!-- Wasp Player code -->
										<script language="javascript" src="http://www.littlechurchlv.com/wasp.js"></script>
										<td colspan="3" align="center" valign="top">
											<?
											//Generate random 10-digit number to tag each iteration of the player seperately - a timestamp is a perfect fit
											$waspID = time();
											?>
											<div id="waspTarget<?=$waspID?>">
												<table border="0" align="center" class="bodyBlack">
												<tr>
													<td><img src="images/flash_player_50x50.gif" alt="" width="50" height="50" border="0"></td>
													<td align="center">
														<strong>Adobe Flash Player Plug-in Required<br>
														<a href="http://www.adobe.com/products/flashplayer/" class="bodyBlack">Click Here for Free Installation</a></strong>
													</td>
												</tr>
												</table>
											</div>
											<!-- WASP Player -->
											<script language="javascript">
											// <![CDATA[
												var waspConfigs<?=$waspID?> = new Object();
												waspConfigs<?=$waspID?>.instanceID="<?=$waspID?>";
												waspConfigs<?=$waspID?>.waspSwf="/wasp.swf";
												waspConfigs<?=$waspID?>.pageColor="000000";
												waspConfigs<?=$waspID?>.im="/images/WebcamSlate640.jpg";
												//waspConfigs<?=$waspID?>.fa="wiggles-wide.flv"; <- pre-roll
												waspConfigs<?=$waspID?>.tf="1";
												waspConfigs<?=$waspID?>.hp="Click%20to%20Play%20%2F%20Pause";
												waspConfigs<?=$waspID?>.v="75";
												waspConfigs<?=$waspID?>.f="<?=$clipname;?>";
												waspConfigs<?=$waspID?>.a="1";
												waspConfigs<?=$waspID?>.me="0";
												waspConfigs<?=$waspID?>.s="0";
												waspConfigs<?=$waspID?>.pw="520";
												waspConfigs<?=$waspID?>.ph="414"; //+24px for controls
												waspConfigs<?=$waspID?>.waspSkin="sr_1|1|4^st_1|3|18|E8E8E8|000000^sg_1|3|22|D8D8D8|FFFFFF^sb_1|10|19|000000|FFFFFF|000000^sp_1|1|23|FFFFFF|FFFFFF|FFFFFF^sm_1|1|23|FFFFFF|FFFFFF|FFFFFF^sf_1|1^sa_1|1|1^sz_1|1|1";
												writeWasp(waspConfigs<?=$waspID?>);
											// ]]>
											</script>
											<br><strong class="bodyDarkGray">&mdash; Now Showing &mdash;</strong><br><img src="images/spacer.gif" alt="" width="1" height="5" border="0"><br>
											<?
											if (strpos($clipname, "stock")===false){
												echo '
											<strong class="bigBlack">'.ucwords($groom).'-'.ucwords($bride).' Wedding<br>'.date("F j, Y",$timestamp).'</strong>
												';
											}else{
												if (!$task || $task == "stock/HistoryOfTheLittleChurch.flv"){
													echo '
											<strong class="bigBlack">History of the Little Church of the West</strong>
													';
												}elseif ($task == "stock/ElvisWedding.flv"){
													echo '
											<strong class="bigBlack">Sample "Elvis" Wedding Ceremony</strong>
													';
												}elseif ($task == "stock/ElvisRenewal.flv"){
													echo '
											<strong class="bigBlack">Sample "Elvis" Renewal Ceremony</strong>
													';
												}elseif ($task == "stock/SampleWedding.flv"){
													echo '
											<strong class="bigBlack">Sample Wedding Ceremony</strong>
													';
												}elseif ($task == "stock/SampleRenewal.flv"){
													echo '
											<strong class="bigBlack">Sample Vow Renewal Ceremony</strong>
													';
												}
											}
											?>
										</td>
									</tr>
									<tr>
										<td height="28" colspan="2" align="center" valign="bottom">
											<!-- Flourish -->
											<img src="images/SeperatorBar.png" alt="" width="575" height="15" border="0">
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/665WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					</table>

					<!-- Spacer -->
					<img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>

					<!-- Video Library -->
					<table width="665" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="images/665WhiteBGTop.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					<tr>
						<td align="center" valign="top" background="images/665WhiteBGMiddle.gif">
							<table width="630" border="0" cellspacing="0" cellpadding="0" align="center" background="images/Ribbons.png" style="background-attachment:scroll; background-position:top right; background-repeat:no-repeat;">
							<tr>
								<td>
									<table width="625" border="0" cellspacing="5" cellpadding="0" align="center" class="bodyDarkGray">
									<tr>
										<td colspan="4" class="bodyDarkGray">
											<img src='TextIMG.php?text=Video Library&font=CACCHAMP.TTF&bold=no&points=30&txtcolor=000000&shadow=C0C0C0&offset=2&width=450&height=39&left=0&top=25&angle=0&bgcolor=F8F6E8&transparent=yes&dropcap=yes&format=png' alt="Video Library" border="0"><br><img src="images/spacer.gif" alt="" width="1" height="10" border="0"><br>
										</td>
									</tr>
									<tr>
										<td width="50">
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/SampleWedding.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><img src="images/SampleWeddingThumbnail.jpg" alt="" width="50" height="40 border="0"></a>
										</td>
										<td width="260">
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/SampleWedding.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><strong>Sample Traditional Wedding</strong></a>
										</td>
										<td width="50">
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/ElvisWedding.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><img src="images/ElvisWeddingThumbnail.jpg" alt="" width="50" height="40 border="0"></a>
										</td>
										<td width="260">
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/ElvisWedding.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><strong>Sample "Elvis" Wedding</strong></a>
										</td>
									</tr>
									<tr>
										<td>
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/SampleRenewal.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><img src="images/SampleRenewalThumbnail.jpg" alt="" width="50" height="40 border="0"></a>
										</td>
										<td>
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/SampleRenewal.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><strong>Sample Vow Renewal</strong></a>
										</td>
										<td>
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/ElvisRenewal.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><img src="images/ElvisRenewalThumbnail.jpg" alt="" width="50" height="40 border="0"></a>
										</td>
										<td>
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/ElvisRenewal.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><strong>Sample "Elvis" Renewal</strong></a>
										</td>
									</tr>
									<tr>
										<td>
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/HistoryOfTheLittleChurch.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><img src="images/HistoryVideoThumbnail.jpg" alt="" width="50" height="40 border="0"></a>
										</td>
										<td colspan="3">
											<a href="javascript:void(0)" onClick="getSample.task.value = 'stock/HistoryOfTheLittleChurch.flv'; document.getElementById('getSample').submit();" title="Click to Play" class="bigDarkGray"><strong>History of the Little Church of the West</strong></a> <strong class="smallDarkGray">(5 Minutes Long)</strong>
										</td>
									</tr>
									</table>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td background="images/665WhiteBGBottom.gif"><img src="images/spacer.gif" alt="" width="665" height="20" border="0"></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>

			<form action="" method="post" name="getSample" id="getSample">
				<input type="hidden" name="task" id="task" value="">
			</form>

			<!-- Webcam Notices Layer -->
			<div align="center" id="WebcamNotice" style="position:absolute; top:300; left:175; z-index:10; width:525; align:center; <?=iif($config2["webcam_notice_show"] == "T",  "display:block; visibility:visible;", "display:none; visibility:hidden;")?>">
			<table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
			<tr>
				<td background="images/600BurgundyBGTop.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
			</tr>
			<tr>
				<td bgcolor="#770025" background="images/600BurgundyBGMiddle.png" valign="top">
					<table width="525" border="0" cellspacing="0" cellpadding="0" align="center">
					<tr>
						<td width="550" valign="top">
							<table width="550" border="0" cellspacing="5" cellpadding="0" align="center">
							<tr>
								<td valign="top" class="xbigWhite"><strong>The Little Church of the West Chapel Webcam</strong></td>
								<td align="right">
									<a href="javascript:void(0)" onclick="hide('WebcamNotice')" class="smallWhite"><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"><br>Close<br></a>
								</td>
							</tr>
							<tr>
								<td colspan="2" valign="top" class="bigWhite">
									<?=$config2["webcam_notice"];?>
								</td>
							</tr>
							</table>
						</td>
					</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td background="images/600BurgundyBGBottom.png" style="background-attachment: scroll; background-position: top; background-repeat: no-repeat;">&nbsp;</td>
			</tr>
			</table>
			</div>

			<!-- END include webcam.php -->

<!--<a href="javascript:void(0)" onclick="show('WebcamNotice')" class="smallWhite">_</a>-->
