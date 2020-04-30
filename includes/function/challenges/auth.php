<?php 
	if ($privacy === "Public" || $privacy === "Private") {
   		//return true
   	}else{
		echo permission_denined('Access Failed!','sorry this challenge doesn\'t exist',401);
	}

   	if ($privacy == "Private") {
   		if ($role == "Stuff") {
   			//visible to stuff member
   		}
   		elseif($username == $author_name){
   			//visible to author
   		}elseif ($view_target['invitation_status'] != "Invited") {
			echo permission_denined('Access Failed!','sorry you\'re not invited to this challenge',401);
		}
   }
?>