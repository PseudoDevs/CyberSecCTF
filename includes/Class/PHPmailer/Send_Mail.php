<?php
require 'class.phpmailer.php';
function Send_Mail($email,$activation){
	$to = $email;
	$subject = "Email verification";
	$body = 'Hi, <br/> <br/> We need to make sure you are human. Please verify your email and get started using your Website account. <br/> <br/> <a href="https://'.$_SERVER['HTTP_HOST'].'/activation/'.$activation.'">https://'.$_SERVER['HTTP_HOST'].'/activation/'.$activation.'</a>';

	$from				= "localhost@yourwebsite.com";
	$mail       		= new PHPMailer();
	$mail->IsSMTP(true);            // use SMTP
	$mail->IsHTML(true);
	$mail->SMTPAuth   	= true;                  // enable SMTP authentication
	$mail->Host       	= "smtp.gmail.com"; // SMTP host
	$mail->Port       	=  465;                    // set the SMTP port
	$mail->Username   	= "ph.hitachi@gmail.com";  // SMTP  username
	$mail->Password   	= "09326179130";  // SMTP password
	$mail->SetFrom($from, 'From Name');
	$mail->AddReplyTo($from,'From Name');
	$mail->Subject    	= $subject;
	$mail->MsgHTML($body);
	$address 			= $to;
	$mail->AddAddress($address, $to);
	$mail->Send();
}
?>