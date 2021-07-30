<?
//Make sure they didn't deep link.  If they did, send 'em home.
if ($_REQUEST['ID'] != ""){
	$_SESSION['ID'] = $_REQUEST['ID'];
}
if (!$_SESSION['ID'] || $_SESSION['ID'] == "") echo "<script>location.replace('/');</script>";

// Increment views counter
$query = "UPDATE listings SET views = views + 1 WHERE id = ".$_REQUEST['ID'].";";
//echo $query."<br><br>";
$rs_update = mysql_query($query, $linkID);

// Get property details
$query = "SELECT * FROM listings WHERE id = ".$_SESSION['ID'].";";
//echo $query."<br><br>";
$rs_details = mysql_query($query, $linkID);
$details = mysql_fetch_assoc($rs_details)
?>
	<!-- Details Content -->
	<div id="Content" style="position:relative; top:0px; left:0px; width:960px; height:1030px; z-index:1;">
		<img src="images/ResultsBG.png" alt="" width="960" height="1030">
		<!-- Top Section -->
		<div id="Header" style="position:absolute; top:25px; left:20px; z-index:2;">
			<!-- Logo Image -->
			<a href="/" title="Click for wmuhomes.com Home Page"><img src="images/Logo.png" alt="" width="54" height="62" style="border:none;" class="shadowSmall"></a>
			<!-- Text -->
			<div id="HeaderText" style="position:absolute; top:5px; left:70px; width:500px; z-index:2;">
				<span style="font-family:'Myvetica',sans-serif; font-size:36px; color:#FFFFFF;">wmuhomes.com</span><br>
				<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF;">Kalamazoo Michigan Luxury & Student Rental Homes</span><br><br>
			</div>
		</div>
		<!-- Bottom Left Section -->
		<?
		$image = iif(file_exists("images/properties/".$details["id"]."_".$details["photo"]."_full.jpg"), "images/properties/".$details["id"]."_".$details["photo"]."_full.jpg", "images/properties/NoImage.jpg");
		?>
		<div id="ChosenImageGlow" title="Click to Take a Tour" style="position:absolute; top:120px; left:60px; width:400px; height:275px; background-image:url(images/ImageGlow.png); z-index:2;">
			<!-- Chosen Image -->
			<!-- For non-IE, dynamically resize and restructure the background image by calling an external resizing script -->
			<![if (!IE)|(IE 9)]>
			<a href="<?=$image;?>" style="text-decoration:none;"><div id="ChosenImage" style="position:absolute; top:12px; left:12px; width:375px; height:250px; background-image:url(ResizeImage.php?image=<?=$image;?>&amp;width=375&amp;height=250&amp;format=jpg); background-color:#A0A0A0; background-position:center center; background-repeat:no-repeat; z-index:3;" class="roundedCorners">
			<![endif]>
			<!-- For IE, dynamically resize and restructure a foreground image by calling an external resizing script.
				 IE can actually handle the above code BUT there is a conflict between the CurvyCorners script and Lightview which breaks it
				 so the below code must be used for IE under version 9 when both frameworks are loaded simultaneously -->
			<!--[if lt IE 9]>
			<a href="<?=$image;?>"><div id="ChosenImage" style="position:absolute; top:12px; left:12px; width:375px; height:250px; background-color:#A0A0A0; z-index:3;" class="roundedCorners">
				<img id="TourImage" src="ResizeImage.php?image=<?=$image;?>&amp;width=375&amp;height=250&amp;format=jpg" style="display:block; margin:auto; border:none;">
			<![endif]-->
				<!-- Add the "Tour" to the upper-right corner -->
				<div id="TourCorner" style="position:absolute; top:0px; right:0px; z-index:3;">
					<img src="images/TourCorner.png" alt="" width="74" height="74" style="border:none;">
				</div>
				<!-- Add home information to bottom, over semi-transparent gradient background -->
