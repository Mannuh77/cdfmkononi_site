<?php
// Start session
session_start();

// Database connection
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';
$db_host = 'localhost';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch constituency number from session
$constituencyNumber = isset($_SESSION['constituencyNumber']) ? $_SESSION['constituencyNumber'] : null;

// Fetch sub-counties linked with the logged-in constituency number
$sql = "SELECT id, name FROM subcounties WHERE constituencyNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $constituencyNumber);
$stmt->execute();
$result = $stmt->get_result();

// Output options for the select element
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
    }
} else {
    echo "<option value=''>No sub-counties found</option>";
}

// Close database connection
$stmt->close();
$conn->close();
?>
