<?php
require_once ('includes/connect.php');
$id = $_REQUEST['page'];
?>
<?php

$result = mysql_query("SELECT id, page_header, page_content, page_java, page_title FROM pages WHERE page_title='$id'") or die(mysql_error());

	while($row = mysql_fetch_array($result)) {
		$id = $row['id'];
		$Header = $row['page_header'];
		$Content = $row['page_content'];
		$pageJava = $row['page_java'];
		$pageTitle1 = $row['page_title'];
	}

?>
<?php eval($Header); ?>
<?php require ('includes/header.php'); ?>

<div id="wrapper">    
    <div id="content-area">
<?php 
//+---------------------------------------------+
//|			 Begin Page Content				    |
//+---------------------------------------------+
?>			
			<?php echo $pageJava; ?>
        	<?php eval($Content); ?>
     
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-->
    
    <?php include ('includes/sidebar.php'); ?>
</div><!--wrapper-->    
	<?php require ('includes/footer.php'); ?>
	
    </body>
</html>