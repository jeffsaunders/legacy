	<div id="Content" style="position:relative; top:0px; left:0px; width:960px; height:570px; z-index:1;">
		<img src="images/HomeBG.png" alt="" width="960" height="570">
		<!-- Top Section -->
		<div id="Header" style="position:absolute; top:25px; left:20px; z-index:2;">
			<!-- Logo Image -->
			<a href="/" title="Click for wmuhomes.com Home Page"><img src="images/Logo.png" alt="" width="54" height="62" style="border:none;" class="shadowSmall"></a>
			<!-- Text -->
			<div id="HeaderText" style="position:absolute; top:5px; left:70px; width:500px; z-index:2;">
				<span style="font-family:'Myvetica',sans-serif; font-size:36px; color:#FFFFFF;">wmuhomes.com</span><br>
				<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF;">Kalamazoo Michigan Luxury & Student Rental Homes</span><br><br>
				<span style="font-family:'Myvetica',sans-serif; font-size:16px; color:#295298;">Welcome to wmuhomes.com.</span>
				<span style="font-family:'Myvetica',sans-serif; font-size:16px; color:#092C3E;">
					You can view pictures and<br>
					pricing information for over <?=number_format(round($totalListings,-1));?> student rental homes within<br>
					a 3-mile radius of Western Michigan University and<br>
					Kalamazoo College. Welcome students seeking Fall 2010 housing!
				</span>
			</div>
		</div>
		<!-- Bottom Sections -->
		<!-- Search Box -->
		<form action="results" method="post" name="Search" id="Search" onSubmit="return validate(this);">
		<div id="SearchBox" style="position:absolute; top:225px; left:90px; width:375px; height:250px; background-color:#FFFFFF; z-index:2;" class="roundedCorners">
			<!-- Search Form -->
			<div id="SearchForm" style="position:absolute; top:20px; left:20px; width:350px; z-index:3;">
				<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#295298;">Kalamazoo Student Rental Search:</span>
				<!-- Left Column -->
				<div id="FormLeft" style="position:absolute; top:40px; left:15px; width:170px; z-index:3;">
					<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="Rent">Max Monthly Rent:</label></span><br>
					<input type="text" name="Rent" id="Rent" size="13" maxlength="8" style="width:140px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" onkeypress="return onlyNumbers(event)" value="" tabindex="1"><br><br>
					<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="Bedrooms">Bedrooms:</label></span><br>
					<select name="Bedrooms" id="Bedrooms" tabindex="3" style="width:145px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;">
						<option value="" selected>Any</option>
						<option value="0">Studio</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
			  			<option value="4">4</option>
			  			<option value="5">5</option>
			  			<option value="6">6</option>
			  			<option value="7">7</option>
			  			<option value="8">8</option>
			  			<option value="9">9+</option>
					</select>
				</div>
				<!-- Right Column -->
				<div id="FormRight" style="position:absolute; top:40px; left:175px; width:170px; z-index:3;">
					<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="Street">Street Name: (eg: "South")</label></span><br>
					<input type="text" name="Street" id="Street" size="13" maxlength="20" style="width:140px; color:#3F3F3F;font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;" value="" tabindex="2"><br><br>
					<span style="font-family:'Myvetica',sans-serif; font-size:13px; color:#444444;"><label for="Order">Sort By:</label></span><br>
					<select name="Order" id="Order" tabindex="4" style="width:145px; color:#3F3F3F; font-family:'Myvetica',sans-serif; font-size:16px; background-color:#D9F0F5;">
						<option value="rent" selected>Rent</option>
						<option value="street">Street</option>
						<option value="bedrooms">Bedrooms</option>
						<option value="available">Availability</option>
					</select>
				</div>
				<!-- Contact field - for use later -->
				<input type="hidden" name="Contact" id="Contact" value="">
				<!-- Submit -->
				<div id="FormSubmit" style="position:absolute; top:180px; left:20px; width:350px; z-index:3;">
					<script>
					function getAll(){
						document.forms['Search'].Rent.value = "";
						document.forms['Search'].Bedrooms.value = "";
						document.forms['Search'].Street.value = "";
						document.forms['Search'].Contact.value = "";
						document.forms['Search'].Order.value = "rent";
						document.forms['Search'].submit();
					}
					</script>
					<input type="submit" value="Search">&nbsp;&nbsp;<a onClick="getAll();" title="Click to View ALL Available Homes" class="bodyBlue">Show All <?=$totalListings;?> Available Homes</a>
				</div>
			</div>
		</div>
		</form>
		<!-- Place cursor in first field by default -->
		<script>document.forms['Search'].Rent.focus();</script>
		<!-- Featured Home Box -->
		<?
		// Randomly grab a home to feature from those flagged as "featured"
		$query = "SELECT id, bedrooms, rent, photo FROM listings WHERE feature = 1 ORDER BY rand() LIMIT 1";
		$rs_featured = mysql_query($query, $linkID);
		$featured = mysql_fetch_assoc($rs_featured);
		$image = iif(file_exists("images/properties/".$featured["id"]."_".$featured["photo"]."_full.jpg"), "images/properties/".$featured["id"]."_".$featured["photo"]."_full.jpg", "images/properties/NoImage.jpg");
		?>
		<a onClick="getDetails('<?=$featured["id"];?>');" title="Click to Tour This Featured Home" style="text-decoration:none; cursor:pointer;">
		<!-- Outer Glow -->
		<div id="FeaturedHomeGlow" style="position:absolute; top:212px; left:483px; width:400px; height:275px; background-image:url(images/ImageGlow.png); z-index:2;">
			<!-- Featured Home Image -->
			<!-- Dynamically resize and restructure the background image by calling an external resizing script -->
			<div id="FeaturedHome" style="position:absolute; top:12px; left:12px; width:375px; height:250px; background-image:url(ResizeImage.php?image=<?=$image;?>&amp;width=375&amp;height=250&amp;format=jpg); background-color:#A0A0A0; background-position:center center; background-repeat:no-repeat; z-index:3;" class="roundedCorners">
				<!-- Add the "Tour" to the upper-right corner -->
				<div id="TourCorner" style="position:absolute; top:0px; right:0px; z-index:3;">
					<img src="images/TourCorner.png" alt="" width="74" height="74">
				</div>
				<!-- Add home information to bottom, over semi-transparent gradient background -->
