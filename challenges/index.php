<?php 
//define('ROOT', $_SERVER['DOCUMENT_ROOT']);
include("../auth/auth.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
     <!-- Navigation bar -->
      <?php 
      include(ROOT.'includes/navigation.php'); 
      ?>
<main>
    <div class="container"> 
    <!-- Section: Profile -->
    <section>
    <!-- Grid row -->
    <div class="row mt-5">
    <!-- Grid column -->
    <div class="col-lg-4 col-md-12">
  <!-- Section: Basic Info -->
  <!-- Team  -->
  <div class="myBtnContainer">
  <section class="note note-danger card-cascade narrower mb-4  special-color-dark text-white">
    <div class="card-body">
      <h5 class="text-center mb-4">
        <strong>Level</strong>
      </h5>
      <hr class="my-3 success-color">
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input active" name="Level" checked>All
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Level">Hard
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Level">Meduim
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Level">Easy
        </label>
      </div>
    </div>
  </section>
  <section class="note note-danger card-cascade narrower mb-4  special-color-dark text-white">
    <div class="card-body">
      <h5 class="text-center mb-4">
        <strong>Program type</strong>
      </h5>
      <hr class="my-3 success-color">
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Program" checked>All
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Program">Public
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="radio" class="form-check-input" name="Program">Privite
        </label>
      </div>
    </div>
  </section>

  <!-- Section: Experience -->
  <section class="note note-danger card-cascade narrower mb-4  special-color-dark text-white">
    <div class="card-body">
      <h5 class="text-center mb-4">
        <strong>Category</strong>
      </h5>
      <hr class="my-3 success-color">
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Category_all" checked>All
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Web_Pentesting">Web Pentesting
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="SQL_injection">SQL injection
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="XSS">Cross-site Scripting
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Cryptography">Cryptography
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Exploits">Exploits
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Forensics">Forensics
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Networking">Networking
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Reversing">Reversing
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Services">Services
        </label>
      </div>
      <div class="form-check">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="Steganography">Steganography
        </label>
      </div>
    </div>
  </section>
  </div>
  <!-- Section: Experience -->
</div>    <!-- Grid column -->
    <!-- Grid column -->
    <div class="col-lg-8 col-md-12 text-center">
<?php 
/*
* User Challenges
*/
$result = query("SELECT * FROM posted_challenges WHERE privacy='Public' ORDER BY `timestamp` DESC");
$challenge = all_challenges();
 if(num_rows($result) > 0){
    while($row = fetch_assoc($result)) {
      $challenge_id = $challenge['challenge_id'];
      $author_name = $challenge['author_name'];
      $category = $challenge['category'];
      $level = $challenge['level'];
      $posted_at = $challenge['posted_at'];
      $timestamp = $challenge['timestamp'];

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
  }else{
    ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card special-color-dark white-text text-left note note-danger">
                      <div class="card-body">
                        <h5 class="card-title">No Challenges posted yet!</h5>
                          <p class="card-text">
                            No challenges posted yet, post your challenge here?
                          </p>
                        <a href="/CyberSecAdmin/post-challenge.php" class="btn btn-danger pd-1 view-challenge">Post challenge</a>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
    <?php
  }
?>    
</div>
</main>
  <!-- Main layout -->
    <?php include("../includes/Footer.php") ?>