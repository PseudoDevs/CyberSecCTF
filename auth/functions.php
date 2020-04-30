<?php 
/*
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
	}
	else{
	    $result = query("SELECT * FROM members WHERE (username='$user' OR email='$user') AND password='$pass'");

	    //$_2FA = MultifactorAuthentacation($username);

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
		    //login_activity($_SESSION['auth']['username']);

	    } else {
			echo ('<script type="text/javascript">alert("wrong username or password")</script>');
	    }
	    if(isset($_SESSION['auth']['username'])) {
	    	echo '{"message":"success"}';
	    	header('Location: /challenges');
	    	exit;
	    }
	}
}
*/
function Register($fullname, $username, $email, $password, $confirm_password){
	
	$error = 0;
	$activation = activation($username);
	$check_email = validate_email($email);
	$check_user = query("SELECT * FROM members WHERE username='$username'");
	$activation_code = base64_encode(random_bytes(100)); //activation token
	if(empty($fullname) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
		if (empty($fullname)) {
			set_msg("fullname is empty",400);
			$error = 1;
		}
		elseif (empty($username)) {
			set_msg("username is empty",400);
			$error = 1;
		}
		elseif (empty($email)) {
			set_msg("email is empty",400);
			$error = 1;
		}
		elseif (empty($password)) {
			set_msg( "password is empty",400);
			$error = 1;
		}
		elseif (empty($confirm_password)) {
			set_msg("confirm password is empty",400);
			$error = 1;
		}
	}elseif (isset($fullname) || isset($username) || isset($email) || isset($password) || isset($confirm_password)) {
		if (isset($fullname)) {
			if (preg_match("/(<|>|{|}|\"|,|\'|\%|\|)/i", $fullname)) {
				set_msg('The <>{}|",\'% characters are not allowed',400);
				$error = 1;
			}
		}
		if(isset($username)) {
			if (num_rows($check_user) > 0) {
				set_msg('The username is already taken, please try new.',400);
			return $error = 1;
			}
			if (preg_match("/(<|>|{|}|\"|,|\'|\%|\|)/i", $username)) {
				set_msg('The <>{}|",\'% characters are not allowed',400);
				$error = 1;
			}
		}
		if(isset($email)) {
			if(!preg_match("/.+@(gmail|yahoo)\.com/i", $email)){
				set_msg("Sorry only gmail & yahoo are allowed email.",400);
				$error = 1;
			}
			if($check_email['email'] == $email) {
				set_msg('The email is already taken, please try new.',400);
				$error = 1;
			}
		}
		if(isset($password) && isset($confirm_password)){
			if ($password != $confirm_password) {
				set_msg("your password not match",400);
				$error = 1;
			}
		}
	}
	return $error;
	
	if($error == 0){
		$email = hashes($email,'encrypt');
		$password = hashes($password,'encrypt');

		query("INSERT INTO members(fullname, email, password, status)VALUES('$fullname','$email','$password','Pending')");
		//send_activation_mail();
		set_msg("Registration successful, please check your inbox.",200);
	}
}

function hashes($data, $method) {
    $salt = substr(hash('sha256', md5('string')), 0, 32); // salt
    $secret_key = md5('!#rA0=31%$@vx^&'); //define private key
    $secret_iv = substr(hash('sha256', $salt.$secret_key.$salt), 0, 32); //secret_iv
    $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB); //iv_size
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND); //create method for iv_size

    if ($method == 'encrypt') {	
    	$output = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $secret_iv, ($data), MCRYPT_MODE_ECB, $iv));
    }elseif ($method == 'decrypt') {
    	$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $secret_iv, base64_decode($data), MCRYPT_MODE_ECB, $iv);
    	$output = rtrim($output, "\0");
    }else{
    	$output = $data; //return to not encrypted/decrypted
    }
    return $output;
}

