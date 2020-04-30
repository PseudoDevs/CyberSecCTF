<?php
//require($_SERVER['DOCUMENT_ROOT'].'auth/dir.php');
//require(_DIR_CLASS.'Sessions/inc.session.php');
require(ROOT.'auth/config.php');
require(ROOT.'auth/sql.php');
require(ROOT.'auth/functions.php');

function login($username,$password){
	$user = escape_string($username);
	$pass = hashes($password, 'encrypt');

	if($user == "" || $pass == "") {
	    if (empty($user)) {
	    	echo "Username is empty";
	    }
	    elseif (empty($pass)) {
	    	echo "Password is empty";
	    }
	}else{
	    $result = query("SELECT * FROM members WHERE (username='$user' OR email='$user') AND password='$pass'");

	    $row = fetch_assoc($result);
	    
	    if(num_rows($result)>0) {
		    $_SESSION['auth'] = array(
		        'user_id' => $row['user_id'],
		        'username' => escape_string($row['username']),
		        'HTTP_CLIENT_IP' => getUserIpAddr(),
		        'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT']
		    );

			$_SESSION['CSRF_TOKEN'] = substr(hash('sha256', md5(random_bytes(100))), 0, 100);

		    session_cookies();
		    //login_activity($user);

	    } else {
			set_msg('Wrong Username & Password, Please try again.',400);
		}
	    
	    if(isset($_SESSION['auth']['username'])) {
	    	Check_2FA($user);
	    	echo "{\"message\":\"success..\"}";
	    	exit();
	    }
	}
}

function session_cookies(){
	
	$HTTPonly		= "HTTPonly";
	$secure			= "secure";
    $xs_value		= base64_encode(random_bytes(32));
    $_SESSION['SESSION_TOKEN'] 	= base64_encode(random_bytes(100));

    setcookie("xs", $xs_value, time() + (86400 * 30), "/");
    setcookie("user_id", $_SESSION['auth']['user_id'], time() + (86400 * 30), "/");
    setcookie("SESSION_TOKEN", $_SESSION['SESSION_TOKEN'], time() + (86400 * 30), "/");
}

function Check_2FA($username){
	$result = query("SELECT * FROM google_auth WHERE (username='$username' OR email='$username')");
	$row = fetch_assoc($result);

	if ($row['status'] == "ON") {
		$_SESSION['LOGGED_IN'] = FALSE;
		header("Location: /users/2FAuthentacation/confirmation");
	}elseif($row['status'] == "OFF"){
		$_SESSION['LOGGED_IN'] = TRUE;
		header("Location: /challenges");
	}else{
		$_SESSION['LOGGED_IN'] = TRUE;
		header("Location: /challenges");
	}
}

function Login_2FA($code){

	$checkResult="";
	$code = escape_string($code);	
	$secret = $_SESSION['secret'];

	require_once _DIR_CLASS.'googleLib/GoogleAuthenticator.php';
	$ga = new GoogleAuthenticator();
	$checkResult = $ga->verifyCode($secret, $code, 2);    // 2 = 2*30sec clock tolerance

	if ($checkResult){
		$_SESSION['googleCode']	= $code;
		$_SESSION['LOGGED_IN'] = TRUE;
		header("Location: /HackerDashboard/overview");
	    exit;
	}
	else{
		$_SESSION['MESSAGE'] = errors("Invalid Two Factor Authentacation Code.");
	}

}

function _2FA_backup($code){
	$result = query("SELECT * FROM google_auth WHERE googlecode='$Username'");

	 if(num_rows($result)>0){
		$_SESSION['LOGGED_IN'] = TRUE;
		header("Location: /HackerDashboard/overview");
	 }else{
		$_SESSION['MESSAGE'] = errors("Invalid Recovery backup code.");
	 }
}

function Reset_2FA(){
	$username = $_SESSION['auth']['username'];
	query("UPDATE `google_auth` SET `status`='RESET' WHERE username='$username'");
	header("Location: /user/sign_in");
	session_destroy();
}

function logged_in(){

	if ($_SESSION['LOGGED_IN'] == FALSE) {
		header("Location: /user/sign_in");
		echo "Authentacation failed";
		exit;
	}
	if (!isset($_SESSION['auth'])) {
	    header("Location: /user/sign_in");
	    echo "Authentacation Failed";
	    exit;
	}

	elseif($_COOKIE['SESSION_TOKEN'] != $session) {
	    echo authentacation_error('Authentacation Failed!','Something went wrong on your session, please try to login.',401);
	    session_destroy();
	}

	elseif($_COOKIE['user_id'] != $user_id) {
	    echo authentacation_error('Authentacation Failed!','Something went wrong on your session, please try to login.',401);
	    session_destroy();
	}

	elseif($_SESSION['auth']['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
	    echo authentacation_error('Authentacation Failed!','Your Sessions has been used now in another browser, please login again',401);
	}
	elseif($_SESSION['auth']['HTTP_CLIENT_IP'] != getUserIpAddr() && $_SESSION['auth']['HTTP_USER_AGENT'] != $_SERVER['HTTP_USER_AGENT']) {
	    echo authentacation_error('Authentacation Failed!','you\'re Unauthorized to access this account.',401);
	}

}

?>