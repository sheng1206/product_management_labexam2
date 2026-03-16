<?php
include "db.php";

// Get form data
$product_type_id = $_POST['product_type_id'];
$brand_id = $_POST['brand_id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];

// Handle image upload
$picture = null;
if (isset($_FILES['picture']) && $_FILES['picture']['size'] > 0) {

    // Check for upload errors
    if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {

        // Limit image size (5MB)
        if ($_FILES['picture']['size'] <= 5 * 1024 * 1024) {

            // Create unique filename
            $filename = time() . '_' . basename($_FILES['picture']['name']);
            $target = "uploads/" . $filename;

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
                $picture = $filename; // store filename in DB
            } else {
                die("Error moving uploaded file. Check folder permissions.");
            }

        } else {
            die("Error: Image too large. Max 5MB allowed.");
        }

    } else {
        die("Error uploading image: " . $_FILES['picture']['error']);
    }
}

// Insert into database
$query = "INSERT INTO products (product_type_id, brand_id, product_name, description, picture)
          VALUES ('$product_type_id', '$brand_id', '$product_name', '$description', " . ($picture ? "'$picture'" : "NULL") . ")";

if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit;
} else {
    die("Error inserting product: " . mysqli_error($conn));
}
?>
