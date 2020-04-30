<?php
// let's start the session
session_start();
// get the data from the form
$message = isset($_POST['message']) ? $_POST['message'] : '';
$captcha = isset($_POST['captcha']) ? $_POST['captcha'] : '';
$img_session = isset($_SESSION['img_session']) ? $_SESSION['img_session'] : '';

if($captcha == $img_session){
	$output = "Your message was sent!<br />Thank you!";
	session_destroy();
}else{
	$output = "Wrong captcha code!";
}
echo $output;
?>