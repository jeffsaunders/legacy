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

//$file = file('c:\netscape\server\docs\blindcenter\count.txt');
$fh = fopen('c:\netscape\server\docs\blindcenter\count.txt','r+');
//$num = ($fh[0] + 1);
$val = fgets($fh, 10);
$num = (int) $val;
//exec("echo $num > count.txt");
fseek($fh, 0);
fputs($fh, $num + 1);
//fwrite($fh, $num);
fclose($fh);
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