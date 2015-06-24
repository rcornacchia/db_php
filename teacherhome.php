<?php
	require_once "common.php";
	
	// get email from login page
	$email = $_SESSION["email"];

	// perform query
	$query = sprintf("SELECT Teachers.tname FROM Teachers WHERE Teachers.temail = '%s'", $email);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	$row = $result->fetch_assoc();

	print "Welcome " . $row["tname"];

?>

<!DOCTYPE HTML>
<html> 
<body>
	<h2>Add the email of the Student you've taught</h2>
	<form action="addStudent.php" method="get">
		<!-- Name: <input type="text" name="studentName"><br> -->
		Email: <input type="text" name="studentEmail"><br>
		<input type="submit" value="Add">
	</form>

	<h2>Add a School where you've taught</h2>
	<form action="addSchool.php" method="get">
		Name: <input type="text" name="schoolName"><br>
		<input type="submit" value="Add">
	</form>

</body>
</html>