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

  $current_password    = escape_string($_POST['current_password']);
  $new_password        = escape_string($_POST['new_password']);
  $confirm_password    = escape_string($_POST['confirm_password']);

  if ($CSRF_TOKEN != $_POST['CSRF_TOKEN']) {
    echo permission_denined('Error!','sorry you\'re authorized to perform an action.',400);
  }else{  
    if ($current_password != $password) {
      //echo permission_denined('Error!','your current password is not match',400);
    }
    elseif ($password == $new_password) {
      //echo permission_denined('Error!','your password is same with your current password',400);
    }
    elseif ($new_password != $confirm_password) {
      //echo permission_denined('Error!','your confirm password is not match in new password',400);
    }
    elseif ($new_password == $confirm_password) {
      update_password($new_password);
      echo "<script>alert('password change successful')</script>";
      echo "<script>window.location.href='change-password.php'</script>";
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
                    <div id="Change-pass" class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>Change Password</p>
                      </div>
                      <div class="card-body">
                        <div class="col-lg-12">
                          
                        </div>
                        <p class="card-text">
                          <b>Warning: </b>Changing your Password is limited. Your old password will be blacklisted, and you will not be able to use it again. To change your password you need to wait after 3months before you change it again.
                        </p>
                        <form action="" method="POST">
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Current Password</label>
                              <input type="password" class="form-control" name="current_password">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">New Password</label>
                              <input type="password" class="form-control" name="new_password">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-sm-12">
                              <label for="pwd">Confirm Password</label>
                              <input type="password" class="form-control" name="confirm_password">
                            </div>
                          </div>
                          <input type="hidden" name="CSRF_TOKEN" value="<?php echo($CSRF_TOKEN) ?>">
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
    <script type="text/javascript" src="/js/global-ctf.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mdb.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>

  </body>
</html>