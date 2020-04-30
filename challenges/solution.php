<?php
include("auth/auth.php");
//$markdown = markdown();
$id = escape_string($_GET['id']);
$Challenges = select_report($id);
$comment_challenge  = comment_challenges($id);
$current_user       = current_user();
$role               = ($current_user['role']);
$challenge_id       = ($Challenges['challenge_id']);
$author_name        = ($Challenges['author_name']);
$target             = ($Challenges['target']);
$category           = ($Challenges['category']);
$level              = ($Challenges['level']);
$challenge_status   = ($Challenges['challenge_status']);

$report_id          = ($Challenges['report_id']);
$challenger_name    = ($Challenges['challenger_name']);
$start_time         = ($Challenges['start_time']);
$end_time           = ($Challenges['end_time']);
$start_date         = ($Challenges['start_date']);
$end_date           = ($Challenges['end_date']);
$points             = ($Challenges['points']);
$solution           = ($Challenges['solution']);
$duration           = ($Challenges['duration']);
$submited_status    = ($Challenges['submited_status']);
$solver_rank        = ($Challenges['solver_rank']);
$challenger_pic     = ($Challenges['challenger_profile']);

   if ($username === $challenger_name || $username === $author_name || $role === "Stuff") {
      //visible to challenger,author & stuff
    }else{
      echo permission_denined('Error!','sorry but you don\'t have permission to this report',401);
    }

      if (isset($_POST['submit'])) {

        $set_status = $_POST['set_status'];
        $comments = urlencode($_POST['comments']);
        $member_name = $username;
        $CSRF_TOKEN = $_POST['CSRF_TOKEN'];

        if ($CSRF_TOKEN != $_SESSION['CSRF_TOKEN']) {
          echo permission_denined('Error!','sorry you don\'t have permission to perform an action.',400);
        }else{
          comments($set_status,$challenger_name,$author_name,$member_name,$challenge_id,$report_id,$comments,$start_date,$start_time,$end_date,$end_time,$level);
        }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Report | <?php echo $report_id ?></title>
<?php 
  include("includes/navigation.php");
?>
  <style type="text/css">
    body{
    background: #1d1e22;
    color: #fff;
  }
  </style>
<div class="container" style="color: white">
  <div class="col-lg-12">
    <div class="header">
      <div class="row"  style="background: ">
        <div class="col-lg-8 profile" style="padding: 10px 0 10px 30px; ">
          <div class="row">
            <img src="/img/<?php echo $challenger_pic ?>" style="height: 60px;width: 60px; border-radius: 50%;">
            <label style="padding: 10px;margin-top: 10px;font-size: 20px"><b><a href=""><?php echo $challenger_name ?></a></b></label>
          </div>
        </div>
        <div class="col-lg-4 text-center" style="padding-top: 20px">
          <div class="row">
            <div class="col-sm-6">
              <p class="text">Earned Points</p>
              <div class="line"></div>
              <p class="text">
                <?php 
                if ($points != NULL) {
                  echo $points; 
                }else{
                  echo "-";
                }
                
                ?></p>
            </div>
            <div class="col-sm-6">
              <p class="text">Solvers Rank</p>
              <div class="line"></div>
              <p class="text"><?php echo $solver_rank; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="line"></div>
      <div class="row" style="background: ">
        <div class="col-lg-8" style="padding: 30px 0 20px 50px;">
          <div class="row">
            <p>Status: <a href=""><?php echo $submited_status ?></a></p>
          </div>
          <div class="row">
            <p>Start Date: <a href=""><?php echo $Challenges['start_date_full'] ?></a></p>
          </div>
          <div class="row">
            <p>End Date: <a href=""><?php echo $Challenges['end_date_full'] ?></a></p>
          </div>
          <div class="row">
            <p>Submited to: <a href=""><?php echo $author_name; ?></a></p>
          </div>
          <div class="row">
            <p>Submited by: <a href=""><?php echo $challenger_name ?></a></p>
          </div>
        </div>
        <div class="col-lg-4" style="padding: 30px 0 20px 50px;">
          <div class="row">
            <p>Challenge: <a href="">#<?php echo $challenge_id ?></a></p>
          </div>
          <div class="row">
            <p>Level: <a href="">Meduim</a></p>
          </div>
          <div class="row">
            <p>Category: <a href=""><?php echo $category ?></a></p>
          </div>
          <div class="row">
            <p>Duration:
              <?php 
              if ($duration != NULL ) {
                echo $duration;
              }else{
                echo "-";
              }
             ?>
               
             </p>
          </div>
          <div class="row">
            <p>target: <a href=""><?php echo "{$Challenges['target']}" ?></a></p>
          </div>
        </div>
      </div>
    </div>
    <?php     ?>
    <div class="timeline">
      <div class="timeline-month">
        <a href=""><?php echo $challenger_name ?></a> Submited Solution to <a href="">#<?php echo $challenge_id; ?></a>.
      </div>
      <div class="timeline-section">
        <div class="timeline-status">
          <div class="box-item"><a href=""><?php echo $challenger_name; ?></a> added a comment</div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="timeline-box">
              <div class="box-title">
                 Solution
              </div>
              <div class="box-content">
                <div class="box-item">
                  <article class="markdown-body entry-content" itemprop="text"> 
                    <?php
                    echo $markdown->convertToHtml($solution);
                    ?>
                  </article>
                </div>
              </div>
              <div class="box-footer">- <a href=""><?php echo $challenger_name; ?></a></div>
            </div>
          </div>
        </div>
      </div>
      <!-- comments -->
<?php
  if(num_rows($comment_challenge) > 0){
    while($comment = fetch_assoc($comment_challenge)) {
      //$comment = fetch_assoc($comment_challenge);
      $type = escape_string($comment['type']);
      $comments = escape_string($comment['comment']);
      $member_name = escape_string($comment['member_name']);
      $challenger = escape_string($Challenges['challenger_name']);
      $points = escape_string($Challenges['points']);
      $timestamp = escape_string($comment['timestamp']);
      echo comment_challenge($type,$comments,$member_name,$challenger,$points,$markdown,$timestamp);
    }
  }
?>
      <!-- comments -->
    </div>
    <form action="" method="POST">
      <div class="container pb-cmnt-container">
        <div class="row">
            <div class="col-lg-12 col-md-offset-3">
                <div class="box-comment">
                  <select name="set_status" class="option">
                    <?php   
                      if ($_SESSION['username'] == $challenger_name) {
                        echo '
                        <option value="Comment">Add comment</option>
                        <option value="Closed">Closed</option>
                        ';
                      }else{
                        echo '
                        <option value="Comment">Add comment</option>
                        <option value="Accept">Add to solver</option>
                        <option value="Declined">Decline</option>
                        <option value="Spam">Spam</option>
                        <option value="Closed">Closed</option>
                        ';
                      }
                    ?>
                  </select>
                  <textarea name="comments" placeholder="Enter your comments" class="pb-cmnt-textarea"></textarea>
                  <input type="hidden" name="CSRF_TOKEN" value="<?php echo($_SESSION['CSRF_TOKEN']) ?>">
                  <div class="col-lg-6">
                    See here to how to use <a href="/docs/markdown.html">Markdown Doc.</a>
                  </div>
                  <div class="btn-right">
                    <button type="submit" name="submit" class="btn btn-success">Add comment</button>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <?php 
      ?>
  </div>
</div>
<script type="text/javascript" src=""></script>

</body>
</html>