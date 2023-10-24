<?php
include('../config/conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                    <a class="nav-link" aria-current="page" href="./user_logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
    </nav>


    <div class="row">
        <?php
        if (!isset($_SESSION['username'])) {
            include('./user_login.php');
        } else {
            include('./payment.php');
        }
        ?>
    </div>

    <?php include("../includes/footer.php") ?>