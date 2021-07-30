<?
// Assign values
$sections = array();

$sections[0][0] = "home";
$sections[0][1] = "HomePage";
$sections[0][2] = "Home Page";
$sections[0][3] = "http://www.littlechurchlv.com/index/home";
$sections[0][4] = "visible";

$sections[1][0] = "gallery_grounds";
$sections[1][1] = "GroundsGalleryPage";
$sections[1][2] = "Grounds Gallery Page";
$sections[1][3] = "http://www.littlechurchlv.com/index/experience/gallery/grounds";
$sections[1][4] = "hidden";

$sections[2][0] = "gallery_chapel";
$sections[2][1] = "ChapelGalleryPage";
$sections[2][2] = "Chapel Gallery Page";
$sections[2][3] = "http://www.littlechurchlv.com/index/experience/gallery/chapel";
$sections[2][4] = "hidden";

$sections[3][0] = "history";
$sections[3][1] = "HistoryPage";
$sections[3][2] = "History Page";
$sections[3][3] = "http://www.littlechurchlv.com/index/experience/history";
$sections[3][4] = "hidden";

$sections[4][0] = "news";
$sections[4][1] = "NewsPage";
$sections[4][2] = "News Page";
$sections[4][3] = "http://www.littlechurchlv.com/index/experience/news";
$sections[4][4] = "hidden";

$sections[5][0] = "testimonials";
$sections[5][1] = "TestimonialsPage";
$sections[5][2] = "Testimonials Page";
$sections[5][3] = "http://www.littlechurchlv.com/index/experience/testimonials";
$sections[5][4] = "hidden";

$sections[6][0] = "wedding_package";
$sections[6][1] = "PackagesPage";
$sections[6][2] = "Wedding Packages Page";
$sections[6][3] = "http://www.littlechurchlv.com/index/packages/weddings";
$sections[6][4] = "hidden";

$sections[7][0] = "wedding";
$sections[7][1] = "";
$sections[7][2] = "";
$sections[7][3] = "";
$sections[7][4] = "Wedding";

$sections[8][0] = "renewal_package";
$sections[8][1] = "RenewalsPage";
$sections[8][2] = "Renewal Packages Page";
$sections[8][3] = "http://www.littlechurchlv.com/index/packages/renewals";
$sections[8][4] = "hidden";

$sections[9][0] = "renewal";
$sections[9][1] = "";
$sections[9][2] = "";
$sections[9][3] = "";
$sections[9][4] = "Renewal";

$sections[10][0] = "featured_package";
$sections[10][1] = "FeaturedPage";
$sections[10][2] = "Featured Packages Page";
$sections[10][3] = "http://www.littlechurchlv.com/index/packages/featured";
$sections[10][4] = "hidden";

$sections[11][0] = "featured";
$sections[11][1] = "";
$sections[11][2] = "";
$sections[11][3] = "";
$sections[11][4] = "Featured";

$sections[12][0] = "gallery_flowers";
$sections[12][1] = "FlowersGalleryPage";
$sections[12][2] = "Flowers Gallery Page";
$sections[12][3] = "http://www.littlechurchlv.com/index/services/flowers";
$sections[12][4] = "hidden";

$sections[13][0] = "photography";
$sections[13][1] = "PhotographyPage";
$sections[13][2] = "Photography Services Page";
$sections[13][3] = "http://www.littlechurchlv.com/index/services/photography";
$sections[13][4] = "hidden";

$sections[14][0] = "limousine";
$sections[14][1] = "LimousinePage";
$sections[14][2] = "Limousine Services Page";
$sections[14][3] = "https://secure.nr.net/littlechurchlv/index/services/limousine";
$sections[14][4] = "hidden";

$sections[15][0] = "additional_services";
$sections[15][1] = "AdditionalServicesPage";
$sections[15][2] = "Additional Services Page";
$sections[15][3] = "http://www.littlechurchlv.com/index/services/additional";
$sections[15][4] = "hidden";

$sections[16][0] = "webcam";
$sections[16][1] = "WebcamPage";
$sections[16][2] = "Webcam Page";
$sections[16][3] = "http://www.littlechurchlv.com/index/guests/webcam";
$sections[16][4] = "hidden";

