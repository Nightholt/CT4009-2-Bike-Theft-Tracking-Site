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

  <link rel="stylesheet" type="text/css" href="../../globalFiles/Navigation.css">
  <link rel="stylesheet" type="text/css" href="../../Public/Login/Login.css">
  <link rel="stylesheet" type="text/css" href="../PoliceLogin/PoliceLogin.css">
</head>

<body>
  <!-- bootstrap navbar -->
  <nav class="navbar navbar-expand-sm">
    <a class="navbar-brand" href="../../Public/Homepage/Homepage.php">
      <img src="../../globalFiles/Logo.png" alt="Constabulary Logo" width="180px" height="60px">
    </a>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <h1 style="color: white;">Police Login</h1>
      </ul>
    </div>
  </nav>
  <br><br>

  <div class="container">