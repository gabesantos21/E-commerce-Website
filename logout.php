<?php
session_start();

if ($_SERVER["HTTPS"] != "on") {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Logout</title>
</head>

<body>
  <div class="container" style="display: flex; align-items: center; margin-top: 10%">
    <div class="col-md-4" style="margin: auto">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Log Out</h3>
        </div>
        <div class="panel-body">
          <h5>You have successfully logged out.</h5>
          <h6>
            <a href="login.php">Log in</a> or
            <a href="register.php">Register</a>
            <h6><a href="home.php">Browse as guest.</a></h6>
          </h6>
        </div>
      </div>
    </div>
  </div>
</body>

</html>