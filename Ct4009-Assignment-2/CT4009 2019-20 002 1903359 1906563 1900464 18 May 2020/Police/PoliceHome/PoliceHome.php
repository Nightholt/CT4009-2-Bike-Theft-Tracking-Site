<?php 
$page_title = "Police Home";
require('../../globalFiles/policeHeader.php');
?>    
<script>
  $('.title').hide();
</script>

    <div class="d-flex justify-content-between">
      <img class="img" src="../../Public/Images/Logo.jpg" style="width: 100px; height: 100px;">
      <h1>Your Dashboard</h1>
      <img class="img" src="../../Public/Images/Logo.jpg" style="width: 100px; height: 100px; float: right;">
    </div>
    <link rel="stylesheet" type="text/css" href="../../Public/Homepage/Homepage.css">

    
    <div class="gridLayout">
      <a href=..\StolenEcommerce\StolenEcommerce.php>
        <div class="box item1">
          <h2>Stolen Ecommerce</h2>
          <p>Check reported stolen bikes against Ecommerce sites</p>
        </div>
      </a>
      <a href="..\UpdateInvestigationStatus\UpdateInvestigationStatus.php">
        <div class="box item2">
          <h2>Update Investigation Status</h2>
          <p>Update an open investigation. Automatically notify victims</p>
        </div>
      </a>
      <a href="..\VictimLocations\VictimLocations.php">
        <div class="box item3">
          <h2>Incident Locations</h2>
          <p>View heatmap of incident locations to identify areas in need of greater support</p>
        </div>
      </a>
      <div class="box item4">
        <a href="../ViewStolenList/ViewStolenList.php">
          <h2>View All Stolen Bikes</h2>
        </a>
        <p>View a list of every bike reported stolen through the system</p>
      </div>
    </div>

  </div>

  <?php
  require('../../globalFiles/footer.php');
  ?>