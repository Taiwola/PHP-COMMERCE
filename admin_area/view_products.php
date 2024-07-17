<?php
$get_Product = "SELECT * FROM products";
$product_query = mysqli_query($conn, $get_Product);


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
    <h1 class="text-center text-success">All Product</h1>

    <table class="table table-bordered mt-5">
        <thead class="text-center">
            <tr>
                <th class="bg-info">Product ID</th>
                <th class="bg-info">Product Title</th>
                <th class="bg-info">Product Image</th>
                <th class="bg-info">Product Price</th>
                <th class="bg-info">Total Sold</th>
                <th class="bg-info">Status</th>
                <th class="bg-info">Edit</th>
                <th class="bg-info">Delete</th>
            </tr>
        </thead>
        <tbody class="text-light bg-secondary text-center">
            <?php
            $number = 1;
            while ($row = mysqli_fetch_assoc($product_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_price = $row['product_price'];
                $product_image = $row['product_image1'];
                $status = $row['status'];
                if ($status == 1) {
                    $product_status = 'true';
                }

                $get_total = "SELECT * FROM orders_pending WHERE product_id = $product_id";
                $result_count = mysqli_query($conn, $get_total);
                $rows_count = mysqli_num_rows($result_count);


                echo "
                <tr>
                <td class='text-light bg-secondary text-center'>" . $number . "</td>
                <td class='text-light bg-secondary'>" . $product_title . "</td>
                <td class='text-light bg-secondary'><img src='./product_images/" . $product_image . "' alt='...' class='img' ></td>
                <td class='text-light bg-secondary'>" . $product_price . "</td>
                <td class='text-light bg-secondary'>" . $rows_count . "</td>
                <td class='text-light bg-secondary'>" . $product_status . "</td>
                <td class='text-light bg-secondary'><a href='index.php?edit_products=" . $product_id . "' class='text-light'><i class='fa-solid fa-pen-to-square'></i></a></td>
                <td class='text-light bg-secondary'><a href='index.php?delete_products=" . $product_id . "' class='text-light'><i class='fa-solid fa-trash'></i></a></td>
            </tr>
                ";
                $number++;
            }
            ?>
        </tbody>
    </table>
</body>

</html>