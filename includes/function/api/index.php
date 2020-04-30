<?php 
include("../auth/auth.php");
$session = $_COOKIE['SESSION_TOKEN'];
$fields = $_GET['fields'];
$table = $_GET['table'];
$members = query("SELECT $fields FROM members where session='$session'");
$row = fetch_assoc($token);
//print_r($row);

echo json_encode($row);
?>