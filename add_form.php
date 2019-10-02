<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <?php
    session_start();
    
  ?>
  <h2>Add a student...</h2>
	<fieldset>
    <legend>Add a record</legend>

    <form method="post" action="add_query.php">

      <input type="text" name="studentnumber" id="studentnumber" />

      <label for="studentnumber"> - Student #</label><br />

      <input type="text" name="firstname" id="firstname" />

      <label for="firstname"> - Firstname</label><br />

      <input type="text" name="lastname" id="lastname" />

      <label for="lastname"> - Lastname</label><br />

      <input type="submit" value="Submit" />

    </form>

	</fieldset>	

</body>
</html>