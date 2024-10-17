<?php
session_start();

$host = 'localhost'; 
$dbname = 'users_register'; 
$username = 'root'; 
$password = '';

// PDO connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM overall");
    $stmt->execute();

    // Fetch the result
    $overall = $stmt->fetch(); 
    $_SESSION["hoover-text"] = $overall['hoover-text'];
    $_SESSION["about"] = $overall['about'];
    $_SESSION["mission"] = $overall['mission'];
    $_SESSION["implement"] = $overall['implement'];
    $_SESSION["cdfprojects"] = $overall['cdfprojects'];
    $_SESSION["objectives"] = $overall['objectives'];
    $_SESSION["kasarani"] = $overall['kasarani'];
    $_SESSION["webuye"] = $overall['webuye'];
    $_SESSION["kapsowar"] = $overall['kapsowar'];
    $_SESSION["bursary"] = $overall['bursary'];
    $_SESSION["news"] = $overall['news'];
    $_SESSION["kabete"] = $overall['kabete'];
    $_SESSION["board"] = $overall['board'];
    $_SESSION["harambee"] = $overall['harambee'];
    $_SESSION["boxno"] = $overall['boxno'];
    $_SESSION["ngcdfno"] = $overall['ngcdfno'];
    $_SESSION["empowerment"] = $overall['empowerment'];
    $_SESSION["abtproj1"] = $overall['abtproj1'];
    $_SESSION["abtproj2"] = $overall['abtproj2'];
    $_SESSION["abtproj3"] = $overall['abtproj3'];
    $_SESSION["abtproj4"] = $overall['abtproj4'];

    // Insert log into database
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $page_visited = $_SERVER['PHP_SELF'];
    $stmt = $conn->prepare("INSERT INTO page_logs (user_ip, user_agent, page_visited) VALUES (:user_ip, :user_agent, :page_visited)");
    $stmt->bindParam(':user_ip', $user_ip);
    $stmt->bindParam(':user_agent', $user_agent);
    $stmt->bindParam(':page_visited', $page_visited);
    $stmt->execute();

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CDF Mkononi</title>
    <link rel="stylesheet" href="login.php">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="images/cdflogo.png">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>

<body>
   
    <section>
        <nav class="heading1">
            <ul>
                <h1 class="cdfmkononi">CDF MKONONI</h1>
                <li class="seal"><img class="img2" src="images/seal.png"></li>
                <li class="logo"><img class="img1" src="images/pcdf1.jpg" alt="CDF KENYA"></li>
                <li style="font-size:20px; font-weight:bolder;"> <a href="#" onclick="showContent('home')">Home</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" onclick="showContent('projects')">Projects</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" onclick="showContent('bursaries')">Bursaries</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" onclick="showContent('news')">News & Notices</a></li>

                <li>
                    <form >
                        <label for="searchInput"></label>
                        <input type="text" id="searchInput" name="q" placeholder="Enter your search term">
                        <button >Search</button>
                    </form>
                </li>
                <li class="button1" style="margin-top:-1%;"><a href="#" onclick="showContent('register')" onmouseleave="hideContent()">Register</a></li>
                <li class="login" style="margin-top:-1%;"><a href="#" onclick="showContent('login')" onmouseleave="hideContent()"><i class="fa-solid fa-user"></i>login</a></li>
               
        </ul> 
            
            </li>
            </ul>
        </nav>
    </section>
    <a href="#" onclick="showContent('about')" onmouseleave="hideContent()"></a>
    <a href="#" onclick="showContent('mission')" onmouseleave="hideContent()"></a>
    <a href="#" onclick="showContent('vision')" onmouseleave="hideContent()"></a>
    <a href="#" onclick="showContent('objectives')" onmouseleave="hideContent()"></a>
    <a href="#" onclick="clearContent()" onmouseleave="hideContent()"></a>
    <div id="content"></div>
            <div class="head1" style="margin-top:5%;">
            <span class="hover-text"><?php echo $_SESSION["hoover-text"];?></span>
        </div>
        <div id="searchResults"></div>
        <div id="registerForm" class="rectangular-container3" style="display: none;">
            
            <form id="registrationForm" class="registration-form" action="register.php" method="POST" onsubmit="return registerUser();">
            <h2 class="title">Registration Form</h2>            
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname">

          
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname">
                
                <label for="email">Email Address:</label>
                <input type="text" id="email" name="email">
        
                <label for="idnumber">ID Number:</label>
                <input type="text" id="idnumber" name="idnumber">

                <label for="constituencyNumber">Constituency Number:</label>
                <input type="text" id="constituencyNumber" name="constituencyNumber">
                       
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
        
                <label for="repassword">Re-enter Password:</label>
                <input type="password" id="repassword" name="repassword">
        
                <label for="checker">Accept terms and conditions that the data entered is true and can be used for official purpose:</label>
                <input type="checkbox" id="checker" name="checker">
        
                <button type="submit">Register</button><BR>
                <input type="button" value="LOGIN"onclick="showContent('login')" onmouseleave="hideContent()">
                
            </form>
        </div>


        <?php if (isset($_SESSION['error'])): ?>
        <div style="color: red;font-size:25px;"><?php echo $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div style="color: green;font-size:25px;"><?php echo $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

        <div id="loginForm" class="rectangular-container3" style="display: none;">
        <!-- Login form content -->
        
        <form id="actualLoginForm" class="login-form" action="login.php" method="POST">
            <label for="loginEmail">Email Address:</label>
            <input type="text" id="loginEmail" name="email" required>

            <label for="loginPassword">Password:</label>
            <input type="password" id="loginPassword" name="password" required >
            <input type="checkbox" onclick="togglePassword('loginPassword')"> Show Password

            <input type="submit" value="LOGIN"></input>
            <a href="forgotpassword.php" onclick="showContent('forgotpassword.php')">Forgot Password</a>
            <p>Not Registered? Click Register</p>
            <input type="button" value="REGISTER" onclick="showContent('register')" onmouseleave="hideContent()">
        </form>
    </div>
               
