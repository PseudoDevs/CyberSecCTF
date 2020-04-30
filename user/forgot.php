<?php 
session_start();
#error_reporting ( E_ALL ) ;
#ini_set ( 'display_errors' , 0 );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
  
  <meta charset="UTF-8">
  <meta name="description" content="PH Capture the Flag Website | Practice your Hacking Skills Here | PH Capture the Flag by Pseudo-X | Basic Challenges | All Web CTF Problems">
  <meta name="keywords" content="Password | Hack the Flag | Can You Get the Flag ?? |">
  <meta name="author" content="Developed by John Lester Legaspi | Pseudo-X ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="phhacktheflag-TileColor" content="#FFFFFF" />
  <meta name="phhacktheflag-TileImage" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square70x70logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square150x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-wide310x150logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <meta name="phhacktheflag-square310x310logo" content="https://i.postimg.cc/7YpjtCsh/23447380.jpg" />
  <link rel="icon" href="https://i.postimg.cc/7YpjtCsh/23447380.jpg">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.css">
	<link rel="stylesheet" type="text/css" href="/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/css/style.min.css">
  <style type="text/css">
  	#forgot{
  		padding-top: 10%;
  	}
  	.btn-right{
  		float: right;
  	}
  </style>
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
            <a href="/challenges" class="nav-link ctf-challenge" category="Challenges">Challenges</a>
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
            <a href="/inbox" class="nav-link ctf-top-hackers" category="top-hackers">Inbox</a>
          </li>

          <li class="nav-item">
            <a href="/invitation" class="nav-link ctf-top-hackers" category="top-hackers">Invitation</a>
          </li>

          <li class="nav-item">
            <a href="/messages" class="nav-link ctf-top-hackers" category="top-hackers">Sign In</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<main>
    <div class="container"> 
        <section id="forgot">
            <div class="col-lg-12 col-sm-12">
                <div class="row">
                	<div class="col-lg-3">
				    </div>
				    <div class="col-lg-6">
				    	<div id="Change-Email" class="card special-color-dark white-text text-left note note-danger">
				        	<div class="card-header">
				        		<p>Forgot your Password?</p>
				        	</div>
				        	<div class="card-body">
				        		<form action="" id="contact_form" method="POST">
				        			<div class="row col-sm-12">
						          		<p class="card-text">
											<div class="response"></div>
						        		</p>
						        	</div><br />
									<div class="row">
				      					<div class="form-group col-sm-12">
				      						<label for="pwd">Enter your Email</label>
				      						<input type="email" class="form-control" name="email" value="" required>
				      					</div>
								    </div>
								    <div class="row">
										<div class="form-group col-sm-12">
											<img src="/captcha.png" id="captcha" class="captcha-image"> 
											<i class="fas fa-redo refresh-captcha" style="padding-left: 10px"></i>
										</div>
									</div>
								    <div class="row">
				      					<div class="form-group col-sm-4">
				      						<input type="text" name="captcha" class="form-control" placeholder="Enter code" required=""/>
				      					</div>
								    </div>
									<div class="btn-right">
								    	<input type="submit" name="submit" class="btn btn-success" value="Send">
				            		</div>
								</form>
				        	</div>
				      	</div>
				      	<br/>
				    </div>
                	<div class="col-lg-3">
				    </div>
				</div>
            </div>
        </section>
    </div>
</main>
<?php
/*if (isset($_POST['captcha'])) {
	$captcha = $_POST['captcha'];
	$code = $_SESSION['img_session'];
	if($captcha == $code){
		$output = 'captcha code Match!';
		header("inbox");
	}else{
		$output = "Wrong captcha code!";
	}
	
}*/
?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/global-ctf.js"></script>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/js/jquery.min.js"></script>
    <script type="text/javascript" src="/js/mdb.js"></script>
    <script type="text/javascript" src="/js/popper.min.js"></script>
    <script type="text/javascript" src="/js/javascript.js"></script>
    <script type="text/javascript">
	var refreshButton = document.querySelector(".refresh-captcha");
	refreshButton.onclick = function() {
  		document.querySelector(".captcha-image").src = '/captcha.png?' + Date.now();
	}
	</script>
</body>
</html>