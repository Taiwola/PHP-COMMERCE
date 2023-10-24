<?php
include('../config/conn.php');
include('../functions/common.php');
@session_start();


if (!isset($_SESSION['username'])) {
    echo "<script>window.open('../index.php', '_self') </script>";
}

$username = $_SESSION['username'];
$select_img = "SELECT * FROM user_table WHERE username='$username'";
$img_query = mysqli_query($conn, $select_img);
$fetch_img = mysqli_fetch_assoc($img_query);
$user_img = $fetch_img['user_image'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        main h2 {
            text-align: center;
            margin: 10px 10px;
        }

        .section {
            display: flex;
            width: 100%;
            margin-block: 10px;
            gap: 10px;
        }

        .dashboard {
            padding: 20px;
            background-color: darkblue;
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 15%;
        }

        .img-cover {
            width: 160px;
            height: 150px;
            overflow: hidden;
            background-color: blueviolet;
        }

        .img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn {
            border: none;
            background-color: darkcyan;
        }

        .btn-logout {
            border: none;
            background-color: firebrick;
        }

        .btn:hover {
            background-color: black;
            color: white;
        }

        .dash_display {
            background-color: grey;
            width: 85%;
            text-align: center;
            padding-block: 20px;
        }

        .logo {
            width: 7%;
            height: 7%;
            border-radius: 10%;
            object-fit: contain;
        }

        .edit_img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <img src="../images/logo.jpg" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../display_all.php">Products</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="./user_registration.php">Register</a>
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
                    <form action="../search.php" method="get" class="d-flex" role="search">
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
                <?php
                header("Location: ../index.php");
                exit;
                ?>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Welcome guest</a>
                </li>
                <?php
                header("Location: ../index.php");
                exit;
                ?>
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
    </nav>


    <main>
        <h2>Welcome to your dashboard <?php echo $_SESSION['username'] ?></h2>
        <section class="section">
            <div class="dashboard">
                <div class="img-cover">
                    <img src="./user_images/<?php echo $user_img  ?>" alt="...." class="img">
                </div>
                <a href="profile.php" class="btn">Pending orders</a>
                <a href="?edit_account" class="btn">Edit Account</a>
                <a href="?my_orders" class="btn">My Orders</a>
                <a href="?delete_account" class="btn">Delete Account</a>
                <a href="./user_logout.php" class="btn-logout btn">Logout</a>
            </div>
            <div class="dash_display">
                <?php get_user_order_details();
                if (isset($_GET['edit_account'])) {
                    include('./edit_account.php');
                }
                if (isset($_GET['my_orders'])) {
                    include('user_orders.php');
                }
                if (isset($_GET['delete_account'])) {
                    include('delete_account.php');
                }
                ?>
            </div>
        </section>
    </main>


    <?php include('../includes/footer.php') ?>