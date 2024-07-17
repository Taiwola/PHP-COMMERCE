<?php


if (isset($_GET['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $select_category = "SELECT * FROM categories WHERE category_id=$category_id";
    $result_query = mysqli_query($conn, $select_category);
    $fetch_result = mysqli_fetch_assoc($result_query);

    $category_title = $fetch_result['category_title'];

    if (isset($_POST['category_update'])) {
        $category_title = $_POST['category_title'];
        $category_id = $_GET['edit_category'];


        $update_category = "UPDATE categories SET category_title='$category_title' WHERE category_id=$category_id";
        $update_query = mysqli_query($conn, $update_category);

        if ($update_query) {
            echo "<script>alert('Successfully updated the category');</script>";
            echo "<script>window.open('./index.php', '_self');</script>";
        }
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
    <h3 class="text-center text-success">Edit Category</h3>
    <form action="" method="post">
        <div class="form-outline mb-4 w-50 m-auto">
            <label for="category_title" class="form-label">Category title</label>
            <input type="text" class="form-control " name="category_title" value="<?php echo $category_title ?>">
        </div>
        <div class="w-50 m-auto">
            <input type="submit" class="btn m-auto" name="category_update" value="Update">
        </div>
    </form>
</body>

</html>