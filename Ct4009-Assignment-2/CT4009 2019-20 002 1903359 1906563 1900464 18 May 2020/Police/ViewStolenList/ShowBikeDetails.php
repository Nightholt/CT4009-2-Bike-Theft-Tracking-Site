<?php
  //page title
  $page_title = "Chosen Bike Details";
  //get police header for page
  require('../../globalFiles/policeHeader.php');
?>
<!--css for the printed table-->
<style>
    #details td,#details th {
        /*set border for the table*/
        border: 5px solid #2b2b2b;
        padding: 8px;
    }
    #details th {
        /*css for the headings in the table*/
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #0032a0;
        color: white;
    }
</style>
<?php
    if (isset($_GET["bikeid"])) {
        //Get and store the chosen bike ID
        $bikeID = $_GET["bikeid"];
    } 
    include "../../globalFiles/config.php";
    
    //sql query to get all the bikes from the table which are stolen
    $sql = "SELECT * FROM tbl_bikes WHERE bikeID = '$bikeID' AND stolen = 1";
    //store the result from the query
    $result = mysqli_query($connection, $sql);
    //if there ar eresults from the query then
    if(mysqli_num_rows($result)>0){ 
        if (mysqli_query($connection, $sql)) {
            //creates the table with the following headings
            echo "<table border='1' id='details'>
            <tr>
            <th>Bike ID</th>
            <th>MPN</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Bike type</th>
            <th>Wheel size</th>
            <th>Colour</th>
            <th>Number of gears</th>
            <th>Brakes</th>
            <th>Suspension</th>
            <th>Gender</th>
            <th>Age</th>
            </tr>";
            //for each row in the results this will loop
            while ($row = mysqli_fetch_array($result)) {
                //the data from the database get printed into the table
                echo "<tr>";
                echo "<td>" . $row['bikeID'] . "</td>";
                echo "<td>" . $row['mpn'] . "</td>";
                echo "<td>" . $row['brand'] . "</td>";
                echo "<td>" . $row['model'] . "</td>";
                echo "<td>" . $row['bikeType'] . "</td>";
                echo "<td>" . $row['wSize'] . "</td>";
                echo "<td>" . $row['colour'] . "</td>";
                echo "<td>" . $row['nGears'] . "</td>";
                echo "<td>" . $row['brakes'] . "</td>";
                echo "<td>" . $row['suspension'] . "</td>";
                echo "<td>" . $row['gender'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
            }
        echo "</table>";
        //if query is not completed error is shown
        } else {
            echo mysqli_error($connection);
            return;
        }
    }
?>

<?php
  //get the footer for the page
  require('../../globalFiles/footer.php');
?>