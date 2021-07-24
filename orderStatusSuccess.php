<?php
session_start();

include 'db_conn.php';

foreach ($_SESSION["shopping_cart"] as $keys => $values) {
    unset($_SESSION["shopping_cart"][$keys]);
}

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if ($_SESSION['userLogged'] != "true") {
    header("Location: returnBackLogin.php");
}

function getClientIP()
{
    if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
        return  $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
        return $_SERVER["REMOTE_ADDR"];
    } else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
        return $_SERVER["HTTP_CLIENT_IP"];
    }
    return '';
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
    <title>Order Status</title>

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
        <div class="col-md-3" style="margin: auto">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Order Status</h3>
                </div>
                <div class="panel-body">
                    <form role="form" action="orderStatusSuccess.php" method="POST">
                        <fieldset>
                            <center>
                                <span style="color: green;">Order Successful</span><br><br>
                                <a onclick="location.href='home.php'" class="btn btn-primary" value="Submit">Back to Home
                                </a>
                            </center>

                            <?php
                            $ip = $_SERVER['REMOTE_ADDR']; //get supposed IP
                            $dateAndTime = date('d-m-y h:i:s'); //gets current date and time
                            $handle = fopen("logs/checkout_log.txt", "a"); //open log file

                            fwrite($handle, "username: " . $_SESSION['username'] . "\r\n");
                            fwrite($handle, "IP Address: " . getClientIP() . "\r\n");
                            fwrite($handle, "Date and Time: $dateAndTime \r\n \r\n");
                            fclose($handle); ?>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>