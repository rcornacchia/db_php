<?php
	require_once "common.php";
	
	// get email from login page
	$email = $_SESSION["email"];

	// get school name from previous page
	$sname = $_REQUEST['schoolName'];

	// check to see if the teacher has already added school
	

	// perform query
	$query = sprintf("SELECT Teachers.tname FROM Teachers WHERE Teachers.temail = '%s'", $email);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	$row = $result->fetch_assoc();

	print "Welcome " . $row["tname"];

?>