<?php
include("auth/config.php");
include("auth/sql.php");
include("auth/functions.php");
include("auth/error.php");
$_SESSION['MESSAGE'] = '';
if (isset($_POST['submit'])) {
  $fullname           = $_POST['fullname']; 
  $username           = $_POST['username']; 
  $email              = $_POST['email']; 
  $password           = $_POST['password']; 
  $confirm_password   = $_POST['confirm_password']; 
  Register($fullname, $username, $email, $password, $confirm_password);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
  
  <meta charset="UTF-8">
  <meta name="description" content="PH Capture the Flag Website | Practice your Hacking Skills Here | PH Capture the Flag by Pseudo-X | Basic Challenges | All Web CTF Problems">
  <meta name="keywords" content="Password | Hack the Flag | Can You Get the Flag ?? |">
  <meta name="author" content="Developed by John Lester Legaspi | Pseudo-X ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--meta name="phhacktheflag-TileColor" content="#FFFFFF" />
  <meta name="phhacktheflag-TileImage" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square70x70logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square150x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-wide310x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square310x310logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <link rel="icon" href="https://i.postimg.cc/7YpjtCsh/23447380.jpg">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"-->
  <link rel="stylesheet" type="text/css" href="/css/font-awesome/css/fontawesome-all.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/timeline.css">
  <link rel="stylesheet" type="text/css" href="/css/forms-style.css">
</head>
<body class="login-page">
  <style>
    html,
    body,
    header,
    .view {
      height: 100vh;
    }
    @media (max-width: 740px) {
      html,
      body,
      header,
      .view {
        height: 700px;
      }
    }
    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .view {
        height: 650px;
      }
    }
  </style>
<div class="home-x"></div>
<!-- Intro Section -->

      <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
        <div class="container">
          <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
              <?php echo get_msg(); ?>
              <!-- Form with header -->
              <div class="card wow fadeIn special-color-dark note note-danger" data-wow-delay="0.3s">
                <div class="card-body">
                  <!-- Header -->
                  <div class="form-header danger-color">
                    <h3 class="font-weight-500 my-2 py-1 changeIt"><i class="fa fa-user"></i> SIGN UP</h3>
                  </div> 
                <form method="POST" action="">
                  <!-- Body -->
                  <div class="md-form ctf-fullname">
                    <i class="fa fa-user prefix text-danger"></i>
                    <input type="text" id="ctf-name" name="fullname" class="form-control text-danger" >
                    <label for="ctf-name">Full name</label>
                  </div>
                  <div class="md-form ctf-fullname">
                    <i class="fa fa-user-secret prefix text-danger"></i>
                    <input type="text" id="ctf-username" name="username" class="form-control text-danger" >
                    <label for="ctf-username">Username</label>
                  </div>
                  <div class="md-form ctf-mail">
                    <i class="fa fa-envelope prefix text-danger"></i>
                    <input type="text" id="ctf-email" name="email"  class="form-control white-text" >
                    <label for="ctf-email">Your email</label>
                  </div>
                  <div class="md-form ctf-pass">
                    <i class="fas fa-lock prefix text-danger"></i>
                    <input type="password" id="ctf-password" name="password"  class="form-control white-text">
                    <label for="ctf-password">Your password
                    </label>
                  </div>
                   <div class="md-form ctf-git">
                    <i class="fa fa-lock prefix text-danger"></i>
                    <input type="password" id="github-confirm_password" name="confirm_password" class="form-control white-text">
                    <label for="confirm_password">Confirm password</label>
                  </div>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" name="Steganography">I Agree & Accept the <span> <a href="terms.html" id="login-now" class="text-primary">Terms & Privacy.</a>
                    </label>
                  </div>
                  <div class="text-center">
                   <button class="btn danger-color btn-lg white-text col-md-12" type="submit" name="submit">Sign up</button>
                    <hr class="mt-2 danger-color"></span>
                    <p class="white-text"> Already have an Account? <span> <a href="/user/sign_in" id="login-now" class="text-danger"> LOGIN NOW!</a></span></p>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- Intro Section -->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/mdbx.js"></script>
  <script type="text/javascript" src="js/global-ctf.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/mdb.js"></script>
  <script type="text/javascript" src="js/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/warengonzaga/daisy.js/daisy.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/warengonzaga/daisy.js/daisy.min.js"></script>
  <script type="text/javascript">
  $('.home-x').daisyjs({
    dotColor: '#ff4444',
    lineColor: '#212121'
  });
  var close = document.getElementsByClassName("closebtn");
  var i;

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
      var div = this.parentElement;
      div.style.opacity = "0";
      setTimeout(function(){ div.style.display = "none"; }, 600);
    }
  }
  </script>
</body>
</html>