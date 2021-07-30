<!-- BEGIN Include home.php -->
<div id="socialPostings">
	<!-- Testimonials -->
	<div id="testimonialsContainer">
		<div id="testimonials">
			<div id="testimonialsText"><a href="?sec=testimonials" title="Click to View All of Our Testimonials">Testimonials</a></div>
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
				<a href="?sec=testimonials" class="testimonialLink" title="Click to View All of Our Testimonials">More >></a>
			</div>
			<div class="testimonialPost">
				<?=$testimonials['testimonial'][1]['text'];?><br>
				<span class="testimonialLabel"><?=$testimonials['testimonial'][1]['author'];?> - <?=$testimonials['testimonial'][1]['city'];?>, <?=$testimonials['testimonial'][1]['state'];?></span>
				<a href="?sec=testimonials" class="testimonialLink" title="Click to View All of Our Testimonials">More >></a>
			</div>
			<div class="testimonialPost">
				<?=$testimonials['testimonial'][2]['text'];?><br>
				<span class="testimonialLabel"><?=$testimonials['testimonial'][2]['author'];?> - <?=$testimonials['testimonial'][2]['city'];?>, <?=$testimonials['testimonial'][2]['state'];?></span>
				<a href="?sec=testimonials" class="testimonialLink" title="Click to View All of Our Testimonials">More >></a>
			</div>
		</div>
	</div>
	<!-- Twitter Tweets -->
	<div id="twitterContainer">
		<div id="twitter">
			<div id="twitterText" onClick="window.open('<?=$config['twitter'];?>');" title="Click to Visit Our Twitter Page">Twitter</div>
		</div>
		<div id="twitterFeed">
			<?
			$hash_tag = $config['twitterHashTag'];
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
				<span class="twitterTimestamp">Posted on <?=date('F j, Y @ g:i a',$time)?></span>
			</div>
			<?
				$counter++;
				if ($counter == 3) break;
		    }
			?>
		</div>
	</div>
	<!-- Blog Posts -->
	<div id="blogContainer">
		<div id="ourBlog">
			<div id="ourBlogText" onClick="window.open('<?=$config['blog'];?>');" title="Click to Visit Our Blog">Our Blog</div>
		</div>
		<div id="blogPosts">
			<?
			$url = $config['blogFeed'];
			$fullfeed = implode('', file($url));
			$parser = xml_parser_create();
			xml_parse_into_struct($parser, $fullfeed, $allvalues, $index);
			xml_parser_free($parser);

			foreach($allvalues as $mainkey => $mainvalue){
				if($mainvalue['type'] != 'cdata'){
					$item[$mainkey] = $mainvalue;
				}
			}
			$i = 0;
			foreach($item as $key => $value){
				if($value['type'] == 'open'){
					$i++;
					$itemame[$i] = $value['tag'];
				}elseif($value['type'] == 'close'){
					$feed = $values[$i];
					$item = $itemame[$i];
					$i--;
					if(count($values[$i])>1){
						$values[$i][$item][] = $feed;
					}else{
						$values[$i][$item] = $feed;
					}
				}else{
					$values[$i][$value['tag']] = $value['value'];  
				}
			}
			for ($cnt=0; $cnt < 2; $cnt++){
				$title = $values[0]['RSS']['CHANNEL']['ITEM'][$cnt]['TITLE'];
				$date =  $values[0]['RSS']['CHANNEL']['ITEM'][$cnt]['PUBDATE'];
				$synopsis = explode('<', $values[0]['RSS']['CHANNEL']['ITEM'][$cnt]['DESCRIPTION']);
				$link =  $values[0]['RSS']['CHANNEL']['ITEM'][$cnt]['GUID'];
			?>
			<div class="blogPost">
				<span class="blogTimestamp">Posted on <?=date('F j, Y @ g:i a',strtotime($date))?></span>
				<span class="blogTitle"><?=$title;?></span>
				<?=$synopsis[0];?>...<br>
				<a href="<?=$link;?>" target="_blank" class="blogLink" title="Click to Visit Our Blog">More >></a>
			</div>

			<?
			}
			?>
		</div>
	</div>
</div>

<!-- END Include home.php -->
