<?
$rssURL = "http://gdata.youtube.com/feeds/api/users/DennisTobler/uploads";
$localFile = "cache/YouTubeVideos.xml";
$cacheMinutes = 5;

function fetchFeed(){
	global $rssURL, $localFile;
	$contents = file_get_contents($rssURL); //fetch RSS feed
	$fp = fopen($localFile, "w");
	fwrite($fp, $contents); //write contents of feed to cache file
	fclose($fp);
}

function outputRSSContent(){
	global $rssURL, $localFile, $cacheMinutes;
	if (!file_exists($localFile)){ //if cache file doesn't exist
		touch($localFile); //create it
		chmod($localFile, 0666);
		fetchFeed(); //then populate cache file with contents of RSS feed
	}
	else if (((time()-filemtime($localFile))/60)>$cacheMinutes)	fetchFeed(); //if age of cache file is greater than cache minutes setting get a fresh copy
//	readfile($localFile); //return the contents of the cache file
}

outputRSSContent(); //make sure we have a current XML file to work with.
?>

<script>
function loadXMLDoc(dname){
	if (window.XMLHttpRequest){
		xhttp = new XMLHttpRequest();
	}else{
		xhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xhttp.open("GET",dname,false);
	xhttp.send();
	return xhttp.responseXML;
} 

function getVideoURL(){
	xmlDoc = loadXMLDoc("<?=$localFile?>");
	if (document.getElementsByTagNameNS != undefined){
		var url = xmlDoc.getElementsByTagNameNS("http://search.yahoo.com/mrss/","content")[0].getAttribute("url"); 
	}else{
		var url = xmlDoc.getElementsByTagName("media:content")[0].getAttribute("url"); 
	}
	SplitResult = url.split("?");
	return SplitResult[0]+"?fs=1&amp;hl=en_US&amp;rel=0";
}
</script>

<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript">
function loadSWF(url){
	var flashvars = {};
	var params = {
		allowFullScreen: "true",
		allowscriptaccess: "always"
	};
	var attributes = {};
	swfobject.embedSWF(url, "YouTubeMovie", "560", "340", "6", "#336699", flashvars, params, attributes);
}
</script>

<body onLoad="loadSWF(getVideoURL());">

<div id="YouTubeMovie">
  This text is replaced by the Flash movie.
</div>

<script>//loadSWF(getVideoURL());</script>


</body>

<script>//document.write(getVideoURL() + "<br>");</script>

<!--<body onLoad="getVideoURL();">

<object width="560" height="340"><param name="movie" id="YouTubeMovie" value=""></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed id="YouTubeEmbed" src="" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="560" height="340"></embed></object>

</body>-->

<?
/*

//$string = <<<XML
//<a>
// <foo name="one" game="lonely">1</foo>
//</a>
//XML;

$doc = simplexml_load_file($localFile);
////$doc = new DOMDocument();
////$doc->load($localFile);
//foreach($doc->children('http://search.yahoo.com/mrss/')->attributes() as $a => $b) {
//   echo $a,'="',$b,"\"\n";
////$url = $xml->getElementsByTagName('media:content').getAttribute("url");
////echo $url;
//}

// foreach ($doc->children('media') as $entry) {
 //     printf("%s\n", $entry->name);
 // } 

//You can get value from "user:name" element:
//$url = $doc->xpath('/feed/entry/media:group/media:content');
$url = $doc->xpath('/media:content');
$x = $url->attributes('url');

//$doc = new DOMDocument();
//$doc->load($localFile);

//$url = $doc->getElementsByTagName('media:content').getAttribute("url");

//echo $x;
print_r($url);

/*
	$arrFeeds = array();
	foreach ($doc->getElementsByTagName('media:content') as $node) {
		$itemRSS = array ( 
			'url' => $node->getElementsByTagName('url')->item(0)->nodeValue
			);
		array_push($arrFeeds, $itemRSS);
	}

	print_r($arrFeeds);
	print_r($itemRSS);
*/
?>

