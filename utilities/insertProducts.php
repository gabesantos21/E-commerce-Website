<?php
if ($_SERVER["HTTPS"] != "on") {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

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
  <title>Add Product</title>
</head>

<body>
  <form action="insertProductsVerification.php" method="POST" enctype="multipart/form-data">
    <div class="container" style="display: flex; align-items: center; margin-top: 10%">
      <div class="col-md-4" style="margin: auto">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Add product</h3>
          </div>
          <div class="panel-body">
            <input type="text" name="productName" class="form-control" placeholder="Enter name of product"><br>
            <input type="number" name="productPrice" class="form-control" placeholder="Enter price of product"><br>
            <input id="input-b1" name="productFile" type="file" class="file" data-browse-on-zone-click="true"><br>
            <input type="submit" value="submit" name="submit" class="btn btn-sm btn-primary">
            <a href="../home.php" class="btn btn-sm btn-primary">Return to Home</a>
          </div>
        </div>
      </div>
    </div>
  </form>

</body>

</html>