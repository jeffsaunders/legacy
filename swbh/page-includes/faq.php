<?php
$result = mysql_query("SELECT * FROM faq ORDER BY id DESC LIMIT 1") or die(mysql_error());

	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$pageID = stripslashes($row['page_id']);
		$title = stripslashes($row['title']);
		$pageTitle = stripslashes($row['page_title']);
		$pageSubtitle = stripslashes($row['page_subtitle']);
	}
?>
<?php
print("<h2>"); echo $pageTitle; print("</h2>");
             echo $pageSubtitle; 

print("<div class=\"faq-wrap\">");
					
					$result2 = mysql_query("SELECT q_id, faq_question, faq_answer FROM faq_entry ORDER BY q_id") or die(mysql_error());
					
					while($row = mysql_fetch_array($result2)) {
						$qID = $row['q_id'];
						$faqQuestion = stripslashes($row['faq_question']);
						$faqAnswer = stripslashes($row['faq_answer']);
					
					   
                    	print ("
						<div class=\"faq-sec\">
                    	
						<div class=\"faq-question\">
							<h4><a href=\"javascript:InsertContent('faq-".$qID."');\"><strong>Q.</strong>&nbsp;".$faqQuestion."</h4></a>
						</div><!--faq-question-->
                        
                        
						<div id=\"faq-".$qID."\" class=\"faq-answer\" style=\"display:none;\">
							<p><strong>A.</strong>&nbsp;".$faqAnswer."
                             
							<div class=\"clear\"></div><!--clear-->
						</div><!--faq-answer-->
                        
						</div><!--faq-sec-->");
					}
					
					print("</div><!--faq-wrap-->");
?>

<script type="text/javascript" language="JavaScript">
					function InsertContent(tid) {
						if(document.getElementById(tid).style.display == "none") {
							document.getElementById(tid).style.display = "";
						}
						else {
							document.getElementById(tid).style.display = "none";	
						}
					}
				</script>