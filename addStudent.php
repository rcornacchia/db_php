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
    
    $query = sprintf("SELECT Teachers.tid FROM Teachers WHERE Teachers.temail = '%s'", $temail);
    $result = mysqli_query($conn, $query);
    if(!$result) {
        $message = 'problem with select Teachers.tid FROM Teachers type query  ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
        
    }
    $row = mysqli_fetch_assoc($result);
    $tid = $row['tid'];
    
    $query = sprintf("INSERT INTO Taught_By(uid, tid)
                     VALUES ('%s', '%s')", $uid, $tid);
                     $result = mysqli_query($conn, $query);
    
     if(!$result) {
     
     $message = 'problem with select * FROM Taughty_By WHERE Teaches_At.uid   ';
     $message = $message . 'Invalid query: ' . mysql_error() . "\n";
     die($message);
     
     
     }
                     else{
                     echo 'worked!';
                     }


?>