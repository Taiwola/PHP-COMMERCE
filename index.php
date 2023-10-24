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

session_start();

$_SESSION['name'] = "john";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce</title>
    <link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        .btn {
            border: none;
            background-color: darkcyan;
        }

        .btn:hover {
            background-color: black;
            color: white;
        }
    </style>
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

                        <?php

                        if (isset($_SESSION["username"])) {
                            echo " <li class='nav-item'>
                        <a class='nav-link' href='./user_area/profile.php'>My Accout</a>
                    </li>";
                        } else {
                            echo "
                        <li class='nav-item'>
                        <a class='nav-link' href='./user_area/user_registration.php'>Register</a>
                    </li>";
                        }

                        ?>

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
                    <form action="search.php" method="get" class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" name="search_data" aria-label="Search">
                        <!-- <button class="btn btn-outline-dark" type="submit">Search</button> -->
                        <input type="submit" value="search" class="btn btn-outline-dark" name="search_query">
                    </form>
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
                    <a href="./user_area/profile.php" class="btn" aria-current="page" href="/">
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
    <div class="row me-0">
        <div class="col-md-10">
            <!-- products -->
            <div class="row">
                <?php if (!isset($_GET['category']) && !isset($_GET['brand'])) : ?>
                    <?php foreach ($row_product as $product) : ?>
                        <?php generateProductCard($product); ?>
                    <?php endforeach; ?>
                <?php elseif (isset($_GET['category'])) : ?>
                    <?php
                    // Check if $unique_categories is an array or object before using foreach
                    if (is_array($unique_categories) || is_object($unique_categories)) {
                        foreach ($unique_categories as $unique) {
                            generate_unique_products($unique);
                        }
                    } else {
                        echo "<h1 class='text-center text-danger'>No stock for this category</h1>";
                    }
                    ?>
                <?php elseif (isset($_GET['brand'])) : ?>
                    <?php
                    // Check if $unique_brands is an array or object before using foreach
                    if (is_array($unique_brands) || is_object($unique_brands)) {
                        foreach ($unique_brands as $brand) {
                            generate_unique_products($brand);
                        }
                    } else {
                        echo "<h1 class='text-center text-danger'>No stock for this brand</h1>";
                    }
                    ?>
                <?php endif; ?>
            </div>



        </div>
        <div class="col-md-2 bg-secondary  p-0">
            <!-- side nav -->
            <ul class="navbar-nav me-auto text-center">
                <!-- brand to be displaed -->
                <li class="nav-item nav-list bg-info-subtle mb-1">
                    <a href="#" class="nav-link">
                        <h4>Delivery Brands</h4>
                    </a>
                </li>
                <?php foreach ($row_brand as $brand) : ?>
                    <?php generateBrandListItem($brand) ?>
                <?php endforeach; ?>
            </ul>

            <ul class="navbar-nav me-auto text-center">
                <!-- categories to be displaed -->
                <li class="nav-item nav-list bg-info-subtle mb-1">
                    <a href="#" class="nav-link">
                        <h4>Categories</h4>
                    </a>
                </li>
                <?php foreach ($row_category as $category) : ?>
                    <?php generateCategoryListItem($category) ?>
                <?php endforeach ?>
            </ul>
        </div>
    </div>


    <!-- last child -->
    <?php include('./includes/footer.php') ?>