<!--				<div id="ImageGradient" style="position:absolute; top:220px; left:0px; width:375px; height:30px; z-index:3;" class="gradientUp roundedBottoms">-->
				<!-- Since IE won't allow for stacked classes we are forced to use a gradient image instead (GRRR!!). Might as well just use it for all browsers -->
				<div id="ImageGradient" style="position:absolute; top:220px; left:0px; width:375px; height:30px; background-image:url(images/IEGradient.png); z-index:3;" class="roundedBottoms">
					<!-- Number of bedrooms -->
					<div id="NumBedrooms" style="position:absolute; top:5px; left:15px; z-index:4;">
						<span style="font-family:'Myvetica',sans-serif; font-size:15px; color:#FFFFFF;"><?=iif($details["bedrooms"] == 0, "Studio", iif($details["bedrooms"] == 9, "9+", $details["bedrooms"])." Bedroom");?><?=iif($details["bedrooms"] > 1, "s", "");?></span>
					</div>
					<!-- Monthly rent -->
					<div id="MonthlyRent" style="position:absolute; top:5px; right:15px; z-index:4;">
						<span style="font-family:'Myvetica',sans-serif; font-size:15px; color:#FFFFFF;"><?=money_format('%.0n', $details["rent"]);?>/mo</span>
					</div>
				</div>
			</div></a>
		</div>
		<div id="Thumbnails" style="position:absolute; top:400px; left:60px; width:375px; height:250px; z-index:2;">
			<?
			$top = 0;
			$left = 12;
			for ($loop = 1; $loop <= 9; $loop++){
				if (file_exists("images/properties/".$details["id"]."_".($loop-1)."_full.jpg")){
					$image = "images/properties/".$details["id"]."_".($loop-1)."_full.jpg";
			?>
			<!-- For non-IE, code for swapping the background image above on mouseOver AND for launching Lightview onClick -->
			<![if (!IE)|(IE 9)]>
			<a href="<?=$image;?>" class="lightview" rel="gallery[mygallery]"><div id="Thumb<?=($loop-1)?>" title="Click to Enlarge" style="position:absolute; top:<?=$top;?>px; left:<?=$left;?>px; width:113px; height:75px; background-image:url(ResizeImage.php?image=<?=$image;?>&amp;width=113&amp;height=75&amp;format=jpg); background-color:#A0A0A0; background-position:center center; background-repeat:no-repeat; z-index:3;" onMouseOver="document.getElementById('ChosenImage').style.backgroundImage='url(ResizeImage.php?image=<?=$image;?>&amp;width=375&amp;height=250&amp;format=jpg)'; document.getElementById('ChosenImage').style.backgroundColor='#A0A0A0'; document.getElementById('ChosenImage').style.backgroundPosition='center center'; document.getElementById('ChosenImage').style.backgroundRepeat='no-repeat';" class="roundedCorners"></div></a>
			<![endif]>
			<!-- For IE, code for swapping the foreground image above on mouseOver AND for launching Lightview onClick -->
			<!--[if lt IE 9]>
			<a href="<?=$image;?>" class="lightview" rel="gallery[mygallery]"><div id="ThumbTopRight" title="Click to Enlarge" style="position:absolute; top:<?=$top;?>px; left:<?=$left;?>px; width:113px; height:75px; background-image:url(ResizeImage.php?image=<?=$image;?>&amp;width=113&amp;height=75&amp;format=jpg); background-color:#A0A0A0; background-position:center center; background-repeat:no-repeat; z-index:3;" onMouseOver="document.getElementById('TourImage').src='ResizeImage.php?image=<?=$image;?>&amp;width=375&amp;height=250&amp;format=jpg';" class="roundedCorners"></div></a>
			<![endif]-->
			<?
				}else{
			?>
			<![if (!IE)|(IE 9)]>
			<div id="Thumb<?=($loop-1)?>" style="position:absolute; top:<?=$top;?>px; left:<?=$left;?>px; width:113px; height:75px; z-index:3;" class="frostGray roundedCorners"></div>
			<![endif]>
			<!--[if lt IE 9]>
			<div id="Thumb<?=($loop-1)?>" style="position:absolute; top:<?=$top;?>px; left:<?=$left;?>px; width:113px; height:75px; background-color:#E0E0E0; z-index:3;" class="roundedCorners"></div>
			<![endif]-->
			<?
				}
				$left += 131;
				if (is_multiple($loop, 3)){
					$top += 90;
					$left = 12;
				}
			}
			?>
		</div>
		<!-- Google Map -->
		<div id="GoogleMapGlow" style="position:absolute; top:675px; left:60px; width:400px; height:275px; background-image:url(images/ImageGlow.png); z-index:2;">
			<div id="GoogleMap" style="position:absolute; top:12px; left:12px; width:375px; height:250px; z-index:3;" class="roundedCorners">
				<iframe width="375" height="250" frameborder="0" scrolling="no" src="http://maps.google.com/maps?hl=en&amp;safe=off&amp;q=<?=urlencode($details["streetnumber"]." ".$details["street"]." ".$details["zip"]);?>&amp;ie=UTF8&amp;hq=&amp;hnear=<?=urlencode($details["streetnumber"]." ".$details["street"]." ".$details["zip"]);?>&amp;z=15&amp;output=embed&amp;iwloc=near" class="roundedCorners"></iframe>
			</div>
		</div>

		<!-- Lower Right Section -->
		<!-- Address -->
		<div id="AddressBlock" style="position:absolute; top:130px; right:60px; width:425px; height:80px; z-index:2;">
			<div id="AddressLabel" style="position:absolute; font-family:'Myvetica',sans-serif; font-size:18px; color:#284C88; top:0px; left:5px; width:425px; z-index:3;">
				Kalamazoo Student Rental Home:
			</div>
			<div id="Address" title="<?=$details["streetnumber"]." ".$details["street"].iif($details["aptnumber"] != "", ", Apt. ".$details["aptnumber"], "");?>" style="position:absolute; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-family:'Myvetica',sans-serif; font-size:30px; color:#284C88; top:22px; left:5px; width:425px; z-index:3;">
				<strong><?=$details["streetnumber"]." ".$details["street"].iif($details["aptnumber"] != "", ", Apt. ".$details["aptnumber"], "");?></strong>
			</div>
		</div>
		<!-- Property Details -->
		<![if (!IE)|(IE 9)]>
		<div id="DetailsBlock" style="position:absolute; top:190px; right:60px; width:425px; height:335px; z-index:2;" class="frostWhite roundedCorners">
		<![endif]>
		<!--[if lt IE 9]>
		<div id="DetailsBlock" style="position:absolute; top:190px; right:60px; width:425px; height:225px; background-image:url(images/WhiteFrostDot.png); z-index:2;" class="roundedTops">
		<![endif]-->
			<div id="DetailsLabels" style="position:absolute; font-family:'Myvetica',sans-serif; font-size:18px; color:#284C88; line-height:23px; top:10px; left:15px; width:100px; height:200px; z-index:3;">
				Rent:<br>
				Bedrooms:<br>
				Bathrooms:<br>
				Size:<br>
				Tenants:<br>
				Utilities:<br>
				Pets:<br>
				Furnished:<br>
				Available:
			</div>
			<div id="DetailsValues" style="position:absolute; font-family:'Myvetica',sans-serif; font-size:18px; color:#287BE2; line-height:23px; top:10px; left:125px; width:250px; height:200px; z-index:3;">
				<?=money_format('%.0n', $details["rent"]);?>/mo<br>
				<?=$details["bedrooms"];?><br>
				<?=$details["bathrooms"];?><br>
				<?=number_format($details["sqfeet"]);?> Sq. Feet<br>
				<?=$details["tenants"];?><br>
				<?=iif($details["utilities"] == 0, "Not ", "");?> Included<br>
				<?=iif($details["pets"] == 0, "Not ", "");?> Allowed<br>
				<?=iif($details["furnished"] == 0, "No", "Yes");?><br>
				<?=date("F j, Y",  strtotime($details["available"]));?>
			</div>
			<!-- Link to full Google Map -->
			<div id="MapLink" title="Click for Full-Size Google Map" style="position:absolute; top:5px; right:15px; width:50px; height:40px; text-align:right; vertical-align:middle; z-index:3;">
				<a href="http://maps.google.com/maps?hl=en&amp;safe=off&amp;q=<?=urlencode($details["streetnumber"]." ".$details["street"]." ".$details["zip"]);?>&amp;pdl=3000&amp;um=1&amp;ie=UTF-8&amp;sa=N&amp;tab=wl" target="_blank"><img src="images/MapPin.png" alt="" width="20" height="30" style="border:none;"></a><a href="http://maps.google.com/maps?hl=en&amp;safe=off&amp;q=<?=urlencode($details["streetnumber"]." ".$details["street"]." ".$details["zip"]);?>&amp;pdl=3000&amp;um=1&amp;ie=UTF-8&amp;sa=N&amp;tab=wl" target="_blank" class="titleBlue">Map</a>
			</div>
			<!-- Contact -->
			<![if (!IE)|(IE 9)]>
			<div id="ContactBlock" style="position:absolute; bottom:0px; right:0px; width:425px; height:110px; z-index:3;" class="frostBlue roundedBottoms">
			<![endif]>
			<!--[if lt IE 9]>
			<div id="ContactBlock" style="position:absolute; top:225px; right:0px; width:425px; height:110px; background-image:url(images/BlueFrostDot.png); z-index:3;" class="roundedBottoms">
			<![endif]-->
				<div id="Promo" style="position:absolute; white-space:nowrap; overflow:hidden; font-family:'MyveticaOblique',sans-serif; font-size:17px; color:#FFFFFF; line-height:23px; top:10px; left:8px; width:400px; height:25px; z-index:3;">
					*Tell them you found their listing on wmuhomes.com!
				</div>
				<div id="ContactLabels" style="position:absolute; font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF; line-height:23px; top:35px; left:15px; width:100px; height:50px; z-index:3;">
					Contact:<br>
					Phone:
				</div>
				<div id="ContactValues" style="position:absolute; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF; line-height:23px; top:35px; left:125px; width:295px; height:50px; z-index:3;">
					<!-- This redundant font declaration is needed to fool IE into not resetting the font to the default when curveycorners are set
						 It must be wrapped around the last text in the last DIV that has rounded corners...don'cha just LOVE IE?? -->
					<span style="font-family:'Myvetica',sans-serif; font-size:18px; color:#FFFFFF;">
						<span title="<?=$details["contact"];?>"><?=$details["contact"];?></span><br>
						<span title="<?=$details["phone"];?>"><?=$details["phone"];?></span><br>
					</span>
				</div>
				<div id="<?=$details["contact"];?>EmailLink" style="position:absolute; white-space:nowrap; overflow:hidden; font-family:'Myvetica',sans-serif; font-size:17px; color:#FFFFFF; line-height:23px; top:80px; left:15px; width:145px; height:25px; z-index:3;">
