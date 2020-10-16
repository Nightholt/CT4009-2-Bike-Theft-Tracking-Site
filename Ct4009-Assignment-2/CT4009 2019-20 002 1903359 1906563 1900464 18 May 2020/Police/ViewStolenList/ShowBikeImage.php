<?php
  //page title
  $page_title = "Chosen Bike Image(s)";
  //get police header for page
  require('../../globalFiles/policeHeader.php');
?>
<section id="sectionBikeImages">
  <!--creates a place for the bike image to be printed-->
</section>
<?php
  include "../../globalFiles/config.php";
  if (isset($_GET["bikeid"])) {
    //Get and store the chosen bike ID
    $bikeID = $_GET["bikeid"];
    // echo $bikeID;
  }
  //Get the image from the database for the relevant bike
  $sql = "SELECT * FROM tbl_bikeImages WHERE bikeID = '$bikeID'";
  //get the result from the query
  $res = mysqli_query($connection, $sql);
  //while there are results from the query
  while ($row = mysqli_fetch_array($res)) {
    //store the value from the database in a variable
    $imgID = $row['imgID'];
    //puts the value into an array
    $array[] = $imgID;
  }
?>

<script>
  //call the below js function
  getItemImages();

  function getItemImages() {
    //gets the array from the php
    var jArray = <?php echo json_encode($array); ?>;
    //initialises the html variable
    var html = '';
    //this loop is iterated round the number of times that there are images for the bike
    for(var i=0; i<jArray.length; i++){
      //set the imageID as the image from the folder 
      var imageID ='../../Public/bikeImages/' + jArray[i];
      //add the image to the html with the height and width
      html = html + '<img src="' +imageID + '"alt = "' + imageID + '" height="300" width="300">'; 
    
    }
    //prints the html to the section on the page
    $('#sectionBikeImages').html(html);
  }
</script>

<?php
  //get the footer for the page
  require('../../globalFiles/footer.php');
?>