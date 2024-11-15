<?php

session_start();

require("../server/connection.php");

if (isset($_SESSION["logged_in"])) {
    if (isset($_SESSION["firstname"]) || isset($_SESSION["email"])) {
        $textaccount = $_SESSION["firstname"];
        $lname = $_SESSION["lastname"];
        $useremail = $_SESSION["email"];
    } else {
        $textaccount = "Account";
    }
} else {
    $textaccount = "Account";
}

$firstname = $middlename = $lastname = $suffix = $bday = $birthplace = $address = $gender = 
$civilstatus = $citizenship = $phone =  $email = $password = $curriculum = $errorMessage = 
$successMessage = "";

$usertype = 2;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname =  ucwords($_POST["firstname"]);
    $middlename =  ucwords($_POST["middlename"]);
    $lastname =  ucwords($_POST["lastname"]);
    $suffix =  ucwords($_POST["suffix"]);
    $bday = $_POST["bday"];
    $birthplace =  ucwords($_POST["birthplace"]);
    $address =  ucwords($_POST["address"]);
    $gender = $_POST["gender"];
    $civilstatus = $_POST["civilstatus"];
    $citizenship =  ucwords($_POST["citizenship"]);
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $curriculum =  ucwords($_POST["curriculum"]);

    // Check if the email already exists in the database
    $emailExistsQuery = "SELECT * FROM users WHERE email = '$email'";
    $emailExistsResult = $connection->query($emailExistsQuery);

    if ($emailExistsResult->num_rows > 0) {
        $errorMessage = "User already exists";
        $firstname = $middlename = $lastname = $suffix = $bday = $birthplace = $address = $gender = 
        $civilstatus = $citizenship = $phone =  $email = $password = $curriculum = $errorMessage = 
        $successMessage = "";

    } else {
        // Insert the user data into the database
        $insertQuery = "INSERT INTO users (firstname, middlename, lastname, suffix, bday, birthplace,
        address, genderid, civilstatus, citizenship, phone, email, pin, curriculum, usertypeid) 
        VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$bday', '$birthplace', '$address', 
        $gender, $civilstatus, '$citizenship', '$phone', '$email', '$password', '$curriculum', $usertype)";
        $result = $connection->query($insertQuery);

        if (!$result) {
            $errorMessage = "Invalid query " . $connection->error;
        } else {
            $firstname = $middlename = $lastname = $suffix = $bday = $birthplace = $address = $gender = 
            $civilstatus = $citizenship = $phone =  $email = $password = $curriculum = $errorMessage = 
            $successMessage = "";
            $errorMessage = "Account successfully created";
        }
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

            <!-- Body -->
            <div class="col offset-2 offset-sm-3 offset-xl-2 d-flex flex-column vh-100">
                <!-- Add Faculty -->
                <div class="container px-3 pt-4">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                        <div class="row mt-1">
                            <h2 class="fs-5">Add New Faculty</h2>
                        </div>

                        <!-- Display Error Message -->
                        <div class="row">
                            <div class="col-sm-12">
                                <?php
                                    if (!empty($errorMessage)) {
                                        echo "
                                        <div class='alert alert-warning alert-dismissible fade show mt-2' role='alert'>
                                            <strong>$errorMessage</strong>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        </div>
                                        ";
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">First Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $firstname; ?>" placeholder="Enter first name" required>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Gender<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <select id="gender" name="gender" class="form-select" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="1" <?php echo ($gender === 1) ? "selected" : ""; ?>>Male</option>
                                    <option value="2" <?php echo ($gender === 2) ? "selected" : ""; ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Middle Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="middlename" id="middlename" value="<?php echo $middlename; ?>" placeholder="Enter middle name">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Civil Status<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <select id="civilstatus" name="civilstatus" class="form-select" required>
                                    <option value="" disabled selected>Select Civil Status</option>
                                    <option value="1" <?php echo ($civilstatus === 1) ? "selected" : ""; ?>>Single</option>
                                    <option value="2" <?php echo ($civilstatus === 2) ? "selected" : ""; ?>>Married</option>
                                    <option value="3" <?php echo ($civilstatus === 3) ? "selected" : ""; ?>>Separated</option>
                                    <option value="4" <?php echo ($civilstatus === 4) ? "selected" : ""; ?>>Divorced</option>
                                    <option value="5" <?php echo ($civilstatus === 5) ? "selected" : ""; ?>>Widowed</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Last Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $lastname; ?>" placeholder="Enter last name" required>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Citizenship<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="citizenship" id="citizenship" value="<?php echo $citizenship; ?>" placeholder="Enter citizenship" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Suffix</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="suffix" id="suffix" value="<?php echo $suffix; ?>" placeholder="Enter suffix">
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Phone<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Enter phone number">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Birthday<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="bday" name="bday" value="<?php echo $bday; ?>" required>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Email<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter email address">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Birthplace<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="birthplace" name="birthplace" value="<?php echo $birthplace; ?>" placeholder="Enter birth place" required>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">PIN<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="password" class="form-control" name="password" id="password" value="<?php echo $password; ?>" placeholder="Enter password" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-sm-2">
                                <label class="form-label">Address<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <textarea class="form-control" id="address" name="address" placeholder="Enter address" rows="3"><?php echo $address; ?></textarea>
                            </div>
                            <div class="col-sm-2">
                                <label class="form-label">Curriculum</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="curriculum" id="curriculum" value="<?php echo $curriculum; ?>" placeholder="Enter curriculum">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 float-end">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-dark px-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Add Faculty -->
            </div>

        </div>
    </div> 

  <!-- Script -->  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>