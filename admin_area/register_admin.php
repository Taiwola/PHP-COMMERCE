<?php
include('../config/conn.php');
session_start();

if (isset($_POST['admin_registration'])) {
    $admin_name = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $conf_password = $_POST['confirm_password'];

    if ($admin_password !== $conf_password) {
        echo "<script>alert('Password do not match')</script>";
    }

    $select_query = "SELECT * FROM admin_table WHERE admin_name='$admin_name' or admin_email='$admin_email'";
    $result = mysqli_query($conn, $select_query);
    $rows_count = mysqli_num_rows($result);

    if ($rows_count > 0) {
        echo "<script>alert('user already exist') </script>";
    }

    $hash_password = password_hash($admin_password, PASSWORD_BCRYPT);

    $insert_query = "INSERT INTO admin_table (admin_name, admin_email, admin_password) VALUES ('$admin_name', '$admin_email', '$hash_password')";

    $sql_execute = mysqli_query($conn, $insert_query);

    if ($sql_execute) {
        echo "<script>alert('User registered')</script>";
    } else {
        die(mysqli_error($conn));
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
        <h2 class="text-center mb-5">Admin Registration</h2>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/billy-huynh-W8KTS-mhFUE-unsplash.jpg" alt="...aim" class="img-fluid">
        </div>

        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username: </label>
                    <input type="text" name="username" placeholder="Enter your username" require="required" id="username" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" name="email" placeholder="Enter your email" require="required" id="email" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password: </label>
                    <input type="password" name="password" placeholder="Enter your password" require="required" id="password" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="confirm_password" class="form-label">Confirm Password: </label>
                    <input type="password" name="confirm_password" placeholder="Enter your password" require="required" id="confirm_password" class="form-control">
                </div>
                <div>
                    <input type="submit" value="Register" class="bg-info py-2 border-0" name="admin_registration">
                    <p class="small fw-bold mt-2 pt-1">Have an account ? <a href="./admin_login.php" class="link-danger">login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>