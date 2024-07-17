<?php

$select_brand = "SELECT * FROM brands";
$result_query = mysqli_query($conn, $select_brand);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">All Brands</h3>
    <table class="table table-bordered mt-5">
        <thead class="bg-info">
            <th class="bg-info">SL.no</th>
            <th class="bg-info">Category title</th>
            <th class="bg-info">Edit</th>
            <th class="bg-info">Delete</th>
        </thead>
        <tbody class="bg-secondary text-light">
            <?php
            $number = 1;
            while ($row = mysqli_fetch_assoc($result_query)) {
                $brand_id = $row['brand_id'];
                $brand_title = $row['brand_title'];

                echo "
                    <tr>
                <td class='bg-secondary text-light text-center'>$number</td>
                <td class='bg-secondary text-light text-center'>$brand_title</td>
                <td class='bg-secondary text-light text-center'>
                    <a href='index.php?edit_brand=$brand_id' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a>
                </td>
                <td class='bg-secondary text-light text-center'>
                    <a href='index.php?delete_brand=$brand_id' class='text-light'><i class='fa-solid fa-trash'></i></a>
                </td>
            </tr>
                    ";
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>