<?php
// Database connection details
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $message = $_POST["message"];
    $email = $_POST["email"];

    // Prepare SQL statement to insert data into the 'help' table
    $sql = "INSERT INTO help (message, email) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $message, $email);

    // Execute the prepared statement
    if ($stmt->execute() === TRUE) {
        echo "Request Submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$mysqli->close();
?>



<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin-left: 0;
            font-size:40px;
            font-weight: bolder;
            box-sizing: 5px ;
            align-items: center;
            padding: 0;
        }
       
      
    </style>
</head>
<body>
    
</body>
</html>