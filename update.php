<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";

// Get form data
$id = $_POST['id'];
$product_type_id = $_POST['product_type_id'];
$brand_id = $_POST['brand_id'];
$product_name = $_POST['product_name'];
$description = $_POST['description'];

// Handle new image upload
$picture = null;
if (isset($_FILES['picture']) && $_FILES['picture']['size'] > 0) {

    if ($_FILES['picture']['error'] === UPLOAD_ERR_OK) {

        if ($_FILES['picture']['size'] <= 5 * 1024 * 1024) {

            if (!is_dir('uploads'))
                mkdir('uploads', 0755, true);

            $filename = time() . '_' . basename($_FILES['picture']['name']);
            $target = "uploads/" . $filename;

            if (move_uploaded_file($_FILES['picture']['tmp_name'], $target)) {
                $picture = $filename;
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

// Build update query
if ($picture !== null) {
    $query = "UPDATE products SET product_type_id='$product_type_id', brand_id='$brand_id', 
              product_name='$product_name', description='$description', picture='$picture' WHERE id=$id";
} else {
    $query = "UPDATE products SET product_type_id='$product_type_id', brand_id='$brand_id', 
              product_name='$product_name', description='$description' WHERE id=$id";
}

// Execute query
if (mysqli_query($conn, $query)) {
    header("Location: index.php");
    exit;
} else {
    die("Error updating product: " . mysqli_error($conn));
}
?>