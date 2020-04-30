<?php
function current_user(){
    $username =  $_SESSION['auth']['username'];
    $session = $_COOKIE['SESSION_TOKEN'];

	$result = query("SELECT * FROM members WHERE username='$username'");
	$row = fetch_assoc($result);
    
    $user_id = escape_string($row['user_id']);
    $fullname = escape_string($row['fullname']);
    $username = escape_string($row['username']);
    $email = escape_string($row['email']);
    $password = escape_string($row['password']);
    $bio = escape_string($row['bio']);
    $profile = escape_string($row['profile']);
    $facebook = escape_string($row['facebook']);
    $twitter = escape_string($row['twitter']);
    $github = escape_string($row['github']);
    $hackerone = escape_string($row['hackerone']);
    $bugcrowd = escape_string($row['bugcrowd']);
    $team_name = escape_string($row['team_name']);
    $rank = escape_string($row['rank']);
    $active = escape_string($row['active']);
    $joined_time = escape_string($row['joined_time']);
    $total_points = escape_string($row['total_points']);
    $total_solved = escape_string($row['total_solved']);
    $role = escape_string($row['role']);
    $status = escape_string($row['status']);
    $session = escape_string($row['session']);

    $current_user = array(
        'user_id' => $user_id,
        'fullname' => $fullname,
        'username' => $username,
        'email' => $email,
        'password' => $password,
        'bio' => $bio,
        'profile' => $profile,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'github' => $github,
        'hackerone' => $hackerone,
        'bugcrowd' => $bugcrowd,
        'team_name' => $team_name,
        'rank' => $rank,
        'active' => $active,
        'joined_time' => $joined_time,
        'total_points' => $total_points,
        'total_solved' => $total_solved,
        'role' => $role,
        'status' => $status,
        'session' => $session
    );

	return $current_user;
}
function MultifactorAuthentacation($username){
    $result = query("SELECT * FROM `2FAuthentacation` WHERE (username='$username' OR email='$username')");
    $row = fetch_assoc($result);

    $MultifactorAuthentacation = array(
        'code'   => $row['code'], 
        'status' => $row['status']
    );
    return $MultifactorAuthentacation;
}
function validate_email($email){
    $encrypt_email = hashes($email,'encrypt');
    $check_email = query("SELECT * FROM members WHERE email='{$encrypt_email}'");
    $row = fetch_assoc($check_email);
    $validate_email = array(
        'email' => hashes($row['email'],'decrypt'), 
    );
    return $validate_email;
}
function activation($username){  
    $result = query("SELECT * FROM activation WHERE (username='$username' OR email='$username')");
    $row = fetch_assoc($result);

    $activation = array(
        'email'   => $row['email'], 
        'username' => $row['username'],
        'token'   => $row['token'], 
        'status'   => $row['status']
    );

    return $activation;
}
function challenge_category(){
    $result =  query("SELECT * from `challenges_category`");
    $row = fetch_assoc($result);

    return $result;
}

function all_challenges(){
	$result = query("SELECT * FROM posted_challenges WHERE privacy='Public' ORDER BY `timestamp` DESC");
 	
    $row = fetch_assoc($result);

    $challenge_id = $row['challenge_id'];
    $author_name = $row['author_name'];
    $category = $row['category'];
    $level = $row['level'];
    $posted_at = $row['posted_date'];
    $timestamp = $row['timestamp'];
	
    $all_challenges = array(
        'result'         => $result,
        'row'            => $row,
        'challenge_id'   => $challenge_id,
        'author_name'    => escape_string($author_name), 
        'category'       => $category, 
        'level'          => $level, 
        'posted_at'      => $posted_at,  
        'timestamp'      => $timestamp,  
    );

    return $all_challenges;
}

