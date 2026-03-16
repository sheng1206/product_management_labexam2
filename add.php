<?php include "db.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Product - LabExam2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Add Product</h2>

        <form action="insert.php" method="POST" enctype="multipart/form-data" class="card p-4 shadow">

            <!-- Product Type (Category) Dropdown -->
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="product_type_id" class="form-control" required>
                    <option value="">-- Select Category --</option>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM product_types");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='{$row['id']}'>{$row['type_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Brand Dropdown -->
            <div class="mb-3">
                <label class="form-label">Brand</label>
                <select name="brand_id" class="form-control" required>
                    <option value="">-- Select Brand --</option>
                    <?php
                    $res = mysqli_query($conn, "SELECT * FROM brands");
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "<option value='{$row['id']}'>{$row['brand_name']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Product Name -->
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" placeholder="Enter product name" required>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Enter product description"
                    required></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-3">
                <label class="form-label">Picture</label>
                <input type="file" name="picture" class="form-control" accept="image/*">
            </div>

            <button type="submit" class="btn btn-success">Save Product</button>
            <a href="index.php" class="btn btn-secondary">Back</a>

        </form>
    </div>
</body>

</html>