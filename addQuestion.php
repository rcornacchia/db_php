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
    //experience from 1-3
    $experience = !$_REQUEST["experience"];
    //company id
    $compid = 0;
    $qid = 0;
    $qtid = 0;



	$difficulty = $_REQUEST["difficulty"];

	//1. Company
	$query = sprintf("SELECT * FROM Companies WHERE Companies.compname = '%s' LIMIT 1", mysqli_real_escape_string($conn,$comp));
	$result = mysqli_query($conn, $query);

	if(!$result) {
        $message = 'Couldnt select * from companies: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
	} else {
		$numRows = $result -> num_rows;
        if($numRows == 0) {
            //1a. Company not in DB -- Add it and get its id
            $query = sprintf("INSERT INTO Companies (compname) VALUES ('%s')",mysqli_real_escape_string($conn,$comp));
            $result = mysqli_query($conn, $query);
            if (!$result) {
                $message = 'problem with insert into companies';
                $message = $message . 'Invalid query: ' . mysql_error() . "\n";
                die($message);
            }
            else{
                $compid = mysqli_insert_id($conn);
            }
        }
        else{
            //1b. Company in DB -- get it's id
            $row = mysqli_fetch_assoc($result);
            $compid = $row['compid'];
        }
    }
    
    

	//2. Question Type
	$query = sprintf("SELECT * FROM Question_Types WHERE Question_Types.qtname = '%s'", mysqli_real_escape_string($conn,$type));
	$qtid = 0;
	$result = mysqli_query($conn, $query);
	if(!$result) {
	    $message = 'problem with select * from into question type query  ';
		$message = $message . 'Invalid query: ' . mysql_error() . "\n";
	    die($message);
	} else {
			$numRows = $result -> num_rows;
			if($numRows == 0) {
                //2a. Question Type doesnt exist -- Add it and get id
				$query = sprintf("INSERT INTO Question_Types (qtname) VALUES ('%s')", mysqli_real_escape_string($conn,$type));
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
                //2b. Question type does exist -- Get it
					$row = mysqli_fetch_assoc($result);
					$qtid = $row['qtid'];
			}
	}


	//3. Question
	$query = sprintf("SELECT Questions.qtext FROM Questions WHERE Questions.qtext = '%s'", $q);
	$result = mysqli_query($conn, $query);
	if(!$result) {
         $message = 'Couldnt select * from companies: ' . mysql_error() . "\n";
         $message .= 'Whole query: ' . $query;
         die($message);

		// also add to Asked_By

		// add interview

	} else {
        $numRows = $result -> num_rows;
         if($numRows == 0) {
             //3a. Question doesnt exist -- Add it and get id
             $query = sprintf("INSERT INTO Questions(difficulty, upvotes, qtext) VALUES ('%s' , 0, '%s')",mysqli_real_escape_string($conn,$difficulty),mysqli_real_escape_string($conn,$q));
             $result = mysqli_query($conn, $query);
             if (!$result) {
                 $message = 'problem with select * from into question type query  ';
                 $message = $message . 'Invalid query: ' . mysql_error() . "\n";
                 die($message);
             }
             $qid = mysqli_insert_id($conn);
         }
         else{
             //3a. Question does exist -- Die and stop here
             die('question already exists in db');
         }
	}
    
    //4. Is_Type
    $query = sprintf("INSERT INTO Is_Type(qid, qtid) VALUES ('%s', '%s')", $qid, $qtid);
    $result = mysqli_query($conn, $query);
    if (!$result) {
        $message = 'problem with select * from into question type query  ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    }
    else {
        /* Question added to Is_Types */
    }
    
    //5. Asked_By
    $query = sprintf("INSERT INTO Asked_By VALUES ('%s','%s')",$qid, $compid);
    $result = mysqli_query($conn, $query);
    if (!$result) {
        $message = 'problem with select * from into question type query  ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    }
    else {
        /* Question added to Is_Types */
    }
    
    //6. Interviewed_By
    $query = sprintf("INSERT INTO Interviewed_By VALUES ('%s','%s','%s')",$experience,$qid, $compid);
    $result = mysqli_query($conn, $query);
    if (!$result) {
        $message = 'problem with insert into * from into Interviewed By type query  ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    }
    else {
        /* Question added to Is_Types */
    }
    

    /* everything should be added now */
    




?>

<!DOCTYPE HTML>
<html>
<body>


</body>
</html>
