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

// Get form data
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$job_applied_for = $_POST['job_applied_for'];
$constituency_name = $_POST['constituency'];
$constituencyNumber = $_POST['constituencyNumber']; // Adding constituencyNumber
$idnumber = $_POST['idnumber']; // Adding idnumber

// Check if the applicant has already applied
$sql_check = "SELECT * FROM job_applications WHERE email = '$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Applicant has already applied
    echo "<h1>You have already applied for a job.</h1>";
} else {
    // Get file names
    $resume_file_name = $_FILES['resume']['name'];
    $application_letter = $_FILES['application_letter']['name'];

    // Move files to the uploads folder
    $resume_file_path = 'uploads/' . $resume_file_name;
    $application_letter_path = 'uploads/' . $application_letter;
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume_file_name);
    move_uploaded_file($_FILES['application_letter']['tmp_name'], $application_letter_path);

    // Insert application into the database
    $sql_insert = "INSERT INTO job_applications (full_name, email, phone, job_applied_for, constituency_name, constituencyNumber, resume_file_name, application_letter, idnumber)
                   VALUES ('$full_name', '$email', '$phone', '$job_applied_for', '$constituency_name', '$constituencyNumber', '$resume_file_name', '$application_letter', '$idnumber')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Application submitted successfully.";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
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
            margin-left: 0%;
            border:box 5px;
            font-size:50px;
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
            font-size:100px;
            font-weight: bold;
        
        }
    </style>
</head>
<body>
    
</body>
</html>