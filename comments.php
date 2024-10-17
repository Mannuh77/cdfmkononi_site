<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if the comment field is not empty
    if (!empty($_POST["comment"])) {
        // Check if the constituency name and project name fields are not empty
        if (!empty($_POST["constituencyName"]) && !empty($_POST["projectName"])) {
            // Connect to the database
            $db_username = 'root';
            $db_password = '';
            $db_name = 'users_register';
            $db_host = 'localhost';
            try {
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare SQL statement to insert comment, constituency name, and project name into the database
                $stmt = $conn->prepare("INSERT INTO comments (comment, constituencyName, projectName) VALUES (:comment, :constituencyName, :projectName)");

                // Bind parameters and execute the statement
                $stmt->bindParam(':comment', $_POST['comment']);
                $stmt->bindParam(':constituencyName', $_POST['constituencyName']);
                $stmt->bindParam(':projectName', $_POST['projectName']);
                $stmt->execute();

                // Redirect back to the page after submitting the comment
                header('Location: ' . $_SERVER['PHP_SELF']);
                exit;
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        } else {
            echo "Constituency Name or Project Name field is empty";
        }
    } else {
        echo "Comment field is empty";
    }

// Check if success parameter is set in the URL
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "Comment submitted successfully!";
}

}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Commments</title>
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