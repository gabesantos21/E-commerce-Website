<?php
session_start();

if ($_SERVER["HTTPS"] != "on") {
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit();
}

include '../db_conn.php';

$msg = "";

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  if (isset($_POST['submit'])) {
    $pname = $_POST['productName'];
    $pprice = $_POST['productPrice'];
    // File
    @$filename  = $_FILES["productFile"]["name"];
    @$tempname = $_FILES["productFile"]["tmp_name"];
    $folder = "../img/" . $filename;

    $sql = "INSERT INTO product_list (`productName`, `productImage`, `price`) VALUES (?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $pname, $filename, $pprice);
    $stmt->execute();

    if (move_uploaded_file($tempname, $folder)) {
      $msg = "Successfully uploaded into database and directory.";
    } else {
      $msg = "There was a problem uploading the product.";
    }
  }
}

?>

<html lang="en">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Add Product Status</title>
</head>

<body>
  <form action="insertProductsVerification.php" method="POST" enctype="multipart/form-data">
    <div class="container" style="display: flex; align-items: center; margin-top: 10%">
      <div class="col-md-4" style="margin: auto">
        <div class="login-panel panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">Add product status</h3>
          </div>
          <div class="panel-body">

            <?php
            if ($msg != '' && $msg != "There was a problem uploading the product") {
              echo "<h6 name='alertProductStatus' id='alert' style='padding: 1rem; margin: 1rem; color: #457376; background-color: #d4edda; text-align: center;border-radius: 4px;'>";
              echo "$msg";
              echo "</h6>";
            }
            if ($msg == "There was a problem uploading the product") {
              echo "<h6 name='alertProductStatus' id='alert' style='padding: 1rem; margin: 1rem; color: white; background-color: pink; text-align: center;border-radius: 4px;'>";
              echo "$msg";
              echo "</h6>";
            }
            ?>
            <br>
            <div style="margin-left: 1rem;">
              <a href="insertProducts.php" class="btn btn-primary">Add another product.</a>
              <a href="../home.php" class="btn btn-primary">Return to Home</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

</body>

</html>