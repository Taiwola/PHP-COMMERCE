<?php
include('../config/conn.php');
@session_start();

if (isset($_POST['delete_account'])) {
    $username = $_SESSION['username'];
    $user_query = "SELECT * FROM user_table WHERE username = '$username'";
    $result = mysqli_query($conn, $user_query);
    $fetched_result = mysqli_fetch_assoc($result);
    $user_id = $fetched_result['user_id'];
    // delete all related data in other tables first
    $delete_pending_orders = "DELETE FROM orders_pending WHERE user_id = $user_id";
    $run_pending_orders_query = mysqli_query($conn, $delete_pending_orders);


    $delete_completed_orders = "DELETE FROM user_orders WHERE user_id = $user_id";
    $run_completed_orders_query = mysqli_query($conn, $delete_completed_orders);

    // delete user
    if ($run_pending_orders_query && $run_completed_orders_query) {
        $delete_user = "DELETE FROM user_table WHERE user_id = $user_id";
        $run_user_query = mysqli_query($conn, $delete_user);
        if ($run_user_query) {
            echo "<script>alert('Account Deleted Successfully!')</script>";
            echo "<script>window.open('../index.php', '_self')</script>";
        } else {
            echo "<script>alert('Error Occurred! Please Try Again Later.')</script>";
            echo "<script>window.open('profile.php?delete_account', '_self')</script>";
        }
    } else {
        echo "<script>alert('Error Occurred! Please Try Again Later.')</script>";
        echo "<script>window.open('profile.php?delete_account', '_self')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
</head>

<body>
    <div class="container">
        <h2 class="text-success">Delete Account</h2>
        <form action="" method="POST">
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" name="delete_account" class="form-control w-50 m-auto bg-danger border-0 text-light" value="Delete Account">
            </div>
            <div class="form-outline my-4 text-center w-50 m-auto">
                <input type="submit" name="delete_account" class="form-control w-50 m-auto bg-success border-0 text-light" value="Don't delete account">
            </div>
        </form>
    </div>
</body>

</html>