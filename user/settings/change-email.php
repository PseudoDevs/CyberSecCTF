<?php 
include($_SERVER['DOCUMENT_ROOT']."/auth/auth.php");
$current_user = current_user();
//$login_activity = login_activity();
$fullname     = ($current_user['fullname']);
$username     = ($current_user['username']);
$email        = hide_email($current_user['email']);
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
  $new_email          = escape_string($_POST['email']);
  $veriry_password    = escape_string($_POST['password']);

  if ($CSRF_TOKEN != $_POST['CSRF_TOKEN']) {
    echo permission_denined('Error!','sorry you\'re authorized to perform an action.',400);
  }else{
    if ($password != $veriry_password) {
      echo permission_denined('Error!','your password is incorrect',400);
    }else{
      update_email($new_email);
      echo "<script>alert('email change successful')</script>";
    }
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
      <main>
        <div class="container"> 
          <section>
            <div class="row mt-5">
              <?php include("settings.php"); ?>
              <div class="col-lg-8 col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div id="Change-Email" class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>Change Email</p>
                      </div>
                      <div class="card-body">
                        <p class="card-text">
                          <b>Warning: </b>Changing your Email is need to verify via Entering password.
                        </p>
                        <form action="" method="POST">
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Change your Email</label>
                              <input type="text" class="form-control" name="email" value="<?php echo ($email); ?>">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Your Password</label>
                              <input type="password" class="form-control" name="password">
                            </div>
                          </div>
                          <input type="hidden" name="CSRF_TOKEN" value="<?php echo $CSRF_TOKEN; ?>">
                          <div class="update">
                            <input type="submit" name="submit" class="btn btn-success" value="Verify">
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
    <script type="text/javascript" src="/js/global-ctf.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mdb.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>

  </body>
</html>