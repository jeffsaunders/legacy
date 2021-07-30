<?
// Since this is called via AJAX, and not as an include to index.php, must redefine basic settings

// Define default settings
setlocale(LC_MONETARY, 'en_US');

// Grab the database
include("dbconnect.php");

// Grab the global PHP functions
include("functions.php");

// Build Query
// Search Criteria
$search = "WHERE live = '1'";  // SQL
$criteria = "";  // Criteria For Display
$rent = $_REQUEST['Rent'];
// If the value for rent was passed, append it to query and to criteria display string.
// Do the same for all potentially passed values below...
if ($rent != ""){
	$search .= " AND (rent <= '$rent')";
	$criteria .= " with maximum rent of <strong>$".$_REQUEST['Rent']."</strong>";
}
// Street
$terms = explode(" ", $_REQUEST['Street']);
$n = 0; //Terms Counter
foreach ($terms as $t){
	if ($t != ""){
		$n++;  // Increment Term Counter
		$search .= " AND (UPPER(street) LIKE UPPER('%$t%'))";
		if ($n == 1){  // First Term
			$criteria .= " located on a street with <strong>'".$t."'</strong>";
		}else{  // Subsequent Terms
			$criteria .= " and <strong>'".$t."'</strong>";
		}
	}
}
if ($n != 0){
	$criteria .= " in its name";
}
// Bedrooms
$bedrooms = $_REQUEST['Bedrooms'];
if ($bedrooms != ""){
	$criteria .= iif($criteria == "", " with", " and");
	if ($bedrooms == 0){
		$criteria .= " <strong>No</strong> bedrooms (Studio)";
	}elseif ($bedrooms == 9){
		$criteria .= " <strong>9 or more</strong> bedrooms";
	}else{
		$criteria .= " <strong>".$bedrooms."</strong> bedroom".iif($bedrooms > 1, "s", "");
	}
	if ($bedrooms < 9){
		$search .= " AND (bedrooms = '$bedrooms')";
	}else{
		$search .= " AND (bedrooms >= '9')";
	}
}
// Contact
$terms = explode(" ", $_REQUEST['Contact']);
$n = 0; //Terms Counter
foreach ($terms as $t){
	if ($t != ""){
		$n++;  // Increment Term Counter
		$search .= " AND (UPPER(contact) LIKE UPPER('%$t%'))";
		if ($n == 1){  // First Term
			$criteria .= iif($criteria != "", ",", "")." whose contact includes <strong>'".$t."'</strong>";
		}else{  // Subsequent Terms
			$criteria .= " and <strong>'".$t."'</strong>";
		}
	}
}

// Now for the Order Criteria
$order_by = "";
if ($_REQUEST['Order'] != ""){
	$order_by = "ORDER BY ".$_REQUEST['Order'].iif($_REQUEST['Order'] == "utilities", " DESC", " ASC");
	$criteria .= ", sorted by <strong>".iif($_REQUEST['Order'] == "available", "Availability", ucfirst($_REQUEST['Order']))."</strong>";
}
$criteria .= ".";

// Count total number of matching listings
$query = "SELECT COUNT(*) FROM listings $search";
//echo $query."<br><br>";
$rs_count = mysql_query($query, $linkID);
$count = mysql_fetch_array($rs_count);
$matches = $count["0"];

// Pagination
$page = $_REQUEST['Page'];
if (!$page){
	$page = 1;
}
$pageSize = "12";
$pageEnd = $page * $pageSize;
$pageBegin = ($pageEnd - $pageSize) + 1;
$pageEnd = min($pageEnd, $matches);
$pages = floor($matches / $pageSize) + 1;

// Calculate query offet & count
$queryCount = ($pageEnd - $pageBegin) + 1;
$queryOffset = $pageBegin - 1;

// Get matching listings, 12 at a time
$query = "SELECT id, streetnumber, street, aptnumber, rent, bedrooms, available, utilities, shortdesc, contact, photo FROM listings ".$search." ".$order_by." LIMIT ".$queryOffset.",".$queryCount.";";
//echo $query."<br><br>";
$rs_results = mysql_query($query, $linkID);

