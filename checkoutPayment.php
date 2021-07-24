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
        <div class="col-md-4" style="margin: auto">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Checkout Confirmation</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="SummaryofOrders.php" method="get">
                        <fieldset>
                            <div class="form-group">
                                <label for="">Payment Method</label>
                                <select class="form-select" aria-label="default" style="width: 100%; height:auto" id="selectMode" onchange="paymentModeSelect()" name="paymentChoice">
                                    <option selected value="Cash On Delivery" name="cod">Cash On Delivery</option>
                                    <option value="Debit/Credit Card" name="dbtCard">Debit/Credit Card</option>
                                </select>
                                <br><br>
                                <label for="username">Credit Card Number</label>
                                <input disabled class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx" id="creditCardNumber" name="creditCardNumber" type="number" autofocus="on" />

                            </div>
                            <div class="form-group">
                                <label for="username">Expiration Date</label>
                                <input disabled class="form-control" placeholder="mm/dd" id="expirationDate" name="expirationDate" type="username" />
                            </div>
                            <div class="form-group">
                                <label for="username">CVV</label>
                                <input disabled class="form-control" placeholder="xxx" id="cvv" name="cvv" type="number" />
                            </div>
                            <div class="form-group">
                                <label for="username">Address (<?php echo $_SESSION['username'] ?>)</label>

                                <?php

                                $sql = "SELECT address FROM user_accounts WHERE username = '$username'";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                ?> <input value="<?php echo $row['address'] ?>" class="form-control" placeholder="" name="address" type="textarea" autofocus="" required>
                            </div>
                    <?php   }
                                } ?>
                    <a href="checkout.php" class="btn btn-danger">Go back to checkout</a>
                    <input type="submit" class="btn btn-success" value="Submit" name="submit" id="submit" />
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/functions.js"></script>
</body>

</html>