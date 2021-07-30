<?
// Define default settings
setlocale(LC_MONETARY, 'en_US');
$pageWidth = 960;
$menuOffset = 30;

// Start the session
session_start(); 

// Grab the database
include("dbconnect.php");

// Grab my PHP functions library
include("functions.php");

// Assign passed (via path/redirect) values
$sec = $_REQUEST['sec'];

// Get count of current listings
$query = "SELECT COUNT(*) FROM listings WHERE live = '1'";
$rs_count = mysql_query($query, $linkID);
$count = mysql_fetch_assoc($rs_count);
$totalListings = $count["COUNT(*)"];
?>
<!DOCTYPE html><!--HTML5-->

<html>
<head>
	<title>WMUHomes.com - Kalamazoo Student Rental Housing - <?=number_format(round($totalListings,-1));?>+ Homes Listed w/Photos</title>
	
	<!-- Meta Tags -->
	<meta name="description" CONTENT="wmuhomes.com lists Kalamazoo student rentals, allowing students and landlords connect. We have over <?=number_format(round($totalListings,-1));?>-homes with interior/exterior photos. WMU, K-College and KVCC students, find your rental home here.">
	<meta name="Keywords" CONTENT="kalamazoo student rentals, kalamazoo student rental, wmu, kcollege, k-college, housing, homes, house, rent, vine neighborhood, south st., south street, university, western michigan, kalamazoo, michigan, student living, student rentals, kalamazoo rent, college">
	<meta content=ALL name=robots>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<!-- Define Home Base -->
	<base href="/">

	<?
	// Only load if using Lightview - conflicts with other libraries
	if ($sec == "details"){
	?>
	<!-- Lightview Scripts -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/prototype/1.6.1/prototype.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/scriptaculous/1.8.2/scriptaculous.js"></script>
	<script type="text/javascript" src="lightview.js"></script>
	<?
	}
	?>
	
	<!-- Common Scripts -->
	<script src="common.js" type="text/javascript"></script>

	<!-- IE Only Scripts -->
	<!--[if lt IE 9]>
	<script src="curvycorners.src.js" type="text/javascript"></script>
	<script type="text/JavaScript">
		// Round all four corners
		addEvent(window, 'load', initCorners);
		function initCorners() {
			var settings = {
				tl: { radius: 20 },
				tr: { radius: 20 },
				bl: { radius: 20 },
				br: { radius: 20 },
				antiAlias: true
			}
			curvyCorners(settings, ".roundedCorners");
		}
		// Round the bottom two corners
		addEvent(window, 'load', initBottomCorners);
		function initBottomCorners() {
			var settings2 = {
				tl: { radius: 0 },
				tr: { radius: 0 },
				bl: { radius: 20 },
				br: { radius: 20 },
				antiAlias: true
			}
			curvyCorners(settings2, ".roundedBottoms");
		}
	</script> 
	<![endif]-->

	<script>
		// Function to populate the hidden "details" form and submit it 
		function getDetails(id){
			document.forms['GetDetails'].ID.value = id;
			document.forms['GetDetails'].submit();
		}
	</script>

	<script>
		// Function to populate the hidden "results" form and submit it 
		function getResults(street,contact,bedrooms,rent,order){
			document.forms['GetResults'].Street.value = street;
			document.forms['GetResults'].Contact.value = contact;
			document.forms['GetResults'].Bedrooms.value = bedrooms;
			document.forms['GetResults'].Rent.value = rent;
			document.forms['GetResults'].Order.value = order;
			document.forms['GetResults'].submit();
		}
	</script>

	<!-- Load Style Sheets -->
	<link href="/common.css" rel="stylesheet" type="text/css">
	<![if (!IE)|(IE 9)]>
		<link href="/standard.css" rel="stylesheet" type="text/css">
	<![endif]>
	<!-- Change this to ie.css -->
	<!--[if lt IE 9]>
		<link href="/standard.css" rel="stylesheet" type="text/css">
		<div style="position:absolute; top:0; left:0; background-color:#FF0000; font-family:Myvetica,sans-serif; font-size:10px; color:#FFFFFF; z-index:9999999;">
			<strong>*Notice - You are using Internet Explorer below version 9, so things may not look as good as they should, YET.</strong>
		</div>
	<![endif]-->
	<?
	// Only load if using Lightview - conflicts with other libraries
	if ($sec == "details"){
	?>
	<link href="/lightview.css" rel="stylesheet" type="text/css">
	<?
	}
	?>

</head>

<body onResize="window.location.reload(true);window.location=window.location;">

<script>
	// Determine left side coordinate for centered page to build site container
	// Must be interrogated within <body> tags
	browserWidth = document.body.clientWidth;
	document.write('<style>.pageContainer {position:absolute; top:0px; left:'+((browserWidth/2)-(<?=$pageWidth;?>/2))+'px; width:<?=$pageWidth;?>;}</style>');
</script>

<div class="pageContainer" id="pageContainer">
	<!-- Menu along top -->
	<div id="Menu" style="position:relative; top:10px; left:0px; width:960px; height:40px; text-align:right; z-index:1;">
		<a href="search" title="Click to Search Listings" class="menuBlue">Search</a>&nbsp;&nbsp;
		<!-- Middle Dot between menu items -->
		<div id="MenuDot1" style="position:absolute; top:-18px; right:<?=268+$menuOffset?>px; width:10px; height:30px; text-align:center; z-index:2;">
			<span style="font-size:50px;"><strong>&middot;</strong></span>
		</div>
		&nbsp;&nbsp;<a href="admin" title="Click to Manage Listings" class="menuBlue">Add/Update a Listing</a>&nbsp;&nbsp;
		<!-- Middle Dot between menu items -->
		<div id="MenuDot2" style="position:absolute; top:-18px; right:<?=81+$menuOffset?>px; width:10px; height:30px; text-align:center; z-index:2;">
			<span style="font-size:50px;"><strong>&middot;</strong></span>
		</div>
		&nbsp;&nbsp;<a href="about" title="Click for Information About wmuhomes.com" class="menuBlue">About Us</a><img src="images/spacer.gif" alt="" width="<?=$menuOffset?>" height="1">
	</div>
<?
// Test here for $sec matching a contact's id (from admin) and switch to "results" page populated with that contact's listings, if found.

// Branch content based on "sec" value
switch($sec){
	case "": include("include/home.php");break;
	case "home": include("include/home.php");break;
	case "search": include("include/home.php");break;
	case "results": include("include/results.php");break;
	case "details": include("include/details.php");break;
	case "admin": include("include/admin.php");break;
	case "about": include("include/about.php");break;
	default: include("include/home.php");break;
} // End Switch
?>
</div>

<form action="details" method="post" name="GetDetails" id="GetDetails">
	<input type="hidden" name="ID" id="ID" value="">
</form>

<form action="results" method="post" name="GetResults" id="GetResults">
	<input type="hidden" name="Street" id="Street" value="">
	<input type="hidden" name="Contact" id="Contact" value="">
	<input type="hidden" name="Bedrooms" id="Bedrooms" value="">
	<input type="hidden" name="Rent" id="Rent" value="">
	<input type="hidden" name="Order" id="Order" value="">
	<input type="hidden" name="Page" id="Page" value="1">
</form>

</body>
</html>
