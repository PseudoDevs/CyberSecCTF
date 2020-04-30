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
                  <div class="col-lg-12">
                    <div id="authentacation" class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>Login Activity in last 90 days</p>
                      </div>
                      <div class="card-body">
                      <?php  
                        $login_activity = loginActivity();
                        if(num_rows($login_activity) > 0){
                          while ($row = fetch_assoc($login_activity)){
                      ?>
                        <div class="row">
                          <div class="col-lg-3" style="border-right: 3px solid green;padding-right: 5px;">
                            <div class="row" style="padding-top: 10%;padding-left: 10%">
                              <img src="/img/computer.png">
                            </div>
                          </div>
                          <div class="col-lg-7" style="">
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="pwd">IP: </label> <label for="pwd"><?php echo $row['IP']; ?></label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="pwd">Browser: </label> <label for="pwd"><?php echo $row['browser']; ?></label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="pwd">OS: </label> <label for="pwd">Windows</label>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="pwd">Country: </label> <label for="pwd"><?php echo "{$row['city']}, {$row['country']}"; ?></label><img src="/assets/flags/<?php echo $row['countryCode']; ?>.svg" style="height: 14px;padding-left: 10px;">
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12">
                                <label for="pwd">Date: </label>
                                <label for="pwd"><?php echo $row['date']; ?></label>
                                <label for="pwd"><?php echo time_elapsed_string($row['timestamp']); ?></label>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-2" style="">
                            <button style="padding: 5px;margin-top:70%; border: 2px solid green;background-color: transparent;color: white">See More</button>
                          </div>
                        </div>
                      <hr class="my-3 success-color">
                      <?php 
                        } 
                      }else{
                        echo "Something Wrong with your login activity";
                      }
                      ?>
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