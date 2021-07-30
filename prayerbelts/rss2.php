<?php
	/******************************************************************************************************************
	   RSS PARSING FUNCTION
	******************************************************************************************************************/
 
	//FUNCTION TO PARSE RSS IN PHP 4 OR PHP 4
	function parseRSS($url) { 
 
	//PARSE RSS FEED
        $feedeed = implode('', file($url));
        $parser = xml_parser_create();
        xml_parse_into_struct($parser, $feedeed, $valueals, $index);
        xml_parser_free($parser);
 
	//CONSTRUCT ARRAY
        foreach($valueals as $keyey => $valueal){
            if($valueal['type'] != 'cdata') {
                $item[$keyey] = $valueal;
			}
        }
 
        $i = 0;
 
        foreach($item as $key => $value){
 
            if($value['type'] == 'open') {
 
                $i++;
                $itemame[$i] = $value['tag'];
 
            } elseif($value['type'] == 'close') {
 
                $feed = $values[$i];
                $item = $itemame[$i];
                $i--;
 
                if(count($values[$i])>1){
                    $values[$i][$item][] = $feed;
                } else {
                    $values[$i][$item] = $feed;
                }
 
            } else {
                $values[$i][$value['tag']] = $value['value'];  
            }
        }
 
	//RETURN ARRAY VALUES
        return $values[0];
	} 
 
 
	/******************************************************************************************************************
	  SAMPLE USAGE OF FUNCTION
	******************************************************************************************************************/
 
	//PARSE THE RSS FEED INTO ARRAY
	$xml = parseRSS("http://blog.prayerbelts.com/feed/");
 
echo "<pre>";
print_r($xml);
echo "</pre>";
	//SAMPLE USAGE OF 
	foreach($xml['RSS']['CHANNEL']['ITEM'] as $item) {
	        echo("<p class=\"indexBoxNews\"><a href=\"{$item['LINK']}\" target=\"_blank\" class=\"indexBoxNews\">{$item['TITLE']}{$link}</a></p>");
	}
 
?>

