<?php
session_start(); // starts session
session_destroy(); // destrory the session
unset($_SESSION['firstName']); // remove the first name frpom the session
echo "<script language='javascript'>";
echo 'alert("You are now logged out");';
echo "</script>";
header("location: ../Public/Homepage/Homepage.php");



?>