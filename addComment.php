<?php
    require_once "common.php";
    
    $comment = $_REQUEST["new-comment"];
    $qid = $_SESSION['qid'];

    
    //1. Add comment
    $query = sprintf("INSERT INTO Comments (content) VALUES ('%s')",
     mysqli_real_escape_string($conn,$comment));
    
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt find any questions that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    $cid = mysqli_insert_id($conn);
    
    //2. Get uid from email
    
    $query = sprintf("SELECT * FROM Users WHERE uemail = '%s' LIMIT 1",
                     mysqli_real_escape_string($conn,$_SESSION['email']));
    
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt find any questions that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    
    $uid = mysqli_fetch_assoc($result)['uid'];
    
    //3. Now insert into Commented On relationship

    
    
    
    $query = sprintf("INSERT INTO Commented_On VALUES ('%s','%s','%s')",
                     mysqli_real_escape_string($conn,$cid),
                     mysqli_real_escape_string($conn,$qid),
                      mysqli_real_escape_string($conn,$uid));
    
    
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt INSERT INTO Commented_On that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    //redirect to correct webpage
    
    header("Location: /studentHome.php"); /* Redirect
    
    
    
    
?>
