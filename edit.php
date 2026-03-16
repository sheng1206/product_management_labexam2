<?php
include "db.php";

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Product - LabExam2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Product</h2>

        <form action="update.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <!-- Category -->
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="product_type_id" class="form-control" required>
                    <?php
                    $res_cat = mysqli_query($conn, "SELECT * FROM product_types");
                    while ($cat = mysqli_fetch_assoc($res_cat)) {
                        $selected = ($cat['id'] == $row['product_type_id']) ? "selected" : "";
                        echo "<option value='{$cat['id']}' $selected>{$cat['type_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Brand -->
            <div class="mb-3">
                <label class="form-label">Brand</label>
                <select name="brand_id" class="form-control" required>
                    <?php
                    $res_brand = mysqli_query($conn, "SELECT * FROM brands");
                    while ($brand = mysqli_fetch_assoc($res_brand)) {
                        $selected = ($brand['id'] == $row['brand_id']) ? "selected" : "";
                        echo "<option value='{$brand['id']}' $selected>{$brand['brand_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Product Name -->
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" value="<?php echo $row['product_name']; ?>"
                    required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4"
                    required><?php echo $row['description']; ?></textarea>
            </div>

            <!-- Current Picture -->
            <div class="mb-3">
                <label class="form-label">Current Picture</label><br>
                <?php
                if ($row['picture']) {
                    echo "<img src='data:image/jpeg;base64," . base64_encode($row['picture']) . "' width='100'>";
                } else {
                    echo "No image";
                }
                ?>
            </div>

            <!-- New Picture -->
            <div class="mb-3">
                <label class="form-label">New Picture</label>
                <input type="file" name="picture" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>

</html>