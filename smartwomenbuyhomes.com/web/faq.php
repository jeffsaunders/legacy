<?php
require_once ('includes/connect.php');
?>
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

<?php require ('includes/header.php'); ?>
    
<div id="wrapper">    
    <div id="content-area">
<?php 
//+---------------------------------------------+
//|			 Begin Page Content				    |
//+---------------------------------------------+
?>	
        	<h2><?php echo $pageTitle; ?></h2>
            <?php echo $pageSubtitle; ?>
            
            <!--START EVENT LINKS-->
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
				<div class="faq-wrap">
                	
                    
                    <?php 
			
					$result2 = mysql_query("SELECT q_id, faq_question, faq_answer FROM faq_entry ORDER BY q_id") or die(mysql_error());
					
					while($row = mysql_fetch_array($result2)) {
						$qID = $row['q_id'];
						$faqQuestion = stripslashes($row['faq_question']);
						$faqAnswer = stripslashes($row['faq_answer']);
					
					?>     
                    
					<div class="faq-sec">
                    	
						<div class="faq-question">
							<h4><a href="javascript:InsertContent('faq-<?php echo $qID; ?>');"><strong>Q.</strong> <?php echo $faqQuestion; ?></h4></a>
						</div><!--faq-question-->
                        
                        
						<div id="faq-<?php echo $qID; ?>" class="faq-answer" style="display:none;">
							<p><strong>A.</strong> <?php echo $faqAnswer; ?>
                             
							<div class="clear"></div><!--clear-->
						</div><!--faq-answer-->
                        
					</div><!--faq-sec-->
					
					<?php } ?>
                 
				</div><!--faq-wrap-->
           
            
            	
        
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-->
    
    <?php include ('includes/sidebar.php'); ?>
</div><!--wrapper-->    
	<?php require ('includes/footer.php'); ?>