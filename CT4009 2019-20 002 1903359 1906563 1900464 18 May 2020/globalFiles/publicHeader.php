<?php
session_start();

include "../../globalFiles/config.php";
?>
<!DOCTYPE html>

<head>
  <title><?php echo $page_title; ?></title>

  <!--helps search engines define what the purpose of the site is-->
  <meta name="description" content="gloucestershire constabulary bike theft">
  <meta name="keywords" content="bike, police, gloucestershire">
  <!--defines correct character set-->
  <meta charset="utf-8">
  <!--ensures site will render correctly on all platforms, primarily mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon (icon displayed in browser tab) taken from gloucestershire constabulary site -->
  <link rel="icon alternate" href="../../globalFiles/LogoFavicon.png" type="image/png">
  <!-- bootstrap, jquery & ajax links CDN links -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- google maps api -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6QCGqF325m9QTLFst-qHTbE1lUaePKHY"></script>
  
  <link rel="stylesheet" type="text/css" href="../../globalFiles/Navigation.css">
</head>

<body>
  <!-- bootstrap navbar -->
  <nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="..\Homepage\Homepage.php">
      <img src="../../globalFiles/Logo.png" alt="Constabulary Logo" width="180px" height="60px">
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href=..\Homepage\Homepage.php>Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href=..\RegisterBike\RegisterBike.php>Register a Bike </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="..\ReportStolen\ReportStolen.php">Report a Stolen Bike </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="..\CheckInvestigationStatus\CheckInvestigationStatus.php">Check Status </a>
        </li>
      </ul>
      <!-- display user's name in navbar and change login to logout button -->
      <?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
      ?>
        <!-- move login links to right hand side of nav bar -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link uName" href="#">Hello, <?php echo $_SESSION["firstName"]; ?> </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="logout" href="../../globalFiles/Logout.php"><b>Logout </b></a>
          </li>
        </ul>
      <?php } else { ?>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link " href="#" id="loginDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Login</b></a>
            <div class="dropdown-menu" aria-labelledby="loginDropdown">
              <a id="dText" class="dropdown-item" href="..\Login\Login.php">Login as Public</a>
              <a id="dText" class="dropdown-item" href="..\..\Police\PoliceLogin\PoliceLogin.php">Login as Police</a>
            </div>
          </li>
        </ul>

      <?php } ?>

    </div>
  </nav>

  <div class="title">
    <h1><?php echo $page_title; ?></h1>
  </div>
  <div class="container">