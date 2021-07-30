<?php

phpinfo(INFO_GENERAL);

/** parse php modules from phpinfo */
function parsePHPModules() {
 ob_start();
 phpinfo(INFO_GENERAL);
 $s = ob_get_contents();
 ob_end_clean();
 
 $s = strip_tags($s,'<td>');
 $s = preg_replace('/<th[^>]*>([^<]+)<\/th>/',"<info>\\1</info>",$s);
 $s = preg_replace('/<td[^>]*>([^<]+)<\/td>/',"<info>\\1</info>",$s);
 $vTmp = preg_split('/(<h2>[^<]+<\/h2>)/',$s,-1,PREG_SPLIT_DELIM_CAPTURE);
 
 print_r($vTmp);exit;
 $vModules = array();
 for ($i=1;$i<count($vTmp);$i++) {
  if (preg_match('/<h2>([^<]+)<\/h2>/',$vTmp[$i],$vMat)) {
   $vName = trim($vMat[1]);
   $vTmp2 = explode("\n",$vTmp[$i+1]);
   foreach ($vTmp2 AS $vOne) {
   $vPat = '<info>([^<]+)<\/info>';
   $vPat3 = "/$vPat\s*$vPat\s*$vPat/";
   $vPat2 = "/$vPat\s*$vPat/";
   if (preg_match($vPat3,$vOne,$vMat)) { // 3cols
     $vModules[$vName][trim($vMat[1])] = array(trim($vMat[2]),trim($vMat[3])); 
   } elseif (preg_match($vPat2,$vOne,$vMat)) { // 2cols
     $vModules[$vName][trim($vMat[1])] = trim($vMat[2]); 
   } 
   } 
  } 
 } 
 return $vModules;
}

$vModules = parsePHPModules();
print_r($vModules);

/** get a module setting */
function getModuleSetting($pModuleName,$pSetting) {
 $vModules = parsePHPModules();
 return $vModules[$pModuleName][$pSetting];
}
//Example: getModuleSetting('gd','GD Version'); returns "bundled (2.0.28 compatible)" 

?>