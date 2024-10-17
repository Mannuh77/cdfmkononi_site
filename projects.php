<?php
session_start(); // Start the session

$host = 'localhost'; // replace with your database host
$dbname = 'users_register'; // replace with your database name
$username = 'root'; // replace with your database username
$password = ''; // replace with your database password

// PDO connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

$stmt7 = $conn->prepare("SELECT * FROM projects WHERE constituencyNumber = ?");
$stmt7->execute([$_SESSION["constituencyNumber"]]);

$projects = $stmt7->fetchAll(PDO::FETCH_ASSOC);


foreach ($projects as $project) {
    echo "<div>";
    echo "<div class='rec-container3' style='width:95%; margin-bottom:15px; margin-top:7%; background:white; min-height:80vh;'>";

    echo "<h4>".$_SESSION['name']." PROJECTS</h4>";
    echo "<img class='abtproj' src='".$project['projimg1']."'></h2>";
    echo "<h4 style='margin-left:55%; margin-top:-30%;'>".$project['summary1']." </h4>";
    echo "<h4 style='margin-left:55%;'>STATUS: ".$project['status1']." </h4>";
    echo "<h4 style='margin-left:55%;'>START DATE: ".$project['start1']." </h4>";
    echo "<h4 style='margin-left:55%;'>COMPLETION DATE: ".$project['complete1']." </h4>";
    echo "<h4 style='margin-left:55%;'>ALLOCATED AMOUNT: ".$project['amount1']." </h4>";
    echo "<h4 style='margin-left:55%;'>WARD: ".$project['ward']." </h4>";
    echo "<h4 style='margin-left:55%;'>AMOUNT USED: ".$project['usedamount']." </h4>";

    // Input form for comments
    echo "<!-- Input form starts here -->";
    echo "<form method='post' action='comments.php' style='margin-top:200px; font-size: 18px;'>";
    echo "  <label for='constituencyName'><strong>Constituency Name:</strong></label><br>";
    echo "  <input type='text' id='constituencyName' name='constituencyName' style='width:300px; height:60px; font-size: 20px; font-weight: bold;'><br>";
    echo "  <label for='projectName'><strong>Project Name:</strong></label><br>";
    echo "  <input type='text' id='projectName' name='projectName' style='width:300px;height:60px; font-size: 20px; font-weight: bold;'><br>";
    echo "  <label for='userData'><strong>Residents comment on Project:</strong></label><br>";
    echo "  <textarea id='userData' name='comment' rows='4' cols='50' style='width:300px; font-size: 20px; font-weight: bold;'></textarea><br>";
    echo "  <input type='submit' name='submit' value='Submit' style='width:150px; height:39px;'>";
    echo "</form>";

    // Input form ends

    echo "</div>";
    echo "</div>";
}    
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
            <h1 class="cdfmkononi" style="margin-left:-10%;margin-top:10%; font-size: 20px;"><?php echo $_SESSION["name"]; ?></h1>
            
<ul style="margin-left:-5%"><li class="logo"><img style="margin-left:-5%; margin-top:15px;" class="img1" src="images/pcdf1.jpg" alt="CDF KENYA"></li>
<h1 style="margin-top: 10%; margin-left:-27%; font-size:20px;">PROJECTS  FOR FINANCIAL YEAR 2022/23</h1>