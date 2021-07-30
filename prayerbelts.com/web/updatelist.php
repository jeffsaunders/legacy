<?
$filename = "csv/MailingList.csv";
$content = $_REQUEST['email'].",".$_REQUEST['name'].",".$_REQUEST['zipcode'].",".date('Y-m-d H:i:s')."\n";
if (is_writable($filename)){
	if (!$handle = fopen($filename, 'a')){
		die("Cannot open file ($filename)");
	}
	if (fwrite($handle, $content) === FALSE) {
		die("Cannot write to file ($filename)");
	}
	fclose($handle);
}else{
	echo "The file $filename is not writable";
}
header("Location: /?sec=thankyou&for=joining");
?>