function getUserIpAddr(){
	if(!empty($_SERVER['HTTP_CLIENT_IP'])){
		//ip from share internet
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
		//ip pass from proxy
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}else{
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	return $ip;
}

function getBrowser(){
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}
   
    return array(
        'userAgent' => $u_agent,
        'browser'	=> $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
}
/*
function session_cookies(){
	
	$HTTPonly		= "HTTPonly";
	$secure			= "secure";
    $xs_value		= base64_encode(random_bytes(32));
    $_SESSION['SESSION_TOKEN'] 	= base64_encode(random_bytes(100));

    setcookie("xs", $xs_value, time() + (86400 * 30), "/");
    setcookie("user_id", $_SESSION['auth']['user_id'], time() + (86400 * 30), "/");
    setcookie("SESSION_TOKEN", $_SESSION['SESSION_TOKEN'], time() + (86400 * 30), "/");
}
*/
function CSRF_Token(){
	//$CSRF_TOKEN = substr(hash('sha256', md5(random_bytes(32))), 0, 32);
	//return $CSRF_TOKEN;
}

function PATH_HISTORY(){
	$_SESSION['PATH_HISTORY'] = $_SERVER['REQUEST_URI'];
	if (preg_match("/(http?s:\/\/|\/\/)/i", $_SESSION['PATH_HISTORY'])) {
		$_SESSION['PATH_HISTORY'] = preg_replace("/(http?s:\/\/|\/\/)/i", '/', $_SESSION['PATH_HISTORY']);
		setcookie("PATH_HISTORY", $_SESSION['PATH_HISTORY'], time() + (86400 * 30), "/");
	}
	return $_SESSION['PATH_HISTORY'];
}
function hide_email($email){
	$mail_name = explode("@", $email);
    $email_length = strlen($mail_name[0]);
    $mail_name[0] = substr($email, 0, 2).str_repeat('*', $email_length - 2);

    return implode("@", $mail_name);
}
function login_activity($member_name){
	$ua = getBrowser();
	$ipAddr = getUserIpAddr();

	$geoIP = json_decode(file_get_contents("http://ip-api.com/json/$ipAddr?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query"), true);

	$continent = $geoIP['continent'];
	$country = $geoIP['country'];
	$continentCode = $geoIP['continentCode'];
	$countryCode = $geoIP['countryCode'];
	$city = $geoIP['city'];
	$zip = $geoIP['zip'];
	$lat = $geoIP['lat'];
	$lon = $geoIP['lon'];
	$timezone = $geoIP['timezone'];
	$isp = $geoIP['isp'];
	$as = $geoIP['as'];
	$asname = $geoIP['asname'];
	$IP = $geoIP['query'];
	$UA = $ua['userAgent'];
	$browser = $ua['browser'] . " " . $ua['version'];
	$OS = $ua['platform'];
	$date = date('F j Y \a\t h:i:s A'); //based on date_default_timezone_set("Asia/Manila");
	$timestamp = date('Y-m-d H:i:sP'); //computer time

	//echo $continent, $country, $countryCode, $city, $zip, $lat, $lon, $timezone, $isp, $as, $asname, $IP, $UA, $browser,$OS, $member_name;
	//var_dump($geoIP);

	query("INSERT INTO `login_activity`(`continent`, `country`, `countryCode`, `city`, `zip`, `lat`, `lon`, `timezone`, `isp`, `as`, `asname`, `IP`, `UA`, `browser`, `OS`, `date`,`timestamp`, `member_name`) VALUES ('$continent', '$country', '$countryCode', '$city', '$zip', '$lat', '$lon', '$timezone', '$isp', '$as', '$asname', '$IP', '$UA', '$browser','$OS', '$date', '$timestamp', '$member_name')");
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );

    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';
	//Get full time
	//echo time_elapsed_string('2013-05-01 00:22:35',true);
	//Get time by timestamp method
	//echo time_elapsed_string('@1367367755'); # timestamp input
	//get normal time diff
	//echo time_elapsed_string('2020-04-01 00:22:35');
}

function dump_time($date){

	$time = date("h:i:s A",strtotime($date));
	$date = date("F j, Y",strtotime($date));
	$full = date('F j, Y, g:i a',strtotime($row['date']));

	$dump_time = array(
		'time' => $time, 
		'date' => $date, 
		'full' => $full, 
	);
	return $dump_time;
}

