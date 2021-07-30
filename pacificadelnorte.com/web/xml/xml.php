<?
$file = 'data.xml';
$elements = $stack = array();
$count = $depth = 0;

class element{
   var $name = '';
   var $attributes = array();
   var $data = '';
   var $depth = 0;
}

function start_element_handler($parser, $name, $attribs){
   global $elements, $stack, $count, $depth;

   $id = $count;
   $element = new element;
   $elements[$id] = $element;
   
   $elements[$id]->name = $name;
   
   while(list($key, $value) = each($attribs))
       $elements[$id]->attributes[$key] = $value;
   
   $elements[$id]->depth = $depth;
   
   array_push($stack, $id);

   $count++;
   $depth++;
}

function end_element_handler($parser, $name){
   global $stack, $depth;
   
   array_pop($stack);
   
   $depth--;
}

function character_data_handler($parser, $data){
   global $elements, $stack;
   
   $elements[$stack[count($stack)-1]]->data .= $data;
}

$xml_parser = xml_parser_create('');

xml_parser_set_option($xml_parser, XML_OPTION_CASE_FOLDING, 0);

xml_set_element_handler($xml_parser, "start_element_handler", "end_element_handler");
xml_set_character_data_handler($xml_parser, "character_data_handler");

if(!file_exists($file))
   die("\n<p>\"$file\" does not exist.</p>\n</body>\n</html>");

if(!($handle = fopen($file, "r")))
   die("<p>Cannot open \"$file\".</p>\n</body>\n</html>");

while($contents = fread($handle, 4096))
   xml_parse($xml_parser, $contents, feof($handle));

fclose($handle);

xml_parser_free($xml_parser);

echo "<hr />\n";

$depth = $offset = 0;

while(list($key_a) = each($elements)){
   $depth--;
   $offset = 0;
   if($elements[$key_a]->depth < $depth){
       while($elements[$key_a]->depth != (($elements[$key_a - $offset]->depth) - 1)  || $offset == 0){
           $offset++;
           if($elements[$key_a]->depth == (($elements[$key_a - $offset]->depth) - 1))
               echo "<dl>\n<dt><strong>Element Closed:</strong></dt>\n<dd>" . $elements[$key_a - $offset]->name . "</dd>\n</dl>\n<hr />\n";
       }
       $depth--;
   }
   if($elements[$key_a]->depth == $depth && $depth != 0){
       while($elements[$key_a]->depth != $elements[$key_a - $offset]->depth  || $offset == 0){
           $offset++;
           if($elements[$key_a]->depth == $elements[$key_a - $offset]->depth)
               echo "<dl>\n<dt><strong>Element Closed:</strong></dt>\n<dd>" . $elements[$key_a - $offset]->name . "</dd>\n</dl>\n<hr />\n";
       }
       $depth--;
   }
   $depth++;
   echo "<dl>\n<dt><strong>Element:</strong></dt>\n<dd>" . $elements[$key_a]->name . "</dd>\n</dl>\n";
   echo "<dl>\n<dt><strong>Attributes:</strong></dt>\n";
   if(empty($elements[$key_a]->attributes))
       echo "<dd>No attributes specified</dd>\n";
   else{
       while(list($key_b, $value) = each($elements[$key_a]->attributes))
           echo "<dd>$key_b=\"$value\"</dd>\n";
   }
   echo "</dl>\n<dl>\n<dt><strong>Data:</strong></dt>\n";
   if(trim($elements[$key_a]->data) == '')
       echo "<dd>No data specified</dd>\n";
   else
       echo "<dd>" . $elements[$key_a]->data . "</dd>\n";
   echo "</dl>\n<dl>\n<dt><strong>Depth:</strong></dt>\n<dd>" . $elements[$key_a]->depth . "</dd>\n</dl>\n<hr />\n";
   $depth++;
}

$depth--; 

for($i = $depth; $i >= 0; $i--){
   $offset = 0;
   $count = count($elements) - 1;
   for($j = 0; $j <= $count; $j++){
       if($elements[$count - $j]->depth == $depth){
           echo "<dl>\n<dt><strong>Element Closed:</strong></dt>\n<dd>" . $elements[$count - $j]->name . "</dd>\n</dl>\n<hr />\n";
           break;
       }
   }
   $depth--;
}
?>
