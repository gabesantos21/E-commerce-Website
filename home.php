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
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['username'])) {
        if ($_SESSION['username'] == 'admin') {
            include 'navbar/adminNavbar.php';
        } else {
            include 'navbar/navbar.php';
        }
    } else {
        include 'navbar/guestNavbar.php';
    }

    ?>

    <div style="width: auto;">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">

            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>


            <div class="carousel-inner">
                <div class="item active">
                    <img src="img/carousel-1.png" alt="Buy newly released movies!">
                </div>

                <div class="item">
                    <img src="img/carousel-2.png" alt="Only for as low as $10">
                </div>

                <div class="item">
                    <img src="img/carousel-3.png" alt="Place your orders NOW!">
                </div>
            </div>


            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <br>
    <center>
        <div style="padding:10rem;" id="browseProducts">
            <h1>Have a look at our <span style="color: yellowgreen;">movies</span> below.</h1>
        </div>
    </center>
    <center>
        <div style="width: auto; text-align:center; margin: 5rem 10rem 10rem 10rem;">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $sql = "SELECT * FROM product_list";
                $result = mysqli_query($conn, $sql);

                $row_size = mysqli_num_rows($result);
                while ($row = mysqli_fetch_array($result)) {
                    echo "<a href='productPage.php?itemId=" . $row['productId'] - 1 . "'>";
                    echo "<div class='col' style='margin-bottom:3rem'>";
                    echo "<div class='card h-100 cardProduct'>";
                    echo "<img src='img/" . $row['productImage'] . "' class='card-img-top' alt='...'>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $row['productName'] . "</h5>";
                    echo "<small class='text-muted'>$" . $row['price'] . "</small>";
                    echo "</div>";
                    // echo "<div type='submit' class='card-footer btn btn-success'> Add to cart";
                    // echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
                ?>
            </div>
        </div>
    </center>



</body>

</html>