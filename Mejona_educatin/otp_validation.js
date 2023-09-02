// Function to validate OTP
function validateOTP() {
    // Retrieve OTP input from the form
    var otpInput = document.getElementById("otp").value;

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "otp_verification.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = xhr.responseText;
            if (response === "success") {
                // OTP is valid
                alert("OTP is valid. Registration is successful.");
            } else {
                // OTP is invalid
                alert("Invalid OTP. Please try again.");
            }
        }
    };
    xhr.send("otp=" + otpInput);
}

var otpForm = document.getElementById("registerForm"); 
otpForm.addEventListener("submit", function (e) {
    e.preventDefault(); 
    validateOTP(); // Calingl the OTP validation function
});
