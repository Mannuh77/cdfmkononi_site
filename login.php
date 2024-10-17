<?php
session_start();

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    $_SESSION['error'] = "Email or password not provided!";
    header("Location: index.php"); // Redirect back to the login page
    exit();
}

// Database configuration
$host = 'localhost'; // change to your database host name
$dbname = 'users_register'; // change to your database name
$username = 'root'; // change to your database username
$password = ''; // change to your database password

try {
    // PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    $_SESSION['error'] = "Connection failed: " . $e->getMessage();
    header("Location: index.php"); // Redirect back to the login page
    exit();
}

$email = $_POST["email"];
$password = $_POST["password"];

if (strpos($email, "@admin.com") !== false) {
    // Admin login
    $table = 'admins';
} elseif (strpos($email, "@consadmin.com") !== false) {
    // Cons Admin login
    $table = 'consadmin';
} else {
    // User login
    $table = 'users';
}

// Prepare SQL statement to fetch user information
$stmt = $conn->prepare("SELECT * FROM $table WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() == 1) {
    $user = $stmt->fetch();
    $email2 = $user['email'];
    $password2 = $user['password'];
    $usertype = $user['usertype'];
    $constituency = $user['constituencyNumber'];
    $status = $user['status']; // Retrieve the status of the user

    if ($status == 'banned' || $status == 'frozen') {
        // Prevent login for banned or frozen users
        $_SESSION['error'] = "Your account is banned or frozen. Please contact the administrator for assistance.";
        header("Location: index.php");
        exit();
    }

    if (password_verify($password, $password2) && $email2 == $email) {
        // Authentication successful
        $_SESSION['email'] = $email; // Change to whatever unique identifier you want to use for the user
        $_SESSION['constituencyNumber'] = $constituency;

        if ($usertype == 'MAIN ADMIN') {
            $_SESSION['success'] = "Login successful!";
            header('location: Admin/indexadmin.php');
            exit();
       
        } elseif ($usertype == 'consadmin') {
            // Check if the constituency number matches
            $stmt = $conn->prepare("SELECT * FROM consadmin WHERE email = ? AND constituencyNumber = ?");
            $stmt->execute([$email, $constituency]);
            if ($stmt->rowCount() == 1) {
                $_SESSION['success'] = "Login successful!";
                header('location: consadmin/consadmin.php');
                exit();
            } else {
                $_SESSION['error'] = "Invalid email or password!";
            }


        } elseif ($usertype == 'user') {
            $_SESSION['success'] = "Login successful!";
            header('location: cons.php');
            exit();
        } else {
            // Handle other types of users here
            $_SESSION['error'] = "Unknown user type";
        }
    } else {
        // Invalid email or password
        $_SESSION['error'] = "Invalid email or password! trying logging in again";
    }
} elseif ($stmt->rowCount() == 0) {
    // User not found
    $_SESSION['error'] = "Invalid email or password! trying logging in again";
} else {
    // Error retrieving user information
    $_SESSION['error'] = "Error retrieving user information!";
}

// Redirect back to the login page
header("Location: index.php");
exit();
?>
