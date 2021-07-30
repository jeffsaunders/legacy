<?php
require_once ('includes/connect.php');
$id = $_REQUEST['page'];
?>
<?php
$pageID = "Home";
$title = "Home";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Smart Women Buy Homes&nbsp;|&nbsp;<?php echo $title; ?></title>

<link href="css/swbh-main.css" rel="stylesheet" type="text/css" />

</head>

<body id="homepage" class="<?php echo $pageID; ?>">

<div id="page-wrap-home">
	
    <div id="home-header">
    	<h1><a href="index.php"><img src="images/header_logo.jpg" alt="Smart Women Buy Homes" width="960" height="133" /></a></h1>
    </div><!--header-->
    
    <?php include("includes/navigation.php"); ?>
    
    <div class="clear"></div><!--clear-->
    
    <div id="banner-area">
    	<img src="images/main_banner.jpg" src="Smart Women Buy Homes" width="960" height="211" border="0" />
    </div><!--banenr-area-->
    
    <div id="lower-banner">
    	<div class="lower-banner-left">
        	<a href="/happy-news"><img src="images/happy_women.jpg" alt="Why women are so happy about Smart Women Buy Homes" border="0" width="434" height="118" /></a>
        </div><!--lower-banner-left-->
        
        <div class="lower-banner-right">
        	<img src="images/main_banner2.jpg" alt="Why women are so happy about Smart Women Buy Homes" border="0" width="526" height="118" />
        </div><!--lower-banner-right-->
    </div><!--lower-banner-->
    
    <div id="info-area">
    	<img src="images/info_bar.jpg" alt="" width="960" height="198" usemap="#Map" border="0" />
        <map name="Map" id="Map">
          <area shape="rect" coords="2,3,267,192" href="/about" alt="About Us" />
          <area shape="rect" coords="341,2,579,191" href="/contact" alt="Contact Us" />
          <area shape="rect" coords="675,4,955,195" href="about#jeanie" alt="About Jeanie" />
        </map>
    </div><!--info-area-->
    
    <div id="swbh-info">
    	<div class="swbh-info-left">
        	<p>Smart Women Buy Homes.<br /><br />If you have always dreamed of being a homeowner but didn’t think you could, we are here to show you how and to help walk you through the process, from start to finish, to make your dream a reality.</p>
            <p>If you are a single women and are interested in learning more about how you can become a homeowner or more about any other home-purchase related topic, please contact us, and we will help you find the answers you are looking for and help get you started on becoming a new homeowner!</p>
        </div><!--swbh-info-left-->
        
        <div class="swbh-info-right">
        	<img src="images/info-pic.jpg" alt="" width="354" height="165" border="0" />
        </div><!--swbh-info-right-->
    </div><!--swbh-info-->	

   </div><!--page-wrap-->
	<div class="clear"></div><!--clear-->
	<?php require ('includes/footer.php'); ?>
	
    </body>
</html>