function img_upload($photo,$type){
	$root = $_SERVER['DOCUMENT_ROOT'];
	$target_dir = $root."img/";
	$basename = basename($_FILES[$photo]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($basename,PATHINFO_EXTENSION));
	$timestamp = random_int(5000, 10000000).(random_int(5000, 10000000))."_" . date("mdYhis") . "_" . date("his");
	$file_name = $timestamp . "_" . md5($basename) .".". $imageFileType;
	// Check if image file is a actual image or fake image
	//if(isset($_POST["submit"])) {
	$check = getimagesize($_FILES[$photo]["tmp_name"]);
	if($check !== false) {
		//echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
		exit;
	}
	//}
	// Check if file already exists
	if (file_exists($basename)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
		exit;
	}
	// Check file size
	if ($_FILES["profile"]["size"] > 500000) {
		exit;
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
		exit;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		exit;
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES[$photo]["tmp_name"], $target_dir.$file_name)) {
					query("UPDATE members set profile='$file_name' where username='{$_SESSION['auth']['username']}'");
					echo "<script type=\"text/javascript\">window.location='/settings/profile/edit';</script>";
			/*switch ($type) {
				case 'member_profile':
					query("UPDATE members set profile='$file_name' where username='{$_SESSION['auth']['username']}'");
					echo "<script type=\"text/javascript\">window.location='/settings/profile/edit';</script>";
					exit;
					break;
				
				case 'blog_thumbnails':
					query("UPDATE blog set thumbnails='$file_name' where username='{$_SESSION['auth']['username']}'");
					echo "<script type=\"text/javascript\">window.location='/settings/profile/edit';</script>";
					exit;
					break;
				
				case 'team_profile':
					query("UPDATE team set profile='$file_name' where admin = '{$_SESSION['auth']['username']}' or editor = '{$_SESSION['auth']['username']}'");
					echo "<script type=\"text/javascript\">window.location='/settings/profile/edit';</script>";
					exit;
					break;
				
				default:
					echo "<script type=\"text/javascript\">alert('Something went wrong')</script>";
					break;
			}*/
		} else {
			echo "Sorry, there was an error uploading your file.";
			exit;
		}
	}
}
function check_username($username,$key){
	$user = query("SELECT username FROM members WHERE username='$username'");
	$email = query("SELECT email FROM members WHERE email='$username'");
	if ($key = 'email') {
		if(num_rows($email) > 0) {
			echo permission_denined('Error','Sorry your username is already exist',400);
		}
	}elseif ($key = 'username') {
		if (num_rows($user) > 0) {
			echo permission_denined('Error','Sorry your username is already exist',400);
		}
	}
}

function update_username($new_username){
	check_username($new_username,'username');
 	query("UPDATE `members` SET `username`='$new_username' WHERE username='{$_SESSION['auth']['username']}'");
	query("UPDATE `posted_challenges` SET `author_name`='$new_username' WHERE author_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `submited_challenges` SET `challenger_name`='$new_username' WHERE challenger_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `login_activity` SET `member_name`='$new_username' WHERE member_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `messages` SET `member_name`='$new_username' WHERE member_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `blog` SET `author_name`='$new_username' WHERE author_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `team_member` SET `member_name`='$new_username' WHERE member_name='{$_SESSION['auth']['username']}'");
	query("UPDATE `comment_challenges` SET `member_name`='$new_username' WHERE member_name='{$_SESSION['auth']['username']}'");
	$_SESSION['auth']['username'] = $new_username;
}

function update_info($name,$facebook,$twitter,$github,$hackerone,$bugcrowd,$bio){
	query("UPDATE `members` SET `fullname`='$name', `facebook`='$facebook',`twitter`='$twitter', `github`='$github', `hackerone`='$hackerone', `bugcrowd`='$bugcrowd', `bio`='$bio' WHERE username='{$_SESSION['auth']['username']}'");
}

function update_email($new_email){
	query("UPDATE `members` SET `email`='$new_email' WHERE username='{$_SESSION['auth']['username']}'");
}

function update_password($new_password){
	query("UPDATE `members` SET `password`='$new_password' WHERE username='{$_SESSION['auth']['username']}'");
}

