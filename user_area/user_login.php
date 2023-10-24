<?php

include('../config/conn.php');

@session_start();

function getIPAddress()
{
    // whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    // check ip from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
    }
    // whether ip is from remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

if (isset($_POST['user_login'])) {
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];
    $user_ip = mysqli_real_escape_string($conn, getIPAddress());;

    $select_query = "SELECT * FROM user_table WHERE username='$username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    //cart_details
    $selct_query = "SELECT * FROM cart_details WHERE ip_address = '$user_ip' ";
    $cart_result = mysqli_query($conn, $selct_query);
    $rows_cart_count = mysqli_num_rows($cart_result);


    if ($row_count > 0) {
        if (password_verify($user_password, $row_data['user_password'])) {
            // echo "<script>alert('User successfully logged in')</script>";
            $_SESSION['username'] = $username;
            if ($rows_cart_count == 0) {
                $_SESSION['username'] = $username;
                echo "<script>alert('User successfully logged in')</script>";
                header("Location: profile.php");
                exit;
            } else {
                $_SESSION['username'] = $username;
                echo "<script>alert('User successfully logged in')</script>";
                header("Location: payment.php");
                exit;
            }
        } else {
            echo "<script>alert('invalid credential')</script>";
        }
    } else {
        echo "<script>alert('Invalid credential')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center m-4">Login</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-lable">username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter your username" required="required" name="username">
                    </div>

                    <!-- password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-lable">password</label>
                        <input type="password" id="password" class="form-control" placeholder="Enter your password" required="required" name="user_password">
                    </div>

                    <div class="mb-3 mt-4 pt-3">
                        <input type="submit" value="Login" class="bg-dark text-light py-2 px-3 border-0" name="user_login">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Do not have an account? <a href="user_registration.php" class="text-decoration-none text-danger">Register</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>