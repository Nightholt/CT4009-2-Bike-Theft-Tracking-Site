<?php
  //this php file will return all location in the database
  include "../../globalFiles/config.php";
  //this all the data from the report stolen table in the databse
  $sql = "SELECT * FROM report_stolen";
  //stores the results in a variable
  $res = mysqli_query($connection, $sql);
  if (mysqli_query($connection, $sql)) {
    while($row = mysqli_fetch_array($res)){
      //stores the data
      $json[] = $row;
    }
    //returns the data
    echo json_encode($json);
  } else {
    //prints the connection error
    echo mysqli_error($connection);
    return;
  }
 ?>