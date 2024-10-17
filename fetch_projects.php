<?php
session_start();

// Include database connection configuration
$db_username = 'root';
$db_password = '';
$db_name = 'users_register';
$db_host = 'localhost';

// Create a connection
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check the connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch projects based on session data or any other criteria
$sql = "SELECT * FROM projects WHERE constituencyNumber = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $_SESSION['constituencyNumber']);
$stmt->execute();
$result = $stmt->get_result();

// Build HTML content for projects
$htmlContent = '';
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Construct HTML content for each project
        $htmlContent .= "<div class='rec-container3' style='width:95%; margin-bottom:15px; background:white; min-height:80vh;'>";
        // Add project details here, similar to your existing code
        $htmlContent .= "</div>";
    }
} else {
    // If no projects found
    $htmlContent = "<p>No projects found for constituency number: " . $_SESSION['constituencyNumber'] . "</p>";
}

// Close prepared statement and database connection
$stmt->close();
$mysqli->close();

// Output HTML content
echo $htmlContent;
?>
