<?php
session_start();
if (!isset($_SESSION["constituencyNumber"])){
    header('location:login.php');


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


$stmt = $conn->prepare("SELECT * FROM cons WHERE constituencyNumber = ?");
$stmt->execute([$_SESSION["constituencyNumber"]]);

    $cons = $stmt->fetch(); 
    $_SESSION["name"] = $cons['name'];
    $_SESSION["location"] = $cons['location'];
    $_SESSION["image1"] = $cons['image1'];
    $_SESSION["image2"] = $cons['image2'];
    $_SESSION["image3"] = $cons['image3'];
    $_SESSION["mpname"] = $cons['mpname'];
    $_SESSION["About Mp"] = $cons['About Mp'];
    $_SESSION["simage"] = $cons['simage'];
    $_SESSION["comchair"] = $cons['comchair'];
    $_SESSION["comvchair"] = $cons['comvchair'];
    $_SESSION["wardrep1"] = $cons['wardrep1'];
    $_SESSION["wardrep2"] = $cons['wardrep2'];
    $_SESSION["fund"] = $cons['fund'];
    $_SESSION["description"] = $cons['description'];
    $_SESSION["accountant"] = $cons['accountant'];
    $_SESSION["ictmanager"] = $cons['ictmanager'];
    $_SESSION["projectmanager"] = $cons['projectmanager'];
    $_SESSION["secretary"] = $cons['secretary'];
    $_SESSION["security"] = $cons['security'];
    $_SESSION["disablerep"] = $cons['disablerep'];
    $_SESSION["allocate"] = $cons['allocate'];
    $_SESSION["report"] = $cons['report'];


    $stmt2 = $conn->prepare("SELECT * FROM projects WHERE constituencyNumber = ?");
    $stmt2->execute([$_SESSION["constituencyNumber"]]);
    
        $projects = $stmt2->fetch(); 
        $_SESSION["projimg1"] = $projects['projimg1'];
        $_SESSION["summary1"] = $projects['summary1'];
        $_SESSION["status1"] = $projects['status1'];
        $_SESSION["start1"] = $projects['start1'];
        $_SESSION["complete1"] = $projects['complete1'];
        $_SESSION["amount1"] = $projects['amount1'];
        $_SESSION["ward"] = $projects['ward'];
        $_SESSION["usedamount"] = $projects['usedamount'];
       
       

    
 
        $stmt3 = $conn->prepare("SELECT * FROM tenders WHERE constituencyNumber = ?");
        $stmt3->execute([$_SESSION["constituencyNumber"]]);
        
        $tenders = $stmt3->fetch(); 
        $_SESSION["tender1"] = $tenders['tender1']; 
        
        $_SESSION["tender1des"] = $tenders['tender1des']; 
       
    
    $stmt4 = $conn->prepare("SELECT * FROM vacancies WHERE constituencyNumber = ?");
    $stmt4->execute([$_SESSION["constituencyNumber"]]);
    
    $vacancies = $stmt4->fetch(); 
    $_SESSION["vacancy1"] = $vacancies['vacancy1']; 
    $_SESSION["vacancy2"] = $vacancies['vacancy2']; 


    $stmt5 = $conn->prepare("SELECT * FROM contacts WHERE constituencyNumber = ?");
    $stmt5->execute([$_SESSION["constituencyNumber"]]);
    
    $contacts = $stmt5->fetch(); 
    $_SESSION["phone"] = $contacts['phone']; 
    $_SESSION["email"] = $contacts['email']; 

    $stmt6 = $conn->prepare("SELECT * FROM notice WHERE constituencyNumber = ?");
    $stmt6->execute([$_SESSION["constituencyNumber"]]);
    
    $notice = $stmt6->fetch(); 
    $_SESSION["notification"] = $notice['notification']; 
   
    
    
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="cons.css">
    <link rel="shortcut icon" href="images/cdflogo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
   

</style>
<body>
    
       
<section>
    <nav class="heading1">
        <ul>
            <h1 class="cdfmkononi1" style="margin-left:-10%;margin-top:10px; font-weight:bolder;font-size:19px;"><?php echo $_SESSION["name"]; ?></h1>

            <ul>
                <li class="logo"><img style="margin-left:-320%; margin-top:25px;" class="img1" src="images/pcdf1.jpg" alt="CDF KENYA"></li>
                <li style="margin-left:-15%;font-size:20px; font-weight:bolder;"><a href="#" data-content-type="home" onmouseenter="showContent('home')" onmouseleave="hideContent()">Home</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" data-content-type="about" onclick="showContent('About Ng-cdf')" onmouseleave="hideContent()">About Ng-cdf</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="projectdir.php" data-content-type="projects" onclick="showContent('')" onmouseleave="hideContent()">Projects</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" data-content-type="bursaries" onclick="showBursaryForm()">Bursaries</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" data-content-type="news" onclick="showContent('news')" onmouseleave="hideContent()">News & Notices</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" data-content-type="job" onclick="showJobAppForm()">Job Application</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="#" data-content-type="tender" onclick="showTenderAppForm()">Tender Application</a></li>
                <li style="font-size:20px; font-weight:bolder;"><a href="contacts.php" data-content-type="contact" onclick="showContent('')">Contact Us</a></li>
                <ul>
        <li class="button1" style="margin-top:-15px; margin-left:84%;"><a href="profile.php" onmouseenter="showContent('profile')" onmouseleave="hideContent()">PROFILE</a></li>
        <li class="login" style="margin-top:-15px; margin-left:89%;"><a href="logout.php" onmouseenter="showContent('logout')" onmouseleave="hideContent()"><i class="fa-solid fa-user"></i>Log out</a></li>
    </ul>
            
            </ul>
        </ul>
    </nav>
</section>

            
<span class="hover-text" style="margin-top:-9%;color:red;"><?php echo $_SESSION["notification"]; ?></span> 
        <div id="contentContainer" style="display: absolute; "  ></div>
        <!-------bursary Application form------>

        <div id="bursaryFormContainer" style="height:fit-content; width:200vh;background:antiquewhite;margin-top:5%;display:none;">
        
        <h2>Bursary Application Form</h2>

<form id="bursaryform" action="bursaryapp.php" method="POST" enctype="multipart/form-data">

    <div style="display: flex; flex-wrap: wrap;">
        <div style="flex: 1; margin-right: 20px;">
            <label for="studentname"><b>Student Name:</b></label>
            <input type="text" id="studentname" name="studentname" style="width: 230px; height:30px;" required oninput="validateStudentName()">
            <span id="studentnameError" class="error"></span> 
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="registrationnumber"><b>Registration Number/Admission Number:</b></label>
            <input type="text" id="registrationnumber" name="registrationnumber" style="width: 230px; height:30px;" required>
            <span id="registrationnumber" class="error"></span> 
        </div>
        <div style="flex: 1;">
            <label for="phone"><b>Phone Number:</b></label>
            <input type="text" id="phone" name="phone" style="width: 230px; height:30px;" required oninput="validatePhoneNumber()">
            <span id="phoneError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="idNumber"><b>Parent/Student ID Number:</b></label>
            <input type="text" id="idNumber" name="idNumber" style="width: 230px; height:30px;" required oninput="validateIDNumber()">
            <span id="idNumberError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="Sub-County"><b>Sub-County:</b></label>
            <select id="sub-county" name="subcounty" style="width: 230px; height:30px;">
                <?php include 'fetch_subcounties.php'; ?>
            </select>
        </div>


       <div style="flex: 1; margin-right: 20px;">
    <label for="Wards"><b>Ward:</b></label>
    <select id="wards" name="wards" style="width: 230px; height:30px;">
    <?php include 'fetchwards.php'; ?>
    </select>
</div>
        <div style="flex: 1;">
            <label for="constituencyNumber"><b>Constituency Number:</b></label>
            <input type="text" id="constituencyNumber" name="constituencyNumber" style="width: 230px; height:30px;" required oninput="validateConstituencyNumber()">
            <span id="constituencyNumberError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="constituencyName"><b>Constituency Name:</b></label>
            <input type="text" id="constituencyName" name="constituencyName" style="width: 230px; height:30px;" required>
            <span id="constituencyNumberError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="email"><b>Email Address:</b></label>
            <input type="email" id="email" name="email" style="width: 230px; height:30px;" required oninput="validateEmail()">
            <span id="emailError" class="error"></span>
        </div>
        <div style="flex: 1;">
            <label for="address"><b>Address:</b></label>
            <textarea id="address" name="address" style="width: 230px; height:30px;" required oninput="validateAddress()"></textarea>
            <span id="addressError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="school"><b>School/Institution Name:</b></label>
            <input type="text" id="school" name="school" style="width: 230px; height:30px;" required oninput="validateSchoolName()">
            <span id="schoolError" class="error"></span>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="course"><b>Course of Study:</b></label>
            <input type="text" id="course" name="course" style="width: 230px; height:30px;" required oninput="validateCourse()">
            <span id="courseError" class="error"></span>
        </div>
        <div style="flex: 1;">
            <label for="admissionletter"><b>Admission Letter:</b></label><br><br>
            <input type="file" id="admissionletter" name="admissionletter" required>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="idcertificate"><b>ID/Birth Certificate:</b></label><br><br>
            <input type="file" id="idcertificate" name="idcertificate" required>
        </div>
        <div style="flex: 1;">
            <label for="supportingdocs"><b>Other Supporting Documents:</b></label><br><br>
            <input type="file" id="supportingdocs" name="supportingdocs[]" required>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="feebalance"><b>Fee Balance:</b></label>
            <input type="text" id="feebalance" name="feebalance" style="width: 230px; height:30px;" required oninput="validateFeeBalance()">
            <span id="feeBalanceError" class="error"></span>
        </div>
        <div style="flex: 1;">
            <label for="applicationdate">Application Date:</label>
            <input type="date" id="applicationdate" name="applicationdate" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>" required>
        </div>
        <div style="flex: 1; margin-right: 20px;">
            <label for="year"><b>Year of Study:</b></label>
            <select id="year" name="year" style="width: 230px; height:30px;">
                <option value="1">Form One </option>
                <option value="2">Form Two</option>
                <option value="3">Form Three</option>              
                <option value="5">Form Four</option>
                <option value="1">First Year</option>
                <option value="2">Second Year</option>
                <option value="3">Third Year</option>
                <option value="4">Fourth Year</option>
                <option value="5">Fifth Year</option>
                <option value="4">Sixth Year</option>
                <option value="5">Other</option>
            </select>
        </div>
        <div style="flex: 1;">
            <label for="reason"><b>Reason for Applying:</b></label><br>
            <textarea id="reason" name="reason" style="width: 530px; height:100px;" required oninput="validateReason()"></textarea>
            <span id="reasonError" class="error"></span>
        </div>
        <div style="flex: 1;">
            <button type="submit" style="width: 130px; height:30px;">Submit Application</button>
        </div>
    </div>
</form>

</div>
<!--------Tender Application Form----->
<div id="TenderappFormContainer" style="height:fit-content;width:200vh;background:antiquewhite;margin-top:5%;display:none;">
    <h2>Tender Application Form</h2>

    <form action="submit_tender.php" method="post" enctype="multipart/form-data">
        <div style="display: inline-block; margin-right: 10%;">
            <label class="form-label" for="name">Full Name:</label><br>
            <input class="form-input" type="text" id="fullname" name="fullname" required oninput="validateFullName()"><br><br>

            <label class="form-label" for="email">Email:</label><br>
            <input class="form-input" type="email" id="email" name="email" required oninput="validateEmail()"><br><br>

            <label class="form-label" for="phone">Phone Number:</label><br>
            <input class="form-input" type="tel" id="tenderPhone" name="phone" required oninput="validatePhoneNumber()"><br><br>
        </div>

        <div style="display: inline-block; margin-right: 15%;">
            <label class="form-label" for="company">Company Name:</label><br>
            <input class="form-input" type="text" id="company" name="company" required oninput="validateCompanyName()"><br><br>

            <label class="form-label" for="tender_name">Tender Name:</label><br>
            <input class="form-input" type="text" id="tender_name" name="tender_name" required oninput="validateTenderName()"><br><br>

            <label class="form-label" for="constituency">Constituency Name:</label><br>
            <input class="form-input" type="text" id="constituency" name="constituency" required oninput="validateConstituencyName()"><br><br>

            <label for="constituencyNumber"><b>Constituency Number:</b></label><br>
            <input type="text" id="constituencyNumber" name="constituencyNumber" style="width: 230px; height:30px;" required oninput="validateConstituencyNumber()">
            <span id="constituencyNumberError" class="error"></span>

        </div>

        


        <div style="display: inline-block;">
            <label class="form-label" for="kra_pin">KRA PIN Document:</label><br>
            <input class="form-input" type="file" id="kra_pin" name="kra_pin" required><br><br>

            <label class="form-label" for="business_registration">Business Registration Document:</label><br>
            <input class="form-input" type="file" id="business_registration" name="business_registration" required><br><br>

            <label class="form-label" for="application_letter">Tender Application Letter:</label><br>
            <input class="form-input" type="file" id="application_letter" name="application_letter" required><br><br>
        </div>
<div>
        <input type="submit" value="Submit">
        </div>
    </form>
</div>

<!--------Job Application Form----->
<div id="JobAppFormContainer" style="height: fit-content; width:200vh; background: antiquewhite; margin-top: 5%; display: none;">
    <h2>Job Application Form</h2>

    <form action="submit_job.php" method="post" enctype="multipart/form-data">
        <div style="display: inline-block; margin-right: 10%;">
            <label class="form-label" for="full_name">Full Name:</label><br>
            <input class="form-input" type="text" id="full_name" name="full_name" required oninput="validateFullName()"><br><br>

            <label class="form-label" for="email">Email:</label><br>
            <input class="form-input" type="email" id="email" name="email" required><br><br>

            <label class="form-label" for="phone">Phone Number:</label><br>
            <input class="form-input" type="tel" id="jobphone" name="phone" required oninput="validatePhoneNumber()"><br><br>
        </div>

        <div style="display: inline-block; margin-right: 15%; ">
            <label class="form-label" for="idnumber">ID Number:</label><br>
            <input class="form-input" type="text" id="jobidnumber" name="idnumber" required oninput="validateIDNumber()"><br><br>

            <label class="form-label" for="job_applied_for">Job Applied For:</label><br>
            <input class="form-input" type="text" id="job_applied_for" name="job_applied_for" placeholder="Enter available job,confirm from Notices"><br><br>

            <label class="form-label" for="constituency">Constituency Name:</label><br>
            <input class="form-input" type="text" id="jobconstituency" name="constituency" required oninput="validateConstituencyName()"><br><br>
        </div>



       

        <div style="display: inline-block;">

        <label class="form-label" for="constituencyNumber">Constituency Number:</label><br>
                <input class="form-input" type="text" id="constituencyNumber" name="constituencyNumber" required><br><br>
       
            <label class="form-label" for="resume">Resume/CV:</label><br>
            <input class="form-input" type="file" id="resume" name="resume" required><br><br>

            <label class="form-label" for="application_letter">Application Letter:</label><br>
            <input class="form-input" type="file" id="application_letter" name="application_letter" required><br><br>

            <input type="submit" value="Submit">
        </div>
    </form>
</div>



    </section>

    <div class="aboutcons">
        <h1 style="margin-left:26%;">WELCOME TO <?php echo $_SESSION["name"];?></h1><br> 
        <div class="divimg" style="width:100%;">
            <img class="constimg" style="width: 100%;height:100%;" src="Admin/<?php echo $_SESSION["image1"]; ?>">
        </div>
        <div class="about" style="width:50%;height:50vh; background-color:greenyellow; ">
            <h2>About Us</h2>
            <h3><?php  echo $_SESSION["description"]; ?></h3>
        </div>
        <div style="width:47%;margin-left:52%;height:50vh;margin-top:-54vh;">
            <img class="constmap" style="width: 50%;height:90%;margin-top:10px;margin-left:30px;" src="Admin/<?php echo $_SESSION["image2"]; ?>">
        </div>
       
    </div>


    <div style="background-color:azure;">
    <form action="consubmithelp.php" method="post"  onsubmit="return validateconhelpForm()">
        <h3>HELP</h3>
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" columns="4" placeholder="Explain your Message"></textarea><br>
        <span id="messageError" style="color: red;"></span><br><br>
        <label class="form-label" for="constituencyNumber">Constituency Number:</label><br>
        <input class="form-input" type="text" id="constituencyNumber" name="constituencyNumber" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email"><br>
        <span id="emailError" style="color: red;"></span><br><br>
        <button type="submit">Submit</button>
    </form>
</div>




    <!-----js--->
    <script>
    function showContent(contentType) {
        var contentContainer = document.getElementById("contentContainer");
        switch (contentType) {
            case 'About Ng-cdf':
                contentContainer.innerHTML = "<div class='abtcontainer' style='width:200vh; border: 1px solid #be1c1c; padding: 10px; margin-top: 50px; font-size: 24px; font-weight: bold; border-radius: 5px; background-color: #c9e9bf;'>" +
                    "<ul>" +
                 
                    "<h2><?php echo $_SESSION["name"];?></h2>" +
                    "<li><a href='#' onclick='showContent(`ourmp`)'>OUR MP</a></li>" +
                    "<li><a href='#' onclick='showContent(`ngcdfboard`)'>NG-CDF BOARD</a></li>" +
                    "<li><a href='#' onclick='showContent(`staffs`)'>STAFFS</a></li>" +
                    "<li><a href='#' onclick='showContent(`psc`)'>PARLIAMENTARY SERVICE COMMISSION</a></li>" +
                    "<li><a href='#' onclick='showContent(`report`)'>REPORT ON USE OF THE ALLOCATED AMOUNT</a></li>" +
                    "<li>ALLOCATED AMOUNT:<?php echo $_SESSION["allocate"];?></a></li>"+
                     "</ul>" +
                    "</div>";
                break;
                case 'ourmp':
                contentContainer.innerHTML = "<div class='rec-container'style='border: 1px solid #be1c1c; padding: 10px; margin-top: 50px; font-size: 24px; font-weight: bold;  background-color: #c9e9bf;height:100vh;'>" +
                    "<h2 class='mp'><?php echo $_SESSION["mpname"];?></h2>"+
                    "<img class='constmp'src='Admin/<?php echo $_SESSION["image3"];?>'>"+
                     "<h2 class='abtmp'><?php echo $_SESSION["About Mp"];?> </h2>"+
                     "</ul>" +
                    "</div>";
                break;

                case 'ngcdfboard':
                contentContainer.innerHTML = "<div class='rec-container1'>" +
                
                    "<div class='chair'><h3>Chairperson</h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"];?>'><p><?php echo $_SESSION["comchair"];?></p></div>"+
                     "<div class='chair'><h3>vice-chair</h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["comvchair"];?></p></div>"+
                     "<div class='chair'><h3>Ward Rep1</h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["wardrep1"];?></p></div>"+
                     "<div class='chair'><h3>Ward Rep2</h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["wardrep2"];?></p></div>"+
                     "<div class='chair'><h3>Fund Acc.Manager</h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["fund"];?></p></div>"+
                     "<div class='chair'><h3>Disabilities Rep </h3><br><img class='user' src='Admin/<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["disablerep"];?></p></div>"+
                     "</div>";
                    break;

                    case 'staffs':
                contentContainer.innerHTML = "<div class='rec-container1'style='overflow-y: scroll;'>" +
                "<div class='chair'><h3>Fund Acc.Manager</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["fund"];?></p></div>"+
                    "<div class='chair'><h3>Accountant</h3><br><img class='user' src='<?php echo $_SESSION["simage"];?>'><p><?php echo $_SESSION["accountant"];?></p></div>"+
                     "<div class='chair'><h3>ICT MANAGER</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["ictmanager"];?></p></div>"+
                     "<div class='chair'><h3>PROJECT MANAGER</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["projectmanager"];?></p></div>"+
                     "<div class='chair'><h3>SECRETARY</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["secretary"];?></p></div>"+
                     "<div class='chair'><h3>SECURITY</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["security"];?></p></div>"+
                     "</div>";
                    break;
                    case 'psc':
                contentContainer.innerHTML = "<div class='rec-container1'style='width:200vh;'>" +
                "<div class='staff' style='width:400px;'><h3>Parliamentary service commission SECRETARY</h3><br><img class='user' src='<?php echo $_SESSION["simage"];?>'><p><?php echo $_SESSION["accountant"];?></p></div>"+
                "<div class='staff'><h3>NG-CDF CHAIRPERSON</h3><br><img class='user' src='<?php echo $_SESSION["simage"];?>'><p><?php echo $_SESSION["comchair"];?></p></div>"+
                "<div class='staff'><h3>Fund Account Manager</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["fund"];?></p></div>"+
                "<div class='staff'><h3>Wards Representative</h3><br><img class='user' src='<?php echo $_SESSION["simage"]; ?>'><p><?php echo $_SESSION["wardrep1"];?></p></div>"+ 
                  
                     "</div>";

                 break;
                
                 case 'news':
    contentContainer.innerHTML = "<div class='rec-container'style='width:200vh;margin-top:7%;font-size:30px; font-weight:bolder;height:100vh; background-color: #c9e9bf;'>" +
        "<ul>" +
        "<h5><?php echo $_SESSION["name"];?></h5>" +
        "<li><a href='tenderadv.php' onclick='showContent(``)'>Tenders Advertisements</a></li>" +
        "<li><a href='jobvacancies.php' onclick='showContent(``)'>Jobs & Vacancies</a></li>" +
        
        "</ul>" +
        "</div>";
    break;

    case 'contact':
    contentContainer.innerHTML = "<div class='rec-container'style='width:200vh;margin-top:7%;font-size:30px; font-weight:bolder;  background-color: #c9e9bf;'>" +
        "<ul>" +
        "<h5><?php echo $_SESSION["name"];?></h5>" +
        "<li>Our Contact:<?php echo $_SESSION["phone"];?></li>" +
        "<li>Our Email:<?php echo $_SESSION["email"];?></li>" +
        
        "</ul>" +
        "</div>";
    break;

    
    case 'jobs':
    contentContainer.innerHTML = "<div class='rec-container'style='width:200vh;margin-top:7%; font-size:30px; font-weight:bolder; background-color: #c9e9bf;'>" +
        "<ul>" +
        "<h5><?php echo $_SESSION["name"];?>  </h5>" +
        "<h4>Available Vacancies</h4>"+
        "<li><a href='#' onclick='showContent(`job`)'><?php echo $_SESSION["vacancy1"];?> </a></li>" +
        "<li><a href='#' onclick='showContent(`job`)'><?php echo $_SESSION["vacancy2"];?> </a></li>" +
        
                
        "</ul>" +
        "</div>";
    break;

    case 'job':
    contentContainer.innerHTML = "<div class='rec-container' style='height: 100vh;width:200vh;margin-top:7%;  font-size:30px; font-weight:bolder;background-color: #c9e9bf;'>" +
        "<h2 class='mp'><?php echo $_SESSION["vacancy1"];?></h2>"+
        "<embed src='<?php echo $_SESSION["tender1des"];?>' style='width:90%; height:700px;'>"+
        "</div>";
    break;

    case 'job':
    contentContainer.innerHTML = "<div class='rec-container' style='height: 100vh;width:200vh;margin-top:7%;font-size:30px; font-weight:bolder;  background-color: #c9e9bf;'>" +
        "<h2 class='mp'><?php echo $_SESSION["vacancy2"];?></h2>"+
        "<embed src='<?php echo $_SESSION["tender1des"];?>' style='width:90%; height:700px;'>"+
        "</div>";
    break;
    
    case 'report':
    contentContainer.innerHTML = "<div class='rec-container' style='height: 100vh;width:200vh;margin-top:7%;  font-size:30px; font-weight:bolder;background-color: #c9e9bf;'>" +
        "<h2 class='mp'><?php echo $_SESSION["report"];?></h2>"+
        "<embed src='<?php echo $_SESSION["tender1des"];?>' style='width:90%; height:700px;'>"+
        "</div>";
    break;


    case 'tenderadv':
    contentContainer.innerHTML = "<div class='rec-container' style='height: 100vh;width:200vh;margin-top:7%;  font-size:30px; font-weight:bolder; background-color: #c9e9bf;'>" +
                    "<ul>" +
                    "<?php echo $_SESSION["name"];?>" +
                    "<li><a href='#' onclick='showContent(`tend1`)'><?php echo $_SESSION["tender1"];?></a></li>" 
                    "</ul>" +
                    "</div>";
    break;

    case 'tend1':
    contentContainer.innerHTML = "<div class='rec-container' style='height: 150vh;width:200vh;margin-top:7%; font-size:30px; font-weight:bolder; background-color: #c9e9bf;'>" +
        "<h2 class='mp'><?php echo $_SESSION["tender1"];?></h2>"+
        "<embed src='<?php echo $_SESSION["tender1des"];?>' style='width:90%; height:700px;'>"+
        "</div>";
    break;

    
                    }
    }
    
     </script>
    <script>
        function showBursaryForm() {
            var bursaryFormContainer = document.getElementById("bursaryFormContainer");
            if (bursaryFormContainer.style.display === "none") {
                bursaryFormContainer.style.display = "block";
            } else {
                bursaryFormContainer.style.display = "none";
            }
        }
    </script>
