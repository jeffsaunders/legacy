<!-- BEGIN Include JesusIsGallery.php -->
										
<table width="100%" border="0">
<tr>
	<td><img src="images/products/JESUS-Is-My-LORD-and-Savior_orig.jpg" alt="" width="400"border="0"></td>
	<td align="right"><a href="javascript:hide('JesusIsGallery');javascript:hide('overlayMask');""><img src="images/CloseButton.gif" alt="Close" title="Close" width="25" height="24" border="0"></a></td>
</tr>
</table>
<!-- Flash Gallery -->

<!-- Div that contains gallery. -->
<div id="JesusIsFlash" align="center" style="background:transparent;">
	<h1>No flash player!</h1>
	It looks like you don't have flash player installed. <a href="http://www.macromedia.com/go/getflashplayer" style="color:#FF0000;">Click here</a> to go to Adobe download page.</p>
</div>

<!-- Script that embeds gallery. -->
<script language="javascript" type="text/javascript">
	var so = new SWFObject("swf/flashgallery.swf", "gallery", "910", "570", "8");
	so.addParam("quality", "high");
	so.addParam("allowFullScreen", "true");
	so.addParam("wmode", "transparent");
	so.addVariable("content_path","../images/gallery/JesusIs"); // Location of a folder with JPG and PNG files (relative to PHP script).
	so.addVariable("color_path","xml/flashgallery.xml"); // Location of XML file with settings.
	so.addVariable("script_path","includes/flashgallery.php"); // Location of PHP script.
	so.write("JesusIsFlash");
</script>
<!--		<div class="tinyWhite" style="position:static; display:none; visibility:hidden;">
	Powered by <a href="http://www.flash-gallery.org" class="tinyWhite">Flash Gallery</a>
</div>-->

<!-- END Include JesusIsGallery.php -->
