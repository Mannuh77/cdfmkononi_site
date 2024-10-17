<?php
// Start the session
session_start();

// Establish database connection
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Check if constituencyNumber is set in session
if (isset($_SESSION["constituencyNumber"])) {
    $constituencyNumber = $_SESSION["constituencyNumber"];

    // Query to fetch tender1 and id for the logged-in user's constituencyNumber
    $sql = "SELECT id, tender1 FROM tenders WHERE constituencyNumber = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($sql);

    // Bind the parameter
    $stmt->bind_param("s", $constituencyNumber);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are any records
    if ($result->num_rows > 0) {
        // Start building HTML content
        echo "<div class='rec-container' style='height: 100vh;width:200vh;margin-top:7%;  font-size:30px; font-weight:bolder;background-color: #c9e9bf;'>";
        echo "<ul>";

        // Loop through each row in the result set
        while ($row = $result->fetch_assoc()) {
            // Output tender1 information as links with id parameter
            echo "<li><a href='tenderdes.php?id=" . $row['id'] . "'>" . $row['tender1'] . "</a></li>";
        }

        // Close the rec-container div
        echo "</ul>";
        echo "</div>";
    } else {
        echo "No tenders found for your constituency";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Please log in to view tenders";
}

// Close connection
$mysqli->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDF Mkononi</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cons.css">
    <link rel="shortcut icon" href="images/cdflogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
        body {
            background: linear-gradient(to right, rgb(207, 132, 19), rgb(231, 229, 228)); 
        }
    </style>
<body>
    
    <section>
        <nav class="heading1">
            <ul>
            <h1 class="cdfmkononi" style="margin-left:-17%;margin-top:17%; font-size: 17px;"><?php echo $_SESSION["name"]; ?></h1>
            
<ul style="margin-left:-5%"><li class="logo"><img style="margin-left:-5%; margin-top:15px;" class="img1" src="images/pcdf1.jpg" alt="CDF KENYA"></li>
<h1 style="margin-top:0%; margin-left:-27%;">TENDERS  FOR FINANCIAL YEAR 2022/23</h1>