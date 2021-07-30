<?
session_start(); 
// Is this the first time we've been here in this session?
$showPromo = 0;
//$_SESSION['FirstTime'] = 0;
if (!$_SESSION['FirstTime'] || $_SESSION['FirstTime'] != 1){
	$showPromo = 1;
	$_SESSION['FirstTime'] = 1;
}
?>

<?
// Inline If (PHP Core needs this function added!)
function iif($condition,$value1,$value2){
	if ($condition){
		return $value1;
	}else{
		return $value2;
	}
}
?>

<!-- Grab the database -->
<? include("dbconnect.php"); ?>

<?
// Assign passed (via path) values
// Blow apart the passed path
$aPath = explode("/",$_SERVER['REQUEST_URI']);
// Pop (shift) off the annoying leading blank
array_shift($aPath);
// Assign passed values
$page = $aPath[0];
$sec = $aPath[0];
$ailment = $aPath[2];
$task = $aPath[3];
$message = $aPath[4];
$test = $aPath[5];
echo "x: ".$sec."<br>";
//print_r($aPath);
?>