<div id="constituenciesForm" class="rectangular-container4" style="display: none;">
    <h2 class="registration-title1">Enter Constituency Details</h2>
    <form>
        <label for="constituencyDropdown"><h3>Select Constituency :</h3></label><br>
        <select id="constituencyDropdown" class="constituencyDropdown">
            <option value="const1">Constituency 1</option>
            <option value="const2">Constituency 2</option>
                   </select><br>
               </form>
</div>
<div class="rectangular-container3" id="passwordResetContainer" style="display: none;">
    <h2>Password Reset</h2>
    <form id="passwordResetForm" method="post">
        <label for="email">Enter your email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <button type="submit">Send</button>
    </form>
</div>

        <div class="image-container" style="width: 100%; z-index:-1000;">
            <img  src="Admin/<?php echo $_SESSION["kabete"]; ?> " class="hovimages">
            <img  src="Admin/<?php echo $_SESSION["board"]; ?>"class="hovimages">
            <img  src="Admin/<?php echo $_SESSION["webuye"]; ?>"class="hovimages">           
        </div>
        
   
        <div class="ovproj" style="width:100%;">
    <div class="box">
        <img src="Admin/<?php echo $_SESSION["webuye"]; ?>" class="ovprojimg">
        <h1 class="head2"><?php echo $_SESSION["abtproj1"]; ?></h1> 
    </div>

    <div class="box">
        <img src="Admin/<?php echo $_SESSION["board"]; ?>" class="ovprojimg">
        <h1 class="head2"><?php echo $_SESSION["abtproj2"]; ?></h1> 
    </div>

    <div class="box">
        <img src="Admin/<?php echo $_SESSION["kabete"]; ?>" class="ovprojimg">
        <h1 class="head2"><?php echo $_SESSION["abtproj3"]; ?></h1> 
    </div>

    <div class="box">
        <img src="Admin/<?php echo $_SESSION["empowerment"]; ?>" class="ovprojimg">
        <h1 class="head2"><?php echo $_SESSION["abtproj4"]; ?></h1> 
    </div>
