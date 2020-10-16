<?php

include "../../globalFiles/config.php";

session_start();// starts the session
if(isset($_POST['policeNumber'])){
    
    $Number = $_POST['policeNumber']; // gets the email input 
    $pass = $_POST['password']; // get the password input 

    //prevents the user input 
    $uname = strip_tags(mysqli_real_escape_string($connection,trim($Number)));
    $pass = strip_tags(mysqli_real_escape_string($connection,trim($pass)));

    $query = "SELECT * FROM police_login WHERE policeNumber='".$Number."'"; // finds row with the email input mtching the database input 
    $tbl = mysqli_query($connection,$query);
    if(mysqli_num_rows($tbl)>0){

        $row = mysqli_fetch_array($tbl); // looks trough the hashes
        $pass_hash = $row['password'];
        if(password_verify($pass, $pass_hash)){ // if the password matches the hash 
            //logs user into website 
            $Number1 = $row['firstName'];
            $_SESSION['firstName'] = $Number1;
            header("Location: https://s1903359-ct4009.uogs.co.uk/Police/PoliceHome/PoliceHome.php"); 

        }
        else {
            echo "<script language='javascript'>";
            echo 'alert("Invalid password");';
            echo 'window.location.replace("PoliceLogin.php");';
            echo "</script>";
        }
        

    }
    else {
        echo "<script language='javascript'>";
        echo 'alert("Invalid Number");';
        echo 'window.location.replace("PoliceLogin.php");';
        echo "</script>";
    }
}

?>