<?php 
include("config.php");
$result = query("SELECT posted_challenges.id as challenge_id, posted_challenges.author_name, posted_challenges.target, posted_challenges.category, posted_challenges.level, posted_challenges.challenge_status, submited_challenges.id as report_id, submited_challenges.challenger_name, submited_challenges.start_time, submited_challenges.start_date, submited_challenges.end_time,submited_challenges.end_date, submited_challenges.points, submited_challenges.solution, submited_challenges.duration,submited_challenges.submited_status, submited_challenges.solver_rank
FROM posted_challenges
INNER JOIN submited_challenges ON submited_challenges.challenge_id = posted_challenges.id WHERE submited_challenges.id = '10105'");
$row = fetch_assoc($result);

$report_id = $row['report_id'];
$challenge_id = $row['challenge_id'];
$challenger_name = $row['challenger_name'];
$level = $row['level'];
$start_time = $row['start_time'];
$start_date = $row['start_date'];
$end_date = $row['end_date'];
$end_time = $row['end_time'];

function add_solver($report_id,$challenge_id, $challenger_name,$start_date,$start_time,$end_date,$end_time,$level){

	$t1  = strtotime($start_time);
	$t2 = strtotime($end_time);
	$difference = $t2 - $t1;

  if($difference / 3600 > 0){
	$hour = $difference / 3600;
	$hour = (int)$hour;
	$difference = $difference - ($hour * 3600);
  }else{
	$hour = "00";
  }
	if($difference / 60 > 0){
       $min = $difference / 60;
       $difference = $difference - ($min * 60);
	}else{
       $min = "00";
	}
	function checkString($str){
        if(strlen($str)==1){
        	return "0".$str;
    	}
    	return $str;
	}
	$duration = (checkString($hour).":".checkString($min).":".checkString($difference));
	echo "start_time: ".$start_time;
	echo "<br>";
	echo "end_time: ".$end_time;
	echo "<br>";
	$points = '';
	echo $duration;
	
	if($start_date == $end_date){
	    if($level == "Hard"){
	    	if($duration <= "01:00:00"){
	        	$points = 25;
	        
		    }elseif ($duration <= "02:00:00") {
		       echo $points = 24;
		        
		    }elseif ($duration <= "03:00:00") {
		        $points = 23;
		        
		    }elseif ($duration <= "04:00:00") {
		        $points = 22;
		        
		    }elseif ($duration <= "05:00:00") {
		        $points = 20;
		        
		    }else{
		        $points = 15;
		        
		    }
	    }elseif ($level == "meduim") {
	    	if($duration <= "01:00:00"){
	        	$points = 15;
	        
	    	}elseif ($duration <= "02:00:00") {
	        	$points = 14;
	        
	    	}elseif ($duration <= "03:00:00") {
	        	$points = 13;
	        
	    	}elseif ($duration <= "04:00:00") {
	        	$points = 12;
	        
	    	}elseif ($duration <= "05:00:00") {
	        	$points = 10;
	        
	    	}else{
	        	$points = 7;
	        
	      }
	    }elseif ($level == "easy") {
	    	if($duration <= "01:00:00"){
	        	$points = 7;
	        
	    	}elseif ($duration <= "02:00:00") {
	        	$points = 6;
	        
	    	}elseif ($duration <= "03:00:00") {
	        $points = 5;
	        
	    	}elseif ($duration <= "04:00:00") {
	        	$points = 5;
	        
	    	}elseif ($duration <= "05:00:00") {
	        	$points = 3;
	        
	    	}else{
	    	    $points = 1;
	        
	    	}
	    }
	    echo "<br";
	    echo "Total Points: ". $points;
	}
  //query("UPDATE submited_challenges SET points='$points' where challenge_id='$challenge_id' and challenger_name='$challenger_name'");

}
add_solver($report_id,$challenge_id, $challenger_name,$start_date,$start_time,$end_date,$end_time,$level);
?>