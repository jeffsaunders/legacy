
<?
	include "dbconnect.php";
$SID = "54c04582abbd0e6dea69b61dbc76e256";
$query = "SELECT * FROM orders WHERE session_id = '".$SID."'";
//$query = "SELECT * FROM devices WHERE session_id = '1a6d9146fab499695a54455e0d1c8c55' and unique_id = '269'";
//$query = "SELECT * FROM devices WHERE session_id = '1a6d9146fab499695a54455e0d1c8c55' and unique_id = '270'";
//echo $query."<br><br>";
	$order = mysql_query($query, $linkID);
	$fields = mysql_num_fields($order);
	$row = mysql_fetch_assoc($order);
	// Then build the list of parameters and values to POST
	$params = "";
//$params .= "&key=f5d3ff40e96c2bf385d85a536186b782";
	$i = 0; 
	while ($i < $fields){
		$params .= "&".mysql_field_name($order, $i)."=".urlencode($row[mysql_field_name($order, $i)]);
		$i++; 
	} 
echo $params."<br><br>";
	mysql_free_result($order);

	// Now POST it using cURL
	$url = "http://216.131.115.179/pws.php";
//	$url = "http://www.cellbenefits.com/received.php";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
////	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
////	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4 seconds
//	ob_start();
	$result = curl_exec($ch);
//	curl_close($ch);
//	$result = ob_get_contents();
//	ob_end_clean();
echo("Results: <br>".$result)."<br><br>";

	// read the reply and act accordingly
	if ($result != false){ //POST was successful
		if (preg_match("/ok:/i", $result)) { //if we got back an "ok:"
			$raw_return = stristr($result,"ok: "); // The part of the reply starting with "ok: "
echo $raw_return."<br><br>"; 
			$raw_key = substr($raw_return, 4, 32); // The next 32 characters starting at position 4 (after "ok: ", zero relative)
echo $raw_key."<br><br>"; 
//		$raw_status = substr($raw_return, strpos($raw_return,"<br>")); // The rest of the returned value starting at the "<br>" following the key
//echo $raw_status."<br><br>"; 
			$query =
				"UPDATE orders SET
				delivery_time = NOW()
				WHERE session_id = '".$SID."'";
			$rs_close = mysql_query($query, $linkID);


////////LEFT OFF HERE - Have it successfully posting the order record and writing the timestamp.  Need to go on to posting device records.  Also need to code for an error below.


		}else{ //if we got "error:" instead (suppoded to get one or the other EVERY time
			$raw_return = stristr($result,"error: "); // The part of the reply starting with "error: "
		}
//		$raw_return = stristr($result,"?sid="); // The part of the reply starting with "?sid="
//echo $raw_return."<br><br>"; 
//		$raw_key = substr($raw_return, strpos($raw_return,"?"), 37); // The first 37 characters ("?sid=" + the 32 character session_id)
//echo $raw_sessid."<br><br>"; 
//		$sessid = substr($raw_sessid, -32, 32); // The last 32 characters of that ("?sid=" removed)...the value of sid only.
//echo $sessid."<br><br>";
//		$raw_status = substr($raw_return, strpos($raw_return,"&")); // The rest of the returned value starting at the "&" ("&status=...")
//echo $raw_status."<br><br>"; 
		$status = substr($raw_status, 8, 7); // 7 characters starting at position 8 (immediately after the "&status=")...will be "success" if it is, if it's not then it failed.
//echo $status."<br><br>";
	}
?>
