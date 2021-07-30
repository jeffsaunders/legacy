<?
$xml_file = 'data.xml';
   function makeXMLTree($file) {
         
       $open_file = fopen($file, "r"); 
         $data = fread($open_file, filesize($file));
         $ret = array();

         $parser = xml_parser_create();
         xml_parser_set_option($parser,XML_OPTION_CASE_FOLDING,0);
         xml_parser_set_option($parser,XML_OPTION_SKIP_WHITE,1);
         xml_parse_into_struct($parser,$data,$values,$tags);
         xml_parser_free($parser);

         $hash_stack = array();
       $a=0;
         foreach ($values as $key => $val) {
           switch ($val['type']) {
                   case 'open':
                       array_push($hash_stack, $val['tag']);
                   break;

                   case 'close':
                       array_pop($hash_stack);
                   break;

                   case 'complete':
                       array_push($hash_stack, $val['tag']);

                       // uncomment to see what this function is doing
                   /* echo("\$ret[$a][" . implode($hash_stack, "][") . "] = '{$val[value]}';\n");
                     $a++;*/
                 
                     eval("
                           \$ret[\$a][" . implode($hash_stack, "][") . "] = '{$val[value]}';
                           \$a++;");
                       array_pop($hash_stack);
                   break;
             }
         }
         return $ret;
       }
   
   $res = makeXMLTree($xml_file);
   print_r($res);
?> 
