<?php
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

// Check if ID is provided in the query string
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $id = $mysqli->real_escape_string($_GET['id']);
    
    // Query to fetch job details for the specified job ID
    $sql = "SELECT vacancy1, jobrequirements FROM vacancies WHERE id = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if job details exist
    if($result->num_rows > 0) {
        // Fetch job details
        $row = $result->fetch_assoc();
        $vacancy1 = $row['vacancy1'];
        $jobrequirements = $row['jobrequirements'];
        
        // Output job details
        echo "<h1>$vacancy1</h1>";
        
        // Check if job requirements file exists
        if(file_exists($jobrequirements)) {
            // Set appropriate headers for file download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . basename($jobrequirements) . "\"");
            
            // Read and output file contents
            readfile($jobrequirements);
        } else {
            echo "Job requirements file not found";
        }
    } else {
        echo "Job details not found";
    }
    
    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request";
}

// Close database connection
$mysqli->close();
?>
