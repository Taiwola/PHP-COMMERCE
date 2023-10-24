<?php

include('../config/conn.php');
//include('../functions/common.php');
session_start();

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


if (isset($_POST['user_register'])) {
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $confirm_password = $_POST['confirm_password'];
    $user_address = $_POST['user_address'];
    $user_contact = $_POST['user_contact'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = mysqli_real_escape_string($conn, getIPAddress());

    $select_query = "SELECT * FROM user_table WHERE username='$username' or user_email='$user_email'";
    $result = mysqli_query($conn, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('user already exist') </script>";
    } elseif ($user_password != $confirm_password) {
        echo "<script>alert('password does not match') </script>";
    } else {
        // move uploaded image
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");
        $hash_password = password_hash($user_password, PASSWORD_BCRYPT);

        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_ip, user_image, user_address, user_mobile) VALUES ('$username', '$user_email', '$hash_password', ' $user_ip', '$user_image', '$user_address', '$user_contact')";

        $sql_execute = mysqli_query($conn, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('User registered')</script>";
        } else {
            die(mysqli_error($conn));
        }
    }


    // selecting cart items 
    $selct_query = "SELECT * FROM cart_details WHERE ip_address = '$user_ip' ";
    $cart_result = mysqli_query($conn, $select_query);
    $rows_cart_count = mysqli_num_rows($cart_result);

    if ($rows_cart_count > 0) {
        $_SESSION['username'] = $username;
        echo "<script>window.open('checkout.php', '_self')</script>";
    } else {
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center m-4">New User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username -->
                    <div class="form-outline mb-4">
                        <label for="username" class="form-lable">username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter your username" required="required" name="username">
                    </div>
                    <!-- user email -->
                    <div class="form-outline mb-4">
                        <label for="email" class="form-lable">email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter your email" required="required" name="user_email">
                    </div>
                    <!-- user image -->
                    <div class="form-outline mb-4">
                        <label for="user_image" class="form-lable">Select an image</label>
                        <input type="file" id="user_image" class="form-control" required="required" name="user_image">
                    </div>
                    <!-- user password -->
                    <div class="form-outline mb-4">
                        <label for="password" class="form-lable">password</label>
                        <input type="password" id="password" class="form-control" placeholder="Enter your password" required="required" name="user_password">
                    </div>
                    <!-- confirm password -->
                    <div class="form-outline mb-4">
                        <label for="confirm_password" class="form-lable">confirm password</label>
                        <input type="password" id="confirm_password" class="form-control" placeholder="Confirm password" required="required" name="confirm_password">
                    </div>
                    <!-- user address -->
                    <div class="form-outline mb-4">
                        <label for="address" class="form-lable">address</label>
                        <input type="text" id="address" class="form-control" placeholder="Enter your address" required="required" name="user_address">
                    </div>
                    <!-- contact -->
                    <div class="form-outline mb-4">
                        <label for="contact" class="form-lable">contact</label>
                        <input type="text" id="contact" class="form-control" placeholder="Enter your contact" required="required" name="user_contact">
                    </div>

                    <div class="mb-3 mt-4 pt-3">
                        <input type="submit" value="Register" class="bg-dark text-light py-2 px-3 border-0" name="user_register">
                        <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account? <a href="user_login.php" class="text-decoration-none text-danger">Login</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>

<?php mysqli_close($conn) ?>