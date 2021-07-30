<?php

class xItem {
  var $xTitle;
  var $xLink;
  var $xDescription;
}

// general vars
$sTitle = "";
$sLink = "";
$sDescription = "";
$arItems = array();
$itemCount = 0;

// ********* Start User-Defined Vars ************
// rss url goes here



$ch = curl_init("http://www.wunderground.com/auto/rss_full/global/stations/78760.xml");
//$fp = fopen("data.xml", "w");

//curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

echo curl_exec($ch);
curl_close($ch);
//fclose($fp);







//$uFile = "http://www.wirelessdevnet.com/wirelessnews/rss/dailynews.rss";
$uFile = "data.xml";
// descriptions (true or false) goes here
$bDesc = true;
// font goes here
$uFont = "Verdana, Arial, Helvetica, sans-serif";
$uFontSize = "2";
// ********* End User-Defined Vars **************

function startElement($parser, $name, $attrs) {
  global $curTag;

  $curTag .= "^$name";

}

function endElement($parser, $name) {
  global $curTag;

  $caret_pos = strrpos($curTag,'^');

  $curTag = substr($curTag,0,$caret_pos);

}

function characterData($parser, $data) { global $curTag; // get the Channel information first
  global $sTitle, $sLink, $sDescription;  
  $titleKey = "^RSS^CHANNEL^TITLE";
  $linkKey = "^RSS^CHANNEL^LINK";
  $descKey = "^RSS^CHANNEL^DESCRIPTION";
  if ($curTag == $titleKey) {
    $sTitle = $data;
  }
  elseif ($curTag == $linkKey) {
    $sLink = $data;
  }
  elseif ($curTag == $descKey) {
    $sDescription = $data;
  }

  // now get the items 
  global $arItems, $itemCount;
  $itemTitleKey = "^RSS^CHANNEL^ITEM^TITLE";
  $itemLinkKey = "^RSS^CHANNEL^ITEM^LINK";
  $itemDescKey = "^RSS^CHANNEL^ITEM^DESCRIPTION";

  if ($curTag == $itemTitleKey) {
    // make new xItem    
    $arItems[$itemCount] = new xItem();     

    // set new item object's properties    
    $arItems[$itemCount]->xTitle = $data;
  }
  elseif ($curTag == $itemLinkKey) {
    $arItems[$itemCount]->xLink = $data;
  }
  elseif ($curTag == $itemDescKey) {
    $arItems[$itemCount]->xDescription = $data;
    // increment item counter
    $itemCount++;
  }
}

// main loop
$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "characterData");
if (!($fp = fopen($uFile,"r"))) {
  die ("could not open RSS for input");
}
while ($data = fread($fp, 4096)) {
  if (!xml_parse($xml_parser, $data, feof($fp))) {
    die(sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($xml_parser)), xml_get_current_line_number($xml_parser)));
  }
}
xml_parser_free($xml_parser);


// write out the items
?>
<html>
<head>
<title><?php echo ($sTitle); ?></title>
<meta name = "description" content = "<?php echo ($sDescription); ?>">
</head>
<body bgcolor = "#FFFFFF">
<font face = "<?php echo($uFont); ?>" size = "<?php echo($uFontSize); ?>"><a href = "<?php echo($sLink); ?>"><?php echo($sTitle); ?></a></font>
<br>
<br>
<?php
for ($i=0;$i<count($arItems);$i++) {
  $txItem = $arItems[$i];
?>
<font face = "<?php echo($uFont); ?>" size = "<?php echo($uFontSize); ?>"><a href = "<?php echo($txItem->xLink); ?>"><?php echo($txItem->xTitle); ?></a></font>
<br>
<?php
if ($bDesc) {
?>
<font face = "<?php echo($uFont); ?>" size = "<?php echo($uFontSize); ?>"><?php echo ($txItem->xDescription); ?>
<br>
<?php
}
echo ("<br>");
}
?>
</body>
</html>