function comment_challenge($type,$comment,$member_name,$challenger_name,$points, $converter,$timestamp){
	
	switch ($type) {
		case 'Comment':
			$status = '<div class="box-item"><a href="/'.$member_name.'">'.$member_name.'</a> Added a comment.</div>';
			break;
		case 'Accept':
			$status = '<div class="box-item"><a href="/'.$member_name.'">'.$member_name.'</a> awarded <a href="/'.$challenger_name.'">'.$challenger_name.'</a> with <strong>+'.$points.'</strong> Points and added to the solvers</div>';
			break;
		case 'Declined':
			$status = '<div class="box-item"><a href="/'.$member_name.'">'.$member_name.'</a> Decline <a href="/'.$challenger_name.'">'.$challenger_name.'</a> Solution. <strong>-'.$points.'</strong> Points</div>';
			break;
		case 'Spam':
			$status = '<div class="box-item"><a href="/'.$member_name.'">'.$member_name.'</a> Set status to  <a href="">Spam</a> <strong>-'.$points.'</strong> Points</div>';
			break;
		case 'Closed':
			$status = '<div class="box-item"><a href="/'.$member_name.'">'.$member_name.'</a> Set status to  <a href="">Closed</a>.</div>';
			break;
		
		default:
			# code...
			break;

		return $status;

	}

    $comments = urldecode($comment);
echo '<div class="timeline-section">
        <div class="timeline-status">
          '.$status.'
        </div>';
        if($comment != NULL){
echo'   <div class="row">
          <div class="col-lg-12">
            <div class="timeline-box">
              <div class="box-title">
                Comment.
                <div class="float-right">
                ';
                $date = time_elapsed_string($timestamp);
				if ($day == "1 day ago") {
					echo date('F j, Y, g:i a',strtotime($timestamp));
				}else{
					echo $date;
				}
          echo '</div>
              </div>
              <div class="box-content">
                <div class="box-item">
                  <article class="markdown-body entry-content" itemprop="text">
                   '.$converter->convertToHtml($comments).'
                  </article>
                </div>
              </div>
              <div class="box-footer">- <a href="/'.$member_name.'">'.$member_name.'</a></div>
            </div>
          </div>
        </div>';
      }
echo '</div>';

}

function add_comments($member_name,$challenge_id,$report_id,$comment,$type){
    $timestamp =  date('YmdHis');
	query("INSERT INTO `comment_challenges`(`member_name`, `challenge_id`, `report_id`, `comment`, `type`,`timestamp`) VALUES ('$member_name','$challenge_id','$report_id','$comment','$type','$timestamp')");
	//return true;
}

function comments($set_status,$challenger_name,$author_name,$member_name,$challenge_id,$report_id,$comments,$start_date,$start_time,$end_date,$end_time,$level){
	
	$current_user 	= current_user();
	$username 		= ($current_user['username']);
	$status 		= '';

	switch ($set_status) {
        case 'Comment':
	    	if(!empty($comments)){
                $type = $set_status;
            }else{
               	set_msg('you can\'t comment a blank or empty text.',400);
            }
            break;
        case 'Accept':
            if($username != $challenger_name){
                $type = $set_status;
                add_solver($report_id,$start_date,$start_time,$end_date,$end_time,$level);
            }else{
				set_msg('Sorry, there was some error when you add this solvers.',400);
            }
			break;
		case 'Declined':
			if($username != $challenger_name){
                $type = $set_status;
			}else{
				set_msg('Sorry, there was some error when Declined Solution.',400);
			}
			break;
		case 'Spam':
			if($username != $challenger_name){
                //
                $type = $set_status;
			}else{
				set_msg('Sorry, there was some error when set as Spam Solution.',400);
			}
			break;
		case 'Closed':
			if (isset($set_status)) {
                $type = $set_status;
			}else{
				set_msg('Sorry, there was some error when set as Closed Solution.',400);
			}
			break;
            
		default:
			set_msg('Sorry, there was some error when when you add comments please contact us in <a href="mailto:support@localhost.com">support@localhost.com</a>.',400);
		break;

		return $type;
	}
    add_comments($member_name,$challenge_id,$report_id,$comments,$type);
	query("UPDATE `submited_challenges` SET `submited_status`='$type' WHERE challenge_id='$challenge_id' AND report_id='$report_id' AND challenger_name='$challenger_name'");
}

