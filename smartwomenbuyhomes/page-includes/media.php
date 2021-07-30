<?php
// Get listings
$query = "
	SELECT *
	FROM media
	WHERE display = 1
	ORDER BY published, title
";
//echo $query;
$rs_media = mysql_query($query, $dbhandle);
?>
<br><br>
<h2>Smart Women In Media</h2>
<?php
for ($counter=1; $counter <= mysql_num_rows($rs_media); $counter++){
	$media = mysql_fetch_assoc($rs_media);
	switch($media['type']){
		case "Print": $icon = "document_icon.png"; break;
		case "Audio": $icon = "music_icon.png"; break;
		case "Video": $icon = "video_icon.png"; break;
	}
?>
<div class="media" onMouseOver="document.getElementById('mediaA<?php echo $counter; ?>').style.color = '#FFFFFF'; document.getElementById('mediaB<?php echo $counter; ?>').style.color = '#FFFFFF';" onMouseOut="document.getElementById('mediaA<?php echo $counter; ?>').style.color = '#666666'; document.getElementById('mediaB<?php echo $counter; ?>').style.color = '#666666';">
<!--	<a href="<?php echo $media['link']; ?>" target="_blank" style="text-decoration:none;">
		<div style="width:50px; text-align:center;">
			<?php echo $media['type']; ?><br>
			<?php echo ($media['duration'] == "" ? "" : "<br><h5><font size='-2'>Duration</font><br>".$media['duration']."</h5>"); ?>
		</div>
		<div style="position:absolute; top:0px;">
			<h4><?php echo $media['title']; ?></h4>
			<h5><?php echo $media['publication']; ?> <?php echo $media['published']; ?></h5>
			<?php echo ($media['note'] == "" ? "" : "<h5 style='font-weight:normal;'><em>".$media['note']."</em></h5>"); ?>
		</div>
	</a>
-->
	<a href="<?php echo $media['link']; ?>" target="_blank" style="text-decoration:none;">
	<table style="font-family:Verdana, Geneva, sans-serif; color:#666666; font-weight:bold;">
	<tr>
		<td width="90" align="center" valign="top" id="mediaA<?php echo $counter; ?>">
			<img src="/images/<?php echo $icon; ?>" alt="<?php echo $media['type']; ?>" width="64" height="64"><br>
			<?php echo ($media['duration'] == "" ? "<font size='-2'>Text</font>" : "<font size='-2'>Length ".$media['duration']."</font>"); ?>
		</td>
		<td valign="top" id="mediaB<?php echo $counter; ?>" style="font-size:18px;">
			<?php echo $media['title']; ?><br>
			<span style="font-size:14px;"><?php echo $media['publication']; ?> &mdash; <?php echo date('F, Y', strtotime($media['published'])); ?></span>
			<?php echo ($media['note'] == "" ? "" : "<br><span style='font-size:12px; font-weight:normal;'>".$media['note']."</span>"); ?>
		</td>
	</tr>
	</table>
	</a>
</div>
<br>
<?php
}
?>
