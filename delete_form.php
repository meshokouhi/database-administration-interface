<!DOCTYPE html>
<html lang="en">
<head>
	<title>TWD PHP | BCIT TWD PHP</title>
	<link rel="stylesheet" href="http://bcitcomp.ca/twd/css/style.css" />
	<link 	type="text/css" 
			rel="stylesheet" 
			href="style.css" />
	<meta charset="utf-8" />
</head>
<body>

	<h2>Delete a student...</h2>	<fieldset>
	<legend>Delete a record - Are you sure?</legend>

	<?php
		session_start();
		
		echo "<p>". $_SESSION['id'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
	?>

	<form method="post" action="delete_query.php">
		<input 	type="radio" 	name="confirm" 	id="yes"	value="yes"	checked="checked" />
		<label for="yes">Yes</label>
		<br />
		<input 	type="radio" 	name="confirm" 	id="no" 	value="no" />
		<label for="no">No</label>
		<br />	
		<input type="submit" value="Submit" />
	</form>

  </body>
</html>