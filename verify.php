<?php
//session_start();
include 'db.php';

if (isset($_POST['email']) && isset($_POST['password']) ) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //$idnumber = $_POST['idnumber'];
    //$constituencyNumber = $_POST['constituencyNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        header("location: login.php?error=User Name Required");
        exit();
    } /*else if (empty($constituencyNumber)) {
        header("location: login.php?error=constituencyNumber Required");
        exit();
    } else if (empty($idnumber)) {
        header("location: login.php?error=idnumber Required");
        exit();
    } */else if (empty($password)) {
        header("location: login.php?error=Password required");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE Email = '$email' AND password='$password'";
        $result = mysqli_query($mysqli, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            
            if ($row["Email"] === $email && $row["Password"] === $password) {
                $_SESSION['email'] = $row['Email'];
                $_SESSION['id'] = $row['id'];
                header('Location: cons.php');
                exit();
            } else {
                header("Location: login.php?error=Incorrect username or password");
                exit();
            }
        }
    }
}

