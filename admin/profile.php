<?php

session_start();

require("../server/connection.php");

if (isset($_SESSION["logged_in"])) {
    if (isset($_SESSION["firstname"]) || isset($_SESSION["email"])) {
        $textaccount = $_SESSION["firstname"];
        $lname = $_SESSION["lastname"];
        $useremail = $_SESSION["email"];

        $firstname = $_SESSION["firstname"];
        $lastname = $_SESSION["lastname"];
        $middlename = $_SESSION["middlename"];
        $suffix = $_SESSION["suffix"];
        $gender = $_SESSION["gender"];
        $bday = $_SESSION["bday"];
        $birthplace = $_SESSION["birthplace"];
        $cs = $_SESSION["cs"];
        $citizenship = $_SESSION["citizenship"];
        $phone = $_SESSION["phone"];
        $address = $_SESSION["address"];
        $curriculum = $_SESSION["curriculum"];
        $usertypename = $_SESSION["usertypename"];
        
    } else {
        $textaccount = "Account";
    }
} else {
    $textaccount = "Account";
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $useremail = $_SESSION["email"];
    $oldpass = $_POST["oldpass"];
    $newpass = $_POST["newpass"];
    $confirmnewpass = $_POST["confirmnewpass"];

    // Fetch the current pin from the database
    $result = $connection->query("SELECT pin FROM users WHERE email = '$useremail'");
    $record = $result->fetch_assoc();
    $stored_password = $record["pin"];

    // Check if the old password matches
    if ($oldpass == $stored_password) {
        // Check if the new pin matches the confirmation pin
        if ($newpass == $confirmnewpass) {
            // Update the pin
            $connection->query("UPDATE users SET pin = '$newpass' WHERE email = '$useremail'");
            $errorMessage = "Password changed successfully";
        } else {
            // If new pins don't match
            $errorMessage = "New PIN numbers do not match";
        }
    } else {
        // If the old password doesn't match
        $errorMessage = "Old PIN number does not match";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayanan Elementary School - Requirements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>

    <div class="container-fluid overflow-hidden">
        <div class="row g-0 vh-100 overflow-y-auto">
            <div class="col-2 col-sm-3 col-xl-2 d-flex fixed-top" id="sidebar">
                <div class="d-flex flex-column flex-grow-1 align-items-center align-items-sm-start bg-dark px-2 px-sm-3 py-2 text-white vh-100 overflow-auto">
                    <a href="adminhome.php" class="d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 fw-bold pt-3">BESMAIN</span></span>
                    </a>
                    <!-- Sidebar -->
                    <ul class="nav nav-pills flex-column flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="adminhome.php" class="nav-link px-sm-0 px-2">
                                <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu1" class="nav-link px-sm-0 px-2" data-bs-toggle="collapse" data-bs-target="#submenu1">
                                <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Users <span class="bi-caret-down"></span></span>
                            </a>
                            <div class="collapse collapse-horizontal px-2" id="submenu1">
                                <ul class="list-unstyled mx-2">
                                    <li>
                                        <a href="students.php" class="nav-link">
                                            <span>Students</span></a>
                                    </li>
                                    <li>
                                        <a href="faculty.php" class="nav-link">
                                            <span>Facutly</span></a>
                                    </li>
                                    <li>
                                        <a href="admin.php" class="nav-link">
                                            <span>Admins</span></a>
                                    </li>
                                    <li>
                                        <a href="admissionacc.php" class="nav-link">
                                            <span>Admissions</span></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="admission.php" class="nav-link px-sm-0 px-2 text-truncate">
                                <i class="fs-5 bi-files"></i><span class="ms-1 d-none d-sm-inline">Admission</span> </a>
                        </li>
                        <li>
                            <a href="facultyevaluation.php" class="nav-link px-sm-0 px-2 text-truncate">
                                <i class="fs-5 bi-clipboard2-check"></i><span class="ms-1 d-none d-sm-inline">Faculty Evaluation</span> </a>
                        </li>
                    </ul>
                    <div class="dropup py-sm-4 py-1 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../img/nopf.jpg" alt="hugenerd" width="28" height="28" class="rounded-circle">
                            <span class="d-none d-sm-inline mx-1"><?php echo $textaccount . " " . $lname ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark px-0 px-sm-2 text-center text-sm-start" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item px-1" href="profile.php"><i class="fs-6 bi-person"></i><span class="d-none d-sm-inline ps-1">Profile</span></a></li>
                            <li><a class="dropdown-item px-1" href="settings.php"><i class="fs-6 bi-gear"></i><span class="d-none d-sm-inline ps-1">Settings</span></a></li>
                            <li><a class="dropdown-item px-1" href="../logout.php"><i class="fs-6 bi-power"></i><span class="d-none d-sm-inline ps-1">Logout</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col offset-2 offset-sm-3 offset-xl-2 d-flex flex-column vh-100">
                <div class="card mt-3 col-sm-11 mx-auto mt-5">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="true" href="profile.php">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-black" href="settings.php">Settings</a>
                        </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-3">
                                <h4 class="card-title">Personal Details</h4>
                                <p>First Name</p>
                                <p>Middle Name</p>
                                <p>Last Name</p>
                                <p>Suffix</p>
                                <p>Gender</p>
                                <p>Birthdate</p>
                                <p>Birth Place</p>
                                <p>Civil Status</p>
                                <p>Citizenship</p>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="card-title text-white">Personal Details</h4>
                                <p><?php echo $firstname; ?></p>
                                <p><?php echo $middlename; ?></p>
                                <p><?php echo $lastname; ?></p>
                                <p><?php echo $suffix; ?></p>
                                <p><?php echo $gender; ?></p>
                                <p><?php echo $bday; ?></p>
                                <p><?php echo $birthplace; ?></p>
                                <p><?php echo $cs; ?></p>
                                <p><?php echo $citizenship; ?></p>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="card-title">Contact Details</h4>
                                <p>Contact Number</p>
                                <p>Email Address</p>
                                <p>Present Address</p>
                                <h4 class="card-title">Program</h4>
                                <p>Standing</p>
                                <p>Curriculum</p>
                            </div>
                            <div class="col-sm-3">
                                <h4 class="card-title text-white">Contact Details</h4>
                                <p><?php echo $phone; ?></p>
                                <p><?php echo $useremail; ?></p>
                                <p><?php echo $address; ?></p>
                                <h4 class="card-title text-white">Program</h4>
                                <p><?php echo $usertypename; ?></p>
                                <p><?php echo $curriculum; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> 

  <!-- Script -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>