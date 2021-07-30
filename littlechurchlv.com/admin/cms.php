<?
// Grab what's passed
$sec = $_REQUEST['sec'];

// define default settings
$pageWidth = 960;

// Grab the database
include("../dbconnect.php");

// Load the config settings
$query = "SELECT * FROM config";
$rs_config = mysql_query($query, $linkID);
$config = mysql_fetch_assoc($rs_config);
$rs_config2 = mysql_query($query, $linkID2);
$config2 = mysql_fetch_assoc($rs_config2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>The Little Church of the West Website Admin System</title>

	<base href="http://www.littlechurchlv.com/admin/cms.php">

	<!-- Load Style Sheets -->
	<link href="/standard.css" media="screen" rel="stylesheet" type="text/css">
<!--	<link href="menu/helper.css" media="screen" rel="stylesheet" type="text/css">-->
	<link href="menu/dropdown.css" media="screen" rel="stylesheet" type="text/css">
	<link href="menu/default.css" media="screen" rel="stylesheet" type="text/css">

	<script>
		// Swap layer visibility
		function show(id) {
			document.getElementById(id).style.visibility = "visible";
			document.getElementById(id).style.display = "block";
		}
		function hide(id) {
			document.getElementById(id).style.visibility = "hidden";
			document.getElementById(id).style.display = "none";
		}
	</script>
</head>

<body bgcolor="#770025" leftmargin="0" topmargin="0" marginwidth="0" onResize="window.location.reload(true);window.location=window.location;" onLoad="void(0);">

<script language="JavaScript1.2">
	// Must be interrogated within <body> tags
	browserWidth = document.body.clientWidth;
	document.write('<style>.pageContainer {position:absolute; top:0; left:'+((browserWidth/2)-(<?=$pageWidth;?>/2))+'px; width:<?=$pageWidth;?>;}</style>');
</script>

<!-- Page Container -->
<div align="center" class="pageContainer" id="pageContainer">

<table width="<?=$pageWidth;?>" border="0" cellspacing="0" cellpadding="0" align="center">
<tr>
	<td style="background-color: transparent;">
		<table width="100%" border="0">
		<tr>
			<td width="100"><img src="/images/AdminLogo.png" alt="" width="100" height="75" border="0"></td>
			<td align="center" class="superWhite">
				<img src="/images/spacer.gif" alt="" width="1" height="15" border="0"><br>
				The Little Church of the West Website Administration System
			</td>
			<td width="100"><img src="/images/spacer.gif" alt="" width="100" height="75" border="0"></td>
		</tr>
		</table>
	</td>
</tr>
<tr>
	<td>
		<!-- Menu -->
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td width="150">
				<ul id="nav" class="dropdown dropdown-horizontal">
					<li class="top"><strong class="menuBlack">Reservations</strong>
						<ul>
							<li><a href="./" class="menuBlack">View</a></li>
							<li><a href="./" class="menuBlack">Add</a></li>
							<li><a href="./" class="menuBlack">Edit</a></li>
							<li><a href="./" class="menuBlack">Download</a></li>
						</ul>
					</li>
				</ul>
			</td>
			<td><img src="/images/spacer.gif" alt="" width="1" border="0"></td>
			<td width="150">
				<ul id="nav" class="dropdown dropdown-horizontal">
					<li class="top"><strong class="menuBlack">Webcam</strong>
						<ul>
							<li><a href="?sec=webcam" class="menuBlack">Manage Videos</a></li>
						</ul>
					</li>
				</ul>
			</td>
			<td><img src="/images/spacer.gif" alt="" width="1" border="0"></td>
			<td width="150">
				<ul id="nav" class="dropdown dropdown-horizontal">
					<li class="top"><strong class="menuBlack">Site Content</strong>
						<ul>
							<li><a href="?sec=homepage" class="menuBlack">Home Page</a></li>
							<li class="dir"><span  class="menuBlack">Experience</span>
								<ul>
									<li><a href="./" class="menuBlack">Chapel Grounds</a></li>
									<li><a href="./" class="menuBlack">Chapel Interior</a></li>
									<li><a href="./" class="menuBlack">Chapel History</a></li>
									<li><a href="./" class="menuBlack">News/Press</a></li>
									<li><a href="./" class="menuBlack">Testimonials</a></li>
								</ul>
							</li>
							<li class="dir"><a href="./" class="menuBlack">Packages</a>
								<ul>
									<li><a href="./" class="menuBlack">Wedding Packages</a></li>
									<li><a href="./" class="menuBlack">Renewal Packages</a></li>
									<li><a href="./" class="menuBlack">Featured Packages</a></li>
								</ul>
							</li>
							<li class="dir"><a href="./" class="menuBlack">Services</a>
								<ul>
									<li><a href="./" class="menuBlack">Flower Gallery</a></li>
									<li><a href="./" class="menuBlack">Photography</a></li>
									<li><a href="./" class="menuBlack">Limousine</a></li>
									<li><a href="./" class="menuBlack">Additional Services</a></li>
								</ul>
							</li>
							<li><a href="./" class="menuBlack">Webcam</a></li>
							<li><a href="./" class="menuBlack">Questions</a></li>
							<li><a href="./" class="menuBlack">Contact</a></li>
							<li class="dir"><a href="./" class="menuBlack">Policies</a>
								<ul>
									<li><a href="./" class="menuBlack">Privacy Policy</a></li>
									<li><a href="./" class="menuBlack">Terms of Use</a></li>
								</ul>
							</li>
							<li><a href="?sec=seo" class="menuBlack">SEO</a></li>
						</ul>
					</li>
				</ul>
			</td>
			<td><img src="/images/spacer.gif" alt="" width="1" border="0"></td>
			<td width="150">
				<ul id="nav" class="dropdown dropdown-horizontal">
					<li class="top"><strong class="menuBlack">Utilities</strong>
						<ul>
							<li><a href="./" class="menuBlack">Upload File</a></li>
						</ul>
					</li>
				</ul>
			</td>
			<td><img src="/images/spacer.gif" alt="" width="1" border="0"></td>
			<td width="100%" bgcolor="#E0E0E0" style="border-style:solid; border-width:1px 1px 1px 0; border-color:#fff #d9d9d9 #d9d9d9;">&nbsp;</td>
		</tr>
		</table>
	</td>
<tr>
	<td style="background-color: #FFFFFF;">
	<!-- Content -->
		<?
		switch($sec){
			case "": include("include/filler.php");break;
			case "webcam": include("include/webcam_admin.php");break;
			case "seo": include("include/seo_admin.php");break;
//			case "experience":
//				if ($feature == "testimonials"){
//					include("include/testimonials.php");
//				}elseif ($feature == "history"){
//					include("include/history.php");
//				}elseif ($feature == "news"){
//					include("include/news.php");
//				}else{ //$task == "grounds"
//					include("include/gallery.php");
//				}
//				break;
			default: include("include/filler.php");break;
		} // End Switch
		?>

	
	
	
	
	
	</td>
</tr>
<tr>
	<td style="background-color: Black;"><br></td>
</tr>
</table>
<br>

</div>

</body>
</html>

