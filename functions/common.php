<?php
@include('./config/conn.php');

// Function to generate HTML for a product
function generateProductCard($product)
{
    $product_id = $product['product_id'];
    $product_title = $product['product_title'];
    $product_desc = $product['product_description'];
    $product_image1 = $product['product_image1'];
    $product_price = $product['product_price'];

    echo '<div class="col-md-4 mb-2">
            <div class="card">
                <img src="./admin_area/product_images/' . $product_image1 . '" class="card-img-top" alt="..." style="width: 100; height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . $product_title . '</h5>
                    <p class="card-text">' . $product_desc . '</p>
                    <p class="card-text">Price: ' . $product_price . '/-</p>
                    <a href="index.php?add_to_cart=' . $product_id . '" class="btn btn-info">Add to cart</a>
                    <a href="view_more.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
                </div>
            </div>
        </div>';
}

// generate product image
function generateProductImg($product)
{

    $product_image2 = $product['product_image2'];
    $product_image3 = $product['product_image3'];


    echo '<div class="row">
                        <div class="col-md-12">
                            <h4 class="text center text-info mb-5">Related Product</h4>
                        </div>
                        <div class="col-md-6">
                        <img src="./admin_area/product_images/' . $product_image2 . '" class="card-img-top" alt="..." style="width: 300px; height: 200px; object-fit: cover;">
                        </div>
                        <div class="col-md-6">
                        <img src="./admin_area/product_images/' . $product_image3 . '" class="card-img-top" alt="..." style="width: 300px; height: 200px; object-fit: cover;">
                        </div>
                    </div>';
}


// generate unique products
function generate_unique_products($product)
{
    $product_id = $product['product_id'];
    $product_title = $product['product_title'];
    $product_desc = $product['product_description'];
    $product_image1 = $product['product_image1'];
    $product_price = $product['product_price'];


    echo '<div class="col-md-4 mb-2">
            <div class="card">
                <img src="./admin_area/product_images/' . $product_image1 . '" class="card-img-top" alt="..." style="width: 100; height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">' . $product_title . '</h5>
                    <p class="card-text">' . $product_desc . '</p>
                    <p class="card-text">Price:' . $product_price . '/-</p>
                    <a href="index.php?add_to_cart=' . $product_id . '" class="btn btn-info">Add to cart</a>
                    <a href="view_more.php?product_id=' . $product_id . '" class="btn btn-secondary">View more</a>
                </div>
            </div>
        </div>';
}


// get unique categories
function get_unique_categories()
{
    global $conn;
    if (isset($_GET['category'])) {
        $product_id = $_GET['category'];
        $select_query = "SELECT * FROM products WHERE category_id=$product_id";
        $product_result = mysqli_query($conn, $select_query);
        $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

        $num_of_rows = mysqli_num_rows($product_result);

        if ($num_of_rows === 0) {
            $string =  'you have no categories';
            return $string;
        }

        return $row_product;
    }
}

// get unique brands
function get_unique_brands()
{
    global $conn;
    if (isset($_GET['brand'])) {
        $product_id = $_GET['brand'];
        $select_query = "SELECT * FROM products WHERE brand_id=$product_id";
        $product_result = mysqli_query($conn, $select_query);
        $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

        $num_of_rows = mysqli_num_rows($product_result);

        if ($num_of_rows === 0) {
            $string =  'you have no categories';
            return $string;
        }

        return $row_product;
    }
}

?>

<?php
// generate brands
function generateBrandListItem($brand)
{
    $brand_id = $brand['brand_id'];
    $brand_title = $brand['brand_title'];

    echo '<li class="nav-item nav-list">';
    echo '<a href="index.php?brand=' . $brand_id . '" class="nav-link">';
    echo $brand_title;
    echo '</a>';
    echo '</li>';
}

// generate category
function generateCategoryListItem($category)
{
    $category_id = $category['category_id'];
    $category_title = $category['category_title'];

    echo '<li class="nav-item nav-list">';
    echo '<a href="index.php?category=' . $category_id . '" class="nav-link">';
    echo $category_title;
    echo '</a>';
    echo '</li>';
}


// getting products
function getFunc()
{
    global $conn;
    $select_product = "SELECT * FROM products ORDER BY rand() LIMIT 0,4";
    $product_result = mysqli_query($conn, $select_product);
    $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

    return $row_product;
}

