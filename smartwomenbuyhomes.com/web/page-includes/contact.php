<?php
$result = mysql_query("SELECT * FROM contact ORDER BY id DESC LIMIT 1") or die(mysql_error());

	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$pageID = stripslashes($row['page_id']);
		$title = stripslashes($row['title']);
		$pageTitle = stripslashes($row['page_title']);
		$pageSubtitle = stripslashes($row['page_subtitle']);
		$pageContent = stripslashes($row['page_content']);
	}
?>
<?php
        	print("<br><br><h2>"); echo $pageTitle; print("</h2>");
            
             echo $pageSubtitle; 
            
             echo $pageContent; 
?>
