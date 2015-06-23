<?php
    require_once "common.php";
    
    $questionContent = '%'.$_REQUEST["qText"].'%';
//    $questionCategory = $_REQUEST["category"];

    //find question
    $query = sprintf("SELECT * FROM Questions JOIN Is_Type ON Questions.qid = Is_Type.qid WHERE Questions.qtext LIKE '%s' LIMIT 1",
                     mysqli_real_escape_string($conn,$questionContent));
    
    // Perform Query
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt find any questions that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    else{
        print($query);
        $row = mysqli_fetch_assoc($result);
        $qText = $row['qtext'];
        $qid = $row['qid'];
        
        //get all info about for question
        $query = sprintf("SELECT Users.uname, Comments.content, Comments.date FROM Commented_On JOIN Comments ON Commented_On.cid = Comments.cid JOIN Users on Commented_On.uid = Users.uid WHERE Commented_On.qid = '%s'",
                         mysqli_real_escape_string($conn,$qid));

        $result = mysqli_query($conn,$query);
        
        //content, date for Comments
        print_r ($row);
        $_SESSION['qid'] = $row['qid'];
        
    }
?>
<!DOCTYPE HTML>
<html>
<body>
    <h1> Question </h1>
    <table style="width:90%" border="1">
        <tr>
        <td>Content</td>
        <td>Upvotes</td>
        <td>Difficulty</td>
        <td>Date</td>
        </tr>
        <tr>
            <td><?php echo $row['qtext'];?></td>
            <td><?php echo $row['upvotes'];?></td>
            <td><?php echo $row['difficulty'];?></td>
            <td><?php echo $row['date'];?></td>
        </tr>
    </table>

    <h2> Comments </h2>
    <table style="width:90%" border="3">
    <?php
        echo "<table border='1'><br />";
    
        while($comment=mysqli_fetch_array($result)) {
            echo "<tr>";
            for ($col = 0; $col < 3; $col ++) {
                echo "<td>", $comment[$col], "</td>";
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
    ?>

<br>

<form action="upvote.php" method="get">
<button type="button" style="width:200px;height:50px">Upvote!</button>
</form>

<br>
<form action="addComment.php" method="get">
Add Comment:   <input type="text" name="new-comment" size='40' height='60'>
<input type="submit" value="Submit">
</form>






</body>
</html>