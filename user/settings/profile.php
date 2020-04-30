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

if (isset($_POST['submit'])) {
  $profile    = $_POST['profile'];

  if ($CSRF_TOKEN != $_POST['CSRF_TOKEN']) {
    echo permission_denined('Error!','sorry you\'re authorized to perform an action.',400);
  }else{
    if (!empty($_POST['profile'])) {
      img_upload($profile,'profile');
    }else{
      echo permission_denined('Error!','sorry you\'re you not set profile yet.',400);
    }
    //update_username($username); 
    //update_info($name,$facebook,$twitter,$github,$hackerone,$bugcrowd,$bio);
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
                            <!--h5>Profile settings</h5>
                            <p>This information appears on your public profile, next to your comments, and in any reports that you submit.</p-->
                              <div class="col-sm-12">
                                <div class="img-profile">
                                  <img src="/img/<?php echo ($profile); ?>" class="response-img">
                                  <div class="info">
                                    <h5>Profile settings</h5>
                                    <p class="card-text">This information appears on your public profile, next to your comments, and in any reports that you submit.</p>
                                  </div>
                                </div>
                                <div class="edit-profile">
                                  <input type="file" name="profile"/>
                                </div>
                              </div>
                          </div>
                          <p class="card-text">Picture should be less than 2048x2048px and sized under 1 MB.</p>
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