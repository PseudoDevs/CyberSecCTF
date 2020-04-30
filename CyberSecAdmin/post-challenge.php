<?php 
	include("../auth/auth.php");

   	$CSRF_TOKEN = $_SESSION['auth']['CSRF_TOKEN'];
   	if (isset($_POST['POST'])) {
   		if ($CSRF_TOKEN == $_POST['CSRF_TOKEN']) {
			$author_name 	=  $username;
			$target 		=  escape_string(filter_var($_POST['target'], FILTER_SANITIZE_URL));
			$category 		=  escape_string($_POST['category']);
			$level 			=  escape_string($_POST['level']);
			$rules 			=  urlencode($_POST['rules']);
			$privacy 		=  escape_string($_POST['privacy']);
			$solvers 		=  escape_string($_POST['solvers']);
			$posted_at 		=  date("F d, Y");
			$timestamp 		=  date('YmdHis');
			postChallenge($author_name,$target,$category,$level,$rules,$privacy,$solvers,$posted_at,$timestamp);
   		}else{
   			
   		}
	}

?>
<html>
<head>
	<title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>

  <meta charset="UTF-8">
  <meta name="description" content="PH Capture the Flag Website | Practice your Hacking Skills Here | PH Capture the Flag by Pseudo-X | Basic Challenges | All Web CTF Problems">
  <meta name="keywords" content="Password | Hack the Flag | Can You Get the Flag ?? |">
  <meta name="author" content="Developed by John Lester Legaspi | Pseudo-X ">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/css/style.css">
  <link rel="stylesheet" type="text/css" href="/css/timeline.css">
</head>
<style type="text/css">
</style>
<body>
  <nav class="mb-1 navbar navbar-expand-lg navbar-dark special-color-dark">
    <div class="container">
      <a class="navbar-brand" href="#">CyberSec CTF</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-333" aria-controls="navbarSupportedContent-333" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent-333">
        <ul class="navbar-nav ml-auto nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link ctf-home waves-effect waves-light" category="home">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item">
            <a href="/challenges" class="nav-link ctf-challenge waves-effect waves-light" category="Challenges">Challenges</a>
          </li>

          <li class="nav-item">
            <a href="/blog" class="nav-link ctf-top-hackers waves-effect waves-light" category="top-hackers">Blog</a>
          </li>

          <li class="nav-item">
            <a href="/tophacker" class="nav-link ctf-top-teams waves-effect waves-light" category="top-teams">Top Hackers</a>
          </li>

          <li class="nav-item">
            <a href="/topteam" class="nav-link ctf-top-hackers waves-effect waves-light" category="top-hackers">Top Team</a>
          </li>

          <li class="nav-item">
            <a href="/inbox" class="nav-link ctf-top-hackers waves-effect waves-light" category="top-hackers">Inbox</a>
          </li>

          <li class="nav-item">
            <a href="/invitation" class="nav-link ctf-top-hackers waves-effect waves-light" category="top-hackers">Invitation</a>
          </li>

          <li class="nav-item">
            <a href="/messages" class="nav-link ctf-top-hackers waves-effect waves-light" category="top-hackers">Messages</a>
          </li>
           <a href="/Ph.Hitachi" class=" waves-effect waves-light"><img src="/img/39700927075352_04072020120506_120506_4807f04b6e5776f3be485dd335ed7435.png" alt="" class="table-img"></a>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-333" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-success special-color-dark success-color" aria-labelledby="navbarDropdownMenuLink-333">
              <a class="dropdown-item text-success waves-effect waves-light" href="/Profile.php">Profile</a>
              <a class="dropdown-item text-success waves-effect waves-light" href="/settings/profile/edit">Settings</a>
              <a class="dropdown-item text-success waves-effect waves-light" href="/terms-and-policy.php">Terms &amp; Policy</a>
              <a class="dropdown-item text-success waves-effect waves-light" href="/logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<!--/.Navbar -->

