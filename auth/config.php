<?php

$mysqli = mysqli_connect("localhost","root","") or die("No Connection");
mysqli_select_db($mysqli, "pncrtg") or die("No Database name");

function escape_string($String){
	global $mysqli;
	$String = trim($String);
	$String = addslashes($String);
	$String = strip_tags($String);
	$String = htmlentities($String);
	$String = htmlspecialchars($String);
	$String = mysqli_real_escape_string($mysqli, $String);
	return $String;
}

function query($String){
	global $mysqli;
	$string = mysqli_query($mysqli, $String);
	if ($string) {
    	//return true
	} else {
	    echo "Error: [" . $string . "]<br>" . mysqli_error($conn);
	    //exit;
	}
	return $string;
}
function fetch_data($string){

	$result = query($string);
	$row = fetch_assoc($result);
	return $row;
}

function fetch_array($String){
	$string = mysqli_fetch_array($String);
	return $string;
}
function fetch_assoc($String){
	$string = mysqli_fetch_assoc($String);
	return $string;
}
function fetch_all($String){
	$string = mysqli_fetch_all($String,MYSQLI_ASSOC);
	return $string;
}
function num_rows($String){
	$string = mysqli_num_rows($String);
	return $string;
}
?>
