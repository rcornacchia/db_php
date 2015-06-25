<?php
	require_once "common.php";

	// get email from login page
	$email = $_SESSION["email"];

	// get uid from Users
	$query = sprintf("SELECT Users.uid FROM Users WHERE Users.uemail = '%s'", $email);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	$row = mysqli_fetch_assoc($result);
	$uid = $row['uid']; 

	

	// taught_by
	$query = sprintf("DELETE FROM Taught_By WHERE Taught_By.uid = '%s'", $uid);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	

	// commented on
	$query = sprintf("DELETE FROM Commented_On WHERE Commented_On.uid = '%s'", $uid);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	

	// delete user from Goes_To
	$query = sprintf("DELETE FROM Goes_To WHERE uid = '%s'", $uid);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
	


	// delete user from users
	$query = sprintf("DELETE FROM Users WHERE Users.uid = '%s'", $uid);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	header( 'Location: /index.php' ) ;

?>