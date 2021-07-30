<?php

if (isset($_POST['submit'])) {
	$qcName = htmlspecialchars(strip_tags($_POST['first_name']));
	$qcEmail = htmlspecialchars(strip_tags($_POST['last_name']));
	$qcPhone = htmlspecialchars(strip_tags($_POST['middle_name']));
	$qcTimeCall = htmlspecialchars(strip_tags($_POST['prefix_name']));
	$qcQuestion = htmlspecialchars(strip_tags($_POST['title']));
		
	$month = htmlspecialchars(strip_tags($_POST['month']));
	$date = htmlspecialchars(strip_tags($_POST['date']));
	$year = htmlspecialchars(strip_tags($_POST['year']));
	$time = htmlspecialchars(strip_tags($_POST['time']));
	
	$timestamp = strtotime($month . " " . $date . " " . $year . " " . $time);
	
	
	if (!get_magic_quotes_gpc()) {
		$qcName = addslashes($qcName);
		$qcEmail = addslashes($qcEmail);
		$qcPhone = addslashes($qcPhone);
		$qcTimeCall = addslashes($qcTimeCall);
		$qcQuestion = addslashes($qcQuestion);
	}
	
	
	$sql = "INSERT INTO quick_contact (
				qc_name,
				qc_email,
				qc_phone,
				qc_timeCall,
				qc_questions,
				timestamp
				
				) VALUES (
				
				'$qcName',
				'$qcEmail',
				'$qcPhone',
				'$qcTimeCall',
				'$qcQuestion',
				'$timestamp'				
				)";
		
	$result = mysql_query($sql) or die ("Can't insert into table quick_contact.<br />" . $sql . "<br />" . mysql_error());
	
	if ($result != false) {
		$status = "Thank you ".$qcName.", We will get with you shortly.";
		
		header("Location: index2.php?page=form");
	}
	
		
}
?>