function add_solver($report_id,$start_date,$start_time,$end_date,$end_time,$level){

		$startTime = new DateTime($start_time);
		$endTime = new DateTime($end_time);
		$durations = $startTime->diff($endTime);
		$duration = $durations->format("%H:%I:%S");
		$points = '';
		/*
		if ($start_date == $end_date) {
			return $duration = $durations->format("%H:%I:%S"); 
		}else{
			return $duration = $durations->format("%H:%I:%S"); 
		}
		*/
		if($start_date == $end_date){
		    if($level == "Hard"){
		    	if($duration <= "01:00:00"){
		        	$points = 50;
		        
			    }elseif ($duration <= "02:00:00") {
			        $points = 47;
			        
			    }elseif ($duration <= "03:00:00") {
			        $points = 45;
			        
			    }elseif ($duration <= "04:00:00") {
			        $points = 43;
			        
			    }elseif ($duration <= "05:00:00") {
			        $points = 40;
			        
			    }else{
			        $points = 35;
			        
			    }
		    }elseif ($level == "Meduim") {
		    	if($duration <= "01:00:00"){
		        	$points = 35;
		        
		    	}elseif ($duration <= "02:00:00") {
		        	$points = 33;
		        
		    	}elseif ($duration <= "03:00:00") {
		        	$points = 30;
		        
		    	}elseif ($duration <= "04:00:00") {
		        	$points = 27;
		        
		    	}elseif ($duration <= "05:00:00") {
		        	$points = 25;
		        
		    	}else{
		        	$points = 20;
		        
		      }
		    }elseif ($level == "Easy") {
		    	if($duration <= "01:00:00"){
		        	$points = 15;
		        
		    	}elseif ($duration <= "02:00:00") {
		        	$points = 14;
		        
		    	}elseif ($duration <= "03:00:00") {
		        	$points = 13;
		        
		    	}elseif ($duration <= "04:00:00") {
		        	$points = 12;
		        
		    	}elseif ($duration <= "05:00:00") {
		        	$points = 11;
		        
		    	}else{
		    	    $points = 10;
		        
		    	}
		    }
		}
		query("UPDATE `submited_challenges` SET duration='$duration', points='$points' WHERE report_id='$report_id'");
	
}

function invite_challenger($challenger_name,$author_name,$challenge_id,$privacy){


	query("INSERT INTO `notifications`(`name`, `member_name`, `type`, `content`, `link`, `status`,`date`) VALUES ('$author_name', '$challenger_name', 'invitation','$challenge_id', '/challenges/view-challenges.php?id=$challenge_id','unread',current_timestamp)");

	query("INSERT INTO `challenge_invitation`(`member_name`, `author_name`, `challenge_id`, `status`) VALUES ('$challenger_name', '$author_name', '$challenge_id','Invited')");

	if ($privacy == "Private") {
		query("INSERT INTO `submited_challenges`(`challenger_name`, `challenge_id`, `invitation_status`) VALUES ('$challenger_name', '$challenge_id', 'Invited')");
	}
}


function start_hacking($challenger_name, $challenge_id, $start_date, $start_time, $author_name, $team_name){
  query("INSERT INTO `submited_challenges`(`challenger_name`, `challenge_id`, `start_date`, `start_time`,`target_status`) VALUES ('$challenger_name', '$challenge_id', '$start_date', '$start_time','view')");
}

function submit_solution($challenger_name, $solution,  $challenge_id, $end_time,  $end_date){
    query("UPDATE `submited_challenges` SET challenger_name = '$challenger_name', solution = '$solution', challenge_id = '$challenge_id', end_time = '$end_time', end_date = '$end_date', submited_status= 'Pending' WHERE challenge_id = '$challenge_id' AND challenger_name = '$challenger_name'");
}

function solvers($id){
	$result = view_solvers($id);
      
      if(num_rows($result) > 0){
        $i = 0;
        while($row = fetch_assoc($result)) {
          $report_id = escape_string($row['report_id']);
          $username = escape_string($row['username']);
          $profile = escape_string($row['profile']);
          $points = escape_string($row['points']);
          $duration = escape_string($row['duration']);
          $i++;
          echo "<tr>";
          echo "<td><p>{$i}</p></td>";
          echo "<td><img src=\"/img/{$profile}\" class=\"table-img\">{$username}</td>";
          echo "<td><p>{$points}</p></td>";
          echo "<td><p>{$duration}</p></td>";
          echo "</tr>";
          query("UPDATE submited_challenges SET solver_rank='$i' where report_id='{$report_id}'");
        }
      }else{
        echo "<td colspan=\"4\"><p>No Solvers yet..</p></td>";
      }
}

