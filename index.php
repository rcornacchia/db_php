<?php
	// if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
	// 	$uri = 'https://';
	// } else {
	// 	$uri = 'http://';
	// }
	// $uri .= $_SERVER['HTTP_HOST'];
	// header('Location: '.$uri.'/xampp/');
	// exit;
	// echo "My first PHP script";
	// connect to database
	require_once "common.php";
	// $x = 0;
	// session_start(); 
	// $_SESSION['views'] = $x + 1; // store session data
	// echo "Pageviews = ". $_SESSION['views']; //retrieve data
?>

<!DOCTYPE HTML>
<html> 
<body>

	<form action="login.php" method="get">
	<!-- Name: <input type="text" name="name"><br> -->
	E-mail: <input type="text" name="email"><br>
	<input type="submit" value="Log In">
	</form>

	<h2>OR</h2>

	<form action="signup.php" method="get">
	Username: <input type="text" name="uname"><br>
	E-mail: <input type="text" name="email"><br>
	School: <input type="text" name="school"><br>
    <input type="radio" name="occupation" value="Student" checked="checked">Student <br>
    <input type="radio" name="occupation" value="Teacher">Teacher<br>
	<input type="submit" value="Register">
	</form>


</body>
</html>