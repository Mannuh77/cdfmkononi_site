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

// Check if ID is provided in the query string
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $id = $mysqli->real_escape_string($_GET['id']);
    
    // Query to fetch tender1des for the specified tender ID
    $sql = "SELECT tender1des FROM tenders WHERE id = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if tender details exist
    if($result->num_rows > 0) {
        // Fetch tender details
        $row = $result->fetch_assoc();
        $tender1des = $row['tender1des'];
        
        // Check if tender document file exists
        if(file_exists($tender1des)) {
            // Set appropriate headers for file download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . basename($tender1des) . "\"");
            header("Content-Length: " . filesize($tender1des));
            
            // Read and output file contents
            readfile($tender1des);
            
            // Exit script after file download
            exit;
        } else {
            echo "Tender document not found";
        }
    } else {
        echo "Tender details not found";
    }
    
    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request";
}

// Close database connection
$mysqli->close();
?>
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

// Check if ID is provided in the query string
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Sanitize input to prevent SQL injection
    $id = $mysqli->real_escape_string($_GET['id']);
    
    // Query to fetch tender1des for the specified tender ID
    $sql = "SELECT tender1des FROM tenders WHERE id = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("i", $id);
    
    // Execute the statement
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Check if tender details exist
    if($result->num_rows > 0) {
        // Fetch tender details
        $row = $result->fetch_assoc();
        $tender1des = $row['tender1des'];
        
        // Check if tender document file exists
        if(file_exists($tender1des)) {
            // Set appropriate headers for file download
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . basename($tender1des) . "\"");
            header("Content-Length: " . filesize($tender1des));
            
            // Read and output file contents
            readfile($tender1des);
            
            // Exit script after file download
            exit;
        } else {
            echo "Tender document not found";
        }
    } else {
        echo "Tender details not found";
    }
    
    // Close the statement
    $stmt->close();
} else {
    echo "Invalid request";
}

// Close database connection
$mysqli->close();
?>
