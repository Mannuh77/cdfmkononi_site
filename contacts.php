<?php
// Start the session
session_start();

// Check if user is logged in
if(!isset($_SESSION['constituencyNumber'])) {
    die("Access denied. You must be logged in to access this page.");
}

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

// Get logged-in constituency number
$loggedInConstituency = $_SESSION['constituencyNumber'];

// SQL query to fetch phone and email from contacts table for the logged-in constituency
$sql = "SELECT phone, email FROM contacts WHERE constituencyNumber = ?";

// Prepare the statement
$stmt = $mysqli->prepare($sql);

// Bind parameters
$stmt->bind_param("i", $loggedInConstituency);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();

// Check if records exist
if ($result->num_rows > 0) {
    // Output data of each row
    echo "<h2> CONTACTS DETAILS</h2>";
    echo "<table border='1'>";
    echo "<tr><th style='font-size: 40px;'>Phone</th><th style='font-size: 40px;'>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='font-size: 40px;'>".$row["phone"]."</td>";
        echo "<td style='font-size: 40px;'><a href='mailto:".$row["email"]."'>".$row["email"]."</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No records found";
}

// Close the statement
$stmt->close();

// Close database connection
$mysqli->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONTATCTS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            
        }
        h2 {
            margin-top: 20px;
        }
        table {
            border-collapse: collapse;
            width: 50%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>