function notifications(){
	$notifications = view_notif();
	$challenge = view_challenge($notifications['content']);
	echo '<a class="notification nav-link" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
    echo '<i class="fa fa-bell"></i>';
	if($notifications['unread'] > 0){
		echo "<span class=\"badge\">{$notifications['unread']}</span>";
	}
	echo "</a>";
	echo '<div class="dropdown-menu dropdown-menu-right dropdown-success special-color-dark success-color" aria-labelledby="menu1">';

	if(num_rows($notifications['notif'])>0){
    	while ($row = fetch_assoc($notifications['notif'])){
    		echo "<a class=\"dropdown-item text-success\" href=\"/Notification/notification.php?id={$row['id']}\" style =\"";
    		if($row['status']=='unread'){
    			echo "font-weight:bold;";
    		}
    		echo "\">";
    		$name = escape_string($row['name']);
    		$content = escape_string($row['content']);
    		$member_name = escape_string($row['member_name']);

    		if($row['type']=='invitation'){
				echo "{$name} invited you to solve #{$content}";
			}
			else if($row['type']=='team'){
				echo "{$name} invited you become member of <b>{$content}</b>.";
			}
			else if($row['type']=='post'){
				echo "{$name} posted a new challenge.";
			}
			else if($row['type']=='solved'){
				echo "{$name} added you to solvers in #{$content}";
			}
			else if($row['type']=='challenge_comment'){
				if ($name == $challenge['author_name']) {
					echo "{$name} comment on your challenge #{$content}.";
				}else{
					echo "{$name} comment on your submited solution on her challenge";
				}
			}
			else if($row['type']=='blog_comment'){
				echo "{$name} comment on your blog";
			}

			echo "<br/>";
			echo "<small><i>";
			$day = time_elapsed_string($row['date']);
			if ($day == "1 day ago") {
				echo date('F j, Y, g:i a',strtotime($row['date']));
			}else{
				echo $day;
			}
			echo "</i></small>";
			echo "</a>";
			echo '<div class="dropdown-divider"></div>';

    	}
    }else{
        echo "No Notifications";
	}
}
function set_msg($msg,$code)
{
	if ($code == 200) {
    	$_SESSION['MESSAGE'] =  success($msg,$code);
	}elseif ($code == 400) {
    	$_SESSION['MESSAGE'] =  errors($msg,$code);
	}
    //errors();
}

function get_msg()
{
    $msg = $_SESSION['MESSAGE'];
    unset($_SESSION['MESSAGE']);
    return $msg;
}
function postChallenge($author_name,$target,$category,$level,$rules,$privacy,$solvers,$posted_at,$timestamp){
	global $mysqli;
	if (!filter_var($url, FILTER_VALIDATE_URL)) {
		set_msg('The target is not valid please add "https://" or "http://"',400);
	}
	if ($postlimit['open'] == 5) {
		set_msg('sorry but all user are limited 5 post only, before you post again please close at least 1 challenge.',400);
	}
	if (!preg_match("/(Public|Private)/i", $privacy)) {
		set_msg('sorry only Public and Private are allowed to privacy.',400);
	}
	if (!preg_match("/(Hard|Meduim|Easy)/i", $level)) {
		set_msg('sorry only Hard,Meduim,Easy are allowed level.',400);
	}
	if (!preg_match("/(Web Pentesting|SQL injection|Cross-site Scripting|Cryptography|Exploits|Forensics|Networking|Reversing|Services|Steganography)/i", $category)) {
		set_msg('sorry your category are not allowed.',400);
	}
	if (!preg_match("/(5|6|7|8|9|10)/i", $solvers)) {
		set_msg('sorry the minimuin solvers are 5 and maximuim are 10 solvers only.',400);
	}else{
		set_msg('Sorry, There was an error when you set a solvers. ',400);
	}
    if (empty($target) || empty($category) || empty($level) || empty($rules) || empty($privacy)) {
    	if (empty($target)) {
			set_msg('sorry but the target is Empty',400);
    	}
    	if (empty($category)) {
			set_msg('sorry but the category is Empty',400);
    	}
    	if (empty($level)) {
			set_msg('sorry but the level is Empty',400);
	   	}
	   	if (empty($rules)) {
			set_msg('sorry but the rules is Empty',400);
	   	}
	   	if (empty($privacy)) {
			set_msg('sorry but the privacy is Empty',400);
	   	}
	}else{
		//function post_challenge($author_name, $target, $category, $level, $rules, $privacy, $posted_at, $timestamp, $solver){
		query("INSERT INTO `posted_challenges` (`author_name`, `target`, `category`, `level`, `rules`, `privacy`, `posted_date`, `timestamp`, `challenge_status`, `solver`) VALUES ('$author_name', '$target', '$category', '$level', '$rules', '$privacy', '$posted_at','$timestamp','Open', '$solvers')");
		//}
		$last_id = mysqli_insert_id($mysqli);
		echo '{"message":"Success.."}';
		header("Location: /Challenges/".$last_id);
		exit;
	}
}
?>