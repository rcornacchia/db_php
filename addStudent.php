<?php
	require_once "common.php";
	
	// get email from login page
	$temail = $_SESSION["email"];

	// get Student's email from previous page
	$uemail = $_REQUEST["studentEmail"];

	// get the user id from the student email
	$query = sprintf("SELECT Users.uid FROM Users WHERE Users.uemail = '%s'", $uemail);
	$result = mysqli_query($conn, $query);

	//check to make sure the result was returned
	if(!$result) {
		$message = 'problem with select * from into question type query  ';
		$message = $message . 'Invalid query: ' . mysql_error() . "\n";
	    die($message);
	} else {
		// if user doesn't exist, print message
		$numRows = $result -> num_rows;
		if($numRows == 0) {
			print "User does not exist. Please enter an existing user email.";
			exit();
		}
	}

	// get user id from result
	$row = mysqli_fetch_assoc($result);
	$uid = $row['uid'];

	// query the database to see if the user is already being taught by teacher
	print $uid;
	print "<br>";
	$query = sprintf("SELECT * FROM Teaches_At WHERE Teaches_At.uid = '%s'", $uid);
	$result = mysqli_query($conn, $query);	

	if(!$result) {
					// get teacher tid
			$query = sprintf("SELECT Teachers.tid FROM Teachers WHERE Teachers.temail = '%s'", $temail);
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			$tid = $row['tid']; 
			print("$uid" . "<br>");
			print("$tid" . "<br>");
			// add student to taught_by table
			$query = sprintf("INSERT INTO Taught_By(uid, tid)
			VALUES ('%s', '%s')", $uid, $tid);
			$result = mysqli_query($conn, $query);
				// $message = 'problem with select * from into question type query  ';
		// $message = $message . 'Invalid query: ' . mysql_error() . "\n";
	 //    die($message);

	}else {
		$numRows = $result -> num_rows;
		if($numRows == 0) {

		} else {
			print "User has already been added";
		}
	}
?>