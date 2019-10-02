<?php
		session_start();

		if( isset($_POST['confirm'])){
				$confirm 	= trim($_POST['confirm']);
				if ( $confirm == "no"){
						 $_SESSION['message'] ="<p class= 'error' > Delete record aborted </p>";
						 header("Location: index.php");
						 die();
				}

				require_once("dbinfo.php");
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				
				if( mysqli_connect_errno() != 0  ){
						die("<p> Sorry, couldnt connect to DB</p>");	
				}

        $id =  $mysqli->real_escape_string($_SESSION['id']);

				$deleteQuery = "DELETE  FROM students WHERE id='" .$id. "';";
				$mysqli->query($deleteQuery);

				$_SESSION['message'] = "<p> Record Deleted: " . $_SESSION['id'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
				$mysqli->close();

				header("Location: index.php");
				die();

		} else{
				$_SESSION['message']= "<p class='error'>You need to login to view this web site.</p>";
				header("Location: index.php");
				die();
		}

?>  
