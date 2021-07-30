<?
// Grab the database
include("../dbconnect.php");

// If form submitted, write to database
if ($_REQUEST['task'] == "submit"){
/*	$query =
		"UPDATE config SET
			home_seo_title = '".addslashes($_REQUEST['home_seo_title'])."',
			home_seo_description = '".addslashes($_REQUEST['home_seo_description'])."',
			home_seo_keywords = '".addslashes($_REQUEST['home_seo_keywords'])."',
			gallery_grounds_seo_title = '".addslashes($_REQUEST['gallery_grounds_seo_title'])."',
			gallery_grounds_seo_description = '".addslashes($_REQUEST['gallery_grounds_seo_description'])."',
			gallery_grounds_seo_keywords = '".addslashes($_REQUEST['gallery_grounds_seo_keywords'])."',
			gallery_chapel_seo_title = '".addslashes($_REQUEST['gallery_chapel_seo_title'])."',
			gallery_chapel_seo_description = '".addslashes($_REQUEST['gallery_chapel_seo_description'])."',
			gallery_chapel_seo_keywords = '".addslashes($_REQUEST['gallery_chapel_seo_keywords'])."',
			history_seo_title = '".addslashes($_REQUEST['history_seo_title'])."',
			history_seo_description = '".addslashes($_REQUEST['history_seo_description'])."',
			history_seo_keywords = '".addslashes($_REQUEST['history_seo_keywords'])."',
			news_seo_title = '".addslashes($_REQUEST['news_seo_title'])."',
			news_seo_description = '".addslashes($_REQUEST['news_seo_description'])."',
			news_seo_keywords = '".addslashes($_REQUEST['news_seo_keywords'])."',
			testimonials_seo_title = '".addslashes($_REQUEST['testimonials_seo_title'])."',
			testimonials_seo_description = '".addslashes($_REQUEST['testimonials_seo_description'])."',
			testimonials_seo_keywords = '".addslashes($_REQUEST['testimonials_seo_keywords'])."',
			wedding_package_seo_title = '".addslashes($_REQUEST['wedding_package_seo_title'])."',
			wedding_package_seo_description = '".addslashes($_REQUEST['wedding_package_seo_description'])."',
			wedding_package_seo_keywords = '".addslashes($_REQUEST['wedding_package_seo_keywords'])."',
			renewal_package_seo_title = '".addslashes($_REQUEST['renewal_package_seo_title'])."',
			renewal_package_seo_description = '".addslashes($_REQUEST['renewal_package_seo_description'])."',
			renewal_package_seo_keywords = '".addslashes($_REQUEST['renewal_package_seo_keywords'])."',
			featured_package_seo_title = '".addslashes($_REQUEST['featured_package_seo_title'])."',
			featured_package_seo_description = '".addslashes($_REQUEST['featured_package_seo_description'])."',
			featured_package_seo_keywords = '".addslashes($_REQUEST['featured_package_seo_keywords'])."',
			gallery_flowers_seo_title = '".addslashes($_REQUEST['gallery_flowers_seo_title'])."',
			gallery_flowers_seo_description = '".addslashes($_REQUEST['gallery_flowers_seo_description'])."',
			gallery_flowers_seo_keywords = '".addslashes($_REQUEST['gallery_flowers_seo_keywords'])."',
			photography_seo_title = '".addslashes($_REQUEST['photography_seo_title'])."',
			photography_seo_description = '".addslashes($_REQUEST['photography_seo_description'])."',
			photography_seo_keywords = '".addslashes($_REQUEST['photography_seo_keywords'])."',
			limousine_seo_title = '".addslashes($_REQUEST['limousine_seo_title'])."',
			limousine_seo_description = '".addslashes($_REQUEST['limousine_seo_description'])."',
			limousine_seo_keywords = '".addslashes($_REQUEST['limousine_seo_keywords'])."',
			additional_services_seo_title = '".addslashes($_REQUEST['additional_services_seo_title'])."',
			additional_services_seo_description = '".addslashes($_REQUEST['additional_services_seo_description'])."',
			additional_services_seo_keywords = '".addslashes($_REQUEST['additional_services_seo_keywords'])."',
			webcam_seo_title = '".addslashes($_REQUEST['webcam_seo_title'])."',
			webcam_seo_description = '".addslashes($_REQUEST['webcam_seo_description'])."',
			webcam_seo_keywords = '".addslashes($_REQUEST['webcam_seo_keywords'])."',
			questions_seo_title = '".addslashes($_REQUEST['questions_seo_title'])."',
			questions_seo_description = '".addslashes($_REQUEST['questions_seo_description'])."',
			questions_seo_keywords = '".addslashes($_REQUEST['questions_seo_keywords'])."',
			reservations_seo_title = '".addslashes($_REQUEST['reservations_seo_title'])."',
			reservations_seo_description = '".addslashes($_REQUEST['reservations_seo_description'])."',
			reservations_seo_keywords = '".addslashes($_REQUEST['reservations_seo_keywords'])."',
			feedback_seo_title = '".addslashes($_REQUEST['feedback_seo_title'])."',
			feedback_seo_description = '".addslashes($_REQUEST['feedback_seo_description'])."',
			feedback_seo_keywords = '".addslashes($_REQUEST['feedback_seo_keywords'])."',
			message_seo_title = '".addslashes($_REQUEST['message_seo_title'])."',
			message_seo_description = '".addslashes($_REQUEST['message_seo_description'])."',
			message_seo_keywords = '".addslashes($_REQUEST['message_seo_keywords'])."',
			privacy_seo_title = '".addslashes($_REQUEST['privacy_seo_title'])."',
			privacy_seo_description = '".addslashes($_REQUEST['privacy_seo_description'])."',
			privacy_seo_keywords = '".addslashes($_REQUEST['privacy_seo_keywords'])."',
			terms_seo_title = '".addslashes($_REQUEST['terms_seo_title'])."',
			terms_seo_description = '".addslashes($_REQUEST['terms_seo_description'])."',
			terms_seo_keywords = '".addslashes($_REQUEST['terms_seo_keywords'])."',
			sitemap_seo_title = '".addslashes($_REQUEST['sitemap_seo_title'])."',
			sitemap_seo_description = '".addslashes($_REQUEST['sitemap_seo_description'])."',
			sitemap_seo_keywords = '".addslashes($_REQUEST['sitemap_seo_keywords'])."'
			WHERE sitename = 'littlechurchlv.com'";
*/
	$query =
		"UPDATE config SET
			home_seo_title = '".$_REQUEST['home_seo_title']."',
			home_seo_description = '".$_REQUEST['home_seo_description']."',
			home_seo_keywords = '".$_REQUEST['home_seo_keywords']."',
			gallery_grounds_seo_title = '".$_REQUEST['gallery_grounds_seo_title']."',
			gallery_grounds_seo_description = '".$_REQUEST['gallery_grounds_seo_description']."',
			gallery_grounds_seo_keywords = '".$_REQUEST['gallery_grounds_seo_keywords']."',
			gallery_chapel_seo_title = '".$_REQUEST['gallery_chapel_seo_title']."',
			gallery_chapel_seo_description = '".$_REQUEST['gallery_chapel_seo_description']."',
			gallery_chapel_seo_keywords = '".$_REQUEST['gallery_chapel_seo_keywords']."',
			history_seo_title = '".$_REQUEST['history_seo_title']."',
			history_seo_description = '".$_REQUEST['history_seo_description']."',
			history_seo_keywords = '".$_REQUEST['history_seo_keywords']."',
			news_seo_title = '".$_REQUEST['news_seo_title']."',
			news_seo_description = '".$_REQUEST['news_seo_description']."',
			news_seo_keywords = '".$_REQUEST['news_seo_keywords']."',
			testimonials_seo_title = '".$_REQUEST['testimonials_seo_title']."',
			testimonials_seo_description = '".$_REQUEST['testimonials_seo_description']."',
			testimonials_seo_keywords = '".$_REQUEST['testimonials_seo_keywords']."',
			wedding_package_seo_title = '".$_REQUEST['wedding_package_seo_title']."',
			wedding_package_seo_description = '".$_REQUEST['wedding_package_seo_description']."',
			wedding_package_seo_keywords = '".$_REQUEST['wedding_package_seo_keywords']."',
			renewal_package_seo_title = '".$_REQUEST['renewal_package_seo_title']."',
			renewal_package_seo_description = '".$_REQUEST['renewal_package_seo_description']."',
			renewal_package_seo_keywords = '".$_REQUEST['renewal_package_seo_keywords']."',
			featured_package_seo_title = '".$_REQUEST['featured_package_seo_title']."',
			featured_package_seo_description = '".$_REQUEST['featured_package_seo_description']."',
			featured_package_seo_keywords = '".$_REQUEST['featured_package_seo_keywords']."',
			gallery_flowers_seo_title = '".$_REQUEST['gallery_flowers_seo_title']."',
			gallery_flowers_seo_description = '".$_REQUEST['gallery_flowers_seo_description']."',
			gallery_flowers_seo_keywords = '".$_REQUEST['gallery_flowers_seo_keywords']."',
			photography_seo_title = '".$_REQUEST['photography_seo_title']."',
			photography_seo_description = '".$_REQUEST['photography_seo_description']."',
			photography_seo_keywords = '".$_REQUEST['photography_seo_keywords']."',
			limousine_seo_title = '".$_REQUEST['limousine_seo_title']."',
			limousine_seo_description = '".$_REQUEST['limousine_seo_description']."',
			limousine_seo_keywords = '".$_REQUEST['limousine_seo_keywords']."',
			additional_services_seo_title = '".$_REQUEST['additional_services_seo_title']."',
			additional_services_seo_description = '".$_REQUEST['additional_services_seo_description']."',
			additional_services_seo_keywords = '".$_REQUEST['additional_services_seo_keywords']."',
			webcam_seo_title = '".$_REQUEST['webcam_seo_title']."',
			webcam_seo_description = '".$_REQUEST['webcam_seo_description']."',
			webcam_seo_keywords = '".$_REQUEST['webcam_seo_keywords']."',
			questions_seo_title = '".$_REQUEST['questions_seo_title']."',
			questions_seo_description = '".$_REQUEST['questions_seo_description']."',
			questions_seo_keywords = '".$_REQUEST['questions_seo_keywords']."',
			reservations_seo_title = '".$_REQUEST['reservations_seo_title']."',
			reservations_seo_description = '".$_REQUEST['reservations_seo_description']."',
			reservations_seo_keywords = '".$_REQUEST['reservations_seo_keywords']."',
			feedback_seo_title = '".$_REQUEST['feedback_seo_title']."',
			feedback_seo_description = '".$_REQUEST['feedback_seo_description']."',
			feedback_seo_keywords = '".$_REQUEST['feedback_seo_keywords']."',
			message_seo_title = '".$_REQUEST['message_seo_title']."',
			message_seo_description = '".$_REQUEST['message_seo_description']."',
			message_seo_keywords = '".$_REQUEST['message_seo_keywords']."',
			privacy_seo_title = '".$_REQUEST['privacy_seo_title']."',
			privacy_seo_description = '".$_REQUEST['privacy_seo_description']."',
			privacy_seo_keywords = '".$_REQUEST['privacy_seo_keywords']."',
			terms_seo_title = '".$_REQUEST['terms_seo_title']."',
			terms_seo_description = '".$_REQUEST['terms_seo_description']."',
			terms_seo_keywords = '".$_REQUEST['terms_seo_keywords']."',
			sitemap_seo_title = '".$_REQUEST['sitemap_seo_title']."',
			sitemap_seo_description = '".$_REQUEST['sitemap_seo_description']."',
			sitemap_seo_keywords = '".$_REQUEST['sitemap_seo_keywords']."'
			WHERE sitename = 'littlechurchlv.com'";
//echo $query.'<br></br>';
	$result = mysql_query($query, $linkID2);

	// Wedding Package Detail Pages
	$query = "SELECT * FROM packages WHERE package_type = 'Wedding' ORDER BY position ASC;";
	$rs_weddings = mysql_query($query, $linkID2);
	for ($Counter=1; $Counter <= mysql_num_rows($rs_weddings)+1; $Counter++){
		$wedding = mysql_fetch_assoc($rs_weddings);
		$query =
			"UPDATE packages SET
				seo_title = '".addslashes($_REQUEST['Package'.$Counter.'_seo_title'])."',
				seo_description = '".addslashes($_REQUEST['Package'.$Counter.'_seo_description'])."',
				seo_keywords = '".addslashes($_REQUEST['Package'.$Counter.'_seo_keywords'])."'
			WHERE package_number = 'Package".$Counter."'";
//echo $query.'<br></br>';
		$result = mysql_query($query, $linkID2);
	}

	// Renewal Package Detail Pages
	$query = "SELECT * FROM packages WHERE package_type = 'Renewal' ORDER BY position ASC;";
	$rs_renewals = mysql_query($query, $linkID2);
	for ($Counter=1; $Counter <= mysql_num_rows($rs_renewals)+1; $Counter++){
		$renewal = mysql_fetch_assoc($rs_renewals);
		$query =
			"UPDATE packages SET
				seo_title = '".addslashes($_REQUEST['Renewal'.$Counter.'_seo_title'])."',
				seo_description = '".addslashes($_REQUEST['Renewal'.$Counter.'_seo_description'])."',
				seo_keywords = '".addslashes($_REQUEST['Renewal'.$Counter.'_seo_keywords'])."'
			WHERE package_number = 'Renewal".$Counter."'";
//echo $query.'<br></br>';
		$result = mysql_query($query, $linkID2);
	}

	// Featured Package Detail Pages
	$query = "SELECT * FROM packages WHERE package_type = 'Featured' ORDER BY position ASC;";
	$rs_features = mysql_query($query, $linkID2);
	for ($Counter=1; $Counter <= mysql_num_rows($rs_features)+1; $Counter++){
		$featured = mysql_fetch_assoc($rs_features);
		$query =
			"UPDATE packages SET
				seo_title = '".addslashes($_REQUEST['Featured'.$Counter.'_seo_title'])."',
				seo_description = '".addslashes($_REQUEST['Featured'.$Counter.'_seo_description'])."',
				seo_keywords = '".addslashes($_REQUEST['Featured'.$Counter.'_seo_keywords'])."'
			WHERE package_number = 'Featured".$Counter."'";
//echo $query.'<br></br>';
		$result = mysql_query($query, $linkID2);
	}

	// Tell 'em it's done
	echo'
		<script>alert("Update Successful");</script>
	';
}

