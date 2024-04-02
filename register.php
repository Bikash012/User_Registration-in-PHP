<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        } 
        .container{
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgb(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2{
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label{
            display: block;
            font-weight: bold;
        }
        .form-group input{
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"]{
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .already {
            text-align: center;
            margin-top: 20px;
        }
        .already a {
            color: #007bff;
            text-decoration: none;
        }
        .already a:hover {
            text-decoration: underline;
        }
    </style> 
</head>
<body>

<div class="container">
    <h2>User Registration</h2>
    <form method="post" action="register.php">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <input type="submit" name="register" value="Register">
        </div>
    </form>

    <div class="already">
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</div>

<?php

// MySQL database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute() === TRUE) {
        //echo "<script>alert('Registration Success.');</script>";
         header("Location: login.php");
        exit(); 
    } else {
        echo "<script>alert('Error: Registration failed.');</script>";
    }

    // Close statement
    $stmt->close();
}

$conn->close();
?>


</body>
</html>
