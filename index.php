<?php 
$email = "ph.hitachi@yahoo.com";
function hide_email($email){
	$mail_name = explode("@", $email);
    $email_length = strlen($mail_name[0]);
    $mail_name[0] = substr($email, 0, 2).str_repeat('*', $email_length - 2);

    return implode("@", $mail_name);
}

echo hide_email($email);
?>