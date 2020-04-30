<?php 
	require_once("rfc6238.php");
	
	$secretkey = 'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ';  //your secret code
	$currentcode = '571427';  //code to validate, for example received from device

	if (TokenAuth6238::verify($secretkey,$currentcode))
	{
		echo "Code is valid\n";
	}
	else
	{
		echo "Invalid code\n";
	}
	print sprintf('<img src="%s"/>',TokenAuth6238::getBarCodeUrl('Ph.Hitachi','http://localhost',$secretkey,''));

?>