<!-- guest
- register
- login
- browse products
- search products by name

registered user
- login
- logout
- browse products
- search products by name
- checkout
- confirm checkout -->

<?php
session_start();

if ($_SERVER["HTTPS"] != "on") {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

if (@$_SESSION['userLogged'] == "true") {
  header("Location: returnBackLogin.php");
}

$errorMessage = array(
  "User Name is required",
  "Password is required",
  "Incorrect Username or password. Try again"
);
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
  <title>Login</title>
</head>

<body>
  <form action="loginVerification.php" method="post">
    <div class="container" style="display: flex; align-items: center; margin-top: 10%">
      <div class="col-md-4" style="margin: auto">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Log In</h3>
          </div>
          <?php if (isset($_GET['errorDetails'])) { ?>
            <h6 class="error" style="padding: 1rem; margin: 1.3rem 1.3rem 0 1.3rem; color: #74281a; background-color: #f8d7da; text-align: center;border-radius: 4px;"><?php echo $errorMessage[$_GET['errorDetails']]; ?></h6>
          <?php } ?>
          <div class="panel-body">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Username" name="username" type="text" autofocus="on" />
                <?php if (isset($_GET['errorUserName'])) { ?>
                  <h6 class="error" style="color: red"><?php echo $errorMessage[$_GET['errorUserName']]; ?></h6>
                <?php } ?>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Password" name="password" type="password" value="" />
                <?php if (isset($_GET['errorUserPass'])) { ?>
                  <h6 class="error" style="color: red"><?php echo $errorMessage[$_GET['errorUserPass']]; ?></h6>
                <?php } ?>
                <h6>
                  Not yet registered? <a href="register.php">Register</a>
                </h6>
                <h6>
                  or <a href="home.php" name="guest">continue as guest</a>
                </h6>
              </div>
              <button type="submit" class="btn btn-sm btn-primary" value="Submit" name="submit">Submit
              </button>
            </fieldset>
          </div>
        </div>
      </div>
    </div>
  </form>

</body>

</html>