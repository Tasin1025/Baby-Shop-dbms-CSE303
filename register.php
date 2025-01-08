<?php
// Database Configuration
include 'db_config.php';

// Handle Registration Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $location = htmlspecialchars($_POST['location']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    if ($role == 'user') {
        // Insert into `users` table
        $sql = "INSERT INTO users (name, email, phone, location, password) VALUES ('$name', '$email', '$phone', '$location', '$password')";
    } elseif ($role == 'admin') {
        // Insert into `admins` table
        $sql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$password')";
    }

    if ($conn->query($sql)) {
        echo "<script>alert('Registration Successful! You can now log in.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to register. Please try again later.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class="form-group">
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="text" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="form-group">
                <input type="text" name="location" placeholder="Location" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <select name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>

</html>