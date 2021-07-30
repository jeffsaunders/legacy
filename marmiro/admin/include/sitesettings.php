<!-- BEGIN Include sitesettings.php -->

		<?
		$query = "SELECT *
					FROM config";
//echo $query."<br><br>";
		$rs_config = mysql_query($query, $linkID);
		$config = mysql_fetch_assoc($rs_config);
		?>

		<script>
			// Validate the form
			function validateEdit(theForm){
				if (theForm.title){
					if (theForm.title.value == ""){
						theForm.title.style.background="#FF0000";
						alert("Please Enter The Website Title");
						theForm.title.style.background="#FFFFFF";
						theForm.title.focus();
						return false;
					}
				}
				if (theForm.facebook){
					if (theForm.facebook.value == ""){
						theForm.facebook.style.background="#FF0000";
						alert("Please Enter The Facebook Address");
						theForm.facebook.style.background="#FFFFFF";
						theForm.facebook.focus();
						return false;
					}
				}
				if (theForm.twitter){
					if (theForm.twitter.value == ""){
						theForm.twitter.style.background="#FF0000";
						alert("Please Enter The Twitter Address");
						theForm.twitter.style.background="#FFFFFF";
						theForm.twitter.focus();
						return false;
					}
				}
				if (theForm.youtube){
					if (theForm.youtube.value == ""){
						theForm.youtube.style.background="#FF0000";
						alert("Please Enter The YouTube Address");
						theForm.youtube.style.background="#FFFFFF";
						theForm.youtube.focus();
						return false;
					}
				}
				if (theForm.request_thankyou){
					if (theForm.request_thankyou.value == ""){
						theForm.request_thankyou.style.background="#FF0000";
						alert("Please Enter The Request 'Thank You' Message");
						theForm.request_thankyou.style.background="#FFFFFF";
						theForm.request_thankyou.focus();
						return false;
					}
				}
				if (theForm.contact_thankyou){
					if (theForm.contact_thankyou.value == ""){
						theForm.contact_thankyou.style.background="#FF0000";
						alert("Please Enter The Contact 'Thank You' Message");
						theForm.contact_thankyou.style.background="#FFFFFF";
						theForm.contact_thankyou.focus();
						return false;
					}
				}
				if (theForm.slideshow_sort){
					var choiceSelected = false;
					for (i = 0;  i <= theForm.slideshow_sort.length;  i++){
						if (theForm.slideshow_sort[i].checked){
							choiceSelected = true;
						}
					}
					if (!choiceSelected){
						alert("Please select the slideshow image display format.");
						return false;
					}
				}
				return true;
			}
		</script>

		<br>
		<form action="action.php" method="post" name="editConfig" id="editConfig" onSubmit="return validateEdit(this);">
		<table border="0" cellspacing="1" cellpadding="2" align="center">
		<tr>
			<td colspan="2" align="center" class="bigBlack"><strong>Edit Site Settings</strong><br><br></td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="15" colspan="2" class="tinyRoundedTops"></td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Website Title:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="title" id="title" size="50" maxlength="255" value="<?=$config["title"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the title that shows up at the top of the browser or in the browser tab.  It's also the title that shows up as the link to the site in search engines." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Website Description:</strong></td>
			<td valign="top" bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="description" id="description" class="bodyBlack" style="width:500px;"><?=$config["description"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the website description that is used by search engines for rankings and as the text to display after the title on search results." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Website Keywords:</strong></td>
			<td valign="top" bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="keywords" id="keywords" class="bodyBlack" style="width:500px;"><?=$config["keywords"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the list of keywords that are used by search engines for rankings." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Facebook Address:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="facebook" id="facebook" size="50" maxlength="255" value="<?=$config["facebook"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the address (URL) to the Facebook page.  Used for the link in the website footer." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Twitter Address:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="twitter" id="twitter" size="50" maxlength="255" value="<?=$config["twitter"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the address (URL) to the Twitter page.  Used for the link in the website footer." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>YouTube Address:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="text" name="youtube" id="youtube" size="50" maxlength="255" value="<?=$config["youtube"];?>" style="width:500px;">
				<img src="../images/QuestionMark.gif" alt="?" title="REQUIRED. This is the address (URL) to the YouTube page.  Used for the link in the website footer." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Request "Thank You":</strong></td>
			<td valign="top" bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="request_thankyou" id="request_thankyou" class="bodyBlack" style="width:500px;"><?=$config["request_thankyou"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the 'Thank You' message that is shown after a request for information is submitted (Marketing Trends request, etc.)." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td valign="top" bgcolor="#E0E0E0"><strong>Contact "Thank You":</strong></td>
			<td valign="top" bgcolor="#F0F0F0">
				<textarea cols="80" rows="3" name="contact_thankyou" id="contact_thankyou" class="bodyBlack" style="width:500px;"><?=$config["contact_thankyou"];?></textarea>
				<img src="../images/QuestionMark.gif" alt="?" title="This is the 'Thank You' message that is shown after the contact form is submitted." border="0" style="cursor:help;">
			</td>
		</tr>
		<tr>
			<td bgcolor="#E0E0E0"><strong>Slideshow Display:</strong></td>
			<td bgcolor="#F0F0F0">
				<input type="radio" id="slideshow_sort" name="slideshow_sort" value="position"<?=iif($config["slideshow_sort"] == "position", " checked", "");?>><strong>Position</strong>&nbsp;&nbsp;
				<input type="radio" id="slideshow_sort" name="slideshow_sort" value="random"<?=iif($config["slideshow_sort"] == "random", " checked", "");?>><strong>Random</strong>&nbsp;&nbsp;
				<img src="../images/QuestionMark.gif" alt="?" title="Indicate whether the slideshows should be displayed in the order specified or if the images should be chosen at random." border="0" style="cursor:help;">
			</td>
		</tr>
 		<tr bgcolor="#000000">
			<td height="1" colspan="2"></td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<br>
				<input type="submit" name="submit" id="submit" value="Save Changes">
				<br><br>
			</td>
		</tr>
		</table>
		<input type="hidden" name="task" id="task" value="editConfig">
		</form>

<!-- END Include sitesettings.php -->
