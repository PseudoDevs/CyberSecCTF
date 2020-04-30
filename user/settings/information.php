<?php 
include($_SERVER['DOCUMENT_ROOT']."/auth/auth.php");
$current_user = current_user();
//$login_activity = login_activity();
$fullname     = ($current_user['fullname']);
$username     = ($current_user['username']);
$email        = ($current_user['email']);
$password     = ($current_user['password']);
$bio          = ($current_user['bio']);
$profile      = ($current_user['profile']);
$facebook     = ($current_user['facebook']);
$twitter      = ($current_user['twitter']);
$github       = ($current_user['github']);
$hackerone    = ($current_user['hackerone']);
$bugcrowd     = ($current_user['bugcrowd']);
$team_name    = ($current_user['team_name']);
$CSRF_TOKEN   = $_SESSION['CSRF_TOKEN'];

if (isset($_POST['submit'])) {

  $name       = escape_string($_POST['fullname']);
  $username   = escape_string($_POST['username']);
  $facebook   = escape_string($_POST['facebook']);
  $twitter    = escape_string($_POST['twitter']);
  $github     = escape_string($_POST['github']);
  $hackerone  = escape_string($_POST['hackerone']);
  $bugcrowd   = escape_string($_POST['bugcrowd']);
  $bio        = escape_string($_POST['bio']);

  if ($CSRF_TOKEN != $_POST['CSRF_TOKEN']) {
    echo permission_denined('Error!','sorry you\'re unauthorized to perform an action.',400);
  }else{
    update_username($username); 
    update_info($name,$facebook,$twitter,$github,$hackerone,$bugcrowd,$bio);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
  
<?php 
include(ROOT.'includes/navigation.php'); 
?>
<!--/.Navbar -->

      <style type="text/css">
        #profile{
          height: 100%;
        }
        .img-profile{

        }
        .response-img{
          height: 100px;
          width: 100px;
          border-radius: 50%;
        }
        .edit-profile{
          padding-left: 0px;
          padding-top: 30px;
        }
        .info{
          float: right;
          width: 80%;
        }
        .update{
          float: right;
        }
        a{
          color:#fff;
        }
        a:hover{
          color:#fff;
        }
      </style>
<!--/.Navbar -->

      <main>
        <div class="container"> 
          <section>
            <div class="row mt-5">
              <?php include("settings.php"); ?>
              <div class="col-lg-8 col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div id="profile" class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>Profile</p>
                      </div>
                      <div class="card-body">
                        <form action="" method="POST">
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Name</label>
                              <input type="text" class="form-control" name="fullname" value="<?php echo ($fullname); ?>" >
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Username</label>
                              <input type="text" class="form-control" name="username" value="<?php echo ($username); ?>">
                            </div>
                          </div>
                          <div class="row">
                             <div class="col-sm-12">
                              <label class="card-text">
                                  <b>Warning</b>: Changing your username is permanent. Your old username will be blacklisted, and you will not be able to reclaim it. Additionally, you won't be able to change your username again until after 2020-05-08.</label>
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Facebook</label>
                              <input type="text" class="form-control" name="facebook" value="<?php echo ($facebook); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Twitter</label>
                              <input type="text" class="form-control" name="twitter" value="<?php echo ($twitter); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Github</label>
                              <input type="text" class="form-control" name="github" value="<?php echo ($github); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">BugCrowd</label>
                              <input type="text" class="form-control" name="bugcrowd" value="<?php echo ($bugcrowd); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">HackerOne</label>
                              <input type="text" class="form-control" name="hackerone" value="<?php echo ($hackerone); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="comment">Bio</label>
                              <textarea class="form-control" rows="5" name="bio"><?php echo ($bio); ?></textarea>
                            </div>
                          </div>
                          <input type="hidden" name="CSRF_TOKEN" value="<?php echo $CSRF_TOKEN; ?>">
                          <div class="update">
                            <input type="submit" name="submit" class="btn btn-primary" value="Update">
                          </div>
                        </form>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
<?php 
include(ROOT.'includes/footer.php'); 
?>

  </body>
</html>