// Load the config settings
$query = "SELECT * FROM config";
$rs_config = mysql_query($query, $linkID);
$config = mysql_fetch_assoc($rs_config);
$rs_config2 = mysql_query($query, $linkID2);
$config2 = mysql_fetch_assoc($rs_config2);
?>

<script>
function validateSEO(theForm){
	return true;
}
</script>

<form action="" method="post" name="seo" id="seo" onSubmit="return validateSEO(this);">
<br>
<div align="center"><font size="+2"><strong>Temporary SEO Content Management Facility</strong></font></div>
<br>
<table border="1" cellspacing="0" cellpadding="0" align="center">
<!-- Home Page -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/home" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Home Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="home_seo_title" value="<?=$config2["home_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="1"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="home_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="2"><?=$config2["home_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="home_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="3"><?=$config2["home_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Grounds Gallery -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/experience/gallery/grounds" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Grounds Gallery Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="gallery_grounds_seo_title" value="<?=$config2["gallery_grounds_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="4"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="gallery_grounds_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="5"><?=$config2["gallery_grounds_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="gallery_grounds_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="6"><?=$config2["gallery_grounds_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Chapel Gallery -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/experience/gallery/chapel" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Chapel Gallery Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="gallery_chapel_seo_title" value="<?=$config2["gallery_chapel_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="7"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="gallery_chapel_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="8"><?=$config2["gallery_chapel_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="gallery_chapel_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="9"><?=$config2["gallery_chapel_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- History -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/experience/history" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">History Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="history_seo_title" value="<?=$config2["history_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="10"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="history_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="11"><?=$config2["history_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="history_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="12"><?=$config2["history_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- News -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/experience/news" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">News Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="news_seo_title" value="<?=$config2["news_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="13"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="news_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="14"><?=$config2["news_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="news_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="15"><?=$config2["news_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Testimonials -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/experience/testimonials" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Testimonials Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="testimonials_seo_title" value="<?=$config2["testimonials_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="16"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="testimonials_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="17"><?=$config2["testimonials_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="testimonials_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="18"><?=$config2["testimonials_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Wedding Packages -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packages/weddings" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Wedding Packages Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="wedding_package_seo_title" value="<?=$config2["wedding_package_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="19"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="wedding_package_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="20"><?=$config2["wedding_package_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="wedding_package_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="21"><?=$config2["wedding_package_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Individual Wedding Packages -->
<?
$query = "SELECT * FROM packages WHERE package_type = 'Wedding' ORDER BY position ASC;";
$rs_weddings = mysql_query($query, $linkID2);
$tab = 22;
for ($Counter=0; $Counter < mysql_num_rows($rs_weddings); $Counter++){
	$wedding = mysql_fetch_assoc($rs_weddings);
?>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packagedetails/wedding/<?=htmlspecialchars($wedding["package_name"]);?>" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF"><?=$wedding["package_name"];?> Wedding Package Details Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="<?=$wedding["package_number"];?>_seo_title" value="<?=$wedding["seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="<?=$wedding["package_number"];?>_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$wedding["seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="<?=$wedding["package_number"];?>_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$wedding["seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<?
}
?>
<!-- Renewal Packages -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packages/renewals" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Renewal Packages Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="renewal_package_seo_title" value="<?=$config2["renewal_package_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="37"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="renewal_package_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="38"><?=$config2["renewal_package_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="renewal_package_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="39"><?=$config2["renewal_package_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Individual Renewal Packages -->
<?
$query = "SELECT * FROM packages WHERE package_type = 'Renewal' ORDER BY position ASC;";
$rs_renewals = mysql_query($query, $linkID2);
$tab = 40;
for ($Counter=0; $Counter < mysql_num_rows($rs_renewals); $Counter++){
	$renewal = mysql_fetch_assoc($rs_renewals);
?>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packagedetails/renewal/<?=htmlspecialchars($renewal["package_name"]);?>" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF"><?=$renewal["package_name"];?> Renewal Package Details Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="<?=$renewal["package_number"];?>_seo_title" value="<?=$renewal["seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="<?=$renewal["package_number"];?>_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$renewal["seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="<?=$renewal["package_number"];?>_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$renewal["seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<?
}
?>
<!-- Featured Packages -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packages/featured" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Featured Packages Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="featured_package_seo_title" value="<?=$config2["featured_package_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="55"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="featured_package_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="56"><?=$config2["featured_package_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="featured_package_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="57"><?=$config2["featured_package_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Individual Featured Packages -->
<?
$query = "SELECT * FROM packages WHERE package_type = 'Featured' ORDER BY position ASC;";
$rs_features = mysql_query($query, $linkID2);
$tab = 58;
for ($Counter=0; $Counter < mysql_num_rows($rs_features); $Counter++){
	$featured = mysql_fetch_assoc($rs_features);
?>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/packagedetails/featured/<?=htmlspecialchars($featured["package_name"]);?>" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF"><?=$featured["package_name"];?> Featured Package Details Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="<?=$featured["package_number"];?>_seo_title" value="<?=$featured["seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="<?=$featured["package_number"];?>_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$featured["seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="<?=$featured["package_number"];?>_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="<?=$tab++;?>"><?=$featured["seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<?
}
?>
<!-- Flowers Gallery -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/services/flowers" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Flowers Gallery Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="gallery_flowers_seo_title" value="<?=$config2["gallery_flowers_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="64"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="gallery_flowers_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="65"><?=$config2["gallery_flowers_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="gallery_flowers_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="66"><?=$config2["gallery_flowers_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Photography -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/services/photography" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Photography Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="photography_seo_title" value="<?=$config2["photography_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="67"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="photography_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="68"><?=$config2["photography_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="photography_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="69"><?=$config2["photography_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Limousine -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="https://secure.nr.net/littlechurchlv/index/services/limousine" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Limousine Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="limousine_seo_title" value="<?=$config2["limousine_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="70"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="limousine_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="71"><?=$config2["limousine_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="limousine_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="72"><?=$config2["limousine_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Additional Services -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/services/additional" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Additional Services Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="additional_services_seo_title" value="<?=$config2["additional_services_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="73"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="additional_services_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="74"><?=$config2["additional_services_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="additional_services_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="75"><?=$config2["additional_services_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Webcam -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/guests/webcam" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Webcam Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="webcam_seo_title" value="<?=$config2["webcam_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="76"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="webcam_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="77"><?=$config2["webcam_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="webcam_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="78"><?=$config2["webcam_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- FAQ -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/questions" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Questions (FAQ) Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="questions_seo_title" value="<?=$config2["questions_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="79"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="questions_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="80"><?=$config2["questions_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="questions_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="81"><?=$config2["questions_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Reservations -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="https://secure.nr.net/littlechurchlv/index/reservations" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Reservations Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="reservations_seo_title" value="<?=$config2["reservations_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="82"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="reservations_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="83"><?=$config2["reservations_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="reservations_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="84"><?=$config2["reservations_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Message -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/contact/message" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Message Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="message_seo_title" value="<?=$config2["message_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="85"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="message_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="86"><?=$config2["message_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="message_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="87"><?=$config2["message_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Feedback -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/contact/feedback" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Feedback Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="feedback_seo_title" value="<?=$config2["feedback_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="88"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="feedback_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="89"><?=$config2["feedback_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="feedback_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="90"><?=$config2["feedback_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Privacy -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/privacy" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Privacy Policy Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="privacy_seo_title" value="<?=$config2["privacy_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="91"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="privacy_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="92"><?=$config2["privacy_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="privacy_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="93"><?=$config2["privacy_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Terms of Use -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/terms" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Terms of Use Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="terms_seo_title" value="<?=$config2["terms_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="94"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="terms_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="95"><?=$config2["terms_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="terms_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="96"><?=$config2["terms_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
<!-- Site Map -->
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="5">
		<tr>
			<td colspan="2" bgcolor="#000000"><a href="http://www.littlechurchlv.com/index/sitemap" title="Click to View Page" target="blank" style="text-decoration:none;"><font size="+1" color="#FFFFFF">Site Map Page</font></a></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td>Page Title:</td>
			<td><input type="text" name="sitemap_seo_title" value="<?=$config2["sitemap_seo_title"];?>" maxlength="255" style="font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000; text-decoration:none; width:750;" tabindex="97"></td>
		</tr>
		<tr bgcolor="#F8F8F8">
			<td valign="top">Description:</td>
			<td><textarea cols="75" rows="2" name="sitemap_seo_description" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="98"><?=$config2["sitemap_seo_description"];?></textarea></td>
		</tr>
		<tr bgcolor="#E8E8E8">
			<td valign="top">Keywords:</td>
			<td><textarea cols="75" rows="2" name="sitemap_seo_keywords" style="font-family:Arial,Helvetica,sans-serif; font-size:12px;	color:#000000; text-decoration:none; width:750;" tabindex="99"><?=$config2["sitemap_seo_keywords"];?></textarea></td>
		</tr>
		</table>
	</td>
</tr>
</table>
<input type="hidden" name="task" value="submit">
<br>
<div align="center"><input type="submit" name="submit" value="Submit" tabindex="100"></div>
<br>
</form>
