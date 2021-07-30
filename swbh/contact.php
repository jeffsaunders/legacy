<?php
require_once ('includes/connect.php');
?>
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
            
            <?php echo $pageContent; ?>
            
            	
        
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-->
    
    <?php include ('includes/sidebar.php'); ?>
</div><!--wrapper-->    
	<?php require ('includes/footer.php'); ?>