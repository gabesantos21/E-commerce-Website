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
        include 'navbar/navbar.php';
    } else {
        include 'navbar/guestNavbar.php';
    }
    @$movieName = $_POST['movieName'];

    ?>

    <div style="width: auto;">
        <center>
            <div style="padding:10rem" id="searchProduct">
                <form class="form-inline my-2 my-lg-0" action="" method="POST">
                    <input name="movieName" style="width: 33rem;" class="form-control mr-sm-2" type="search" placeholder="Hi <?php echo "$username" ?>, what movie do you want to buy?" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </center>
    </div>
    <?php
    if ($movieName != '') {
    ?>
        <center>
            <center>
                <div id="browseProducts">
                    <h3>Showing results of your search: <span style="color: yellowgreen;"><?php echo "$movieName" ?></span></h3>
                </div>
                <br>
                <br>
            </center>
            <?php
            $movieName = htmlspecialchars($movieName); // changes characters used in html to their equivalents
            $movieName = mysqli_real_escape_string($conn, $movieName); // makes sure nobody uses SQL injection

            $sql = "SELECT * FROM product_list WHERE (`productName` LIKE '%" . $movieName . "%') OR (`productName` LIKE '%" . $movieName . "%')";
            $result = mysqli_query($conn, $sql);
            ?>

            <div style="width: auto; text-align:center; margin: 5rem 10rem 10rem 10rem;" id="browseProducts">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
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
            }
                ?>
                </div>
            </div>
        </center>



</body>

</html>