<?
### IMAGE FORMAT
$format = ".gif";

#######################################
## (C) 2000 Total Eclipse Scripts
#
### This script is free for personal
### or commercial use. 
#
#   problems? scripts@tedesign.net
#######################################

$file = file("count.txt");
$num = ($file[0] + 1);
exec("echo $num > count.txt");
switch($type) { 
 case "text":
  echo $num; 
  break;
 case "gfx":
  $i = 0;
  $cntn = strlen($num);
  while($i < $cntn) {
   $tmpnum = substr($num, $i, 1); 
   echo("<img src=\"$dir/$tmpnum$format\">");
   $i++;
  }
  break;
 case "q":
 break;
 default: 
 echo("count.php <b>error</b> : type not specified.");
 break;
}
?>