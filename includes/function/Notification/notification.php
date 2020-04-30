<?php 
include($_SERVER['DOCUMENT_ROOT']."auth/auth.php");
$id = escape_string($_GET['id']);
$notifacation = redir_notifacation($id);

$link = $notifacation['link'];
if ($_SESSION['auth']['username'] != $notifacation['member_name']) {
	echo permission_denined('Access Failed!','Something went wrong',401);
}else{
	query("UPDATE notifications set status='read' where member_name='{$_SESSION['auth']['username']}' and id = '$id'");
	header("Location: {$link}");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Redirect 304 </title>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
	<META HTTP-EQUIV="Refresh" CONTENT="0;url=<?php echo($link) ?>">
</head>
<body>
	<p><a href="<?php echo($link)  ?>">Click Here</a></p>
</body>
</html>
<?php 
}
exit; 
?>