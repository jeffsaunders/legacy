<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$dbServer = "192.168.15.100";
$dbUsername = "eWNWebSites";
$dbPassword = "zNyU59LFry5E9ajf";

if (!($confLink = mysql_connect($dbServer, $dbUsername, $dbPassword, true))){
	die("<h3>Error - Could Not Connect to eWomen Conference Database</h3>".mysql_error()."\n");
}
mysql_select_db("conference", $confLink);
//print_r($_GET);
$today = date("Y-m-d");
$search_date = $today."%";
$report_sql = "select * from `transactions` where date_submitted like '$search_date';";
//print $report_sql;
// Connect to database
/*if (!($mylink = mysql_connect("192.168.15.100","eWNWebSites","zNyU59LFry5E9ajf"))){
	echo "<h3>Error - Could Not Connect to Database</h3>\n";
	exit;
}*/
//mysql_select_db("ewomen", $ewnLink);

//mail function
function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
    $file = $path.$filename;
    $file_size = filesize($file);
    $handle = fopen($file, "r");
    $content = fread($handle, $file_size);
    fclose($handle);
    $content = chunk_split(base64_encode($content));
    $uid = md5(uniqid(time()));
    $name = basename($file);
    $header = "From: ".$from_name." <".$from_mail.">\r\n";
    $header .= "Reply-To: ".$replyto."\r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $header .= $message."\r\n\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-Type: application/octet-stream; name=\"".$filename."\"\r\n"; // use different content types here
    $header .= "Content-Transfer-Encoding: base64\r\n";
    $header .= "Content-Disposition: attachment; filename=\"".$filename."\"\r\n\r\n";
    $header .= $content."\r\n\r\n";
    $header .= "--".$uid."--";
    if (mail($mailto, $subject, "", $header)) {
        //echo "mail send ... OK"; // or use booleans here
    } else {
        //echo "mail send ... ERROR!";
    }
}



// Excel functions
function xlsBOF($Filename){
	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-Type: application/force-download");
	header("Content-Type: application/octet-stream");
	header("Content-Type: application/download");;
	header("Content-Disposition: attachment;filename=".$Filename."");
	header("Content-Transfer-Encoding: binary ");
//	echo pack("ssssss", 0x809, 0x8, 0x0, 0x10, 0x0, 0x0);
	return;
}

function xlsEOF(){
	echo pack("ss", 0x0A, 0x00);
	return;
}

function xlsWriteNumber($Row, $Col, $Value){
	echo pack("sssss", 0x203, 14, $Row, $Col, 0x0);
	echo pack("d", $Value);
	return;
}

function xlsWriteText($Row, $Col, $Value ){
	$Len = strlen($Value);
	echo pack("ssssss", 0x204, 8 + $Len, $Row, $Col, 0x0, $Len);
	echo $Value;
	return;
}

// Initialize the spreadsheet file
//xlsBOF("mdTrackerDumpReport.csv");

// Get the data
$query = $report_sql;
//die($query);
$rs_transactions = mysql_query($query, $confLink);
// Build the header row --
// Grab the first row
$row = mysql_fetch_assoc($rs_transactions);
//print_r($row);
$sHeader = "";
// Grab just the column names
foreach ($row as $key => $value){
	$sHeader .= $key.",";
}
// Chop off the trailing comma
$sHeader = substr($sHeader, 0, -1);
// Write the header row
$data = $sHeader;
// Must send this seperately - it is ignored by Excel if appended to the header string
$data .= "\n";

// Build the data rows --
// Start from the top
mysql_data_seek($rs_transactions, 0);
while ($row = mysql_fetch_assoc($rs_transactions)){
	// Initialize a clean row
	$sRow = "";
	foreach ($row as $key => $value){
		// If it's a credit card column, decrypt it
		if (substr($key, 0, 3) == "cc_"){
			$dataKey = base64_decode('d2Vscm47d2xrZW5yd2VvaWowMiE5bm4=');
			$sRow .= '"*'.decrypt($value, $dataKey).'*",';
		// Replace any double-quotes wiht tow double-quotes
		}else{
			$sRow .= '"'.str_replace("\"", "\"\"", $value).'",';
		}
	}
	// Chop off the trailing comma
	$sRow = substr($sRow, 0, -1);
	// Write data row
	$data .= $sRow;
	$data .= "\n";
}

// Close 'er up
//xlsEOF();
//print $data;

//save file to filesystem
$file_name = "/var/www/ewn2/admin/conference/reports/".$today."-Conference_TransactionReport.csv";
$file_handle = fopen($file_name, 'w') or die('Cannot open file:  '.$file_name);

fwrite($file_handle, $data);

fclose($file_handle);
//email todays file to someone
$mail_file = $today."-Conference_TransactionReport.csv";
$mail_path = "/var/www/ewn2/admin/conference/reports/";
$mail_name = "Conference Billing Module";
$mail_mail = "it@ewomennetwork.net";
$mail_replyto = "it@ewomennetwork.net";
$mail_subject = "Conference Billing Transaction Report.";
$mail_message = "Conference Billing Transaction Report for ". $today;
mail_attachment($mail_file, $mail_path, "accountant@ewomennetwork.com", $mail_mail, $mail_name, $mail_replyto, $mail_subject, $mail_message);
mail_attachment($mail_file, $mail_path, "scott@360computing.com", $mail_mail, $mail_name, $mail_replyto, $mail_subject, $mail_message);
?>