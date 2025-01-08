<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonkaBabyShop</title>
    <link rel="stylesheet" href="index_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="left">
            <div class="logo">KonkaBabyShop</div>
        </div>
        <div class="right">
            <button class="btn" onclick="location.href='login.php'">Login</button>
            <button class="btn" onclick="location.href='register.php'">Register</button>
        </div>

    </header>

    <div class="banner">
        <h1>Welcome to KonkaBabyShop!</h1>
        <p>Explore premium-quality baby products, handpicked for your little ones.</p>
        <button class="btn">Shop Now</button>
    </div>

    <div class="categories">
        <h2>Featured Categories</h2>
        <div class="category-grid">
            <div class="category">
                <img src="uploads/category1.jpg" alt="Toys" />
                <h3>Toys</h3>
                <p>Discover a range of educational and fun toys for kids.</p>
            </div>
            <div class="category">
                <img src="uploads/category2.jpg" alt="Clothing" />
                <h3>Clothing</h3>
                <p>Stylish and comfortable baby clothing for all seasons.</p>
            </div>
            <div class="category">
                <img src="uploads/category3.jpg" alt="Feeding" />
                <h3>Feeding</h3>
                <p>Essential feeding products to make mealtime a breeze.</p>
            </div>
        </div>
    </div>

    <!-- Featured Products Section -->
    <div class="container">
        <h2>Our Bestsellers</h2>
        <div class="product-grid">
            <?php
            // Include the database configuration file
            include 'db_config.php';

            // Fetch products from the database
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            // Display products dynamically
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '
                        <div class="product">
                            <img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '">
                            <h3>' . $row['name'] . '</h3>
                            <p>' . number_format($row['price'], 2) . ' Taka</p>
                        </div>
                    ';
                }
            } else {
                echo "<p>No products found!</p>";
            }

            ?>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-cards">
            <div class="testimonial-card">
                <p>"I absolutely love the quality of the products! My baby is happy, and I’m a satisfied customer!"</p>
                <h4>Maryam</h4>
                <p>Mother of 1</p>
            </div>
            <div class="testimonial-card">
                <p>"Quick delivery and fantastic customer service. The products are exactly as described!"</p>
                <h4>Ahmed</h4>
                <p>Father of 2</p>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2025 KonkaBabyShop | All Rights Reserved</p>
    </footer>
</body>

</html>