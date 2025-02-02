<?php
include('../config/conn.php');
include('../functions/common.php');

@session_start();


if (!isset($_SESSION['admin_username'])) {
    echo "<script>window.open('./admin_login.php', '_self') </script>";
} else {
    $admin_user = $_SESSION['admin_username'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashbord</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .admin_img {
            width: 100px;
            object-fit: cover;
        }

        .btn {
            border: none;
            background-color: #D2E0FB;
        }
    </style>
</head>

<body>
    <div class="container-fluid me-0 p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="../index.php">
                    <img src="../images/logo.jpg" alt="" class="logo">
                </a>
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="" class="nav-link"><?php echo $admin_user ?></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>

    <!-- second child -->
    <div class="bg-dark-subtle">
        <h3 class="text-center p-2">
            Manage Details
        </h3>
    </div>


    <!-- third child -->
    <div class="row me-0">
        <div class="col-md-12 bg-secondary-subtle d-flex align-items-center gap-3">
            <div class="p-3">
                <a href="/index.php"><img src="../images/port4.jpg" class="admin_img" alt=""></a>
                <p class="text-center text-dark">Admin name</p>
            </div>
            <div class="button text-center my-3">
                <button class="btn"><a href="insert_product.php" class="text-dark nav-link my-1">insert products</a></button>
                <button class="btn"><a href="index.php?view_products" class="text-dark nav-link my-1">View Products</a></button>
                <button class="btn"><a href="index.php?insert_category" class="text-dark nav-link my-1">Insert Categories</a></button>
                <button class="btn"><a href="index.php?view_category" class="text-dark nav-link my-1">View Categories</a></button>
                <button class="btn"><a href="index.php?insert_brand" class="text-dark nav-link my-1">Insert Brand</a></button>
                <button class="btn"><a href="index.php?view_brand" class="text-dark nav-link my-1">View Brands</a></button>
                <button class="btn"><a href="index.php?all_orders" class="text-dark nav-link my-1">All Orders</a></button>
                <button class="btn"><a href="index.php?all_payment" class="text-dark nav-link my-1">AllPayments</a></button>
                <button class="btn"><a href="index.php?all_users" class="text-dark nav-link my-1">List Users</a></button>
                <button class="btn"><a href="./admin_logout.php" class="text-dark nav-link my-1">Logout</a></button>
            </div>
        </div>
    </div>

    <!-- fourth child -->
    <div class="container my-5">
        <?php if (isset($_GET['insert_category'])) {
            include('insert_categories.php');
        } elseif (isset($_GET['insert_brand'])) {
            include('insert_brands.php');
        } elseif (isset($_GET['view_products'])) {
            include('view_products.php');
        } elseif (isset($_GET['edit_products'])) {
            include('edit_products.php');
        } elseif (isset($_GET['delete_products'])) {
            include('delete_product.php');
        } elseif (isset($_GET['view_category'])) {
            include('view_category.php');
        } elseif (isset($_GET['edit_category'])) {
            include('edit_category.php');
        } elseif (isset($_GET['delete_category'])) {
            include('delete_category.php');
        } elseif (isset($_GET['view_brand'])) {
            include('view_brands.php');
        } elseif (isset($_GET['edit_brand'])) {
            # code...
            include('edit_brand.php');
        } elseif (isset($_GET['delete_brand'])) {
            # code...
            include('delete_brand.php');
        } elseif (isset($_GET['all_orders'])) {
            include('all_orders.php');
        } elseif (isset($_GET['all_payment'])) {
            include('view_all_payment.php');
        } elseif (isset($_GET['delete_payment'])) {
            include('delete_payment.php');
        } elseif (isset($_GET['all_users'])) {
            include('get_all_users.php');
        } elseif (isset($_GET['delete_user'])) {
            include('delete_user.php');
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </script>
</body>

</html>