<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/../core/inc/global.php');
require_once(CORE .'inc/recaptchalib.php');

$privatekey = "6LfiwPQSAAAAAGeknrGdsM0CiISWXjMNcHQoelGr";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	
	function isAjax() {
	 return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
	}
	function htmlMessage($msg) {
		if (isAjax()) die($msg);
		echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>E-Mailer</title>
<style>
body, html {
	height:100%;
	width:100%;
	margin:0;
	padding:0;
	background-color:#282828;
}
#response {
	margin-top:300px;
	text-align:center;
	color:#FFF;
	font-size:24px;	
}
</style>
</head>
<body>
';
		echo $msg;
		echo '
</body>
</html>
';
		exit();
	}

if (!$resp->is_valid) {
 	htmlMessage('<div id="response">' . _('Sorry, but there has been a security error. Please try again') . '.</div>');
	exit();
	
} else {
	$msg = "";
	foreach ($_POST as $key => $val) {
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
		htmlMessage('<div id="response">' . _('Thanks') . ' ' . $fname .  ', ' . _('your information has been received') . '.</div>');
	} else {
		htmlMessage('<div id="response">' . _('Sorry') . ' ' . $fname .  ', ' . _('an error occurred when receiving your details. Please phone us') . '.</div>');
	}
}
?>
