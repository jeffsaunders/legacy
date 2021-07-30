<!-- BEGIN Include product.php -->

<div id="aboutBar">
	<img src="images/secondbar.gif">
</div>

<!-- Power Zoomer Scripts -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="/js/ddpowerzoomer.js">
/***********************************************
* Image Power Zoomer- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
***********************************************/
</script>
<script type="text/javascript">
	jQuery(document).ready(function($){ //fire on DOM ready

		/*
		EXAMPLE 1:
		$('#myimage').addpowerzoom()
	
		EXAMPLE 2:
		$('img.vacation').addpowerzoom({
			defaultpower: 2,
			powerrange: [2,5],
			largeimage: null,
			magnifiersize: [100,100] //<--no comma following last option!
		})
		*/
		$('#image1').addpowerzoom({
			defaultpower: 3,
			powerrange: [2,5],
			largeimage: "images/products/UniversalFrontHiRes.jpg",
			magnifiersize: [150,150]
		})
		$('#image2').addpowerzoom({
			defaultpower: 3,
			powerrange: [2,5],
			largeimage: "images/products/InJesusBackHiRes.jpg",
			magnifiersize: [150,150]
		})
		$('#image3').addpowerzoom({
			defaultpower: 3,
			powerrange: [2,5],
			largeimage: "images/products/InJesusBack2HiRes.jpg",
			magnifiersize: [150,150]
		})
		$('#image4').addpowerzoom({
			defaultpower: 3,
			powerrange: [2,5],
			largeimage: "images/products/UniversalSideHiRes.jpg",
			magnifiersize: [150,150]
		})
	})
</script>

<br>
<img src="images/products/UniversalFront.jpg" id="image1" alt="" width="320" height="240" class="productsListImg">
<br><br>
<img src="images/products/InJesusBack.jpg" id="image2" alt="" width="320" height="240" class="productsListImg">
<br><br>
<img src="images/products/InJesusBack2.jpg" id="image3" alt="" width="320" height="240" class="productsListImg">
<br><br>
<img src="images/products/UniversalSide.jpg" id="image4" alt="" width="320" height="240" class="productsListImg">
<br>

<!-- END Include product.php -->
