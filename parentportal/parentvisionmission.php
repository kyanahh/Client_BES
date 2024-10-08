<?php

session_start();

require("../server/connection.php");

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["firstname"]) || isset($_SESSION["email"])){
        $textaccount = $_SESSION["firstname"];
        $useremail = $_SESSION["email"];
    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bayanan Elementary School - Main</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body style="background-color: #424d21;">
    <nav class="navbar" style="background-color: #708238;">
        <a class="navbar-brand" style="color: #708238;">Navbar</a>
          <div class="d-flex me-5">
            <a href="https://www.facebook.com/BESMainMuntinlupaOFFICIAL/" target="_blank">
                <i class="bi bi-facebook text-white"></i></a>
            <a href="mailto:bayanan.esmain2016@gmail.com"><i class="bi bi-google text-white ms-4"></i></a>
        </div>
    </nav>

    <nav class="navbar navbar-expand-lg py-3 bg-white">
        <div class="container-fluid">
            <img src="../img/logo.jpg" alt="BESMAIN" style="height: 7vh;" class="mx-3">
            <a class="navbar-brand " href="parenthome.php">Bayanan Elementary School Main</a>
          <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavDropdown">
            <ul class="navbar-nav grid gap-3">

              <!-- HOME -->
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="parenthome.php">Home</a>
              </li>

              <!-- ABOUT -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  About
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="parentvisionmission.php">Vision and Mission</a></li>
                  <li><a class="dropdown-item" href="parenthymn.php">BESMAIN Hymn</a></li>
                  <li><a class="dropdown-item" href="parenthistory.php">History</a></li>
                  <li><a class="dropdown-item" href="parentcontacts.php">Contacts and Directory</a></li>
                </ul>
              </li>

              <!-- e-Consultation-->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                e-Consultation
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="parentconsult.php">Consult a Teacher</a></li>
                </ul>
              </li>

              <!-- GRADES -->
              <li class="nav-item">
                <a class="nav-link" href="parentstudentgrades.php">
                  Student Grades
                </a>
              </li>

              <!-- OTHER SERVICES -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Other Services
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="parentpta.php">PTA</a></li>
                  <li><a class="dropdown-item" href="parentaccmgt.php">Account Management</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item">Logged in as:</a></li>
                  <li><a class="dropdown-item"><?php echo $useremail; ?></a></li>
                </ul>
              </li>
              
              <!-- LOGOUT -->
              <li class="nav-item me-3">
                <a class="nav-link" href="../logout.php" role="button">
                  Logout
                </a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

      <div class="container-fluid bg-image p-5 text-white" style="background-image: 
      linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('../img/besmain.png'); 
      height: 30vh; background-repeat: no-repeat; background-position: center; background-size: cover; 
      position: relative;">
        <div class="content-container" style="position: absolute; bottom: 0; width: 100%;">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <h3 class="fw-bold text-white ms-5">Mission and Vision</h3>
                <ol class="breadcrumb ms-5">
                    <li class="breadcrumb-item fw-bold">
                        <a href="home.html" class="text-decoration-none text-white">Home</a>
                    </li>
                    <li class="breadcrumb-item active text-white fw-bold" aria-current="page">Mission and Vision</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-fluid mt-5 d-flex justify-content-center">
        <div class="card p-4 mx-5 col-sm-10">
            <h4 class="fw-bold">Vision</h4>
            <p>Bayanan Elementary School (Main) is a caring, dedicated, and child friendly institution of learning which is committed to produce literate, God-fearing, productive and well-disciplined graduates ready to face and solve life’s challenges.</p>
            <h4 class="fw-bold mt-3">Mission</h4>
            <p>The school endeavors to transform each child into a person capable of developing his optimum potential to prepare him for global competition.</p>
        </div>
    </div>

    <hr class="mt-5">
    <footer>
        <div class="container-fluid row m-2 text-white">

            <div class="col-md-6">
                <p>Copyright &copy; 2024 Bayanan Elementary School Main</p>
            </div>

        </div>
    </footer>
    
    <!-- Script -->  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>