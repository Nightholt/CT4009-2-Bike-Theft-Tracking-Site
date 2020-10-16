<?php
  //page title
  $page_title = "Victim Locations Heat map";
  //get the police header for page
  require('../../globalFiles/heatMapHeader.php'); //includes the file which sets the style of the page
?>
<?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
  //check if user is logged in
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Heatmap</title>
    <!--sets the size of the map-->
    <!--css for the map-->
    <style>
      #map {
        height: 750px;
        border-radius: 5px;
        border: 2px solid;
        border-color: black;
      }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
  </head>

  <body>
    <!--makes a table to show the key for the heat map-->
    <table>
      <tr>  
        <!--title-->
        <th>Key</th>
      </tr>
      <tr>
        <!--sets the colour of the box to relate to the heat map-->
        <td bgcolor="#ff0000">High Vulnerability</td>
      </tr>
      <tr>
        <!--sets the colour of the box to relate to the heat map-->
        <td bgcolor="#ffff00">Medium Vulnerability</td>
      </tr>
      <tr>
        <!--sets the colour of the box to relate to the heat map-->
        <td bgcolor="#00ff00">Low Vulnerability</td>
      </tr>
    </table><br />

    <div id="map"></div>
    <!--call the js file that creates the heat map-->
    <script src="HeatMap.js"></script>
    <!--this is the google api and includes the heat map api, calls the initMap function-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6QCGqF325m9QTLFst-qHTbE1lUaePKHY&libraries=visualization&callback=initMap" async defer></script>

  </body>
</html>

<?php } else { ?>
    <!-- won't display form if user not logged in -->
    <div id="notLoggedIn">
        <h3>Please Log in to access this</h3>
        <hr />
        <a class="btn btn-primary" href="../PoliceLogin/PoliceLogin.php" role="button">Login as Police</a>
    </div>

<?php }
  //get the footer for the page
  require('../../globalFiles/footer.php');
?>