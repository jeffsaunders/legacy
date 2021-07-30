<!-- BEGIN Include gallery.php -->



										<!-- Flash Gallery -->
										<script language="javascript" type="text/javascript" src="js/swfobject.js" ></script>
										
										<!-- Div that contains gallery. -->
										<div id="gallery" align="center" style="background:transparent; z-index:-100">
										<h1>No flash player!</h1>
										<p>It looks like you don't have flash player installed. <a href="http://www.macromedia.com/go/getflashplayer" >Click here</a> to go to Macromedia download page.</p>
										</div>
										
										<!-- Script that embeds gallery. -->
										<script language="javascript" type="text/javascript">
										var so = new SWFObject("swf/flashgallery.swf", "gallery", "890", "590", "8");
										so.addParam("quality", "high");
										so.addParam("allowFullScreen", "true");
										so.addParam("wmode", "transparent");
										so.addVariable("content_path","../images/products/"); // Location of a folder with JPG and PNG files (relative to PHP script).
										so.addVariable("color_path","xml/flashgallery.xml"); // Location of XML file with settings.
										so.addVariable("script_path","includes/flashgallery.php"); // Location of PHP script.
										so.write("gallery");
										</script>
										<div class="tinyWhite" style="position:static; display:none; visibility:hidden;">
											Powered by <a href="http://www.flash-gallery.org" class="tinyWhite">Flash Gallery</a>
										</div>

<!-- END Include gallery.php -->