// Display search results with criteria string
?>
<!-- Display search criteria -->
<div id="Criteria" style="position:absolute; top:10px; left:10px; width:820px; height:60px; z-index:4;">
	<div id="CriteriaLabel" style="position:absolute; top:0px; left:0px; width:140px; z-index:4;">
		<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;">
			Search Results: 
		</span>
	</div>
	<div id="CriteriaDetails" style="position:absolute; top:0px; left:140px; width:680px; z-index:4;">
		<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;">
			<?
			if ($matches == 0){
				echo "<strong>No</strong> rentals found".$criteria;
			}else{
				echo "Listings <strong>".$pageBegin."-".$pageEnd."</strong> of <strong>".$matches."</strong> rentals found".$criteria;
			}
			?>
		</span>
	</div>
</div>
<!-- Column headers -->
<div id="Header" style="position:absolute; top:60px; left:0px; width:840px; height:30px; background-color:#EAF7F8; z-index:4;">
	<div id="StreetHeader" style="position:absolute; top:5px; left:90px; width:225px; text-align:center; z-index:5;">
		<!-- Link to sort by Street.  Do the same for the rest of the applicable headers below... -->
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=street&Page=1');" title="Click to Sort by Street Name" class="titleBlue">Street</a>
		</span>
	</div>
	<div id="RentHeader" style="position:absolute; top:5px; left:325px; width:75px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=rent&Page=1');" title="Click to Sort by Rent Amount" class="titleBlue">Rent</a>
		</span>
	</div>
	<div id="BedroomsHeader" style="position:absolute; top:5px; left:400px; width:80px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=bedrooms&Page=1');" title="Click to Sort by Number of Bedrooms" class="titleBlue">Bedrooms</a>
		</span>
	</div>
	<div id="UtilitiesHeader" style="position:absolute; top:5px; left:480px; width:60px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=utilities&Page=1');" title="Click to Sort by Utilities Included" class="titleBlue">Utilities</a>
		</span>
	</div>
	<div id="AvailableHeader" style="position:absolute; top:5px; left:540px; width:90px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=available&Page=1');" title="Click to Sort by Availability Date" class="titleBlue">Available</a>
		</span>
	</div>
	<div id="ContactHeader" style="position:absolute; top:5px; left:630px; width:190px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:14px; color:#2e708b;">
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=contact&Page=1');" title="Click to Sort by Contact Name" class="titleBlue">Contact</a>
		</span>
	</div>
