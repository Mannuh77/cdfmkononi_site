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

// Retrieve application code from URL parameter
if (isset($_GET['code'])) {
    $application_code = $_GET['code'];

    // Fetch user details from the database using the application code
    $sql = "SELECT * FROM bursaryapplications WHERE applicationcode = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $application_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User details found, generate PDF
        require_once('../fpdf/fpdf.php');

        // Create a new PDF instance
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Fetch user details and add them to the PDF
        while ($row = $result->fetch_assoc()) {

            $pdf->SetFont('Arial', 'Bu', 14);
            $pdf->Cell(0, 10, "BURSARY APPLICATION INFORMATION", 0, 1);
            $pdf->SetFont('Arial', 'Bu', 14);
            $pdf->Cell(0, 10, "Personal Information", 0, 1);
            // Personal Information Fields
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "Student Name: " . ($row['studentname'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Registration Number: " . ($row['registrationnumber'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Phone: " . ($row['phone'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "ID Number: " . ($row['idnumber'] ?? ''), 0, 1);

            // Heading for Address Information

            $pdf->SetFont('Arial', 'Bu', 14);
            $pdf->Cell(0, 10, "Address Information", 0, 1);
            // Address Information Fields
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "Sub County: " . ($row['subcounty'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Ward: " . ($row['wards'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Constituency Number: " . ($row['constituencyNumber'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Constituency Name: " . ($row['constituencyName'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Email: " . ($row['email'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Address: " . ($row['address'] ?? ''), 0, 1);

            // Heading for Education Information
            $pdf->SetFont('Arial', 'Bu', 14);
            $pdf->Cell(0, 10, "Education Information", 0, 1);
            // Education Information Fields
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "School: " . ($row['school'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Course: " . ($row['course'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Fee Balance: " . ($row['feebalance'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Year: " . ($row['year'] ?? ''), 0, 1);

            // Heading for Application Details
            $pdf->SetFont('Arial', 'Bu', 14);
            $pdf->Cell(0, 10, "Application Details", 0, 1);
            // Application Details Fields
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, "Reason for Applying: " . ($row['reason'] ?? ''), 0, 1);
            $pdf->Cell(0, 10, "Application Code: " . ($row['applicationcode'] ?? ''), 0, 1);


            // Add other user details as needed
        }

        // Output PDF as a download
        $pdf->Output('Applicant_details.pdf', 'D');
    } else {
        echo "No user found with the provided application code.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Application code not provided.";
}
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