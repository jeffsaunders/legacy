<?php
$result = mysql_query("SELECT * FROM happy_news ORDER BY id DESC LIMIT 1") or die(mysql_error());

	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$pageID = stripslashes($row['page_id']);
		$title = stripslashes($row['title']);
		$pageTitle = stripslashes($row['page_title']);
		$pageSubtitle = stripslashes($row['page_subtitle']);
	}

?>
<?php
print("<br><br><h2>"); echo $pageTitle; print("</h2>");
print("<ol>");
			$result2 = mysql_query("SELECT id, test_content, test_author, test_email FROM happy_news_testimonial ORDER BY id") or die(mysql_erroor());
			
			while($row = mysql_fetch_array($result2)) {
				$id = $row['id'];
				$testAuthor = stripslashes($row['test_author']);
				$testEmail = stripslashes($row['test_email']);
				$testContent = stripslashes($row['test_content']);
				
				print ("<li>". $testContent ."</li>");
			}
print("</ol>");
?>