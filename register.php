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
  "The username is taken, try another username.",
  "Please fill up all the necessary details.",
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
  <title>Register</title>
</head>

<body>
  <div class="container" style="display: flex; margin-top: 10%">
    <div class="col-md-4" style="margin: auto">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Register</h3>
        </div>
        <?php if (isset($_GET['errorDetails'])) { ?>
          <h6 class="error" style="padding: 1rem; margin: 1.3rem 1.3rem 0 1.3rem; color: #74281a; background-color: #f8d7da; text-align: center; border-radius: 4px;"><?php echo $errorMessage[$_GET['errorDetails']]; ?></h6>
        <?php } ?>
        <div class="panel-body">
          <form role="form" action="registerVerification.php" method="POST">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Username" name="username" type="username" autofocus="on" required />
                <i>
                  <h6 for="username" style="color: gray">
                    Must be unique
                  </h6>
                </i>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Enter First Name" name="firstName" type="text" autofocus="" required />
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Middle Name" name="middleName" type="text" autofocus="" />
                <i>
                  <h6 for="middleName" style="color: gray" id="middleNameSubtext">
                    Optional
                  </h6>
                </i>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Last Name" name="lastName" type="text" autofocus="" required />
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Enter Suffix" name="nameSuffix" type="text" autofocus="" />
                <i>
                  <h6 for="nameSuffix" style="color: gray" id="suffixSubText">
                    Optional
                  </h6>
                </i>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password" value="" onkeyup="passwordVerify()" id="password" required />
                <i>
                  <h6 for="password" style="color: gray" id="passwordSubtext">
                    Must be atleast 8 characters long
                  </h6>
                </i>
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Confirm Password" name="confirmPassword" type="password" value="" id="confirmPassword" onkeyup="passwordVerify()" required />
                <i>
                  <h6 for="confirmPassword" id="cPsubtext"></h6>
                </i>
              </div>
              <h6>Already registered? <a href="login.php">Login</a></h6>
              <input type="submit" class="btn btn-sm btn-primary" value="Submit" name="submit" id="submit" disabled />
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="js/functions.js"></script>
</body>

</html>