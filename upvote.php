<?php
    require_once "common.php";
    
    $qid = $_SESSION['qid'];
    //    $questionCategory = $_REQUEST["category"];
    
    //find question
    $query = sprintf("UPDATE Questions SET upvotes=upvotes+1 WHERE qid = '%s';
",
                     mysqli_real_escape_string($conn,$qid));
    
    // Perform Query
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt find any questions that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    else{
        //redirect to correct webpage
        header("Location: studentHome.php");
    }
?>