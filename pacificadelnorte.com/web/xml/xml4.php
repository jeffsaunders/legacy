<?PHP
// Variables
$file = "data.xml";
$feed = array();
$key = "";
$info = "";
$in_HEAD = false;

function startElement($xml_parser, $name, $attrs ) {
  global $feed, $key, $in_HEAD;
  $key = $name;
  if( $name == "HEAD" )
   $in_HEAD = true; }

function endElement($xml_parser, $name) { 
// The Workhorse of the Call Back Functions
// Most of the programming will be put in this function.

  global $feed, $key, $info, $in_HEAD; 
                                           
  if( $name == "HEAD" )                    
   $in_HEAD = false;                        
  if($in_HEAD==false)
   $key = $name;
  elseif( $in_HEAD )
   $key = "HEAD_".$name;
  
  $feed[$key] = $info;
  $info = ""; }

function charData($xml_parser, $data ) {
  // $xml_parser - The resource ID for this parser
  // $data - The character data returned by the parser, from the XML file
  global $info;
  $info .= $data; }

// The Beginning of Execution *******************************************

$xml_parser = xml_parser_create();
xml_set_element_handler($xml_parser, "startElement", "endElement");
xml_set_character_data_handler($xml_parser, "charData" );
$fp = fopen($file, "r");
while ($data = fread($fp, 8192))
  !xml_parse($xml_parser, $data, feof($fp));
xml_parser_free($xml_parser);

// Start Web page
echo "<HTML>\n";
echo "<HEAD>\n";
echo "<TITLE>".$feed['HEAD_TITLE']."</TITLE>\n";
echo "</HEAD>\n";
echo "<BODY>\n";
echo "<CENTER><H1>".$feed['HEAD_TITLE']."</H1></CENTER>\n";
echo "<HR>\n";
foreach( $feed as $assoc_index => $value )
  {
   echo "\$assoc_index = $assoc_index<BR> \$value = $value<BR><BR>\n";
  }
echo "</BODY>\n";
echo "</HTML>\n";
?>