// get all products
function getAllProducts()
{
    global $conn;
    $select_product = "SELECT * FROM products ORDER BY rand()";
    $product_result = mysqli_query($conn, $select_product);
    $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

    return $row_product;
}

// getting brands
function getBrands()
{
    global $conn;
    $select_brand = "SELECT * FROM brands";
    $brand_result = mysqli_query($conn, $select_brand);
    $row_brand =  mysqli_fetch_all($brand_result, MYSQLI_ASSOC);

    return $row_brand;
}


// getting categories
function getCategories()
{
    global $conn;
    $select_category = "SELECT * FROM categories";
    $category_result = mysqli_query($conn, $select_category);
    $row_category = mysqli_fetch_all($category_result, MYSQLI_ASSOC);
    return $row_category;
}


// get searched data
function getSearch()
{
    global $conn;

    if (isset($_GET['search_query'])) {
        $user_search = $_GET['search_data'];
        $select_product = "SELECT * FROM products WHERE product_keywords like '%$user_search%'";
        $product_result = mysqli_query($conn, $select_product);
        $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);

        if (empty($row_product)) {
            $string = "Result not found";
            return $string;
        }

        return $row_product;
    } else {
        $string = "Result not found";
        return $string;
    }
}

// view more details
function getProduct()
{
    global $conn;
    if (isset($_GET['product_id'])) {

        $product_id = $_GET['product_id']; // Make sure to sanitize and validate user input.
        $select_product = "SELECT * FROM products WHERE product_id = $product_id";

        $product_result = mysqli_query($conn, $select_product);
        $row_product = mysqli_fetch_all($product_result, MYSQLI_ASSOC);
        return $row_product;
    }
}


// get IP address

