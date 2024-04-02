<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// User is logged in, so retrieve username from session
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <!-- Add your CSS stylesheets or links here -->
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $username; ?>!</h2>
        <!-- Add any content you want to display on the home page -->
        <p>This is the home page.</p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
