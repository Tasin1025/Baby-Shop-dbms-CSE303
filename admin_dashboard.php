<?php
// Include database configuration
include 'db_config.php';

// Handle Product Upload Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = htmlspecialchars($_POST['product_name']);
    $product_price = htmlspecialchars($_POST['product_price']);
    $image = $_FILES['product_image'];

    // Check if the 'uploads' directory exists; if not, create it
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    if ($image['error'] == 0) {
        $image_name = uniqid() . '-' . basename($image['name']); // Add unique prefix to avoid overwriting
        $image_path = $upload_dir . $image_name;

        // Move uploaded file to the 'uploads' directory
        if (move_uploaded_file($image['tmp_name'], $image_path)) {
            // Use prepared statements to insert product into the database
            $stmt = $conn->prepare("INSERT INTO products (name, price, image) VALUES (?, ?, ?)");
            $stmt->bind_param("sds", $product_name, $product_price, $image_name);

            if ($stmt->execute()) {
                echo "<script>alert('Product uploaded successfully!');</script>";
            } else {
                echo "<script>alert('Error: Unable to upload product.');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Error: Unable to upload image.');</script>";
        }
    } else {
        echo "<script>alert('Error: Please select an image to upload.');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="header">
        <!-- Left Section for Logo -->
        <div class="left">
            <div>KonkaBabyShop</div>
        </div>

        <!-- Middle Section for Navigation -->
        <div class="mid">
            <ul class="navbar">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="view_orders.php">View Orders</a></li>
            </ul>
        </div>

        <!-- Right Section for Logout -->
        <div class="right">
            <a href="logout.php" class="btn">Logout</a>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Upload Product</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" name="product_name" placeholder="Product Name" required>
            </div>
            <div class="form-group">
                <input type="number" name="product_price" placeholder="Product Price" required>
            </div>
            <div class="form-group">
                <input type="file" name="product_image" accept="image/*" required>
            </div>
            <button type="submit" class="btn">Upload Product</button>
        </form>
    </div>
</body>

</html>