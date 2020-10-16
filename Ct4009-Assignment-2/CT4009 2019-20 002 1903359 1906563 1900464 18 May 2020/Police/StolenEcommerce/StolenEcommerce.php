<?php
    //Sets the page title
    $page_title = "Stolen Ecommerce";
    //gets the necessary css
    require('../../globalFiles/policeHeader.php');
?>

<?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
    //Checks if the user is logged in 
?>
<html>
    <head>
    </head>
    <body>
        <div class="container">
            <!-- creates a table format for the page -->
            <div class="row">
                <div class="col">
                    <!-- Title -->
                    <h2>Search Ebay for the stolen bikes</h2>
                    <!--Add a style line on the page -->
                    <hr />  
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!--calls the StolenEcommerceDAO.php page-->
                    <form id='stlnBikes' method="get" action="StolenEcommerceDAO.php">
                        <!--explanation for the user-->
                        <h4>Select a stolen bike to search on ebay</h4>
                        <?php
                            //links to the database
                            include '../../globalFiles/config.php';
                            //the table is then searched so that all bikes that have been stolen are shown
                            $result = mysqli_query($connection, "SELECT * FROM tbl_bikes WHERE stolen = '1'");
                            //this creates the dropdown which will be filled with data from the table
                            echo "<select class='browser-default custom-select' id = 'bikeID'>";
                            echo "<option value='0'>ID - brand - model</option>";
                            while ($row = mysqli_fetch_Array($result)) {
                                //this prints out the bike ID, the brand and model for all the missing bikes 
                                echo "<option>$row[bikeID] - $row[brand] - $row[model] </option>";
                            }
                            //close the connection with the database
                            mysqli_close($connection);
                        ?>
                        <!--creates a submit button for the form-->
                        <input type="submit" class="btn btn-primary" id="btnSubmit">
                        <script>
							//on form submit
							$('#stlnBikes').on('submit', function(e) {
							  var formData = new FormData(this);

							  //add val of bike dropdown to form data to be posted to DAO
							  var bike = $('#bikeID').val();
							  formData.append('bike', bike);

							  if ($('#bikeID').val() === '0') { //guard against empty selection input
								alert("Please Select a Bike");
								return false;
							  }

							  //ajax to post data from form and alert user on success
							  e.preventDefault();
							  $.ajax({
								url: "StolenEcommerceDAO.js",
								method: "POST",
								data: formData,
								contentType: false,
								cache: false,
								processData: false,
								success: function(echoedMsg) {},
								error: function(err) {
								  alert("There was an error. Try again please!" + err);
								} 
							  });
							});
                        </script>
                        </input>
                    </form><br />
                </div>
            </div>
        </div>      
    </body>
</html>
<?php } else { ?>
    <!-- won't display page if user not logged in -->
    <div id="notLoggedIn">
        <h3>Please Log in to access this</h3>
        <hr />
        <!--button to link to the polics login-->
        <a class="btn btn-primary" href="../PoliceLogin/PoliceLogin.php" role="button">Login as Police</a>
    </div>
<?php } 
    //call the footer for the page
    require('../../globalFiles/footer.php');
?>