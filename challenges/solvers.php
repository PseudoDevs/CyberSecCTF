<?php 
include("../auth/auth.php");

?>
<!DOCTYPE html>
<html>
<head>
	<title> PH Capture the Flag Website for Pentesters | Basic Challenges | All Web CTF Problems  </title>
  <?php 
    include('../includes/navigation.php'); 
  ?>
<body>
<div class="container">       
  <table class="table table-dark table-striped">
    <thead>
      <tr>
        <th>Top</th>
        <th>Challenger</th>
        <th>Total Points</th>
        <th>Duration</th>
      </tr>
    </thead>
    <tbody>
    <?php 
      $id = escape_string($_GET['id']);
      solvers($id);
    ?>
    </tbody>
  </table>
</div>
</body>
<?php include("../includes/Footer.php") ?>