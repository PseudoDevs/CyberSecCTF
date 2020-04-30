<?php 
header("Cache-Control: private, no-cache, no-store, must-revalidate");
header("X-Content-Type-Options: nosniff");
header("Content-Type: text/html; charset=utf-8");
header("Pragma: no-cache");
header("Cache-Control: max-age=0");
header("Vary: origin");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: DENY");
header("X-Frame-Options: SAMEORIGIN");
header("Referrer-Policy: origin");
//header("Access-Control-Allow-Origin: *");
header("Cross-Origin-Resource-Policy: same-origin");
header("X-DNS-Prefetch-Control: off");
header('Expect-CT: max-age=86400, enforce, report-uri="/report"');
header("Strict-Transport-Security: max-age=86400; preload");
if (isset($_SESSION['CSRF_TOKEN'])) {	
	header("X-CSRF-Token-Debug: ".$_SESSION['CSRF_TOKEN']);
}else{
	header("X-CSRF-Token-Debug: ".base64_encode(random_bytes(45)));
}
//header("Content-Security-Policy-Report-Only: default-src https:; report-uri /csp-violation-report-endpoint/");
header_remove("X-Powered-By");
date_default_timezone_set("Asia/Manila");
?>