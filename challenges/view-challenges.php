<?php 
	include("../auth/auth.php");
    $id 				= escape_string($_GET['id']);
   	$view_target 		= view_target($id,$username);
   	$current_user 		= current_user();
    $view_challenge 	= view_challenge($id);

    $challenge_id 		= $view_challenge['challenge_id'];
    $author_name 		= $view_challenge['author_name'];
    $bio 				= $view_challenge['bio'];
    $target 			= $view_challenge['target'];
    $category 			= $view_challenge['category'];
    $level 				= $view_challenge['level'];
    $posted_date 		= $view_challenge['posted_date'];
    $timestamp	 		= $view_challenge['timestamp'];
    $challenge_status 	= $view_challenge['challenge_status'];
    $privacy 			= $view_challenge['privacy'];
    $rules 				= $view_challenge['rules'];
    $profile 			= $view_challenge['profile'];
    $facebook 			= $view_challenge['facebook'];
    $twitter 			= $view_challenge['twitter'];
    $github 			= $view_challenge['github'];
    $hackerone 			= $view_challenge['hackerone'];
    $bugcrowd 			= $view_challenge['bugcrowd'];
   	$c_username 		= $current_user['username'];
   	$c_team_name 		= $current_user['team_name'];
   	$role		 		= $current_user['role'];
	$CSRF_TOKEN         = CSRF_Token();


    $challenge = query("SELECT * FROM posted_challenges WHERE challenge_id ='$id'");
   	if (num_rows($challenge) == 0) {
		echo permission_denined('Access Failed!','sorry this challenge doesn\'t exist',401);
   	}

   	if ($privacy == "Private") {
   		if ($role == "Stuff") {
   			//visible to stuff member
   		}
   		elseif($username == $author_name){
   			//visible to author
   		}elseif ($view_target['invitation_status'] != "Invited") {
			echo permission_denined('Access Failed!','sorry you\'re not invited to this challenge',401);
		}
   	}
   	
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
			<div class="row mt-5">
				<div class="col-lg-8 col-md-12 text-center">
	                <div class="row">
	                	<div class="col-md-12">
		                    <div class="card special-color-dark white-text text-left note note-danger">
			                    <div class="card-header">
			                        <p>Note</p>
			                    </div>
			                    <div class="card-body">
			                        <h5 class="card-title"></h5>
			                        <p class="text">All challenges is based on time, to be pair the Target is hidden if you don't click the "Start Hacking".</p> 
			                        <p>but if you click the start hacking the timer will be started.</p>
			                    </div>
		                    </div>
		                    <br/>
	                	</div>
	                </div>
	                <div class="row">
		                <div class="col-md-12">
		                    <div class="card special-color-dark white-text text-left note note-danger">
		                      	<div class="card-header">
			                        <p>
			                        	<span class="text"><?php echo $category; ?></span>
			                            <span class="badge badge-pill badge-danger btn-rounded pd-5"> <?php echo time_elapsed_string($timestamp); ?> </span> 
			                        	<span class="float-right"> Challenge #<?php echo $challenge_id ?></span>
			                        </p>
		                    	</div>
			                    <div class="card-body">
			                        <article  class="markdown-body entry-content" itemprop="text">
			                         	<?php echo $markdown->convertToHtml(urldecode($rules)); ?>
			                         </article>
			                        <p class="card-text">Target: 
			                        <?php 
			                        	if ($view_target['target_status'] == "View") {
			                        		echo $target;
			                        	}elseif ($author_name == $c_username) {
			                        		echo $target;
			                        	}else{
			                        		echo ' <span><a id="signup-now" class="text-primary">Please Click Start Hacking</a></span>';
			                        	}
			                        ?>
			                        </p>
			                        <?php 
			                        	if ($author_name == $c_username) {
				                        		echo '
					                        <form action="" method="POST">
					                        	<button class="btn btn-danger pd-1 view-challenge" type="submit" name="start_hacking">Closed your Challenge</button>
					                        </form>';
				                        	}elseif ($view_target['target_status'] == "View") {
				                        		echo '
					                        	<a href="submit-solution.php?id='.$challenge_id.'" class="btn btn-danger pd-1 view-challenge">Submit Solution</a>';
				                        	}else{
				                        		echo '
				                        	<form action="" method="POST">
				                        		<button class="btn btn-danger pd-1 view-challenge" type="submit" name="start_hacking">Start Hacking</button>
				                        	</form>';
			                        	}

			                        ?>
			                    </div>
		                      	<div class="card-footer text-muted">
			                        <p class="mb-0">
			                        	<span class="text">Author :</span> 
			                        	<span class="text-danger"><?php echo ($author_name);?> </span>
			                        	<span class="">&nbsp; | &nbsp;Posted at <?php echo ($posted_date);?> &nbsp; | &nbsp;Level &nbsp;</span>
			                        	<?php 
				                            if($level == "Hard"){
				                              echo '<span class="badge badge-pill badge-danger"> Hard </span>';
				                            }elseif ($level == "Meduim") {
				                              echo '<span class="badge badge-pill badge-warning"> Meduim </span>';
				                            }elseif ($level == "Easy") {
				                              echo '<span class="badge badge-pill badge-success"> Easy </span>';
				                            }
				                        ?>
			                        </p>
		                    	</div>
		                	</div>
		                	<br/>
		                </div>
		            </div>
				</div>
    			<div class="col-lg-4 col-md-12" style="position: relative;">
	                <!-- Section: Experience -->
	                <?php 
	                if ($c_username == $author_name) {

	                $all_member = query("SELECT * FROM members WHERE NOT username='$c_username' AND NOT role='Stuff'");

	                ?>
	                <section id="invitation" class="note note-danger card card-cascade narrower mb-4 text-center  special-color-dark text-whit" style="max-height: 457px;height: 457px;overflow-x: hidden;overflow-y: auto;">
	                	<input class="form-control" id="" type="text" style="margin-bottom: 10px" placeholder="Search..">
	                	<?php 
	                	if(num_rows($all_member) > 0){
                          while ($row = fetch_assoc($all_member)){ 
                        ?>
	                    <div class="row">
	                    	<div class="col-lg-8" style="padding-left: 10%">
	                    		<div class="row">
			                    	<div class="profile">
			                    		<img src="/img/<?php echo $row['profile'] ?>" style="height: 50px;width: 50px;border-radius: 50%">
			                    	</div>
				                    <div class="" style="">
				                    	<p style="padding-top: 5px;margin: 10px"><?php echo $row['username'] ?></p>
				                    </div>
	                    		</div>
		                    </div>
		                    <div class="col-lg-4" style="margin-top: 10px">
		                    		<?php

		                    			$member_name = $row['username'];
		                    			//$_SESSION[$member_name] = $member_name;

		                    			$check_invitation = view_target($id,$member_name);
		                    			if ($check_invitation['invitation_status'] == "Invited") {
		                    				echo '
		                    		<button style="border:1px solid green;padding: 5px 10px;background: transparent;color: grey;width:80px;cursor:not-allowed">Invited</button>';
		                    			}elseif($username == $row['username']) {
		                    				echo '
		                    		<button style="border:1px solid green;padding: 5px 10px;background: transparent;color: white;width:80px;">You</button>';
		                    			}else{
		                    				echo '
		                    		<form method="POST" action="/challenger/invite">
			                    		<input type="hidden" name="challenger" value="'.$row['username'].'">
			                    		<input type="hidden" name="id" value="'.$challenge_id.'">
			                    		<input type="hidden" name="CSRF_TOKEN" value="'.$CSRF_TOKEN.'">
			                    		<button style="border:1px solid green;padding: 5px 10px;background: transparent;color: white;width:80px" type="submit" name="invite">Invite</button>
			                    	</form>';
		                    			}
		                    		
		                    		?>
		                    </div>
	                    </div>
		                <hr class="hr dark-color">
	                    <?php 
	                    	}
	                    } 
	                    ?>
	                </section>

	                <?php 
	                }else{ 
	                ?>
	                <section class="note note-danger card card-cascade narrower mb-4 text-center  special-color-dark text-white">
	                    <div class="img-card">
	                      <img src="/img/<?php echo ($profile) ?>" alt="" class="card-img-top">
	                    </div>
	                    <!-- Card content -->
	                    <div class="card-body card-body-cascade">
	                        <!-- Title -->
	                      <h4 class="card-title">
	                        <strong><?php echo ($author_name);?></strong>
	                      </h4>
	                      <p class="dark-white-text bio"><?php echo $bio ?></p>
	                        <!-- Social -->
	                      <a href="<?php echo $facebook ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-facebook-f grey-text"></i></a>
	                      <a href="<?php echo $twitter ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-twitter grey-text"></i></a>
	                      <a href="<?php echo $github ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-linkedin-in grey-text"></i></a>
	                        <!-- Text -->
	                        <hr class="my-3 success-color">
	                      <button type="button" class="btn btn-danger btn-rounded btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalContactUser">
	                          Staff Member<i class="fas fa-user-ninja ml-2"></i>
	                      </button>
	                    </div>
	                </section>
	            	<?php } ?>
	                <section class="note note-danger card mb-4 special-color-dark text-center white-text">
	                    <div class="card-body">
	                      <h5 class="text-center mb-4">
	                          <strong>Average Points</strong>
	                      </h5>
	                        <hr class="my-3 success-color">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Hard</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              25-15
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Meduim</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              15-5
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Easy</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              5-1
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                    </div>
	                </section>
	                <!-- Section: Experience -->
            	</div>
			</div>
		</section>
	</div>
</main>
<?php 
	include("../includes/Footer.php");
?>