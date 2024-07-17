<?php

include('../config/conn.php');

@session_start();

if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['username'];
    $admin_password = $_POST['password'];

    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);

    if ($row_count > 0) {
        if (password_verify($admin_password, $row_data['admin_password'])) {
            $_SESSION['admin_username'] = $admin_username;
            echo "<script>alert('User successfully logged in')</script>";
            echo "<script>window.open('./index.php', '_self')</script>";
        } else {
            echo "<script>alert('invalid credential')</script>";
        }
    } else {
        echo "<script>alert('invalid credential')</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <div class="container-fluid m-3">
        <h2 class="text-center mb-5">Admin Login</h2>
    </div>

    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/joe-woods-4Zaq5xY5M_c-unsplash.jpg" alt="...aim" class="img-fluid">
        </div>

        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" name="username" placeholder="Enter your username" require="required" id="username" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password: </label>
                    <input type="password" name="password" placeholder="Enter your password" require="required" id="password" class="form-control">
                </div>
                <div>
                    <input type="submit" value="Login" class="bg-info py-2 border-0" name="admin_login">
                    <p class="small fw-bold mt-2 pt-1">Don't have an account yet ? <a href="./register_admin.php" class="link-danger">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>