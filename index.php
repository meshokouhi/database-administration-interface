<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP MySQL | BCIT TWD PHP</title>
		<link rel="stylesheet" type="text/css" href="http://bcitcomp.ca/twd/css/style.css" />
		<style>
		tr:nth-child(odd)		{ background-color:#ccc; }
		tr:nth-child(even)		{ background-color:#fff; }
		</style>
	<meta charset="utf-8" />
</head>
<body>
<h1>Administering DB From a Form</h1>
<div id="dbtable">
	<h2>Students:</h2>
	<p><a href='add_form.php'>Add a Student</a></p>
   
<?php
session_start();

      if(isset($_SESSION['message'])){
					echo $_SESSION['message']; 
					unset($_SESSION['message']);
      }
$_SESSION = array(); 


require_once("dbinfo.php");
$sortOrder = "lastname"; 

if( isset($_GET['choice'] ) ){

		$validChoices = array("id","firstname","lastname");

		if( in_array($_GET['choice'], $validChoices) ){
				$sortOrder = $_GET['choice'];	
		}else{
				echo "<p>'".$_GET['choice']."' is not a valid sort choice!</p>";
		}	

}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if( mysqli_connect_errno() != 0  ){
		die("<p> Sorry, couldnt connect to DB</p>");	
}

$sortOrder = $mysqli->real_escape_string($sortOrder);

$query = "SELECT id, firstname, lastname FROM students ORDER BY ".$sortOrder.";";
$result = $mysqli->query($query);

echo "<table>";

		$fieldObjects = $result->fetch_fields();

		echo "<tr>";
			foreach($fieldObjects as $fieldObject){
							echo "<th><a href='index.php?choice=$fieldObject->name'>" .$fieldObject->name. "</a></th>" ;
			}
		echo "</tr>";
		
		while($record = $result->fetch_assoc() ){
					echo "<tr>";
					
					echo "<td>" . $record["id"] . "</td>" ;
					echo "<td>" . $record["firstname"] . "</td>" ;
					echo "<td>" . $record["lastname"] . "</td>" ;
					echo"<td>&nbsp;<a href='prepare_query.php?delete=".$record["id"]."'>delete</a>&nbsp;</td>";
					echo"<td>&nbsp;<a href='prepare_query.php?update=".$record["id"]."'>update</a>&nbsp;</td>";

					echo "</tr>";		
		}

echo "</table>";


$mysqli->close();

?>	
	
</body>
</html>