</div>


    <div class="fsection">
        <footer class="footer-columns">
            <div class="column">
                <h1 class="Address">ADDRESS</h1>
                <p class="pharambee"><i class="fa-solid fa-building-columns"></i>&nbsp</i><?php echo $_SESSION["harambee"]; ?></p>
                <p class="pharambee"><i class="fa-solid fa-map-location-dot"></i><?php echo $_SESSION["boxno"]; ?></p>
                <p class="pharambee"><i class="fa-solid fa-phone"></i><?php echo $_SESSION["ngcdfno"]; ?></p>
                <p class="pharambee"><i class="fa-sharp fa-regular fa-envelope"></i><a href="mailto:info@ngcdf.go.ke">&nbsp info@ngcdf.go.ke</a></p>
            </div>
            
            <div class="column">
                <h2 class="link">LINKS</h2>
                <h3 class="badd"><a href="#" onmouseenter="showContent('home')" onmouseleave="hideContent()">Home</a></h3>
                <h3 class="badd"><a href="#" onmouseenter="showContent('about')" onmouseleave="hideContent()">About us</a></h3>
                <h3 class="badd"><a href="#" onmouseenter="showContent('projects')" onmouseleave="hideContent()">Projects</a></h3>
                <h3 class="badd"><a href="#" onmouseenter="showContent('bursaries')" onmouseleave="hideContent()">Bursaries</a></h3>
            </div>

            <div class="column">
        <h4 >SOCIAL MEDIAS</h4>
        <form action="redirect.php" method="post">
        <input style="background-color: transparent; border: 3px solid black; font-weight: bold; border-radius: 10px; font-size: 16px;" type="submit" name="facebook" value="Facebook"><br><br><br>
<input style="background-color: transparent; border: 3px solid black; font-weight: bold; border-radius: 10px; font-size: 16px;" type="submit" name="whatsapp" value="Whatsapp"><br><br><br>
<input style="background-color: transparent; border: 3px solid black; font-weight: bold; border-radius: 10px; font-size: 16px;" type="submit" name="twitter" value="Twitter">
        </form>
    </div>
    </div>

             </footer>
   
    
    <div style="background-color:azure;">
    <form action="submithelp.php" method="post" onsubmit="return validateForm()">
        <h3>HELP</h3>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" columns="4" placeholder="Explain your Message"></textarea><br>
        <span id="messageError" style="color: red;"></span><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email"><br>
        <span id="emailError" style="color: red;"></span><br><br>
        <button type="submit">Submit</button>
    </form>
</div>

        <div class="copyright">  Copyright &copy;Developed by Mannuh </div>


        <!------javascript------------------------------------------------>
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
        <script>
            var currentContentType = null;
    function showContent(contentType) {
               var contentContainer = document.getElementById("content");
    
    // Hide all forms
    document.getElementById('registerForm').style.display = 'none';
    document.getElementById('loginForm').style.display = 'none';
    document.getElementById('constituenciesForm').style.display = 'none';
    document.getElementById('passwordResetForm').style.display = 'none';

    if (contentType !== currentContentType) {
        switch (contentType) {
            case 'content1':
                contentContainer.innerHTML = "<div class='rectangular-container'><p>Content for ABOUT NG-CDF.</p></div>";
                break;
            case 'content2':
                contentContainer.innerHTML = "<div class='rectangular-container'><p>Content for About NG-CDF MISSION</p></div>";
                break;
            case 'home':
                contentContainer.innerHTML = "<div class='rectangular-container'style='margin-top:100px;'>" +
                    "<ul>" +
                    "<li>KNOW MORE ABOUT CDF KENYA</li>" +
                    "<li><a href='#' onclick='showContent(`about`)'>ABOUT US</a></li>" +
                    "<li><a href='#' onclick='showContent(`mission`)'>MISSION</a></li>" +
                    "<li><a href='#' onclick='showContent(`vision`)'>NG-CDF IMPLEMENTATION STRUCTURE</a></li>" +
                    "<li><a href='#' onclick='showContent(`objectives`)'>OBJECTIVES</a></li>" +
                    "</ul>" +
                    "</div>";
                break;
                case 'register':
                  document.getElementById('registerForm').style.display = 'block';
                 break;
                    case 'login':
                  document.getElementById('loginForm').style.display = 'block';
                 break;

                 case 'constituencies':
                  document.getElementById('constituenciesForm').style.display = 'block';
                 break;
                 case 'forgotpassword':
                document.getElementById('passwordResetForm').style.display = 'block';
                break;

                             
                case 'about':
                contentContainer.innerHTML = "<div class='rectangular-container' style='margin-top:100px;'>" +
                    "<h3> About Us </h3>" +
                    "<p><?php echo $_SESSION["about"];?><p>" +
                    "</div>";
                break;
                case 'mission':
                contentContainer.innerHTML = "<div class='rectangular-container'style='margin-top:100px;'>" +
                    "<h4>MISSION VISION CORE VALUES</h4>" +
                    "<p><?php echo $_SESSION["mission"];?></p>" +
                    "</div>";
                break;
                case 'vision':
                contentContainer.innerHTML = "<div class='rectangular-container5'style='margin-top:100px;width:98%;'>" +
                    "<h4>NG CDF Implementation Structure</h4>" +
                    "<p><?php echo $_SESSION["implement"];?></p>" +
                    "</div>";
                break;
            case 'objectives':
                contentContainer.innerHTML = "<div class='rectangular-container'style='margin-top:100px;'>" +
                    "<p>Objectives.</p>" +
                    "<p><?php echo $_SESSION["objectives"];?></p>" +
                    "</div>";
                break;
                case 'projects':
                contentContainer.innerHTML = "<div class='rectangular-container5'style='margin-top:100px;width:98%;'>" +
                    "<h1>About CDF PROJECTS.</h1>" +
                    "<h3><?php echo $_SESSION["cdfprojects"];?></h3>"+               
                    "<img class='project-image' src='Admin/<?php echo $_SESSION["kasarani"];?>'>" +
                    "<img class='project-image' src='Admin/<?php echo $_SESSION["webuye"];?>'>" +
                      "</div>";
                break;
            case 'bursaries':
                contentContainer.innerHTML = "<div class='rectangular-container5'style='margin-top:100px;width:98%;'>" +
                    "<h1>About Cdf Bursaries.</h1>" +
                    "<p><?php echo $_SESSION["bursary"];?></p>"+
                    "<img class='project-image' src='Admin/<?php echo $_SESSION["kapsowar"];?>'>" +
                                      "</div>";
                break;
            case 'news':
                contentContainer.innerHTML = "<div class='rectangular-container'style='margin-top:100px;'>" +
                    "<h1>News & Notices.</h1>" +
                    
                    "<p><h3><p><?php echo $_SESSION["news"];?></p></h3> </p>" +
                    "</div>";
                break;
            
            default:
                contentContainer.innerHTML = "<div class='rectangular-container'><p>Default Content.</p></div>";
                break;
        
           
            }

        }
    }

    document.querySelector('a[data-content-type="home"]').addEventListener('mouseenter', function () {
    showContent('home');
});
document.querySelector('a[data-content-type="bursaries"]').addEventListener('mouseenter', function () {
    showContent('bursaries');
});
document.querySelector('a[data-content-type="projects"]').addEventListener('mouseenter', function () {
    showContent('projects');
});
document.querySelector('a[data-content-type="news"]').addEventListener('mouseenter', function () {
    showContent('news');
});

