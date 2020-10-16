<?php
  //page title
  $page_title = "Chosen Bike Location";
  //header for page
  require('../../globalFiles/policeHeader.php');
?>

<!--Shows a map to view the chosen stolen bike and sets the size-->
<div id="mapInput" style="height: 750px;"></div>
<?php
  //includes the configuration so it can connect to the database
  include "../../globalFiles/config.php";
  //If a bike is selected
  if (isset($_GET["bikeid"])) {
    //Get and store the chosen bike ID
    $bikeID = $_GET["bikeid"];
  }
  //sql command to get the lat and long of the chosen bike
  $sql = "SELECT Latitude, Longitude FROM report_stolen WHERE BikeID = '" . $bikeID . "'";
  //get result from the sql query
  $result = mysqli_query($connection, $sql);
  //if the query can be completed
  if (mysqli_query($connection, $sql)) {
    //checks how many results there are
    while ($row = mysqli_fetch_array($result)) {
      //stores the longitude and latitude of the chosen stolen bik
      $lat = $row['Latitude'];
      $long = $row['Longitude'];
    }
  } else {
    //prints the connection error
    echo mysqli_error($connection);
    return;
  }
  //closes the connection to the database
  mysqli_close($connection);
?>
<script>
  //calls the below js function
  initMap();

  function initMap() {
    //chooses the map center to be gloucester
    var mapCenter = new google.maps.LatLng(51.8642, -2.2382);
    var geocoder = new google.maps.Geocoder();
    //sets the zoom and the center of the map
    var mapOptions = {
      zoom: 15,
      center: mapCenter
    };
    //gets the values from the php and stores them
    var lat = "<?php echo $lat ?>";
    var long = "<?php echo $long ?>";
    //sets the map
    var myMap = new google.maps.Map(document.getElementById("mapInput"), mapOptions);
    //puts the values into a marker
    var markerLatLng = new google.maps.LatLng(lat, long);
    //create a map marker
    var marker = new google.maps.Marker({
      //sets the position of the marker to be where the values are 
      position: markerLatLng,
      //sets the map to be the personalised one
      map: myMap
    });
  }
</script>

<?php
  //get the footer for the page
  require('../../globalFiles/footer.php');
?>