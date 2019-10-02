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
      $firstName 	          = ucfirst(strtolower(trim($_POST['firstname'])));
      $lastName 	          = ucfirst(strtolower(trim($_POST['lastname'])));
      $studentNumber        = ucfirst(trim($_POST['studentnumber']));
      $checkStNum           = preg_match($studentNumberPattern , $studentNumber);


      if ($studentNumber == "" || $firstName == ""  || $lastName == ""){
          $_SESSION['message']= "<p class='error'>Record not added. All the field must be filled. </p>";
          header("Location: index.php");
          die();
      }

      $_SESSION['id']         = $studentNumber;
      $_SESSION['firstname']  = $firstName;
      $_SESSION['lastname']   = $lastName;

      if ( $checkStNum !== 1 ){
        $_SESSION['message']= "<p class='error'>Record not added. Student Number must match the pattern: a0xxxxxxx " . $_SESSION['id']. " " .$_SESSION['firstname']. " " .$_SESSION['lastname']. "</p>";
          header("Location: index.php");
      }

      require_once("dbinfo.php");
      $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

      
      if( mysqli_connect_errno() != 0  ){
          die("<p> Sorry, couldnt connect to DB</p>");	
      }
      
      $id           = $mysqli->real_escape_string($_SESSION['id']);
      $firstname    = $mysqli->real_escape_string($_SESSION['firstname']);
      $lastname     = $mysqli->real_escape_string($_SESSION['lastname']);
      $affectedRows = 0;

      $insertQuery = "INSERT INTO  students (id,firstname,lastname) VALUES ('$id' ,'$firstname' , '$lastname');";

      $mysqli->query($insertQuery);

      $affectedRows = $mysqli->affected_rows;
      
      if ($affectedRows < 1 ){
          $_SESSION['message'] = "<p class ='error'> Record not added. This student number already exists." . $_SESSION['id'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
      } else{
        $_SESSION['message'] = "<p> A new record has been added to the table: " . $_SESSION['id'] ."  ". $_SESSION['firstname']. "  " .$_SESSION['lastname']. "</p>";
      }
      
      $mysqli->close();
      header("Location: index.php");
      die();
      //die();
  
?>  