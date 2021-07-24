<?php
session_start();

include 'db_conn.php';

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Home</title>

    <style>
        .cardProduct:hover {
            border-color: blue;
            transition-delay: .01s;
            transition-timing-function: linear;
            transform: scale(1.01);
        }

        img {
            object-fit: contain;
        }

        /* Chrome, Safari, Edge, Opera */
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
    if (isset($_SESSION['username'])) {
        include 'navbar/navbar.php';
    } else {
        include 'navbar/guestNavbar.php';
    }

    ?>
    <br><br><br>
    <div class="container" id="product-section">
        <div class="row">
            <div class="col-md-6">
                <?php
                $itemId = $_GET['itemId'] + 1;

                $item_id = '';
                $item_name = '';
                $item_image_name = '';
                $item_price = '';

                $itemId = htmlspecialchars($itemId); // changes characters used in html to their equivalents
                $itemId = mysqli_real_escape_string($conn, $itemId); // makes sure nobody uses SQL injection

                $sql = "SELECT * FROM product_list WHERE productId =" . $itemId . ";";
                $result = mysqli_query($conn, $sql);
                $result2 = mysqli_query($conn, $sql);

                if (!($row2 = mysqli_fetch_assoc($result2))) {
                    header("Location: home.php");
                    exit();
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $item_id = $row['productId'];
                        $item_name = $row['productName'];
                        $item_image_name = $row['productImage'];
                        $item_price = $row['price'];



                        echo "<img src='img/" . $row['productImage'] . "' alt='' class='image-responsive'>";
                        echo "</div>";
                        echo " <div class='col-md-6'>";
                        echo "<form action='checkout.php?action=add&id=" . $item_id . "' method='post'>";
                        echo "<div class='row'>";
                        echo "<div class='col-md-12'>";
                        echo "<h1>" . $row['productName'] . "</h1>";
                        echo "</div>";
                        echo "<div class='col-md-12'>";
                        echo "<h3>Movie price: <span style='color: yellowgreen;'> $ " . $row['price'] . "</span></h3>";
                        echo "</div>
                    <br><br><br>";
                    }

                    if ($_SESSION['username'] != 'Guest') {
                        echo "<div class='col-md-12'>
                            <h6>Quantity</h6>
                        <input type='number' style='width: 17rem;' value='1' id='quantity' onkeyup='quantValidityChecker()' name='productQuantity'>
                        <input type='hidden' name='productName' value='" . $item_name . "'>
                        <input type='hidden' name='productPrice' value='" . $item_price . "'>
                        <input type='hidden' name='productImage' value='" . $item_image_name . "'>
                    </div>
                    <br><br><br><br>"; ?>
                <?php

                        $_SESSION['itemId'] = $itemId;
                        echo "<div class='col-md-12'>
                        <input type='submit' name='add_to_cart' class='btn btn-primary' id='purchaseMovie' value='Add to Cart' disable>                        </form>
                    </div>";
                    } else {
                        echo "<div class='col-md-12'>
                    </div>
                    <br><br><br>
                    <div class='col-md-12'>
                        <a href='home.php' class='btn btn-primary'>Back to Home</a>
                    </div>";
                    }
                }
                ?>
            </div>
        </div><!-- end row -->
    </div><!-- end container -->


    <script src="js/functions.js"></script>



</body>

</html>