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

$studentid = $gradeid = $application_status = $remarks = "";

if (isset($_GET["applicationid"]) && !empty($_GET["applicationid"])) {
    $applicationid = $_GET["applicationid"];

    $query = "SELECT * FROM enrollment_applications
            WHERE applicationid = '$applicationid'";

    $res = $connection->query($query);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();

        $applicationid = $row["applicationid"];
        $studentid = $row["studentid"];
        $appdate = $row["appdate"];
        $application_status = $row["application_status"];
        $remarks = $row["remarks"];

        $gradeid = (isset($row["gradeid"]) && $row["gradeid"] >= 1 && $row["gradeid"] <= 8) ? (int)$row["gradeid"] : 8;

    } else {
        $errorMessage = "Enrollment Application not found.";
    }
} else {
    $errorMessage = "Enrollment Application ID is missing.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studentid = $_POST["studentid"];
    $gradeid = $_POST["gradeid"];
    $application_status = $_POST["application_status"];
    $remarks = $_POST["remarks"];

    $insertQuery = "UPDATE enrollment_applications  
                    SET  
                    studentid = '$studentid', 
                    gradeid = '$gradeid', 
                    application_status = '$application_status', 
                    remarks = '$remarks'
                    WHERE applicationid = '$applicationid'";

    $result = $connection->query($insertQuery);

    if ($result) {
        // Set a session variable for success
        $_SESSION['update_success'] = true;
        header("Location: grade_enrollment.php"); 
        exit;
    } else {
        $errorMessage = "Error updating details: " . $connection->error;
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
                                <i class="fs-5 bi-files"></i><span class="ms-1 d-none d-sm-inline">Admission Forms</span> </a>
                        </li>
                        <li>
                            <a href="admissionsched.php" class="nav-link px-sm-0 px-2 text-truncate">
                                <i class="fs-5 bi-calendar-check"></i><span class="ms-1 d-none d-sm-inline">Admission Schedules</span> </a>
                        </li>
                        <li class="nav-item">
                            <a href="#submenu2" class="nav-link px-sm-0 px-2" data-bs-toggle="collapse" data-bs-target="#submenu2">
                                <i class="fs-5 bi-file-person"></i><span class="ms-1 d-none d-sm-inline">Enrollment <span class="bi-caret-down"></span></span>
                            </a>
                            <div class="collapse collapse-horizontal px-2" id="submenu2">
                                <ul class="list-unstyled mx-2">
                                    <li>
                                        <a href="gradesection.php" class="nav-link">
                                            <span>Class Section</span></a>
                                    </li>
                                    <li>
                                        <a href="grade_enrollment.php" class="nav-link">
                                            <span>Enrollment Applications</span></a>
                                    </li>
                                    <li>
                                        <a href="grade_classassignment.php" class="nav-link">
                                            <span>Class Assignments</span></a>
                                    </li>
                                </ul>
                            </div>
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

                <!-- Edit Enrollment Application -->
                <div class="container px-3 pt-4">
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">

                        <div class="row mt-1">
                            <h2 class="fs-5">Edit Enrollment Application</h2>
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
                                <label class="form-label">Application ID</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="applicationid" id="applicationid" value="<?php echo $applicationid; ?>" disabled>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Student Number<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="studentid" id="studentid" value="<?php echo $studentid; ?>" required>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Application Date</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="appdate" id="appdate" value="<?php echo $appdate; ?>" disabled>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Grade Level<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-select" id="gradeid" name="gradeid" required>
                                    <option selected disabled>Select an option</option>
                                    <option value="1" <?php echo ($gradeid == 1) ? 'selected' : ''; ?>>Preschool</option>
                                    <option value="2" <?php echo ($gradeid == 2) ? 'selected' : ''; ?>>Kindergarten</option>
                                    <option value="3" <?php echo ($gradeid == 3) ? 'selected' : ''; ?>>Grade 1</option>
                                    <option value="4" <?php echo ($gradeid == 4) ? 'selected' : ''; ?>>Grade 2</option>
                                    <option value="5" <?php echo ($gradeid == 5) ? 'selected' : ''; ?>>Grade 3</option>
                                    <option value="6" <?php echo ($gradeid == 6) ? 'selected' : ''; ?>>Grade 4</option>
                                    <option value="7" <?php echo ($gradeid == 7) ? 'selected' : ''; ?>>Grade 5</option>
                                    <option value="8" <?php echo ($gradeid == 8) ? 'selected' : ''; ?>>Grade 6</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Application Status<span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-select" id="application_status" name="application_status" required>
                                    <option selected disabled>Select an option</option>
                                    <option value="Pending" <?php echo ($application_status == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Approved" <?php echo ($application_status == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                                    <option value="Rejected" <?php echo ($application_status == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                                </select>                            
                            </div>
                        </div>

                        <div class="row mb-3 mt-2 align-items-center">
                            <div class="col-sm-2">
                                <label class="form-label">Remarks</label>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="remarks" id="remarks" value="<?php echo $remarks; ?>" placeholder="Remarks..">
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-dark px-5">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Edit Enrollment Application -->

            </div>

        </div>
    </div> 

    <!-- Script -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php if (isset($_GET['success']) && $_GET['success'] == 'true') : ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toastHTML = `
                <div class="toast align-items-center text-bg-success border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            Enrollment Application added successfully.
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>`;
            document.body.insertAdjacentHTML('beforeend', toastHTML);
            const toast = new bootstrap.Toast(document.querySelector('.toast'));
            toast.show();
        });
    </script>
    <?php endif; ?>

</body>
</html>
