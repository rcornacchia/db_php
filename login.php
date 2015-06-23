<?php
	require_once "common.php";

	$email = $_REQUEST["email"];

	// adding check for user submits blank textbox


	$query = sprintf("SELECT * 
						FROM Users, Teachers
						WHERE Users.uemail = '%s' OR Teachers.temail = '%s'",
						mysql_real_escape_string($email),
						mysql_real_escape_string($email));
	// mysql_real_escape_string

	// Perform Query
	$result = mysql_query($query);


	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	// Use result
	while($row = mysql_fetch_assoc($result)) {
		print_r($row);
	}

?>