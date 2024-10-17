<?php
include 'db.php';

// Get form inputs
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$idnumber = $_POST["idnumber"];
$constituencyNumber = $_POST["constituencyNumber"];
$password = $_POST["password"];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Check if the user already exists
$stmt = $mysqli->prepare("SELECT COUNT(*) FROM users WHERE email = ? OR idnumber = ?");
$stmt->bind_param("si", $email, $idnumber);
$stmt->execute();
$stmt->bind_result($userCount);
$stmt->fetch();
$stmt->close();

if ($userCount > 0) {
    // User already exists, return an error message
    echo json_encode(array("success" => false, "message" => "User already exists"));
} else {
    // Insert the new user into the database
    $query = "INSERT INTO users (firstname, lastname, email, idnumber, constituencyNumber, Password) VALUES (?, ?, ?, ?, ?, ?)"; // Removed an extra placeholder
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ssssis", $firstname, $lastname, $email, $idnumber, $constituencyNumber, $hashedPassword); // Adjusted the bind_param call

    if ($stmt->execute()) {
        // Return a success message
        echo json_encode(array("success" => true, "message" => "User Registered Successfully"));
    } else {
        // Return an error message
        echo json_encode(array("success" => false, "error" => $mysqli->error));
    }
}
?>
