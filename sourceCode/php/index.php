<?php
require("config.php"); 
//$commonObj = new Common();
  if(isset($_REQUEST['submit'])){
    $commonObj->validateLogin();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<div class="row">
<div class="col-sm-6">
  <h2>Login Form</h2>
  <?php echo $commonObj->getSuccessMsg();
      echo $commonObj->getErrorMsg();
      $commonObj->unsetMessage();
  ?>
  <form method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
    </div>
    
    <button type="submit" class="btn btn-primary" name="submit" value="login">Submit</button>
  </form>
</div>
</div></div>
</body>
</html>