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
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ff0000;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #00cc00
;
}

input:focus + .slider {
  box-shadow: 0 0 1px #00cc00;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
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
                        <p>Security & Logins</p>
                      </div>
                      <div class="card-body">
                        <h6 class="card-title">
                          <b>Enable Security protections</b>
                        </h6>
                        <p class="card-text">
                          This security protections helps you to secure your account and private info on your accounts
                        </p>
                        <div class="row">
                          <div class="tab col-md-12">
                            <hr class="my-3">
                             <div class="row">
                              <div class="col-lg-10">
                                <div class="row container" style="padding-top: 10px">
                                  <label>Unrecognized Logins Security Alert</label>
                                </div>
                              </div>
                              <div class="col-lg-1" style="">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider"></span>
                                </label>
                              </div>
                            </div>
                            <hr class="my-3">
                             <div class="row">
                              <div class="col-lg-10">
                                <div class="row container" style="padding-top: 10px">
                                  <label>Two-Factor Athentacation</label>
                                </div>
                              </div>
                              <div class="col-lg-1" style="">
                                <label class="switch">
                                  <input type="checkbox" onclick="setTimeout(authentacation, 500)">
                                  <span class="slider"></span>
                                </label>
                              </div>
                            </div>
                            <hr class="my-3">
                             <div class="row">
                              <div class="col-lg-10">
                                <div class="row container" style="padding-top: 10px">
                                  <label>Generate Backup Security Code</label>
                                </div>
                              </div>
                              <div class="col-lg-1" style="">
                                <label class="switch">
                                  <input type="checkbox">
                                  <span class="slider"></span>
                                </label>
                              </div>
                            </div>
                            <hr class="my-3">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
      <script>
function authentacation() {
  window.location.href='/settings/2Fauthentacation';
}
      </script>
 <?php 
include(ROOT.'includes/footer.php'); 
?>
  </body>
</html>