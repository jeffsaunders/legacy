<!-- BEGIN Include home.php -->

<!-- Original orange sunburst background --
<div id="pageBackground" style="position:relative; top:0px; left:0px; width:100%; height:450px; background:transparent url('images/OrangeBG.jpg') no-repeat center top; background-size:100% 450px; background-color:#1F1F1F; z-index:0; filter:progid:DXImageTransform.Microsoft.AlphaImageLoader( src='images/OrangeBG.jpg', sizingMethod='scale');"></div>-->

<div id="topSectionBackground" style="position:relative; top:0px; left:0px; width:100%; height:450px; background-color:#FFFFFF; background:transparent url('images/TopSectionBackground.png') repeat-x left top;"></div>

<div id="pageContainer" style="position:relative; top:-450px; left:50%; margin-left:-480px; width:960px; min-height:800px;">
	<div id="splashBelts" style="position:absolute; top:140px; left:0px; width:800px; height:600px; z-index:2;">
		<!-- Animation Scripts -->
		<script type="text/javascript" src="/js/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="/js/jquery.cross-slide.min.js"></script>
		<script>
		$(document).ready(function(){
			$(function() {
				$('#crossSlide').crossSlide({
					sleep: 5,
					fade: <?=(($isie) ? ".01" : "1") //IE fade bug;?>,
					doubleFade: true
				}, [
					{ src: 'images/HomeBelt1.png' },
					{ src: 'images/HomeBelt2.png' }
				])
			});
		});
		</script>
		<div id="crossSlide" style="width:800px; height:600px;"></div>
	</div>
	<div id="topSmallBadge" style="position:absolute; top:90px; left:5px; width:200px; height:200px; z-index:0;">
		<img src="images/Badge3.png" alt="" width="200" height="200" border="0">
	</div>
	<div id="topLargeBadge" style="position:absolute; top:30px; right:-10px; width:510px; height:510px; z-index:0;">
		<img src="images/Badge2.png" alt="" width="510" height="510" border="0">
	</div>
	<div id="bottomContainer" style="position:relative; top:450px; left:0px; width:960px; min-height:250px; z-index:1;">
<!--		<div id="spreadingWord" style="position:absolute; top:100px; left:0px; width:600px; height:100px; text-align:center; z-index:4;">
			<span class="hugeWhite"><em><strong>&ldquo;Spread The Word One Belt at a Time&rdquo;</strong></em></span>
		</div>-->
		<div id="briefDescription" style="position:absolute; top:300px; left:0px; width:100%; height:100px; z-index:4;">
<!--			<span class="biggerWhite">PRAYER BELTS embroider a foundation verse of Scripture or an affirming statement-of-faith onto a color fast web-style belt and turn a common fashion accessory into a personal banner for displaying your faith in places where such displays are prohibited.</span>-->
			<span class="biggerWhite">PRAYER BELTS were created by people deeply troubled over the systematic removal of prayer from public life for people who share the common desire to express their faith in public.</span>
		</div>
		<div id="learnMore" style="position:absolute; top:370px; right:25px; width:140px; height:500px; z-index:4;">
<!--		<div id="learnMore" style="position:absolute; top:400px; right:25px; width:140px; height:500px; z-index:4;">-->
			<a href="./"><img src="images/LearnMore.png" alt="Learn More" width="140" height="50" border="0" title="Click for More Information or to Order Now" onMouseOver="this.src='images/LearnMoreOn.png';" onMouseOut="this.src='images/LearnMore.png';"></a>
		</div>
	</div>

	<div id="SocialPostings" style="position:relative; top:650px; left:50%; margin-left:-480px; width:960px; min-height:750px; z-index:2;">
		<div id="FromBlog" style="position:relative; top:20px; left:0px; width:320px; z-index:3;">
			<img src="images/HitsFromOurBlog.png" alt="" width="275" height="75"><br>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 4, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">11</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 8, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Pellentesque iaculis, sem nec ullamcorper semper, ligula nulla suscipit odio,  tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">38</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>October 11, 2011</em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="4" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/PostedIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite">Posted by <font color="#DF5256">Admin</font></td>
				<td width="20"><img src="images/CommentsIcon.png" alt="" width="20" height="20"></td>
				<td width="120" class="smallWhite"><font color="#DF5256">547</font> Comments</td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>

		<div id="FromTwitter" style="position:absolute; top:20px; left:320px; width:45%; z-index:101;">
			<img src="images/LatestFromTwitter.png" alt="" width="275" height="75">
			<?
			//	$hash_tag = "#cowboys OR #rangers";
				$hash_tag = "#prayer OR #belts";
			    $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
			    $ch = curl_init($url);
			    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
			    $xml = curl_exec ($ch);
			    curl_close ($ch);

			    //If you want to see the response from Twitter, uncomment this next part out:
			    //echo "<p>Response:</p>";
			    //echo "<pre>".htmlspecialchars($xml)."</pre>";

			    $affected = 0;
				$counter = 0;
			    $twelement = new SimpleXMLElement($xml);
			    foreach ($twelement->entry as $entry) {
			        $text = trim($entry->title);
			        $author = trim($entry->author->name);
			        $time = strtotime($entry->published);
			        $id = $entry->id;
			?>
			<table width="280">
			<tr>
				<td colspan="4" class="smallWhite"><font color="#DF5256"><em>@<?=$author;?></em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyWhite">
					<?=$text;?>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallWhite"><em>Posted on <font color="#DF5256"><?=date('n.j.y @ g:i a',$time)?></font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<?
					$counter++;
					if ($counter == 3) break;
			    }
			?>
		</div>

		<div id="Testimonials" style="position:absolute; top:20px; left:640px; width:320px; z-index:3;">
			<img src="images/ClientTestimonials.png" alt="" width="275" height="75"><br>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Alex P. - Dallas, Texas</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Maecenas euismod aliquet justo, ac adipiscing sapien feugiat at. Morbi sollicitudin augue eu ipsum...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Shannon M. - St. Louis, Missouri</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Fusce venenatis ligula a enim aliquam vitae sagittis magna adipiscing. Pellentesque iaculis,sem nec ullamcorper semper, ligula nulla suscipit odio, tincidunt aliquet nunc arcu et est...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
			<table width="280">
			<tr>
				<td colspan="2" class="smallWhite"><font color="#DF5256"><em>Darren K. - San Francisco, California</em></font></td>
			</tr>
			<tr>
				<td width="60" valign="top"><img src="images/TestimonialBullet.png" alt="" width="50" height="50"></td>
				<td width="240" valign="top" class="bodyWhite">
					Nulla ligula erat, ultricies non ullamcorper nec, molestie quis mauris. Duis volutpat ante ut arcu dignissim sit amet consequat tellus fringilla...
				</td>
			</tr>
			<tr>
				<td colspan="2" align="right" class="bodyWhite">
					<em>More >></em>
				</td>
			</tr>
			<tr>
				<td colspan="2"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>
		</div>
	</div>
	<br><br>
</div>
				
<!-- END Include home.php -->
