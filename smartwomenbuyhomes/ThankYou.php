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
			<div style="font-family: verdana; "> <span style="font-size: 20px; ">
					Thank you for your interest <BR/>in Smart Women Buy Homes.<BR/>
					<br/></span><span style="font-size: 14px; ">
					I or one of my associates will contact you very soon.<BR/>
					<br/>
					We look forward to working with you in serving single women home buyers.<BR/>
					<br/>
					<img src="/images/Jeanie-a.png" width=145 height=168 border=0 align="left"><BR>
					<I>Jeanie Douthitt</I><br/>
					</div>
     
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-->
    
    <?php include ('includes/sidebar.php'); ?>
</div><!--wrapper-->    
	<?php require ('includes/footer.php'); ?>