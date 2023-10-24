<?php echo
include('../config/conn.php');
include('../functions/common.php');

@session_start();

$username = $_SESSION['username'];


$user_ip = getIPAddress();

$select_query = "SELECT * FROM user_table WHERE username = '$username'";
$result = mysqli_query($conn, $select_query);
$fetch_data = mysqli_fetch_assoc($result);
$user_id = $fetch_data['user_id'];




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- import fontawesome link later -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        img {
            width: 90%;
            height: auto;
            margin: auto;
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center text-info">Payment Options</h2>

        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-md-6">
                <a href="https://www.paypal.com" target="_blank"><img src="../images/port2.jpg" alt="..."></a>
            </div>
            <div class="col-md-6">
                <a href="./order.php?user_id=<?php echo $user_id ?>" class="text-decoration-none">
                    <h2 class="text-center">
                        pay offline
                    </h2>
                </a>
            </div>
        </div>
    </div>

</body>

</html>