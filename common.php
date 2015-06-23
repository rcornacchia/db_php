<?php
	// display errors/debugging
	ini_set('display_errors', 'On');

	// connection to database
	// don't forget to close database connection using mysqli($conn)
	$dburl = "cs4111.cfziojgqxy1i.us-east-1.rds.amazonaws.com:3306";
	$dbuser = "rlc2160";
	$dbname = "cs4111";
	$conn = mysqli_connect($dburl, $dbuser, $dbpassword, $dbname);

?>