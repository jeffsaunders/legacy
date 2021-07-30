<?php

   $currentElements = array();
   $newsArray = array();




$ch = curl_init("http://www.wunderground.com/auto/rss_full/global/stations/78760.xml");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$rawfeed = curl_exec($ch);
curl_close($ch);
//echo $rawfeed;







//   readXml("./data.xml");
   readXml($rawfeed);

   echo("<pre>");
   print_r($newsArray);
   echo("</pre>");

   // Reads XML file into formatted html
//   function readXML($xmlFile)
   function readXML($xml)
   {

     $xmlParser = xml_parser_create();

     xml_parser_set_option($xmlParser, XML_OPTION_CASE_FOLDING, false); 
     xml_set_element_handler($xmlParser, startElement, endElement); 
     xml_set_character_data_handler($xmlParser, characterData);










//     $fp = fopen($xmlFile, "r");

//     while($data = fread($fp, filesize($xmlFile))){
//         xml_parse($xmlParser, $data, feof($fp));}
         xml_parse($xmlParser, $xml, false);

//     xml_parser_free($xmlParser);

   }

   // Sets the current XML element, and pushes itself onto the element hierarchy
   function startElement($parser, $name, $attrs)
   {

     global $currentElements, $itemCount;

     array_push($currentElements, $name);

     if($name == "item"){$itemCount += 1;}

   } 

   // Prints XML data; finds highlights and links
   function characterData($parser, $data)
   {

     global $currentElements, $newsArray, $itemCount;

     $currentCount = count($currentElements);
     $parentElement = $currentElements[$currentCount-2];
     $thisElement = $currentElements[$currentCount-1];

     if($parentElement == "item"){
         $newsArray[$itemCount-1][$thisElement] = $data;}
     else{
         switch($name){
           case "title":
               break;
           case "link":
               break;
           case "description":
               break;
           case "language":
               break;
           case "item":
               break;}}

   } 

   // If the XML element has ended, it is poped off the hierarchy
   function endElement($parser, $name)
   {

     global $currentElements;

     $currentCount = count($currentElements);
     if($currentElements[$currentCount-1] == $name){
         array_pop($currentElements);}

   } 

?> 