$sections[17][0] = "questions";
$sections[17][1] = "FAQPage";
$sections[17][2] = "Questions (FAQ) Page";
$sections[17][3] = "http://www.littlechurchlv.com/index/questions";
$sections[17][4] = "hidden";

$sections[18][0] = "reservations";
$sections[18][1] = "ReservationsPage";
$sections[18][2] = "Reservations Page";
$sections[18][3] = "https://secure.nr.net/littlechurchlv/index/reservations";
$sections[18][4] = "hidden";

$sections[19][0] = "privacy";
$sections[19][1] = "PrivacyPage";
$sections[19][2] = "Privacy Policy Page";
$sections[19][3] = "http://www.littlechurchlv.com/index/privacy";
$sections[19][4] = "hidden";

$sections[20][0] = "terms";
$sections[20][1] = "TermsPage";
$sections[20][2] = "Terms of Use Page";
$sections[20][3] = "http://www.littlechurchlv.com/index/terms";
$sections[20][4] = "hidden";

$sections[21][0] = "sitemap";
$sections[21][1] = "SiteMapPage";
$sections[21][2] = "Site Map Page";
$sections[21][3] = "http://www.littlechurchlv.com/index/sitemap";
$sections[21][4] = "hidden";
?>

<!-- Build page -->
<table border="0" cellspacing="10" cellpadding="0">
<tr>
	<td class="xbigBlack">SEO Settings</td>
	<td valign="bottom" class="bodyBlack"><!--<em>(Sorted by <?=$sortby;?>)</em><br><img src="/images/spacer.gif" alt="" width="1" height="2" border="0">--></td>
</tr>
</table>

