<?php
include('../../config/conn.php');
//include(__DIR__ . '/../../../functions/common.php');

echo getcwd();

?>

<?php
function registerUser()
{
    global $conn;
    if (isset($_POST['user_register'])) {
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $confirm_password = $_POST['confirm_password'];
        $user_address = $_POST['user_address'];
        $user_contact = $_POST['user_contact'];
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];
        $user_ip = getIPAddress();

        // move uploaded image
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        $insert_query = "INSERT INTO user_table (username, user_email, user_password, user_ip, user_image, user_address, user_mobile) VALUES ('$username', '$user_email', '$user_password', ' $user_ip', '$user_image', '$user_address', '$user_contact')";

        $sql_execute = mysqli_query($conn, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('User registered')</script>";
        } else {
            die(mysqli_error($conn));
        }
    }
}
