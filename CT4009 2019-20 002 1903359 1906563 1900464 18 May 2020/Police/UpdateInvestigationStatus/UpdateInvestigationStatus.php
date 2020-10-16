<?php //header file
$page_title = "Update Investigations";
require('../../globalFiles/policeHeader.php');
?>
<?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
  ?>

<h3>Select Stolen Bike to Update Status of</h3>

<form id="invUpdate" action="UpdateInvestigationStatusDAO.php">
  <?php
  //populate dropdown with all bikes reported stolen 
  $result = mysqli_query($connection, "SELECT report_stolen.bikeID, tbl_bikes.brand, tbl_bikes.model, tbl_bikes.colour FROM report_stolen INNER JOIN tbl_bikes ON report_stolen.bikeID = tbl_bikes.bikeID");
  echo "<hr/>";
  echo "<select class='browser-default custom-select' id='bikeSelect'>";
  echo "<option value='0'>Select a Bike</option>";
  while ($row = mysqli_fetch_Array($result)) {
    echo "<option value='$row[bikeID]'>$row[bikeID] - $row[brand] - $row[model] - $row[colour]</option>"; //display bikeID and some bike info to distiguish the bike
  }
  echo "</select>";

  ?>
  <br /><br />

  <!-- radio button input options -->
  <input type="radio" id="nInv" name="status" value="Not Investigated">
  <label for="nInv">Not Investigated</label><br />
  <input type="radio" id="invOn" name="status" value="Investigation Ongoing">
  <label for="invOn">Investigation Ongoing</label><br />
  <input type="radio" id="bikeF" name="status" value="Investigation Closed, Bike Found">
  <label for="nInv">Investigation Closed, Bike Found</label><br />
  <input type="radio" id="bikeM" name="status" value="Investigation Closed, Bike Missing">
  <label for="nInv">Investigation Closed, Bike Missing</label><br /><br />

  <!-- text area to write message of update -->
  <textarea id="updateMsg" name="updateMsg" class="form-control text" maxlength="200" placeholder="Write your update here (200 characters)" required="required"></textarea><br />

  <input type="submit" class="btn btn-primary" id="btnUpdateInv" value="Submit">

</form>

<script>
  $(document).ready(function($) {

    //action of the form
    $('#invUpdate').on('submit', function(e) {
      var formData = new FormData(this);

      //add val of bike dropdown to form data to be posted to DAO
      var bike = $('#bikeSelect').val();
      formData.append('bike', bike);

      if ($('#bikeSelect').val() === '0') { //guard against empty selection input
        alert("Please Select a Bike");
        return false;
      }

      //ajax to post data from form and alert user on success
      e.preventDefault();
      $.ajax({
        url: "UpdateInvestigationStatusDAO.php",
        method: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(echoedMsg) {
          alert("Investigation Successfully Updated");
          location.reload();
        },
        error: function(err) {
          alert("There was an error. Try again please!" + err);
        } 
      });
    });
  });
</script>
<?php } else { ?>
    <!-- won't display form if user not logged in -->
    <div id="notLoggedIn">
        <h3>Please Log in to access this</h3>
        <hr />
        <a class="btn btn-primary" href="../PoliceLogin/PoliceLogin.php" role="button">Login as Police</a>
    </div>

<!-- footer file link -->
<?php }
require('../../globalFiles/footer.php');
?>