<?php
    require_once "common.php";
    $compName = '%'.$_REQUEST["searchComp"].'%';
    //    $questionCategory = $_REQUEST["category"];
    
    //find question
    $query = sprintf("SELECT qtext, upvotes, difficulty, date FROM Questions JOIN Asked_By ON Questions.qid = Asked_By.qid JOIN Companies ON Asked_By.compid = Companies.compid WHERE Companies.compname LIKE '%s' LIMIT 1",
                     mysqli_real_escape_string($conn,$compName));
    
    // Perform Query
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt find any questions that match: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
?>
<!DOCTYPE HTML>
<html>
<body>

<h2> Questions asked by <? echo $_REQUEST["searchComp"] ?> </h2>
<?php
    echo "<table border='1'> <tr><td>Text</td><td>Upvotes</td><td>Difficulty</td><td>Date</td></tr><br/>";
    
    while($q=mysqli_fetch_array($result)) {
        echo "<tr>";
        for ($col = 0; $col < 4; $col ++) {
            echo "<td>", $q[$col], "</td>";
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
?>








</body>
</html>