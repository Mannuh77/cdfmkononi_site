<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

$host = 'localhost'; // replace with your database host
$dbname = 'users_register'; // replace with your database name
$username = 'root'; // replace with your database username
$password = ''; // replace with your database password

// PDO connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM users WHERE constituencyNumber = ?");
    $stmt->execute([$_SESSION["constituencyNumber"]]);
    
    $user = $stmt->fetch(); 
    $_SESSION["firstname"] = $user['firstname'];
    $_SESSION["lastname"] = $user['lastname'];
    $_SESSION["email"] = $user['email'];
    $_SESSION["idnumber"] = $user['idnumber'];
    $_SESSION["constituencyNumber"] = $user['constituencyNumber'];
    $_SESSION["password"] = $user['password'];

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Change Password Logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["current_password"]) && isset($_POST["new_password"]) && isset($_POST["confirm_password"])) {
        $currentPassword = $_POST["current_password"];
        $newPassword = $_POST["new_password"];
        $confirmPassword = $_POST["confirm_password"];

        // Check if the current password matches the one in the database
        if (password_verify($currentPassword, $_SESSION["password"])) {
            // Check if the new password and confirm password match
            if ($newPassword === $confirmPassword) {
                // Update the password in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE constituencyNumber = ?");
                $updateStmt->execute([$hashedPassword, $_SESSION["constituencyNumber"]]);
                
                // Redirect to profile page
                header("Location: profile.php");
                exit();
            } else {
                $passwordError = "New passwords do not match!";
            }
        } else {
            $passwordError = "Incorrect current password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-weight: bolder;
           
            background-image: url();
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: wheat;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            font-size:26px;
            margin-bottom: 10px;
            font-weight: bold;
            font-size: 16px; /* Increased font size */
        }
        input[type="password"] {
            width: 50%;
            padding: 10px;
            font-size: 16px; /* Increased font size */
        }
        .profile-info {
            margin-bottom: 20px;
        }
    </style>
    <script>
        function togglePassword(inputID) {
            var x = document.getElementById(inputID);
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</head>
<body>
<div class="container">
    <h2>User Profile</h2>
    <div class="profile-info">
        <label for="firstname">First Name: <?php echo $_SESSION['firstname']; ?></label>
        <span id="firstname"></span>
    </div>
    <div class="profile-info">
        <label for="lastname">Last Name: <?php echo $_SESSION['lastname']; ?></label>
        <span id="lastname"></span>
    </div>
    <div class="profile-info">
        <label for="email">Email Address: <?php echo $_SESSION['email']; ?></label>
        <span id="email"></span>
    </div>
    <div class="profile-info">
        <label for="idnumber">ID Number: <?php echo $_SESSION['idnumber']; ?></label>
        <span id="idnumber"></span>
    </div>
    
    <div class="profile-info">
        <label for="constituencyNumber">Constituency Number: <?php echo $_SESSION['constituencyNumber']; ?></label>
        <span id="constituencyNumber"></span>
    </div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="profile-info">
            <label for="current_password">Current Password:</label>
            <input type="password" id="current_password" name="current_password" required>
            <input type="checkbox" onclick="togglePassword('current_password')"> Show Current Password
        </div>
        <div class="profile-info">
            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>
            <input type="checkbox" onclick="togglePassword('new_password')"> Show New Password
        </div>
        <div class="profile-info">
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <input type="checkbox" onclick="togglePassword('confirm_password')"> Show Confirm Password
        </div>
        <div style="color: red;"><?php echo isset($passwordError) ? $passwordError : ''; ?></div>
        <div class="profile-info">
            <button type="submit">CHANGE PASSWORD</button>
        </div>
    </form>
    <a href="logout.php">LOG-OUT</a>
</div>

</body>
</html>
