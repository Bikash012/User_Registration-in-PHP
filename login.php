<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group input[type="submit"] {
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
<?php
session_start();

if(isset($_SESSION["username"])) {
    header("Location: home.php");
    exit();
}

?>

<body>

<div class="container">
    <h2>Login Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="login_username">Username:</label>
            <input type="text" id="login_username" name="login_username" required>
        </div>
        
        <div class="form-group">
            <label for="login_password">Password:</label>
            <input type="password" id="login_password" name="login_password" required>
        </div>
        
        <div class="form-group">
            <input type="submit" name="login" value="Login">
        </div>
    </form>
    <div class="already">
        <p>Don't have an account yet? <a href="register.php">Register here</a>.</p>
    </div>
</div>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['login_username'];
    $password = $_POST['login_password'];


    $conn = mysqli_connect("localhost", "root", "", "my_database");


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }


    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['password'];


        if (password_verify($password, $hashed_password)) {

            $_SESSION["username"] = $username;
            header("Location: home.php");
            exit();
        } else {

            $error = "Invalid password";
        }
    } else {

        $error = "Username not found";
    }


    $stmt->close();
    $conn->close();
}
?>
</body>
