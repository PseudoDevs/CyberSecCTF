<?php 

include($_SERVER['DOCUMENT_ROOT']."includes/function/challenges/main.php");
if (isset($_POST['invite'])) {
  echo CSRF_Token();
  echo $_POST['CSRF_TOKEN'];
  exit;
  if ($CSRF_TOKEN == $_POST['CSRF_TOKEN']) {
    $challenger       = escape_string($_POST['challenger']);
    $id               = escape_string($_POST['id']);
    $check_invitation = view_target($id,$challenger);
    $challenger_name  = query("SELECT username FROM members WHERE username='$challenger'");

    $challenges_id    = query("SELECT challenge_id FROM posted_challenges WHERE challenge_id='10130' AND author_name='$c_username'");
    $row = fetch_assoc($challenges_id);
    $challenge_id = $row['challenge_id'];

    if (num_rows($challenger_name) == 0) {
        echo permission_denined('Error!','sorry but your challenger invited are not a member',400);
    }
    if (num_rows($challenges_id) == 0) {
      echo permission_denined('Error!','sorry, but the challenge id is not your challenge or doesn\'t exists',400);
    }

    if (empty($challenger)) {
      echo permission_denined('Error!','Sometheng when wrong in invite challenger',400);
    }

    elseif ($check_invitation['invitation_status'] == "Invited") {
      echo permission_denined('Error!','sorry but this challenger is already invited',400);
    }
      
    elseif($challenger == $username) {
      echo permission_denined('Error!','sorry but you\'re not available to invite your self.',400);
    }
    else{
      invite($challenger, $author_name, $challenge_id, $privacy);
    }
  }else{
    echo permission_denined('Error!','sorry your\'re not authorazed to perform an action',400);
  }
}else{
  header("Location: /challenges");
}

  function invite($challenger_name,$author_name,$challenge_id,$privacy){

    query("INSERT INTO `notifications`(`name`, `member_name`, `type`, `content`, `link`, `status`,`date`) VALUES ('$author_name', '$challenger_name', 'invitation','$challenge_id', '/challenges/$challenge_id','unread',current_timestamp)");

    query("INSERT INTO `submited_challenges`(`challenger_name`, `challenge_id`, `invitation_status`) VALUES ('$challenger_name', '$challenge_id', 'Invited')");

    header("location: /challenges/{$challenge_id}");
    echo '{"messages":"success.."}';
    exit;
  }

?>