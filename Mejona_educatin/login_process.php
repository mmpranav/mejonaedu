<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "mejonaedu";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST["email"];
$password = $_POST["password"];

$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User with the provided email exists
    $row = $result->fetch_assoc();
    
    // Verify the password 
    if (password_verify($password, $row["password"])) {
        // Password is correct, user is authenticated
        session_start();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["user_email"] = $row["email"];
        
        // Redirect to a secure dashboard or profile page
        header("Location: dashboard.php");
        exit();
    } else {
        // Password is incorrect
        header("Location: login.php?error=invalid");
        exit();
    }
} else {
    // User with the provided email does not exist
    header("Location: login.php?error=notfound");
    exit();
}

$conn->close();
?>
