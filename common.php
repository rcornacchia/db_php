<?php
	// display errors/debugging
	ini_set('display_errors', 'On');
	// start a session
	session_start();
	// connection to database
	// don't forget to close database connection using mysqli($conn)
	$dburl = "cs4111.cfziojgqxy1i.us-east-1.rds.amazonaws.com";
	$dbuser = "rlc2160";
	$dbpassword = "t3chmark";
	$dbname = "cs4111";
	$conn = mysqli_connect($dburl, $dbuser, $dbpassword, $dbname);
	if(!$conn){
		die ("It didn't work!");
	}



?>
