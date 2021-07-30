<!-- BEGIN Include home.php -->

<div id="aboutBar">
	<img src="images/secondbar.gif">
</div>

<div id="socialPostings">
	<div id="blogContainer">
		<div id="ourBlog">
			<div id="ourBlogText">Our Blog</div>
		</div>
		<div id="blogPosts">
			<!-- Insert blog posts from RSS here -->
			<!-- I can't pre-code this as I still don't know what blog platform Splash Media is going to be using -->
			<div class="blogPost">
				<span class="blogLabel">October 4, 2011</span>
				Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...<br>
				<a href="#" class="blogLink">More >></a>
			</div>
			<div class="blogPost">
				<span class="blogLabel">October 4, 2011</span>
				Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...<br>
				<a href="#" class="blogLink">More >></a>
			</div>
			<div class="blogPost">
				<span class="blogLabel">October 4, 2011</span>
				Sed viverra rhoncus mauris, ac elementum mi interdum accumsan. In vel nunc neque, vulputate tincidunt tortor. Proin sed leo metus. Nam et rhoncus quam...<br>
				<a href="#" class="blogLink">More >></a>
			</div>
		</div>
	</div>
	<div id="twitterContainer">
		<div id="twitter">
			<div id="twitterText">Twitter</div>
		</div>
		<div id="twitterFeed">
			<?
			$hash_tag = "#prayerbelts OR prayerbelts";
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
			<div class="twitterPost">
				<span class="twitterLabel">@<?=$author;?></span>
				<?=$text;?><br>
				<span class="twitterTimestamp">Posted on <?=date('n.j.y @ g:i a',$time)?></span>
			</div>
			<?
				$counter++;
				if ($counter == 3) break;
		    }
			?>
		</div>
	</div>
	<div id="testimonialsContainer">
		<div id="testimonials">
			<div id="testimonialsText">Testimonials</div>
		</div>
		<div id="testimonialsFeed">
			<?
			$xml = simplexml_load_file('xml/testimonials.xml');
			$json = json_encode($xml);
			$testimonials = json_decode($json, TRUE);
			//print_r($testimonials);
			?>
			<div class="testimonialPost">
				<?=$testimonials['testimonial'][0]['text'];?><br>
				<span class="testimonialLabel"><?=$testimonials['testimonial'][0]['author'];?> - <?=$testimonials['testimonial'][0]['city'];?>, <?=$testimonials['testimonial'][0]['state'];?></span>
			</div>
			<div class="testimonialPost">
				<?=$testimonials['testimonial'][1]['text'];?><br>
				<span class="testimonialLabel"><?=$testimonials['testimonial'][1]['author'];?> - <?=$testimonials['testimonial'][1]['city'];?>, <?=$testimonials['testimonial'][1]['state'];?></span>
			</div>
			<div class="testimonialPost">
				<?=$testimonials['testimonial'][2]['text'];?><br>
				<span class="testimonialLabel"><?=$testimonials['testimonial'][2]['author'];?> - <?=$testimonials['testimonial'][2]['city'];?>, <?=$testimonials['testimonial'][2]['state'];?></span>
			</div>
		</div>
	</div>
</div>

<!-- END Include home.php -->
