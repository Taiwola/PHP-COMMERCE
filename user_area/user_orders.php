<?php
$username = $_SESSION['username'];

$get_user = "SELECT * FROM user_table WHERE username = '$username'";
$run_user = mysqli_query($conn, $get_user);
$fetch_orders = mysqli_fetch_assoc($run_user);
$user_id = $fetch_orders['user_id'];

$get_orders = "SELECT * FROM user_orders WHERE user_id=$user_id";
$order_results = mysqli_query($conn, $get_orders);
$count_orders = mysqli_num_rows($order_results);



function generate_order_table()
{
    global $order_results;
    $number = 1;
    while ($fetch_orders = mysqli_fetch_assoc($order_results)) {
        $o_id = $fetch_orders['order_id'];
        $amount_due = $fetch_orders['amount'];
        $invoice_no = $fetch_orders['invoice_number'];
        $total_products = $fetch_orders['total_products'];
        $order_date = $fetch_orders['order_date'];
        $order_status = $fetch_orders['order_status'];
        if ($order_status == 'pending') {
            $order_status = 'incomplete';
        } else {
            $order_status = 'completed';
        }
        $date = date('d-m-y', strtotime($order_date));

        // Start the HTML table row
        echo "<tr>";

        // Output the table data (TD) elements
        echo "
            <td class='bg-secondary text-light'>" . $number . "</td>
            <td class='bg-secondary text-light'>" . $amount_due . "</td>
            <td class='bg-secondary text-light'>" . $total_products . "</td>
            <td class='bg-secondary text-light'>" . $invoice_no . "</td>
            <td class='bg-secondary text-light'>" . $date . "</td>
            <td class='bg-secondary text-light'>" . $order_status . "</td>";

        // Increment the number
        $number++;

        // Output the last TD element and close the table row
        if ($order_status == 'completed') {
            echo "<td class='bg-secondary text-light'>Paid</td>";
        } else {
            echo "<td class='bg-secondary text-light'>
                <a href='confirm.php?order_id=" . $o_id . "' class='text-light'>confirm</a>
            </td>";
        }
        echo "</tr>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h3 class="text-center text-success">All Orders</h3>

    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th class="bg-info">Sl no</th>
                <th class="bg-info">Amount Due</th>
                <th class="bg-info">Total Product</th>
                <th class="bg-info">Invoice Number</th>
                <th class="bg-info">Date</th>
                <th class="bg-info">Complete/Incomplete</th>
                <th class="bg-info">Status</th>
            </tr>
        </thead>
        <tbody>

            <?php generate_order_table() ?>

        </tbody>
    </table>
</body>

</html>