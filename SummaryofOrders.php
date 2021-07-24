<?php
session_start();

include 'db_conn.php';

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if ($_SESSION['userLogged'] != "true") {
    header("Location: returnBackLogin.php");
}

$username = $_SESSION['username'];

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
    <title>Checkout</title>

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>

<body>
    <?php
    include 'navbar/navbar.php';
    ?>
    <div class="container" style="display: flex; margin-top:5%">
        <div class="col-md-12" style="margin: auto">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Summary</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="orderStatusSuccess.php" method="post">
                        <fieldset>
                            <div style="padding:3rem 10rem 10rem 10rem;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td scope="col">Product Name</td>
                                            <td scope="col">Poster</td>
                                            <td scope="col">Quantity</td>
                                            <td scope="col">Price</td>
                                            <td scope="col">Total</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php
                                            if (!empty($_SESSION["shopping_cart"])) {
                                                $total = 0;
                                                foreach ($_SESSION["shopping_cart"] as $keys => $values) {
                                            ?>
                                        <tr>
                                            <td scope="row" style="vertical-align: middle;"><?php echo $values["item_name"]; ?></td>
                                            <td style="vertical-align: middle;"><a href="productPage.php?itemId=<?php echo $values["item_id"] - 1; ?>"><img src="img/<?php echo $values["item_image"]; ?>" alt="" width="100rem"></a></td>
                                            <td style="vertical-align: middle;"><?php echo $values["item_quantity"]; ?></td>
                                            <td style="vertical-align: middle;">$ <?php echo $values["item_price"]; ?></td>
                                            <td style="vertical-align: middle; color: green;">$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
                                        </tr>
                                    <?php
                                                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                                                }
                                    ?>
                                    <tr>
                                        <td colspan="4" align="right"></td>
                                        <td align="right" style="color: green;"> <b>$ <?php echo number_format($total, 2); ?></b></td>

                                    </tr>
                                <?php
                                            }
                                            $choiceOfPayment = $_GET['paymentChoice'];
                                            $address = $_GET['address'];

                                            echo "<b>Payment Mode</b>: " . $choiceOfPayment;
                                            echo "<br><br>";
                                            echo "<b>Shipping Address</b>: " . $address;
                                            echo "<br><br>";
                                            echo "<b>Products</b>: ";
                                            echo "<br><br>";

                                            $sql = "UPDATE user_accounts SET address = '" . $address . "' WHERE username = '" . $username . "'";

                                            mysqli_query($conn, $sql);

                                            // if (mysqli_query($conn, $sql)) {
                                            //     echo "Record updated successfully";
                                            // } else {
                                            //     echo "Error updating record: " . mysqli_error($conn);
                                            // }
                                ?>
                                </tr>
                                    </tbody>
                                </table>
                                <a onclick="location.href='checkout.php'" class="btn btn-danger" value="Submit">Cancel
                                </a>
                                <button type="submit" class="btn btn-success" value="Submit" name="submit">Confirm
                                </button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/functions.js"></script>
</body>

</html>