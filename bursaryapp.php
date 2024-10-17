<?php
// Database connection
$db_host = 'localhost';
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the form
$studentName = $_POST['studentname'] ?? '';
$registrationNumber = $_POST['registrationnumber'] ?? '';
$phone = $_POST['phone'] ?? '';
$idNumber = $_POST['idNumber'] ?? '';
$subCounty = $_POST['subcounty'] ?? '';
$wards = $_POST['wards'] ?? '';
$constituencyNumber = $_POST['constituencyNumber'] ?? '';
$constituencyName = $_POST['constituencyName'] ?? ''; 
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$school = $_POST['school'] ?? '';
$course = $_POST['course'] ?? '';
$feeBalance = $_POST['feebalance'] ?? '';
$year = $_POST['year'] ?? '';
$reason = $_POST['reason'] ?? '';
$applicationdate = $_POST['applicationdate'] ?? '';

// Check if the registration number already exists
$check_sql = "SELECT * FROM bursaryapplications WHERE registrationnumber = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("s", $registrationNumber);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // Registration number already exists, prevent application
    echo "<h2>Sorry, you have already applied for the bursary, check on your downloads.</h2>";
} else {
    // Registration number does not exist, proceed with application
    // Handle file uploads
    $admissionLetterFileName = $_FILES['admissionletter']['name'] ?? '';
    $admissionLetterTmpName = $_FILES['admissionletter']['tmp_name'] ?? '';
    $idCertificateFileName = $_FILES['idcertificate']['name'] ?? '';
    $idCertificateTmpName = $_FILES['idcertificate']['tmp_name'] ?? '';
    $supportingDocsFileName = $_FILES['supportingdocs']['name'][0] ?? ''; // Only one supporting document

    // Move uploaded files to a permanent location
    $uploadDirectory = 'uploads/';
    $admissionLetterDestination = $uploadDirectory . $admissionLetterFileName;
    $idCertificateDestination = $uploadDirectory . $idCertificateFileName;
    $supportingDocsDestination = $uploadDirectory . $supportingDocsFileName;

    move_uploaded_file($admissionLetterTmpName, $admissionLetterDestination);
    move_uploaded_file($idCertificateTmpName, $idCertificateDestination);
    move_uploaded_file($_FILES['supportingdocs']['tmp_name'][0], $supportingDocsDestination);

    // Prepare and bind SQL statement
   // Prepare and bind SQL statement
// Prepare and bind SQL statement
$sql = "INSERT INTO bursaryapplications (studentname, registrationnumber, phone, idnumber, subcounty, wards, constituencyNumber, constituencyName, applicationdate, email, address, school, course, feebalance, year, reason, admissionletter, idcertificate, supportingdocs) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssssssssssssssssss", $studentName, $registrationNumber, $phone, $idNumber, $subCounty, $wards, $constituencyNumber, $constituencyName, $applicationdate, $email, $address, $school, $course, $feeBalance, $year, $reason, $admissionLetterFileName, $idCertificateFileName, $supportingDocsFileName); // Use $supportingDocsFileName instead of $supportingDocsDestination

// Execute the prepared statement

// Execute the prepared statement

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Get the auto-generated ID of the inserted record
        $application_id = $stmt->insert_id;

        // Generate application code (you can customize this as needed)
        $application_code = 'APP' . $application_id;

        // Update user's record with the generated application code
        $update_sql = "UPDATE bursaryapplications SET applicationcode = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $application_code, $application_id);
        if ($update_stmt->execute()) {
            // Display success message after PDF generation
            echo "<h2><script>alert('Applied successfully. Get your application details from your Downloads. Your application code is: $application_code'); window.location.href = 'generate_pdf.php?code=$application_code';</script></h2>";
        } else {
            echo "Error updating application code: " . $update_stmt->error;
        }
        $update_stmt->close();
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Close the check statement and connection
$check_stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bursary Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin-left: 25%;
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
