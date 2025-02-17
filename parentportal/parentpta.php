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

              <!-- PTA -->
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="parentpta.php">PTA</a>
              </li>

              <!-- FORUM -->
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="parentconsult.php">Forum</a>
              </li>

              <!-- OTHER SERVICES -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Other Services
                </a>
                <ul class="dropdown-menu">
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

      <div class="mt-5">
          <h2 class="text-white fw-bold text-center mb-3">Parent Teacher Associaton</h2>
      </div>
      <div class="container" style="height: 400px; overflow-y: scroll; background-color: #424d21; padding: 15px; border-radius: 8px; scrollbar-width: none; -ms-overflow-style: none;">
        <style>
            /* Hide the scrollbar */
            .container::-webkit-scrollbar {
                display: none;
            }
        </style>
      <?php
        // Fetch posts from the database
        $query = "
            SELECT pta.ptaid, pta.ptatitle, pta.ptapost, 
                DATE_FORMAT(pta.dateposted, '%M %d, %Y') AS datepost, 
                users.firstname, users.lastname  
            FROM pta 
            INNER JOIN users ON pta.postedby = users.userid 
            ORDER BY ptaid DESC";
        $result = $connection->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Display each post
                echo '<div class="card mb-3 shadow">';
                echo '  <div class="card-body">';
                echo '    <h5 class="card-title fw-bold">' . htmlspecialchars($row['ptatitle']) . '</h5>';
                echo '    <p class="card-text">' . nl2br(htmlspecialchars($row['ptapost'])) . '</p>';
                echo '    <p class="card-text">';
                echo '      <small class="text-muted">Posted by ' . htmlspecialchars($row['firstname'] . ' ' . $row['lastname']);
                echo '      on ' . htmlspecialchars($row['datepost']) . '</small>';
                echo '    </p>';
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo '<div class="alert alert-info" role="alert">No posts available.</div>';
        }
        ?>
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