<?php
$page_title = "View Comparison";
require('../../globalFiles/policeHeader.php');
?>
<table>
<th>
<td>
        <h2>Choose a bike to compare</h2>
        <hr />
            <?php
            include '../../globalFiles/config.php';
            //this gets the email from the person that is logged in
            //the table is then searched so that all bikes that are registered by the person loggedd in are selected
            $result = mysqli_query($connection, "SELECT bikeID, brand, model FROM tbl_bikes WHERE stolen = 1");
            //this creates the dropdown which will be filled with data from the table
            echo "<select class='browser-default custom-select' id = 'bikeID'>";
            echo "<option>ID - brand - model</option>";
            while ($row = mysqli_fetch_Array($result)) {
                //this prints out the bike ID, the brand and model for all the bikes registered by the user
                echo "<option>$row[bikeID] - $row[brand] - $row[model] </option>";
            }
            echo "</select>";
            mysqli_close($connection);
            ?>
            <input type="submit" class="btn btn-primary" id="btnSubmit"></input>
            <script>
                //when the submit button is pressed the js file will be called.
                document.getElementById("btnSubmit").addEventListener("click", myFunction);
                function myFunction() {
                    $.ajax({
                        url: "ViewComparisonDAO.js"
                    })
                }
            </script>
</td>
</th>
<th>
<td>
<h1>Hello</h1>
</td>
</th>
</table>

<?php 
require('../../globalFiles/footer.php');
?>