<?php
session_start();


$storedOTP = isset($_SESSION['otp']) ? $_SESSION['otp'] : null;

$userOTP = isset($_POST['otp']) ? $_POST['otp'] : null;

if ($storedOTP !== null && $userOTP !== null) {
    if ($userOTP === $storedOTP) {
      
        unset($_SESSION['otp']);
        echo "success";
    } else {
        
        echo "error";
    }
} else {
   
    echo "error";
}
?>