function select_report($id){
	$result = query("SELECT * FROM posted_challenges INNER JOIN submited_challenges ON submited_challenges.challenge_id = posted_challenges.challenge_id WHERE submited_challenges.report_id = '$id'");

	$Challenges = fetch_assoc($result);
    $ST = dump_time($Challenges['start_time']);
    $ET = dump_time($Challenges['end_time']);

    $challenge_id = escape_string($Challenges['challenge_id']);
    $author_name = escape_string($Challenges['author_name']);
    $target = escape_string($Challenges['target']);
    $category = escape_string($Challenges['category']);
    $level = escape_string($Challenges['level']);
    $challenge_status = escape_string($Challenges['challenge_status']);

    $report_id = escape_string($Challenges['report_id']);
    $challenger_name = escape_string($Challenges['challenger_name']);
    $start_time = escape_string($ST['time']);
    $start_date = escape_string($Challenges['start_date']);
    $end_time = escape_string($ET['time']);
    $end_date = escape_string($Challenges['end_date']);
    $points = escape_string($Challenges['points']);
    $solution = urldecode($Challenges['solution']);
    $duration = escape_string($Challenges['duration']);
    $submited_status = escape_string($Challenges['submited_status']);
    $solver_rank = escape_string($Challenges['solver_rank']);

    $author_info = query("SELECT * FROM `members` INNER JOIN posted_challenges ON posted_challenges.author_name = members.username WHERE posted_challenges.challenge_id = '$challenge_id'");

    $challenger_info = query("SELECT * FROM `members` INNER JOIN submited_challenges ON submited_challenges.challenger_name = members.username WHERE submited_challenges.challenge_id = '$challenge_id'");

	$author = fetch_assoc($author_info);
    $challenger = fetch_assoc($challenger_info);

    $challenger_profile = escape_string($challenger['profile']);
    $author_profile = escape_string($author['profile']);
    $author_facebook = escape_string($author['facebook']);
    $author_twitter = escape_string($author['twitter']);
    $author_github = escape_string($author['github']);
    $author_hackerone = escape_string($author['hackerone']);
    $author_bugcrowd = escape_string($author['bugcrowd']);

    $select_report = array(
        'challenge_id' => $challenge_id, 
        'author_name' => $author_name, 
        'target' => $target, 
        'category' => $category, 
        'level' => $level,
        'challenge_status' => $challenge_status,
        'report_id' => $report_id,  
        'challenger_name' => $challenger_name,
        'start_time' => $start_time,
        'end_time' => $end_time,
        'start_date' => $start_date,
        'end_date' => $end_date,
        'start_date_full' => $start_date.' at '.$start_time,
        'end_date_full' => $end_date.' at '.$end_time, 
        'points' => $points, 
        'solution' => $solution, 
        'duration' => $duration, 
        'submited_status' => $submited_status, 
        'solver_rank' => $solver_rank, 
        'challenger_profile' => $challenger_profile,
        'author_profile' => $author_profile,
        'author_facebook' => $author_facebook,
        'author_twitter' => $author_twitter,
        'author_github' => $author_github,
        'author_hackerone' => $author_hackerone,
        'author_bugcrowd' => $author_bugcrowd,
    );

    return $select_report;
}

function comment_challenges($id){
    $challenges = select_report($id);
    $report_id = $challenges['report_id'];
    $challenge_id = $challenges['challenge_id'];

    $result = query("SELECT * FROM `comment_challenges` WHERE challenge_id='$challenge_id' AND report_id = '$report_id' ORDER BY id");

    return $result;
}

function view_challenge($id){
	$result = query("SELECT * FROM posted_challenges INNER JOIN members ON posted_challenges.author_name = members.username WHERE posted_challenges.challenge_id='$id'");
 	
    $row = fetch_assoc($result);

    $challenge_id = escape_string($row['challenge_id']);
    $author_name = escape_string($row['author_name']);
    $bio = escape_string($row['bio']);
    $target = escape_string($row['target']);
    $category = escape_string($row['category']);
    $level = escape_string($row['level']);
    $posted_date = escape_string($row['posted_date']);
    $timestamp = escape_string($row['timestamp']);
    $challenge_status = escape_string($row['challenge_status']);
    $privacy = escape_string($row['privacy']);
    $rules = urldecode($row['rules']);
    $profile = escape_string($row['profile']);
    $facebook = escape_string($row['facebook']);
    $twitter = escape_string($row['twitter']);
    $github = escape_string($row['github']);
    $hackerone = escape_string($row['hackerone']);
    $bugcrowd = escape_string($row['bugcrowd']);
    $team_name = escape_string($row['bugcrowd']);

    $view_challenge = array(
        'challenge_id' => $challenge_id,
        'author_name' => $author_name,
        'bio' => $bio,
        'target' => $target,
        'category' => $category,
        'level' => $level,
        'posted_date' => $posted_date,
        'timestamp' => $timestamp,
        'challenge_status' => $challenge_status,
        'privacy' => $privacy,
        'rules' => $rules,
        'profile' => $profile,
        'facebook' => $facebook,
        'twitter' => $twitter,
        'github' => $github,
        'hackerone' => $hackerone,
        'bugcrowd' => $bugcrowd,
        'team_name' => $team_name,
    );

	return $view_challenge;
}

