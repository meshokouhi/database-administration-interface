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
      <?php
        session_start(); 
      ?>
      <h2>Update a student...</h2>	<fieldset>
      <legend>Update a record</legend>

      <form method="post" action="update_query.php">
        <fieldset>
        <legend>New data</legend>
          <input 	type="text" name="studentnumber" id="studentnumber"  value="<?php echo $_SESSION['id'] ?>" />

          <label 	for="studentnumber"> - Student #</label><br />

          <input 	type="text" name="firstname"   id="firstname"  value="<?php echo $_SESSION['firstname'] ?>" />

          <label for="firstname"> - Firstname</label><br />

          <input 	type="text"   name="lastname"  id="lastname"  value="<?php echo $_SESSION['lastname'] ?>" />

          <label for="lastname"> - Lastname</label><br />
        </fieldset>

        <input type="submit" value="Submit" />
     
      </fieldset>
      </form>
    </body>
</html>