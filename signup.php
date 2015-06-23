<?php
    require_once "common.php";
    
    $name = $_REQUEST["uname"];
    $email = $_REQUEST["email"];
    $school = $_REQUEST["school"];
    $occupation = $_REQUEST["occupation"];
    $tableName = ($occupation == 'Student') ? 'Users' : 'Teachers';
    $columnName = ($tableName == 'Users') ? 'uemail' : 'temail';
    
    //DEBUG -  for printing paramters
//    print($name . ' ' . $email . ' ' . $school . ' ' . $occupation);
    // adding check for user submits blank textbox
    
    
    //first check that it doesn't exist
    $query = sprintf("SELECT * FROM %s WHERE %s.%s = '%s'",
                     $tableName,
                     $tableName,
                      $columnName,
                      mysqli_real_escape_string($conn,$email));
    
    
    
    // Perform Query
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Invalid query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    else{
        //for printing query - debugging
//        print($query);
    }
    /*
    while ($row = mysqli_fetch_assoc($result))
    {
        //for printing results
        echo $row[$columnName];
    }
     */
    
    $row_cnt = $result -> num_rows;
    if($row_cnt >= 1){
        die('Email already exists, please try again');
    }
    
    //Email/user doesnt exist. Insert new dataset into tables
    if($tableName == 'Users'){
        $query = sprintf("INSERT INTO Users (uname, uemail) VALUES ('%s','%s')",
                         mysqli_real_escape_string($conn,$name),
                         mysqli_real_escape_string($conn,$email));
        // Perform Query
        $result = mysqli_query($conn,$query);
        if(!$result) {
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        else{
            //worked
            //now get uid of student and add it to GOES_TO relationship with school
            $query = sprintf("SELECT * FROM Users WHERE uemail = '%s'",
                             mysqli_real_escape_string($conn,$email));
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            $uid = $row['uid'];
            
            // check to see if school is already in db
            $query = sprintf("SELECT Schools.sname FROM Schools WHERE Schools.sname = '%s'", $school);
            $result = mysqli_query($conn, $query);
            if(!$result) {
                die("Problem with school selection query");
            }else {
                $numRows = $result -> num_rows;
            }

            if($numRows == 0) {
                // then school isn't already in db, so add
            
                $sql = sprintf("INSERT INTO Schools (sname)
                VALUES ('%s')", mysqli_real_escape_string($conn, $school));

                if (!mysqli_query($conn, $sql)) {
                    die("Error: " . $sql . "<br>" . mysqli_error($conn));
                }
            }
            
            //get sid of school
            $query = sprintf("SELECT * FROM Schools WHERE sname = '%s'",
                             mysqli_real_escape_string($conn,$school));
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            $sid = $row['sid'];
            
            //now insert into goes_to relationship
            $query = sprintf("INSERT INTO Goes_To VALUES ('%s','%s')",
                             mysqli_real_escape_string($conn,$uid),
                             mysqli_real_escape_string($conn,$sid));
            $result = mysqli_query($conn,$query);
            
            $_SESSION["email"] = $email;
            //redirect to correct webpage
            header("Location: /studentHome.php"); /* Redirect browser */
        }
    }
    if($tableName == 'Teachers'){
        $query = sprintf("INSERT INTO Teachers (tname, temail) VALUES ('%s','%s')",
                         mysqli_real_escape_string($conn,$name),
                         mysqli_real_escape_string($conn,$email));
        // Perform Query
        $result = mysqli_query($conn,$query);
        if(!$result) {
            $message = 'Invalid query: ' . mysql_error() . "\n";
            $message .= 'Whole query: ' . $query;
            die($message);
        }
        else{
            //worked
            //now get tid of Teacher and add it to to Teachers_at relationship with School
            $query = sprintf("SELECT * FROM Teachers WHERE temail = '%s'",
                             mysqli_real_escape_string($conn,$email));
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            $tid = $row['tid'];
            
            
            //get sid of school
            $query = sprintf("SELECT * FROM Schools WHERE sname = '%s'",
                             mysqli_real_escape_string($conn,$school));
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);
            $sid = $row['sid'];
            
            //now insert into goes_to relationship
            $query = sprintf("INSERT INTO Teaches_At VALUES ('%s','%s')",
                             mysqli_real_escape_string($conn,$tid),
                             mysqli_real_escape_string($conn,$sid));
            $result = mysqli_query($conn,$query);
            
            $_SESSION["email"] = $email;
            //redirect to correct webpage
            header("Location: /teacherHome.php"); /* Redirect browser */
        }
    }
    

?>