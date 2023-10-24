<?php
include('../config/conn.php');
//fetch all categories
$select_category = "SELECT * FROM categories";
$category_query = mysqli_query($conn, $select_category);
$row_categories = mysqli_fetch_all($category_query, MYSQLI_ASSOC);

// fetch all brands
$select_brand = "SELECT * FROM brands";
$brand_query = mysqli_query($conn, $select_brand);
$row_brand = mysqli_fetch_all($brand_query, MYSQLI_ASSOC);

if (isset($_POST['insert_product'])) {

    try {
        $product_title = filter_input(INPUT_POST, 'product_title', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_description = filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_keyword = filter_input(INPUT_POST, 'product_keyword', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_category = filter_input(INPUT_POST, 'product_category', FILTER_SANITIZE_SPECIAL_CHARS);
        $brand_value = filter_input(INPUT_POST, 'product_brand', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_price = filter_input(INPUT_POST, 'product_price', FILTER_SANITIZE_SPECIAL_CHARS);
        $product_status = true;

        if (empty($product_title) || empty($product_description) || empty($product_keyword) || empty($product_category) || empty($brand_value) || empty($product_price)) {
            echo "<script>alert('please fill all avaliable fields') </script>";
            exit();
        }

        $allowed_ext = ['png', 'jpg', 'jpeg', 'gif'];

        $product_img1 = $_FILES['product_image1']['name'];
        $product_img2 = $_FILES['product_image2']['name'];
        $product_img3 = $_FILES['product_image3']['name'];

        // accessing tmp name
        $product_img1_tmp = $_FILES['product_image1']['tmp_name'];
        $product_img2_tmp = $_FILES['product_image2']['tmp_name'];
        $product_img3_tmp = $_FILES['product_image3']['tmp_name'];

        // Get file extension
        $img1_ext = explode('.', $product_img1);
        $img1_ext = strtolower(end($img1_ext));

        $img2_ext = explode('.', $product_img2);
        $img2_ext = strtolower(end($img2_ext));

        $img3_ext = explode('.', $product_img1);
        $img3_ext = strtolower(end($img3_ext));

        if (in_array($img1_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img1";
            move_uploaded_file($product_img1_tmp, $targetDir);
        }

        if (in_array($img2_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img2";
            move_uploaded_file($product_img2_tmp, $targetDir);
        }

        if (in_array($img3_ext, $allowed_ext)) {
            $targetDir = "product_images/$product_img3";
            move_uploaded_file($product_img1_tmp, $targetDir);
        }

        $insert_product = "INSERT INTO products (product_title, product_description, product_keywords, category_id, brand_id, product_image1, product_image2, product_image3, product_price, date, status) VALUES ('$product_title', '$product_description', '$product_keyword', '$product_category', '$brand_value', '$product_img1', '$product_img2', '$product_img3', '$product_price', NOW(), '$product_status')";
        $result_query = mysqli_query($conn, $insert_product);
        if ($result_query) {
            echo "<script>alert('Successfully inserted the products');</script>";
        }
    } catch (mysqli_sql_exception) {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Products</title>
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-light">
    <div class="container mt-3">
        <h1 class="text-center">Insert Products</h1>
        <!-- form -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <!-- title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product title</label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter Product Title" autocomplete="off" required>
            </div>
            <!-- description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_description" class="form-label">Product description</label>
                <input type="text" name="product_description" id="product_description" class="form-control" placeholder="Enter Product description" autocomplete="off" required>
            </div>

            <!-- keyword -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control" placeholder="Enter Product keyword" autocomplete="off" required>
            </div>

            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php foreach ($row_categories as $category) : ?>
                        <?php $category_id = $category['category_id']; ?>
                        <option value="<?php echo $category_id ?>"><?php echo $category['category_title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- Brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                    <option value="">Select a brand</option>
                    <?php foreach ($row_brand as $brand) : ?>
                        <?php $brand_id = $brand['brand_id']; ?>
                        <option value="<?php echo $brand_id ?>"><?php echo $brand['brand_title'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <!-- first image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image1" id="product_image1" required class="form-control">
            </div>

            <!-- second image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image2" id="product_image2" required class="form-control">
            </div>

            <!-- third image -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image3" id="product_image3" required class="form-control">
            </div>

            <!-- price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control" placeholder="Enter Product price" autocomplete="off" required>
            </div>


            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info" value="insert product">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </script>
</body>

</html>

<?php mysqli_close($conn) ?>