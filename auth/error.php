<?php 
function errors($string,$code){
http_response_code($code);
$text = '
  <div class="col-lg-12">
    <div class="alert">
      <span class="closebtn">&times;</span> 
      '.$string.'
    </div>
  </div>';
  return  $text;
}
function success($string){
$text = '
  <div class="col-lg-12">
    <div class="alert success">
      <span class="closebtn">&times;</span>
      '.$string.'
    </div>
  </div>';
  return  $text;
}
function permission_denined($error,$message,$code){
  http_response_code($code);
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    echo '
<!DOCTYPE html>
<html>
<head>
  <title> ';
  if($code == 400){
    echo "Error: Unauthorized perform an action";
  }elseif($code == 401){
    echo "Permission denined! Unauthorized access";
  }
echo ' </title>';
include($DOCUMENT_ROOT."/includes/navigation.php");
echo  '<div class="container">
      <div class="col-lg-12">
        <div class="alert">
          <p><strong>'.$error.'</strong> '.$message.'</p>
        </div>
      </div>
    </div>    
    <footer class="page-footer font-small pt-0 mt-5" style="position: relative;">
      <!-- Copyright -->
      <div class="footer-copyright py-3 text-center">
        <div class="container-fluid">
          © 2020 Copyright: <a href="" target="_blank"> CyberSEc CTF | PH </a>
        </div>
      </div>
      <!-- Copyright -->
    </footer>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/global-ctf.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mdb.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
  </body>
</html>

    ';
    exit;
}

function authentacation_error($error,$message,$code){
  http_response_code($code);
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'];
    echo '
<!DOCTYPE html>
<html>
<head>
  <title> ';
  if($code == 400){
    echo "Error: Unauthorized perform an action";
  }elseif($code == 401){
    echo "Permission denined! Unauthorized access";
  }
  echo ' </title>
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
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/timeline.css">
</head>
<body>
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark special-color-dark">
    <div class="container">
      <a class="navbar-brand" href="#">CyberSec CTF</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333"
        aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link ctf-home" category="home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/blog" class="nav-link ctf-top-hackers" category="top-hackers">Blog</a>
          </li>

          <li class="nav-item">
            <a href="/tophacker" class="nav-link ctf-top-teams" category="top-teams">Top Hackers</a>
          </li>

          <li class="nav-item">
            <a href="/topteam" class="nav-link ctf-top-hackers" category="top-hackers">Top Team</a>
          </li>

          <li class="nav-item">
            <a href="/invitation" class="nav-link ctf-top-hackers" category="top-hackers">Sing in</a>
          </li>

          <li class="nav-item">
            <a href="/messages" class="nav-link ctf-top-hackers" category="top-hackers">Sign up</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
    <div class="container">
      <div class="col-lg-12">
        <div class="alert">
          <p><strong>'.$error.'</strong> '.$message.'</p>
        </div>
      </div>
    </div>    
    <footer class="page-footer font-small pt-0 mt-5" style="position: relative;">
      <!-- Copyright -->
      <div class="footer-copyright py-3 text-center">
        <div class="container-fluid">
          © 2020 Copyright: <a href="" target="_blank"> CyberSEc CTF | PH </a>
        </div>
      </div>
      <!-- Copyright -->
    </footer>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/global-ctf.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mdb.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
  </body>
</html>

    ';
    exit;
}

 ?>