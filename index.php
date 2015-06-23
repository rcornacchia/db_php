<?php
	// if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
	// $uri .= $_SERVER['HTTP_HOST'];
	// header('Location: '.$uri.'/xampp/');
	// exit;

	// echo "My first PHP script";

	$x = 0;
	session_start(); 
	$_SESSION['views'] = $x + 1; // store session data
	echo "Pageviews = ". $_SESSION['views']; //retrieve data



?>