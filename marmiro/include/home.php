<!-- BEGIN Include home.php -->

			<!-- Animation Scripts -->
			<script type="text/javascript" src="/js/jquery.min.js"></script>
			<script type="text/javascript" src="/js/fadeslideshow.js">
				/***********************************************
				* Ultimate Fade In Slideshow v2.0- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
				* This notice MUST stay intact for legal use
				* Visit Dynamic Drive at http://www.dynamicdrive.com/ for this script and 100s more
				***********************************************/
			</script>

			<!-- Rotating Images -->
			<script type="text/javascript">
				<?
				// Get image names for slideshow
				if ($config['slideshow_sort'] != "random"){
					$query = "SELECT *
								FROM slideshow
								WHERE display = 'T'
								ORDER BY position ASC;";
				}else{
					$query = "SELECT *
								FROM slideshow
								WHERE display = 'T'
								ORDER BY RAND();";
				}
//echo $query."<br><br>";
				$rs_slideshow = mysql_query($query, $linkID);
				?>
				var mygallery=new fadeSlideShow({
					wrapperid: "fadeShow",
					dimensions: [960, 467],
					imagearray: [
						<?
						$imageCnt = 0;
						while ($slide = mysql_fetch_assoc($rs_slideshow)){
							$imageCnt++;
						?>
						["/images/slideshow/<?=$slide["image"];?>"]<?=iif($imageCnt < mysql_num_rows($rs_slideshow), ",", "");?>
						<?
						}
						?>
					],
					displaymode: {type:'auto', pause:7500, cycles:0, wraparound:false, randomize:false},
					persist: false,
					fadeduration: 1000,
					descreveal: "ondemand",
					togglerid: ""
				})
			</script>
			<!-- Div to replace with image(s) -->
			<div id="fadeShow"></div>
				
<!-- END Include home.php -->
