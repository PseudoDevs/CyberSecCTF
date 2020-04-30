<?php
// let's start the session
session_start();
// get the data from the form
$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
$code = isset($_SESSION['captcha']) ? $_SESSION['captcha'] : '';

if($captcha == $code){
	$output = "Your Email was successfully sent! please check your email<br />";
	session_destroy(); //destroy session to prevent spam
}else{
	$output = "Wrong captcha code!";
}
echo $output;
?>