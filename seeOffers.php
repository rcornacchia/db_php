<?php
    require_once "common.php";
    
    $qid = $_SESSION['qid'];
    
    
    //1. Get All Offers with Amt + Company Name
    $query = sprintf("SELECT amount, compname FROM Offer_To JOIN Companies ON Offer_To.compid = Companies.compid ORDER BY amount DESC");
    $result = mysqli_query($conn,$query);
    if(!$result) {
        $message = 'Couldnt run query: ' . mysql_error() . "\n";
        $message .= 'Whole query: ' . $query;
        die($message);
    }
    
?>

<!DOCTYPE HTML>
<html>
<body>
    <h1> Offers </h1>
    <table style="width:90%" border="1">
        <tr>
        <td>Offer</td>
        <td>Company</td>
        </tr>
    <?php
        while($comment=mysqli_fetch_array($result)) {
            echo "<tr>";
            for ($col = 0; $col < 2; $col ++) {
                echo "<td>", $comment[$col], "</td>";
            }
            
            echo "</tr>";
        }
        
        echo "</table>";
    ?>
</body>
</html>