</div>
<?
// Display results
if ($rs_results){
	$top = 0;
	while ($result = mysql_fetch_assoc($rs_results)){
		$top++;
	?>
<!-- Make the entire bar clickable -->
<a onClick="getDetails('<?=$result["id"];?>');" title="Click to Tour This Home" onMouseOver="document.getElementById('<?=$result["id"];?>').style.backgroundColor='#8fd5dc'" onMouseOut="document.getElementById('<?=$result["id"];?>').style.backgroundColor='<?=iif(is_odd($top), "#E1F0F3", "#EAF7F8");?>'" style="text-decoration:none; cursor:pointer;">
<div id="<?=$result["id"];?>" style="position:absolute; top:<?=iif($top == 1, "90", ($top*60)+30);?>px; left:0px; width:840px; height:60px; background-color:<?=iif(is_odd($top), "#E1F0F3", "#EAF7F8");?>; z-index:4;">
	<!-- Show thumbnail image -->
	<div id="<?=$result["id"];?>Thumbnail" style="position:absolute; top:12px; left:20px; width:100px; z-index:5;">
		<?
		$thumbnail = iif(file_exists("images/properties/".$result["id"]."_".$result["photo"]."_mini.jpg"), "images/properties/".$result["id"]."_".$result["photo"]."_mini.jpg", "images/properties/NoThumb.jpg");
		$image = iif(file_exists("images/properties/".$result["id"]."_".$result["photo"]."_full.jpg"), "images/properties/".$result["id"]."_".$result["photo"]."_full.jpg", "images/properties/NoImage.jpg");
		?>
		<img src="<?=$thumbnail;?>" alt="#<?=$result["id"];?>" width="48" height="32" onMouseOver="show('<?=$result["id"];?>Image');" onMouseOut="hide('<?=$result["id"];?>Image');" onMouseLeave="hide('<?=$result["id"];?>Image');" class="shadowSmall">
	</div>
	<!-- Show the rest of the details -->
	<div id="<?=$result["id"];?>Street" style="position:absolute; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; top:12px; left:90px; width:225px; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#2E708B;">
			<?//=substr($result["streetnumber"]." ".$result["street"].iif($result["aptnumber"] != "", ", Apt. ".$result["aptnumber"], ""), 0, 22);?>
			<?=$result["streetnumber"]." ".$result["street"].iif($result["aptnumber"] != "", ", Apt. ".$result["aptnumber"], "");?>
		</span>
	</div>
	<div id="<?=$result["id"];?>Rent" style="position:absolute; white-space:nowrap; overflow:hidden; top:12px; left:325px; width:75px; text-align:right; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=money_format('%.0n', $result["rent"]);?>/mo
		</span>
	</div>
	<div id="<?=$result["id"];?>Bedrooms" style="position:absolute; top:12px; left:400px; width:80px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=iif($result["bedrooms"] == 0, "Studio", iif($result["bedrooms"] == 9, "9+", $result["bedrooms"]));?>
		</span>
	</div>
	<div id="<?=$result["id"];?>Utilities" style="position:absolute; top:12px; left:480px; width:60px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=iif($result["utilities"] == 1, "Yes", "No");?>
		</span>
	</div>
	<div id="<?=$result["id"];?>Available" style="position:absolute; top:12px; left:540px; width:90px; text-align:center; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=date("m.d.Y", strtotime($result["available"]));?>
		</span>
	</div>
	<div id="<?=$result["id"];?>Contact" style="position:absolute; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; top:12px; left:640px; width:180px; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=$result["contact"];?>
		</span>
	</div>
	<div id="<?=$result["id"];?>Shortdesc" style="position:absolute; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; top:30px; left:90px; width:730px; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#092C3E;">
			<?=$result["shortdesc"];?>
		</span>
	</div>
</div>
<!-- Display enlarged image on mousover of thumbnail -->
<div id="<?=$result["id"];?>Image" style="position:absolute; top:<?=($top * 60)-80;?>px; left:68px; width:460px; height:260px; background-image:url(images/ImageBubble.png); z-index:6; visibility:hidden;">
	<div id="<?=$result["id"];?>Pic" style="position:absolute; top:7px; right:16px; width:365px; height:235px; background-image:url('ResizeImage.php?image=<?=$image;?>&amp;width=365&amp;height=235&amp;format=jpg'); background-position:center center; background-repeat:no-repeat; z-index:7;" class="roundedCorners"></div>
</div>
</a>
	<?
	}
	?>
<!-- Pagination links -->
<div id="Pagination" style="position:absolute; top:815px; left:10px; width:820px; height:60px; z-index:4;">
	<div id="PaginationLabel" style="position:absolute; top:0px; left:0px; width:50px; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;">
			Page:
		</span>
	</div>
	<div id="PaginationMenu" style="position:absolute; top:0px; left:60px; width:610px; z-index:5;">
		<span style="font-family:'Myvetica',sans-serif; font-size:16px; color:#092C3E;">
			<?
			// If there is more than one page and the current page is not the first page, show "Previous" link
			if ($page > 1){
			?>
			<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>&Page=<?=$page - 1;?>');" title="Click for Previous Page" class="menuBlue">Previous</a>&nbsp;&nbsp;
			<?
			}
			// If fewer than 10 pages, just show links to them all
			if ($pages < 10){
				$pageCount = 0;
				do{
					$pageCount++;
					// If on that page, don't show link to it, just show it bolded
					if($pageCount == $page){
					?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;"><strong><?=$page;?></strong>&nbsp</span>
					<?
					// otherwise show link to page
					}else{
					?>
			 <a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>&Page=<?=$pageCount;?>');" title="Click for Page <?=$pageCount;?>" class="menuBlue"><?=$pageCount;?></a>&nbsp;
					<?
					}
				}while(($pageCount * $pageSize) < $matches);
			// If more than 10 pages, break them up to make them managable
			}else{
				$pageCount = 0;
				do{
					$pageCount++;
					// Always show display or link for page 1
					if ($pageCount == 1){
						// If on that page, don't show link to it, just show it bolded
						if($page == 1){
						?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;"><strong><?=$page;?></strong>&nbsp</span>
						<?
						// Show link to page
						}else{
						?>
			 <a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>&Page=<?=$pageCount;?>');" title="Click for Page <?=$pageCount;?>" class="menuBlue"><?=$pageCount;?></a>&nbsp;
						<?
						}
						// Increment counter to "2"
						$pageCount++;
					}
					// Float links to equal the 3 pages before and the 3 pages after the current page, using ellipsys' ("...") to cover the gaps
					// If page is greater than 5 and you would normally print a link to "2" here, print ellipsys instead to represent gap
					if ($page > 5 && $pageCount == 2){
					?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px;" class="menuBlue">...&nbsp</span>
						<?
						// then if page you are on is less than the total number of pages, minus 3
						if ($page < ($pages - 3)){
							// reset the counter to the current page, minus 3 to show links to the 3 pages prior to the current one
							$pageCount = $page - 3;
						}else{
							// otherwise set the counter to the total number of pages, minus 7 to show links to the last 7 pages
							$pageCount = $pages - 7;
						}
					}
					// If page is less than 6 and you would normally print a link to ninth page here, print ellipsys instead to represent gap
					if ($page < 6 && $pageCount == 9){
					?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px;" class="menuBlue">...&nbsp</span>
						<?
						// and reset counter to the last page
						$pageCount = $pages;
					}
					// If page is greater than 6, the counter is 4 more than the page number you are on, and the counter is not the same
					//  as the total number of pages, print ellipsys instead to represent gap
					if ($page > 5 && $pageCount == $page + 4 && $pageCount != $pages){
					?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px;" class="menuBlue">...&nbsp</span>
						<?
						// and reset counter to the last page
						$pageCount = $pages;
					}
					// If on that page, don't show link to it, just show it bolded
					if($pageCount == $page){
					?>
			<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#092C3E;"><strong><?=$page;?></strong>&nbsp</span>
					<?
					// otherwise show link to page
					}else{
					?>
			 <a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>&Page=<?=$pageCount;?>');" title="Click for Page <?=$pageCount;?>" class="menuBlue"><?=$pageCount;?></a>&nbsp;
					<?
					}
				}while(($pageCount * $pageSize) < $matches);
			}
			// If there is more than one page and the current page is not the last page, show "Next" link
			if ($page < $pageCount){
			?>
			&nbsp;<a onClick="javascript:Lookup('Street=<?=$_REQUEST['Street'];?>&Contact=<?=$_REQUEST['Contact'];?>&Bedrooms=<?=$_REQUEST['Bedrooms'];?>&Rent=<?=$_REQUEST['Rent'];?>&Order=<?=$_REQUEST['Order'];?>&Page=<?=$page + 1;?>');" title="Click for Next Page" class="menuBlue">Next</a> 
			<?
			}
			?>
		</span>
	</div>
	<!-- Search Again link -->
	<div id="SearchLink" style="position:absolute; top:0px; right:0px; width:150px; text-align:right; z-index:5;">
		<a href="search" title="Click to Start a New Search" class="menuBlue">Search Again</a>
	</div>
</div>
<?
}
?>
