<?php

if (isset($_GET['delete_user'])) {
    $user_id = $_GET['delete_user'];
    $delete_product = "DELETE FROM user_table WHERE user_id='$user_id' ";
    $delete_result = mysqli_query($conn, $delete_product);

    if ($delete_result) {
        echo "<script>alert('user deleted successfully')</script>";
        echo "<script>window.open('./index.php', '_self')</script>";
    }
}
