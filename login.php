<?php
	require_once "common.php";
	$email = $_REQUEST["email"];
	// adding check for user submits blank textbox
	$query = sprintf("SELECT * FROM Users WHERE Users.uemail = '%s'",
                        mysqli_real_escape_string($conn,$email));
    
    // Perform Query
    $result = mysqli_query($conn,$query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}
    else{
//        print($query);
    }
    
    $row_cnt = $result -> num_rows;
    
    if($row_cnt == 1){
        print('user is student');
        $_SESSION["email"] = $email;
        //redirect to correct webpage
        header("Location: localhost/studentHome.php"); /* Redirect browser */
        exit();
    }
    else{
       /* start query on teacher table */
        $query = sprintf("SELECT * FROM Teachers WHERE Teachers.temail = '%s'",
                         mysqli_real_escape_string($conn,$email));
        
        
    
        if(!$result) {
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        else{
//            print($query);
        }
        
        // Perform Query
        $result = mysqli_query($conn,$query);
        $row_cnt = $result -> num_rows;
        
        if($row_cnt == 1){
            print('user is teacher');
            $_SESSION["email"] = $email;
            //redirect to correct webpage
            header("Location: localhost/teacherHome.php"); /* Redirect browser */
            exit();
        }
        else{
            die('email not in DB');
        }
    }
    
?>