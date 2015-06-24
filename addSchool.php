<?php
	require_once "common.php";
	
	// get email from login page
	$temail = $_SESSION["email"];

	// get school name from previous page
	$sname = $_REQUEST['schoolName'];

	// check to see if the teacher has already added school
	$query = sprintf("SELECT Schools.sname FROM Schools WHERE Schools.sname = '%s'", $sname);
	$result = mysqli_query($conn, $query);

	//check to make sure the result was returned
	if(!$result) {
		$message = 'problem with select * from into question type query ';
		$message = $message . 'Invalid query: ' . mysql_error() . "\n";
	    die($message);
	} else {
		// if school doesn't exist, add it to Schools
		$numRows = $result -> num_rows;
		if($numRows == 0) {

			$query = sprintf("INSERT INTO Schools(sname)
			VALUES ('%s')", $sname);
			$result = mysqli_query($conn, $query);
			if($result){
				print "We've never seen that school before. Don't worry, we'll add it to the list." . "<br>";
			}
		} 
	// either way, add school to Teaches_At

		// get teacher tid
		$query = sprintf("SELECT Teachers.tid FROM Teachers WHERE Teachers.temail = '%s'", $temail);
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$tid = $row['tid']; 

		// get School sid
		$query = sprintf("SELECT Schools.sid FROM Schools WHERE Schools.sname = '%s'", $sname);
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
		$sid = $row['sid']; 

		// add school to Teaches_At Table
		$query = sprintf("INSERT INTO Teaches_At(tid, sid)
		VALUES ('%s', '%s')", $tid, $sid);
		$result = mysqli_query($conn, $query);

		if($result){
			// successful query
			print "School successfully added!";
		}
	}
?>