<main>
	<div class="container"> 
		<section>
			<div class="row mt-5">
				<div class="col-lg-8 col-md-12 text-center">
	                <div class="row">
		                <div class="col-md-12">
		                	<form action="" method="POST">

		                    <div class="card special-color-dark white-text text-left note note-danger">

		                      	<div class="card-header">
			                        <p>
			                        	<span class="text">Post challenge here</span>
			                        </p>
		                    	</div>
		                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
								    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Easy</button>
								    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Meduim</button>
								    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
								</div>
								<div class="row">
									<div class="row">
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
									</div>
									<div class="row">
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
									</div>
									<div class="row">
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
				                    	<div class="btn-group btn-group-xs" style="width: 400px; height: 50px; padding: 5px;">
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Tricky</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Waff</button>
										    <button type="button" class="btn btn-primary waves-effect waves-light" style="padding: 5px;">Hard</button>
										</div>
									</div>
								</div>
			                    <div class="card-body">
			                        <div class="row col-lg-12">
			                            <div class="form-group col-lg-12">
			                            	<input type="text" class="form-control" name="target" value="https://target.com" placeholder="your target here">
			                            </div>
			                        </div>
			                        <div class="row col-lg-12">
			                            <div class="form-group col-lg-12">
			                            	<label class="">Category:</label>
			                            	<select name="category">
			                            		<?php 
			                            			$challenge_category = challenge_category();    			
													if (num_rows($challenge_category)>0) {
														while($row = fetch_assoc($challenge_category)){
															echo "<option value=\"{$row['category']}\">{$row['category']}</option>";
														}
													} 
			                            		?>
			                            	</select>
			                            	<label class="">Privacy:</label>
			                            	<select name="privacy">
			                            		<option value="Public">Public</option>
			                            		<option value="Private">Private</option>
			                            	</select>
			                            	<label class="">Level:</label>
			                            	<select name="level">
			                            		<option value="Easy">Easy</option>
			                            		<option value="Meduim">Meduim</option>
			                            		<option value="Hard">Hard</option>
			                            	</select><br>	
			                            	<label class="">Solvers:</label>
			                            	<select name="solvers">
			                            		<option value="5">5</option>
			                            		<option value="6">6</option>
			                            		<option value="7">7</option>
			                            		<option value="8">8</option>
			                            		<option value="9">9</option>
			                            		<option value="10">10</option>
			                            	</select>
			                            </div>
			                        </div>
			                        <div class="col-lg-12">
			                        	<textarea name="rules" style="margin-top: 0px;margin-bottom: 0px;height: 400px;width: 100%;border-radius: 10px;background: transparent;/* border: none; */color: white;"><?php echo urldecode('%23%20Rules%0A%0A%2a%2aDescription%2a%2a%0A%0A%2a%2aDon%27t%20use%20the%20following%2a%2a%0A%0A1.%20%0A%0A2.%20%0A%0A3.%20%0A%0A-%20list%201%0A-%20list%202%0A-%20list%203%0A%0A%2a%2aNote%2a%2a%3A%20note%20here'); ?></textarea>
			                    	</div>
					            </div>
					            <input type="hidden" name="CSRF_TOKEN" value="<?php echo($CSRF_TOKEN)?>">
		                      	<div class="card-footer text-muted">
		                      		<div class="float-right">
		                      			<button name="POST" type="submit" class="btn btn-danger">Post</button>
		                      		</div>
		                    	</div>
		                	</div>
		                	</form>
		                </div>
		            </div>
				</div>
    			<div class="col-lg-4 col-md-12" style="position: relative;">
	                <!-- Section: Experience -->
	                <section class="note note-danger card mb-4 special-color-dark text-center white-text">
	                    <div class="card-body">
	                      <h5 class="text-center mb-4">
	                          <strong>Average Points</strong>
	                      </h5>
	                        <hr class="my-3 success-color">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Hard</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              25-15
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Meduim</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              15-5
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                      	<div class="row">
		                        <div class="col-sm-12">
		                            <p class="text">Easy</p>
		                              <hr class="hr dark-color">
		                            <p class="text">
		                              5-1
		                            </p>
		                        </div>
		                    </div>
		                    <hr class="">
	                    </div>
	                </section>
	                <!-- Section: Experience -->
            	</div>
			</div>
		</section>
	</div>
</main>
		<footer class="page-footer font-small pt-0 mt-5" style="position: relative;">
		    <!-- Copyright -->
		    <div class="footer-copyright py-3 text-center">
		      <div class="container-fluid">
		        © 2020 Copyright: <a href="" target="_blank"> CyberSEc CTF | PH </a>
		      </div>
		    </div>
		    <!-- Copyright -->
		</footer>
	    <!--script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script-->
	    <script type="text/javascript" src="/js/global-ctf.js"></script>
	    <script type="text/javascript" src="/js/bootstrap.js"></script>
	    <script type="text/javascript" src="/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="/js/jquery.min.js"></script>
	    <script type="text/javascript" src="/js/mdb.js"></script><div class="hiddendiv common"></div>
	    <script type="text/javascript" src="/js/popper.min.js"></script>
	</body>
</html>