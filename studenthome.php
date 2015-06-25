<?php
	require_once "common.php";
	
	// get email from login page
	$email = $_SESSION["email"];

	// perform query
	$query = sprintf("SELECT Users.uname FROM Users WHERE Users.uemail = '%s'", $email);
	$result = mysqli_query($conn, $query);
	if(!$result) {
		$message = 'Invalid query: ' . mysql_error() . "\n";
		$message .= 'Whole query: ' . $query;
		die($message);
	}

	$row = $result->fetch_assoc();

	print "Welcome " . $row["uname"];

?>

<!DOCTYPE HTML>
<html> 
<body>


	<h2>Search for Questions</h2>
	<form action="questionPage.php" method="get">
		Question: <input type="text" name="qText"><br>
		<input type="submit" value="Search">
	</form>

	<h2>Search by Company</h2>
		<form action="compSearch.php" method="get">
		Company: <input type="text" name="searchComp"><br>
		<input type="submit" value="Search">
	</form>

	<h2>Add a question and the Company that asked it</h2>
	<form action="addQuestion.php" method="get">
		Question: <input type="text" name="newQuestion"><br>
		Company: <input type="text" name="company"><br>
		Type: <input type="text" name="type"><br>
		<p>Difficulty</p>
   		<input type="radio" name="difficulty" value="1" checked="checked">1 <br>
   		<input type="radio" name="difficulty" value="2">2 <br>
   		<input type="radio" name="difficulty" value="3">3		

		<p>Experience</p>
   		<input type="radio" name="experience" value="1" checked="checked">1 <br>
   		<input type="radio" name="experience" value="2">2 <br>
   		<input type="radio" name="experience" value="3">3		
		<input type="submit" value="Add">
	</form>

<h2>Add offer received by company</h2>
<form action="addOffer.php" method="get">
Offer: <input type="text" name="offer"><br>
Company: <input type="text" name="comp"><br>
<input type="submit" value="Add">
</form>

<h2>See All Offers</h2>
<form action="seeOffers.php" method="get">
<input type="submit" value="Go">
</form>



</body>
</html>
