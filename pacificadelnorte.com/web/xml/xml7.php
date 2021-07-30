<?php
Class xmlread
 {

   var $tree = '$this->ogg';
   var $ogg    ;
   var $cnt = 0;

   /************
   * change_to_array
   * is called by startElement
   * to check if there is need
   * to change element to array
   ************/
   function change_to_array($test,$is_arr) {
   if ($test and !$is_arr):  //if element is set, change it to array
     eval('$tmp = '.$this->tree.';'); //save element to tmp
     eval('unset('.$this->tree.');'); //unset element
     eval(''.$this->tree.'= array();'); //transform $this->tree in an array
     eval('array_push('.$this->tree.',$tmp);');//push old object
                                               //into the array
     return true;
   endif;
   if ($is_arr)
     return true;
   }

   /************
   * startElement
   ************/
   function startElement($parser, $name, $attrs)
   {
     $this->tree = $this->tree."->".$name;  //add tag to tree string
                                           //test if element is an array
     eval('$is_arr = is_array('.$this->tree.');');
                                       //test if element is set
     eval('$test = isset('.$this->tree.');');
                                 //if is already set (and not array)...
                                 //...change it to array
     $is_arr = $this->change_to_array($test,$is_arr);

     if ($is_arr):                  //if is an array
       $this->cnt = $this->cnt+1;    //increase counter
                   //and set tree-string to add element
       $this->tree = $this->tree.'['.$this->cnt.']';
     endif;

   return true;}

   /************
   * characterData
   ************/
   function characterData($parser, $data)
   {
     if (trim($data)!=''):
       $data = addslashes($data);
               //add data to tree set up by startElement()
       eval($this->tree."='".trim($data)."';");
     endif;
   return true;}

   /************
   * endElement
   ************/
   function endElement($parser, $name)
   { //cut last ->element
     $pos  = strrpos($this->tree, ">");
     $leng = strlen($this->tree);
     $pos1 = ($leng-$pos)+1;
     $this->tree = substr($this->tree, 0, -$pos1);
   return true;}

   /************
   * get_data: this is the
   * parser
   ************/
       function get_data
       ($doc,$st_el='startElement',
       $end_el='endElement',
       $c_data='characterData') {
       $this->mioparser = xml_parser_create();
       xml_set_object($this->mioparser, &$this);
       xml_set_element_handler
       ($this->mioparser, $st_el,$end_el);
       xml_set_character_data_handler
       ($this->mioparser,$c_data);
       xml_parser_set_option
       ($this->mioparser, XML_OPTION_CASE_FOLDING, false);
       xml_parse($this->mioparser,$doc);
       if (xml_get_error_code($this->mioparser)):
         print "<b>XML error at line n. ".
         xml_get_current_line_number
         ($this->mioparser)." -</b> ";
         print xml_error_string
           (xml_get_error_code($this->mioparser));
       endif;
   return true; }

   function xmlread($doc) {
       $xml = file_get_contents('data.xml');
       $this->get_data($xml);
   return true; }

  }  //end of class
  
  ?> 