function view_target($id,$challenger_name){
    $result = query("SELECT * FROM submited_challenges WHERE challenger_name='$challenger_name' AND challenge_id='$id'");
    
    $row = fetch_assoc($result);
    return $row;
}


function loginActivity(){
    $current_user = current_user();
    $member_name = $current_user['username'];

    $result = query("SELECT * FROM login_activity WHERE member_name='$member_name'");

    return $result;
}

function count_post(){
    $current_user = current_user();
    $username = $current_user['username'];

    $total  = query("SELECT count(challenge_status) as total_challenges FROM posted_challenges WHERE author_name='$username'");
    $open   = query("SELECT count(challenge_status) as open FROM posted_challenges WHERE author_name='$username' AND challenge_status='Open'");
    $closed = query("SELECT count(challenge_status) as closed FROM posted_challenges WHERE author_name='$username' AND challenge_status='Closed'");

    $total_count = fetch_assoc($total);
    $count_open = fetch_assoc($open);
    $count_closed = fetch_assoc($closed);

    $count = array(
        'total' => $total_count['total_challenges'],
        'open' => $count_open['open'],
        'closed' => $count_closed['closed']
    );

    return $count;
}
function avg_points($challenger_name){
    $avg_easy = query("SELECT avg(points) as easy   FROM submited_challenges WHERE challenger_name='$challenger_name' AND level='Easy'");
    $avg_meduim = query("SELECT avg(points) as meduim FROM submited_challenges WHERE challenger_name='$challenger_name' AND level='Meduim'");
    $avg_hard = query("SELECT avg(points) as hard   FROM submited_challenges WHERE challenger_name='$challenger_name' AND level='Hard'");

    $easy = fetch_assoc($avg_easy);
    $meduim = fetch_assoc($avg_meduim);
    $hard = fetch_assoc($avg_hard);

    $avg_points = array(
        'total' => $easy['easy'],
        'meduim' => $meduim['meduim'],
        'hard' => $hard['hard']
    );

    return $avg_points;
}

function count_solvers($id){
    $solved = query("SELECT count(submited_status) as solved FROM submited_challenges WHERE challenge_id='$id' AND submited_status='Solved'");
    $solvers   = query("SELECT solvers FROM posted_challenges WHERE challenge_id='$id'");

    $submited = fetch_assoc($solved);
    $posted = fetch_assoc($solvers);

    $count_solvers = array(
        'solved' => $submited['solved'],
        'solvers' => $meduim['solvers']
    );

    return $count_solvers;
}

function view_solvers($id){
    $result = query("SELECT * FROM submited_challenges INNER JOIN members ON submited_challenges.challenger_name = members.username WHERE submited_challenges.submited_status = 'Solved' AND submited_challenges.challenge_id='$id' ORDER BY submited_challenges.duration ASc");

    return $result;
}
function view_notif(){
    $username = $_SESSION['auth']['username'];
    $count_unread =  query("SELECT count(*) as unread from `notifications` WHERE status='unread' AND member_name='{$username}'");
    $unread = fetch_assoc($count_unread);

    $notif = query("SELECT * from `notifications` WHERE member_name='{$username}' order by `date` DESC");
    $content = fetch_assoc($notif);

    $view_notif = array(
        'unread' => $unread['unread'], 
        'notif' => $notif,
        'content' => $content['content'], 
    );

    return $view_notif;
}
function redir_notifacation($id){
    $notifications =  query("SELECT * from `notifications` WHERE id='$id'");
    $redirect = fetch_assoc($notifications);

    return $redirect;
}
?>