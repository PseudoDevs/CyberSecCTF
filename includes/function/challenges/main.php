<?php 
  require_once($_SERVER['DOCUMENT_ROOT']."auth/auth.php");

  $id               = escape_string($_GET['id']);
  $view_target      = view_target($id,$username);
  $current_user     = current_user();
  $view_challenge   = view_challenge($id);

  $challenge_id     = $view_challenge['challenge_id'];
  $author_name      = $view_challenge['author_name'];
  $bio              = $view_challenge['bio'];
  $target           = $view_challenge['target'];
  $category         = $view_challenge['category'];
  $level            = $view_challenge['level'];
  $posted_date      = $view_challenge['posted_date'];
  $timestamp        = $view_challenge['timestamp'];
  $status           = $view_challenge['challenge_status'];
  $privacy          = $view_challenge['privacy'];
  $rules            = $view_challenge['rules'];
  $profile          = $view_challenge['profile'];
  $facebook         = $view_challenge['facebook'];
  $twitter          = $view_challenge['twitter'];
  $github           = $view_challenge['github'];
  $hackerone        = $view_challenge['hackerone'];
  $bugcrowd         = $view_challenge['bugcrowd'];
  $c_username       = $current_user['username'];
  $c_team_name      = $current_user['team_name'];
  $role             = $current_user['role'];
  $target_status    = $view_target['target_status'];
  $CSRF_TOKEN       = $_SESSION['CSRF_TOKEN'];
?>