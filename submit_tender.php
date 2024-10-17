<?php
// Establish database connection
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';
$db_host = 'localhost';

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if all form fields are set
if (!isset($_POST['fullname'], $_POST['email'], $_POST['phone'], $_POST['company'], $_POST['tender_name'], $_POST['constituencyNumber'], $_POST['constituency'])) {
    die("Missing form fields.");
}

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$company = $_POST['company'];
$tender_name = $_POST['tender_name'];
$constituency = $_POST['constituency'];
$constituencyNumber = $_POST['constituencyNumber'];

// Check if all file fields are set
if (!isset($_FILES['kra_pin'], $_FILES['business_registration'], $_FILES['application_letter'])) {
    die("Missing file uploads.");
}

// File upload handling
$upload_dir = 'uploads/';

$kra_pin_file = $_FILES['kra_pin']['name'];
$kra_pin_temp = $_FILES['kra_pin']['tmp_name'];
$kra_pin_destination = $upload_dir . $kra_pin_file;
move_uploaded_file($kra_pin_temp, $kra_pin_destination);

$business_registration_file = $_FILES['business_registration']['name'];
$business_registration_temp = $_FILES['business_registration']['tmp_name'];
$business_registration_destination = $upload_dir . $business_registration_file;
move_uploaded_file($business_registration_temp, $business_registration_destination);

$application_letter_file = $_FILES['application_letter']['name'];
$application_letter_temp = $_FILES['application_letter']['tmp_name'];
$application_letter_destination = $upload_dir . $application_letter_file;
move_uploaded_file($application_letter_temp, $application_letter_destination);

// Insert data into the database
$sql_insert = "INSERT INTO tender_applications (fullname, email, phone, company, tender_name, constituencyNumber, constituency, kra_pin, business_registration, application_letter)
               VALUES ('$fullname', '$email', '$phone', '$company', '$tender_name', '$constituencyNumber', '$constituency', '$kra_pin_file', '$business_registration_file', '$application_letter_file')";

if ($conn->query($sql_insert) === TRUE) {
    echo "Tender application submitted successfully.";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin-left:0%;
            font-size:50px;
            border:box 5px;
            align-items: center;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 50px;
           
            font-weight: bold;
        
        }
    </style>
</head>
<body>
    
</body>
</html>