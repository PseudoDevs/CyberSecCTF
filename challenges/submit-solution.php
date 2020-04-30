<?php 
	include("../auth/auth.php");
    $id 				= escape_string($_GET['id']);
    $row 				= view_challenge($id);

   	$current_user 		= current_user();
   	$view_target 		= view_target($id,$username);

    $challenge_id 		= $row['challenge_id'];
    $author_name 		= $row['author_name'];
    $privacy 			= $row['privacy'];
    $team_name 			= $row['team_name'];
   	$invitation_status	= $view_target['invitation_status'];
   	$submited_status	= $view_target['submited_status'];
   	$report_id			= $view_target['report_id'];
   	$start_time			= $view_target['start_time'];
   	$CSRF_TOKEN			= $_SESSION['CSRF_TOKEN'];

	if ($author_name == $username) {
		echo permission_denined('Error!','sorry but solvers not complete before post solution or writes up make sure your solvers completed <span><a href="" class="text-primary">Learn more.</a></span>',400);
	}	
	if ($privacy === "Public" || $privacy === "Private") {
   		//return true
   	}else{
		echo permission_denined('Access Failed!','sorry this challenge doesn\'t exist',401);
	}
	
	if ($privacy == "Private") {
		if ($start_time == NuLL){
			echo permission_denined('Error!','sorry but you don\'t already accepted this challenge.',400);
		}
	}
	
   	if (isset($_POST['submit_solution'])) {

		$challenger_name = $current_user['username'];
		$solution = urlencode($_POST['solution']);
		$end_date = date("d/m/Y");
		$end_time = date("H:i:s");
		$team_name = $current_user['team_name'];

		if($CSRF_TOKEN == $_POST['CSRF_TOKEN']){
			if (empty($solution)) {
				echo permission_denined('Error!','sorry but your solution is Empty, if it\'s spam we closed your solution as spam and you well be -50 points',400);
			}
			if ($submited_status == "Pending") {
				echo permission_denined('Error!','sorry but you already submited solution.',400);
			}
			elseif($invitation_status != "New") {
				echo permission_denined('Error','sorry, you need to click "start hacking" before submit solution.',400);
			}
			else{
				submit_solution($challenger_name, $solution, $challenge_id, $end_time,  $end_date);
				header("Location: /report.php?id=".$report_id);
			}
		}else{
			echo permission_denined('Error!','sorry you\'re unauthorized to perform an action.',400);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
<?php 
	include("../includes/navigation.php");
?>
<main>
	<div class="container"> 
		<section>
			<form action="" method="POST">
				<div class="col-lg-12">
					<div class="row">
			                <div class="col-md-12">
			                    <div class="card special-color-dark white-text text-left note note-danger" style="height: 700px;">
			                      	<div class="card-header">
				                        <p>
				                        	<span class="text">Submit Solution</span>
				                        	<span class="float-right"> Challenge #<?php echo $challenge_id; ?></span>
				                        </p>
			                    	</div>
				                    <div class="card-body">
				                        <div class="col-lg-12" style="height:100%">
				                        	<textarea name="solution" style="height: 100%;width: 100%;background: #17191B;color:#fff"><?php echo urldecode('hi%20@Ph.Hitachi%0A%0Athis%20is%20my%20query%20%0A%0APoC%3A%0A%0A%21%5B%5D%28https%3A%2f%2fimgur.com%2fr8DpLDe.gif%29%0A%0A'); ?></textarea>
                        					<input type="hidden" name="CSRF_TOKEN" value="<?php echo $CSRF_TOKEN; ?>">
				                        </div>
				                    </div>
			                      	<div class="card-footer text-muted">
				                        <p class="mb-0">
				                        	<div class="btn-right">
				                        		<a href="">Markdown</a>
				                        	</div>
				                        	<buttin type="submit" class="text">Write</buttin> 
				                        	<span class="text">&nbsp;|&nbsp;</span> 
				                        	<buttin type="submit" class="text">Preview</buttin>
				                        </p>
			                    	</div>
			                      	<div class="card-footer text-muted">
				                        <p class="mb-0">
				                        	<div class="btn-right">
			                        			<button class="btn btn-danger pd-1 view-challenge" type="submit" name="submit_solution">Start Hacking</button>
				                        	</div>
				                        </p>
			                    	</div>
			                	</div>
			                	<br/>
			                </div>
			            </div>
			        </div>
				</div>
			</form>
		</section>
	</div>
</main>
<?php 
	include("../includes/Footer.php");
?>