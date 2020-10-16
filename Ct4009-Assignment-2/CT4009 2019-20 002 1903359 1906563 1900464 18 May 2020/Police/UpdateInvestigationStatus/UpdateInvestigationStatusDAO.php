<?php
include "../../globalFiles/config.php";
//assign form values to variable
$bikeID = ($_POST['bike']);
$status = $_POST['status'];
$message = $_POST['updateMsg'];
//insert into db if no message exists, else replace existing message

try {
   
    $sqlEmail = $connection->prepare("SELECT user_id FROM tbl_bikes WHERE bikeID = ?"); //use placeholders to prevent sql injection
    $sqlEmail->bind_param("i", $bikeID); //bind actual value to placeholder along with type (integer)
    $sqlEmail->execute(); //execute query
    $result = $sqlEmail->get_result(); //assign query result to variable

    //sort result into array to be assigned to a variable
    while ($row = $result->fetch_row()) {
        $userID = $row[0];
    }

    $subject = "Investigation Status Update"; //email subject
    $txt = "Dear Valued Civilian, \n\nYour investigation has been updated with the Status: $status, \n\n$message \n\nThank you for using our services, \n\nGloucestershire Police"; //email body
    $headers = "From: police@gloucester.com" . "\r\n"; //email sender
    mail($userID, $subject, $txt, $headers); //send email with above information to recipient with matching bikeID
     
    $sqlUpdate = $connection->prepare("REPLACE INTO `invUpdates` values (?, ?, ?)");
    $sqlUpdate->bind_param("iss", $bikeID, $status, $message); //bind actual value to placeholder along with type (integer, string)
    $sqlUpdate->execute(); //execute query

} catch(Exception $e){
    echo $e;
}