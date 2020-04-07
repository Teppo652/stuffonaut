<?php
define('VALID_USERNAME', "user");
define('VALID_PASSWORD', "pw");

if(!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != VALID_USERNAME) || ($_SERVER['PHP_AUTH_PW'] != VALID_PASSWORD)) { 
	// show BASIC login form
	header('HTTP/1.1 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="The Social Site"');
	exit("A valid username and password are needed to access this page.");
} else {
	//$err = '';
	//// validate USER and PW against database
	//if($_SERVER['PHP_AUTH_USER'] != 'xxxx') { $err .= 'error'; }
	//if($err == '') {
		echo '<br>Welcome';
	//} else {
	//	// display validation errors
	//	echo 'Please check yout username and password';
	//}
}




?>