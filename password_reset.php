<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Update the require statements to point to the correct directory
require 'Comp493/PHPMailer/Exception.php';
require 'Comp493/PHPMailer/PHPMailer.php';
require 'Comp493/PHPMailer/SMTP.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the email address submitted via the form
    $email = $_POST["email"];

    // Validate the email address (you might want to add more robust validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address";
        exit; // Stop further execution
    }

    // Generate a unique token
    $token = generateUniqueToken();

    // Store the token, email, and timestamp in the database (you need to implement this)

    // Construct the reset link
    $resetLink = "http://example.com/reset_password.php?token=$token";

    // Email subject and message
    $subject = "Password Reset";
    $message = "Dear user,\n\n";
    $message .= "Please click on the following link to reset your password:\n";
    $message .= "$resetLink\n\n";
    $message .= "Thank you.";

    // Send the email using SMTP
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ngcdf@gmail.com'; // Your Gmail email address
        $mail->Password   = '1234'; // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port       = 587;  // TCP port to connect to

        //Recipients
        $mail->setFrom('ngcdf@gmail.com', 'Ng-cdf');
        $mail->addAddress($email);     // Add a recipient

        //Content
        $mail->isHTML(false);  // Set email format to plain text
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo "Reset link sent to your email address.";
    } catch (Exception $e) {
        echo "Failed to send reset link. Please try again later. Error: {$mail->ErrorInfo}";
    }

    // Redirect the user to a confirmation page
    // header("Location: reset_confirmation.php");
    // exit;
} else {
    // If the form wasn't submitted, redirect the user to the forgot password page
    header("Location: forgotpassword.php");
    exit;
}

// Function to generate a unique token
function generateUniqueToken($length = 32) {
    // Generate a random token using random_bytes
    $token = bin2hex(random_bytes($length / 2)); // Convert bytes to hexadecimal
    return $token;
}
?>