<!--					<a href="mailto:<?=$details["email"];?>?subject=Your wmuhomes.com listing for <?=$details["streetnumber"]." ".$details["street"].iif($details["aptnumber"] != "", ", Apt. ".$details["aptnumber"], "");?>" title="Click to email <?=$details["contact"];?>" class="titleBlue">Email Contact</a>-->
					<a href="javascript:show('overlayMask');" class="titleBlue">Email Contact</a>
				</div>
				<div id="<?=$details["contact"];?>ListingsLink" style="position:absolute; white-space:nowrap; text-align:right; font-family:'Myvetica',sans-serif; font-size:17px; color:#FFFFFF; line-height:23px; top:80px; right:15px; width:250px; height:25px; z-index:3;">
					<a onClick="getResults('','<?=urlencode($details['contact']);?>','','','Rent');" title="Click to view all of <?=$details["contact"];?>'s Listings" class="titleBlue">View All Of This Contact's Listings</a>
				</div>
			</div>
		</div>
		<!-- Availability -->
		<div id="AvailabilityBlock" style="position:absolute; top:540px; right:60px; width:410px; height:25px; font-family:'Myvetica',sans-serif; font-size:18px; font-weight:bold; color:#284C88; z-index:2;">
			This rental is available after <?=date("M j, Y",  strtotime($details["available"]));?>.
		</div>
		<!-- Description (Scrollable) -->
		<div id="DescriptionBlock" style="position:absolute; top:570px; right:60px; width:410px; height:365px; overflow:auto; font-family:'Myvetica',sans-serif; font-size:14px; color:#284C88; line-height:16px; z-index:2;">
			<?=$details["description"];?><br><br>
			This property listing has been viewed <strong><?=number_format($details["views"]);?></strong> time<?=iif(($details["views"] == 0 || $details["views"] > 1), "s", "");?>.
		</div>
	</div>
	<!-- Email Form -->
	<script>
		browserWidth = document.body.clientWidth;
		browserHeight = document.body.clientHeight;
		containerWidth = 600;
		containerHeight = 400;
		document.write('<style>.emailContainer {position:absolute; top:'+((browserHeight/2)-(containerHeight/2))+'px; left:'+((browserWidth/2)-(containerWidth/2))+'px; width:'+containerWidth+'px; height:'+containerHeight+'px;}</style>');
	</script>
	<div id="overlayMask" style="position:fixed; top:0px; left:0px; width:100%; height:100%; z-index:999; display:none; visibility:hidden;">
<!--	<div id="overlayMask" style="position:fixed; top:0px; left:0px; width:100%; height:100%; z-index:999;">-->
		<img src="images/Overlay.png" alt="" width="100%" height="100%">
<!--		<div id="emailForm" style="position:absolute; top:50%; left:'+((browserWidth/2)-(<?=$pageWidth;?>/2))+'px; z-index:99999; width:600px; height:300px; background-image:url(images/EmailBG.jpg); background-color:#FFFFFF; background-position:bottom left; background-repeat:no-repeat; display:block; visibility:visible;">-->
		<div id="emailContainer" class="emailContainer">
			<div id="emailFrame" style="position:absolute; top:0px; left:0px; z-index:1000; width:600px; height:400px; border:solid white 15px; background-image:url(images/EmailBG.jpg); background-color:#FFFFFF; background-position:bottom left; background-repeat:no-repeat;" class="roundedCorners">


<?
include("include/emailform.php");
?>



			</div>
		</div>
	</div>

<!--<a href="javascript:void(0);" onClick="show('overlayMask');" class="bodyBlue">.</a>-->
	