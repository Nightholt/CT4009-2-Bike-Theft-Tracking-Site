<?php
include "../../globalFiles/config.php";

//retrieve status update where selected bike id matches
$bikeID = ($_POST['bike']);
$stmt = $connection->prepare("SELECT invStatus, msg FROM invUpdates WHERE bikeID = ?"); //use placeholders to prevent sql injection
$stmt->bind_param("i", $bikeID); //bind actual value to placeholder along with type (integer)
$stmt->execute(); //execute query
$result = $stmt->get_result(); //assign query result to variable

//determine colour of div based on which status is selected
while ($row = $result->fetch_row()) {
    if (strpos($row[0], 'Not') !== false) { //grey if status contains word 'not'
        $color = 'grey';
    } else if (strpos($row[0], 'Ongoing') !== false) {
        $color = 'yellow';
    } else if (strpos($row[0], 'Found') !== false) {
        $color = 'green';
    } else if (strpos($row[0], 'Missing') !== false) {
        $color = 'red';
    }
    //display results in div
    echo "<div style='border-radius: 5px; padding: 10px; background-color: $color'> <b>$row[0]</b><hr/> $row[1]</div>";
}