// Event listener for mouse leave on the content area to clear content if no links are hovered
document.getElementById('content').addEventListener('mouseleave', function () {
    if (!document.querySelector('nav a:hover') && !document.getElementById('content:hover')) {
        clearContent();
    }
});

// Function to clear content
function clearContent() {
    var contentContainer = document.getElementById("content");
    contentContainer.innerHTML = "";
}

        // Event listener to display the registration form when hovering over the register link
document.querySelector('a[data-content-type="register"]').addEventListener('mouseenter', function() {
    showContent('registerForm');
});

// Event listener to display the password reset form when clicking the "FORGOT PASSWORD" button
document.querySelector('input[value="FORGOT PASSWORD"]').addEventListener('click', function() {
    console.log("Forgot Password button clicked"); // Check if the event listener is triggered
    showContent('forgotpassword');
});


// Event listener to display the login form when hovering over the login link
document.querySelector('a[data-content-type="login"]').addEventListener('mouseenter', function() {
    showContent('loginForm');
});

// Event listener to display the constituencies form when hovering over the constituencies link
document.querySelector('a[data-content-type="constituencies"]').addEventListener('mouseenter', function() {
    showContent('constituenciesForm');
});
// Function to handle registration form submission
function registerUser() {
    // Get form inputs
    var firstName = document.getElementById('firstname').value;
    var lastName = document.getElementById('lastname').value;
    var email = document.getElementById('email').value;
    var idNumber = document.getElementById('idnumber').value;
    var constituencyNumber = document.getElementById('constituencyNumber').value;
    var password = document.getElementById('password').value;
    var repassword = document.getElementById('repassword').value;
    var checker = document.getElementById('checker').checked;

    // Validate and display errors for first name
    if (!firstName.trim()) {
        alert('First name must not be empty');
        return false;
    }

    // Validate first name (only characters allowed)
    function isValidName(name) {
    // Regular expression to match only alphabetic characters, excluding single characters
    return /^[a-zA-Z]+(?:[-' ]?[a-zA-Z]+)*$/.test(name);
}

// Validate first name
if (!isValidName(firstName)) {
    alert('First name must contain only strings of alphabetic characters');
    return false;
}


    // Validate first name type (should be string)
    if (!isString(firstName)) {
        alert('First name must be a string');
        return false;
    }

    // Validate and display errors for last name
    if (!lastName.trim()) {
        alert('Last name must not be empty');
        return false;
    }

    // Validate last name (only characters allowed)
    if (!isValidName(lastName)) {
        alert('Last name must contain only alphabetic characters, spaces, and certain special characters');
        return false;
    }

    // Validate last name type (should be string)
    if (!isString(lastName)) {
        alert('Last name must be a string');
        return false;
    }

    // Validate and display errors for email
    if (!email.trim()) {
        alert('Email must not be empty');
        return false;
    }

    // Validate email format
    if (!validateEmail(email)) {
        alert('Invalid email format');
        return false;
    }

    // Validate and display errors for ID number
    if (!idNumber.trim()) {
        alert('ID number must not be empty');
        return false;
    }

    // Validate ID number (should be 8 digits)
    if (!/^\d{6,9}$/.test(idNumber) || idNumber === '0' || parseInt(idNumber) <= 99999) {
    alert('ID number must be between 6 and 9 digits long, not zero, and greater than 99999');
    return false;
}


    // Validate and display errors for constituency number
    if (!constituencyNumber.trim()) {
        alert('Constituency number must not be empty');
        return false;
    }

    // Validate constituency number (should be between 1 and 290)
    var constituencyNumInt = parseInt(constituencyNumber);
    if (isNaN(constituencyNumInt) || constituencyNumInt < 1 || constituencyNumInt > 290) {
        alert('Constituency number must be between 1 and 290');
        return false;
    }

    // Validate and display errors for password
    if (!password.trim()) {
        alert('Password must not be empty');
        return false;
    }

    // Validate password (at least one uppercase, one lowercase, and one digit)
    if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}/.test(password)) {
        alert('Password must contain at least one uppercase letter, one lowercase letter, and one digit');
        return false;
    }

    // Validate and display errors for re-entered password
    if (!repassword.trim()) {
        alert('Please re-enter your password');
        return false;
    }

    // Check if the passwords match
    if (password !== repassword) {
        alert('Passwords do not match');
        return false;
    }

    // Send form data to the server
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'register.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    // Registration successful, redirect to login form
                    alert('User Registered Successfully');
                } else {
                    // Registration failed, display error message
                    if (response.message) {
                        alert(response.message); // Display user exists message
                    } else {
                        alert('Error: ' + response.error); // Display general error message
                    }
                }
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };
    xhr.send('firstname=' + encodeURIComponent(firstName) +
        '&lastname=' + encodeURIComponent(lastName) +
        '&email=' + encodeURIComponent(email) +
        '&idnumber=' + encodeURIComponent(idNumber) +
        '&constituencyNumber=' + encodeURIComponent(constituencyNumber) +
        '&password=' + encodeURIComponent(password));

    // Prevent form submission
    return false;
}

