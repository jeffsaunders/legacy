<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>






<?php
/*
    Relative Time Function
    based on code from http://stackoverflow.com/questions/11/how-do-i-calculate-relative-time/501415#501415
    For use in the "Parse Twitter Feeds" code below
*/
define("SECOND", 1);
define("MINUTE", 60 * SECOND);
define("HOUR", 60 * MINUTE);
define("DAY", 24 * HOUR);
define("MONTH", 30 * DAY);
function relativeTime($time)
{
    $delta = strtotime('+2 hours') - $time;
    if ($delta < 2 * MINUTE) {
        return "1 min ago";
    }
    if ($delta < 45 * MINUTE) {
        return floor($delta / MINUTE) . " min ago";
    }
    if ($delta < 90 * MINUTE) {
        return "1 hour ago";
    }
    if ($delta < 24 * HOUR) {
        return floor($delta / HOUR) . " hours ago";
    }
    if ($delta < 48 * HOUR) {
        return "yesterday";
    }
    if ($delta < 30 * DAY) {
        return floor($delta / DAY) . " days ago";
    }
    if ($delta < 12 * MONTH) {
        $months = floor($delta / DAY / 30);
        return $months <= 1 ? "1 month ago" : $months . " months ago";
    } else {
        $years = floor($delta / DAY / 365);
        return $years <= 1 ? "1 year ago" : $years . " years ago";
    }
}
?>

<?php
/*
    Parse Twitter Feeds
    based on code from http://spookyismy.name/old-entries/2009/1/25/latest-twitter-update-with-phprss-part-three.html
    and cache code from http://snipplr.com/view/8156/twitter-cache/
    and other cache code from http://wiki.kientran.com/doku.php?id=projects:twitterbadge
*/
/*
function parse_cache_feed($usernames, $limit) {
    $username_for_feed = str_replace(" ", "+OR+from%3A", $usernames);
    $feed = "http://search.twitter.com/search.atom?q=from%3A" . $username_for_feed . "&rpp=" . $limit;
    $usernames_for_file = str_replace(" ", "-", $usernames);
    $cache_file = dirname(__FILE__).'/cache/' . $usernames_for_file . '-twitter-cache';
    $last = filemtime($cache_file);
    $now = time();
    $interval = 600; // ten minutes
    // check the cache file
    if ( !$last || (( $now - $last ) > $interval) ) {
        // cache file doesn't exist, or is old, so refresh it
        $cache_rss = file_get_contents($feed);
        if (!$cache_rss) {
            // we didn't get anything back from twitter
            echo "<!-- ERROR: Twitter feed was blank! Using cache file. -->";
        } else {
            // we got good results from twitter
            echo "<!-- SUCCESS: Twitter feed used to update cache file -->";
            $cache_static = fopen($cache_file, 'wb');
            fwrite($cache_static, serialize($cache_rss));
            fclose($cache_static);
        }
        // read from the cache file
        $rss = @unserialize(file_get_contents($cache_file));
    }
    else {
        // cache file is fresh enough, so read from it
        echo "<!-- SUCCESS: Cache file was recent enough to read from -->";
        $rss = @unserialize(file_get_contents($cache_file));
    }
    // clean up and output the twitter feed
    $feed = str_replace("&amp;", "&", $rss);
    $feed = str_replace("&lt;", "< ", $feed);
    $feed = str_replace("&gt;", ">", $feed);
    $clean = explode("<entry>", $feed);
    $amount = count($clean) - 1;
    if ($amount) { // are there any tweets?
        for ($i = 1; $i < = $amount; $i++) {
            $entry_close = explode("</entry>", $clean[$i]);
            $clean_content_1 = explode("<content type=\"html\">", $entry_close[0]);
            $clean_content = explode("</content>", $clean_content_1[1]);
            $clean_name_2 = explode("<name>", $entry_close[0]);
            $clean_name_1 = explode("(", $clean_name_2[1]);
            $clean_name = explode(")</name>", $clean_name_1[1]);
            $clean_user = explode(" (", $clean_name_2[1]);
            $clean_lower_user = strtolower($clean_user[0]);
            $clean_uri_1 = explode("<uri>", $entry_close[0]);
            $clean_uri = explode("</uri>", $clean_uri_1[1]);
            $clean_time_1 = explode("<published>", $entry_close[0]);
            $clean_time = explode("</published>", $clean_time_1[1]);
            $unix_time = strtotime($clean_time[0]);
            $pretty_time = relativeTime($unix_time);
            ?>
                <li>
                    <p class="tweet">
                        <?php echo $clean_content[0]; ?>
                        <small><?php echo $pretty_time; ?></small>
                    </p>
                </li>
            <?php
        }
    } else { // if there aren't any tweets
        ?>
            <li>
                <p class="tweet">
                    I have been terribly busy recently shoveling pixels and
                    clearing out the tubes that make up the Internet, so I
                    haven't had a chance to tweet recently. I am truly very
                    sorry about this, so with just a bit more prodding I'll
                    update as soon as possible.
                </p>
            </li>
        <?php
    }
}
*/
?>








<?
/*
$rssUrl = "http://twitter.com/statuses/user_timeline/$jeffssaunders.xml";
$rss = @file_get_contents($rssUrl);

if($rss)
{
$xml = @simplexml_load_string($rss);
if($xml !== false)
{
//print_r($xml->channel->item);
foreach($xml->status as $tweet)
{
// update id
$id=$tweet->id;
// update date
$created_at=$tweet->created_at;
// update text
$text=$tweet->text;
// update source ie: from web , from sharthis etc
$source=$tweet->source;
// update in replay to
$in_reply_to_screen_name=$tweet->in_reply_to_screen_name;

}
}
else
{
echo "Error: RSS file not valid!";
}
}
else
{
echo "Error:Username invalid or requires authentication";
}
*/
?>



<?
//function getTweets($hash_tag) {
	$hash_tag = "#rangers";
    $url = 'http://search.twitter.com/search.atom?q='.urlencode($hash_tag) ;
//    echo "<p>Connecting to <strong>$url</strong> ...</p>";
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
//        echo "<p>Tweet from ".$author.": <strong>".$text."</strong>  <em>Posted ".date('n/j/y g:i a',$time)."</em></p>";
?>

			<table width="100%">
			<tr>
				<td colspan="4" class="smallBlack"><font color="#DF5256"><em>@<?=$author;?></em></font></td>
			</tr>
			<tr>
				<td colspan="4" class="bodyBlack">
					<?=$text;?>
				</td>
			</tr>
			<tr>
				<td width="20"><img src="images/TweetIcon.png" alt="" width="20" height="20"></td>
				<td class="smallBlack"><em>Posted on <font color="#DF5256"><?=date('n.j.y @ g:i a',$time)?></font></em></td>
			</tr>
			<tr>
				<td colspan="4"><img src="images/SocialLine.png" alt="" width="150" height="5"></td>
			</tr>
			</table>

<?
		$counter++;
		if ($counter == 3) break;
    }

//    return true ;
//}

//getTweets('#Rangers');
?>







</body>
</html>
