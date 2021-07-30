<?php 

$status = "<p><strong>Fill Out The Form</strong></p>"; 

if (isset($_POST['submit'])) {
	$qcName = htmlspecialchars(strip_tags($_POST['qc_name']));
	$qcEmail = htmlspecialchars(strip_tags($_POST['qc_email']));
	$qcPhone = htmlspecialchars(strip_tags($_POST['qc_phone']));
	$qcTimeCall = htmlspecialchars(strip_tags($_POST['qc_timeCall']));
	$qcQuestions = htmlspecialchars(strip_tags($_POST['qc_questions']));
	$month = htmlspecialchars(strip_tags($_POST['month']));
	$date = htmlspecialchars(strip_tags($_POST['date']));
	$year = htmlspecialchars(strip_tags($_POST['year']));
	$time = htmlspecialchars(strip_tags($_POST['time']));
	$timestamp = strtotime($month . " " . $date . " " . $year . " " . $time);
	
	$error_list = array();
	
	if(empty($qcName)) {
		$error_list[] = 'Please supply your full name.';	
	}
	
	if(empty($qcEmail)) {
		$error_list[] = 'Please supply a valid email address.';	
	}
	
	if(empty($error_list)) {
	
		if (!get_magic_quotes_gpc()) {
			$qcName = addslashes($qcName);
			$qcEmail = addslashes($qcEmail);
			$qcPhone = addslashes($qcPhone);
			$qcTimeCall = addslashes($qcTimeCall);
			$qcQuestions = addslashes($qcQuestions);
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
					'$qcQuestions',
					'$timestamp'				
					)";
			
		$result = mysql_query($sql) or die ("Can't insert into table quick_contact.<br />" . $sql . "<br />" . mysql_error());
		
		if ($result != false) {
			$status = "Thank you ".$qcName.", We will get with you shortly. ".$qcPhone."";
			
		}
		
		if(empty($qcTimeCall)) {
			$qcTimeCall = "Not Specified";	
		}
		
		//START EMAIL NOTIFICATION
		$current_month = date("F");
		$current_date = date("d");
		$current_year = date("Y");
		$current_time = date("h:i:A");
		
		$to = "jeff.saunders@ewomennetwork.net";
		
		$from = "brandon.mccarthy@ewomennetwork.net";
		$reply = "brandon.mccarthy@ewomennetwork.net";
		
		$subject = "Smart Women Buy Homes - Quick Contact ";
		
		$headers = "From: ". $from ."\r\n";
		$headers .= "Reply-To: ".$reply."\r\n";
		$headers .= "CC: mccarthyhe@gmail.com\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		//START MESSAGE
		$message = '<html><body>';
		//header
		$message .= "<img src=\"http://smartwomenbuyhomes.com/images/misc/qc-email-header.jpg\" width=\"600px\" height=\"75px\" alt=\"PHPR CMS UPDATE\" />";
		$message .= "<br />";
		$message .= "<br />";
		//status
		$message .= "<table rules=\"all\" style=\"border-color: #000;\" cellpadding=\"10\" width=\"600\">";
		$message .= "<tr style=\"background-color:#CFC;\"><td><strong>\"". $qcName ."\" has submitted a contact form.</strong></td></tr>";
		$message .= "</table>";
		$message .= "<br />";
		//title
		$message .= "<table rules=\"all\" style=\"border-color: #000;\" cellpadding=\"10\" width=\"600\">";
		$message .= "<tr style=\"background-color:#000; color:#fff;\"><td><strong>Form Information</strong></td></tr>";
		$message .= "</table>";
		//update info
		$message .= "<table rules=\"all\" style=\"border-color: #000;\" cellpadding=\"10\" width=\"600\">";
		$message .= "<tr><td style='background: #f25b22;color:#fff;'><strong>Sent By:</strong> </td><td>". $qcName ."</td></tr>";
		$message .= "<tr><td style='background: #f25b22;color:#fff;'><strong>Date:</strong> </td><td>". $current_month ." ".$current_date.", ".$current_year." - ".$current_time."</td></tr>";
		$message .= "<tr><td style='background: #f25b22;color:#fff;'><strong>Contact Phone:</strong> </td><td>". $qcPhone ."</td></tr>";
		$message .= "<tr><td style='background: #f25b22;color:#fff;'><strong>Contact Email:</strong> </td><td>". $qcEmail ."</td></tr>";
		$message .= "<tr><td style='background: #f25b22;color:#fff;'><strong>Time To Call:</strong> </td><td>". $qcTimeCall ."</td></tr>";
		$message .= "</table>";
		$message .= "<br />";
		//content	
		$message .= "<table rules=\"all\" style=\"border-color: #000;\" cellpadding=\"10\" width=\"600\">";
		$message .= "<tr style='background: #000;color:#fff;'><td><strong>Comment or Question</strong></td></tr>";//TITLE
		$message .= "<tr><td>". $qcQuestions ."</td></tr>";
		$message .= "</table>";
		$message .= "<br />";
		//admin message 
		$message .= "<table rules=\"all\" border=\"1\" cellpadding=\"10\" width=\"600\">";
		$message .= "<tr><td>This is an automatic response please do not respond to this email.<br /><br />- Systems Administrator</td></tr>";
		$message .= "</table>";
		$message .= "</body></html>";
		//END MESSAGE
		
		if (mail($to, $subject, $message, $headers)) {
			$status = "<p><strong>Email Send Successful</strong></p>";
		} else {
			$status2 = "<p><strong>Email Send Failed</strong></p>";
		}
		//END EMAIL NOTIFICATION	
		
	}else{
	
		$status = "<ul>";
		
		foreach($error_list as $error_message) {
			$status .= "<li>$error_message</li>";	
		}
		
		$status .= "</ul>";
		
	}
	
		
}

?>
<?php echo $status; ?>
                    
<?php
$current_month = date("F");
$current_date = date("d");
$current_year = date("Y");
$current_time = date("H:i");
?>
<form action="index2.php?page=form" method="post">
                        
    <fieldset>
        <p style="display:none;">
        <select name="month" id="month">
            <option value="<?php echo $current_month; ?>"><?php echo $current_month; ?></option>
        </select>
        
        <input type="text" name="date" id="date" size="2" value="<?php echo $current_date; ?>" />
        
        <select>
            <option value="<?php echo $current_year; ?>"><? echo $current_year; ?></option>
        </select>
        
        
        <input type="text" name="time" id="time" size="5" value="<?php echo $current_time; ?>" />
        </p>
                            
        <p>
            <label>Your Name *</label><br />
            <input class="text-input small-input" type="text" id="qc_name" name="qc_name" />
        </p>
        
        <p>
            <label>Your Email *</label><br />
            <input class="text-input small-input" type="text" id="qc_email" name="qc_email" />
        </p>
        
        <p>
            <label>Phone Number</label><br />
            <input class="text-input small-input" type="text" id="qc_phone" name="qc_phone" />
        </p>
        
         <p>
            <label>Best Time to Call You</label><br />
            <input class="text-input small-input" type="text" id="qc_timeCall" name="qc_timeCall" />
        </p>

        <p>
            <label>Comments or Questions</label><br />
            <textarea class="text-input textarea wysiwyg" id="qc_questions" name="qc_questions" cols="30" rows="5"></textarea>
        </p>
        
        <p>
            <input class="button" type="submit" value="submit" name="submit" id="submit" />
        </p>
        
    </fieldset>
    
    <div class="clear"></div><!-- End .clear -->
    
</form>
                    