// Function to validate name format (only characters allowed)
function isValidName(name) {
    return /^[A-Za-z\s']*$/.test(name);
}

// Function to check if a value is a string
function isString(value) {
    return typeof value === 'string' || value instanceof String;
}

// Function to validate email format
function validateEmail(email) {
    // Regular expression for common email formats
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}

</script>
<script>
// Function to perform search
function performSearch() {
    var input = document.getElementById('searchInput').value;

    // Create XHR object
    var xhr = new XMLHttpRequest();

    // Configure the request
    xhr.open('GET', 'search.php?q=' + input, true);

    // Define what happens on successful data submission
    xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 300) {
            // Request was successful, update search results
            document.getElementById('searchResults').innerHTML = xhr.responseText;
        } else {
            // Error handling
            console.error('Request failed with status ' + xhr.status);
        }
    };

    // Send the request
    xhr.send();
}

// Listen for changes in the input field
document.getElementById('searchInput').addEventListener('input', function() {
    performSearch();
});
</script>

<script>
    function validateForm() {
        var message = document.getElementById('message').value.trim();
        var email = document.getElementById('email').value.trim();
        var messageError = document.getElementById('messageError');
        var emailError = document.getElementById('emailError');
        var isValid = true;

        // Reset error messages
        messageError.textContent = '';
        emailError.textContent = '';

        // Validate message
        if (message === '') {
            messageError.textContent = 'Please enter your message.';
            isValid = false;
        }

        // Validate email
       

        return isValid;
    }
</script>
                        </body>
</html>