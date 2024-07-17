<?php
$get_orders = "SELECT * FROM user_orders";
$result = mysqli_query($conn, $get_orders);
$count = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-success text-center">All orders</h3>

    <table class="table table-bordered mt-5">
        <?php



        echo "
            <thead>
            <tr>
                <th class='bg-info'>SL.no</th>
                <th class='bg-info'>Due Amount</th>
                <th class='bg-info'>Invoice number</th>
                <th class='bg-info'>Total products</th>
                <th class='bg-info'>Order Date</th>
                <th class='bg-info'>Status</th>
                <th class='bg-info'>Delete</th>
            </tr>
        </thead>
        <tbody>
            ";

        if ($count == 0) {
            echo "<h2 class='bg-danger text-center mt-5'>No order yet</h2>";
        } else {
            $number = 0;
            while ($row_date = mysqli_fetch_assoc($result)) {
                $order_id = $row_date['order_id'];
                $user_id = $row_date['user_id'];
                $order_amount = $row_date['amount'];
                $invoice = $row_date['invoice_number'];
                $total_products = $row_date['total_products'];
                $order_date = $row_date['order_date'];
                $order_status = $row_date['order_status'];
                $number++;

                echo "
                <tr>
                <td class='bg-secondary text-light text-center'>$number</td>
                <td class='bg-secondary text-light text-center'>$order_amount</td>
                <td class='bg-secondary text-light text-center'>$invoice</td>
                <td class='bg-secondary text-light text-center'>$total_products</td>
                <td class='bg-secondary text-light text-center'>$order_date</td>
                <td class='bg-secondary text-light text-center'>$order_status</td>
                <td class='bg-secondary text-light text-center'>
                <a href='index.php?delete_order=$order_id' class='text-light'><i class='fa-solid fa-trash'></i></a>
                </td>
            </tr>
                ";
            }
        }
        ?>
        </tbody>
    </table>
</body>

</html>