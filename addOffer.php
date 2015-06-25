<?php
    require_once "common.php";
    
    // get email from login page
    $temail = $_SESSION["email"];
    $amount = $_REQUEST['offer'];
    $compName = $_REQUEST['comp'];
    $uid = 0;
    $compid = 0;

    //1. Get users UID
    $query = sprintf("SELECT uid FROM Users WHERE uemail = '%s'", $temail);
    //check to make sure the result was returned
    $result = mysqli_query($conn, $query);
    if(!$result) {
        $message = 'problem with select * from into question type query ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    } else {
        $row = mysqli_fetch_assoc($result);
        $uid = $row['uid'];
    }
    
    //2. Get CompID
    $query = sprintf("SELECT compid FROM Companies WHERE compname = '%s'", $compName);
    //check to make sure the result was returned
    $result = mysqli_query($conn, $query);
    if(!$result) {
        $message = 'problem with select * from into question type query ';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    } else {
        if($result -> num_rows == 0){
            die('no companies by that name found');
        }
        $row = mysqli_fetch_assoc($result);
        $compid = $row['compid'];
    }
    
    //3. Insert into Offer_To
    $query = sprintf("INSERT INTO Offer_To VALUES ('%s','%s','%s')", $amount,$uid,$compid);
    //check to make sure the result was returned
    $result = mysqli_query($conn, $query);
    if(!$result) {
        $message = 'problem with insert into Offers_To';
        $message = $message . 'Invalid query: ' . mysql_error() . "\n";
        die($message);
    } else {
        echo 'offer succesfully added to db';
    }
?>