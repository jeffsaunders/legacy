<?php
require_once ('includes/connect.php');

$page = $_REQUEST["page"];

// Branch content based on passed "page" value
switch($page){
	case "": header("Location:http://smartwomenbuyhomes.com/index.php");break;
	case "realtor-marketing-kit": $title = "Realtor Marketing Kit";break;
	case "realtor-checkout": $title = "Checkout";break;
	case "realtor-confirmation": $title = "Confirmation";break;
	default: header("Location:http://smartwomenbuyhomes.com/index.php");break;
} // End Switch

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Smart Women Buy Homes&nbsp;|&nbsp;<?php echo $title; ?></title>

<link href="css/swbh-main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="theme/default/css/default.css" id="theme" />

</head>

<body id="sub" class="<?php echo $pageID; ?>">

<div id="page-wrap">
	
    <div id="header">
    	<a href="index.php"><img src="images/logo.jpg" alt="Smart Women Buy Homes" width="372" height="127" border="0" /></a>
    	<h1><a href="index.php">Smart Women Buy Homes</a></h1>
    </div><!--header-->
    
    <?php include ('includes/navigation.php'); ?>
    
    <div class="clear"></div><!--clear-->
    

	<div id="wrapper">    
   	 <div id="content-area-ns">
<?php 
//+---------------------------------------------+
//|			 Begin Page Content				    |
//+---------------------------------------------+
?>			
			    <?php
	// Branch content based on passed "page" value
		switch($page){
			case "": header("Location:http://smartwomenbuyhomes.com/index.php");break;
			case "realtor-marketing-kit": include("page-includes/realtor-marketing-kit.php");break;
			case "realtor-checkout": include("page-includes/realtor-checkout.php");break;
			case "realtor-confirmation": include("page-includes/realtor-confirmation.php");break;
			default: header("Location:http://smartwomenbuyhomes.com/index.php");break;
		} // End Switch
	?>
     
<?php 
//+---------------------------------------------+
//|			   End Page Content				 	|
//+---------------------------------------------+
?>
    </div><!--content-area-ns-->
   <div class="clear"></div><!--clear-->
 </div><!--wrapper-->

</div><!--page-wrap-->
<div class="clear"></div><!--clear-->
 <?php require ('includes/footer.php'); ?>	
	   
    </body>
</html>