<script>
    function showTenderAppForm() {
        var tenderFormContainer = document.getElementById("TenderappFormContainer");
        if (tenderFormContainer.style.display === "none") {
            tenderFormContainer.style.display = "block";
        } else {
            tenderFormContainer.style.display = "none";
        }
    }
</script>

<script>
    function showJobAppForm() {
        var jobFormContainer = document.getElementById("JobAppFormContainer");
        if (jobFormContainer.style.display === "none") {
            jobFormContainer.style.display = "block";
        } else {
            jobFormContainer.style.display = "none";
        }
    }
</script>


<script>
    // Function to validate student name
    function validateStudentName() {
    var studentNameInput = document.getElementById('studentname');
    var studentName = studentNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(studentName);
    if (!isValid) {
        studentNameInput.setCustomValidity("Please enter a valid student name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        studentNameInput.setCustomValidity('');
    }
}







function validateConstituencyName() {
    var constituencyNameInput = document.getElementById('constituencyName');
    var constituencyName = constituencyNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(constituencyName);
    if (!isValid) {
        constituencyNameInput.setCustomValidity("Please enter a valid constituency name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        constituencyNameInput.setCustomValidity('');
    }
}


function validateCompanyName() {
    var CompanyNameInput = document.getElementById('company');
    var CompanyName = CompanyNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(CompanyName);
    if (!isValid) {
        CompanyNameInput.setCustomValidity("Please enter a valid Company name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        CompanyNameInput.setCustomValidity('');
    }
}


function validateTenderName() {
    var TenderNameInput = document.getElementById('tender_name');
    var TenderName = TenderNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(TenderName);
    if (!isValid) {
        TenderNameInput.setCustomValidity("Please enter a valid Tender name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        TenderNameInput.setCustomValidity('');
    }
}


function validateConstituencyName() {
    var ConstituencyNameInput = document.getElementById('constituency');
    var ConstituencyName = ConstituencyNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(ConstituencyName);
    if (!isValid) {
        ConstituencyNameInput.setCustomValidity("Please enter a valid Constituency Name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        ConstituencyNameInput.setCustomValidity('');
    }
}

function validateConstituencyName() {
    var ConstituencyNameInput = document.getElementById('jobconstituency');
    var ConstituencyName = ConstituencyNameInput.value.trim();
    // Allow letters, spaces, hyphens, and apostrophes
    var isValid = /^[A-Za-z\s\-']+$/.test(ConstituencyName);
    if (!isValid) {
        ConstituencyNameInput.setCustomValidity("Please enter a valid Constituency Name (only letters, spaces, hyphens, and apostrophes allowed).");
    } else {
        ConstituencyNameInput.setCustomValidity('');
    }
}




    // Function to validate phone number
    function validatePhoneNumber() {
        var phoneNumberInput = document.getElementById('phone');
        var phoneNumber = phoneNumberInput.value.trim();
        var isValid = /^0[17]\d{8}$/.test(phoneNumber);
        if (!isValid) {
            phoneNumberInput.setCustomValidity("Please enter a valid phone number starting with 01 or 07 and having 10 digits.");
        } else {
            phoneNumberInput.setCustomValidity('');
        }
    }
 

    function validatePhoneNumber() {
        var PhoneNumberInput = document.getElementById('tenderPhone');
        var PhoneNumber = PhoneNumberInput.value.trim();
        var isValid = /^0[17]\d{8}$/.test(PhoneNumber);
        if (!isValid) {
            PhoneNumberInput.setCustomValidity("Please enter a valid phone number starting with 01 or 07 and having 10 digits.");
        } else {
            PhoneNumberInput.setCustomValidity('');
        }
    }

    function validatePhoneNumber() {
        var PhoneNumberInput = document.getElementById('jobphone');
        var PhoneNumber = PhoneNumberInput.value.trim();
        var isValid = /^0[17]\d{8}$/.test(PhoneNumber);
        if (!isValid) {
            PhoneNumberInput.setCustomValidity("Please enter a valid phone number starting with 01 or 07 and having 10 digits.");
        } else {
            PhoneNumberInput.setCustomValidity('');
        }
    }

    function validateRegistrationNumber() {
    var registrationNumberInput = document.getElementById('registrationnumber');
    var registrationNumber = registrationNumberInput.value.trim();
    var isValidFormat = /^[A-Za-z0-9]+$/.test(registrationNumber);
    var isValidLength = registrationNumber.length === 10;
    var errorSpan = document.getElementById('registrationnumberError');
    
    if (!isValidFormat || !isValidLength) {
        errorSpan.textContent = "Please enter a valid registration number (exactly 10 characters, only letters and numbers allowed).";
        registrationNumberInput.setCustomValidity("Invalid registration number");
    } else {
        errorSpan.textContent = "";
        registrationNumberInput.setCustomValidity('');
    }
}



    // Function to validate parent/student ID number
    function validateIDNumber() {
    var idNumberInput = document.getElementById('idNumber');
    var idNumber = idNumberInput.value.trim();
    var isValid = /^\d+$/.test(idNumber) && idNumber.length >= 6 && idNumber.length <= 8;
    if (!isValid) {
        idNumberInput.setCustomValidity("Please enter a parent/student ID number between 6 and 8 digits.");
    } else {
        idNumberInput.setCustomValidity('');
    }
}

function validateIDNumber() {
    var idNumberInput = document.getElementById('jobidnumber');
    var idNumber = idNumberInput.value.trim();
    var isValid = /^\d+$/.test(idNumber) && idNumber.length >= 6 && idNumber.length <= 8;
    if (!isValid) {
        idNumberInput.setCustomValidity("Please enter a parent/student ID number between 6 and 8 digits.");
    } else {
        idNumberInput.setCustomValidity('');
    }
}






    // Function to validate constituency number
    function validateConstituencyNumber() {
        var constituencyNumberInput = document.getElementById('constituencyNumber');
        var constituencyNumber = parseInt(constituencyNumberInput.value.trim());
        var isValid = constituencyNumber >= 1 && constituencyNumber <= 290;
        if (!isValid) {
            constituencyNumberInput.setCustomValidity("Please enter a valid constituency number between 1 and 290.");
        } else {
            constituencyNumberInput.setCustomValidity('');
        }
    }

    // Function to validate school/institution name
    function validateSchoolName() {
        var schoolNameInput = document.getElementById('school');
        var schoolName = schoolNameInput.value.trim();
        var isValid = /^[A-Za-z\s]+$/.test(schoolName);
        if (!isValid) {
            schoolNameInput.setCustomValidity("Please enter a valid school/institution name (only letters and spaces allowed).");
        } else {
            schoolNameInput.setCustomValidity('');
        }
    }

    // Function to validate fee balance
    function validateFeeBalance() {
    var feeBalanceInput = document.getElementById('feebalance');
    var feeBalance = feeBalanceInput.value.trim();
    var isValid = /^\d+$/.test(feeBalance);
    if (!isValid) {
        feeBalanceInput.setCustomValidity("Please enter a valid fee balance consisting of integers only.");
    } else {
        feeBalanceInput.setCustomValidity('');
    }
}


    // Function to validate reason for applying
    function validateReason() {
        var reasonInput = document.getElementById('reason');
        var reason = reasonInput.value.trim();
        var isValid = /^[A-Za-z\s]+$/.test(reason);
        if (!isValid) {
            reasonInput.setCustomValidity("Please enter a valid reason for applying (only letters and spaces allowed).");
        } else {
            reasonInput.setCustomValidity('');
        }
    }
    function validateEmail() {
        var emailInput = document.getElementById('email');
        var email = emailInput.value.trim();
        var isValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if (!isValid) {
            document.getElementById('emailError').textContent = "Please enter a valid email address.";
        } else {
            document.getElementById('emailError').textContent = "";
        }
    }

    function validateAddress() {
    var addressInput = document.getElementById('address');
    var address = addressInput.value.trim();
    if (address === "") {
        document.getElementById('addressError').textContent = "Please enter your address.";
    } else {
        document.getElementById('addressError').textContent = "";
    }
}
    function validateCourse() {
        var courseInput = document.getElementById('course');
        var course = courseInput.value.trim();
        var regex = /^[A-Za-z\s\d!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]+$/;
        if (!regex.test(course)) {
            document.getElementById('courseError').textContent = "Please enter a valid course of study.";
        } else {
            document.getElementById('courseError').textContent = "";
        }
    }

    function validateFullName() {
        var fullNameInput = document.getElementById('fullname');
        var fullName = fullNameInput.value.trim();
        // Allow letters, spaces, hyphens, and apostrophes
        var isValid = /^[A-Za-z\s\-']+$/.test(fullName);
        if (!isValid) {
            fullNameInput.setCustomValidity("Please enter a valid full name (only letters, spaces, hyphens, and apostrophes allowed).");
        } else {
            fullNameInput.setCustomValidity('');
        }
    }
    

    function validateFullName() {
        var fullNameInput = document.getElementById('full_name');
        var fullName = fullNameInput.value.trim();
        // Allow letters, spaces, hyphens, and apostrophes
        var isValid = /^[A-Za-z\s\-']+$/.test(fullName);
        if (!isValid) {
            fullNameInput.setCustomValidity("Please enter a valid full name (only letters, spaces, hyphens, and apostrophes allowed).");
        } else {
            fullNameInput.setCustomValidity('');
        }
    }
    
   
    function validateEmail() {
    var emailInput = document.getElementById('email');
    var email = emailInput.value.trim();
    // Email validation regex with specific format
    var isValid = /^[^\s@]+@gmail\.com$/.test(email);
    if (!isValid) {
        emailInput.setCustomValidity("Please enter a valid email address in the format 'abc@gmail.com'.");
    } else {
        emailInput.setCustomValidity('');
    }
}

function validateTenderPhoneNumber() {
    var phoneInput = document.getElementById('tenderPhone');
    var phone = phoneInput.value.trim();
    // Phone number validation regex: exactly 10 numeric digits
    var isValid = /^\b\d{10}\b$/.test(phone);
    if (!isValid) {
        phoneInput.setCustomValidity("Please enter a valid 10-digit phone number.");
    } else {
        phoneInput.setCustomValidity('');
    }
}

  function validateTenderForm() {
        // Validate all fields in the tender form
        validateFullName(document.getElementById('fullname'));
        validateEmail(document.getElementById('email'));
        validatePhoneNumber(document.getElementById('phone'));
        
        var invalidFields = document.querySelectorAll('#TenderappFormContainer :invalid');
        if (invalidFields.length > 0) {
            return false; // Prevent form submission if any field is invalid
        } else {
            return true; // Allow form submission if all fields are valid
        }
    }

    function validateBursaryForm() {
        // Validate all fields in the bursary form
        validateFullName(document.getElementById('studentname'));
        validateEmail(document.getElementById('email'));
        validatePhoneNumber(document.getElementById('phone'));
        // Call other validation functions specific to the bursary form

        // Check if any fields have invalid input
        var invalidFields = document.querySelectorAll('bursaryFormContainer :invalid');
        if (invalidFields.length > 0) {
            return false; // Prevent form submission if any field is invalid
        } else {
            return true; // Allow form submission if all fields are valid
        }
    }
    function validateJobForm() {
        // Validate all fields in the bursary form
        validateFullName(document.getElementById('full_name'));
        validateEmail(document.getElementById('email'));
        validatePhoneNumber(document.getElementById('phone'));
        // Call other validation functions specific to the bursary form

        // Check if any fields have invalid input
        var invalidFields = document.querySelectorAll('JobAppFormContainer :invalid');
        if (invalidFields.length > 0) {
            return false; // Prevent form submission if any field is invalid
        } else {
            return true; // Allow form submission if all fields are valid
        }
    }
</script>


<script>
    function validateconhelpForm() {
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
<script>
    function hideForm() {
        var form = document.getElementById('bursaryform');
        form.style.display = 'none'; // Hide the form
    }
</script>

</body>
</html>







