<?php 

include(_DIR_FUNCTION."challenges/main.php");

if (isset($_POST['start_hacking'])) {
	$challenger_name = $username;
	$start_date = date("d/m/Y");
	$start_time = date("H:i:s");
	$team_name = $c_team_name;
	if ($view_target['target_status'] == "view") {
		echo permission_denined('Error!','sorry but you already accept the challenge, the timer will be started.',400);
	}else{
		start_hacking($challenger_name, $challenge_id, $start_date, $start_time, $author_name, $team_name);
	}
} 
?>