<?
// Step through all the sections and build edit screen
for ($key = 0; $key < sizeof($sections); $key++) {
	if ($sections[$key][4] == "visible" || $sections[$key][4] == "hidden"){
?>
<!-- Empty layer -->
<div id="<?=$sections[$key][1];?>OffDiv" style="position:static; visibility:visible;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: thin solid #000000;">
	<tr>
		<td width="100%" align="center" bgcolor="#000000" style="padding-top:2px; padding-bottom:4px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
				<td><img src="images/RightArrow.gif" alt="" width="12" height="9" border="0"><a href="<?=$sections[$key][3];?>" title="Click to View Page" target="blank" class="bigWhite"><?=$sections[$key][2];?></a></td>
				<td align="right"><a href="javascript:void(0);" onClick="hide('<?=$sections[$key][1];?>OffDiv');show('<?=$sections[$key][1];?>OnDiv');" class="bigWhite">Click To Edit</a>&nbsp;<img src="images/DownArrow.gif" alt="" width="12" height="9" border="0"></td>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	</tr>
	</table>
</div>

<!-- Populated layer -->
<div id="<?=$sections[$key][1];?>OnDiv" style="position:static; visibility:hidden; display:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" style="border: thin solid #000000;">
	<tr>
		<td width="100%" align="center" bgcolor="#000000" style="padding-top:2px; padding-bottom:4px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
				<td><img src="images/RightArrow.gif" alt="" width="12" height="9" border="0"><a href="<?=$sections[$key][3];?>" title="Click to View Page" target="blank" class="bigWhite"><?=$sections[$key][2];?></a></td>
				<td align="right"><a href="javascript:void(0);" onClick="hide('<?=$sections[$key][1];?>OnDiv');show('<?=$sections[$key][1];?>OffDiv');" class="bigWhite">Click To Hide</a>&nbsp;<img src="images/UpArrow.gif" alt="" width="12" height="9" border="0"></td>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table width="<?=($pageWidth-2);?>" border="0" cellspacing="0" cellpadding="5" class="bigBlack">
			<tr bgcolor="#E8E8E8">
				<td width="100"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Page Title:</strong></td>
				<td><input type="text" name="<?=$sections[$key][0];?>_seo_title" value="<?=$config2[$sections[$key][0]."_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="4"></td>
			</tr>
			<tr bgcolor="#F8F8F8">
				<td valign="top"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Description:</strong></td>
				<td><textarea cols="75" rows="2" name="<?=$sections[$key][0];?>_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="5"><?=$config2[$sections[$key][0]."_seo_description"];?></textarea></td>
			</tr>
			<tr bgcolor="#E8E8E8">
				<td valign="top"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Keywords:</strong></td>
				<td><textarea cols="75" rows="2" name="<?=$sections[$key][0];?>_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="6"><?=$config2[$sections[$key][0]."_seo_keywords"];?></textarea></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</div>

<?
		if ($sections[$key][4] == "visible"){ // Pop this one open
			echo"<script>hide('".$sections[$key][1],"OffDiv');show('".$sections[$key][1]."OnDiv');</script>";
		}
	}else{
		$query = "SELECT * FROM packages WHERE package_type = '".$sections[$key][4]."' ORDER BY position ASC;";
//echo $query;
		$rs_weddings = mysql_query($query, $linkID2);
		$tab = 22;
		for ($Counter=0; $Counter < mysql_num_rows($rs_weddings); $Counter++){
			$wedding = mysql_fetch_assoc($rs_weddings);
?>
<!-- Empty details layer -->
<div id="<?=$wedding["package_number"];?>OffDiv" style="position:static; visibility:visible;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border: thin solid #000000;">
	<tr>
		<td width="100%" align="center" bgcolor="#000000" style="padding-top:2px; padding-bottom:4px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
				<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><img src="images/RightArrow.gif" alt="" width="12" height="9" border="0"><a href="http://www.littlechurchlv.com/index/packagedetails/<?=$sections[$key][0];?>/<?=htmlspecialchars($wedding["package_name"]);?>" title="Click to View Page" target="blank" class="bigWhite"><?=$wedding["package_name"];?> <?=$sections[$key][4];?> Package Details Page</a></td>
				<td align="right"><a href="javascript:void(0);" onClick="hide('<?=$wedding["package_number"];?>OffDiv');show('<?=$wedding["package_number"];?>OnDiv');" class="bigWhite">Click To Edit</a>&nbsp;<img src="images/DownArrow.gif" alt="" width="12" height="9" border="0"></td>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td><img src="images/spacer.gif" alt="" width="1" height="5" border="0"></td>
	</tr>
	</table>
</div>

<!-- Populated details layer -->
<div id="<?=$wedding["package_number"];?>OnDiv" style="position:static; visibility:hidden; display:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#000000" style="border: thin solid #000000;">
	<tr>
		<td width="100%" align="center" bgcolor="#000000" style="padding-top:2px; padding-bottom:4px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
				<td><img src="images/spacer.gif" alt="" width="20" height="1" border="0"><img src="images/RightArrow.gif" alt="" width="12" height="9" border="0"><a href="http://www.littlechurchlv.com/index/packagedetails/<?=$sections[$key][0];?>/<?=htmlspecialchars($wedding["package_name"]);?>" title="Click to View Page" target="blank" class="bigWhite"><?=$wedding["package_name"];?> <?=$sections[$key][4];?> Package Details Page</a></td>
				<td align="right"><a href="javascript:void(0);" onClick="hide('<?=$wedding["package_number"];?>OnDiv');show('<?=$wedding["package_number"];?>OffDiv');" class="bigWhite">Click To Hide</a>&nbsp;<img src="images/UpArrow.gif" alt="" width="12" height="9" border="0"></td>
				<td width="10"><img src="images/spacer.gif" alt="" width="10" height="1" border="0"></td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="center">
			<table width="<?=($pageWidth-2);?>" border="0" cellspacing="0" cellpadding="5" class="bigBlack">
			<tr bgcolor="#E8E8E8">
				<td width="100"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Page Title:</strong></td>
				<td><input type="text" name="<?=$wedding["package_number"];?>_seo_title" value="<?=$wedding["seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="4"></td>
			</tr>
			<tr bgcolor="#F8F8F8">
				<td valign="top"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Description:</strong></td>
				<td><textarea cols="75" rows="2" name="<?=$wedding["package_number"];?>_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="5"><?=$wedding["seo_description"];?></textarea></td>
			</tr>
			<tr bgcolor="#E8E8E8">
				<td valign="top"><img src="images/spacer.gif" alt="" width="5" height="1" border="0"><strong>Keywords:</strong></td>
				<td><textarea cols="75" rows="2" name="<?=$wedding["package_number"];?>_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:830;" tabindex="6"><?=$wedding["seo_keywords"];?></textarea></td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
</div>
<?
		}
	}
}
?>
