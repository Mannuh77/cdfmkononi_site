<?php
// Include your database connection file
include 'db.php';

// Function to highlight the search term in a string
function highlightSearchTerm($text, $searchTerm) {
    // Replace the search term with its HTML highlighted version
    return preg_replace("/($searchTerm)/i", "<span style='background-color: yellow;'>$1</span>", $text);
}

// Check if the search term is set and not empty in the GET request
if(isset($_GET['q']) && !empty(trim($_GET['q']))) {
    // Get the search term from the GET request
    $searchTerm = $_GET['q'];

    // Flag to check if any results are found
    $resultsFound = false;

    // Table to search
    $tableName = 'cons';

    // Get a list of all columns in the 'cons' table
    $columnsQuery = "SHOW COLUMNS FROM $tableName";
    $columnsResult = $mysqli->query($columnsQuery);

    // Initialize an array to store column names
    $tableColumns = array();

    // Loop through each column
    while($columnRow = $columnsResult->fetch_assoc()) {
        $columnName = $columnRow['Field'];
        $tableColumns[] = $columnName;
    }

    // Construct and execute a search query for all columns in the 'cons' table
    $searchQuery = "SELECT * FROM $tableName WHERE ";
    $conditions = array();
    foreach ($tableColumns as $column) {
        $conditions[] = "`$column` LIKE '%$searchTerm%'";
    }
    $searchQuery .= implode(' OR ', $conditions);
    $result = $mysqli->query($searchQuery);

    // Display search results for the 'cons' table
    if($result->num_rows > 0) {
        // Set flag to true if results are found
        $resultsFound = true;

        echo "<h2>Search Results for '$searchTerm'</h2>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>";
            // Display only the content of the matched item with the search term highlighted
            foreach ($row as $key => $value) {
                // Only display the column if it contains the search term
                if(stripos($value, $searchTerm) !== false) {
                    echo "<strong>$key:</strong> " . highlightSearchTerm($value, $searchTerm) . "<br>";
                }
            }
            echo "</li>";
        }
        echo "</ul>";
    }

    // If no results are found, display a message
    if(!$resultsFound) {
        echo "<h2 style='color:red;'>Oops! No results found for '$searchTerm'.</h2>";
    }

    // Close connection
    $mysqli->close();
} else {
    echo "<h2 style='color:red;'>Please enter your search item.</h2>";
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: wheat;
            margin-left: 0;
            font-size:20px;
            box-sizing: 5px ;
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