<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonkaBabyShop</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Baloo+Bhai&display=swap"
        rel="stylesheet">
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
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Order List</a></li>
                <li><a href="" class="active">Contact Us</a></li>
            </ul>
        </div>

        <!-- Right Section for Buttons -->
        <div class="right">
            <button class="btn">Call Us Now</button>
            <button class="btn">Email Us</button>
        </div>
    </header>

    <!-- Main Content Section -->
    <div class="container">
        <h1>Join and Grab Exclusive Baby Products!</h1>
        <form action="noaction.php">
            <div class="form-group">
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Enter your Email ID" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Enter your Phone Number" required>
            </div>
            <div class="form-group">
                <textarea name="message" placeholder="Enter your Message" required></textarea>
            </div>
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>
</body>

</html>