function getIPAddress()
{
    // whether ip is from the share internet
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }

    // check ip from proxy
    elseif (!empty($_SERVER['HTTP_X_FORWARD_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
    }
    // whether ip is from remote address
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

// cart function 
function cart()
{
    global $conn;
    if (isset($_GET['add_to_cart'])) {
        $ip = mysqli_real_escape_string($conn, getIPAddress());
        $pID = $_GET["add_to_cart"];
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' AND product_id = $pID";
        $result_query = mysqli_query($conn, $select_query);

        if (!$result_query) {
            die("Error: " . mysqli_error($conn));
        }

        $row_product = mysqli_fetch_all($result_query, MYSQLI_ASSOC);

        if ($row_product) {
            echo "<script>alert('This item is already present inside the cart')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        } else {
            $insert = "INSERT INTO cart_details (product_id, ip_address, quantity) VALUES ('$pID', '$ip', 0)";
            $insert_query = mysqli_query($conn, $insert);
            echo "<script>alert('This item is added')</script>";
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}

// function to get the number of items in a cart
function cart_item_no()
{
    global $conn;
    if (isset($_GET['add_to_cart'])) {
        $ip = mysqli_real_escape_string($conn, getIPAddress());
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_item = mysqli_num_rows($result_query);
    } else {
        $ip = mysqli_real_escape_string($conn, getIPAddress());
        $select_query = "SELECT * FROM cart_details WHERE ip_address = '$ip'";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart_item = mysqli_num_rows($result_query);
    }
    echo $count_cart_item;
}

// get total price
function total_price()
{

    $total = utilityTotal();
    echo $total;
}


function utilityTotal()
{
    global $conn;
    $ip = mysqli_real_escape_string($conn, getIPAddress());
    $price_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' ";
    $result = mysqli_query($conn, $price_query);

    $total = 0; // Initialize total

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $select_product = "SELECT * FROM products WHERE product_id = $product_id"; // Only select the price column
        $product_result = mysqli_query($conn, $select_product);

        while ($row_product_price = mysqli_fetch_array($product_result)) {
            $product_price = $row_product_price['product_price']; // Get the product price
            $total += $product_price; // Accumulate the total price
        }
    }

    return $total;
}

function generateCartTable($table)
{
    $title = $table['product_title'];
}

function getCart()
{
    global $conn;
    $ip = mysqli_real_escape_string($conn, getIPAddress());
    $price_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' ";
    $result = mysqli_query($conn, $price_query);
    $total = 0;
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $product_id = $row['product_id'];
            $select_product = "SELECT * FROM products WHERE product_id = $product_id"; // Only select the price column
            $product_result = mysqli_query($conn, $select_product);

            while ($row_product_price = mysqli_fetch_array($product_result)) {
                $product_price = $row_product_price['product_price']; // Get the product price
                $product_table_price = $row_product_price['product_price'];
                $product_title = $row_product_price['product_title'];
                $product_image = $row_product_price['product_image1'];
                $total += $product_price; // Accumulate the total price

                echo '<tr>
                        <td>' . $product_title . '</td>
                        <td><img src="./images/ ' . $product_image . ' " style="width: 80px; height: 80px;" alt=""></td>
                        <td><input type="text" name="qty" placeholder="quantity" class="form-input w-50"></td>
                        <td>' . $product_table_price . '</td>
                        <td><input type="checkbox" name="removeitem[]" value="' . $product_id . '"></td>
                        <td>
                            <input type="submit" class="bg-grey px-3 py-2 border-0 mx-3" value="Update cart" name="update_cart">
                            <input type="submit" class="bg-grey px-3 py-2 border-0 mx-3" value="remove cart" name="remove_item">
                        </td>
                    </tr>';
            }
        }
    } else {
        echo "<h3 class='text-danger text-center'> No Item </h3>";
    }
}

function  updateTotal()
{
    global $conn;
    $ip = mysqli_real_escape_string($conn, getIPAddress());
    $total = utilityTotal();
    if (isset($_POST['update_cart'])) {
        $quantities = $_POST['qty'];
        $update_cart = $update_cart = "UPDATE cart_details SET quantity=$quantities WHERE ip_address='$ip'";
        $result_products_query = mysqli_query($conn, $update_cart);

        $total_price = $total * $quantities;

        return $total_price;
    } else {
        return $total;
    }
}

// fucntion to remove item from the cart
function remove_item_cart()
{
    global $conn;

    if (isset($_POST['remove_item'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            $delete_query = "DELETE FROM cart_details  WHERE product_id = $remove_id";
            $run_delete = mysqli_query($conn, $delete_query);

            if ($run_delete) {
                echo "<script>window.open('cart.php', '_self' )</script>";
            }
        }
    }
}

function checkOutButton()
{
    global $conn;
    $ip = mysqli_real_escape_string($conn, getIPAddress());
    $price_query = "SELECT * FROM cart_details WHERE ip_address = '$ip' ";
    $result = mysqli_query($conn, $price_query);

    if (mysqli_num_rows($result) > 0) {
        $update = updateTotal();
        echo "
        <h4 class='px-3'>Subtotal: <strong class='text-info'>
           " . $update . "/-
                        </strong>
                    </h4>
                    <input type='submit' value='continue shopping' name='continue_shopping' class='bg-grey px-3 py-2 border-0' />
                    <button class='bg-secondary px-3 py-2 border-0'><a href='./user_area/checkout.php' class='text-decoration-none text-light'>checkout</a></button>";
    } else {
        echo "<input type='submit' value='continue shopping' name='continue_shopping' class='bg-grey px-3 py-2 border-0' /> ";
    }

    if (isset($_POST['continue_shopping'])) {
        echo "<script>window.open('index.php', '_self') </script>";
    }
}


// user profile
// get user order
function get_user_order_details()
{
    global $conn;
    $username = $_SESSION['username'];
    $get_id = "SELECT * FROM user_table WHERE username='$username'";
    $result_query = mysqli_query($conn, $get_id);

    while ($row_query = mysqli_fetch_array($result_query)) {
        $user_id = $row_query['user_id'];
        if (!isset($_GET['edit_account'])) {
            if (!isset($_GET['my_orders'])) {
                if (!isset($_GET['delete_account'])) {
                    $get_order = "SELECT * FROM user_orders WHERE user_id=$user_id AND order_status = 'pending' ";
                    $result_orders = mysqli_query($conn, $get_order);
                    $row_count = mysqli_num_rows($result_orders);

                    if ($row_count > 0) {
                        echo "<h3 class='text-success'> You have <span class='text-danger'>$row_count</span> pending orders </h3>
                        <br>
                        <a href='?my_orders' class='btn'>Order Details</a>
                        ";
                    } else {
                        echo "<h3 class='text-success'> You have zero pending orders</h3>
                        <br>
                        <a href='../display_all' class='btn'>Explore Products</a>
                        ";
                    }
                }
            }
        }
    }
}

?>