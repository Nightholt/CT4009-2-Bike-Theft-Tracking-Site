<?php
  //title
  $page_title = "Stolen List Results";
  //get the header for the page
  require('../../globalFiles/policeHeader.php');
?>   
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
  //links to the configuration file
  include "../../globalFiles/config.php";
  //get the data from the week input
  $stolenweek = $_POST['stolenWeek'];
  //get the data from the month input
  $stolenmonth = $_POST['stolenMonth'];
  //get the data from the year input
  $stolenyear = $_POST['stolenYear'];
  //if the police clicks the submit week button
  if (isset($_POST['submitWeek'])) {
    //splits the week value
    $yearweek = explode('-', $stolenweek);
    //into the year
    $year = $yearweek[0];
    //and the week number with W first
    $Week = $yearweek[1];
    //gets rid of the W so its just a number
    $week = ltrim($Week, 'W');
    $dto = new DateTime();
    $dto->setISODate($year, $week);
    //works out the start of the week
    $startweek = $dto->format('Y-m-d');
    //adds 6 to work out the end of the week
    $dto->modify('+6 days');
    $endweek = $dto->format('Y-m-d');
    //Sql query to get the data during that week
    $sql = "SELECT * FROM report_stolen WHERE DateStolen >= '" . $startweek . "' and DateStolen <= '" . $endweek . "'";
    //gets the result of the query
    $result = mysqli_query($connection, $sql);
    if(mysqli_num_rows($result)>0){    
      //if the query works
      if (mysqli_query($connection, $sql)) {
        //makes a table table headings seen below
        echo "<table border='1' id = 'details'>
        <tr>
        <th>Bike ID</th>
        <th>View Location</th>
        <th>View Picture</th>
        <th>Date Stolen</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
          //adds the data from the databsae to the table along with links to the bike location and image
          $bikeid = $row['BikeID'];
          echo "<tr>";
          echo "<td>" . $row['BikeID'] . "</td>";
          echo "<td> <a href='./ShowBikeLocation.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td> <a href='./ShowBikeImage.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td>" . $row['DateStolen'] . "</td>";
        }
        echo "</table>";
        //if the query is not completed
      } else {
        echo mysqli_error($connection);
        return;
      }
    }else {
      echo ("There were no bikes reported stolen in this time frame");
    }
      mysqli_close($connection);
      //if the police clicks the submit month button
    } elseif (isset($_POST['submitMonth'])) {
      $d = date_parse_from_format("Y-m", $stolenmonth);
      //sql query to get the data from the chosen month
      $sql = "SELECT * FROM report_stolen WHERE MONTH(DateStolen) = '" . $d["month"] . "'";
      $result = mysqli_query($connection, $sql);
      if(mysqli_num_rows($result)>0){ 
      if (mysqli_query($connection, $sql)) {
        //creates the table with the data
        echo "<table border='1' id = 'details'>
        <tr>
        <th>Bike ID</th>
        <th>View Location</th>
        <th>View Picture</th>
        <th>Date Stolen</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {          
          //adds the data from the databsae to the table along with links to the bike location and image
          $bikeid = $row['BikeID'];
          echo "<tr>";
          echo "<td>" . $row['BikeID'] . "</td>";
          echo "<td> <a href='./ShowBikeLocation.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td> <a href='./ShowBikeImage.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td>" . $row['DateStolen'] . "</td>";
        }
        echo "</table>";
        //if query is not completed error is shown
      } else {
        echo mysqli_error($connection);
        return;
      }
    }else {
      echo ("There were no bikes reported stolen in this time frame");
    }
      mysqli_close($connection);
      //if police clicks the year submit button
    } elseif (isset($_POST['submitYear'])) {
      $d = date_parse_from_format("Y-m", $stolenyear);
      //sql query to get the data from table in the chosen year
      $sql = "SELECT * FROM report_stolen WHERE Year(DateStolen) = '" . $d["year"] . "'";
      $result = mysqli_query($connection, $sql);
      if(mysqli_num_rows($result)>0){ 
      if (mysqli_query($connection, $sql)) {
        //create the table
        echo "<table border='1' id = 'details'>
        <tr>
        <th>Bike ID</th>
        <th>View Location</th>
        <th>View Picture</th>
        <th>View Details</th>
        <th>Date Stolen</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
          //adds the data from the databsae to the table along with links to the bike location and image
          $bikeid = $row['BikeID'];
          echo "<tr>";
          echo "<td>" . $row['BikeID'] . "</td>";
          echo "<td> <a href='./ShowBikeLocation.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td> <a href='./ShowBikeImage.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td> <a href='./ShowBikeDetails.php?bikeid=$bikeid' class='button'>Click here</a></td>";
          echo "<td>" . $row['DateStolen'] . "</td>";
        }
        echo "</table>";
        //prints the error
      } else {
        echo mysqli_error($connection);
        return;
      }
    }else {
      echo ("There were no bikes reported stolen in this time frame");
    }
      //lose connection with the database
      mysqli_close($connection);
      exit;
    }
?>
    
<?php
//gets the footer for the page
require('../../globalFiles/footer.php');
?>