<?php
header('Content-Type: application/json');
//error_reporting(E_ALL);
//ini_set('display_errors',1);
function isAjax() {
		return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
}

if (!isAjax()) 
{
	echo json_encode(array("status"=>false, "msg"=>'Sorry, but there has been a security error. Please try again'));
	exit();
}

require_once($_SERVER['DOCUMENT_ROOT'] . '/../core/inc/global.php');
require_once(CORE .'inc/recaptchalib.php');

$privatekey = "6LfiwPQSAAAAAGeknrGdsM0CiISWXjMNcHQoelGr";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	
$fieldsToValidate = array('fname','email');

if (!$resp->is_valid) {

	echo json_encode(array("status"=>false, "msg"=>'Invalid Captcha'));
	
} else {
	$msg = "";
	foreach ($_POST as $key => $val) {
		if (in_array($key, $fieldsToValidate) && empty($val)) {
			echo json_encode(array("status"=>false, "msg"=>'Invalid Data'));
			exit();
		}
		if (!in_array($key,array('recaptcha_challenge_field','recaptcha_response_field'))) {
			if (is_array($val)) {
				foreach ($val as $subval) {
					$msg .= ucfirst(str_replace('_',' ',$key)) . ' - ' . ucfirst(str_replace('_',' ',$subval)) . "\n\n";
				}
			} else {
				$msg .= ucfirst(str_replace('_',' ',$key)) . ' - ' . ucfirst(str_replace('_',' ',$val)) . "\n\n";
			}
		}
	}
	
	
	$msg = trim($msg);

	//$to = 'info@' . $_SERVER['HTTP_HOST'];
	$to = 'asif.javed@';
	
	
	$fname = ucwords(strtolower($_POST['fname']));	
	$subject = 'Contact Form from ' . $fname;	
	$message = $msg . "\n----------------------------------------------------------------\n\n" .
				'Date Sent : ' . date(DATE_RFC822) . "\n\n" ;
				
	$headers = "From: Contact Form <contact-form@{$_SERVER['HTTP_HOST']}>\n";
	$headers .= "X-Sender: <contact-form@{$_SERVER['HTTP_HOST']}>\n";
	$headers .= "X-Mailer: PHP\n"; 
	$headers .= "X-Priority: 3\n"; //1 Urgent, 3 Normal
	$headers .= "Return-Path: <contact-form@{$_SERVER['HTTP_HOST']}>\n";
	$headers .= "Content-Type: text/plain; charset=ISO-8859-1\n"; 
	//$headers .= "Content-Type: text/plain; charset=UTF-8\n";
	$message = $message; 
	//$message = utf8_wordwrap($message,70);
	
	// Save all contact posts to contact.log
//	if ($f = @fopen(CORE . 'contact.log','a+')) {
//		ob_start();
//		print $message. "\n^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^\n\n";
//		$txt = ob_get_contents();
//		fwrite($f,$txt);
//		fclose($f);
//		ob_end_clean();
//	}
	
	if (mail($to, $subject, $message, $headers)) {
		echo json_encode(array("status"=>true, "msg"=>'Thanks ' . $fname .  ', ' . 'your information has been recieved'));
	} else {
		echo json_encode(array("status"=>false, "msg"=>'Sorry ' . $fname .  ', ' . 'an error occurred when receiving your details. Please phone us'));
	}

}
 
?>