<!--				<div id="ImageGradient" style="position:absolute; top:220px; left:0px; width:375px; height:30px; z-index:3;" class="gradientUp roundedBottoms">-->
				<!-- Since IE won't allow for stacked classes we are forced to use a gradient image instead (GRRR!!). Might as well just use it for all browsers -->
				<div id="ImageGradient" style="position:absolute; top:220px; left:0px; width:375px; height:30px; background-image:url(images/IEGradient.png); z-index:3;" class="roundedBottoms">
					<!-- Number of bedrooms -->
					<div id="NumBedrooms" style="position:absolute; top:5px; left:15px; z-index:4;">
						<span style="font-family:'Myvetica',sans-serif; font-size:15px; color:#FFFFFF;"><?=iif($featured["bedrooms"] == 0, "Studio", iif($featured["bedrooms"] == 9, "9+", $featured["bedrooms"])." Bedroom");?><?=iif($featured["bedrooms"] > 1, "s", "");?></span>
					</div>
					<!-- Monthly rent -->
					<div id="MonthlyRent" style="position:absolute; top:5px; right:15px; z-index:4;">
						<span style="font-family:'Myvetica',sans-serif; font-size:15px; color:#FFFFFF;"><?=money_format('%.0n', $featured["rent"]);?>/mo</span>
					</div>
				</div>
			</div>
		</div>
		</a>
	</div>
