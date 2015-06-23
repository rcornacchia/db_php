<?php

	

?>

<!DOCTYPE HTML>
<html> 
<body>

	<h2>Search for Questions</h2>
	<form action="addStudent.php" method="get">
		Name: <input type="text" name="qText"><br>
		<input type="submit" value="Add">
	</form>

	<h2>Add a question and the Company that asked it</h2>
	<form action="addSchool.php" method="get">
		Name: <input type="text" name="newQuestion"><br>
		Company: <input type="text" name="Company"><br>
		<input type="submit" value="Add">
	</form>

	<h2>Add a teacher</h2>
	<form action="addSchool.php" method="get">
		Name: <input type="text" name="teacherName"><br>
		Email: <input type="text" name="teacherEmail">
		<input type="submit" value="Add">
	</form>

</body>
</html>