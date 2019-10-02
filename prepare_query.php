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

		<h1>Administering DB From a Form</h1>
				
		<h3>No table administration selection was made</h3>

		<?php
			session_start();

			require_once("dbinfo.php");

			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			if( mysqli_connect_errno() != 0  ){
				die("<p> Sorry, couldnt connect to DB</p>");	
			}

			$setUpdate = false;
			$setDelete = false;

			if (!isset($_GET['delete']) && !isset($_GET['update']) ){
					$_SESSION['message']= "<p class='error'>You need to login to view this web site.</p>";
					header("Location: index.php");
					die();
			} 
			
			if( isset($_GET['delete']) ){
					$id = $mysqli->real_escape_string($_GET['delete']);
					$setDelete = true;
			}


			if( isset($_GET['update']) ){
					$id = $mysqli->real_escape_string($_GET['update']);
					$setUpdate = true;
			}  

				$query = "SELECT id, firstname, lastname FROM students WHERE id='".$id."';";
				$result = $mysqli->query($query);
				
				while($record = $result->fetch_assoc() ){

							$_SESSION['id']        = $record["id"];
							$_SESSION['firstname'] = $record["firstname"];
							$_SESSION['lastname']  = $record["lastname"];
							echo "<fieldset>";
							echo "<legend>Delete a student...</legend>" ;
							echo "<p>Hello, " . $record["firstname"] . " " . $record["lastname"] . "!</p>" ;
							echo "</fieldset>";
					
				}	
				
				if ($setUpdate == true){ 
						header("Location: update_form.php");
						die();
				}

				if ($setDelete == true){
						header("Location: delete_form.php");
						die();
				}
			
		?>
		
	</body>
</html>