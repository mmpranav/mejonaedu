<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$database = "your_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirmPassword"];
$otp = $_POST["otp"]; 

// Check if the password and confirmation match
if ($password !== $confirmPassword) {
    header("Location: register.php?error=password");
    exit();
}


$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);


$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert user data into the database
$sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashedPassword')";

if ($conn->query($sql) === TRUE) {
    // Registration successful
    header("Location: login.php?registration=success");
    exit();
} else {
    // Registration failed
    header("Location: register.php?error=registration");
    exit();
}

$conn->close();
?>
