<?php
require_once ('includes/connect.php');

$page = $_REQUEST["page"];
$showSidebar = true;

// Branch content based on passed "page" value
switch($page){
	case "": header("Location:http://smartwomenbuyhomes.com"); break;
	case "about": $title = "About"; break;
	case "happy-news":$title = "Happy News"; break;
	case "realtor": $title = "Realtors"; break;
	case "faq": $title = "FAQ"; break;
	case "contact": $title = "Contact"; break;
	case "form": $title = "Form"; break;
	case "realtor-signup": $title = "Realtor Signup"; break;
	case "realtor-marketing-kit": $title = "Realtor Advisor Program"; $showSidebar = false; break;
	default: header("Location:http://smartwomenbuyhomes.com"); break;
} // End Switch
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Smart Women Buy Homes&nbsp;|&nbsp;<?php echo $title; ?></title>

	<!-- Stylesheets -->
	<link href="css/swbh-main.css" rel="stylesheet" type="text/css" />
	<link href="theme/default/css/default.css" rel="stylesheet" type="text/css" />

	<!-- Common scripts -->
	<script src="/js/functions.js" type="text/javascript"></script>
</head>

<body id="sub" class="<?php echo $pageID; ?>">

<div id="page-wrap">
	<div id="header">
		<a href="/"><img src="images/logo.jpg" alt="Smart Women Buy Homes" width="372" height="127" border="0" /></a>
		<h1><a href="/">Smart Women Buy Homes</a></h1>
	</div><!--header-->
	<?php include ('includes/navigation.php'); ?>
	<div class="clear"></div><!--clear-->
	<div id="wrapper">
		<div id="content-area<?php echo (!$showSidebar ? '-ns' : ''); ?>">
			<?php 
			//+---------------------------------------------+
			//|			 Begin Page Content				    |
			//+---------------------------------------------+
			?>			
			<?php
			// Branch content based on passed "page" value
			switch($page){
// Switch above covers the blank and default values - JS
//				case "": header("Location:http://smartwomenbuyhomes.com/index.php");break;
				case "about": include("page-includes/about.php"); break;
				case "happy-news": include("page-includes/happy-news.php"); break;
				case "realtor": include("page-includes/realtors.php"); break;
				case "faq": include("page-includes/faq.php"); break;
				case "contact": include("page-includes/contact.php"); break;
				case "form": include("page-includes/form.php"); break;
				case "realtor-signup": include("page-includes/realtor-signup.php"); break;
//				case "realtor-marketing-kit": header("Location:http://smartwomenbuyhomes.com/secure.php?page=realtor-marketing-kit");break;
				case "realtor-marketing-kit": include("page-includes/realtor-marketing-kit.php"); break;
//				default: header("Location:http://smartwomenbuyhomes.com/index.php");break;
			} // End Switch
			?>

			<?php 
			//+---------------------------------------------+
			//|			   End Page Content				 	|
			//+---------------------------------------------+
			?>
		</div><!--content-area-->
		<?php if ($showSidebar) include ('includes/sidebar.php'); ?>
	</div><!--wrapper-->
</div><!--page-wrap-->
<div class="clear"></div><!--clear-->
<?php require ('includes/footer.php'); ?>	
	   
</body>
</html>