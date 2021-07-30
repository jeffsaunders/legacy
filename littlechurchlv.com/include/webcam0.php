<!-- BEGIN INCLUDE webcam -->

<!-- Check for Real Player First -->
<?
if ($task != "skip"){
	echo'
<script src="plugintest.js">// Player detection scripts</script>
<script language="Javascript">
	if (!detectReal()){
		window.location="?sec=webcam&cargo=needplayer";
	}
</script>
	';
}
?>

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
//			$result = multi_array_search($search_value, $value);
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
$clipname = "";
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
		foreach(myglob("/var/www/helix/Content/Archive/littlechurch/*.rm") as $filename) {
			$path = explode('/',$filename); // [7] => groom-bride@timestamp.rm
			$noext = explode('.',$path[7]); // [0] => groom-bride@timestamp
			$timestamp = explode('@',$noext[0]); // [0] => groom-bride, [1] => timestamp
//echo $timestamp[0];
			$couple = explode('-',$timestamp[0]); // [0] => groom, [1] => bride
			// If the date they selected is the date of the embedded timestamp, push it onto the stack, if not, skip it.
			// End result is an array of filename info for ONLY the clips from the date they specified.
			if (date("mdy",$date) == date("mdy",$timestamp[1])){
				array_push($weddings,array($timestamp[1],$couple[0],$couple[1],$path[7]));
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
		// Look for BOTH name instead.....
		$result = find_video(strtoupper(stripslashes($groom)), strtoupper(stripslashes($bride)), $weddings);
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
			$clipname = $result[3];
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
	$clipname = $task;
}
?>

<br>
<table width="900" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td background="images/900IvoryBGTop.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
<tr>
	<td background="images/900IvoryBGMiddle.gif">


<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<!-- Main Body -->
	<td valign="top" class="bodyBlack">
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="bodyBlack">
		<tr>
			<td colspan="3" class="xbigBlack">
				<img src="images/spacer.gif" alt="" width="10" height="1" border="0">
				<strong>Welcome to the Little Church of the West Chapel Webcam</strong><br><br>
			</td>
		</tr>
		<tr>
			<td><img src="images/spacer.gif" alt="" width="25" height="1" border="0"></td>
			<td>
				<table border="0" cellspacing="0" cellpadding="2" class="bodyBlack">
				<tr>
					<td valign="top">
					<p>The Little Church of the West Chapel Webcam offers your friends and family who cannot attend in person the ability to share in your big day.  If Webcam service was purchased, wedding videos, while not live for security and privacy reasons, are available 15 minutes after the conclusion of your ceremony and are <strong>free</strong> to view for 30 days after.</p>
					
					<p>If your wedding was recorded on our chapel webcam, please select the wedding date and enter the Groom's and the Bride's maiden LAST names to retrieve the video you wish to view.  Remember, all dates and times are <strong>Pacific Time</strong>, so adjust your request accordingly.</p>

					<p><strong><nobr>Current Las Vegas Time is:&nbsp;&nbsp;<? include("./LVClock.js"); ?></nobr></strong></p>

					</td>
<?//=$navigator_user_agent;?>
					<script>
						function fullScreen(){
							<?
							if (stristr($navigator_user_agent, "msie")){
							?>
							document.video.SetFullScreen();
							<?
							}else{
							?>
//							document.video2.SetFullScreen();
							document.getElementById('video2').SetFullScreen();
							<?
							}
							?>
						}
					</script>
					<td width="340" rowspan="3" align="center" valign="top">
						<!-- Embed the Real Player -->
						<object id=video classid="CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="320" height="240">
							<!-- Assign a "SRC" value only if we have a clip selected to play-->
							<? if ($clipname) echo '<param name="SRC" value="http://helix.littlechurchlv.com/ramgen/encoder/littlechurch/'.$clipname.'">';?>
							<param name="CONTROLS" value="ImageWindow">
							<param name="CONSOLE" value="cons">
							<param name="AUTOSTART" value="true">
 							<!-- Netscape -->
							<embed <? if ($clipname) echo 'src="http://helix.littlechurchlv.com/ramgen/encoder/littlechurch/'.$clipname.'"'; ?> type="audio/x-pn-realaudio-plugin" id="video2" width="320" height="240" controls="ImageWindow" console="cons" autostart="true" pluginspage="http://forms.real.com/netzip/getrde601.html?h=software-dl.real.com&r=212ec0ac690832cb0418&f=windows/RealPlayer10-5GOLD_bb.exe&p=RealOne+Player&oem=dlrhap_bb&tagtype=ie&type=dlrhap_bb"></embed>
							<!--<noembed><a href="http://clip url">Play</a></noembed>-->
						</object>
						<!-- Controls -->
						<object id=controls classid="CLSID:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA" width="320" height="85">
							<? if ($clipname) echo '<param name="SRC" value="http://helix.littlechurchlv.com/ramgen/encoder/littlechurch/'.$clipname.'">';?>
							<param name="CONTROLS" value="all">
							<param name="CONSOLE" value="cons">
							<param name="AUTOSTART" value="true">
							<!-- Netscape -->
							<embed  <? if ($clipname) echo 'src="http://helix.littlechurchlv.com/ramgen/encoder/littlechurch/'.$clipname.'"'; ?> type="audio/x-pn-realaudio-plugin" id="controls2" width="320" height="85" controls="all" console="cons" autostart="true"></embed>
						</object><br>
						<br>
<!--						<a href="javascript:document.video.SetFullScreen()" class="bigBlack"><strong>Click Here For Full Screen View</strong></a><br>-->
						<a href="javascript:void(0);" onClick="fullScreen();" class="bigBlack"><strong>Click Here For Full Screen View</strong></a><br>
						<strong class="smallBlack">(Press ESCape Key To Return)</strong>
					</td>
<!--					<td><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>-->
				</tr>
				<tr>
					<td valign="top">
					<form action="" method="post" name="clip" id="clip">
						<table border="0" cellspacing="0" cellpadding="2" align="center" class="bodyBlack">
						<tr>
							<td><label for="date"><strong class="bigBlack">Wedding Date:</strong></label></td>
							<td>
								<select name="date" id="date" style="width:220px;" value="<? echo $date; ?>">
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
//									$then = $now-((($lastday+1)*82400)*2);
									$then = $now-(($lastday+1)*82400);
									//build an option list of the valid dates
//									for($counter = 0; $counter <= $lastday+1; $counter++){  // changed to list dates in reverse order
//									for($counter = $lastday*2; $counter >= 0; $counter--){
									for($counter = $lastday; $counter >= 0; $counter--){
										$targetdate = $then+(86400*$counter);
										// If it's Sat. or Sun. make the background a little darker.
										if (date("w",$targetdate)==0 || date("w",$targetdate)==6){
											// If a date is already selected make it the one that shows.
											if ($targetdate == $date){
												echo "<option value=\"$targetdate\" style=\"background-color:#E0E0E0;\" selected>".date("l, F d, Y", $targetdate)."</option>\n";
											// ...otherwise don't.
											}else{
												echo "<option value=\"$targetdate\" style=\"background-color:#E0E0E0;\">".date("l, F d, Y", $targetdate)."</option>\n";
											}
										// It's M-F, make the background lighter.
										}else{
											if ($targetdate == $date){
												echo "<option value=\"$targetdate\" style=\"background-color:#F8F8F8;\" selected>".date("l, F d, Y", $targetdate)."</option>\n";
											}else{
												echo "<option value=\"$targetdate\" style=\"background-color:#F8F8F8;\">".date("l, F d, Y", $targetdate)."</option>\n";
											}
										}
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td><label for="groom"><strong class="bigBlack">Groom's Last Name:</strong></label></td>
							<td><input type="text" name="groom" id="groom" style="width:220px;background-color:#ECEADC;" value="<? echo stripslashes($groom); ?>"></td>
						</tr>
						<tr>
							<td><label for="bride"><strong class="bigBlack">Bride's Maiden Name:</strong></label></td>
							<td><input type="text" name="bride" id="bride" style="width:220px;background-color:#ECEADC;" value="<? echo stripslashes($bride); ?>"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="task" id="task" value="<? echo $task; ?>"></td>
							<td align="center"><input type="submit" value="Retrieve Video"></td>
						</tr>
						</table>
					</td>
					<!-- Intentionally outside of <td></td> tags to eliminate forced <br> above tag -->
					</form>
				</tr>
				<tr>
					<td valign="top">
						<table border="0" cellspacing="0" cellpadding="0" align="center" class="bodyBlack">
						<tr>
							<td><img src="images/VideoIcon.gif" alt="" width="39" height="35 border="0"></td>
							<td><a href="/index/guests/webcam0/SampleWedding.rm" class="bodyBlack"><strong>Sample Wedding Video</strong></a></td>
							<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
							<td><img src="images/VideoIcon.gif" alt="" width="39" height="35 border="0"></td>
							<td><a href="/index/guests/webcam0/ElvisWedding.rm" class="bodyBlack"><strong>Sample "Elvis" Wedding</strong></a></td>
						</tr>
						<tr>
							<td><img src="images/VideoIcon.gif" alt="" width="39" height="35 border="0"></td>
							<td><a href="/index/guests/webcam0/SampleRenewal.rm" class="bodyBlack"><strong>Sample Vow Renewal</strong></a></td>
							<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"></td>
							<td><img src="images/VideoIcon.gif" alt="" width="39" height="35 border="0"></td>
							<td><a href="/index/guests/webcam0/ElvisRenewal.rm" class="bodyBlack"><strong>Sample "Elvis" Renewal</strong></a></td>
						</tr>
						<tr>
							<td><img src="images/VideoIcon.gif" alt="" width="39" height="35 border="0"></td>
							<td colspan="4"><a href="/index/guests/webcam0/HistoryOfTheLittleChurch.rm" class="bodyBlack"><strong>Little Church of the West Chapel History Video</strong></a> <strong class="smallBlack">(5 Minutes Long)</strong></td>
						</tr>
						</table>
					</td>
				</tr>
				</table>
			</td>
			<td><img src="images/spacer.gif" alt="" width="15" height="1" border="0"></td>
		</tr>
		<tr>
			<td colspan="5" align="center">
			<?
			// Tell them the name of the wedding they are watching, if one is selected, and to press play.
			if ($clipname){
				if (!$task){
					echo '
					<br><strong>The '.$weddings[$result[0]][1].'-'.$weddings[$result[0]][2].' Wedding from '.date("F j",$timestamp).' has been retrieved.<br>If it does not start automatically, press the play button ( <a href="javascript:document.video.DoPlay()"><img src="images/realplaybutton.gif" alt="" border="0" align="bottom"></a> ) to begin.</strong>
					';
				}else{
					echo '
					<br><strong>The requested video has been retrieved.<br>If it does not start automatically, press the play button ( <a href="javascript:document.video.DoPlay()"><img src="images/realplaybutton.gif" alt="" border="0" align="bottom"></a> ) to begin.</strong>
					';
				}
			}else{
				echo '
				<br><strong>*Note - The chapel webcam is a premium service which must have been requested prior to the ceremony, not all weddings are available.</strong><br>
				';
			}
			?>
				<br>
				<em>Not responsible for your computer or Internet connection performance.  For video player support visit <a href="http://www.realplayer.com" target="_blank" class="bodyBlack">RealPlayer.com</a>.</strong>
				<br>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
	

	</td>
</tr>
<tr>
	<td background="images/900IvoryBGBottom.gif"><img src="images/spacer.gif" alt="" width="900" height="20" border="0"></td>
</tr>
</table>

<!-- Message popup in case of a problem -->
<script language="JavaScript">
function popmsg() {
//	alert("Due to technical difficulties weddings from Saturday, September 30 to Tuesday, October 3 are currently unavailable for viewing.  We are working to remedy the situation and will change this notification once service is restored and those weddings become available again.  Rest assured your wedding will be available for viewing for the full 30 days promised from the day this issue is resolved.\n\nWeddings through Friday, September 29 and from Wednesday, October 4 on are not affected.");
//	alert("Good News Folks!\n\nFor those of you who have been unable to view weddings from between Saturday, September 30 and Tuesday, October 3, we have remedied the technical issues and restored your weddings.  We have extended the available viewing time by 2 full weeks, the week you missed plus a bonus week as a 'thank you' for your patience.");
	alert("Good News Folks!\n\nFor those of you who have been unable hear the audio for weddings from between Wednesday, April 11 and Saturday, April 21 we have remedied the technical issues and restored your wedding's audio track.  We apologize for the inconvenience and have extended your available viewing time by a full month as a 'thank you' for your patience.");
}
<?// if (!$_REQUEST['date']) echo'setTimeout("popmsg();",1000);'; ?>
</script>

<!-- END INCLUDE webcam -->

