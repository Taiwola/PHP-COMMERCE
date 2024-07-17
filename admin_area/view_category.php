<?php

$select_category = "SELECT * FROM categories";
$result_query = mysqli_query($conn, $select_category);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">All Categories</h3>
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
                $category_id = $row['category_id'];
                $category_title = $row['category_title'];

                echo "
                    <tr>
                <td class='bg-secondary text-light text-center'>$number</td>
                <td class='bg-secondary text-light text-center'>$category_title</td>
                <td class='bg-secondary text-light text-center'>
                    <a href='index.php?edit_category=$category_id' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a>
                </td>
                <td class='bg-secondary text-light text-center'>
                    <a href='index.php?delete_category=$category_id' class='text-light'><i class='fa-solid fa-trash'></i></a>
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