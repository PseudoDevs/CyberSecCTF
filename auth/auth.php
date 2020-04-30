<?php
error_reporting(0);
date_default_timezone_set("Asia/Manila");
require_once($_SERVER['DOCUMENT_ROOT']."auth/dir.php");
require_once(ROOT.'includes/class/Sessions/inc.session.php');
require_once(ROOT."auth/headers.php");
require_once(ROOT."auth/config.php");
require_once(ROOT."auth/sql.php");
require_once(ROOT."auth/functions.php");
require_once(ROOT."auth/error.php");
require_once(ROOT."auth/markdown.php");
require_once(ROOT."auth/autoload.php");
$handler->start_session('_session', FALSE);

$current_user = current_user();
$username = $current_user['username'];
$session = $_SESSION['SESSION_TOKEN'];
$user_id = $_SESSION['auth']['user_id'];

if (!isset($_SESSION['auth'])) {
	var_dump($_SESSION['auth']);
    header("Location: /user/sign_in");
    echo "Authentacation Failed";
    exit;
}
elseif($_COOKIE['SESSION_TOKEN'] != $session) {
    echo authentacation_error('Authentacation Failed!','Something went wrong on your session.',401); 
}

elseif($_COOKIE['user_id'] != $user_id) {
    echo authentacation_error('Authentacation Failed!','Something went wrong on your session.',401); 
}

elseif($_SESSION['auth']['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
    echo authentacation_error('Authentacation Failed!','you\'re Unauthorized to access this account.',401);
}
elseif($_SESSION['auth']['HTTP_CLIENT_IP'] != getUserIpAddr() && $_SESSION['auth']['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
    echo authentacation_error('Authentacation Failed!','you\'re Unauthorized to access this account.',401);
}

?>