<?
$a = "<tt>some</tt><b>html</b>";
preg_match("/<\w?>(\w*?)<\/\w?>/",$a,$b);
echo $b[1];
?>
