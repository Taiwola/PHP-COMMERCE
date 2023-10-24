<?php
include('./config/conn.php');
include('./functions/common.php');
//$select_brand = "SELECT * FROM brands";
//$brand_result = mysqli_query($conn, $select_brand);
//$row_brand =  mysqli_fetch_all($brand_result, MYSQLI_ASSOC);

// fetch all from categories
//$select_category = "SELECT * FROM categories";
//$category_result = mysqli_query($conn, $select_category);
//$row_category = mysqli_fetch_all($category_result, MYSQLI_ASSOC);

// fectch all product
// $select_product = "SELECT * FROM products ORDER BY rand() LIMIT 0,9";
// $product_result = mysqli_query($conn, $select_product);
// $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);


$row_product = getFunc();
$row_brand = getBrands();
$row_category = getCategories();
$unique_categories = get_unique_categories();
$unique_brands = get_unique_brands();
// $ip = getIPAddress();
// echo "Client's IP address is: " . $ip;
cart();
remove_item_cart();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="./images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display_all.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./user_area/user_registration.php">Register</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item_no() ?></sup></a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price: <?php total_price()  ?>/-</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- second child -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <ul class="navbar-nav me-auto">
            <?php if (!isset($_SESSION['username'])) { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">Welcome guest</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/">
                        <?php
                        $username = $_SESSION['username'];
                        echo "Welcome $username";
                        ?>
                    </a>
                </li>
            <?php } ?>
            <?php if (!isset($_SESSION['username'])) { ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./user_area/user_login.php">Login</a>
                </li>
            <?php } else { ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="./user_area/user_logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <!-- third child -->
    <div class="bg-light p-2">
        <h3 class="text-center">
            New Age
        </h3>
        <p class="text-center">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, placeat?
        </p>
    </div>


    <!-- fourth child -->
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Product title</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Remove</th>
                            <th colspan="2">Operations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fetch dynamic data -->
                        <?php getCart() ?>
                    </tbody>
                </table>

                <!-- subtitle -->
                <div class="d-flex gap-1 mb-5">
                    <?php checkOutButton() ?>
                </div>
            </div>
        </form>
    </div>



    <?php include("./includes/footer.php") ?>