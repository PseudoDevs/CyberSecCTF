<?php 
require_once($_SERVER['DOCUMENT_ROOT']."auth/auth.php");
$handler->start_session('_session', true);

$id = $_GET['id'];
$user = query("SELECT * FROM members WHERE username = '{$id}'");

$current_user = fetch_assoc($user);
$description = $current_user['fullname']." (".$current_user['username'].")";
//var_dump($user);
if (num_rows($user) == 0) {
  //echo('404 not found');
  http_response_code(404);
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <title> <?php echo escape_string($current_user['username']);?> | Profile  </title>
  
  <meta charset="UTF-8">
  <meta name="description" content="<?php echo escape_string($description);?> | Practice your Hacking Skills Here | PH Capture the Flag by Pseudo-X | Basic Challenges | All Web CTF Problems">
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
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet"-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/font-awesome/css/fontawesome-all.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.lite.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/mdb.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/global-ctf.css">
  <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
  <?php include($_SERVER['DOCUMENT_ROOT']."includes/navigation.php") ?>
      <main>
        <div class="container"> 
          <section>
            <div class="row mt-5">
              
              <div class="col-lg-4 col-md-12" style="position: relative;">
                <!-- Section: Basic Info -->
                <section class="note note-danger card card-cascade narrower mb-4 text-center  special-color-dark text-white">
                    <div class="img-card">
                      <a href="/<?php echo escape_string($current_user['username']);?>"><img src="/img/<?php echo escape_string($current_user['profile']) ?>" alt="" class="card-img-top"></a>
                    </div>
                    <!-- Card content -->
                    <div class="card-body card-body-cascade">
                        <!-- Title -->
                      <h4 class="card-title">
                        <strong><?php echo escape_string($current_user['fullname']) ?></strong>
                      </h4>
                      <p class="dark-white-text bio"><?php echo escape_string($current_user['bio']) ?></p>
                        <!-- Social -->
                      <a href="<?php echo escape_string($current_user['facebook']) ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-facebook-f grey-text"></i></a>
                      <a href="<?php echo escape_string($current_user['twitter']) ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-twitter grey-text"></i></a>
                      <a href="<?php echo escape_string($current_user['github']) ?>" type="button" class="btn-floating btn-small waves-effect waves-light"><i class="fab fa-github grey-text"></i></a>
                        <!-- Text -->
                        <hr class="my-3 success-color">
                      <button type="button" class="btn btn-danger btn-rounded btn-sm waves-effect waves-light" data-toggle="modal" data-target="#modalContactUser">
                        <?php 
                          if ($current_user['role'] == "Stuff") {
                            echo "Stuff Member";
                            echo('<i class="fas fa-user-ninja ml-2"></i>');
                          }elseif ($current_user['role'] == "member" && $current_user['status'] == "veryfied") {
                            echo "veryfied Member"; 
                            echo '<i class="fas fa-check"></i>';
                          }else{
                            echo "Member"; 
                          }
                        ?>
                      </button>
                    </div>
                </section>
                <!-- Section: Basic Info -->
                <!-- Team  -->
              <?php /*
              if($team_name){?>
                <section class="note note-danger card-cascade narrower mb-4 text-center  special-color-dark text-white">
                    <div class="card-body">
                      <h5 class="text-center mb-4">
                          <strong>Group Team</strong>
                      </h5>
                        <hr class="my-3 success-color">
                      <div class="team-section">
                          <img src="img/avatar.png" alt="" class="team-profile">
                        </div>
                      <div class="team-name">
                          <strong>
                            <?php 
                              echo escape_string($team_name); 
                            ?>
                          </strong>
                      </div>
                    </div>
                </section>
                <?php
                }else{
                  echo "<!-- Team -->";
                }*/
                ?>

                <!-- Section: Experience -->
                <section class="note note-danger card mb-4 special-color-dark text-center white-text">
                    <div class="card-body">
                      <h5 class="text-center mb-4">
                          <strong>Achievements</strong>
                      </h5>
                        <hr class="my-3 success-color">
                      <div class="row">
                          <div class="col-sm-6">
                            <p class="text">Total Solved</p>
                                <hr class="hr dark-color">
                            <p class="text">
                              <?php 
                                if($current_user['total_solved'] != null){
                                   echo escape_string($current_user['total_solved']);
                                }else{
                                  echo "-";
                                }
                               ?>
                            </p>
                          </div>
                          <div class="col-sm-6">
                            <p class="text">Average points</p>
                              <hr class="hr dark-color">
                            <p class="text">-</p>
                          </div>
                      </div>
                        <hr class="">
                      <div class="row">
                          <div class="col-sm-6">
                            <p class="text">Total points</p>
                              <hr class="hr dark-color">
                            <p class="text"><?php echo escape_string($current_user['total_points']) ?></p>
                          </div>
                          <div class="col-sm-6">
                            <p class="text">Team Points</p>
                              <hr class="hr dark-color">
                            <p class="text">
                              <?php 
                              /*
                                if($team_points){
                                   echo escape_string($team_points);
                                }else{
                                  echo "-";
                                }*/ 
                               ?>
                            </p>
                          </div>
                      </div>
                        <hr class="">
                      <div class="row">
                          <div class="col-sm-6">
                            <p class="text">Rank</p>
                              <hr class="hr dark-color">
                            <p class="text">
                              <?php 
                                if($current_user['rank'] < 100){
                                   echo escape_string($current_user['rank']);
                                }else{
                                  echo "-";
                                }
                               ?>
                            </p>
                          </div>
                          <div class="col-sm-6">
                            <p class="text">Team rank</p>
                              <hr class="hr dark-color">
                            <p class="text">
                              <?php /*
                                if($team_rank){
                                  echo escape_string($team_rank);
                                }else{
                                  echo "-";
                                } */
                              ?>
                            </p>
                          </div>
                      </div>
                      <hr class="">
                    </div>
                </section>
                <!-- Section: Experience -->
              </div>
              
              <div class="col-lg-8 col-md-12 text-center">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <p>About Ph.Hitachi</p>
                      </div>
                      <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text">Hi, I'm Ph.Hitachi this is not all about me, this all about what you think about me.</p>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
                  <?php 
/*
* User Challenges
*/
$result = query("SELECT * FROM posted_challenges WHERE author_name = '{$id}'");

 if(num_rows($result) > 0){
    while($challenge = fetch_assoc($result)) {
      $challenge_id = escape_string($challenge['challenge_id']);
      $author_name = escape_string($challenge['author_name']);
      $category = escape_string($challenge['category']);
      $level = escape_string($challenge['level']);
      //$policy = escape_string($challenge['policy']);
      $posted_at = escape_string($challenge['posted_date']);

?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-header">
                        <span class="text"><?php echo escape_string($category) ?></span>
                        <span class="badge badge-pill badge-danger btn-rounded pd-5"> <?php echo  time_elapsed_string($challenge['timestamp']) ?></span> 
                          <span class="dropdown float-right">
                            <span class="dropdown-toggle" data-toggle="dropdown">&nbsp;</span>
                            <div class="dropdown-menu dropdown-menu-right dropdown-success special-color-dark success-color">
                              <a class="dropdown-item text-success" href="#"><i class="fa fa-copy"></i>  Copy Link</a>
                              <a class="dropdown-item text-success" href="#"><i class="fa fa-hide"></i>  Hide this post</a>
                              <div class="dropdown-divider" style="background-color: grey;"></div>
                              <a class="dropdown-item text-success" href="#"><i class="fa fa-report"></i> Find report for this post</a>
                            </div>
                          </span>
                          <span class="float-right">Challenge #<?php echo escape_string($challenge_id) ?></span>
                        
                      </div>
                      <div class="card-body">
                        <a href="/challenges/<?php echo escape_string($challenge_id); ?>" class="btn btn-danger pd-1 view-challenge">View challenge</a>
                      </div>
                      <div class="card-footer text-muted">
                        <p class="mb-0">
                          <span class="text">Author :</span> 
                          <span class="text-danger"><?php echo escape_string($author_name); ?> </span>
                          <span class="">&nbsp; | &nbsp;Posted at <?php echo escape_string($posted_at); ?> &nbsp; | &nbsp;Level &nbsp;</span>
                          <?php 
                            if($level == "Hard"){
                              echo '<span class="badge badge-pill badge-danger"> Hard </span>';
                            }elseif ($level == "Meduim") {
                              echo '<span class="badge badge-pill badge-warning"> Meduim </span>';
                            }elseif ($level == "Easy") {
                              echo '<span class="badge badge-pill badge-success"> Easy </span>';
                            }
                          ?>

                        </p>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
<?php 
    }
  }
?>
                  
              </div>
            </div>
          </section>
        </div>
      </main>
  <!-- Main layout -->

  <!-- Footer -->
<?php include($_SERVER['DOCUMENT_ROOT'].'includes/Footer.php'); ?>

  </body>
</html>
