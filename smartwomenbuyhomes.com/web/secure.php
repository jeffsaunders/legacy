<?php
// Show me the errors
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

// Force HTTPS
//if ((empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "on") && $_SERVER['SERVER_PORT'] != 443){
//if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == ""){
//if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
//}else{
//if (!isset($_SERVER['HTTPS'])) echo "on";die();
//if ($_SERVER["SERVER_PORT"] != "443"){
//	$url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
//	header("Location: $url");
//	exit;
//}
//die($_ENV['SCRIPT_URI']);
//if(preg_match('/^https/i',$_ENV['SCRIPT_URI']) == 0) {
//    header('Location: ' . preg_replace('/^http/i','https', $_ENV['SCRIPT_URI']));
//} 

// f'ing NetSol server doesn't report https one way or the other!!
// I don't know how they do it, but they close the lock in the browser but all other indications are that it's still http when you ask!!!!

//UPDATE: I wish I had found this 2 hours ago! http://stackoverflow.com/questions/4686668/https-redirect-for-network-solutions

//A-HA!  NetSol acknowledges it and says it has to be done client-side.
//They use a proxy so the SSL connection is between the browser and the proxy, NOT the web server, so PHP always sees it as HTTP...AAAAAAAA!!!!
?>

<script language="javascript">
//	if (document.location.protocol != "https:"){
//		document.location.href = "https://" + document.location.hostname + document.location.pathname + window.location.search;
//	};
</script>

<?php
require_once ('includes/connect.php');

// Read in the config settings and stuff them into session vars
$query = "
	SELECT *
	FROM config
	LIMIT 1
";
$rs_config = mysql_query($query, $dbhandle);
$config = mysql_fetch_assoc($rs_config);
// Save each value to a session variable (i.e. $_SESSION['membership_price'] = '965.00')
// I don't think I need to do this anymore - leaving JIC
//for ($field = 0; $field < sizeof($config); $field++){
//	$_SESSION[mysql_field_name($rs_config, $field)] = $config[mysql_field_name($rs_config, $field)];
//}

$page = $_REQUEST["page"];

// Branch content based on passed "page" value
switch($page){
//	case "": header("Location: /");break;
	case "realtor-marketing-kit": $title = "Realtor Marketing Kit";break;
	case "realtor-checkout": $title = "Checkout";break;
	case "realtor-confirmation": $title = "Confirmation";break;
//	case "download-marketing-kit": header("Location: page-includes/download-marketing-kit.php?".$_SERVER['QUERY_STRING']);break;
	case "download-marketing-kit":
		echo '
			<script>
				document.location.href = "http://" + document.location.hostname + "/page-includes/download-marketing-kit.php" + window.location.search;
//alert(document.location.href);
			</script>
		';
		break;
//	default: header("Location: /");break;
} // End Switch
//<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
//<html xmlns="https://www.w3.org/1999/xhtml">

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Smart Women Buy Homes&nbsp;|&nbsp;<?php echo $title; ?></title>

	<link href="css/swbh-main.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="theme/default/css/default.css" id="theme" />

	<!-- Common scripts -->
	<script src="/js/functions.js" type="text/javascript"></script>
</head>

<body id="sub" class="<?php echo $pageID; ?>">

<div id="page-wrap">
	
    <div id="header">
    	<a href="index.php"><img src="images/logo.jpg" alt="Smart Women Buy Homes" width="372" height="127" border="0" /></a>
    	<h1><a href="index.php">Smart Women Buy Homes</a></h1>
    </div><!--header-->
    
    <?php include ('includes/navigation2.php'); ?>
    
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
//			case "": header("Location: /");break;
			case "realtor-marketing-kit": include("page-includes/realtor-marketing-kit.php");break;
			case "realtor-checkout": include("page-includes/realtor-checkout.php");break;
			case "realtor-confirmation": include("page-includes/realtor-confirmation.php");break;
//			default: header("Location: /");break;
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