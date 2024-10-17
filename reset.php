<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email field is empty
    if (empty($_POST["email"])) {
        echo json_encode(array("success" => false, "message" => "Email is required"));
        exit;
    }

    // Retrieve the email from the POST request
    $email = $_POST["email"];

    // Check if the email format is valid
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(array("success" => false, "message" => "Invalid email format"));
        exit;
    }

    // Database connection details
    $db_username = 'root';
    $db_password = '';
    $db_name = 'users_register';
    $db_host = 'localhost';

    // Create connection
    $mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // SQL query to check if the email exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Email exists, you can proceed with sending the password reset link
        // Generate a unique token for password reset link
        $token = bin2hex(random_bytes(32)); // Using a more secure method for generating tokens

        // Store the token in the database along with the email
        $sql = "UPDATE users SET reset_token = ? WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $token, $email);
        if ($stmt->execute()) {
            // Construct the password reset link
            $resetLink = "http://localhost/Comp493/indexpage/index.com/reset-password.php?email=" . urlencode($email) . "&token=" . urlencode($token);

            // Send the password reset link to the user's email
            $subject = "Password Reset";
            $message = "Click the following link to reset your password: $resetLink";
            $headers = "From: Your Sender Name <peterkimindu2@gmail.com>\r\n";
            $headers .= "Reply-To: Your Reply-to Address <peterkimindu2@gmail.com>\r\n";
            $headers .= "Content-type: text/html\r\n"; // You might need to adjust the content type if you're sending HTML emails

            if (mail($email, $subject, $message, $headers)) {
                echo json_encode(array("success" => true, "message" => "Password reset link sent to your email"));
            } else {
                echo json_encode(array("success" => false, "message" => "Failed to send password reset link"));
            }
        } else {
            echo json_encode(array("success" => false, "message" => "Error updating record: " . $mysqli->error));
        }
    } else {
        // Email does not exist in the database
        echo json_encode(array("success" => false, "message" => "Email not found"));
    }

    // Close connection
    $mysqli->close();
} else {
    // Invalid request method
    echo json_encode(array("success" => false, "message" => "Invalid request method"));
}
?>

