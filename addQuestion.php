<?php
	require_once "common.php";
	if(!$_REQUEST["newQuestion"] || !$_REQUEST["company"] || !$_REQUEST["type"]){
		print "Please enter all fields";
		exit();
	}

	// get question from form
	$q = $_REQUEST["newQuestion"];
	// get company name
	$comp = $_REQUEST["company"];
	// get question type
	$type = $_REQUEST["type"];

	$difficulty = $_REQUEST["difficulty"];

	//check to see if company is in database already
	$query = sprintf("SELECT Companies.compname FROM Companies WHERE Companies.compname = '%s'", $comp);
	$result = mysqli_query($conn, $query);
	if($result) {
		$numRows = $result -> num_rows;
	} else {
		print "No entries";
	}
	if($numRows == 0) {
		// then company isn't already in db, so add
		$query = "INSERT INTO Companies (compname)
		VALUES ('$comp')";



		if (!mysqli_query($conn, $query)) {
		    print "Error: " . $query . "<br>" . mysqli_error($conn);
		}
	}

	//check to see if question type is in db already
	$query = sprintf("SELECT * FROM Question_Types WHERE Question_Types.qtname = '%s'", $type);
	$qtid = 0;
	$result = mysqli_query($conn, $query);
	if(!$result) {
	    $message = 'problem with select * from into question type query  ';
		$message = $message . 'Invalid query: ' . mysql_error() . "\n";
	    die($message);
	} else {
			$numRows = $result -> num_rows;
			if($numRows == 0) {
				// then q type isn't already in db, so add
				$query = sprintf("INSERT INTO Question_Types (qtname)
				VALUES ('%s')", $type);
				$result = mysqli_query($conn, $query);
				if (!$result) {
					$message = 'problem with insert into question type query  ';
					$message = $message . 'Invalid query: ' . mysql_error() . "\n";
				    die($message);
				}
				else{
					$qtid = mysqli_insert_id($conn);	
				}
			}
			else {
					$row = mysqli_fetch_assoc($result);
					$qtid = $row['qtid'];

			}
	}


	//check to see if question is in database already
	$query = sprintf("SELECT Questions.qtext FROM Questions WHERE Questions.qtext = '%s'", $q);
	$result = mysqli_query($conn, $query);
	if($result) {
		$numRows = $result -> num_rows;
	} else {
		print "No entries";
	}
	if($numRows == 0) {
		// then question doesn't exist, add
		$query = "INSERT INTO Questions(difficulty, upvotes, qtext)
		VALUES ($difficulty , 0, '$q')";
		$result = mysqli_query($conn, $query);
		if (!$result) {
		    $message = 'problem with select * from into question type query  ';
			$message = $message . 'Invalid query: ' . mysql_error() . "\n";
		    die($message);
		} else {
			// Question successfully added to Questions table
			$qid = mysqli_insert_id($conn);
			// Now add to is_Type
			$query = sprintf("INSERT INTO Is_Type(qid, qtid)
			VALUES ('%s', '%s')", $qid, $qtid);

			// run query
			if (!mysqli_query($conn, $query)) {
			    print "Error: " . $query . "<br>" . mysqli_error($conn);
			}else {
				// Question also logged to Is_Types table
				print "Question successfully added!";
			}
		}

	} else {
		print "Question already exists.";
	}




?>

<!DOCTYPE HTML>
<html> 
<body>


</body>
</html>
