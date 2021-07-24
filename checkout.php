<?php
session_start();

include 'db_conn.php';

if ($_SERVER["HTTPS"] != "on") {
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}

if (isset($_POST["add_to_cart"])) {
    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if (!in_array($_GET["id"], $item_array_id)) {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'            =>    $_GET["id"],
                'item_name'            =>    $_POST["productName"],
                'item_price'        =>    $_POST["productPrice"],
                'item_quantity'        =>    $_POST["productQuantity"],
                'item_image'        =>    $_POST["productImage"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        } else {
            echo '<script>alert("Item Already Added")</script>';
        }
    } else {
        $item_array = array(
            'item_id'            =>    $_GET["id"],
            'item_name'            =>    $_POST["productName"],
            'item_price'        =>    $_POST["productPrice"],
            'item_quantity'        =>    $_POST["productQuantity"],
            'item_image'        =>    $_POST["productImage"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}

if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete") {
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["item_id"] == $_GET["id"]) {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="checkout.php"</script>';
            }
        }
    }
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
        td {
            text-align: center;
        }

        img:hover {
            border-color: blue;
            transition-delay: .01s;
            transition-timing-function: linear;
            transform: scale(1.05);
        }

        button {
            transition: all .5s ease;
            color: green;
            border: 3px solid green;
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            line-height: 1;
            background-color: transparent;
            outline: none;
            border-radius: 4px;
        }

        button:hover {
            color: white;
            background-color: green;
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
    <div style="padding:3rem 10rem 10rem 10rem;">
        <h1>Your Checkout</h1>
        <br>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <td scope="col">Product Name</td>
                    <td scope="col">Poster</td>
                    <td scope="col">Quantity</td>
                    <td scope="col">Price</td>
                    <td scope="col">Total</td>
                    <td scope="col">Action</td>
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
                    <td style="vertical-align: middle;"><a href="checkout.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
                </tr>
            <?php
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);
                        }
            ?>
            <tr>
                <td colspan="4" align="right"></td>
                <td align="right" style="color: green;"> <b>$ <?php echo number_format($total, 2); ?></b></td>
                <td><button style=" border-radius: 10px;" onclick="location.href = 'checkoutPayment.php'"> Confirm checkout</button></td>
            </tr>
        <?php
                    }
        ?>
            </tbody>
        </table>
    </div>


</body>

</html>