<!--https://manage.sprintpcs.com/specialoffers/CheckRebate.do?dispatch=checkRebate&phoneNumber=9723335615&zipCode=75094-->

<?






	$params = "?dispatch=checkRebate&phoneNumber=9723335615&zipCode=75094";
	$url = "https://manage.sprintpcs.com/specialoffers/CheckRebate.do";
	$user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$params);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // this line makes it work under https
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//	curl_setopt($ch, CURLOPT_TIMEOUT, 4); // times out after 4 seconds
//	ob_start();
	$result = curl_exec($ch);

	echo '<xmp>'.$result.'</xmp>';
?>