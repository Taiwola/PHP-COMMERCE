<?php
$get_users = "SELECT * FROM user_table";
$user_query = mysqli_query($conn, $get_users);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <style>
        img {
            width: 60px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <h1 class="text-center text-success">All user</h1>

    <table class="table table-bordered mt-5">
        <thead class="text-center">
            <tr>
                <th class="bg-info">User ID</th>
                <th class="bg-info">User Name</th>
                <th class="bg-info">User Image</th>
                <th class="bg-info">User Address</th>
                <th class="bg-info">User Mobile</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="text-light bg-secondary text-center">
            <?php
            $number = 1;
            while ($row = mysqli_fetch_assoc($user_query)) {
                $user_id = $row['user_id'];
                $user_name = $row['username'];
                $user_image = $row['user_image'];
                $user_address = $row['user_address'];
                $user_mobile = $row['user_mobile'];



                echo "
                <tr>
                <td class='text-light bg-secondary text-center'>" . $number . "</td>
                <td class='text-light bg-secondary'>" . $user_name . "</td>
                <td class='text-light bg-secondary'><img src='./product_images/" . $user_image . "' alt='...' class='img' ></td>
                <td class='text-light bg-secondary'>" . $user_address . "</td>
                <td class='text-light bg-secondary'>" . $user_mobile . "</td>
                <td class='text-light bg-secondary'><a href='index.php?delete_user=" . $user_id . "' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
                ";
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>