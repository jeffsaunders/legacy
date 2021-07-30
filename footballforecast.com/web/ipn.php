<?php
include_once('includes/config.inc.php');

$test=0;

$req = 'cmd=_notify-validate';

foreach ($_POST as $key => $value) {
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
$mail_content.=$key.': '.$value.'
';
}

foreach ($_SERVER as $key=>$value) {
$mail_content.=$key.': '.$value.'
';
}
//mail('frelyz@yahoo.com,owner@frely.net','posted var from paypal',$mail_content);
mail('jeff@nr.net','posted var from paypal',$mail_content);

// post back to PayPal system to validate
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
//$header .= "POST /testing/ipntest.php HTTP/1.0\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
//$domain='www.sandbox.paypal.com';
if($test==1) {
	$domain='216.113.169.205';
	$business_email='ffc@jogjamultimedia.com';
}
else {
	$domain='footballforecast.com';
	$business_email='billing@footballforecast.com';
}
//$domain='66.111.61.145';
//$fp = fsockopen ('216.113.169.205', 80, $errno, $errstr, 30);
$reply=$domain.'-'.$business_email.'
';

// assign posted variables to local variables
$item_name = $_POST['item_name'];
$item_number = $_POST['item_number'];
$payment_status = $_POST['payment_status'];
$payment_amount = $_POST['mc_gross'];
$payment_currency = $_POST['mc_currency'];
$txn_id = $_POST['txn_id'];
$receiver_email = urldecode($_POST['receiver_email']);
$payer_email = $_POST['payer_email'];
$invoice=$_POST['invoice'];

$custom_var=urldecode($_POST['custom']);
$temp=explode(',',$custom_var);
$handicapper=$temp[0];
$member=$temp[1];
unset($temp);

$temp=explode('-',$invoice);
$order_id=$temp[count($temp)-1];



if ($_POST['payment_status']=='Completed' && $receiver_email==$business_email) {
	$sql=array();
	if($item_number=='PicksForTheMonth') {
        $subscription_status='Monthly';
		$interval='30 DAYS';
	}
	else {
        $subscription_status='Season';
		$interval='ENTIRE SEASON';
	}
/*	
    $query="SELECT * FROM subscription WHERE md5(CONCAT('ffc_',user_id))='".$member."' AND handicapper=".$handicapper;
    $sql[]=$query;
    $result=mysql_query($query);
    if($result && mysql_num_rows($result)) {
        $data=mysql_fetch_array($result);
        if($data['expire']>=date('Y-m-d')) {
            $query="UPDATE subscription SET `date`=CURDATE(), type='".$subscription_status."', `expire`=CURDATE()+ INTERVAL ".$interval." WHERE no='".$data['no']."'";
            mysql_query($query);
        }
        else {
            $query="UPDATE subscription SET `date`=CURDATE(), type='".$subscription_status."', `expire`=CURDATE()+ INTERVAL ".$interval." WHERE no='".$data['no']."'";
            mysql_query($query);
        }
        $sql[]=$query;
    }
    else {
        //get user id first
        $query="SELECT login_id FROM member WHERE md5(CONCAT('ffc_',login_id))='".$member."'";
        $result=mysql_query($query);
        $data=@mysql_fetch_array($result);
        $sql[]=$query;
        $query="INSERT INTO subscription SET `date`=CURDATE(), user_id='".$data['login_id']."', handicapper='".$handicapper."', type='".$subscription_status."', expire=CURDATE() + INTERVAL ".$interval."";
        mysql_query($query);
        $sql[]=$query;
    }
*/
//	mail('frelyz@yahoo.com,gwe@frely.net','verified ipn',implode('
//	mail('winner@footballforecast.com,jeff@nr.net','verified ipn',implode('
//
//',$sql).'
//'.$mail_content);
	mail('winner@footballforecast.com,jeff@nr.net','verified ipn',$mail_content);
// check the payment_status is Completed
// check that txn_id has not been previously processed
// check that receiver_email is your Primary PayPal email
// check that payment_amount/payment_currency are correct
// process payment
}

?>
