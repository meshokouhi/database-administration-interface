<?php
        session_start();

          if( !isset($_POST['studentnumber']) ||
              !isset($_POST['firstname'])     || 
              !isset($_POST['lastname'])      ){
              $_SESSION['message']= "<p class='error'>You need to login to view this web site.</p>";
              header("Location: index.php");
              die();
          }     

          //define the variables
          $studentNumberPattern = "/^a0[0-9]{7}$/i";
          $firstName 	        = ucfirst(strtolower(trim($_POST['firstname'])));
          $lastName 	        = ucfirst(strtolower(trim($_POST['lastname'])));
          $studentNumber        = trim($_POST['studentnumber']);
          $checkStNum           = preg_match($studentNumberPattern , $studentNumber);


          if ($studentNumber == "" || $firstName == ""  || $lastName == ""){
              $_SESSION['message']= "<p class='error'>The record could not be updated as requested. All the field must be filled.</p>";
              header("Location: index.php");
              die();
          }

          $_SESSION['updatedID']  = $studentNumber;
          $_SESSION['firstname']  = $firstName;
          $_SESSION['lastname']   = $lastName;

          if ( $checkStNum !== 1 ){
            $_SESSION['message']= "<p class='error'>Record not updated. Student Number must match the pattern: a0xxxxxxx " . $_SESSION['updatedID']. " " .$_SESSION['firstname']. " " .$_SESSION['lastname']. "</p>";
              header("Location: index.php");
          }

          require_once("dbinfo.php");
          $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

          
          if( mysqli_connect_errno() != 0  ){
              die("<p> Sorry, couldnt connect to DB</p>");	
          }
          
          $updatedID  = $mysqli->real_escape_string($_SESSION['updatedID']);
          $firstname  = $mysqli->real_escape_string($_SESSION['firstname']);
          $lastname   = $mysqli->real_escape_string($_SESSION['lastname']);
          $oroginalID = $mysqli->real_escape_string($_SESSION['id']);

          $updateQuery = "UPDATE students SET id='$updatedID', firstname='$firstname', lastname='$lastname' WHERE id='$oroginalID';";
          $mysqli->query($updateQuery);
          $affectedRows = $mysqli->affected_rows;
         
          if ($affectedRows < 1 ){
              $_SESSION['message'] = "<p class ='error'> The record could not be updated as requested. " . $_SESSION['updatedID'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
          } else{
              $_SESSION['message'] = "<p> The record has been updated: " . $_SESSION['updatedID'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
          }
          $mysqli->close();
          header("Location: index.php");
          die();
  
      ?>  