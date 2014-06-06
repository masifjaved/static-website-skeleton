<?php 
require_once($_SERVER['DOCUMENT_ROOT'] .'/../core/inc/recaptchalib.php');

$privatekey = "6LfiwPQSAAAAAGeknrGdsM0CiISWXjMNcHQoelGr";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);
	

if (!$resp->is_valid) {
	echo 'false';	
} else {
	echo 'true';
}
?>
