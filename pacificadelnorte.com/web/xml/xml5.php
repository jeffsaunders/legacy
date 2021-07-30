<?
$_elements = array();
$_cur_path = '';
                                                                               
function parse_xml_config($file, $elems)
{
       global  $_elements;
                                                                               
       $e = error_reporting(0);
       if (($fp = fopen($file, 'r')) === false)
               return ($elements);
       $xph = xml_parser_create();
       if (is_resource($xph)) {
               xml_parser_set_option($xph, XML_OPTION_CASE_FOLDING, true);
               if (!xml_set_element_handler($xph,
                   'start_elem_handler', 'end_elem_handler'))
                       return ($elements);
               while (($data = fread($fp, 4096)))
                       xml_parse($xph, $data, feof($fp));
               xml_parser_free($xph);
       }
       fclose($fp);
       $elems = $_elements;
       error_reporting($e);
}
                                                                               
function start_elem_handler($xph, $name, $attrs)
{
       global  $_elements, $_cur_path;
                                                                               
       $e = error_reporting(0);
       $_cur_path .= "/$name";
       while (list($key,$val) = each($attrs)) {
               $index = "$_cur_path/$key";
               if (isset($_elements[$index])) {
                       $tmp = $_elements[$index];
                       $_elements[$index] = array();
                       array_push($_elements[$index], $tmp);
                       array_push($_elements[$index], $val);
               } else
                       $_elements[$index] = $val;
       }
       error_reporting($e);
}
                                                                               
function end_elem_handler($xph, $name)
{
       global  $_elements, $_cur_path;
       $_cur_path = dirname($_cur_path);
}

/* main prog */
$config = array();
parse_xml_config('data.xml', &$config);
print_r($config);
?>
