<?php 
session_start();
include("auth/config.php");
unset($_COOKIE['SESSION_TOKEN']);
unset($_COOKIE['user_id']);
unset($_COOKIE['PHPSESSID']);
unset($_COOKIE['xs']);
session_destroy();
header("Location: login.php");
 ?>