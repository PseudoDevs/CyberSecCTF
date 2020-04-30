<?php
require($_SERVER['DOCUMENT_ROOT'].'auth/dir.php');

require(_DIR_CLASS.'Sessions/inc.session.php');
require(_DIR_FUNCTION.'login/index.php');

if(isset($_POST['submit'])) {
  $handler->start_session('_session', FALSE);
  $username = ($_POST['username']);
  $password = ($_POST['password']);
  login($username,$password);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title> Two Factors Authentaccation </title>
  
  <meta charset="UTF-8">
  <meta name="description" content="PH Capture the Flag Website | Practice your Hacking Skills Here | PH Capture the Flag by CyberSec CTF | Basic Challenges | All Web CTF Problems">
  <meta name="keywords" content="Password | Hack the Flag | Can You Get the Flag ?? |">
  <meta name="author" content="Developed by John Lester Legaspi | Pseudo-X ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--meta name="phhacktheflag-TileColor" content="#FFFFFF" />
  <meta name="phhacktheflag-TileImage" content="//i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square70x70logo" content="//i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square150x150logo" content="//i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-wide310x150logo" content="//i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square310x310logo" content="//i.postimg.cc/7YpjtCsh/23447380.jpg" />
    <link rel="icon" href="//i.postimg.cc/7YpjtCsh/23447380.jpg">
  <link href="//fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.11.2/assets/css/all.css">
  <link rel="stylesheet" href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/assets/css/font-awesome.min.css"-->
  <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome/css/fontawesome-all.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/forms-style.css">
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

              <!-- Form with header -->
            
              <div class="card wow fadeIn special-color-dark note note-danger" data-wow-delay="0.3s">
                <div class="card-body">
                  <!-- Header -->
                  <div class="form-header danger-color">
                    <h3 class="font-weight-500 my-2 py-1 changeIt">Reset Your 2FA</h3>
                  </div> 
               
                  <form method="post" action="">
                  <!-- Body -->
                    <div class="form-content">
                      <h2 class="white-text">Two Factor Authentication</h2>
                      <p class="white-text">Reset your 2Factor Authentacation we send to your email after 24hours, and you can cancel it in case you find your recovery backup code.</p>
					           </div>

                  <div class="text-center">
                    <input type="submit" name="submit" class="btn danger-color btn-lg white-text col-md-12" value="Reset">
                    <hr class="mt-2 danger-color">
                    <p class="white-text"><span> <a href="/login/authentacation/confirmation" id="signup-now" class="text-primary">Use 6 Digit Code number instead</a></span></p>
                    <p class="white-text"><span> <a href="/login/authentacation/backup" id="signup-now" class="text-primary">Use backup Code instead</a></span></p>
                  </div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
<!-- Intro Section -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/mdbx.js"></script>
<script type="text/javascript" src="/assets/js/global-ctf.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.js"></script>
<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>
<script type="text/javascript" src="/assets/js/mdb.js"></script>
<script type="text/javascript" src="/assets/js/popper.min.js"></script>
<!--script src="//cdn.jsdelivr.net/gh/warengonzaga/daisy.js/daisy.js"></script>
<script src="//cdn.jsdelivr.net/gh/warengonzaga/daisy.js/daisy.min.js"></script-->

<script type="text/javascript">
  $('.home-x').daisyjs({
        dotColor: '#ff4444',
        lineColor: '#212121'
    });
</script>
</body>
</html>