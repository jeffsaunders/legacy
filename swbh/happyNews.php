<?php
require_once ('includes/connect.php');
?>
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

<?php require ('includes/header.php'); ?>
    
<div id="wrapper">    
    <div id="content-area">
<?php 
//+---------------------------------------------+
//|			 Begin Page Content				    |
//+---------------------------------------------+
?>	

        	<h2><?php echo $pageTitle; ?></h2>
            
            
          
            <ol>
            	  <?php 
			
			$result2 = mysql_query("SELECT id, test_content, test_author, test_email FROM happy_news_testimonial ORDER BY id") or die(mysql_erroor());
			
			while($row = mysql_fetch_array($result2)) {
				$id = $row['id'];
				$testAuthor = stripslashes($row['test_author']);
				$testEmail = stripslashes($row['test_email']);
				$testContent = stripslashes($row['test_content']);
				
				print ("<li>". $testContent ."</li>");
			}
			
			
			?>
            </ol>
            
            
        
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-->
   
    <?php include ('includes/sidebar.php'); ?>
</div><!--wrapper-->     
	<?php require ('includes/footer.php'); ?>