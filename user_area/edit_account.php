<?php

if (isset($_GET['edit_account'])) {
    $username = $_SESSION['username'];
    $select_query = "SELECT * FROM user_table WHERE username = '$username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_fetch_assoc($result);

    $user_id = $row_count['user_id'];
    $user_email = $row_count['user_email'];
    $user_image = $row_count['user_image'];
    $user_address = $row_count['user_address'];
    $user_mobile = $row_count['user_mobile'];


    if (isset($_POST['user_update'])) {
        $update_id = $user_id;
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_address = $_POST['user_address'];
        $user_mobile = $_POST['user_mobile'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // update query
        $update_data = "UPDATE user_table set username='$username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
        $result_query = mysqli_query($conn, $update_data);

        if ($result_query) {
            echo "<script>alert('Profile updated successfully')</script>";
            echo "<script>window.open('user_logout.php', '_self') </script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
</head>

<body>
    <h3 class="text-center text-success mb-4">Edit Account</h3>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="username" value="<?php echo $username ?>">
        </div>
        <div class="form-outline mb-4">
            <input type="email" class="form-control w-50 m-auto" name="user_email" value="<?php echo $user_email ?>">
        </div>
        <div class="form-outline mb-4 d-flex  w-50 m-auto">
            <input type="file" class="form-control" name="user_image">
            <img src="./user_images/<?php echo $user_img ?>" alt="" class="edit_img">
        </div>
        <div class="form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_address" value="<?php echo $user_address ?>">
        </div>
        <div class=" form-outline mb-4">
            <input type="text" class="form-control w-50 m-auto" name="user_mobile" value="<?php echo $user_mobile ?>">
        </div>
        <input type="submit" class="btn m-auto" name="user_update" value="Update">
    </form>
</body>

</html>