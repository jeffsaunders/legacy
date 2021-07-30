<!-- BEGIN Include events.php -->

			<div id="productTabsContainer">
				<strong class="sectionLabel">Events</strong>
			</div>
			<div id="productInfoContainer">
				<br>
				<div id="staticInfoContainer" class="staticInfoContainer">
					<table width="940" cellspacing="10" align="center">
					<tr>
						<td width="280" valign="top"><img src="images/Events.jpg" alt="Marmiro Stones by Turan Bekisoglu" width="280" height="423" border="0" class="imageContainer"></td>
						<td valign="top">
							<table width="100%" cellspacing="0" cellpadding="0">
							<?
							// Get the events that haven't ended
//							$query = "SELECT *, date_format(start_date, '%c/%e/%Y') as formatted_start_date, date_format(end_date, '%c/%e/%Y') as formatted_end_date
//										FROM events
//										WHERE (start_date >= CURRENT_DATE OR end_date >= CURRENT_DATE)
//										AND display <> 'F'
//										ORDER BY start_date ASC";
							$query = "SELECT *, date_format(start_date, '%c/%e/%Y') as formatted_start_date, date_format(end_date, '%c/%e/%Y') as formatted_end_date
										FROM events
										WHERE display <> 'F'
										ORDER BY start_date ASC";
//echo $query."<br><br>";
							$rs_events = mysql_query($query, $linkID);
							// Display them
							while ($event = mysql_fetch_assoc($rs_events)){
							?>
							<tr>
								<td height="95" valign="top" class="eventContainer">
									<?
									echo "<strong class='eventLabel'>".$event["event"]."</strong>";
									// If it's a one-day event, then just show one date
									if ($event["start_date"] == $event["end_date"]){
										echo "<br>".$event["formatted_start_date"];
									// Otherwise, show start and end dates
									}else{
										echo "<br>".$event["formatted_start_date"]." - ".$event["formatted_end_date"];
									}
									echo "<br>".$event["location1"];
									// If there is a location2 defined, show it
									if ($event["location2"] != ""){
										echo "<br>".$event["location2"];
									}else{
										echo "<br>";
									}
									// If there is a link to the show's site defined, show it
									if ($event["link"] != ""){
										echo "<br><a href='http://".$event["link"]."' target='_blank' class='eventLink'>".$event["link"]."</a>";
									}
									?>
								</td>
							</tr>
							<?
							}
							?>
							</table>
						</td>
					</tr>
					</table>
				</div>
			</div>

<!-- END Include events.php -->
